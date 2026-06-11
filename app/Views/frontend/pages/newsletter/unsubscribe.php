<?= $this->extend('frontend/layouts/landing') ?>

<?= $this->section('content') ?>

<?= $this->include('frontend/pages/home/sections/header') ?>

<section class="newsletter-status d-flex align-items-center justify-content-center" style="min-height: 60vh; background: var(--color-bg-alt);">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card border-0 shadow-sm text-center p-4 p-md-5">
                    <?php if ($result === true): ?>
                        <div class="display-4 mb-3">👋</div>
                        <h1 class="h3 mb-3"><?= lang('LandingPage.newsletter.unsubscribe_success_title') ?></h1>
                        <p class="text-muted mb-4"><?= lang('LandingPage.newsletter.unsubscribe_success_message') ?></p>
                        <a href="<?= base_url("/{$locale}") ?>" class="btn btn-primary"><?= lang('LandingPage.newsletter.back_home') ?></a>
                    <?php elseif ($result === false): ?>
                        <div class="display-4 mb-3">⚠️</div>
                        <h1 class="h3 mb-3"><?= lang('LandingPage.newsletter.unsubscribe_error_title') ?></h1>
                        <p class="text-muted mb-4"><?= lang('LandingPage.newsletter.unsubscribe_error_message') ?></p>
                        <a href="<?= base_url("/{$locale}") ?>" class="btn btn-primary"><?= lang('LandingPage.newsletter.back_home') ?></a>
                    <?php elseif ($token === ''): ?>
                        <div class="display-4 mb-3">⚠️</div>
                        <h1 class="h3 mb-3"><?= lang('LandingPage.newsletter.unsubscribe_error_title') ?></h1>
                        <p class="text-muted mb-4"><?= lang('LandingPage.newsletter.missing_token') ?></p>
                        <a href="<?= base_url("/{$locale}") ?>" class="btn btn-primary"><?= lang('LandingPage.newsletter.back_home') ?></a>
                    <?php else: ?>
                        <div class="display-4 mb-3">📭</div>
                        <h1 class="h3 mb-3"><?= lang('LandingPage.newsletter.unsubscribe_title') ?></h1>
                        <p class="text-muted mb-4"><?= lang('LandingPage.newsletter.unsubscribe_prompt') ?></p>
                        <form method="post" action="<?= base_url("/{$locale}/unsubscribe") ?>">
                            <?= csrf_field() ?>
                            <input type="hidden" name="token" value="<?= esc($token, 'attr') ?>">
                            <button type="submit" class="btn btn-danger"><?= lang('LandingPage.newsletter.unsubscribe_button') ?></button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->include('frontend/pages/home/sections/footer') ?>

<?= $this->endSection() ?>
