<?php

return [
    // META TAGS
    'meta' => [
        'title' => 'NewsLanding — The Subscription Landing Page Template for CodeIgniter 4',
        'description' => 'A ready-to-use CI4 landing page template with newsletter subscription, multi-language support (5 locales), reCAPTCHA, Google Analytics, and beautiful animations. Fork it, brand it, launch it.',
        'keywords' => 'newsletter landing page, codeigniter 4 template, subscription page, ci4 starter kit, multi-language landing, newsletter signup template, open source landing page',
        'og_title' => 'NewsLanding — Subscription Landing Page Template',
        'og_description' => 'A production-ready CodeIgniter 4 template for newsletter landing pages. Multi-language, reCAPTCHA, API-connected, fully responsive.',
        'twitter_title' => 'NewsLanding — Subscription Landing Page Template',
        'twitter_description' => 'Fork it, brand it, launch it. A CI4 newsletter landing page template with 5 languages, animations, and API integration.',
    ],

    // HEADER
    'header' => [
        'logo_alt' => 'NewsLanding Logo',
        'tagline' => 'Landing Template',
    ],

    // HERO SECTION
    'hero' => [
        'title' => '<strong>Your brand.</strong> Your audience. One template.',
        'description' => 'NewsLanding is a production-ready subscription landing page built on CodeIgniter 4. <strong>Fork it, add your content, and launch your waitlist or newsletter in minutes.</strong>',
        'newsletter_instruction' => 'Try the live demo — subscribe here',
        'email_placeholder' => 'your@email.com',
        'subscribe_btn' => 'Subscribe',
        'portfolio_title' => 'Multi-language',
        'visibility_title' => 'CI4 Backend',
        'search_title' => 'API-Ready',
    ],

    // OPTIONS SECTION
    'options' => [
        'portfolio' => [
            'title' => 'Built to be customized',
            'description' => 'Every section — hero, features, FAQ, footer — is driven by language files. <strong>Change the copy in one place and all 5 locales update instantly.</strong> No template logic to touch.',
        ],
        'search' => [
            'title' => 'Wired for production',
            'description' => 'Connects to your API for subscription handling, <strong>validates with reCAPTCHA v3, supports Google Analytics and GTM,</strong> and ships with SEO meta tags, Open Graph, and Twitter Cards out of the box.',
        ],
    ],

    // FAQ SECTION
    'faq' => [
        'title' => 'Everything you<br>need to <strong>launch<br>your landing</strong>',
        'description' => 'NewsLanding is self-documenting — this page itself demonstrates what the template looks like in action.',
        'questions' => [
            [
                'question' => 'What is NewsLanding?',
                'answer' => [
                    'intro' => 'NewsLanding is a CodeIgniter 4 starter template for subscription landing pages. It includes:',
                    'benefits' => [
                        'A responsive, animated landing page with hero, features, FAQ, and footer',
                        'Multi-language support with 5 locales: English, Spanish, French, Italian, and Portuguese',
                        'Newsletter subscription form connected to your own API endpoint',
                        'reCAPTCHA v3 integration, Google Analytics 4, and Google Tag Manager support',
                    ],
                    'outro' => 'Clone the repository, update the language files with your content, configure your env, and you are live.',
                ],
            ],
            [
                'question' => 'How do I customize it for my product?',
                'answer' => [
                    'intro' => 'Customization is straightforward and does not require touching the view logic:',
                    'benefits' => [
                        'Edit app/Language/{locale}/LandingPage.php to change all visible copy',
                        'Replace the images in public/images/landing/ and logos in public/images/logos/',
                        'Update the colors and site name in app/Config/SiteConfig.php',
                        'Point the API_BASE_URL in env to your own subscription backend',
                    ],
                    'outro' => 'The template is intentionally structured so content and presentation are fully separated.',
                ],
            ],
            [
                'question' => 'Which languages are included?',
                'answer' => [
                    'intro' => 'The template ships with five fully-translated locale files: English (en), Spanish (es), French (fr), Italian (it), and Portuguese (pt).',
                    'benefits' => [],
                    'outro' => 'The language switcher in the header is driven by the supported locales configuration in app/Config/App.php. Each locale is accessed at its own URL path: /en, /es, /fr, /it, /pt.',
                ],
            ],
            [
                'question' => 'What does the subscription form do?',
                'answer' => [
                    'intro' => 'The newsletter form collects an email address, validates it client-side and server-side, and submits it to your configured API endpoint. It handles duplicate emails, invalid addresses, and reCAPTCHA failures gracefully with localized feedback messages.',
                    'benefits' => [
                        'reCAPTCHA v3 token is generated invisibly on submit',
                        'Duplicate email detection returns a friendly message',
                        'Welcome email is sent via your API (SMTP configuration lives server-side)',
                        'All feedback messages are localized per the active language',
                    ],
                    'outro' => '',
                ],
            ],
        ],
    ],

    // FOOTER
    'footer' => [
        'newsletter_text' => 'Like this template? Subscribe to get updates when new versions drop.',
        'email_placeholder' => 'your@email.com',
        'subscribe_btn' => 'Subscribe',
        'copyright' => '© 2026 NewsLanding. A CodeIgniter 4 subscription landing page template.',
    ],
];
