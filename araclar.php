<?php
/**
 * kzyfilo — Araç Kataloğu (araclar.php)
 */
require_once __DIR__ . '/includes/config.php';

// Verileri yükle
$vehicles = loadData('vehicles.php');

// URL query parametreleri
$selectedBrand = $_GET['marka'] ?? '';
$selectedBody = $_GET['kasa'] ?? '';
$selectedFuel = $_GET['yakit'] ?? '';
$selectedTransmission = $_GET['vites'] ?? '';
$selectedCategory = $_GET['kategori'] ?? '';
$maxPrice = $_GET['maks_fiyat'] ?? '';
$isCampaign = isset($_GET['kampanya']) && $_GET['kampanya'] === '1';
$isPremium = isset($_GET['premium']) && $_GET['premium'] === '1';
$isFastDelivery = isset($_GET['hizli_teslim']) && $_GET['hizli_teslim'] === '1';

// Sayfa meta bilgileri
setPageMeta([
    'title' => t('catalog.title') . ' | ' . SITE_NAME,
    'description' => t('catalog.description'),
    'canonical' => canonical('araclar.php'),
]);

$breadcrumbs = [
    ['title' => t('catalog.title')]
];

include includePath('header.php');
include includePath('breadcrumbs.php');
?>

<div class="page-header">
    <div class="container">
        <h1><?php e('catalog.title'); ?></h1>
        <p><?php e('catalog.description'); ?></p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="layout-sidebar">
            
            <!-- ─── DESKTOP FILTER SIDEBAR ─────────────────────────────── -->
            <aside class="catalog-sidebar">
                <form id="catalog-filter-form" class="card card-body">
                    <div class="flex flex-between mb-4">
                        <h3 class="text-base fw-bold"><?php e('catalog.filters'); ?></h3>
                        <button type="reset" class="btn btn-ghost btn-sm text-xs text-primary">
                            <?php e('catalog.clear_filters'); ?>
                        </button>
                    </div>

                    <!-- Kategori -->
                    <div class="filter-section">
                        <div class="filter-section-title"><?php e('catalog.category'); ?></div>
                        <select name="kategori" class="form-select">
                            <option value="all"><?php e('catalog.all'); ?></option>
                            <option value="binek" <?php echo ($selectedCategory === 'binek') ? 'selected' : ''; ?>><?php e('categories.binek'); ?></option>
                            <option value="ticari" <?php echo ($selectedCategory === 'ticari') ? 'selected' : ''; ?>><?php e('categories.ticari'); ?></option>
                            <option value="elektrikli" <?php echo ($selectedCategory === 'elektrikli') ? 'selected' : ''; ?>><?php e('categories.elektrikli'); ?></option>
                        </select>
                    </div>

                    <!-- Marka -->
                    <div class="filter-section">
                        <div class="filter-section-title"><?php e('catalog.brand'); ?></div>
                        <div class="filter-options">
                            <?php 
                            $brands = ['Renault', 'Fiat', 'Toyota', 'Hyundai', 'BMW', 'MG', 'Ford', 'Volkswagen'];
                            foreach ($brands as $b):
                                $checked = ($selectedBrand === $b);
                            ?>
                            <label class="form-check">
                                <input type="checkbox" name="marka[]" value="<?php echo esc($b); ?>" <?php echo $checked ? 'checked' : ''; ?>>
                                <span class="form-check-label"><?php echo esc($b); ?></span>
                            </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Kasa Tipi -->
                    <div class="filter-section">
                        <div class="filter-section-title"><?php e('catalog.body_type'); ?></div>
                        <div class="filter-options">
                            <?php 
                            $bodies = ['sedan' => 'Sedan', 'hatchback' => 'Hatchback', 'suv' => 'SUV', 'minivan' => 'Minivan', 'panelvan' => 'Panelvan'];
                            foreach ($bodies as $key => $name):
                                $checked = ($selectedBody === $key);
                            ?>
                            <label class="form-check">
                                <input type="checkbox" name="kasa[]" value="<?php echo esc($key); ?>" <?php echo $checked ? 'checked' : ''; ?>>
                                <span class="form-check-label"><?php echo esc($name); ?></span>
                            </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Yakıt Tipi -->
                    <div class="filter-section">
                        <div class="filter-section-title"><?php e('catalog.fuel'); ?></div>
                        <div class="filter-options">
                            <?php 
                            $fuels = ['benzin' => 'Benzin', 'dizel' => 'Dizel', 'hibrit' => 'Hibrit', 'elektrik' => 'Elektrik'];
                            foreach ($fuels as $key => $name):
                                $checked = ($selectedFuel === $key);
                            ?>
                            <label class="form-check">
                                <input type="checkbox" name="yakit[]" value="<?php echo esc($key); ?>" <?php echo $checked ? 'checked' : ''; ?>>
                                <span class="form-check-label"><?php echo esc($name); ?></span>
                            </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Vites Tipi -->
                    <div class="filter-section">
                        <div class="filter-section-title"><?php e('catalog.transmission'); ?></div>
                        <div class="filter-options">
                            <?php 
                            $transmissions = ['otomatik' => 'Otomatik', 'manuel' => 'Manuel'];
                            foreach ($transmissions as $key => $name):
                                $checked = ($selectedTransmission === $key);
                            ?>
                            <label class="form-check">
                                <input type="checkbox" name="vites[]" value="<?php echo esc($key); ?>" <?php echo $checked ? 'checked' : ''; ?>>
                                <span class="form-check-label"><?php echo esc($name); ?></span>
                            </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Fiyat Aralığı -->
                    <div class="filter-section">
                        <div class="filter-section-title"><?php e('catalog.price_range'); ?></div>
                        <div class="grid grid-2 gap-2">
                            <input type="number" name="min_fiyat" class="form-input" placeholder="Min ₺" min="0" step="1000">
                            <input type="number" name="maks_fiyat" class="form-input" placeholder="Maks ₺" value="<?php echo esc($maxPrice); ?>" min="0" step="1000">
                        </div>
                    </div>

                    <!-- Özel Filtreler -->
                    <div class="filter-section">
                        <div class="filter-section-title"><?php echo (CURRENT_LANG === 'tr') ? 'Özel Seçenekler' : 'Special Filters'; ?></div>
                        <div class="filter-options">
                            <label class="form-check">
                                <input type="checkbox" name="kampanya" value="1" <?php echo $isCampaign ? 'checked' : ''; ?>>
                                <span class="form-check-label"><?php e('catalog.campaign_only'); ?></span>
                            </label>
                            <label class="form-check">
                                <input type="checkbox" name="premium" value="1" <?php echo $isPremium ? 'checked' : ''; ?>>
                                <span class="form-check-label"><?php e('catalog.premium_only'); ?></span>
                            </label>
                            <label class="form-check">
                                <input type="checkbox" name="hizli_teslim" value="1" <?php echo $isFastDelivery ? 'checked' : ''; ?>>
                                <span class="form-check-label"><?php e('catalog.fast_delivery_only'); ?></span>
                            </label>
                        </div>
                    </div>
                </form>
            </aside>

            <!-- ─── VEHICLE RESULTS MAIN ───────────────────────────────── -->
            <main class="catalog-main">
                <!-- Toolbar -->
                <div class="catalog-toolbar">
                    <div class="catalog-count">
                        <strong><span id="catalog-count-number"><?php echo count($vehicles); ?></span></strong> <?php echo (CURRENT_LANG === 'tr') ? 'araç listeleniyor' : 'vehicles listed'; ?>
                    </div>

                    <div class="flex items-center gap-3">
                        <!-- Mobile Filter Drawer Trigger -->
                        <button type="button" class="btn btn-secondary btn-sm flex items-center gap-2" id="catalog-drawer-trigger">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="4" y1="21" x2="4" y2="14"></line>
                                <line x1="4" y1="10" x2="4" y2="3"></line>
                                <line x1="12" y1="21" x2="12" y2="12"></line>
                                <line x1="12" y1="8" x2="12" y2="3"></line>
                                <line x1="20" y1="21" x2="20" y2="16"></line>
                                <line x1="20" y1="12" x2="20" y2="3"></line>
                                <line x1="1" y1="14" x2="7" y2="14"></line>
                                <line x1="9" y1="8" x2="15" y2="8"></line>
                                <line x1="17" y1="16" x2="23" y2="16"></line>
                            </svg>
                            <span><?php e('catalog.filters'); ?></span>
                        </button>

                        <div class="catalog-sort">
                            <label for="catalog-sort-select"><?php e('catalog.sort_by'); ?>:</label>
                            <select id="catalog-sort-select" class="form-select" style="min-width: 180px;">
                                <option value="recommended"><?php e('catalog.sort_recommended'); ?></option>
                                <option value="price_asc"><?php e('catalog.sort_price_asc'); ?></option>
                                <option value="price_desc"><?php e('catalog.sort_price_desc'); ?></option>
                                <option value="brand_az"><?php e('catalog.sort_brand_az'); ?></option>
                                <option value="newest"><?php e('catalog.sort_newest'); ?></option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Active Filter Tags -->
                <div class="active-filters" id="catalog-active-filters"></div>

                <!-- Vehicles Grid -->
                <div class="vehicle-grid" id="catalog-vehicle-grid">
                    <?php foreach ($vehicles as $vehicle): ?>
                        <?php include includePath('vehicle-card.php'); ?>
                    <?php endforeach; ?>
                </div>

                <!-- Empty State -->
                <div class="empty-state hidden" id="catalog-empty-state">
                    <div class="empty-state-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </div>
                    <h3><?php e('catalog.no_results'); ?></h3>
                    <p><?php e('catalog.no_results_desc'); ?></p>
                    <a href="<?php echo url('araclar.php'); ?>" class="btn btn-primary">
                        <?php e('catalog.show_all'); ?>
                    </a>
                </div>
            </main>
        </div>
    </div>
