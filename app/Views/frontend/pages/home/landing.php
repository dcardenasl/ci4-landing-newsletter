<!DOCTYPE html>
<html lang="<?= $locale ?>">
<!--
    This is a landing page template for Filma, a platform for finding crew members for audiovisual productions.
    The page includes sections for the header, hero, options, FAQ, and footer.
    It uses Bootstrap for styling and includes custom CSS for animations and layout.-->

<head>
    <!-- Google tag (gtag.js) -->
    <?php $ga4Id = getenv('GA4_ID'); ?>
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
    <meta name="author" content="Filma">
    <meta name="robots" content="index, follow">

    <!-- Open Graph Meta Tags -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= lang('LandingPage.meta.og_title') ?>">
    <meta property="og:description" content="<?= lang('LandingPage.meta.og_description') ?>">
    <meta property="og:image" content="/images/logos/fil-yellow.png">
    <meta property="og:url" content="<?= current_url() ?>">
    <meta property="og:site_name" content="Filma">
    <meta property="og:locale" content="<?= $locale ?>_<?= strtoupper($locale) ?>">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= lang('LandingPage.meta.twitter_title') ?>">
    <meta name="twitter:description" content="<?= lang('LandingPage.meta.twitter_description') ?>">
    <meta name="twitter:image" content="/images/logos/fill.png">

    <!-- Canonical URL -->
    <link rel="canonical" href="<?= base_url() ?>">

    <!-- APP Configuration injected by server -->
    <script>
        window.APP_CONFIG = <?= json_encode($appConfig) ?>;
    </script>

    <!-- Additional SEO Tags -->
    <meta name="theme-color" content="#007bff">
    <meta name="msapplication-TileColor" content="#007bff">

    <!-- Content-Security-Policy to prevent inline scripts -->
    <!-- <meta http-equiv="Content-Security-Policy" content="script-src 'self';"> -->

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="Filma crew finder" />
    <link rel="manifest" href="/site.webmanifest" />

    <!-- STYLES -->
    <link href="/css/landing/bootstrap.min.css" rel="stylesheet" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- Base Styles -->
    <link rel="stylesheet" href="<?= base_url('css/landing/base_v2.css') ?>">

    <!-- Animations Core Styles -->
    <link rel="stylesheet" href="<?= base_url('css/landing/animations-core.css') ?>">

    <!-- Header Section Styles -->
    <link rel="stylesheet" href="<?= base_url('css/landing/header.css') ?>">

    <!-- Hero Section Styles (conditional loading) -->
    <link rel="stylesheet" href="<?= base_url('css/landing/hero.css') ?>">

    <!-- Form Components -->
    <link rel="stylesheet" href="<?= base_url('css/landing/form-newsletter.css') ?>">

    <!-- Options Section Styles  -->
    <link rel="stylesheet" href="<?= base_url('css/landing/options.css') ?>">

    <!-- Mockups Laptop and Phone Styles  -->
    <link rel="stylesheet" href="<?= base_url('css/landing/mockups.css') ?>">

    <!-- FAQ Section Styles -->
    <link rel="stylesheet" href="<?= base_url('css/landing/faq.css') ?>">

    <!-- Footer Section Styles -->
    <link rel="stylesheet" href="<?= base_url('css/landing/footer.css') ?>">
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <?php $gtmId = getenv('GTM_ID'); ?>
    <?php if ($gtmId): ?>
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=<?= $gtmId ?>"
            height="0" width="0" style="display:none;visibility:hidden">
        </iframe>
    </noscript>
    <?php endif; ?>
    <!-- End Google Tag Manager (noscript) -->

    <main class="Landing">
        <!-- Header Section -->
        <header class="header">
            <div class="container">
                <!-- Language Selector -->
                <div class="row">
                    <div class="col">
                        <div class="language-selector">
                            <div class="language-dropdown" id="languageDropdown">
                                <button class="language-btn" id="languageBtn">
                                    <span class="language-flag" id="currentFlag"><img src="/images/flags/<?= strtolower($supportedLocales['current_language']['country_code']) ?>.svg" class="img-fluid" style="min-width: 15px;" alt="<?= $supportedLocales['current_language']['name'] ?> flag"></span>
                                    <span class="language-code" id="currentLang"><?= strtoupper($supportedLocales['current_language']['country_code']) ?></span>
                                    <span class="language-arrow">▼</span>
                                </button>
                                <div class="language-menu" id="languageMenu">
                                    <?php foreach ($supportedLocales['languages'] as $languages): ?>
                                        <button class="language-option <?= $languages['locale'] === $locale ? 'active' : '' ?>"
                                            data-locale="<?= $languages['locale'] ?>"
                                            data-flag="<?= $languages['flag'] ?>"
                                            data-name="<?= $languages['name'] ?>"
                                            data-url="/<?= $languages['locale'] ?>">
                                            <span class="flag"><img src="/images/flags/<?= strtolower($languages['country_code']) ?>.svg" class="img-fluid" style="min-width: 15px;" alt="<?= $languages['native_name'] ?> flag"></span>
                                            <span><?= $languages['native_name']  ?></span>
                                        </button>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row logo_container">
                    <div class="col pe-0">
                        <img src="/images/logos/filma-black.svg" alt="<?= lang('LandingPage.header.logo_alt') ?>" class="img-fluid image-logo " />
                    </div>
                    <div class="col">
                        <p class="line-separator "><span>|</span> </p>
                    </div>
                    <div class="col">
                        <p class="text-logo"><?= lang('LandingPage.header.tagline') ?></p>
                    </div>
                </div>
            </div>
        </header>

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
                        <img src="/images/landing/hero-landing.webp" alt="Hero Image" class="img-fluid hero-image">
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

        <!-- Options Section -->
        <section class="options-section bg-alt d-flex justify-content-center">
            <div class="container py-5">
                <!-- Option 1:  Offer -->
                <div class="row align-items-center">
                    <div class="col-md-12 col-lg-6 d-flex justify-content-center fade-in-left">
                        <!-- <div class="col-md-12 col-lg-6 d-flex justify-content-center d-none d-lg-block fade-in-left"> -->
                        <img src="/images/landing/op1-landing.webp" alt="Option 1" class="img-fluid option-image">
                        <!-- <div class="laptop-mockup">
                            <div class="laptop">
                                <div class="laptop-screen">
                                    <div class="browser-laptop">
                                        <div class="browser-header-laptop">
                                            <div class="browser-buttons-laptop">
                                                <div class="browser-button-laptop"></div>
                                                <div class="browser-button-laptop"></div>
                                                <div class="browser-button-laptop"></div>
                                            </div>
                                            <div class="address-bar-laptop"></div>
                                        </div>
                                        <div class="website-content-laptop">
                                            <div class="scrolling-content-laptop">
                                                El contenido ahora es manejado por la imagen de fondo
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <div class="col-md-12 col-lg-6 align-items-center d-flex flex-column justify-content-center fade-in-right delay-3">
                        <!-- <img src="/images/icons/megaphone.png" alt="Option Icon" class="img-fluid option-icon"> -->
                        <h3 class="option-title text-2xl text-center"><?= lang('LandingPage.options.portfolio.title') ?></h3>
                        <p class="option-description font-secondary fw-light text-center"><?= lang('LandingPage.options.portfolio.description') ?></p>
                    </div>
                </div>
                <!-- Option 2:  Search -->
                <div class="row align-items-center mt-5 mt-lg-0">
                    <div class="col-md-12 col-lg-6 align-items-center d-flex flex-column justify-content-center fade-in-left delay-1">
                        <!-- <img src="/images/icons/search.png" alt="Option Icon" class="img-fluid option-icon"> -->
                        <h3 class="option-title text-2xl text-center"><?= lang('LandingPage.options.search.title') ?></h3>
                        <p class="option-description font-secondary fw-light text-center"><?= lang('LandingPage.options.search.description') ?></p>
                    </div>
                    <div class="order-first col-md-12 order-md-last col-lg-6 d-flex justify-content-center fade-in-right delay-4">
                        <!-- <div class="order-first col-md-12 order-md-last col-lg-6 d-flex justify-content-center  d-none d-lg-block fade-in-right delay-4"> -->
                        <img src="/images/landing/op2-landing.webp" alt="Option 2" class="img-fluid option-image" style="max-height: 500px; width:auto;" />
                        <!-- <div class="laptop-mockup">
                            <div class="laptop">
                                <div class="laptop-screen">
                                    <div class="browser-laptop">
                                        <div class="browser-header-laptop">
                                            <div class="browser-buttons-laptop">
                                                <div class="browser-button-laptop"></div>
                                                <div class="browser-button-laptop"></div>
                                                <div class="browser-button-laptop"></div>
                                            </div>
                                            <div class="address-bar-laptop"></div>
                                        </div>
                                        <div class="website-content-laptop">
                                            <div class="scrolling-content-laptop-alt">
                                                El contenido ahora es manejado por la imagen de fondo
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="faq-section d-flex justify-content-center py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-12 col-lg-6 d-flex justify-content-center align-self-start mb-5 scale-in delay-2">
                        <img src="/images/landing/faq-landing.webp" alt="Filmaker" class="img-fluid option-image" style="max-width: 400px; height:auto;" />
                    </div>
                    <div class="col-md-12 col-lg-6 d-flex flex-column justify-content-center">
                        <h2 class="faq-title text-4xl fw-medium fade-in-up delay-1"><?= lang('LandingPage.faq.title') ?></h2>
                        <p class="faq-description font-secondary fw-light fade-in-up delay-3"><?= lang('LandingPage.faq.description') ?></p>
                        <div class="accordion" id="faqAccordion">
                            <div class="accordion-item fade-in-up delay-2">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="false" aria-controls="faq1">
                                        <?= lang('LandingPage.faq.questions.0.question') ?>
                                    </button>
                                </h2>
                                <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        <p class="mb-3"> <?= lang('LandingPage.faq.questions.0.answer.0') ?></p>
                                        <ul class="service-list mb-0">
                                            <li><?= lang('LandingPage.faq.questions.0.answer.benefits.0') ?></li>
                                            <li><?= lang('LandingPage.faq.questions.0.answer.benefits.1') ?></li>
                                            <li><?= lang('LandingPage.faq.questions.0.answer.benefits.2') ?></li>
                                            <li><?= lang('LandingPage.faq.questions.0.answer.benefits.3') ?></li>
                                        </ul>
                                        <p class="mt-3 mb-0"> <?= lang('LandingPage.faq.questions.0.answer.1') ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item fade-in-up delay-2">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false" aria-controls="faq2">
                                        <?= lang('LandingPage.faq.questions.1.question') ?>
                                    </button>
                                </h2>
                                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        <p class="mb-3"><?= lang('LandingPage.faq.questions.1.answer.0') ?></p>
                                        <ul class="service-list mb-0">
                                            <li><?= lang('LandingPage.faq.questions.1.answer.benefits.0') ?></li>
                                            <li><?= lang('LandingPage.faq.questions.1.answer.benefits.1') ?></li>
                                            <li><?= lang('LandingPage.faq.questions.1.answer.benefits.2') ?></li>
                                            <li><?= lang('LandingPage.faq.questions.1.answer.benefits.3') ?></li>
                                        </ul>
                                        <p class="mt-3 mb-0"><?= lang('LandingPage.faq.questions.1.answer.1') ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item fade-in-up delay-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false" aria-controls="faq3">
                                        <?= lang('LandingPage.faq.questions.2.question') ?>
                                    </button>
                                </h2>
                                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        <p class="mb-3"><?= lang('LandingPage.faq.questions.2.answer.0') ?></p>
                                        <p class="mb-0"><?= lang('LandingPage.faq.questions.2.answer.1') ?></p>
                                        <p class="mb-0"><?= lang('LandingPage.faq.questions.2.answer.2') ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item fade-in-up delay-4">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="false" aria-controls="faq4">
                                        <?= lang('LandingPage.faq.questions.3.question') ?>
                                    </button>
                                </h2>
                                <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        <p class="mb-3"><?= lang('LandingPage.faq.questions.3.answer.0') ?></p>
                                        <p class="mb-0"><?= lang('LandingPage.faq.questions.3.answer.1') ?></p>
                                        <ul class="service-list mb-0">
                                            <li><?= lang('LandingPage.faq.questions.3.answer.benefits.0') ?></li>
                                            <li><?= lang('LandingPage.faq.questions.3.answer.benefits.1') ?></li>
                                            <li><?= lang('LandingPage.faq.questions.3.answer.benefits.2') ?></li>
                                            <li><?= lang('LandingPage.faq.questions.3.answer.benefits.3') ?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
        </section>

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
        </section>

        <!-- Footer Section -->
        <footer class="footer-section bg-accent justify-content-center">
            <div class="container ">
                <div class="row py-5 justify-content-center align-items-center">
                    <img src="/images/logos/filma-white.svg" alt="Filma Logo" class="img-fluid my-5" style="max-width: 400px; height:auto;" />
                    <p class="footer-description text-white text-center mb-5"><?= lang('LandingPage.footer.copyright') ?></p>
                </div>
            </div>
        </footer>

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
