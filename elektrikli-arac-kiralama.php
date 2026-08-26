<?php
/**
 * kzyfilo — Elektrikli Araç Kiralama (elektrikli-arac-kiralama.php)
 * KZY Executive Electric Fleet Solutions
 */
require_once __DIR__ . '/includes/config.php';

$vehicles = loadData('vehicles.php');
$evVehicles = array_filter($vehicles, fn($v) => ($v['fuel'] ?? '') === 'elektrik' || ($v['category'] ?? '') === 'elektrikli');

if (empty($evVehicles)) {
    $evVehicles = array_slice($vehicles, 0, 3);
}

setPageMeta([
    'title' => t('solutions_menu.electric_rental') . ' | ' . SITE_NAME,
    'description' => 'Şirketiniz için sıfır emisyonlu, yüksek tasarruflu elektrikli filo kiralama ve uçtan uca şarj altyapısı çözümleri.',
    'canonical' => canonical('elektrikli-arac-kiralama.php'),
]);

$breadcrumbs = [
    ['title' => t('services.title'), 'url' => url('hizmetler.php')],
    ['title' => t('solutions_menu.electric_rental')]
];

include includePath('header.php');?>

<!-- ─── 1. PAGE HEADER ─────────────────────────────────────────────── -->
<div class="page-header">
    <div class="container">
        <h1><?php e('solutions_menu.electric_rental'); ?></h1>
        <?php include includePath('breadcrumbs.php'); ?>
    </div>
</div>

<!-- ─── 2. ESG & YEŞİL FİLO VİZYONU ──────────────────────────────────── -->
<section class="section section-ivory" data-reveal="fade-up">
    <div class="container">
        <div class="section-header text-center" style="max-width: 760px; margin: 0 auto var(--space-12);">
            <span class="editorial-tag">Sürdürülebilir Mobilite</span>
            <h2 style="font-size: clamp(2.2rem, 3.5vw, 3rem); font-weight: var(--font-weight-normal); margin-top: var(--space-2); margin-bottom: var(--space-3);">
                Geleceğin Elektrikli Filo Çözümleri
            </h2>
            <p style="font-size: 1.05rem; color: var(--color-text-muted); line-height: 1.65;">
                Şirketinizin karbon ayak izini sıfırlarken, %70'e varan enerji tasarrufu ve üstün sessiz sürüş konforuyla filonuzu geleceğe taşıyın.
            </p>
        </div>

        <div class="solution-benefit-grid mb-16">
            <!-- 1. ESG -->
            <div class="solution-benefit-card" data-spotlight>
                <div class="solution-icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2a10 10 0 0 1 10 10c0 5.52-4.48 10-10 10S2 17.52 2 12A10 10 0 0 1 12 2z"></path>
                        <path d="M12 6v6l4 2"></path>
                    </svg>
                </div>
                <h3>Kurumsal ESG & Yeşil Mutabakat</h3>
                <p>Uluslararası sürdürülebilirlik kriterlerine uyum sağlayın; şirketinizin yıllık karbon emisyon raporlarında somut düşüş elde edin.</p>
            </div>

            <!-- 2. %70 Enerji Tasarrufu -->
            <div class="solution-benefit-card" data-spotlight>
                <div class="solution-icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                    </svg>
                </div>
                <h3>%70'e Varan Yakıt Tasarrufu</h3>
                <p>Geleneksel fosil yakıtlara kıyasla kilometre başına enerji maliyetlerinizi dramatik şekilde düşürün ve operasyon kârınızı artırın.</p>
            </div>

            <!-- 3. Düşük Bakım -->
            <div class="solution-benefit-card" data-spotlight>
                <div class="solution-icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
                    </svg>
                </div>
                <h3>Minimum Mekanik Aşınma</h3>
                <p>İçten yanmalı motorlara kıyasla motor yağı, triger kayışı ve şanzıman gibi aşınan parçalar bulunmadığından servis süreleri kısalır.</p>
            </div>
        </div>
    </div>
</section>

