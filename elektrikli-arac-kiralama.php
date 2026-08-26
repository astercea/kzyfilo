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

include includePath('header.php');?>

<div class="page-header">
    <div class="container">
        <h1><?php e('solutions_menu.electric_rental'); ?></h1>
        <?php include includePath('breadcrumbs.php'); ?>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="flex flex-between mb-8">
            <h2 class="text-2xl">Öne Çıkan Elektrikli Araçlar</h2>
            <a href="<?php echo url('araclar.php', ['kategori' => 'elektrikli']); ?>" class="btn btn-outline btn-sm">Tüm Elektrikli Araçlar</a>
        </div>

        <div class="grid grid-3 gap-6 mb-16">
            <?php foreach ($evVehicles as $vehicle): ?>
                <?php include includePath('vehicle-card.php'); ?>
            <?php endforeach; ?>
        </div>

        <div class="service-features">
            <div class="service-feature-card">
                <div class="service-feature-icon">🌱</div>
                <h4 class="text-base mb-2">Kurumsal Sürdürülebilirlik & ESG</h4>
                <p class="text-sm text-muted">Şirketinizin karbon ayak izini azaltın, yeşil mutabakat ve uluslararası sürdürülebilirlik raporlarında öne geçin.</p>
            </div>
            <div class="service-feature-card">
                <div class="service-feature-icon">🔋</div>
                <h4 class="text-base mb-2">Şarj İstasyonu Danışmanlığı</h4>
                <p class="text-sm text-muted">Şirket genel merkeziniz veya otoparklarınız için kurumsal AC/DC şarj altyapısı çözümleri.</p>
            </div>
            <div class="service-feature-card">
                <div class="service-feature-icon">💡</div>
                <h4 class="text-base mb-2">Düşük Bakım ve Enerji Gideri</h4>
                <p class="text-sm text-muted">Elektrik motorlarının basit mekanik yapısı sayesinde düşük periyodik bakım maliyetleri ve ekonomik kilometre başı maliyet.</p>
            </div>
        </div>
    </div>
</section>

<?php include includePath('footer.php'); ?>
