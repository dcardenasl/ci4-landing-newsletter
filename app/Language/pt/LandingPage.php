<?php

return [
    // META TAGS
    'meta' => [
        'title' => 'NewsLanding — O template de landing page de inscrições para CodeIgniter 4',
        'description' => 'Um template CI4 pronto para uso: landing page de inscrições com suporte multilíngue (5 locales), reCAPTCHA, Google Analytics e animações. Clone-o, personalize-o, lance-o.',
        'keywords' => 'landing page inscrições, template codeigniter 4, página newsletter, ci4 starter kit, landing multilíngue, template newsletter, landing page open source',
        'og_title' => 'NewsLanding — Template de Landing Page de Inscrições',
        'og_description' => 'Template pronto para produção em CodeIgniter 4 para landing pages de newsletter. Multilíngue, reCAPTCHA, conectado a API, totalmente responsivo.',
        'twitter_title' => 'NewsLanding — Template de Landing Page de Inscrições',
        'twitter_description' => 'Clone-o, personalize-o, lance-o. Template CI4 para landing pages com 5 idiomas, animações e integração de API.',
    ],

    // HEADER
    'header' => [
        'logo_alt' => 'Logo NewsLanding',
        'tagline' => 'Template Landing',
    ],

    // HERO SECTION
    'hero' => [
        'title' => '<strong>Sua marca.</strong> Seu público. Um só template.',
        'description' => 'NewsLanding é uma landing page de inscrições pronta para produção, construída sobre CodeIgniter 4. <strong>Clone-a, adicione seu conteúdo e lance sua lista de espera ou newsletter em minutos.</strong>',
        'newsletter_instruction' => 'Experimente a demo ao vivo — inscreva-se aqui',
        'email_placeholder' => 'seu@email.com',
        'subscribe_btn' => 'Inscrever-se',
        'portfolio_title' => 'Multilíngue',
        'visibility_title' => 'Backend CI4',
        'search_title' => 'Pronto para API',
    ],

    // OPTIONS SECTION
    'options' => [
        'portfolio' => [
            'title' => 'Feito para ser personalizado',
            'description' => 'Cada seção — hero, funcionalidades, FAQ, rodapé — é controlada por arquivos de idioma. <strong>Altere o conteúdo em um só lugar e todos os 5 locales são atualizados instantaneamente.</strong> Sem tocar na lógica das views.',
        ],
        'search' => [
            'title' => 'Pronto para produção',
            'description' => 'Conecta-se à sua API para gerenciamento de inscrições, <strong>valida com reCAPTCHA v3, suporta Google Analytics e GTM,</strong> e inclui meta tags de SEO, Open Graph e Twitter Cards desde o início.',
        ],
    ],

    // FAQ SECTION
    'faq' => [
        'title' => 'Tudo o que<br>você precisa para <strong>lançar<br>sua landing</strong>',
        'description' => 'NewsLanding é auto-documentado — esta própria página é uma demonstração ao vivo de como o template se parece.',
        'questions' => [
            [
                'question' => 'O que é NewsLanding?',
                'answer' => [
                    'intro' => 'NewsLanding é um template starter de CodeIgniter 4 para landing pages de inscrição. Inclui:',
                    'benefits' => [
                        'Landing page responsiva e animada com hero, funcionalidades, FAQ e rodapé',
                        'Suporte multilíngue com 5 locales: inglês, espanhol, francês, italiano e português',
                        'Formulário de inscrição conectado ao seu próprio endpoint de API',
                        'Integração reCAPTCHA v3, Google Analytics 4 e Google Tag Manager',
                    ],
                    'outro' => 'Clone o repositório, atualize os arquivos de idioma com seu conteúdo, configure seu env e você está no ar.',
                ],
            ],
            [
                'question' => 'Como personalizo para o meu produto?',
                'answer' => [
                    'intro' => 'A personalização é direta e não requer tocar na lógica das views:',
                    'benefits' => [
                        'Edite app/Language/{locale}/LandingPage.php para alterar todo o conteúdo visível',
                        'Substitua as imagens em public/images/landing/ e os logos em public/images/logos/',
                        'Atualize os colores e o nome do sítio em app/Config/SiteConfig.php',
                        'Aponte o API_BASE_URL em env para o seu próprio backend de inscrições',
                    ],
                    'outro' => 'O template é intencionalmente estruturado para que conteúdo e apresentação sejam completamente separados.',
                ],
            ],
            [
                'question' => 'Quais idiomas estão incluídos?',
                'answer' => [
                    'intro' => 'O template inclui cinco arquivos de locale completamente traduzidos: inglês (en), espanhol (es), francês (fr), italiano (it) e português (pt).',
                    'benefits' => [],
                    'outro' => 'O seletor de idioma no cabeçalho é controlado pela configuração de locales suportados em app/Config/App.php. Cada locale é acessível em seu próprio caminho de URL: /en, /es, /fr, /it, /pt.',
                ],
            ],
            [
                'question' => 'O que faz o formulário de inscrição?',
                'answer' => [
                    'intro' => 'O formulário de newsletter coleta um endereço de email, valida-o no lado do cliente e do servidor, e o envia para o seu endpoint de API configurado. Gerencia emails duplicados, endereços inválidos e falhas de reCAPTCHA com mensagens de feedback localizadas.',
                    'benefits' => [
                        'O token reCAPTCHA v3 é gerado invisivelmente no envio',
                        'A detecção de email duplicado retorna uma mensagem amigável',
                        'O email de boas-vindas é enviado via sua API (a configuração SMTP fica no servidor)',
                        'Todas as mensagens de feedback são localizadas conforme o idioma ativo',
                    ],
                    'outro' => '',
                ],
            ],
        ],
    ],

    // FOOTER
    'footer' => [
        'newsletter_text' => 'Gostou deste template? Inscreva-se para receber atualizações quando novas versões forem lançadas.',
        'email_placeholder' => 'seu@email.com',
        'subscribe_btn' => 'Inscrever-se',
        'copyright' => '© 2026 NewsLanding. Um template de landing page de inscrições para CodeIgniter 4.',
    ],

    // NEWSLETTER CONFIRM / UNSUBSCRIBE PAGES
    'newsletter' => [
        'confirm_success_title' => 'Assinatura confirmada!',
        'confirm_success_message' => 'Seu e-mail foi verificado. Você já faz parte da lista.',
        'confirm_error_title' => 'Não foi possível confirmar sua assinatura',
        'confirm_error_message' => 'O link é inválido ou expirou. Tente se inscrever novamente.',
        'unsubscribe_title' => 'Cancelar assinatura',
        'unsubscribe_prompt' => 'Tem certeza de que não quer mais receber nossos e-mails?',
        'unsubscribe_button' => 'Sim, cancelar minha assinatura',
        'unsubscribe_success_title' => 'Assinatura cancelada',
        'unsubscribe_success_message' => 'Você não receberá mais nossos e-mails. Pode se inscrever novamente quando quiser.',
        'unsubscribe_error_title' => 'Não foi possível processar sua solicitação',
        'unsubscribe_error_message' => 'O link é inválido ou expirou. Se o problema persistir, fale conosco.',
        'missing_token' => 'O código de cancelamento está ausente do link. Use o link incluído em nossos e-mails.',
        'back_home' => 'Voltar ao início',
    ],
];
