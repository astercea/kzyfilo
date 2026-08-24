<?php
/**
 * kzyfilo — Elektrikli Araç Kiralama (elektrikli-arac-kiralama.php)
 */
require_once __DIR__ . '/includes/config.php';

$vehicles = loadData('vehicles.php');
$evVehicles = array_filter($vehicles, fn($v) => $v['category'] === 'elektrikli');

setPageMeta([
    'title' => t('solutions_menu.electric_rental') . ' | ' . SITE_NAME,
    'description' => 'Sürdürülebilir, çevreci ve yüksek verimli elektrikli araç filosu kiralama çözümleri.',
    'canonical' => canonical('elektrikli-arac-kiralama.php'),
]);

$breadcrumbs = [
    ['title' => t('services.title'), 'url' => url('hizmetler.php')],
    ['title' => t('solutions_menu.electric_rental')]
];

include includePath('header.php');
?>

<div class="service-hero">
    <div class="container">
        <div class="max-w-xl">
            <span class="hero-subtitle">Geleceðin Mobilite Vizyonu</span>
            <h1 class="text-4xl mb-4"><?php e('solutions_menu.electric_rental'); ?></h1>
            <p class="text-lg text-muted mb-6">
                Sýfýr egzoz emisyonu, ultra sessiz sürüþ ve %70'e varan yakýt/enerji tasarrufu ile þirketinizin yeþil filo dönüþümünü baþlatýn.
            </p>
            <div class="flex gap-4">
                <a href="<?php echo url('araclar.php', ['kategori' => 'elektrikli']); ?>" class="btn btn-primary btn-lg"><?php e('home.hero_cta_vehicles'); ?></a>
                <a href="<?php echo url('hizli-teklif.php'); ?>" class="btn btn-outline btn-lg"><?php e('header.get_quote'); ?></a>
            </div>
        </div>

<?php include includePath('breadcrumbs.php'); ?>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="flex flex-between mb-8">
            <h2 class="text-2xl">Öne Çýkan Elektrikli Araçlar</h2>
            <a href="<?php echo url('araclar.php', ['kategori' => 'elektrikli']); ?>" class="btn btn-outline btn-sm">Tüm Elektrikli Araçlar ›</a>
        </div>

        <div class="grid grid-3 gap-6 mb-16">
            <?php foreach ($evVehicles as $vehicle): ?>
                <?php include includePath('vehicle-card.php'); ?>
            <?php endforeach; ?>
        </div>

        <div class="service-features">
            <div class="service-feature-card">
                <div class="service-feature-icon">??</div>
                <h4 class="text-base mb-2">Kurumsal Sürdürülebilirlik & ESG</h4>
                <p class="text-sm text-muted">Þirketinizin karbon ayak izini azaltýn, yeþil mutabakat ve uluslararasý sürdürülebilirlik raporlarýnda öne geçin.</p>
            </div>
            <div class="service-feature-card">
                <div class="service-feature-icon">??</div>
                <h4 class="text-base mb-2">Þarj Ýstasyonu Danýþmanlýðý</h4>
                <p class="text-sm text-muted">Þirket genel merkeziniz veya otoparklarýnýz için kurumsal AC/DC þarj altyapýsý çözümleri.</p>
            </div>
            <div class="service-feature-card">
                <div class="service-feature-icon">??</div>
                <h4 class="text-base mb-2">Düþük Bakým ve Enerji Gideri</h4>
                <p class="text-sm text-muted">Elektrik motorlarýnýn basit mekanik yapýsý sayesinde düþük periyodik bakým maliyetleri ve ekonomik kilometre baþý maliyet.</p>
            </div>
        </div>
    </div>
</section>

<?php include includePath('footer.php'); ?>
