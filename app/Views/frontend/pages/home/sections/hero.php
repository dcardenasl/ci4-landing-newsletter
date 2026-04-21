<!-- Hero Section -->
<section class="hero-section d-flex justify-content-center">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-4 col-md-12">
                <h1 class="hero-title text-4xl fw-medium"><?= lang('LandingPage.hero.title') ?></h1>
                <p class="hero-description font-secondary fw-light fade-in-up"><?= lang('LandingPage.hero.description') ?></p>
                <div class="form-newsletter-container p-4 fade-in-left delay-3">
                    <div class="flex-column justify-content-center">
                        <p class="newsletter-text-instructions text-center"><?= lang('LandingPage.hero.newsletter_instruction') ?></p>
                        <form id="newsletter-form" class="form-newsletter">
                            <div class="justify-content-center align-items-center">
                                <div class="input-group">
                                    <input
                                        type="email"
                                        id="email-input"
                                        class="form-control"
                                        placeholder="<?= lang('LandingPage.hero.email_placeholder') ?>"
                                        aria-label="Email"
                                        required>
                                    <!-- Campo oculto para el token -->
                                    <?= recaptcha_hidden_input() ?>
                                    <button class="btn-primary-form" type="submit" id="submit-btn">
                                        <span class="btn-text"><?= lang('LandingPage.hero.subscribe_btn') ?></span>
                                        <div class="loading-spinner"></div>
                                    </button>
                                </div>
                                <div id="feedback-message" class="feedback-message ps-4"></div>
                                <div class="invitation-badge" style="display: none; color: #28a745; font-size: 0.875rem; margin-top: 0.5rem;"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 pt-5 pt-lg-0 col-md-12 d-flex justify-content-center scale-in delay-5">
                <img src="/images/landing/<?= $siteConfig->imageHero ?>" alt="Hero Image" class="img-fluid hero-image">
            </div>
        </div>
        <div class="row d-flex justify-content-center pt-5">
            <div class="d-flex col-4 align-items-center d-flex flex-column justify-content-center scale-in delay-1">
                <img src="/images/landing/icon-opt1.svg" alt="Drone" class="img-fluid mb-4" />
                <p class="hero-option-title font-secondary text-lg text-center"><?= lang('LandingPage.hero.portfolio_title') ?></p>
            </div>
            <div class="d-flex col-4 align-items-center d-flex flex-column justify-content-center scale-in delay-2">
                <img src="/images/landing/icon-opt2.svg" alt="Camera" class="img-fluid mb-4" />
                <p class="hero-option-title font-secondary text-lg text-center"><?= lang('LandingPage.hero.visibility_title') ?></p>
            </div>
            <div class="d-flex col-4 align-items-center d-flex flex-column justify-content-center scale-in delay-3">
                <img src="/images/landing/icon-opt3.svg" alt="Film" class="img-fluid mb-4" />
                <p class="hero-option-title font-secondary text-lg text-center"><?= lang('LandingPage.hero.search_title') ?></p>
            </div>
        </div>
    </div>
</section>
