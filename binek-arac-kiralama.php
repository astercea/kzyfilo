<?php
/**
 * kzyfilo — Binek Araç Kiralama (binek-arac-kiralama.php)
 * KZY Executive Passenger Fleet Solutions
 */
require_once __DIR__ . '/includes/config.php';

$vehicles = loadData('vehicles.php');
$binekVehicles = array_filter($vehicles, fn($v) => ($v['category'] ?? '') === 'binek');

if (empty($binekVehicles)) {
    $binekVehicles = array_slice($vehicles, 0, 3);
}

setPageMeta([
    'title' => t('solutions_menu.passenger_rental') . ' | ' . SITE_NAME,
    'description' => 'Şirketiniz için hatchback, sedan ve SUV binek araç kiralama çözümleri; sıfır km konfor ve kurumsal avantajlar.',
    'canonical' => canonical('binek-arac-kiralama.php'),
]);

$breadcrumbs = [
    ['title' => t('services.title'), 'url' => url('hizmetler.php')],
    ['title' => t('solutions_menu.passenger_rental')]
];

include includePath('header.php');?>

<!-- ─── 1. PAGE HEADER ─────────────────────────────────────────────── -->
<div class="page-header">
    <div class="container">
        <h1><?php e('solutions_menu.passenger_rental'); ?></h1>
        <?php include includePath('breadcrumbs.php'); ?>
    </div>
</div>

<!-- ─── 2. SEGMENT ÇÖZÜMLERİ REHBERİ ────────────────────────────────── -->
<section class="section section-ivory" data-reveal="fade-up">
    <div class="container">
        <div class="section-header text-center" style="max-width: 760px; margin: 0 auto var(--space-12);">
            <span class="editorial-tag">Her İhtiyaca Uygun Filo</span>
            <h2 style="font-size: clamp(2.2rem, 3.5vw, 3rem); font-weight: var(--font-weight-normal); margin-top: var(--space-2); margin-bottom: var(--space-3);">
                Kurumsal Binek Segment Çözümleri
            </h2>
            <p style="font-size: 1.05rem; color: var(--color-text-muted); line-height: 1.65;">
                Saha operasyonlarından üst düzey yönetici temsiline kadar şirketinizin her kademesine özel sıfır km binek araç alternatifleri.
            </p>
        </div>

        <div class="segment-tier-grid mb-16">
            <!-- 1. Saha & Satış -->
            <div class="segment-tier-card" data-spotlight>
                <span class="segment-tier-badge">Saha & Satış Kademesi</span>
                <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: var(--space-2); color: #121822;">Ekonomik B & C Segment</h3>
                <p style="font-size: 0.9rem; color: var(--color-text-muted); line-height: 1.6; margin-bottom: var(--space-4);">
                    Şehir içi yoğun trafikte düşük yakıt tüketimi, kolay manevra ve yüksek dayanıklılık sunan kompakt modeller.
                </p>
                <div style="background-color: #f7f6f2; padding: 12px; border-radius: 4px; font-size: 0.85rem; color: #121822; font-weight: 600;">
                    Örnek Modeller: Renault Clio, Fiat Egea, Hyundai i20
                </div>
            </div>

            <!-- 2. Orta & Üst Yönetim -->
            <div class="segment-tier-card" data-spotlight>
                <span class="segment-tier-badge" style="background-color: #53575c;">Orta & Üst Yönetim</span>
                <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: var(--space-2); color: #121822;">Executive Sedan & Compact SUV</h3>
                <p style="font-size: 0.9rem; color: var(--color-text-muted); line-height: 1.6; margin-bottom: var(--space-4);">
                    Yüksek konfor, geniş bagaj hacmi, ileri sürüş destek sistemleri ve prestijli kurumsal görünüm.
                </p>
                <div style="background-color: #f7f6f2; padding: 12px; border-radius: 4px; font-size: 0.85rem; color: #121822; font-weight: 600;">
                    Örnek Modeller: VW Passat, Toyota Corolla, Peugeot 3008
                </div>
            </div>

            <!-- 3. Üst Düzey Yönetici -->
            <div class="segment-tier-card" data-spotlight>
                <span class="segment-tier-badge" style="background-color: var(--color-orange);">Üst Düzey Yönetici & Prestij</span>
                <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: var(--space-2); color: #121822;">Premium D & E Segment</h3>
                <p style="font-size: 0.9rem; color: var(--color-text-muted); line-height: 1.6; margin-bottom: var(--space-4);">
                    Şirketinizin marka değerini en üst düzeyde temsil eden lüks kabin, üstün performans ve özel donanımlar.
                </p>
                <div style="background-color: #f7f6f2; padding: 12px; border-radius: 4px; font-size: 0.85rem; color: #121822; font-weight: 600;">
                    Örnek Modeller: BMW 3/5 Serisi, Mercedes C/E Serisi
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ─── 3. BİNEK FİLO AVANTAJLARI ───────────────────────────────────── -->
<section class="section section-paper" data-reveal="fade-up">
    <div class="container">
        <div class="section-header text-center" style="max-width: 760px; margin: 0 auto var(--space-12);">
            <span class="editorial-tag">Neden KZY Binek Filo?</span>
            <h2 style="font-size: clamp(2rem, 3vw, 2.6rem); font-weight: var(--font-weight-normal); margin-top: var(--space-2);">
                Kurumsal Binek Filo Avantajları
            </h2>
        </div>

        <div class="solution-benefit-grid mb-16">
            <div class="solution-benefit-card" data-spotlight>
                <div class="solution-icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    </svg>
                </div>
                <h3>Maksimum Güvenlik & Konfor</h3>
                <p>Şerit takip, acil frenleme, kör nokta uyarısı ve Apple CarPlay donanımlı sıfır km araçlar.</p>
            </div>
            <div class="solution-benefit-card" data-spotlight>
                <div class="solution-icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2"></path>
                        <circle cx="7" cy="17" r="2"></circle>
                        <path d="M9 17h6"></path>
                        <circle cx="17" cy="17" r="2"></circle>
                    </svg>
                </div>
                <h3>Hızlı İkame Araç Güvencesi</h3>
                <p>Bakım ve hasar onarım süreçlerinde çalışanlarınızın mobilitesi aynı segment ikame araçla korunur.</p>
            </div>
            <div class="solution-benefit-card" data-spotlight>
                <div class="solution-icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="1" x2="12" y2="23"></line>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                </div>
                <h3>Vergi & Gider Tasarrufu</h3>
                <p>Aylık kira bedelini gider yazarak şirketinizin kurumlar vergisi matrahını optimize edin.</p>
            </div>
        </div>
    </div>
