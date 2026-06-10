<?= $this->extend('frontend/layouts/landing') ?>

<?= $this->section('content') ?>

<?= $this->include('frontend/pages/home/sections/header') ?>

<section class="newsletter-status d-flex align-items-center justify-content-center" style="min-height: 60vh; background: var(--color-bg-alt);">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card border-0 shadow-sm text-center p-4 p-md-5">
                    <?php if ($confirmed): ?>
                        <div class="display-4 mb-3">✅</div>
                        <h1 class="h3 mb-3"><?= lang('LandingPage.newsletter.confirm_success_title') ?></h1>
                        <p class="text-muted mb-4"><?= lang('LandingPage.newsletter.confirm_success_message') ?></p>
                    <?php else: ?>
                        <div class="display-4 mb-3">⚠️</div>
                        <h1 class="h3 mb-3"><?= lang('LandingPage.newsletter.confirm_error_title') ?></h1>
                        <p class="text-muted mb-4"><?= lang('LandingPage.newsletter.confirm_error_message') ?></p>
                    <?php endif; ?>
                    <a href="<?= base_url("/{$locale}") ?>" class="btn btn-primary"><?= lang('LandingPage.newsletter.back_home') ?></a>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->include('frontend/pages/home/sections/footer') ?>

<?= $this->endSection() ?>
