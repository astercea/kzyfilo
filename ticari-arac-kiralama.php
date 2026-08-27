<?php
/**
 * kzyfilo — Ticari Araç Kiralama (ticari-arac-kiralama.php)
 * KZY Executive Commercial Fleet Solutions
 */
require_once __DIR__ . '/includes/config.php';

$vehicles = loadData('vehicles.php');
$ticariVehicles = array_filter($vehicles, fn($v) => ($v['category'] ?? '') === 'ticari');

if (empty($ticariVehicles)) {
    $ticariVehicles = array_slice($vehicles, 0, 3);
}

setPageMeta([
    'title' => t('solutions_menu.commercial_rental') . ' | ' . SITE_NAME,
    'description' => 'Hafif ticari, minivan ve panelvan kiralama çözümleri ile lojistik, servis ve saha operasyonlarınızı kesintisiz yürütün.',
    'canonical' => canonical('ticari-arac-kiralama.php'),
]);

$breadcrumbs = [
    ['title' => t('services.title'), 'url' => url('hizmetler.php')],
    ['title' => t('solutions_menu.commercial_rental')]
];

include includePath('header.php');?>

<!-- ─── 1. PAGE HEADER ─────────────────────────────────────────────── -->
<div class="page-header">
    <div class="container">
        <h1><?php e('solutions_menu.commercial_rental'); ?></h1>
        <?php include includePath('breadcrumbs.php'); ?>
    </div>
</div>

<!-- ─── 2. TİCARİ ÇÖZÜM KATEGORİLERİ ────────────────────────────────── -->
<section class="section section-ivory" data-reveal="fade-up">
    <div class="container">
        <div class="section-header text-center" style="max-width: 760px; margin: 0 auto var(--space-12);">
            <span class="editorial-tag">İşletmenizin Güçlü Ortağı</span>
            <h2 style="font-size: clamp(2.2rem, 3.5vw, 3rem); font-weight: var(--font-weight-normal); margin-top: var(--space-2); margin-bottom: var(--space-3);">
                Kurumsal Hafif Ticari Çözümleri
            </h2>
            <p style="font-size: 1.05rem; color: var(--color-text-muted); line-height: 1.65;">
                Şehir içi hızlı dağıtımdan ağır yük taşımacılığına kadar operasyonel yükünüzü hafifleten esnek ticari filo modelleri.
            </p>
        </div>

        <div class="segment-tier-grid mb-16">
            <!-- 1. Kombi Minivan -->
            <div class="segment-tier-card" data-spotlight>
                <span class="segment-tier-badge">Şehir İçi Dağıtım & Servis</span>
                <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: var(--space-2); color: #121822;">Kombi Minivan Modelleri</h3>
                <p style="font-size: 0.9rem; color: var(--color-text-muted); line-height: 1.6; margin-bottom: var(--space-4);">
                    Hem 5 kişilik personel transferi hem de 3.3 m³'e varan kargo yükleme hacmi sunan çok amaçlı kompakt ticari araçlar.
                </p>
                <div style="background-color: #f7f6f2; padding: 12px; border-radius: 4px; font-size: 0.85rem; color: #121822; font-weight: 600;">
                    Örnek Modeller: Renault Express, Fiat Doblo, Ford Courier
                </div>
            </div>

            <!-- 2. Orta & Büyük Panelvan -->
            <div class="segment-tier-card" data-spotlight>
                <span class="segment-tier-badge" style="background-color: #53575c;">Lojistik & Kargo Taşımacılığı</span>
                <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: var(--space-2); color: #121822;">Orta & Büyük Panelvanlar</h3>
                <p style="font-size: 0.9rem; color: var(--color-text-muted); line-height: 1.6; margin-bottom: var(--space-4);">
                    6 m³'ten 15 m³'e kadar yükleme kapasitesi, euro palet uyumluluğu ve yüksek tavanlı geniş taşıma hacmi.
                </p>
                <div style="background-color: #f7f6f2; padding: 12px; border-radius: 4px; font-size: 0.85rem; color: #121822; font-weight: 600;">
                    Örnek Modeller: Ford Transit, Renault Master, Peugeot Boxer
                </div>
            </div>

            <!-- 3. Teknik Saha Filosu -->
            <div class="segment-tier-card" data-spotlight>
                <span class="segment-tier-badge" style="background-color: var(--color-orange);">Teknik Servis & Mobil Saha</span>
                <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: var(--space-2); color: #121822;">Özel Kasa & Raf Entegrasyonu</h3>
                <p style="font-size: 0.9rem; color: var(--color-text-muted); line-height: 1.6; margin-bottom: var(--space-4);">
                    Teknik ekipman ve alet taşımacılığı için raf sistemleri, kapalı kasa ve izolasyonlu taşıma opsiyonları.
                </p>
                <div style="background-color: #f7f6f2; padding: 12px; border-radius: 4px; font-size: 0.85rem; color: #121822; font-weight: 600;">
                    Saha odaklı özel donanım ve üst yapı çözümleri
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ─── 3. TİCARİ FİLO AVANTAJLARI ──────────────────────────────────── -->
<section class="section section-paper" data-reveal="fade-up">
    <div class="container">
        <div class="section-header text-center" style="max-width: 760px; margin: 0 auto var(--space-12);">
            <span class="editorial-tag">Neden KZY Ticari Filo?</span>
            <h2 style="font-size: clamp(2rem, 3vw, 2.6rem); font-weight: var(--font-weight-normal); margin-top: var(--space-2);">
                Kurumsal Ticari Filo Avantajları
            </h2>
        </div>

        <div class="solution-benefit-grid mb-16">
            <div class="solution-benefit-card" data-spotlight>
                <div class="solution-icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="1" y="3" width="15" height="13"></rect>
                        <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                        <circle cx="5.5" cy="18.5" r="2.5"></circle>
                        <circle cx="18.5" cy="18.5" r="2.5"></circle>
                    </svg>
                </div>
                <h3>Ağır Hizmet & Yüksek Dayanıklılık</h3>
                <p>Yoğun kilometre ve ağır yük koşulları için test edilmiş, dayanıklı dizel motor ve güçlendirilmiş süspansiyonlar.</p>
            </div>
            <div class="solution-benefit-card" data-spotlight>
                <div class="solution-icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="23 4 23 10 17 10"></polyline>
                        <path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path>
                    </svg>
                </div>
                <h3>Öncelikli Ticari İkame Desteği</h3>
                <p>Saha teslimatlarınızın aksamaması için ticari araç arızalarında ticari özellikli eşdeğer yedek araç önceliği.</p>
            </div>
            <div class="solution-benefit-card" data-spotlight>
                <div class="solution-icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="1" x2="12" y2="23"></line>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                </div>
                <h3>Tam KDV & Gider Avantajı</h3>
                <p>Ticari araç kiralamalarında aylık fatura KDV'sinin tamamını indirim konusu yapabilir ve gider kaydedebilirsiniz.</p>
            </div>
        </div>
    </div>
