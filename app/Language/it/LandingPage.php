<?php

return [
    // META TAGS
    'meta' => [
        'title' => 'NewsLanding — Il template di landing page per iscrizioni su CodeIgniter 4',
        'description' => 'Un template CI4 pronto all\'uso: landing page per iscrizioni con supporto multilingue (5 locale), reCAPTCHA, Google Analytics e animazioni. Clonalo, personalizzalo, lancialo.',
        'keywords' => 'landing page iscrizioni, template codeigniter 4, pagina newsletter, ci4 starter kit, landing multilingue, template newsletter, landing page open source',
        'og_title' => 'NewsLanding — Template di Landing Page per Iscrizioni',
        'og_description' => 'Template pronto per la produzione in CodeIgniter 4 per landing page newsletter. Multilingue, reCAPTCHA, connesso ad API, completamente responsive.',
        'twitter_title' => 'NewsLanding — Template di Landing Page per Iscrizioni',
        'twitter_description' => 'Clonalo, personalizzalo, lancialo. Template CI4 per landing page con 5 lingue, animazioni e integrazione API.',
    ],

    // HEADER
    'header' => [
        'logo_alt' => 'Logo NewsLanding',
        'tagline' => 'Template Landing',
    ],

    // HERO SECTION
    'hero' => [
        'title' => '<strong>Il tuo brand.</strong> Il tuo pubblico. Un solo template.',
        'description' => 'NewsLanding è una landing page per iscrizioni pronta per la produzione, costruita su CodeIgniter 4. <strong>Clonala, aggiungi i tuoi contenuti e lancia la tua lista d\'attesa o newsletter in pochi minuti.</strong>',
        'newsletter_instruction' => 'Prova la demo live — iscriviti qui',
        'email_placeholder' => 'tua@email.com',
        'subscribe_btn' => 'Iscriviti',
        'portfolio_title' => 'Multilingue',
        'visibility_title' => 'Backend CI4',
        'search_title' => 'Pronto per API',
    ],

    // OPTIONS SECTION
    'options' => [
        'portfolio' => [
            'title' => 'Progettato per essere personalizzato',
            'description' => 'Ogni sezione — hero, funzionalità, FAQ, footer — è gestita da file di lingua. <strong>Modifica il testo in un posto solo e tutti e 5 i locale si aggiornano istantaneamente.</strong> Senza toccare la logica delle viste.',
        ],
        'search' => [
            'title' => 'Pronto per la produzione',
            'description' => 'Si connette alla tua API per la gestione delle iscrizioni, <strong>valida con reCAPTCHA v3, supporta Google Analytics e GTM,</strong> e include meta tag SEO, Open Graph e Twitter Cards fin da subito.',
        ],
    ],

    // FAQ SECTION
    'faq' => [
        'title' => 'Tutto quello<br>che ti serve per <strong>lanciare<br>la tua landing</strong>',
        'description' => 'NewsLanding è auto-documentato — questa pagina stessa è una dimostrazione live di come appare il template.',
        'questions' => [
            [
                'question' => 'Che cos\'è NewsLanding?',
                'answer' => [
                    'intro' => 'NewsLanding è un template starter di CodeIgniter 4 per landing page di iscrizione. Include:',
                    'benefits' => [
                        'Landing page responsive e animata con hero, funzionalità, FAQ e footer',
                        'Supporto multilingue con 5 locale: inglese, spagnolo, francese, italiano e portoghese',
                        'Form di iscrizione connesso al tuo endpoint API',
                        'Integrazione reCAPTCHA v3, Google Analytics 4 e Google Tag Manager',
                    ],
                    'outro' => 'Clona il repository, aggiorna i file di lingua con i tuoi contenuti, configura il tuo env e sei online.',
                ],
            ],
            [
                'question' => 'Come lo personalizzo per il mio prodotto?',
                'answer' => [
                    'intro' => 'La personalizzazione è semplice e non richiede di toccare la logica delle viste:',
                    'benefits' => [
                        'Modifica app/Language/{locale}/LandingPage.php per cambiare tutti i testi visibili',
                        'Sostituisci le immagini in public/images/landing/ e i logo in public/images/logos/',
                        'Aggiorna i colori e il nome del sito in app/Config/SiteConfig.php',
                        'Punta l\'API_BASE_URL in env al tuo backend di iscrizioni',
                    ],
                    'outro' => 'Il template è strutturato intenzionalmente in modo che contenuto e presentazione siano completamente separati.',
                ],
            ],
            [
                'question' => 'Quali lingue sono incluse?',
                'answer' => [
                    'intro' => 'Il template include cinque file di locale completamente tradotti: inglese (en), spagnolo (es), francese (fr), italiano (it) e portoghese (pt).',
                    'benefits' => [],
                    'outro' => 'Il selettore di lingua nell\'intestazione è gestito dalla configurazione dei locale supportati in app/Config/App.php. Ogni locale è accessibile al proprio percorso URL: /en, /es, /fr, /it, /pt.',
                ],
            ],
            [
                'question' => 'Cosa fa il form di iscrizione?',
                'answer' => [
                    'intro' => 'Il form newsletter raccoglie un indirizzo email, lo valida lato client e server, e lo invia al tuo endpoint API configurato. Gestisce email duplicate, indirizzi non validi e fallimenti di reCAPTCHA con messaggi di feedback localizzati.',
                    'benefits' => [
                        'Il token reCAPTCHA v3 viene generato invisibilmente all\'invio',
                        'Il rilevamento di email duplicata restituisce un messaggio amichevole',
                        'L\'email di benvenuto viene inviata tramite la tua API (la configurazione SMTP è lato server)',
                        'Tutti i messaggi di feedback sono localizzati in base alla lingua attiva',
                    ],
                    'outro' => '',
                ],
            ],
        ],
    ],

    // FOOTER
    'footer' => [
        'newsletter_text' => 'Ti piace questo template? Iscriviti per ricevere aggiornamenti quando escono nuove versioni.',
        'email_placeholder' => 'tua@email.com',
        'subscribe_btn' => 'Iscriviti',
        'copyright' => '© 2026 NewsLanding. Un template di landing page per iscrizioni su CodeIgniter 4.',
    ],
];
