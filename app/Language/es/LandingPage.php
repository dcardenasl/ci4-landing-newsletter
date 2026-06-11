<?php
return [
    // META TAGS
    'meta' => [
        'title' => 'NewsLanding — Plantilla de landing page de suscripción para CodeIgniter 4',
        'description' => 'Plantilla CI4 lista para usar: landing page de suscripción con soporte multiidioma (5 locales), reCAPTCHA, Google Analytics y animaciones. Clónala, personalízala y lánzala.',
        'keywords' => 'landing page suscripción, plantilla codeigniter 4, ci4 starter kit, landing multiidioma, plantilla newsletter',
        'og_title' => 'NewsLanding — Plantilla de Landing Page para Suscripciones',
        'og_description' => 'Plantilla CI4 lista para producción para landing pages de suscripción. Multiidioma, reCAPTCHA, conectada a API, totalmente responsiva.',
        'twitter_title' => 'NewsLanding — Plantilla de Landing Page para Suscripciones',
        'twitter_description' => 'Clónala, personalízala, lánzala. Plantilla CI4 para landing pages con 5 idiomas, animaciones e integración de API.',
    ],

    // HEADER
    'header' => [
        'logo_alt' => 'Logo de NewsLanding',
        'tagline' => 'Plantilla Landing',
    ],

    // HERO SECTION
    'hero' => [
        'title' => '<strong>Tu marca.</strong> Tu audiencia. Una sola plantilla.',
        'description' => 'NewsLanding es una landing page de suscripción lista para producción, construida sobre CodeIgniter 4. <strong>Clónala, agrega tu contenido y lanza tu lista de espera o newsletter en minutos.</strong>',
        'newsletter_instruction' => 'Prueba el demo en vivo — suscríbete aquí',
        'email_placeholder' => 'tu@email.com',
        'subscribe_btn' => 'Suscribirme',
        'portfolio_title' => 'Multiidioma',
        'visibility_title' => 'Backend CI4',
        'search_title' => 'Lista para API',
    ],

    // OPTIONS SECTION
    'options' => [
        'portfolio' => [
            'title' => 'Diseñada para personalizarse',
            'description' => 'Cada sección —hero, características, FAQ, pie de página— está controlada por archivos de idioma. <strong>Cambia el contenido en un lugar y los 5 locales se actualizan al instante.</strong> Sin tocar la lógica de la vista.',
        ],
        'search' => [
            'title' => 'Lista para producción',
            'description' => 'Se conecta a tu API para gestionar suscripciones, <strong>valida con reCAPTCHA v3, soporta Google Analytics y GTM,</strong> e incluye etiquetas SEO, Open Graph y Twitter Cards desde el primer momento.',
        ],
    ],

    // FAQ SECTION
    'faq' => [
        'title' => 'Todo lo que<br>necesitas para <strong>lanzar<br>tu landing</strong>',
        'description' => 'NewsLanding es autodocumentada — esta misma página es una demostración en vivo de cómo luce la plantilla.',
        'questions' => [
            [
                'question' => '¿Qué es NewsLanding?',
                'answer' => [
                    'intro' => 'NewsLanding es una plantilla starter de CodeIgniter 4 para landing pages de suscripción. Incluye:',
                    'benefits' => [
                        'Landing page responsiva y animada con hero, características, FAQ y pie de página',
                        'Soporte multiidioma con 5 locales: inglés, español, francés, italiano y portugués',
                        'Formulario de suscripción conectado a tu propio endpoint de API',
                        'Integración con reCAPTCHA v3, Google Analytics 4 y Google Tag Manager',
                    ],
                    'outro' => 'Clona el repositorio, actualiza los archivos de idioma con tu contenido, configura tu env y ya estás en línea.',
                ],
            ],
            [
                'question' => '¿Cómo la personalizo para mi producto?',
                'answer' => [
                    'intro' => 'La personalización es directa y no requiere tocar la lógica de las vistas:',
                    'benefits' => [
                        'Edita app/Language/{locale}/LandingPage.php para cambiar todo el contenido visible',
                        'Reemplaza las imágenes en public/images/landing/ y los logos en public/images/logos/',
                        'Actualiza los colores y el nombre del sitio en app/Config/SiteConfig.php',
                        'Apunta el API_BASE_URL en env a tu propio backend de suscripciones',
                    ],
                    'outro' => 'La plantilla está estructurada para que el contenido y la presentación estén completamente separados.',
                ],
            ],
            [
                'question' => '¿Qué idiomas están incluidos?',
                'answer' => [
                    'intro' => 'La plantilla incluye cinco archivos de locale completamente traducidos: inglés (en), español (es), francés (fr), italiano (it) y portugués (pt).',
                    'benefits' => [],
                    'outro' => 'El selector de idioma está controlado por la configuración de locales soportados en app/Config/App.php. Cada locale es accesible en su propia ruta URL: /en, /es, /fr, /it, /pt.',
                ],
            ],
            [
                'question' => '¿Qué hace el formulario de suscripción?',
                'answer' => [
                    'intro' => 'El formulario recopila un email, lo valida en cliente y servidor, y lo envía a tu endpoint de API configurado. Gestiona emails duplicados, direcciones inválidas y fallos de reCAPTCHA con mensajes localizados.',
                    'benefits' => [
                        'Token reCAPTCHA v3 generado de forma invisible al enviar',
                        'Detección de email duplicado con mensaje amigable',
                        'Email de bienvenida enviado desde tu API (SMTP vive en el servidor)',
                        'Todos los mensajes de retroalimentación están localizados según el idioma activo',
                    ],
                    'outro' => '',
                ],
            ],
        ],
    ],

    // FOOTER
    'footer' => [
        'newsletter_text' => '¿Te gusta esta plantilla? Suscríbete para recibir actualizaciones cuando salgan nuevas versiones.',
        'email_placeholder' => 'tu@email.com',
        'subscribe_btn' => 'Suscribirme',
        'copyright' => '© 2026 NewsLanding. Una plantilla de landing page de suscripción en CodeIgniter 4.',
    ],

    // NEWSLETTER CONFIRM / UNSUBSCRIBE PAGES
    'newsletter' => [
        'confirm_success_title' => '¡Suscripción confirmada!',
        'confirm_success_message' => 'Tu correo ha sido verificado. Ya formas parte de la lista.',
        'confirm_error_title' => 'No pudimos confirmar tu suscripción',
        'confirm_error_message' => 'El enlace no es válido o ya expiró. Intenta suscribirte de nuevo.',
        'unsubscribe_title' => 'Cancelar suscripción',
        'unsubscribe_prompt' => '¿Seguro que quieres dejar de recibir nuestros correos?',
        'unsubscribe_button' => 'Sí, darme de baja',
        'unsubscribe_success_title' => 'Suscripción cancelada',
        'unsubscribe_success_message' => 'No volverás a recibir nuestros correos. Puedes suscribirte de nuevo cuando quieras.',
        'unsubscribe_error_title' => 'No pudimos procesar la baja',
        'unsubscribe_error_message' => 'El enlace no es válido o ya expiró. Si el problema persiste, contáctanos.',
        'missing_token' => 'Falta el código de baja en el enlace. Usa el enlace incluido en nuestros correos.',
        'back_home' => 'Volver al inicio',
    ],
];
