<?php
/**
 * kzyfilo — Araç Karşılaştırma Sayfası (arac-karsilastir.php)
 */
require_once __DIR__ . '/includes/config.php';

$vehicles = loadData('vehicles.php');

setPageMeta([
    'title' => t('compare.title') . ' | ' . SITE_NAME,
    'description' => t('compare.description'),
    'canonical' => canonical('arac-karsilastir.php'),
]);

$breadcrumbs = [
    ['title' => t('catalog.title'), 'url' => url('araclar.php')],
    ['title' => t('compare.title')]
];

include includePath('header.php');?>

<div class="page-header">
    <div class="container">
        <h1><?php e('compare.title'); ?></h1>
        <?php include includePath('breadcrumbs.php'); ?>
    </div>
</div>

<section class="section">
    <div class="container">
        <!-- ─── TOP TOOLBAR ────────────────────────────────────────────── -->
        <div class="flex flex-between mb-6 flex-wrap gap-4 items-center" id="compare-toolbar">
            <div class="flex items-center gap-4">
                <label class="form-check" style="cursor: pointer; margin-bottom: 0;">
                    <input type="checkbox" id="toggle-compare-diff">
                    <span class="text-sm fw-semibold text-dark"><?php e('compare.highlight_diff'); ?></span>
                </label>

                <span class="badge badge-primary" id="compare-count-badge">0 / 4 Araç</span>
            </div>

            <div class="flex items-center gap-3">
                <button type="button" class="btn btn-ghost btn-sm text-error" id="btn-clear-compare">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 4px;">
                        <polyline points="3 6 5 6 21 6"></polyline>
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    </svg>
                    <span><?php e('compare.clear_all'); ?></span>
                </button>

                <a href="<?php echo url('araclar.php'); ?>" class="btn btn-outline btn-sm" id="btn-add-more-compare">
                    + <?php e('compare.add_vehicle'); ?>
                </a>
            </div>
        </div>

        <!-- ─── COMPARISON TABLE CONTAINER ─────────────────────────────── -->
        <div class="card compare-table-wrapper" id="compare-table-wrapper">
            <table class="compare-table" id="compare-table">
                <thead>
                    <tr id="compare-table-head-row">
                        <!-- Filled dynamically by vehicle-compare.js -->
                    </tr>
                </thead>
                <tbody id="compare-table-body">
                    <!-- Filled dynamically by vehicle-compare.js -->
                </tbody>
            </table>
        </div>

        <!-- ─── EMPTY STATE (0 VEHICLES) ───────────────────────────────── -->
        <div class="empty-state hidden" id="compare-empty-state">
            <div class="empty-state-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="20" x2="18" y2="10"></line>
                    <line x1="12" y1="20" x2="12" y2="4"></line>
                    <line x1="6" y1="20" x2="6" y2="14"></line>
                </svg>
            </div>
            <h3><?php e('compare.empty_title'); ?></h3>
            <p><?php e('compare.empty_desc'); ?></p>
            <a href="<?php echo url('araclar.php'); ?>" class="btn btn-primary btn-lg">
                <?php e('compare.go_to_catalog'); ?>
            </a>
        </div>
    </div>
</section>

<script>
    window.allVehiclesData = <?php echo json_encode($vehicles); ?>;
</script>
<script src="<?php echo asset('js/vehicle-compare.js'); ?>"></script>

<?php include includePath('footer.php'); ?>
