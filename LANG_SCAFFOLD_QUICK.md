# Language Scaffold — Quick Reference

## ⚡ Los Comandos Más Usados

```bash
# Crear idiomas de Config\App
php spark lang:scaffold

# Crear un idioma específico
php spark lang:scaffold --languages de

# Crear múltiples idiomas a la vez
php spark lang:scaffold --languages de,fr,ja

# Con personalización de preguntas FAQ
php spark lang:scaffold --faq-count 6
php spark lang:scaffold --languages es --faq-count 8

# Regenerar/sobrescribir existentes
php spark lang:scaffold --force
php spark lang:scaffold --languages es,en --force
```

---

## 📍 Ubicación de Archivos

```
app/Language/
├── es/
│   └── LandingPage.php    ← Completa con contenido español
├── en/
│   └── LandingPage.php    ← Completa con contenido inglés
├── fr/
│   └── LandingPage.php    ← Completa con contenido francés
└── de/
    └── LandingPage.php    ← Completa con contenido alemán
```

---

## ✍️ Estructura a Completar

Después de generar, cada archivo tiene esta estructura:

```php
return [
    // META TAGS
    'meta' => [
        'title' => '',                    ← SEO title
        'description' => '',              ← Meta description
        'keywords' => '',                 ← Keywords
        'og_title' => '',                 ← Open Graph title
        'og_description' => '',           ← Open Graph description
        'twitter_title' => '',            ← Twitter title
        'twitter_description' => ''       ← Twitter description
    ],

    // HEADER
    'header' => [
        'logo_alt' => '',                 ← Alt text para logo
        'tagline' => ''                   ← Tagline principal
    ],

    // HERO SECTION
    'hero' => [
        'title' => '',                    ← Título principal (puede incluir <strong>)
        'description' => '',              ← Descripción
        'newsletter_instruction' => '',   ← "Sé el primero en..."
        'email_placeholder' => '',        ← "tu@email.com"
        'subscribe_btn' => '',            ← "Suscribir" o similar
        'portfolio_title' => '',
        'visibility_title' => '',
        'search_title' => ''
    ],

    // OPTIONS SECTION
    'options' => [
        'portfolio' => [
            'title' => '',                ← Título opción 1
            'description' => ''           ← Descripción opción 1
        ],
        'search' => [
            'title' => '',                ← Título opción 2
            'description' => ''           ← Descripción opción 2
        ]
    ],

    // FAQ SECTION
    'faq' => [
        'title' => '',                    ← "Preguntas frecuentes" (puede incluir <strong>)
        'description' => '',              ← Descripción del FAQ
        'questions' => [
            [
                'question' => 'Tu pregunta?',
                'answer' => [
                    'intro' => '',        ← Párrafo introductorio
                    'benefits' => [       ← Lista de beneficios (puede estar vacía)
                        'Item 1',
                        'Item 2',
                    ],
                    'outro' => ''         ← Párrafo final (puede estar vacío)
                ],
            ],
            // ... más preguntas
        ]
    ],

    // FOOTER
    'footer' => [
        'newsletter_text' => '',          ← "Únete a..."
        'email_placeholder' => '',        ← "tu@email.com"
        'subscribe_btn' => '',            ← "Suscribir"
        'copyright' => ''                 ← "© 2025..."
    ]
];
```

---

## 🎯 Ejemplo Completo: Llenar un Idioma

**app/Language/de/LandingPage.php:**