<!-- ─── 3. ÖNE ÇIKAN ELEKTRİKLİ ARAÇLAR ─────────────────────────────── -->
<section class="section section-paper" data-reveal="fade-up">
    <div class="container">
        <div class="flex flex-between mb-8 flex-wrap gap-4 items-center">
            <div>
                <span class="editorial-tag">Yeni Nesil Filo</span>
                <h2 style="font-size: clamp(1.8rem, 2.5vw, 2.4rem); font-weight: var(--font-weight-normal); margin-top: var(--space-1);">
                    Öne Çıkan Elektrikli Araçlar
                </h2>
            </div>
            <a href="<?php echo url('araclar.php', ['kategori' => 'elektrikli']); ?>" class="btn btn-dark btn-sm">
                <span>Tüm Elektrikli Araçlar</span>
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </a>
        </div>

        <div class="catalog-grid mb-12">
            <?php foreach (array_slice($evVehicles, 0, 3) as $vehicle): ?>
                <?php include includePath('vehicle-card.php'); ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ─── 4. ŞARJ ALTYAPISI & ENERJİ ENTEGRASYONU ───────────────────────── -->
<section class="section section-ivory" data-reveal="fade-up">
    <div class="container">
        <div class="section-header text-center" style="max-width: 740px; margin: 0 auto var(--space-12);">
            <span class="editorial-tag">Uçtan Uca Destek</span>
            <h2 style="font-size: clamp(2rem, 3vw, 2.6rem); font-weight: var(--font-weight-normal); margin-top: var(--space-2);">
                Kurumsal Şarj Altyapısı ve Enerji Yönetimi
            </h2>
            <p style="color: var(--color-text-muted); font-size: 1.05rem;">
                Sadece araç temini değil; şirket merkeziniz, şubeleriniz ve sürücüleriniz için komple şarj ekosistemi sağlıyoruz.
            </p>
        </div>

        <div class="solution-benefit-grid mb-16">
            <div class="solution-benefit-card" data-spotlight>
                <div class="solution-icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                        <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                    </svg>
                </div>
                <h3>AC/DC Otopark Şarj İstasyonları</h3>
                <p>Şirket otoparkınıza özel keşif, projelendirme ve 22kW AC veya yüksek hızlı DC şarj ünitelerinin kurulumu.</p>
            </div>
            <div class="solution-benefit-card" data-spotlight>
                <div class="solution-icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                        <line x1="1" y1="10" x2="23" y2="10"></line>
                    </svg>
                </div>
                <h3>Tek Kartla Tüm Türkiye'de Şarj</h3>
                <p>Anlaşmalı tüm halka açık şarj operatörlerinde geçerli kurumsal RFID kart ve merkezi aylık faturalama kolaylığı.</p>
            </div>
            <div class="solution-benefit-card" data-spotlight>
                <div class="solution-icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 20V10"></path>
                        <path d="M12 20V4"></path>
                        <path d="M6 20v-6"></path>
                    </svg>
                </div>
                <h3>Telematik Batarya & Rota Analizi</h3>
                <p>Gerçek zamanlı batarya doluluk oranları, menzil tahminleme ve enerji tüketim raporlaması.</p>
            </div>
        </div>
    </div>
</section>

<!-- ─── 5. KURUMSAL CTA BANNER ──────────────────────────────────────── -->
<section class="section-sm" style="padding-top: 0;">
    <div class="container">
        <div class="solution-cta-card" style="background-image: url('<?php echo asset('images/cta-electric-bg.jpg'); ?>');">
            <h3>Yeşil Filo Dönüşümünüzü Bugün Başlatın</h3>
            <p>Şirketinizin karbon ayak izini düşürmek ve elektrikli araç avantajlarından yararlanmak için uzmanlarımızla görüşün.</p>
            <div class="solution-cta-actions">
                <a href="<?php echo url('hizli-teklif.php'); ?>" class="btn btn-primary btn-lg"><?php e('header.get_quote'); ?></a>
                <button type="button" class="btn btn-outline btn-lg" data-open-modal="callback"><?php e('home.cta_call'); ?></button>
            </div>
        </div>
    </div>
</section>

<?php include includePath('footer.php'); ?>
