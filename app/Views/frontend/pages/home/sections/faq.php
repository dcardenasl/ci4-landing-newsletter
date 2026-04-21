<!-- FAQ Section -->
<section class="faq-section d-flex justify-content-center py-5">
    <div class="container">
        <div class="row justify-content-center mb-5 scale-in delay-2">
            <div class="col-12 col-lg-10 d-flex justify-content-center">
                <img src="/images/landing/<?= $siteConfig->imageFaq ?>"
                     alt="Template preview"
                     class="img-fluid faq-image" />
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <h2 class="faq-title text-center text-4xl fw-medium fade-in-up delay-1"><?= lang('LandingPage.faq.title') ?></h2>
                <p class="faq-description text-center font-secondary fw-light fade-in-up delay-3"><?= lang('LandingPage.faq.description') ?></p>
                <div class="accordion" id="faqAccordion">
                    <?php
                    $faqQuestions = lang('LandingPage.faq.questions');
                    $delays = ['delay-2', 'delay-2', 'delay-3', 'delay-4'];
                    foreach ($faqQuestions as $i => $faq):
                        $delay = $delays[$i % count($delays)];
                        $faqId = 'faq' . ($i + 1);
                    ?>
                    <div class="accordion-item fade-in-up <?= $delay ?>">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?= $faqId ?>" aria-expanded="false" aria-controls="<?= $faqId ?>">
                                <?= esc($faq['question']) ?>
                            </button>
                        </h2>
                        <div id="<?= $faqId ?>" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <?php if (!empty($faq['answer']['intro'])): ?>
                                    <p class="mb-3"><?= $faq['answer']['intro'] ?></p>
                                <?php endif; ?>
                                <?php if (!empty($faq['answer']['benefits'])): ?>
                                    <ul class="service-list mb-0">
                                        <?php foreach ($faq['answer']['benefits'] as $benefit): ?>
                                            <li><?= esc($benefit) ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                                <?php if (!empty($faq['answer']['outro'])): ?>
                                    <p class="mt-3 mb-0"><?= $faq['answer']['outro'] ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