</section>

<!-- ─── MOBILE FILTER DRAWER ───────────────────────────────────────── -->
<div class="filter-drawer-backdrop" id="catalog-drawer-backdrop" aria-hidden="true"></div>
<div class="filter-drawer" id="catalog-filter-drawer" role="dialog" aria-modal="true" aria-label="Filtreleme Menüsü" aria-hidden="true">
    <div class="filter-drawer-header">
        <h3><?php e('catalog.filters'); ?></h3>
        <button type="button" class="modal-close" id="catalog-drawer-close" aria-label="<?php e('btn.close'); ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
    </div>
    <form id="catalog-mobile-filter-form">
        <!-- Replicates the same filter fields for mobile viewport -->
        <div class="filter-section">
            <div class="filter-section-title"><?php e('catalog.category'); ?></div>
            <select name="kategori" class="form-select">
                <option value="all"><?php e('catalog.all'); ?></option>
                <option value="binek" <?php echo ($selectedCategory === 'binek') ? 'selected' : ''; ?>><?php e('categories.binek'); ?></option>
                <option value="ticari" <?php echo ($selectedCategory === 'ticari') ? 'selected' : ''; ?>><?php e('categories.ticari'); ?></option>
                <option value="elektrikli" <?php echo ($selectedCategory === 'elektrikli') ? 'selected' : ''; ?>><?php e('categories.elektrikli'); ?></option>
            </select>
        </div>

        <div class="filter-section">
            <div class="filter-section-title"><?php e('catalog.brand'); ?></div>
            <div class="filter-options">
                <?php foreach (['Renault', 'Fiat', 'Toyota', 'Hyundai', 'BMW', 'MG', 'Ford', 'Volkswagen'] as $b): ?>
                <label class="form-check">
                    <input type="checkbox" name="marka[]" value="<?php echo esc($b); ?>">
                    <span class="form-check-label"><?php echo esc($b); ?></span>
                </label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="filter-section">
            <div class="filter-section-title"><?php e('catalog.fuel'); ?></div>
            <div class="filter-options">
                <?php foreach (['benzin' => 'Benzin', 'dizel' => 'Dizel', 'hibrit' => 'Hibrit', 'elektrik' => 'Elektrik'] as $k => $v): ?>
                <label class="form-check">
                    <input type="checkbox" name="yakit[]" value="<?php echo esc($k); ?>">
                    <span class="form-check-label"><?php echo esc($v); ?></span>
                </label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="mt-6 flex flex-col gap-3">
            <button type="button" class="btn btn-primary" id="catalog-mobile-apply-btn" onclick="document.getElementById('catalog-drawer-close').click();">
                <?php e('catalog.filter'); ?>
            </button>
            <button type="reset" class="btn btn-secondary">
                <?php e('catalog.clear_filters'); ?>
            </button>
        </div>
    </form>
</div>

<script src="<?php echo asset('js/catalog.js'); ?>"></script>

<?php include includePath('footer.php'); ?>
