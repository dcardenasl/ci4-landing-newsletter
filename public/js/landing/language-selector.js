/**
 * Language Selector Component
 * Handles the language dropdown functionality for the header
 */
class LanguageSelector {
  constructor() {
    this.dropdown = document.getElementById("languageDropdown");
    this.btn = document.getElementById("languageBtn");
    this.menu = document.getElementById("languageMenu");

    if (this.dropdown && this.btn && this.menu) {
      this.init();
    }
  }

  init() {
    // Toggle dropdown on button click
    this.btn.addEventListener("click", (e) => {
      e.stopPropagation();
      this.toggleDropdown();
    });

    // Handle language selection
    const options = this.menu.querySelectorAll(".language-option");
    options.forEach((option) => {
      option.addEventListener("click", (e) => {
        e.stopPropagation();
        this.selectLanguage(option);
      });
    });

    // Close dropdown when clicking outside
    document.addEventListener("click", () => {
      this.closeDropdown();
    });

    // Prevent dropdown from closing when clicking inside menu
    this.menu.addEventListener("click", (e) => {
      e.stopPropagation();
    });

    // Close dropdown on escape key
    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape") {
        this.closeDropdown();
      }
    });

    // Close dropdown on scroll
    window.addEventListener("scroll", () => {
      this.closeDropdown();
    });
  }

  toggleDropdown() {
    this.dropdown.classList.toggle("open");

    // Update aria attributes for accessibility
    const isOpen = this.dropdown.classList.contains("open");
    this.btn.setAttribute("aria-expanded", isOpen);
  }

  closeDropdown() {
    this.dropdown.classList.remove("open");
    this.btn.setAttribute("aria-expanded", "false");
  }

  selectLanguage(option) {
    const locale = option.dataset.locale;
    const url = option.dataset.url;

    // Add loading state to the clicked option
    option.style.opacity = "0.7";
    option.style.pointerEvents = "none";

    // Close dropdown
    this.closeDropdown();

    // Redirect to new language URL with smooth transition
    if (url) {
      // Add a small delay to show the selection feedback
      setTimeout(() => {
        window.location.href = url;
      }, 150);
    } else {
      // Fallback: construct URL manually
      setTimeout(() => {
        window.location.href = this.constructLanguageUrl(locale);
      }, 150);
    }
  }

  constructLanguageUrl(locale) {
    const currentPath = window.location.pathname;
    const baseUrl = window.location.origin;

    // Remove current locale from path if exists
    const pathSegments = currentPath
      .split("/")
      .filter((segment) => segment !== "");
    const supportedLocales = ["es", "en", "pt", "fr", "it"]; // Should match your config

    if (supportedLocales.includes(pathSegments[0])) {
      pathSegments[0] = locale;
    } else {
      pathSegments.unshift(locale);
    }

    return `${baseUrl}/${pathSegments.join("/")}`;
  }
}

// Initialize language selector when DOM is loaded
document.addEventListener("DOMContentLoaded", () => {
  new LanguageSelector();
});

// Export for potential use in other modules
if (typeof module !== "undefined" && module.exports) {
  module.exports = LanguageSelector;
}
