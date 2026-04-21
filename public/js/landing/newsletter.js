// Newsletter functionality with Google reCAPTCHA v3 integration and invitation code support
class Newsletter {
  constructor(formElement) {
    this.endpoint = window.APP_CONFIG?.newsletterEndpoint || "/api/newsletter/subscribe";
    this.form = formElement;
    this.siteKey = window.APP_CONFIG?.recaptchaSiteKey || "";
    this.invitationCode = this.getInvitationCodeFromURL();
    this.initializeElements();
    this.bindEvents();
    this.displayInvitationStatus();
  }

  /**
   * Extract invitation code from URL query parameters
   * Supports both 'invitation_code' and 'code' parameters
   */
  getInvitationCodeFromURL() {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get("invitation_code") || urlParams.get("code") || null;
  }

  /**
   * Display a message if an invitation code is detected
   */
  displayInvitationStatus() {
    if (this.invitationCode) {
      console.log("Código de invitación detectado:", this.invitationCode);

      // Opcional: Mostrar un mensaje visual al usuario
      const invitationBadge = this.form.querySelector(".invitation-badge");
      if (invitationBadge) {
        invitationBadge.textContent = `Código de invitación: ${this.invitationCode}`;
        invitationBadge.style.display = "block";
      }
    }
  }

  initializeElements() {
    // Find elements within the specific form scope using the original IDs
    this.emailInput = this.form.querySelector("#email-input");
    this.submitBtn = this.form.querySelector("#submit-btn");
    this.btnText = this.submitBtn.querySelector(".btn-text");
    this.loadingSpinner = this.submitBtn.querySelector(".loading-spinner");
    this.feedbackMessage = this.form.querySelector("#feedback-message");

    // Create hidden input for reCAPTCHA token if it doesn't exist
    this.recaptchaInput = this.form.querySelector("#recaptcha_token");
    if (!this.recaptchaInput) {
      this.recaptchaInput = document.createElement("input");
      this.recaptchaInput.type = "hidden";
      this.recaptchaInput.id = "recaptcha_token";
      this.recaptchaInput.name = "recaptcha_token";
      this.form.appendChild(this.recaptchaInput);
    }

    // Create hidden input for invitation code if it doesn't exist
    this.invitationInput = this.form.querySelector("#invitation_code");
    if (!this.invitationInput) {
      this.invitationInput = document.createElement("input");
      this.invitationInput.type = "hidden";
      this.invitationInput.id = "invitation_code";
      this.invitationInput.name = "invitation_code";
      this.form.appendChild(this.invitationInput);
    }

    // Set invitation code value if available
    if (this.invitationCode) {
      this.invitationInput.value = this.invitationCode;
    }
  }

  bindEvents() {
    // Bind form submission and input events
    this.form.addEventListener("submit", (e) => this.handleSubmit(e));
    this.emailInput.addEventListener("input", () => this.clearValidation());
  }

  setLoadingState(isLoading) {
    // Toggle loading state for submit button
    if (isLoading) {
      this.submitBtn.disabled = true;
      this.btnText.style.display = "none";
      this.loadingSpinner.style.display = "inline-block";
    } else {
      this.submitBtn.disabled = false;
      this.btnText.style.display = "inline-block";
      this.loadingSpinner.style.display = "none";
    }
  }

  showFeedback(message, type) {
    // Display feedback message with specified type (success/error)
    this.feedbackMessage.textContent = message;
    this.feedbackMessage.className = `feedback-message ${type}`;
    this.feedbackMessage.style.display = "block";

    // Auto-hide feedback message after 5 seconds
    setTimeout(() => {
      this.feedbackMessage.style.display = "none";
    }, 5000);
  }

  validateEmail(email) {
    // Validate email format using regex
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }

  clearValidation() {
    // Remove validation classes and hide feedback message
    this.emailInput.classList.remove("is-invalid", "is-valid");
    if (this.feedbackMessage.style.display === "block") {
      this.feedbackMessage.style.display = "none";
    }
  }

  async getRecaptchaToken() {
    // Get reCAPTCHA token for the newsletter subscription action
    return new Promise((resolve, reject) => {
      if (typeof grecaptcha === "undefined") {
        reject(new Error("reCAPTCHA not loaded"));
        return;
      }

      if (!this.siteKey) {
        reject(new Error("reCAPTCHA site key not configured"));
        return;
      }

      grecaptcha.ready(() => {
        grecaptcha
          .execute(this.siteKey, { action: "newsletter_subscription" })
          .then((token) => {
            resolve(token);
          })
          .catch((error) => {
            reject(error);
          });
      });
    });
  }

  /**
   * Get CSRF token from meta tags
   */
  getCsrfToken() {
    const metaToken = document.querySelector('meta[class="csrf-token"]');
    return metaToken ? metaToken.getAttribute("content") : "";
  }

