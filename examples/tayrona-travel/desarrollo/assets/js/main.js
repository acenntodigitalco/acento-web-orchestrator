/**
 * Tayrona Travel — Interacciones de Conversión y Animaciones GSAP
 * Cumple master-animaciones:
 * - Contenido 100% visible por defecto si JS falla
 * - Solo transform y opacity (compositor GPU)
 * - gsap.registerPlugin() una sola vez + gsap.matchMedia() para prefers-reduced-motion
 * - gsap.quickTo() para microinteracción magnética sutil en botones desktop (pointer: fine)
 * - Cero jQuery
 */
(function () {
  "use strict";

  const WA_PHONE = "573000000000";

  const PLANS = {
    tayrona: {
      id: "tayrona_alojamiento",
      name: "Camping y Cabañas Parque Tayrona",
      price: "175000",
      optionsLabel: "Elige tu alojamiento",
      options: [
        { id: "camping", label: "Camping (desde $175.000/noche)", text: "Camping en el Parque Tayrona" },
        { id: "cabana_sin_ac", label: "Cabaña sin A/C", text: "Cabaña sin aire acondicionado en el Parque Tayrona" },
        { id: "cabana_con_ac", label: "Cabaña con A/C", text: "Cabaña con aire acondicionado en el Parque Tayrona" }
      ]
    },
    baru: {
      id: "pasadia_cartagena_baru",
      name: "Pasadía Cartagena e Isla Barú",
      price: "185000",
      optionsLabel: "Elige horario de salida desde Santa Marta",
      options: [
        { id: "salida_3am", label: "Salida 3:00 AM ($185.000)", text: "Pasadía Cartagena e Isla Barú saliendo a las 3:00 AM" },
        { id: "salida_7am", label: "Salida 7:00 AM ($185.000)", text: "Pasadía Cartagena e Isla Barú saliendo a las 7:00 AM" }
      ]
    }
  };

  function initWhatsAppBuilder() {
    const root = document.getElementById("wa-builder");
    if (!root) return;

    const planButtons = root.querySelectorAll("[data-select-plan]");
    const subOptionsWrap = document.getElementById("wa-suboptions");
    const subOptionsLabel = document.getElementById("wa-suboptions-label");
    const guestButtons = root.querySelectorAll("[data-select-guests]");
    const previewEl = document.getElementById("wa-message-preview");
    const ctaLink = document.getElementById("wa-builder-cta");

    const state = {
      planKey: "tayrona",
      optionIndex: 0,
      guests: "2 personas"
    };

    function renderSubOptions() {
      const plan = PLANS[state.planKey];
      subOptionsLabel.textContent = plan.optionsLabel;
      subOptionsWrap.innerHTML = "";

      plan.options.forEach((opt, idx) => {
        const btn = document.createElement("button");
        btn.type = "button";
        btn.className = "pill-btn";
        btn.textContent = opt.label;
        btn.setAttribute("aria-pressed", idx === state.optionIndex ? "true" : "false");
        btn.addEventListener("click", function () {
          state.optionIndex = idx;
          renderSubOptions();
          updatePreview(true);
        });
        subOptionsWrap.appendChild(btn);
      });
    }

    function updatePreview(shouldTrack) {
      const plan = PLANS[state.planKey];
      const opt = plan.options[state.optionIndex] || plan.options[0];
      const attr = window.TayronaTracking ? window.TayronaTracking.getAttribution() : {};
      const campaignNote = attr.utm_campaign ? " (Vi la promo en redes)" : "";

      const message =
        "Hola Tayrona Travel, quiero cotizar " +
        opt.text +
        " para " +
        state.guests +
        " saliendo desde Santa Marta. ¿Qué disponibilidad tienen?" +
        campaignNote;

      previewEl.textContent = message;
      ctaLink.href = "https://wa.me/" + WA_PHONE + "?text=" + encodeURIComponent(message);
      ctaLink.setAttribute("data-plan-id", plan.id);
      ctaLink.setAttribute("data-plan-name", opt.text);
      ctaLink.setAttribute("data-price", plan.price);

      if (shouldTrack && window.TayronaTracking) {
        window.TayronaTracking.pushEvent("plan_select", {
          plan_id: plan.id,
          plan_name: opt.text,
          option_id: opt.id,
          guests: state.guests,
          value: Number(plan.price),
          currency: "COP"
        });
      }
    }

    planButtons.forEach((btn) => {
      btn.addEventListener("click", function () {
        state.planKey = btn.getAttribute("data-select-plan");
        state.optionIndex = 0;
        planButtons.forEach((b) =>
          b.setAttribute("aria-pressed", b === btn ? "true" : "false")
        );
        renderSubOptions();
        updatePreview(true);
      });
    });

    guestButtons.forEach((btn) => {
      btn.addEventListener("click", function () {
        state.guests = btn.getAttribute("data-select-guests");
        guestButtons.forEach((b) =>
          b.setAttribute("aria-pressed", b === btn ? "true" : "false")
        );
        updatePreview(true);
      });
    });

    renderSubOptions();
    updatePreview(false);
  }

  function initFloatingWhatsApp() {
    const floater = document.getElementById("floating-wa");
    const hero = document.getElementById("inicio");
    if (!floater || !hero) return;

    if ("IntersectionObserver" in window) {
      const obs = new IntersectionObserver(
        function (entries) {
          const heroVisible = entries[0].isIntersecting;
          floater.classList.toggle("is-visible", !heroVisible);
        },
        { threshold: 0.12 }
      );
      obs.observe(hero);
    } else {
      floater.classList.add("is-visible");
    }
  }

  function initAnimations() {
    // Barra de progreso de lectura ligera (funciona incluso sin GSAP)
    const progressBar = document.querySelector(".scroll-progress__bar");
    if (progressBar && typeof window.gsap === "undefined") {
      window.addEventListener(
        "scroll",
        function () {
          const max = document.documentElement.scrollHeight - window.innerHeight;
          const ratio = max > 0 ? Math.min(1, Math.max(0, window.scrollY / max)) : 0;
          progressBar.style.transform = "scaleX(" + ratio + ")";
        },
        { passive: true }
      );
      return;
    }

    if (typeof window.gsap === "undefined") return;

    const gsap = window.gsap;
    const ScrollTrigger = window.ScrollTrigger;
    if (ScrollTrigger) {
      gsap.registerPlugin(ScrollTrigger);
    }

    const mm = gsap.matchMedia();

    // 1. Movimiento completo cuando el usuario NO solicita reducción
    mm.add("(prefers-reduced-motion: no-preference)", function () {
      // Barra de progreso ligada al scroll
      if (progressBar && ScrollTrigger) {
        gsap.to(progressBar, {
          scaleX: 1,
          ease: "none",
          scrollTrigger: {
            trigger: document.documentElement,
            start: "top top",
            end: "bottom bottom",
            scrub: 0.2
          }
        });
      }

      // Entrada focal única del hero (contenido visible si JS falla; gsap.from usa immediateRender seguro)
      const heroItems = document.querySelectorAll(".hero [data-hero-reveal]");
      if (heroItems.length) {
        gsap.from(heroItems, {
          autoAlpha: 0,
          y: 26,
          duration: 0.65,
          stagger: 0.08,
          ease: "power3.out",
          clearProps: "transform,opacity,visibility"
        });
      }

      // Parallax real en el fondo del Hero
      const heroMedia = document.querySelector("[data-parallax-hero]");
      if (heroMedia && ScrollTrigger) {
        gsap.to(heroMedia, {
          yPercent: 14,
          ease: "none",
          scrollTrigger: {
            trigger: "#inicio",
            start: "top top",
            end: "bottom top",
            scrub: true
          }
        });
      }

      // Parallax sutil interior en fotografías de tarjetas de planes
      document.querySelectorAll("[data-parallax-img]").forEach(function (img) {
        if (!ScrollTrigger) return;
        gsap.to(img, {
          yPercent: 7,
          ease: "none",
          scrollTrigger: {
            trigger: img.closest(".plan-card__media") || img,
            start: "top bottom",
            end: "bottom top",
            scrub: true
          }
        });
      });

      // Reveals por scroll en bloques editoriales
      if (ScrollTrigger) {
        ScrollTrigger.batch("[data-reveal]", {
          start: "top 86%",
          once: true,
          onEnter: function (batch) {
            gsap.from(batch, {
              autoAlpha: 0,
              y: 24,
              duration: 0.55,
              stagger: 0.08,
              ease: "power3.out",
              clearProps: "transform,opacity,visibility"
            });
          }
        });
      }

      // Microinteracción magnética sutil en CTAs principales solo en desktop (pointer: fine)
      if (window.matchMedia("(pointer: fine)").matches) {
        document.querySelectorAll("[data-magnetic]").forEach(function (btn) {
          const surface = btn.querySelector(".btn__surface");
          if (!surface) return;
          const xTo = gsap.quickTo(surface, "x", { duration: 0.3, ease: "power3.out" });
          const yTo = gsap.quickTo(surface, "y", { duration: 0.3, ease: "power3.out" });

          const onMove = function (e) {
            const rect = btn.getBoundingClientRect();
            const dx = (e.clientX - (rect.left + rect.width / 2)) * 0.14;
            const dy = (e.clientY - (rect.top + rect.height / 2)) * 0.18;
            xTo(gsap.utils.clamp(-8, 8, dx));
            yTo(gsap.utils.clamp(-5, 5, dy));
          };

          const onLeave = function () {
            xTo(0);
            yTo(0);
          };

          btn.addEventListener("pointermove", onMove);
          btn.addEventListener("pointerleave", onLeave);
        });
      }
    });

    // 2. Movimiento reducido semántico: cero parallax, solo fades sutiles
    mm.add("(prefers-reduced-motion: reduce)", function () {
      if (progressBar && ScrollTrigger) {
        gsap.to(progressBar, {
          scaleX: 1,
          ease: "none",
          scrollTrigger: {
            trigger: document.documentElement,
            start: "top top",
            end: "bottom bottom",
            scrub: true
          }
        });
      }
    });
  }

  document.addEventListener("DOMContentLoaded", function () {
    initWhatsAppBuilder();
    initFloatingWhatsApp();
    initAnimations();
  });
})();
