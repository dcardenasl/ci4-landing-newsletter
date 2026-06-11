class LandingAnalytics {
  constructor() {
    this.config = window.APP_CONFIG || {};
    this.endpoint = this.config.analyticsEndpoint || "";
    this.projectKey = this.config.projectKey || "default";
    this.locale = this.config.locale || document.documentElement.lang || "es";
    this.pageType = this.config.pageType || "home";
    this.pageState = this.config.pageState || "";
    this.pageContextEvent = this.config.pageContextEvent || "";
    this.disabled = this.isDoNotTrackEnabled() || !this.endpoint;
    this.sessionKey = `newsletter.analytics.session.${this.projectKey}`;
    this.sectionSeen = new Set();
    this.scrollMarksSeen = new Set();
    this.formStarted = new WeakSet();
    this.sessionId = this.resolveSessionId();
  }

  init() {
    if (this.disabled) {
      return;
    }

    this.annotateForms();
    this.trackPageContext();
    this.trackPageview();
    this.observeSections();
    this.bindScrollTracking();
  }

  isDoNotTrackEnabled() {
    return navigator.doNotTrack === "1" || window.doNotTrack === "1" || navigator.msDoNotTrack === "1";
  }

  resolveSessionId() {
    const stored = this.readStorage(this.sessionKey);
    if (stored) {
      return stored;
    }

    const generated = this.generateSessionId();
    this.writeStorage(this.sessionKey, generated);

    return generated;
  }

  generateSessionId() {
    if (window.crypto?.randomUUID) {
      return window.crypto.randomUUID();
    }

    const randomPart = Math.random().toString(36).slice(2, 12);
    return `analytics-${Date.now()}-${randomPart}`;
  }

  readStorage(key) {
    try {
      return window.localStorage.getItem(key);
    } catch (error) {
      return null;
    }
  }

  writeStorage(key, value) {
    try {
      window.localStorage.setItem(key, value);
    } catch (error) {
      // Ignore storage failures in private browsing / blocked storage modes.
    }
  }

  annotateForms() {
    document.querySelectorAll("[data-newsletter-form]").forEach((form) => {
      const sessionInput = form.querySelector('[name="analytics_session_id"]') || document.createElement("input");
      sessionInput.type = "hidden";
      sessionInput.name = "analytics_session_id";
      sessionInput.value = this.sessionId;
      if (!sessionInput.isConnected) {
        form.appendChild(sessionInput);
      }

      const formKey = form.dataset.analyticsForm || "newsletter-form";

      form.addEventListener("focusin", () => {
        if (this.formStarted.has(form)) {
          return;
        }
        this.formStarted.add(form);
        this.track("form_start", {
          formKey: formKey,
          metadata: { page_type: this.pageType },
        });
      });

      form.addEventListener("submit", () => {
        this.track("form_submit", {
          formKey: formKey,
          metadata: { page_type: this.pageType },
        });
      });
    });
  }

  trackPageContext() {
    if (!this.pageContextEvent) {
      return;
    }

    this.track(this.pageContextEvent, {
      metadata: {
        page_type: this.pageType,
        page_state: this.pageState || null,
      },
    });
  }

  trackPageview() {
    this.track("pageview", {
      metadata: {
        page_type: this.pageType,
        locale: this.locale,
        page_state: this.pageState || null,
      },
    });
  }

  observeSections() {
    const sections = document.querySelectorAll("[data-analytics-section]");
    if (!sections.length) {
      return;
    }

    if (!("IntersectionObserver" in window)) {
      sections.forEach((section) => {
        this.trackSection(section);
      });
      return;
    }

    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) {
          return;
        }

        this.trackSection(entry.target);
        observer.unobserve(entry.target);
      });
    }, { threshold: 0.35 });

    sections.forEach((section) => observer.observe(section));
  }

  trackSection(section) {
    const sectionKey = section.dataset.analyticsSection || "";
    if (!sectionKey || this.sectionSeen.has(sectionKey)) {
      return;
    }

    this.sectionSeen.add(sectionKey);
    this.track("section_view", {
      sectionKey: sectionKey,
      metadata: { page_type: this.pageType },
    });
  }

  bindScrollTracking() {
    const thresholds = [25, 50, 75, 100];

    const onScroll = () => {
      const maxScroll = Math.max(document.documentElement.scrollHeight - window.innerHeight, 1);
      const current = Math.min(100, Math.round((window.scrollY / maxScroll) * 100));

      thresholds.forEach((threshold) => {
        if (current < threshold || this.scrollMarksSeen.has(threshold)) {
          return;
        }

        this.scrollMarksSeen.add(threshold);
        this.track("scroll", {
          metadata: {
            page_type: this.pageType,
            percent: threshold,
          },
        });
      });
    };

    window.addEventListener("scroll", onScroll, { passive: true });
    onScroll();
  }

  track(eventName, options = {}) {
    if (this.disabled) {
      return Promise.resolve(false);
    }

    const payload = {
      events: [
        {
          analytics_session_id: this.sessionId,
          project_key: this.projectKey,
          event_name: eventName,
          page_path: window.location.pathname,
          section_key: options.sectionKey || null,
          form_key: options.formKey || null,
          occurred_at: new Date().toISOString(),
          metadata: {
            locale: this.locale,
            page_type: this.pageType,
            page_state: this.pageState || null,
            ...(options.metadata || {}),
          },
        },
      ],
    };

    const body = JSON.stringify(payload);

    if (navigator.sendBeacon) {
      try {
        const beaconPayload = new Blob([body], { type: "application/json" });
        if (navigator.sendBeacon(this.endpoint, beaconPayload)) {
          return Promise.resolve(true);
        }
      } catch (error) {
        // Fallback to fetch below.
      }
    }

    return fetch(this.endpoint, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
      },
      body,
      keepalive: true,
    }).then(() => true).catch(() => false);
  }
}

document.addEventListener("DOMContentLoaded", () => {
  window.LandingAnalytics = new LandingAnalytics();
  window.LandingAnalytics.init();
});
