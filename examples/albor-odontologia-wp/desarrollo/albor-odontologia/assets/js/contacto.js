/**
 * Formulario CRO de valoración dental:
 * - Validación inline on-blur sin borrar inputs
 * - Mueve foco al primer error al enviar
 * - Dispara generate_lead únicamente cuando POST REST devuelve HTTP 2xx y ok: true
 */
(function () {
  "use strict";

  document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("albor-valoracion-form");
    if (!form || typeof window.AlborRest === "undefined") return;

    const statusBox = document.getElementById("albor-form-status");
    const submitBtn = document.getElementById("albor-submit-btn");

    function setError(input, message) {
      const errEl = document.getElementById(input.id + "-error");
      if (message) {
        input.setAttribute("aria-invalid", "true");
        if (errEl) errEl.textContent = message;
      } else {
        input.removeAttribute("aria-invalid");
        if (errEl) errEl.textContent = "";
      }
    }

    function validateField(input) {
      const val = (input.value || "").trim();
      if (input.name === "nombre") {
        if (val.length < 2) {
          setError(input, "Escribe tu nombre (mínimo 2 caracteres).");
          return false;
        }
      }
      if (input.name === "celular") {
        if (!/^[0-9+\s()-]{7,20}$/.test(val)) {
          setError(input, "Ingresa un celular o WhatsApp válido de 7 a 15 dígitos.");
          return false;
        }
      }
      if (input.name === "motivo" && !val) {
        setError(input, "Selecciona el motivo de tu consulta.");
        return false;
      }
      setError(input, "");
      return true;
    }

    const inputs = form.querySelectorAll("input[required], select[required]");
    inputs.forEach(function (inp) {
      inp.addEventListener("blur", function () {
        validateField(inp);
      });
    });

    form.addEventListener("submit", async function (ev) {
      ev.preventDefault();
      if (statusBox) {
        statusBox.hidden = true;
        statusBox.className = "albor-form-status";
      }

      let firstInvalid = null;
      inputs.forEach(function (inp) {
        const ok = validateField(inp);
        if (!ok && !firstInvalid) firstInvalid = inp;
      });

      if (firstInvalid) {
        firstInvalid.focus();
        return;
      }

      const payload = {
        nombre: form.elements.nombre.value.trim(),
        celular: form.elements.celular.value.trim(),
        motivo: form.elements.motivo.value,
        franja: form.elements.franja.value
      };

      const originalLabel = submitBtn.textContent;
      submitBtn.disabled = true;
      submitBtn.textContent = "Enviando solicitud...";

      try {
        const res = await fetch(window.AlborRest.endpoint, {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "X-WP-Nonce": window.AlborRest.nonce
          },
          body: JSON.stringify(payload)
        });
        const data = await res.json();

        if (!res.ok || !data || data.ok !== true) {
          throw new Error((data && data.message) || "No pudimos registrar tu solicitud.");
        }

        if (statusBox) {
          statusBox.hidden = false;
          statusBox.classList.add("albor-form-status--ok");
          statusBox.textContent = data.message || "Solicitud recibida. Te contactaremos en tu franja elegida.";
        }

        // Evento de conversión únicamente tras éxito 2xx confirmado por el servidor
        if (window.AlborTracking) {
          window.AlborTracking.pushEvent("generate_lead", {
            lead_id: data.lead_id,
            motivo: payload.motivo,
            franja: payload.franja,
            value: 95000,
            currency: "COP"
          });
        }

        form.reset();
      } catch (err) {
        if (statusBox) {
          statusBox.hidden = false;
          statusBox.classList.add("albor-form-status--err");
          statusBox.textContent = err.message + " También puedes escribirnos por WhatsApp.";
        }
      } finally {
        submitBtn.disabled = false;
        submitBtn.textContent = originalLabel;
      }
    });
  });
})();
