<?php
/**
 * kzyfilo — Ticari Araç Kiralama (ticari-arac-kiralama.php)
 */
require_once __DIR__ . '/includes/config.php';

$vehicles = loadData('vehicles.php');
$ticariVehicles = array_filter($vehicles, fn($v) => $v['category'] === 'ticari');

setPageMeta([
    'title' => t('solutions_menu.commercial_rental') . ' | ' . SITE_NAME,
    'description' => 'Hafif ticari, minivan ve panelvan kiralama çözümleri ile saha ve lojistik operasyonlarýnýzý güçlendirin.',
    'canonical' => canonical('ticari-arac-kiralama.php'),
]);

$breadcrumbs = [
    ['title' => t('services.title'), 'url' => url('hizmetler.php')],
    ['title' => t('solutions_menu.commercial_rental')]
];

include includePath('header.php');
?>

<div class="service-hero">
    <div class="container">
        <div class="max-w-xl">
            <span class="hero-subtitle">Ýþletmenizin Güçlü Ortaðý</span>
            <h1 class="text-4xl mb-4"><?php e('solutions_menu.commercial_rental'); ?></h1>
            <p class="text-lg text-muted mb-6">
                Yüksek taþýma kapasitesi, dayanýklý gövde yapýlarý ve avantajlý kiralama vadeleri ile lojistik, servis ve daðýtým filonuzu kurun.
            </p>
            <div class="flex gap-4">
                <a href="<?php echo url('araclar.php', ['kategori' => 'ticari']); ?>" class="btn btn-primary btn-lg"><?php e('home.hero_cta_vehicles'); ?></a>
                <a href="<?php echo url('hizli-teklif.php'); ?>" class="btn btn-outline btn-lg"><?php e('header.get_quote'); ?></a>
            </div>
        </div>

<?php include includePath('breadcrumbs.php'); ?>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="flex flex-between mb-8">
            <h2 class="text-2xl">Öne Çýkan Ticari Araçlar</h2>
            <a href="<?php echo url('araclar.php', ['kategori' => 'ticari']); ?>" class="btn btn-outline btn-sm">Tüm Ticari Araçlar ›</a>
        </div>

        <div class="grid grid-3 gap-6 mb-16">
            <?php foreach ($ticariVehicles as $vehicle): ?>
                <?php include includePath('vehicle-card.php'); ?>
            <?php endforeach; ?>
        </div>

        <div class="service-features">
            <div class="service-feature-card">
                <div class="service-feature-icon">??</div>
                <h4 class="text-base mb-2">Geniþ Yükleme Hacimleri</h4>
                <p class="text-sm text-muted">Kombi minivanlardan büyük panelvanlara kadar her türlü koli, palet ve teknik ekipman taþýmasýna uygun hacim seçenekleri.</p>
            </div>
            <div class="service-feature-card">
                <div class="service-feature-icon">??</div>
                <h4 class="text-base mb-2">Saha Dayanýklýlýðý & Düþük TCO</h4>
                <p class="text-sm text-muted">Yoðun kilometre yapan ticari filolar için tasarlanmýþ dayanýklý dizel motorlar ve aðýr hizmet tipi süspansiyonlar.</p>
            </div>
            <div class="service-feature-card">
                <div class="service-feature-icon">??</div>
                <h4 class="text-base mb-2">Hýzlý Ticari Ýkame Desteði</h4>
                <p class="text-sm text-muted">Saha operasyonlarýnýzýn durmamasý için ticari araç arýzalarýnda ticari ikame araç önceliði.</p>
            </div>
        </div>
    </div>
</section>

<?php include includePath('footer.php'); ?>
