/**
 * Tayrona Travel — Tracking & Consent Mode v2
 * Cumple master-tracking:
 * - window.dataLayer inicializado antes de GTM
 * - Consent Mode v2 en 'denied' por defecto hasta acción explícita
 * - snake_case estricto en eventos y propiedades
 * - Captura y preservación de UTMs + fbclid / gclid para Meta Ads
 * - Lectura numérica segura desde data-price con currency separada (sin parseFloat sobre texto)
 */
(function () {
  "use strict";

  const CONSENT_KEY = "tt_consent_v2";
  const ATTR_KEY = "tt_attribution_v1";

  // 1. Inicializar dataLayer + Consent Mode v2 en denied por defecto
  window.dataLayer = window.dataLayer || [];
  function gtag() {
    window.dataLayer.push(arguments);
  }

  const defaultConsent = {
    analytics_storage: "denied",
    ad_storage: "denied",
    ad_user_data: "denied",
    ad_personalization: "denied",
    wait_for_update: 500
  };

  gtag("consent", "default", defaultConsent);

  // 2. Capturar UTMs y click IDs (fbclid, gclid, gbraid, wbraid) sin PII
  function captureAttribution() {
    const params = new URLSearchParams(window.location.search);
    const keys = [
      "utm_source",
      "utm_medium",
      "utm_campaign",
      "utm_content",
      "utm_term",
      "fbclid",
      "gclid",
      "gbraid",
      "wbraid"
    ];

    let stored = {};
    try {
      stored = JSON.parse(sessionStorage.getItem(ATTR_KEY) || "{}");
    } catch (_) {
      stored = {};
    }

    let changed = false;
    keys.forEach((key) => {
      const val = params.get(key);
      if (val) {
        stored[key] = val.trim().slice(0, 120);
        changed = true;
      }
    });

    if (changed) {
      try {
        sessionStorage.setItem(ATTR_KEY, JSON.stringify(stored));
      } catch (_) {}
    }
    return stored;
  }

  const attribution = captureAttribution();

  function parseNumericPrice(raw) {
    if (!raw || typeof raw !== "string") return null;
    const clean = raw.trim();
    return /^(?:0|[1-9][0-9]*)(?:\.[0-9]+)?$/.test(clean) ? Number(clean) : null;
  }

  let currentConsent = { ...defaultConsent };

  function pushEvent(eventName, payload) {
    const base = {
      event: eventName,
      page_path: window.location.pathname,
      utm_source: attribution.utm_source || "direct",
      utm_medium: attribution.utm_medium || "none",
      utm_campaign: attribution.utm_campaign || "none",
      utm_content: attribution.utm_content || "none",
      fbclid_present: Boolean(attribution.fbclid),
      gclid_present: Boolean(attribution.gclid)
    };
    window.dataLayer.push(Object.assign(base, payload || {}));
  }

  function applyConsent(next, persist) {
    currentConsent = {
      analytics_storage: next.analytics_storage === "granted" ? "granted" : "denied",
      ad_storage: next.ad_storage === "granted" ? "granted" : "denied",
      ad_user_data: next.ad_user_data === "granted" ? "granted" : "denied",
      ad_personalization: next.ad_personalization === "granted" ? "granted" : "denied"
    };

    gtag("consent", "update", currentConsent);
    pushEvent("consent_update", currentConsent);

    if (persist) {
      try {
        localStorage.setItem(CONSENT_KEY, JSON.stringify(currentConsent));
      } catch (_) {}
    }
  }

  // Exponer API mínima controlada para main.js
  window.TayronaTracking = {
    pushEvent: pushEvent,
    parseNumericPrice: parseNumericPrice,
    getAttribution: function () {
      return { ...attribution };
    },
    hasAdConsent: function () {
      return currentConsent.ad_storage === "granted";
    }
  };

  // 3. Banner discreto + <dialog> nativo de preferencias
  document.addEventListener("DOMContentLoaded", function () {
    const banner = document.getElementById("consent-banner");
    const dialog = document.getElementById("privacy-dialog");
    const chkAnalytics = document.getElementById("consent-analytics");
    const chkAds = document.getElementById("consent-ads");

    let saved = null;
    try {
      saved = JSON.parse(localStorage.getItem(CONSENT_KEY) || "null");
    } catch (_) {
      saved = null;
    }

    if (saved) {
      applyConsent(saved, false);
      if (banner) banner.hidden = true;
    } else if (banner) {
      banner.hidden = false;
    }

    function syncCheckboxes() {
      if (chkAnalytics) chkAnalytics.checked = currentConsent.analytics_storage === "granted";
      if (chkAds) chkAds.checked = currentConsent.ad_storage === "granted";
    }

    document.querySelectorAll("[data-consent-accept]").forEach((btn) => {
      btn.addEventListener("click", function () {
        applyConsent(
          {
            analytics_storage: "granted",
            ad_storage: "granted",
            ad_user_data: "granted",
            ad_personalization: "granted"
          },
          true
        );
        if (banner) banner.hidden = true;
        if (dialog && dialog.open) dialog.close();
      });
    });

    document.querySelectorAll("[data-consent-reject]").forEach((btn) => {
      btn.addEventListener("click", function () {
        applyConsent(defaultConsent, true);
        if (banner) banner.hidden = true;
        if (dialog && dialog.open) dialog.close();
      });
    });

    document.querySelectorAll("[data-open-privacy]").forEach((btn) => {
      btn.addEventListener("click", function () {
        syncCheckboxes();
        if (dialog && typeof dialog.showModal === "function") {
          dialog.showModal();
        }
      });
    });

    const savePrefsBtn = document.getElementById("save-privacy-prefs");
    if (savePrefsBtn) {
      savePrefsBtn.addEventListener("click", function () {
        const analyticsVal = chkAnalytics && chkAnalytics.checked ? "granted" : "denied";
        const adsVal = chkAds && chkAds.checked ? "granted" : "denied";
        applyConsent(
          {
            analytics_storage: analyticsVal,
            ad_storage: adsVal,
            ad_user_data: adsVal,
            ad_personalization: adsVal
          },
          true
        );
        if (banner) banner.hidden = true;
        if (dialog && dialog.open) dialog.close();
      });
    }

    // 4. Medir clics reales a WhatsApp con data-price numérico y currency separada
    document.addEventListener("click", function (ev) {
      const link = ev.target.closest("a[data-wa-cta]");
      if (!link) return;

      const price = parseNumericPrice(link.getAttribute("data-price"));
      const currency = link.getAttribute("data-currency") || "COP";
      const planId = link.getAttribute("data-plan-id") || "consulta_general";
      const planName = link.getAttribute("data-plan-name") || "Consulta general";
      const location = link.getAttribute("data-cta-location") || "unknown";

      const payload = {
        cta_location: location,
        plan_id: planId,
        plan_name: planName,
        currency: currency
      };

      if (price !== null) {
        payload.value = price;
      }

      pushEvent("whatsapp_click", payload);

      // Disparo opcional hacia Meta Pixel solo si existe fbq y consentimiento ad_storage granted
      if (typeof window.fbq === "function" && currentConsent.ad_storage === "granted") {
        window.fbq("track", "Contact", {
          content_name: planName,
          content_category: planId,
          value: price !== null ? price : undefined,
          currency: currency
        });
      }
    });

    // 5. Medir apertura de FAQs (<details>) para diagnosticar objeciones CRO
    document.querySelectorAll("details[data-faq-id]").forEach((det) => {
      det.addEventListener("toggle", function () {
        if (det.open) {
          pushEvent("faq_toggle", {
            question_id: det.getAttribute("data-faq-id")
          });
        }
      });
    });

    // 6. Scroll depth (25, 50, 75, 90)
    const milestones = [25, 50, 75, 90];
    const reached = new Set();
    let scrollTicking = false;

    window.addEventListener(
      "scroll",
      function () {
        if (scrollTicking) return;
        scrollTicking = true;
        window.requestAnimationFrame(function () {
          const docHeight = document.documentElement.scrollHeight - window.innerHeight;
          if (docHeight > 0) {
            const pct = Math.round((window.scrollY / docHeight) * 100);
            milestones.forEach((m) => {
              if (pct >= m && !reached.has(m)) {
                reached.add(m);
                pushEvent("scroll_depth", { percent_scrolled: m });
              }
            });
          }
          scrollTicking = false;
        });
      },
      { passive: true }
    );
  });
})();
