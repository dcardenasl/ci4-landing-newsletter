<!-- Invitation Section -->
<section class="invitation-section d-flex justify-content-center py-5 bg-alt">
    <div class="container">
        <div class="row justify-content-center align-items-center text-center mb-5 ">
            <div class="col-12 scale-in delay-1">
                <img src="/images/logos/fil-black.svg" alt="Fil Logo" class="img-fluid my-5" style="max-width: 400px; height:auto;" />
            </div>
            <div class="col-md-12 col-lg-6">
                <p class="newsletter-text-instructions text-center scale-in delay-2">
                    <?= lang('LandingPage.footer.newsletter_text') ?>
                </p>
                <form id="newsletter-form" class="form-newsletter">
                    <div class="justify-content-center align-items-center scale-in delay-3">
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
                        <div id="feedback-message" class="feedback-message ps-4"></div>
                        <div class="invitation-badge" style="display: none; color: #28a745; font-size: 0.875rem; margin-top: 0.5rem;"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
