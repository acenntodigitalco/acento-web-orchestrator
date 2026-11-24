/**
 * Albor Odontología — Consent Mode v2 y dataLayer en snake_case.
 */
(function () {
  "use strict";

  const CONSENT_KEY = "albor_consent_v2";
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

  function pushEvent(name, payload) {
    window.dataLayer.push(
      Object.assign(
        {
          event: name,
          page_path: window.location.pathname
        },
        payload || {}
      )
    );
  }

  let current = { ...defaultConsent };

  function applyConsent(next, persist) {
    current = {
      analytics_storage: next.analytics_storage === "granted" ? "granted" : "denied",
      ad_storage: next.ad_storage === "granted" ? "granted" : "denied",
      ad_user_data: next.ad_user_data === "granted" ? "granted" : "denied",
      ad_personalization: next.ad_personalization === "granted" ? "granted" : "denied"
    };
    gtag("consent", "update", current);
    pushEvent("consent_update", current);
    if (persist) {
      try {
        localStorage.setItem(CONSENT_KEY, JSON.stringify(current));
      } catch (_) {}
    }
  }

  window.AlborTracking = { pushEvent: pushEvent };

  document.addEventListener("DOMContentLoaded", function () {
    const banner = document.getElementById("albor-consent-banner");
    const dialog = document.getElementById("albor-privacy-dialog");
    const chkA = document.getElementById("albor-consent-analytics");
    const chkM = document.getElementById("albor-consent-ads");

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

    document.querySelectorAll("[data-albor-accept]").forEach(function (el) {
      el.addEventListener("click", function () {
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

    document.querySelectorAll("[data-albor-reject]").forEach(function (el) {
      el.addEventListener("click", function () {
        applyConsent(defaultConsent, true);
        if (banner) banner.hidden = true;
        if (dialog && dialog.open) dialog.close();
      });
    });

    document.querySelectorAll("[data-albor-open-privacy]").forEach(function (el) {
      el.addEventListener("click", function () {
        if (chkA) chkA.checked = current.analytics_storage === "granted";
        if (chkM) chkM.checked = current.ad_storage === "granted";
        if (dialog && typeof dialog.showModal === "function") dialog.showModal();
      });
    });

    const saveBtn = document.getElementById("albor-save-privacy");
    if (saveBtn) {
      saveBtn.addEventListener("click", function () {
        const a = chkA && chkA.checked ? "granted" : "denied";
        const m = chkM && chkM.checked ? "granted" : "denied";
        applyConsent(
          {
            analytics_storage: a,
            ad_storage: m,
            ad_user_data: m,
            ad_personalization: m
          },
          true
        );
        if (banner) banner.hidden = true;
        if (dialog && dialog.open) dialog.close();
      });
    }

    document.addEventListener("click", function (ev) {
      const link = ev.target.closest("a[data-albor-wa]");
      if (!link) return;
      pushEvent("whatsapp_click", {
        cta_location: link.getAttribute("data-cta-location") || "general",
        value: 95000,
        currency: "COP"
      });
    });
  });
})();
