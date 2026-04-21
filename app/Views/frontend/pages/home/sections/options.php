<!-- Options Section -->
<section class="options-section bg-alt d-flex justify-content-center">
    <div class="container py-5">
        <!-- Option 1: Portfolio -->
        <div class="row align-items-center">
            <div class="col-md-12 col-lg-6 d-flex justify-content-center fade-in-left">
                <img src="/images/landing/<?= $siteConfig->imageOptions1 ?>" alt="Option 1" class="img-fluid option-image">
            </div>
            <div class="col-md-12 col-lg-6 align-items-center d-flex flex-column justify-content-center fade-in-right delay-3">
                <h3 class="option-title text-2xl text-center"><?= lang('LandingPage.options.portfolio.title') ?></h3>
                <p class="option-description font-secondary fw-light text-center"><?= lang('LandingPage.options.portfolio.description') ?></p>
            </div>
        </div>
        <!-- Option 2: Search -->
        <div class="row align-items-center mt-5 mt-lg-0">
            <div class="col-md-12 col-lg-6 align-items-center d-flex flex-column justify-content-center fade-in-left delay-1">
                <h3 class="option-title text-2xl text-center"><?= lang('LandingPage.options.search.title') ?></h3>
                <p class="option-description font-secondary fw-light text-center"><?= lang('LandingPage.options.search.description') ?></p>
            </div>
            <div class="order-first col-md-12 order-md-last col-lg-6 d-flex justify-content-center fade-in-right delay-4">
                <img src="/images/landing/<?= $siteConfig->imageOptions2 ?>" alt="Option 2" class="img-fluid option-image" style="max-height: 500px; width:auto;" />
            </div>
        </div>
    </div>
</section>
