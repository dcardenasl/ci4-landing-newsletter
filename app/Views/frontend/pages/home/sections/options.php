<!-- Options Section -->
<section class="options-section bg-alt d-flex justify-content-center" data-analytics-section="options">
    <div class="container py-5">
        <!-- Option 1 -->
        <div class="row align-items-center g-4 g-lg-5 mb-5">
            <div class="col-md-12 col-lg-6 d-flex justify-content-center fade-in-left">
                <img src="/images/landing/<?= $siteConfig->imageOptions1 ?>" alt="Option 1" class="img-fluid option-image">
            </div>
            <div class="col-md-12 col-lg-6 d-flex flex-column justify-content-center fade-in-right delay-3">
                <h3 class="option-title text-2xl text-center text-lg-start"><?= lang('LandingPage.options.portfolio.title') ?></h3>
                <p class="option-description font-secondary fw-light text-center text-lg-start"><?= lang('LandingPage.options.portfolio.description') ?></p>
            </div>
        </div>

        <!-- Option 2 -->
        <div class="row align-items-center g-4 g-lg-5">
            <div class="col-md-12 col-lg-6 d-flex flex-column justify-content-center fade-in-left delay-1 order-lg-1 order-2">
                <h3 class="option-title text-2xl text-center text-lg-start"><?= lang('LandingPage.options.search.title') ?></h3>
                <p class="option-description font-secondary fw-light text-center text-lg-start"><?= lang('LandingPage.options.search.description') ?></p>
            </div>
            <div class="col-md-12 col-lg-6 d-flex justify-content-center fade-in-right delay-4 order-lg-2 order-1">
                <img src="/images/landing/<?= $siteConfig->imageOptions2 ?>" alt="Option 2" class="img-fluid option-image option-image--tall" />
            </div>
        </div>
    </div>
</section>