```php
<?php
return [
    'meta' => [
        'title' => 'NewsLanding - Plantilla de Landing Page de Suscripción',
        'description' => 'Verbinde dich mit den besten Audiovisuelle-Profis...',
        'keywords' => 'crew finder, audiovisuelle, produktion, regisseure',
        'og_title' => 'NewsLanding - Plantilla de Landing Page',
        'og_description' => 'Professionelle Crew und Services finden...',
        'twitter_title' => 'NewsLanding - Subscription Landing Page',
        'twitter_description' => 'Audiovisuelle Profis verbinden...'
    ],

    'header' => [
        'logo_alt' => 'NewsLanding Logo',
        'tagline' => 'Crew Finder'
    ],

    'hero' => [
        'title' => '<strong>Erstelle dein Profil</strong> als Audiovisuelle-Profi',
        'description' => 'Suche, biete, kaufe und verkaufe alles rund um die <strong>audiovisuelle und filmische Welt</strong>',
        'newsletter_instruction' => 'Sei der Erste, der es erfährt',
        'email_placeholder' => 'Gib deine E-Mail ein',
        'subscribe_btn' => 'Abonnieren',
        'portfolio_title' => 'Professionelles Portfolio',
        'visibility_title' => 'Online-Sichtbarkeit',
        'search_title' => 'Team-Suche'
    ],

    'options' => [
        'portfolio' => [
            'title' => 'Online-Portfolio',
            'description' => 'Erstelle ein professionelles Profil, fülle deine Fachgebiete aus, lade deine Reels hoch und <strong>biete deine Dienstleistungen an</strong>.'
        ],
        'search' => [
            'title' => 'Profi-Suche',
            'description' => 'Nutze unsere <strong>erweiterte Suchmaschine</strong> und filtere nach Spezialität, Region und Verfügbarkeit.'
        ]
    ],

    'faq' => [
        'title' => 'Alles, was du<br>für deine<br><strong>Produktionen brauchst</strong>',
        'description' => 'Über unsere Plattform kannst du planen, Budgets organisieren und deine Film- oder Audiovisualprojekte verbessern.',
        'questions' => [
            [
                'question' => 'Was ist NewsLanding?',
                'answer' => [
                    'intro' => 'NewsLanding ist ein CodeIgniter 4 Template für Subscription Landing Pages...',
                    'benefits' => [],
                    'outro' => 'Unsere Plattform erleichtert die Verbindung zwischen diesen Profis...'
                ],
            ],
            // ... más preguntas
        ]
    ],

    'footer' => [
        'newsletter_text' => 'Sei der Erste, der von NewsLanding-Updates erfährt.',
        'email_placeholder' => 'Gib deine E-Mail ein',
        'subscribe_btn' => 'Abonnieren',
        'copyright' => '© 2026 NewsLanding. Alle Rechte vorbehalten.'
    ]
];
```

---

## 🔄 Workflow Típico

### 1️⃣ Generar
```bash
php spark lang:scaffold --languages de,fr,ja --faq-count 5
```

### 2️⃣ Completar
- Abrir `app/Language/de/LandingPage.php`
- Reemplazar vacíos con contenido alemán
- Repetir para `fr/` y `ja/`

### 3️⃣ Probar
```bash
php spark serve
# http://localhost:8080/de
# http://localhost:8080/fr
# http://localhost:8080/ja
```

### 4️⃣ Commit
```bash
git add app/Language/
git commit -m "Add German, French, Japanese landing pages"
```

---

## 💡 Consejos

### Reutilizar Contenido
Si tienes contenido en un idioma, cópialo como base:
```bash
# Copiar Spanish como base para otros idiomas
cp app/Language/es/LandingPage.php app/Language/de/LandingPage.php
# Luego editar y traducir valores
```

### HTML en Textos
Los campos soportan HTML simple (para bold, links, etc.):
```php
'title' => 'Mi <strong>landing page</strong> en <em>múltiples idiomas</em>'
```

### Caracteres Especiales
El charset está seteado a UTF-8, así que puedes usar caracteres especiales:
```php
'title' => 'Crea tu perfil como profesional del audiovisual',  // ✓ OK
'title' => 'Café, résumé, Zürich, 日本語'                      // ✓ OK
```

### Control de Cambios
Commita cada idioma cuando esté listo:
```bash
git add app/Language/de/LandingPage.php
git commit -m "feat: Add German landing page translation"
```

---

## ⚠️ Errores Comunes

### ❌ "File exists"
```
⊘ es: File exists (use --force to overwrite)
```
**Solución:** Ya existe el archivo. Usa `--force` para regenerar o edita manualmente.

### ❌ Estructura inválida
Si el archivo PHP tiene errores de sintaxis, verás un error al cargar la página.
**Solución:** Verificar llaves `{}`, corchetes `[]`, comillas `''` o `""`.

### ❌ Falta un campo
Si un campo no está en el archivo, `lang()` retorna su clave.
**Solución:** Agregar el campo faltante o copiar de otro idioma.

---

## 📚 Referencia Completa
Para documentación detallada, ver: **LANG_SCAFFOLD.md**

Para estructuración del FAQ: Ver ejemplos en `app/Language/es/LandingPage.php`
