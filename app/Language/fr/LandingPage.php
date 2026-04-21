<?php

return [
    // META TAGS
    'meta' => [
        'title' => 'NewsLanding — Le template de landing page d\'abonnement pour CodeIgniter 4',
        'description' => 'Un template CI4 prêt à l\'emploi : landing page d\'abonnement avec support multilingue (5 locales), reCAPTCHA, Google Analytics et animations. Clonez-le, personnalisez-le, lancez-le.',
        'keywords' => 'landing page abonnement, template codeigniter 4, page d\'inscription newsletter, ci4 starter kit, landing multilingue, template newsletter, landing page open source',
        'og_title' => 'NewsLanding — Template de Landing Page d\'Abonnement',
        'og_description' => 'Template prêt pour la production en CodeIgniter 4 pour les landing pages newsletter. Multilingue, reCAPTCHA, connecté à une API, entièrement responsive.',
        'twitter_title' => 'NewsLanding — Template de Landing Page d\'Abonnement',
        'twitter_description' => 'Clonez-le, personnalisez-le, lancez-le. Template CI4 pour landing pages avec 5 langues, animations et intégration API.',
    ],

    // HEADER
    'header' => [
        'logo_alt' => 'Logo NewsLanding',
        'tagline' => 'Template Landing',
    ],

    // HERO SECTION
    'hero' => [
        'title' => '<strong>Votre marque.</strong> Votre audience. Un seul template.',
        'description' => 'NewsLanding est une landing page d\'abonnement prête pour la production, construite sur CodeIgniter 4. <strong>Clonez-la, ajoutez votre contenu et lancez votre liste d\'attente ou newsletter en quelques minutes.</strong>',
        'newsletter_instruction' => 'Testez la démo en direct — abonnez-vous ici',
        'email_placeholder' => 'votre@email.com',
        'subscribe_btn' => 'S\'abonner',
        'portfolio_title' => 'Multilingue',
        'visibility_title' => 'Backend CI4',
        'search_title' => 'Prêt pour l\'API',
    ],

    // OPTIONS SECTION
    'options' => [
        'portfolio' => [
            'title' => 'Conçu pour être personnalisé',
            'description' => 'Chaque section — hero, fonctionnalités, FAQ, pied de page — est pilotée par des fichiers de langue. <strong>Modifiez le contenu à un seul endroit et les 5 locales se mettent à jour instantanément.</strong> Sans toucher à la logique des vues.',
        ],
        'search' => [
            'title' => 'Prêt pour la production',
            'description' => 'Se connecte à votre API pour la gestion des abonnements, <strong>valide avec reCAPTCHA v3, prend en charge Google Analytics et GTM,</strong> et inclut les balises SEO, Open Graph et Twitter Cards dès le départ.',
        ],
    ],

    // FAQ SECTION
    'faq' => [
        'title' => 'Tout ce qu\'il<br>vous faut pour <strong>lancer<br>votre landing</strong>',
        'description' => 'NewsLanding est auto-documenté — cette page elle-même est une démonstration en direct de ce à quoi ressemble le template.',
        'questions' => [
            [
                'question' => 'Qu\'est-ce que NewsLanding ?',
                'answer' => [
                    'intro' => 'NewsLanding est un template starter CodeIgniter 4 pour les landing pages d\'abonnement. Il comprend :',
                    'benefits' => [
                        'Landing page responsive et animée avec hero, fonctionnalités, FAQ et pied de page',
                        'Support multilingue avec 5 locales : anglais, espagnol, français, italien et portugais',
                        'Formulaire d\'abonnement connecté à votre propre endpoint d\'API',
                        'Intégration reCAPTCHA v3, Google Analytics 4 et Google Tag Manager',
                    ],
                    'outro' => 'Clonez le dépôt, mettez à jour les fichiers de langue avec votre contenu, configurez votre env et vous êtes en ligne.',
                ],
            ],
            [
                'question' => 'Comment le personnaliser pour mon produit ?',
                'answer' => [
                    'intro' => 'La personnalisation est simple et ne nécessite pas de toucher à la logique des vues :',
                    'benefits' => [
                        'Éditez app/Language/{locale}/LandingPage.php pour modifier tout le contenu visible',
                        'Remplacez les images dans public/images/landing/ et les logos dans public/images/logos/',
                        'Mettez à jour les couleurs et le nom du site dans app/Config/SiteConfig.php',
                        'Pointez l\'API_BASE_URL dans env vers votre propre backend d\'abonnement',
                    ],
                    'outro' => 'Le template est intentionnellement structuré pour que le contenu et la présentation soient entièrement séparés.',
                ],
            ],
            [
                'question' => 'Quelles langues sont incluses ?',
                'answer' => [
                    'intro' => 'Le template est livré avec cinq fichiers de locale entièrement traduits : anglais (en), espagnol (es), français (fr), italien (it) et portugais (pt).',
                    'benefits' => [],
                    'outro' => 'Le sélecteur de langue dans l\'en-tête est piloté par la configuration des locales supportées dans app/Config/App.php. Chaque locale est accessible à son propre chemin URL : /en, /es, /fr, /it, /pt.',
                ],
            ],
            [
                'question' => 'Que fait le formulaire d\'abonnement ?',
                'answer' => [
                    'intro' => 'Le formulaire newsletter collecte une adresse email, la valide côté client et serveur, puis la soumet à votre endpoint d\'API configuré. Il gère les emails en double, les adresses invalides et les échecs reCAPTCHA avec des messages de retour localisés.',
                    'benefits' => [
                        'Le token reCAPTCHA v3 est généré de manière invisible à la soumission',
                        'La détection d\'email en double retourne un message convivial',
                        'L\'email de bienvenue est envoyé via votre API (la configuration SMTP est côté serveur)',
                        'Tous les messages de retour sont localisés selon la langue active',
                    ],
                    'outro' => '',
                ],
            ],
        ],
    ],

    // FOOTER
    'footer' => [
        'newsletter_text' => 'Vous aimez ce template ? Abonnez-vous pour être informé des nouvelles versions.',
        'email_placeholder' => 'votre@email.com',
        'subscribe_btn' => 'S\'abonner',
        'copyright' => '© 2026 NewsLanding. Un template de landing page d\'abonnement pour CodeIgniter 4.',
    ],
];