</section>

<!-- ─── 4. ÖNE ÇIKAN BİNEK ARAÇLAR ──────────────────────────────────── -->
<section class="section section-ivory" data-reveal="fade-up">
    <div class="container">
        <div class="flex flex-between mb-8 flex-wrap gap-4 items-center">
            <div>
                <span class="editorial-tag">Binek Filo Portföyü</span>
                <h2 style="font-size: clamp(1.8rem, 2.5vw, 2.4rem); font-weight: var(--font-weight-normal); margin-top: var(--space-1);">
                    Öne Çıkan Binek Araçlar
                </h2>
            </div>
            <a href="<?php echo url('araclar.php', ['kategori' => 'binek']); ?>" class="btn btn-dark btn-sm">
                <span>Tüm Binek Araçlar</span>
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </a>
        </div>

        <div class="catalog-grid mb-12">
            <?php foreach (array_slice($binekVehicles, 0, 3) as $vehicle): ?>
                <?php include includePath('vehicle-card.php'); ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ─── 5. KURUMSAL CTA BANNER ──────────────────────────────────────── -->
<section class="section-sm" style="padding-top: 0;">
    <div class="container">
        <div class="solution-cta-card" style="background-image: url('<?php echo asset('images/cta-passenger-bg.jpg'); ?>');">
            <h3>Binek Filonuzu Hemen Yapılandıralım</h3>
            <p>12-48 ay vadeli sabit fiyatlı kurumsal binek araç teklifinizi almak için hemen başvurun.</p>
            <div class="solution-cta-actions">
                <a href="<?php echo url('hizli-teklif.php'); ?>" class="btn btn-primary btn-lg"><?php e('header.get_quote'); ?></a>
                <button type="button" class="btn btn-outline btn-lg" data-open-modal="callback"><?php e('home.cta_call'); ?></button>
            </div>
        </div>
    </div>
</section>

<?php include includePath('footer.php'); ?>
