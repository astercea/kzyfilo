<?php
/**
 * kzyfilo — Araç İade Noktaları (arac-iade-noktalari.php)
 */
require_once __DIR__ . '/includes/config.php';

$locationsData = loadData('locations.php');
$returnPoints = $locationsData['return_points'] ?? [];

setPageMeta([
    'title' => t('return_points.title') . ' | ' . SITE_NAME,
    'description' => t('return_points.description'),
    'canonical' => canonical('arac-iade-noktalari.php'),
]);

$breadcrumbs = [
    ['title' => t('services.title'), 'url' => url('hizmetler.php')],
    ['title' => t('return_points.title')]
];

include includePath('header.php');
include includePath('breadcrumbs.php');
?>

<div class="page-header">
    <div class="container text-center">
        <h1><?php e('return_points.title'); ?></h1>
        <p>Sözleşme sonu ekspertiz ve araç teslim/iade lokasyonlarımız</p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="grid grid-2 gap-8 mb-12">
            <?php foreach ($returnPoints as $point): ?>
                <div class="card card-body flex flex-col justify-between">
                    <div>
                        <div class="flex flex-between items-start mb-3">
                            <h3 class="text-lg"><?php echo esc($point['name']); ?></h3>
                            <span class="badge badge-primary"><?php echo esc($point['city']); ?></span>
                        </div>

                        <div class="flex flex-col gap-2 text-sm text-muted mb-6">
                            <p class="mb-1"><strong>Adres:</strong> <?php echo esc($point['address']); ?></p>
                            <p class="mb-1"><strong>Telefon:</strong> <a href="tel:<?php e('topbar.phone_full'); ?>"><?php echo esc($point['phone']); ?></a></p>
                            <p class="mb-1"><strong>Kabul Saatleri:</strong> <?php echo esc($point['hours']); ?></p>
                            <p class="mb-0 text-success">✓ Uzman Ekspertiz Personeli Mevcut</p>
                        </div>
                    </div>

                    <a href="<?php echo url('online-islemler.php'); ?>" class="btn btn-outline btn-sm">
                        İade Randevusu Oluştur →
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php include includePath('footer.php'); ?>
