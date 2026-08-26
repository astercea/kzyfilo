<?php
/**
 * kzyfilo — SSS (Sıkça Sorulan Sorular) (sss.php)
 * KZY Executive Motion — Premium FAQ Experience
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
    <div class="container">
        <h1><?php e('faq.title'); ?></h1>
        <?php include includePath('breadcrumbs.php'); ?>
    </div>
</div>

<section class="section section-paper">
    <div class="container container-narrow">
        
        <!-- ─── Search & Category Filter Bar ─────────────────────────── -->
        <div class="faq-filter-bar" data-reveal="fade-up">
            <div class="faq-search-input-wrap">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input type="search" id="faq-search" class="faq-search-input" placeholder="Sorularda arayın (ör: vergi, ikame araç, kış lastiği, süre)..." aria-label="Soru arama">
            </div>

            <div class="faq-cat-pills" role="tablist" aria-label="Soru Kategorileri">
                <button type="button" class="faq-cat-pill is-active" data-cat="all">Tümü</button>
                <?php foreach ($faqsData as $catKey => $category): ?>
                    <button type="button" class="faq-cat-pill" data-cat="<?php echo esc($catKey); ?>">
                        <?php echo esc($category['category_name']); ?>
                    </button>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- ─── FAQ Categories & Accordions ──────────────────────────── -->
        <div id="faq-groups-container">
            <?php 
            $globalIndex = 1;
            foreach ($faqsData as $catKey => $category): 
            ?>
                <div class="faq-group-section mb-12" data-cat="<?php echo esc($catKey); ?>" data-reveal="fade-up">
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: var(--space-4); padding-bottom: var(--space-2); border-bottom: 1px solid var(--color-border-light);">
                        <span style="width: 8px; height: 8px; border-radius: 50%; background-color: var(--color-orange);"></span>
                        <h2 style="font-size: var(--font-size-xl); font-weight: var(--font-weight-medium); color: var(--color-text-dark); margin: 0;">
                            <?php echo esc($category['category_name']); ?>
                        </h2>
                    </div>

                    <div class="accordion">
                        <?php foreach ($category['items'] as $item): ?>
                            <div class="accordion-item" data-faq-item>
                                <button type="button" class="accordion-trigger" aria-expanded="false">
                                    <div class="accordion-title-wrap">
                                        <span class="accordion-num"><?php echo str_pad($globalIndex++, 2, '0', STR_PAD_LEFT); ?></span>
                                        <span class="faq-q-text"><?php echo esc($item['question']); ?></span>
                                    </div>
                                    <div class="accordion-icon-btn">
                                        <svg class="accordion-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                    </div>
                                </button>
                                <div class="accordion-panel">
                                    <div class="accordion-panel-content faq-a-text">
                                        <?php echo esc($item['answer']); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Empty Search State -->
        <div class="empty-state hidden" id="faq-empty-search">
            <div class="empty-state-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </div>
            <h3>Eşleşen Soru Bulunamadı</h3>
            <p>Aradığınız kriterlere uygun bir soru bulunamadı. Lütfen farklı bir arama terimi deneyin veya bize doğrudan danışın.</p>
        </div>

        <!-- ─── Bottom Assistance CTA ────────────────────────────────── -->
        <div class="closing-cta-card" style="margin-top: var(--space-12);" data-reveal="fade-up">
            <div class="closing-cta-content">
                <span class="editorial-tag" style="color: var(--color-sand);">Bize Ulaşın</span>
                <h3 style="color: #ffffff; font-size: var(--font-size-2xl); font-weight: var(--font-weight-light); margin-top: var(--space-2); margin-bottom: var(--space-3);">
                    Başka Bir Sorunuz mu Var?
                </h3>
                <p style="color: var(--color-text-muted-dark); font-size: var(--font-size-base); line-height: var(--line-height-relaxed);">
                    Filo uzmanlarımız şirketinizin filo yapısına özel kiralama ve operasyon senaryolarını yanıtlamaktan memnuniyet duyar.
                </p>
                <div class="closing-cta-actions">
                    <a href="<?php echo url('iletisim.php'); ?>" class="btn btn-primary">
                        <span><?php e('header.contact'); ?></span>
                    </a>
                    <a href="tel:<?php e('topbar.phone_full'); ?>" class="btn btn-outline" style="color: #fff; border-color: rgba(255,255,255,0.25);">
                        <span><?php e('topbar.phone'); ?></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Live FAQ Filter & Search Script -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('faq-search');
    const catPills = document.querySelectorAll('.faq-cat-pill');
    const sections = document.querySelectorAll('.faq-group-section');
    const emptyState = document.getElementById('faq-empty-search');

    let activeCat = 'all';

    function filterFAQs() {
        const query = (searchInput ? searchInput.value : '').toLowerCase().trim();
        let totalVisible = 0;

        sections.forEach(function (sec) {
            const secCat = sec.getAttribute('data-cat');
            const items = sec.querySelectorAll('[data-faq-item]');
            let secVisibleCount = 0;

            const matchesCat = (activeCat === 'all' || activeCat === secCat);

            items.forEach(function (item) {
                const qText = item.querySelector('.faq-q-text')?.textContent.toLowerCase() || '';
                const aText = item.querySelector('.faq-a-text')?.textContent.toLowerCase() || '';

                const matchesQuery = !query || qText.includes(query) || aText.includes(query);

                if (matchesCat && matchesQuery) {
                    item.style.display = '';
                    secVisibleCount++;
                    totalVisible++;
                } else {
                    item.style.display = 'none';
                }
            });

            if (secVisibleCount > 0) {
                sec.style.display = '';
            } else {
                sec.style.display = 'none';
            }
        });

        if (emptyState) {
            if (totalVisible === 0) {
                emptyState.classList.remove('hidden');
            } else {
                emptyState.classList.add('hidden');
            }
        }
    }

    if (searchInput) {
        searchInput.addEventListener('input', filterFAQs);
    }

    catPills.forEach(function (pill) {
        pill.addEventListener('click', function () {
            catPills.forEach(p => p.classList.remove('is-active'));
            this.classList.add('is-active');
            activeCat = this.getAttribute('data-cat');
            filterFAQs();
        });
    });
});
</script>

<?php include includePath('footer.php'); ?>
