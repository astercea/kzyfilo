<?php
/**
 * kzyfilo — Araç Karşılaştırma Sayfası (arac-karsilastir.php)
 * KZY Executive Motion — Redesigned Fleet Comparison System
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

<!-- ─── 1. PAGE HEADER ─────────────────────────────────────────────── -->
<div class="page-header">
    <div class="container">
        <h1><?php e('compare.title'); ?></h1>
        <?php include includePath('breadcrumbs.php'); ?>
    </div>
</div>

<!-- ─── 2. KARŞILAŞTIRMA MATRİSİ & ARAÇLAR ───────────────────────────── -->
<section class="section">
    <div class="container">
        
        <!-- ─── ÜST KONTROL & FİLTRE ÇUBUĞU ─────────────────────────────── -->
        <div class="compare-control-bar" id="compare-toolbar">
            <div class="compare-control-left">
                <label class="compare-diff-toggle-wrap" title="Sadece araçlar arasındaki farklılıkları renklendir">
                    <input type="checkbox" id="toggle-compare-diff" class="compare-diff-checkbox">
                    <span class="compare-diff-switch"></span>
                    <span class="compare-diff-label"><?php e('compare.highlight_diff'); ?></span>
                </label>
            </div>

            <div class="compare-control-right">
                <button type="button" class="btn btn-outline btn-sm" id="btn-open-picker">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    <span>+ <?php e('compare.add_vehicle'); ?></span>
                </button>

                <button type="button" class="btn btn-ghost btn-sm" id="btn-share-compare" title="Karşılaştırma Bağlantısını Kopyala">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><circle cx="18" cy="5" r="3"></circle><circle cx="6" cy="12" r="3"></circle><circle cx="18" cy="19" r="3"></circle><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line></svg>
                    <span>Paylaş</span>
                </button>

                <button type="button" class="btn btn-ghost btn-sm text-error" id="btn-clear-compare">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 4px;">
                        <polyline points="3 6 5 6 21 6"></polyline>
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    </svg>
                    <span><?php e('compare.clear_all'); ?></span>
                </button>
            </div>
        </div>

        <!-- ─── KARŞILAŞTIRMA TABLOSU ──────────────────────────────────── -->
        <div class="compare-table-wrapper" id="compare-table-wrapper" data-reveal="fade-up">
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

        <!-- ─── BOŞ DURUM (0 ARAÇ SEÇİLİ OLDUĞUNDA) ───────────────────── -->
        <div class="compare-empty-card hidden" id="compare-empty-state" data-reveal="fade-up">
            <div class="compare-empty-icon-wrap">
                <svg viewBox="0 0 24 24" width="36" height="36" fill="none" stroke="currentColor" stroke-width="1.8">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="3" y1="9" x2="21" y2="9"></line>
                    <line x1="9" y1="21" x2="9" y2="9"></line>
                </svg>
            </div>
            <h2 class="compare-empty-title"><?php e('compare.empty_title'); ?></h2>
            <p class="compare-empty-desc"><?php e('compare.empty_desc'); ?></p>
            
            <div class="compare-empty-actions">
                <a href="<?php echo url('araclar.php'); ?>" class="btn btn-primary btn-lg">
                    <span><?php e('compare.go_to_catalog'); ?></span>
                </a>
            </div>
        </div>

    </div>
</section>

<!-- ─── 3. HIZLI ARAÇ SEÇİM MODALI (POPUP) ──────────────────────────── -->
<div class="modal-backdrop" id="modal-vehicle-picker" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 820px; padding: 24px;">
        <div class="flex flex-between items-center mb-4">
            <div>
                <h3 style="margin: 0; font-size: 1.25rem; font-weight: 700; color: var(--color-navy-950);">Karşılaştırmaya Araç Ekle</h3>
                <p class="text-xs text-muted m-0">Katalogdan karşılaştırma tablosuna eklemek istediğiniz aracı seçin.</p>
            </div>
            <button type="button" class="btn btn-ghost btn-sm" id="btn-close-picker-modal" style="padding: 6px; border-radius: 50%;">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>

        <!-- Arama ve Kategori Filtresi -->
        <div class="flex gap-3 mb-4 flex-wrap">
            <div style="flex: 1; min-width: 220px; position: relative;">
                <input type="search" id="picker-search-input" class="form-input" placeholder="Marka veya model arayın..." style="padding-left: 36px; height: 40px; font-size: 0.9rem;">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" style="position: absolute; left: 12px; top: 12px; color: var(--color-text-muted);">
                    <circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </div>
            <div class="flex gap-2">
                <button type="button" class="btn btn-sm btn-outline picker-filter-btn is-active" data-cat="all">Tümü</button>
                <button type="button" class="btn btn-sm btn-outline picker-filter-btn" data-cat="binek">Binek</button>
                <button type="button" class="btn btn-sm btn-outline picker-filter-btn" data-cat="ticari">Ticari</button>
            </div>
        </div>

        <!-- Araç Kartları Izgarası -->
        <div class="picker-grid" id="picker-vehicles-grid">
            <!-- Populated via vehicle-compare.js -->
        </div>
    </div>
</div>

<script>
    window.allVehiclesData = <?php echo json_encode($vehicles); ?>;
</script>
<script src="<?php echo asset('js/vehicle-compare.js'); ?>"></script>

<?php include includePath('footer.php'); ?>
