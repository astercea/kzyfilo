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
include includePath('breadcrumbs.php');
?>

<div class="service-hero">
    <div class="container">
        <div class="max-w-xl">
            <span class="hero-subtitle">Geleceğin Mobilite Vizyonu</span>
            <h1 class="text-4xl mb-4"><?php e('solutions_menu.electric_rental'); ?></h1>
            <p class="text-lg text-muted mb-6">
                Sıfır egzoz emisyonu, ultra sessiz sürüş ve %70'e varan yakıt/enerji tasarrufu ile şirketinizin yeşil filo dönüşümünü başlatın.
            </p>
            <div class="flex gap-4">
                <a href="<?php echo url('araclar.php', ['kategori' => 'elektrikli']); ?>" class="btn btn-primary btn-lg"><?php e('home.hero_cta_vehicles'); ?></a>
                <a href="<?php echo url('hizli-teklif.php'); ?>" class="btn btn-outline btn-lg"><?php e('header.get_quote'); ?></a>
            </div>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="flex flex-between mb-8">
            <h2 class="text-2xl">Öne Çıkan Elektrikli Araçlar</h2>
            <a href="<?php echo url('araclar.php', ['kategori' => 'elektrikli']); ?>" class="btn btn-outline btn-sm">Tüm Elektrikli Araçlar →</a>
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
