<!-- FAQ Section -->
<section class="faq-section d-flex justify-content-center py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12 col-lg-6 d-flex justify-content-center align-self-start mb-5 scale-in delay-2">
                <img src="/images/landing/<?= $siteConfig->imageFaq ?>" alt="Filmaker" class="img-fluid option-image" style="max-width: 400px; height:auto;" />
            </div>
            <div class="col-md-12 col-lg-6 d-flex flex-column justify-content-center">
                <h2 class="faq-title text-4xl fw-medium fade-in-up delay-1"><?= lang('LandingPage.faq.title') ?></h2>
                <p class="faq-description font-secondary fw-light fade-in-up delay-3"><?= lang('LandingPage.faq.description') ?></p>
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item fade-in-up delay-2">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="false" aria-controls="faq1">
                                <?= lang('LandingPage.faq.questions.0.question') ?>
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p class="mb-3"> <?= lang('LandingPage.faq.questions.0.answer.0') ?></p>
                                <ul class="service-list mb-0">
                                    <li><?= lang('LandingPage.faq.questions.0.answer.benefits.0') ?></li>
                                    <li><?= lang('LandingPage.faq.questions.0.answer.benefits.1') ?></li>
                                    <li><?= lang('LandingPage.faq.questions.0.answer.benefits.2') ?></li>
                                    <li><?= lang('LandingPage.faq.questions.0.answer.benefits.3') ?></li>
                                </ul>
                                <p class="mt-3 mb-0"> <?= lang('LandingPage.faq.questions.0.answer.1') ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item fade-in-up delay-2">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false" aria-controls="faq2">
                                <?= lang('LandingPage.faq.questions.1.question') ?>
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p class="mb-3"><?= lang('LandingPage.faq.questions.1.answer.0') ?></p>
                                <ul class="service-list mb-0">
                                    <li><?= lang('LandingPage.faq.questions.1.answer.benefits.0') ?></li>
                                    <li><?= lang('LandingPage.faq.questions.1.answer.benefits.1') ?></li>
                                    <li><?= lang('LandingPage.faq.questions.1.answer.benefits.2') ?></li>
                                    <li><?= lang('LandingPage.faq.questions.1.answer.benefits.3') ?></li>
                                </ul>
                                <p class="mt-3 mb-0"><?= lang('LandingPage.faq.questions.1.answer.1') ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item fade-in-up delay-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false" aria-controls="faq3">
                                <?= lang('LandingPage.faq.questions.2.question') ?>
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p class="mb-3"><?= lang('LandingPage.faq.questions.2.answer.0') ?></p>
                                <p class="mb-0"><?= lang('LandingPage.faq.questions.2.answer.1') ?></p>
                                <p class="mb-0"><?= lang('LandingPage.faq.questions.2.answer.2') ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item fade-in-up delay-4">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="false" aria-controls="faq4">
                                <?= lang('LandingPage.faq.questions.3.question') ?>
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p class="mb-3"><?= lang('LandingPage.faq.questions.3.answer.0') ?></p>
                                <p class="mb-0"><?= lang('LandingPage.faq.questions.3.answer.1') ?></p>
                                <ul class="service-list mb-0">
                                    <li><?= lang('LandingPage.faq.questions.3.answer.benefits.0') ?></li>
                                    <li><?= lang('LandingPage.faq.questions.3.answer.benefits.1') ?></li>
                                    <li><?= lang('LandingPage.faq.questions.3.answer.benefits.2') ?></li>
                                    <li><?= lang('LandingPage.faq.questions.3.answer.benefits.3') ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
