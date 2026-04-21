<!DOCTYPE html>
<html lang="<?= $locale ?>">
<head>
    <!-- Google tag (gtag.js) -->
    <?php $ga4Id = env('GA4_ID'); ?>
    <?php if ($ga4Id): ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?= $ga4Id ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', '<?= $ga4Id ?>');
    </script>
    <?php endif; ?>

    <!-- Meta Tags for SEO -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= lang('LandingPage.meta.title') ?></title>
    <meta name="description" content="<?= lang('LandingPage.meta.description') ?>">
    <meta name="keywords" content="<?= lang('LandingPage.meta.keywords') ?>">
    <meta name="author" content="<?= $siteConfig->siteName ?>">
    <meta name="robots" content="index, follow">

    <!-- Open Graph Meta Tags -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= lang('LandingPage.meta.og_title') ?>">
    <meta property="og:description" content="<?= lang('LandingPage.meta.og_description') ?>">
    <meta property="og:image" content="/images/logos/logo-sm-accent.png">
    <meta property="og:url" content="<?= current_url() ?>">
    <meta property="og:site_name" content="<?= $siteConfig->siteName ?>">
    <meta property="og:locale" content="<?= $locale ?>_<?= strtoupper($locale) ?>">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= lang('LandingPage.meta.twitter_title') ?>">
    <meta name="twitter:description" content="<?= lang('LandingPage.meta.twitter_description') ?>">
    <meta name="twitter:image" content="/images/logos/logo-sm-accent.png">

    <!-- Canonical URL -->
    <link rel="canonical" href="<?= base_url() ?>">

    <!-- APP Configuration injected by server -->
    <script>
        window.APP_CONFIG = <?= json_encode($appConfig) ?>;
    </script>

    <!-- Additional SEO Tags -->
    <meta name="theme-color" content="<?= $siteConfig->colorPrimary ?>">
    <meta name="msapplication-TileColor" content="<?= $siteConfig->colorPrimary ?>">

    <!-- Content-Security-Policy to prevent inline scripts -->
    <!-- <meta http-equiv="Content-Security-Policy" content="script-src 'self';"> -->

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="<?= $siteConfig->siteName ?>" />
    <link rel="manifest" href="/site.webmanifest" />

    <!-- STYLES -->
    <link href="/css/landing/bootstrap.min.css" rel="stylesheet" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

    <!-- CSS Custom Properties (Theme Colors) -->
    <style>
        :root {
            --color-primary:        <?= esc($siteConfig->colorPrimary) ?>;
            --color-secondary:      <?= esc($siteConfig->colorSecondary) ?>;
            --color-accent:         <?= esc($siteConfig->colorAccent) ?>;
            --color-text-highlight: <?= esc($siteConfig->colorTextHighlight) ?>;
            --color-bg-alt:         <?= esc($siteConfig->colorBgAlt) ?>;
            --color-bg-accent:      <?= esc($siteConfig->colorBgAccent) ?>;
        }
    </style>

    <!-- Base Styles -->
    <link rel="stylesheet" href="<?= base_url('css/landing/base.css') ?>">

    <!-- Animations Core Styles -->
    <link rel="stylesheet" href="<?= base_url('css/landing/animations-core.css') ?>">

    <!-- Header Section Styles -->
    <link rel="stylesheet" href="<?= base_url('css/landing/header.css') ?>">

    <!-- Hero Section Styles -->
    <link rel="stylesheet" href="<?= base_url('css/landing/hero.css') ?>">

    <!-- Form Components -->
    <link rel="stylesheet" href="<?= base_url('css/landing/form-newsletter.css') ?>">

    <!-- Options Section Styles -->
    <link rel="stylesheet" href="<?= base_url('css/landing/options.css') ?>">

    <!-- FAQ Section Styles -->
    <link rel="stylesheet" href="<?= base_url('css/landing/faq.css') ?>">

    <!-- Footer Section Styles -->
    <link rel="stylesheet" href="<?= base_url('css/landing/footer.css') ?>">
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <?php $gtmId = env('GTM_ID'); ?>
    <?php if ($gtmId): ?>
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=<?= $gtmId ?>"
            height="0" width="0" style="display:none;visibility:hidden">
        </iframe>
    </noscript>
    <?php endif; ?>
    <!-- End Google Tag Manager (noscript) -->

    <main class="Landing">
        <?= $this->renderSection('content') ?>
    </main>

    <!-- JavaScript -->

    <!-- Cargar reCAPTCHA script -->
    <?= recaptcha_script() ?>

    <!-- Establecer site key globalmente para JavaScript -->
    <?= recaptcha_site_key_js() ?>

    <script src="/js/landing/bootstrap.bundle.min.js"></script>
    <script src="/js/landing/newsletter.js?key=<?= time(); ?>"></script>
    <script src="/js/landing/animations.js"></script>
    <script src="/js/landing/language-selector.js"></script>

</body>

</html>
