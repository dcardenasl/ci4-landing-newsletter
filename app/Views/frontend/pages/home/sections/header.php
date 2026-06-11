<!-- Header Section -->
<header class="header" data-analytics-section="header">
    <div class="container">
        <div class="header-bar">
            <div class="brand-group">
                <span class="brand-logo"><?= esc($siteConfig->siteName) ?></span>
                <span class="brand-separator" aria-hidden="true">|</span>
                <p class="brand-tagline"><?= lang('LandingPage.header.tagline') ?></p>
            </div>

            <div class="language-selector">
                <div class="language-dropdown" id="languageDropdown">
                    <button class="language-btn" id="languageBtn" type="button" aria-haspopup="listbox" aria-expanded="false">
                        <span class="language-flag" id="currentFlag">
                            <img src="/images/flags/<?= strtolower($supportedLocales['current_language']['country_code']) ?>.svg"
                                 class="img-fluid"
                                 width="18" height="18"
                                 alt="<?= esc($supportedLocales['current_language']['name']) ?> flag">
                        </span>
                        <span class="language-code" id="currentLang"><?= strtoupper($supportedLocales['current_language']['country_code']) ?></span>
                        <span class="language-arrow" aria-hidden="true">▼</span>
                    </button>
                    <div class="language-menu" id="languageMenu" role="listbox">
                        <?php foreach ($supportedLocales['languages'] as $languages): ?>
                            <button class="language-option <?= $languages['locale'] === $locale ? 'active' : '' ?>"
                                type="button"
                                role="option"
                                aria-selected="<?= $languages['locale'] === $locale ? 'true' : 'false' ?>"
                                data-locale="<?= $languages['locale'] ?>"
                                data-flag="<?= $languages['flag'] ?>"
                                data-name="<?= $languages['name'] ?>"
                                data-url="/<?= $languages['locale'] ?>">
                                <span class="flag">
                                    <img src="/images/flags/<?= strtolower($languages['country_code']) ?>.svg"
                                         class="img-fluid"
                                         width="18" height="18"
                                         alt="<?= esc($languages['native_name']) ?> flag">
                                </span>
                                <span><?= esc($languages['native_name']) ?></span>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
