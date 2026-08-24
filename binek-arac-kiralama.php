<?php
/**
 * kzyfilo — Binek Araç Kiralama (binek-arac-kiralama.php)
 */
require_once __DIR__ . '/includes/config.php';

$vehicles = loadData('vehicles.php');
$binekVehicles = array_filter($vehicles, fn($v) => $v['category'] === 'binek');

setPageMeta([
    'title' => t('solutions_menu.passenger_rental') . ' | ' . SITE_NAME,
    'description' => 'Şirketiniz için sedan, hatchback ve SUV binek araç kiralama çözümleri.',
    'canonical' => canonical('binek-arac-kiralama.php'),
]);

$breadcrumbs = [
    ['title' => t('services.title'), 'url' => url('hizmetler.php')],
    ['title' => t('solutions_menu.passenger_rental')]
];

include includePath('header.php');?>

<div class="service-hero">
    <div class="container">
        <div class="max-w-xl">
            <span class="hero-subtitle"><?php e('site_name'); ?> Binek Filo</span>
            <h1 class="text-4xl mb-4"><?php e('solutions_menu.passenger_rental'); ?></h1>
            <p class="text-lg text-muted mb-6">
                Ekonomik hatchback modellerden üst segment yönetici sedan ve SUV araçlarına kadar zengin binek araç seçenekleri.
            </p>
            <div class="flex gap-4">
                <a href="<?php echo url('araclar.php', ['kategori' => 'binek']); ?>" class="btn btn-primary btn-lg"><?php e('home.hero_cta_vehicles'); ?></a>
                <a href="<?php echo url('hizli-teklif.php'); ?>" class="btn btn-outline btn-lg"><?php e('header.get_quote'); ?></a>
                    <?php include includePath('breadcrumbs.php'); ?>
    </div>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="flex flex-between mb-8">
            <h2 class="text-2xl">Öne Çıkan Binek Araçlar</h2>
            <a href="<?php echo url('araclar.php', ['kategori' => 'binek']); ?>" class="btn btn-outline btn-sm">Tüm Binek Araçlar</a>
        </div>

        <div class="grid grid-3 gap-6 mb-16">
            <?php foreach (array_slice($binekVehicles, 0, 3) as $vehicle): ?>
                <?php include includePath('vehicle-card.php'); ?>
            <?php endforeach; ?>
        </div>

        <div class="service-features">
            <div class="service-feature-card">
                <div class="service-feature-icon">🌟</div>
                <h4 class="text-base mb-2">Her İhtiyaca Uygun Segmentler</h4>
                <p class="text-sm text-muted">Saha çalışanları için ekonomik B segmenti, orta kademe için C segmenti, yöneticiler için D ve Premium segmentler.</p>
            </div>
            <div class="service-feature-card">
                <div class="service-feature-icon">🛡️</div>
                <h4 class="text-base mb-2">Güvenlik ve Konfor Standartları</h4>
                <p class="text-sm text-muted">Tüm binek filomuz gelişmiş sürüş destek sistemleri, Apple CarPlay/Android Auto ve modern güvenlik donanımlarıyla gelir.</p>
            </div>
            <div class="service-feature-card">
                <div class="service-feature-icon">⚡</div>
                <h4 class="text-base mb-2">Düşük Yakıt Tüketimi</h4>
                <p class="text-sm text-muted">Yeni nesil Euro 6D motorlar ve hibrit seçeneklerle şirketinizin yakıt giderlerini asgariye indirin.</p>
            </div>
        </div>
    </div>
</section>

<?php include includePath('footer.php'); ?>
