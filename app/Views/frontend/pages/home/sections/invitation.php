<!-- Invitation Section -->
<section class="invitation-section bg-alt d-flex justify-content-center py-5">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-12 scale-in delay-1">
                <p class="invitation-brand"><?= esc($siteConfig->siteName) ?></p>
            </div>
            <div class="col-md-12 col-lg-8 col-xl-6">
                <p class="newsletter-text-instructions text-center scale-in delay-2">
                    <?= lang('LandingPage.footer.newsletter_text') ?>
                </p>
                <form id="newsletter-form" class="form-newsletter scale-in delay-3">
                    <div class="input-group">
                        <input
                            type="email"
                            id="email-input"
                            class="form-control"
                            placeholder="<?= lang('LandingPage.footer.email_placeholder') ?>"
                            aria-label="Email"
                            required>
                        <?= recaptcha_hidden_input() ?>
                        <button class="btn-secundary-form" type="submit" id="submit-btn">
                            <span class="btn-text"><?= lang('LandingPage.footer.subscribe_btn') ?></span>
                            <div class="loading-spinner"></div>
                        </button>
                    </div>
                    <div id="feedback-message" class="feedback-message"></div>
                    <div class="invitation-badge"></div>
                </form>
            </div>
        </div>
    </div>
</section>
