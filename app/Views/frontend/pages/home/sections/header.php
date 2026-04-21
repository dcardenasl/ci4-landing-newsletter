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
                <span class="brand-text-logo fw-bold" style="font-family:'Poppins',sans-serif; font-size:1.5rem; color:#111;">
                    <?= esc($siteConfig->siteName) ?>
                </span>
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