  /**
   * Get CSRF token name from meta tags
   */
  getCsrfTokenName() {
    const metaToken = document.querySelector('meta[class="csrf-token"]');
    return metaToken ? metaToken.getAttribute("name") : "csrf_test_name";
  }

  async handleSubscription(email, recaptchaToken) {
    try {
      // Preparar datos para enviar (incluir código de invitación si existe)
      const requestData = {
        email: email,
        source: window.APP_CONFIG?.siteId || "newsletter-landing",
        timestamp: new Date().toISOString(),
        recaptcha_token: recaptchaToken,
      };

      // Agregar código de invitación si está disponible
      if (this.invitationCode) {
        requestData.invitation_code = this.invitationCode;
      }

      console.log("Sending subscription data:", {
        ...requestData,
        recaptcha_token: "***hidden***", // No mostrar el token en logs
      });

      // Headers for the request
      const headers = {
        "Content-Type": "application/json",
        Accept: "application/json",
      };

      // Add CSRF token to headers
      const csrfToken = this.getCsrfToken();
      if (csrfToken) {
        headers["X-CSRF-TOKEN"] = csrfToken;
      }

      // Send subscription request to API endpoint with reCAPTCHA token
      const response = await fetch(this.endpoint, {
        method: "POST",
        headers: headers,
        body: JSON.stringify(requestData),
      });

      const data = await response.json();

      if (response.ok) {
        this.handleSuccess(data);
      } else {
        this.handleError(data);
      }
    } catch (error) {
      // Handle network or connection errors
      console.error("Subscription error:", error);
      this.showFeedback(
        "Error de conexión. Por favor intenta nuevamente.",
        "error"
      );
      this.emailInput.classList.add("is-invalid");
    }
  }

  handleSuccess(data) {
    // Handle successful subscription response
    let successMessage =
      data.message || "¡Gracias por suscribirte! Te mantendremos informado.";

    // Agregar mensaje especial si se usó código de invitación
    if (this.invitationCode && data.invitation_applied) {
      successMessage +=
        " Tu código de invitación ha sido aplicado exitosamente.";
    }

    this.showFeedback(successMessage, "success");
    this.emailInput.value = "";
    this.emailInput.classList.remove("is-invalid");
    this.emailInput.classList.add("is-valid");

    // Reset validation styling after 6 seconds
    setTimeout(() => {
      this.emailInput.classList.remove("is-valid");
    }, 6000);
  }

  handleError(data) {
    // Handle error response from API
    if (data.errors) {
      const emailError = data.errors.email;
      const recaptchaError = data.errors.recaptcha_token;
      const invitationError = data.errors.invitation_code;

      if (emailError) {
        this.showFeedback(emailError, "error");
      } else if (recaptchaError) {
        this.showFeedback(
          "Error de verificación. Por favor intenta nuevamente.",
          "error"
        );
      } else if (invitationError) {
        this.showFeedback(
          `Código de invitación inválido: ${invitationError}`,
          "error"
        );
      } else {
        const firstError = Object.values(data.errors)[0];
        this.showFeedback(firstError, "error");
      }
    } else {
      const errorMessage = data.message || "Error al procesar la suscripción";
      this.showFeedback(errorMessage, "error");
    }
    this.emailInput.classList.add("is-invalid");
  }

  async handleSubmit(e) {
    e.preventDefault();

    const email = this.emailInput.value.trim();

    // Validate email input
    if (!email) {
      this.showFeedback("Por favor ingresa tu email.", "error");
      this.emailInput.classList.add("is-invalid");
      return;
    }

    if (!this.validateEmail(email)) {
      this.showFeedback("Por favor ingresa un email válido.", "error");
      this.emailInput.classList.add("is-invalid");
      return;
    }

    // Clear previous validation classes
    this.emailInput.classList.remove("is-invalid", "is-valid");

    // Process subscription with loading state
    this.setLoadingState(true);

    try {
      // Get reCAPTCHA token before making the request
      const recaptchaToken = await this.getRecaptchaToken();

      if (!recaptchaToken) {
        throw new Error("No se pudo obtener el token de reCAPTCHA");
      }

      this.recaptchaInput.value = recaptchaToken;

      // Process subscription with reCAPTCHA token
      await this.handleSubscription(email, recaptchaToken);
    } catch (error) {
      console.error("reCAPTCHA error:", error);
      this.showFeedback(
        "Error de verificación. Por favor recarga la página e intenta nuevamente.",
        "error"
      );
      this.emailInput.classList.add("is-invalid");
    } finally {
      this.setLoadingState(false);
    }
  }
}

// Initialize newsletter functionality for all forms when DOM is loaded
document.addEventListener("DOMContentLoaded", () => {
  // Find all forms with ID "newsletter-form" (there might be duplicates)
  const newsletterForms = document.querySelectorAll("#newsletter-form");

  // Create Newsletter instance for each form
  newsletterForms.forEach((form) => {
    new Newsletter(form);
  });
});
