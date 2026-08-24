<?php
/**
 * kzyfilo — Ticari Araç Kiralama (ticari-arac-kiralama.php)
 */
require_once __DIR__ . '/includes/config.php';

$vehicles = loadData('vehicles.php');
$ticariVehicles = array_filter($vehicles, fn($v) => $v['category'] === 'ticari');

setPageMeta([
    'title' => t('solutions_menu.commercial_rental') . ' | ' . SITE_NAME,
    'description' => 'Hafif ticari, minivan ve panelvan kiralama çözümleri ile saha ve lojistik operasyonlarınızı güçlendirin.',
    'canonical' => canonical('ticari-arac-kiralama.php'),
]);

$breadcrumbs = [
    ['title' => t('services.title'), 'url' => url('hizmetler.php')],
    ['title' => t('solutions_menu.commercial_rental')]
];

include includePath('header.php');?>

<div class="service-hero">
    <div class="container">
        <div class="max-w-xl">
            <span class="hero-subtitle">İşletmenizin Güçlü Ortağı</span>
            <h1 class="text-4xl mb-4"><?php e('solutions_menu.commercial_rental'); ?></h1>
            <p class="text-lg text-muted mb-6">
                Yüksek taşıma kapasitesi, dayanıklı gövde yapıları ve avantajlı kiralama vadeleri ile lojistik, servis ve dağıtım filonuzu kurun.
            </p>
            <div class="flex gap-4">
                <a href="<?php echo url('araclar.php', ['kategori' => 'ticari']); ?>" class="btn btn-primary btn-lg"><?php e('home.hero_cta_vehicles'); ?></a>
                <a href="<?php echo url('hizli-teklif.php'); ?>" class="btn btn-outline btn-lg"><?php e('header.get_quote'); ?></a>
                    <?php include includePath('breadcrumbs.php'); ?>
    </div>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="flex flex-between mb-8">
            <h2 class="text-2xl">Öne Çıkan Ticari Araçlar</h2>
            <a href="<?php echo url('araclar.php', ['kategori' => 'ticari']); ?>" class="btn btn-outline btn-sm">Tüm Ticari Araçlar →</a>
        </div>

        <div class="grid grid-3 gap-6 mb-16">
            <?php foreach ($ticariVehicles as $vehicle): ?>
                <?php include includePath('vehicle-card.php'); ?>
            <?php endforeach; ?>
        </div>

        <div class="service-features">
            <div class="service-feature-card">
                <div class="service-feature-icon">📦</div>
                <h4 class="text-base mb-2">Geniş Yükleme Hacimleri</h4>
                <p class="text-sm text-muted">Kombi minivanlardan büyük panelvanlara kadar her türlü koli, palet ve teknik ekipman taşımasına uygun hacim seçenekleri.</p>
            </div>
            <div class="service-feature-card">
                <div class="service-feature-icon">🚚</div>
                <h4 class="text-base mb-2">Saha Dayanıklılığı & Düşük TCO</h4>
                <p class="text-sm text-muted">Yoğun kilometre yapan ticari filolar için tasarlanmış dayanıklı dizel motorlar ve ağır hizmet tipi süspansiyonlar.</p>
            </div>
            <div class="service-feature-card">
                <div class="service-feature-icon">🔄</div>
                <h4 class="text-base mb-2">Hızlı Ticari İkame Desteği</h4>
                <p class="text-sm text-muted">Saha operasyonlarınızın durmaması için ticari araç arızalarında ticari ikame araç önceliği.</p>
            </div>
        </div>
    </div>
</section>

<?php include includePath('footer.php'); ?>
