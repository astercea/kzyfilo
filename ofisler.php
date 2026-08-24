<?php
/**
 * kzyfilo — Ofislerimiz (ofisler.php)
 */
require_once __DIR__ . '/includes/config.php';

$locationsData = loadData('locations.php');
$offices = $locationsData['offices'] ?? [];

setPageMeta([
    'title' => t('offices.title') . ' | ' . SITE_NAME,
    'description' => t('offices.description'),
    'canonical' => canonical('ofisler.php'),
]);

$breadcrumbs = [
    ['title' => t('offices.title')]
];

include includePath('header.php');?>

<div class="page-header">
    <div class="container">
        <h1><?php e('offices.title'); ?></h1>
        <?php include includePath('breadcrumbs.php'); ?>
    </div>
</div>

<section class="section">
    <div class="container">
        <!-- Ofis Kartları -->
        <div class="grid grid-2 gap-8 mb-12">
            <?php foreach ($offices as $office): ?>
                <div class="card card-body flex flex-col justify-between">
                    <div>
                        <div class="flex flex-between items-start mb-3">
                            <h3 class="text-xl"><?php echo esc($office['name']); ?></h3>
                            <?php if (!empty($office['is_headquarters'])): ?>
                                <span class="badge badge-primary">Genel Müdürlük</span>
                            <?php else: ?>
                                <span class="badge badge-light"><?php echo esc($office['city']); ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="flex flex-col gap-3 text-sm text-muted mb-6">
                            <div class="flex gap-2 items-start">
                                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary flex-shrink-0" style="margin-top: 2px;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                <span><?php echo esc($office['address']); ?></span>
                            </div>

                            <div class="flex gap-2 items-center">
                                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary flex-shrink-0"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                                <a href="tel:<?php echo preg_replace('/\s+/', '', $office['phone']); ?>" class="text-dark fw-bold"><?php echo esc($office['phone']); ?></a>
                                <span>(Mobil: <?php echo esc($office['mobile']); ?>)</span>
                            </div>

                            <div class="flex gap-2 items-center">
                                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary flex-shrink-0"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                <span><?php echo esc($office['hours']); ?></span>
                            </div>
                        </div>

                        <div class="flex gap-2 flex-wrap mb-6">
                            <?php foreach ($office['services'] as $srv): ?>
                                <span class="badge badge-light text-xs">• <?php echo esc($srv); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <a href="https://maps.google.com/?q=<?php echo urlencode($office['address']); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-outline btn-sm">
                        <?php e('btn.get_directions'); ?> ↗
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php include includePath('footer.php'); ?>
