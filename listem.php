<?php
/**
 * kzyfilo — Listem (Favori Araçlar) (listem.php)
 */
require_once __DIR__ . '/includes/config.php';

$vehicles = loadData('vehicles.php');

setPageMeta([
    'title' => t('my_list.title') . ' | ' . SITE_NAME,
    'description' => t('my_list.description'),
    'canonical' => canonical('listem.php'),
]);

$breadcrumbs = [
    ['title' => t('my_list.title')]
];

include includePath('header.php');
include includePath('breadcrumbs.php');
?>

<div class="page-header">
    <div class="container">
        <h1><?php e('my_list.title'); ?></h1>
        <p><?php e('my_list.description'); ?></p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="flex flex-between mb-8 flex-wrap gap-4">
            <div class="flex items-center gap-3">
                <a href="<?php echo url('araclar.php'); ?>" class="btn btn-outline btn-sm">
                    <?php echo (CURRENT_LANG === 'tr') ? '+ Yeni Araç Ekle' : '+ Add New Vehicle'; ?>
                </a>
                <a href="<?php echo url('arac-karsilastir.php'); ?>" class="btn btn-secondary btn-sm">
                    <?php e('my_list.compare_selected'); ?>
                </a>
            </div>

            <div class="flex items-center gap-3">
                <button type="button" class="btn btn-ghost btn-sm text-muted" id="btn-share-list">
                    <?php e('my_list.share_list'); ?>
                </button>
                <button type="button" class="btn btn-ghost btn-sm text-error" id="btn-clear-favorites">
                    <?php e('my_list.clear_all'); ?>
                </button>
            </div>
        </div>

        <!-- Dynamic Favorites Grid (Filled via vehicle-compare.js) -->
        <div class="vehicle-grid" id="favorites-vehicle-grid"></div>

        <!-- Empty State -->
        <div class="empty-state hidden" id="favorites-empty-state">
            <div class="empty-state-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                </svg>
            </div>
            <h3><?php e('my_list.empty_title'); ?></h3>
            <p><?php e('my_list.empty_desc'); ?></p>
            <a href="<?php echo url('araclar.php'); ?>" class="btn btn-primary">
                <?php e('my_list.go_to_catalog'); ?>
            </a>
        </div>
    </div>
</section>

<script>
    window.allVehiclesData = <?php echo json_encode($vehicles); ?>;
</script>
<script src="<?php echo asset('js/vehicle-compare.js'); ?>"></script>

<?php include includePath('footer.php'); ?>
