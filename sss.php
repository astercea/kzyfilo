<?php
/**
 * kzyfilo — SSS (Sýkça Sorulan Sorular) (sss.php)
 */
require_once __DIR__ . '/includes/config.php';

$faqsData = loadData('faqs.php');

setPageMeta([
    'title' => t('faq.title') . ' | ' . SITE_NAME,
    'description' => t('faq.description'),
    'canonical' => canonical('sss.php'),
]);

$breadcrumbs = [
    ['title' => t('faq.title')]
];

include includePath('header.php');
?>

<div class="page-header">
    <div class="container text-center">
        <h1><?php e('faq.title'); ?></h1>
        <p><?php e('faq.description'); ?></p>
    </div>

<?php include includePath('breadcrumbs.php'); ?>
</div>

<section class="section">
    <div class="container container-narrow">
        <?php foreach ($faqsData as $catKey => $category): ?>
            <div class="mb-12">
                <h2 class="text-xl mb-4" style="color: var(--color-primary); border-bottom: 2px solid var(--color-primary-light); padding-bottom: 8px;">
                    <?php echo esc($category['category_name']); ?>
                </h2>

                <div class="accordion">
                    <?php foreach ($category['items'] as $item): ?>
                        <div class="accordion-item">
                            <button type="button" class="accordion-trigger" aria-expanded="false">
                                <span><?php echo esc($item['question']); ?></span>
                                <svg class="accordion-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                            </button>
                            <div class="accordion-panel">
                                <div class="accordion-panel-content">
                                    <?php echo esc($item['answer']); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>

        <!-- Sorunuz mu var CTA -->
        <div class="card card-body p-8 text-center bg-surface-soft mt-12">
            <h3 class="text-xl mb-2">Baþka Bir Sorunuz mu Var?</h3>
            <p class="text-muted text-sm mb-4">Filo uzmanlarýmýz tüm sorularýnýzý yanýtlamaktan memnuniyet duyacaktýr.</p>
            <div class="flex gap-4 justify-center">
                <a href="<?php echo url('iletisim.php'); ?>" class="btn btn-primary"><?php e('header.contact'); ?></a>
                <button type="button" class="btn btn-outline" data-open-modal="callback"><?php e('home.cta_call'); ?></button>
            </div>
        </div>
    </div>
</section>

<?php include includePath('footer.php'); ?>
