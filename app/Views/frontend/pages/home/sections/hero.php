<!-- Hero Section -->
<section class="hero-section d-flex justify-content-center" data-analytics-section="hero">
    <div class="container">
        <div class="row align-items-center g-4 g-lg-5">
            <div class="col-lg-5 col-md-12">
                <h1 class="hero-title text-4xl fw-medium"><?= lang('LandingPage.hero.title') ?></h1>
                <p class="hero-description font-secondary fw-light fade-in-up"><?= lang('LandingPage.hero.description') ?></p>
                <div class="form-newsletter-container p-4 fade-in-left delay-3">
                    <p class="newsletter-text-instructions text-center"><?= lang('LandingPage.hero.newsletter_instruction') ?></p>
                    <form class="form-newsletter" data-newsletter-form data-analytics-form="hero-newsletter">
                        <div class="input-group">
                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                placeholder="<?= lang('LandingPage.hero.email_placeholder') ?>"
                                aria-label="Email"
                                required>
                            <?= recaptcha_hidden_input() ?>
                            <button class="btn-primary-form" type="submit">
                                <span class="btn-text"><?= lang('LandingPage.hero.subscribe_btn') ?></span>
                                <div class="loading-spinner"></div>
                            </button>
                        </div>
                        <div class="feedback-message"></div>
                        <div class="invitation-badge"></div>
                    </form>
                </div>
            </div>
            <div class="col-lg-7 pt-4 pt-lg-0 col-md-12 d-flex justify-content-center scale-in delay-5">
                <img src="/images/landing/<?= $siteConfig->imageHero ?>" alt="Hero Image" class="img-fluid hero-image">
            </div>
        </div>

        <div class="row g-4 pt-5 justify-content-center">
            <?php
            $features = [
                ['icon' => 'icon-opt1.svg', 'title' => 'LandingPage.hero.portfolio_title',  'delay' => 'delay-1'],
                ['icon' => 'icon-opt2.svg', 'title' => 'LandingPage.hero.visibility_title', 'delay' => 'delay-2'],
                ['icon' => 'icon-opt3.svg', 'title' => 'LandingPage.hero.search_title',     'delay' => 'delay-3'],
            ];
            foreach ($features as $feature):
                $iconPath = FCPATH . 'images/landing/' . $feature['icon'];
            ?>
            <div class="col-6 col-md-4 hero-feature d-flex flex-column align-items-center scale-in <?= $feature['delay'] ?>">
                <span class="hero-feature-icon" aria-hidden="true">
                    <?= is_file($iconPath) ? file_get_contents($iconPath) : '' ?>
                </span>
                <p class="hero-option-title font-secondary text-lg text-center"><?= lang($feature['title']) ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