</section>

<!-- ─── 4. ÖNE ÇIKAN TİCARİ ARAÇLAR ─────────────────────────────────── -->
<section class="section section-ivory" data-reveal="fade-up">
    <div class="container">
        <div class="flex flex-between mb-8 flex-wrap gap-4 items-center">
            <div>
                <span class="editorial-tag">Ticari Portföy</span>
                <h2 style="font-size: clamp(1.8rem, 2.5vw, 2.4rem); font-weight: var(--font-weight-normal); margin-top: var(--space-1);">
                    Öne Çıkan Ticari Modeller
                </h2>
            </div>
            <a href="<?php echo url('araclar.php', ['kategori' => 'ticari']); ?>" class="btn btn-dark btn-sm">
                <span>Tüm Ticari Araçlar</span>
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </a>
        </div>

        <div class="catalog-grid mb-12">
            <?php foreach (array_slice($ticariVehicles, 0, 3) as $vehicle): ?>
                <?php include includePath('vehicle-card.php'); ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ─── 5. KURUMSAL CTA BANNER ──────────────────────────────────────── -->
<section class="section-sm" style="padding-top: 0;">
    <div class="container">
        <div class="solution-cta-card" style="background-image: url('<?php echo asset('images/cta-commercial-bg.jpg'); ?>');">
            <h3>Ticari Filonuzu Avantajlı Şartlarla Güçlendirin</h3>
            <p>Lojistik ve saha operasyonlarınız için bütçenize uygun hafif ticari filo teklifinizi bugün alın.</p>
            <div class="solution-cta-actions">
                <a href="<?php echo url('hizli-teklif.php'); ?>" class="btn btn-primary btn-lg"><?php e('header.get_quote'); ?></a>
                <button type="button" class="btn btn-outline btn-lg" data-open-modal="callback"><?php e('home.cta_call'); ?></button>
            </div>
        </div>
    </div>
</section>

<?php include includePath('footer.php'); ?>
