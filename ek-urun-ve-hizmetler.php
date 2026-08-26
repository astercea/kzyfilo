<?php
/**
 * kzyfilo — Ek Ürün ve Hizmetler (ek-urun-ve-hizmetler.php)
 * KZY Executive Value-Added Services
 */
require_once __DIR__ . '/includes/config.php';

$services = loadData('services.php');

setPageMeta([
    'title' => t('solutions_menu.additional_services') . ' | ' . SITE_NAME,
    'description' => 'Filo kiralama deneyiminizi zenginleştiren katma değerli ek ürünler, sınırsız lastik, muafiyetsiz kasko ve VIP transfer hizmetleri.',
    'canonical' => canonical('ek-urun-ve-hizmetler.php'),
]);

$breadcrumbs = [
    ['title' => t('services.title'), 'url' => url('hizmetler.php')],
    ['title' => t('solutions_menu.additional_services')]
];

include includePath('header.php');?>

<!-- ─── 1. PAGE HEADER ─────────────────────────────────────────────── -->
<div class="page-header">
    <div class="container">
        <h1><?php e('solutions_menu.additional_services'); ?></h1>
        <?php include includePath('breadcrumbs.php'); ?>
    </div>
</div>

<!-- ─── 2. KATMA DEĞERLİ EK HİZMET KARTLARI ────────────────────────── -->
<section class="section section-ivory" data-reveal="fade-up">
    <div class="container">
        <div class="section-header text-center" style="max-width: 760px; margin: 0 auto var(--space-12);">
            <span class="editorial-tag">Özelleştirilebilir Filo Deneyimi</span>
            <h2 style="font-size: clamp(2.2rem, 3.5vw, 3rem); font-weight: var(--font-weight-normal); margin-top: var(--space-2); margin-bottom: var(--space-3);">
                Katma Değerli Ek Ürün ve Hizmetler
            </h2>
            <p style="font-size: 1.05rem; color: var(--color-text-muted); line-height: 1.65;">
                Standart operasyonel kiralamanın ötesinde; filonuzun risklerini sıfırlayan ve konforunu artıran esnek hizmet modülleri.
            </p>
        </div>

        <div class="addon-service-grid mb-16">
            <?php foreach ($services as $service): ?>
                <div class="addon-service-card" data-spotlight>
                    <div>
                        <div class="flex flex-between items-start mb-3">
                            <h3 style="font-size: 1.25rem; font-weight: 700; color: #121822; margin-bottom: 0;"><?php echo esc($service['name']); ?></h3>
                            <span class="addon-price-badge">
                                +<?php echo number_format($service['price'], 0, ',', '.'); ?> ₺ <?php echo ($service['type'] === 'monthly') ? '/ay' : '(Tek Sefer)'; ?>
                            </span>
                        </div>
                        <p style="font-size: 0.95rem; color: var(--color-text-muted); line-height: 1.6; margin-bottom: var(--space-4);">
                            <?php echo esc($service['description']); ?>
                        </p>

                        <div style="background-color: #f7f6f2; border: 1px solid rgba(0,0,0,0.06); padding: 12px 14px; border-radius: 4px; font-size: 0.85rem; color: #121822; margin-bottom: var(--space-4); display: flex; align-items: flex-start; gap: 8px;">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--color-orange); flex-shrink: 0; margin-top: 2px;">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="16" x2="12" y2="12"></line>
                                <line x1="12" y1="8" x2="12.01" y2="8"></line>
                            </svg>
                            <span><?php echo esc($service['info']); ?></span>
                        </div>
                    </div>

                    <div style="border-top: 1px solid var(--color-border-light); padding-top: var(--space-4); margin-top: var(--space-4);">
                        <a href="<?php echo url('hizli-teklif.php'); ?>" class="btn btn-outline btn-sm" style="width: 100%; text-align: center;">
                            Pakete Dahil Et
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ─── 3. KURUMSAL CTA BANNER ──────────────────────────────────────── -->
<section class="section-sm" style="padding-top: 0;">
    <div class="container">
        <div class="solution-cta-card" style="background-image: url('<?php echo asset('images/cta-services-bg.jpg'); ?>');">
            <h3>Filonuza Özel Ek Hizmet Tanımlayın</h3>
            <p>Teklif sürecinde ihtiyacınız olan tüm ek ürün ve hizmetleri tek tıkla kiralama paketinize ekleyebilirsiniz.</p>
            <div class="solution-cta-actions">
                <a href="<?php echo url('hizli-teklif.php'); ?>" class="btn btn-primary btn-lg"><?php e('header.get_quote'); ?></a>
                <button type="button" class="btn btn-outline btn-lg" data-open-modal="callback"><?php e('home.cta_call'); ?></button>
            </div>
        </div>
    </div>
</section>

<?php include includePath('footer.php'); ?>
