<?php
/**
 * kzyfilo — SSS (Sıkça Sorulan Sorular) (sss.php)
 * KZY Executive Motion — Minimalist Clean FAQ Experience (Homepage Style)
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

<!-- ─── 1. PAGE HEADER ─────────────────────────────────────────────── -->
<div class="page-header">
    <div class="container">
        <h1><?php e('faq.title'); ?></h1>
        <?php include includePath('breadcrumbs.php'); ?>
    </div>
</div>

<!-- ─── 2. SSS SORULAR LİSTESİ (SADE & ANA SAYFA TASARIMI İLE BİREBİR) ─ -->
<section class="section section-ivory" data-reveal="fade-up">
    <div class="container" style="max-width: 960px;">
        <?php 
        $globalIndex = 1;
        foreach ($faqsData as $catKey => $category): 
        ?>
            <!-- Kategori Başlığı -->
            <div class="faq-category-header" style="margin-bottom: var(--space-8); margin-top: <?php echo ($globalIndex === 1) ? '0' : 'var(--space-16)'; ?>;">
                <h2 style="font-size: clamp(1.4rem, 2.2vw, 1.75rem); font-weight: var(--font-weight-medium); color: var(--color-navy-900); margin: 0; letter-spacing: -0.01em;">
                    <?php echo esc($category['category_name']); ?>
                </h2>
            </div>

            <!-- Numaralandırılmış Akordiyon Soruları -->
            <div class="accordion mb-8">
                <?php foreach ($category['items'] as $item): ?>
                    <div class="accordion-item">
                        <button type="button" class="accordion-trigger" aria-expanded="false">
                            <div class="accordion-title-wrap">
                                <span class="accordion-num"><?php echo str_pad($globalIndex++, 2, '0', STR_PAD_LEFT); ?></span>
                                <span><?php echo esc($item['question']); ?></span>
                            </div>
                            <div class="accordion-icon-btn">
                                <svg class="accordion-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                            </div>
                        </button>
                        <div class="accordion-panel">
                            <div class="accordion-panel-content">
                                <?php echo esc($item['answer']); ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php include includePath('footer.php'); ?>
