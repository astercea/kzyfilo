<?php
/**
 * kzyfilo — Araç Kataloğu (araclar.php)
 * KZY Executive Motion — Premium Kurumsal Araç Kataloğu
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
?>

<!-- ─── PAGE HEADER & FAST CATEGORY BAR ───────────────────────────── -->
<div class="page-header">
    <div class="container">
        <h1><?php e('catalog.title'); ?></h1>
        <?php include includePath('breadcrumbs.php'); ?>
    </div>
</div>

<!-- ─── MAIN CATALOG SECTION ──────────────────────────────────────── -->
<section class="section catalog-section">
    <div class="container">
        <div class="catalog-layout">
            
            <!-- ─── DESKTOP FILTER SIDEBAR ─────────────────────────────── -->
            <aside class="catalog-sidebar">
                <div class="catalog-filter-card">
                    <div class="catalog-filter-header">
                        <div class="catalog-filter-header-left">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
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
                            <h3><?php e('catalog.filters'); ?></h3>
                        </div>
                        <button type="button" id="catalog-filter-clear-btn" class="catalog-filter-clear">
                            <?php e('catalog.clear_filters'); ?>
                        </button>
                    </div>

                    <form id="catalog-filter-form" class="catalog-filter-form">
                        <!-- Model Search Input -->
                        <div class="filter-group filter-search-group">
                            <div class="filter-search-box">
                                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                                <input type="text" name="q" id="catalog-search-input" class="filter-search-input" placeholder="<?php echo (CURRENT_LANG === 'tr') ? 'Marka veya model ara...' : 'Search brand or model...'; ?>" autocomplete="off">
                            </div>
                        </div>

                        <!-- Kategori (Gizli ya da Select) -->
                        <input type="hidden" name="kategori" id="hidden-category-input" value="<?php echo esc($selectedCategory); ?>">

                        <!-- Marka Seçimi -->
                        <div class="filter-group">
                            <div class="filter-group-title">
                                <span><?php e('catalog.brand'); ?></span>
                            </div>
                            <div class="filter-checkbox-grid">
                                <?php 
                                $brands = ['Renault', 'Fiat', 'Toyota', 'Hyundai', 'BMW', 'MG', 'Ford', 'Volkswagen'];
                                foreach ($brands as $b):
                                    $checked = ($selectedBrand === $b);
                                ?>
                                <label class="filter-checkbox-item">
                                    <input type="checkbox" name="marka[]" value="<?php echo esc($b); ?>" <?php echo $checked ? 'checked' : ''; ?>>
                                    <span class="checkbox-box"></span>
                                    <span class="checkbox-label"><?php echo esc($b); ?></span>
                                </label>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="filter-divider"></div>

                        <!-- Kasa Tipi -->
                        <div class="filter-group">
                            <div class="filter-group-title">
                                <span><?php e('catalog.body_type'); ?></span>
                            </div>
                            <div class="filter-checkbox-list">
                                <?php 
                                $bodies = [
                                    'sedan' => 'Sedan', 
                                    'hatchback' => 'Hatchback', 
                                    'suv' => 'SUV / Crossover', 
                                    'minivan' => 'Minivan', 
                                    'panelvan' => 'Panelvan'
                                ];
                                foreach ($bodies as $key => $name):
                                    $checked = ($selectedBody === $key);
                                ?>
                                <label class="filter-checkbox-item">
                                    <input type="checkbox" name="kasa[]" value="<?php echo esc($key); ?>" <?php echo $checked ? 'checked' : ''; ?>>
                                    <span class="checkbox-box"></span>
                                    <span class="checkbox-label"><?php echo esc($name); ?></span>
                                </label>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="filter-divider"></div>

                        <!-- Yakıt Tipi -->
                        <div class="filter-group">
                            <div class="filter-group-title">
                                <span><?php e('catalog.fuel'); ?></span>
                            </div>
                            <div class="filter-checkbox-list">
                                <?php 
                                $fuels = [
                                    'benzin' => ['label' => 'Benzin', 'icon' => '⛽'], 
                                    'dizel' => ['label' => 'Dizel', 'icon' => '🛢️'], 
                                    'hibrit' => ['label' => 'Hibrit', 'icon' => '🔋'], 
                                    'elektrik' => ['label' => 'Elektrik', 'icon' => '⚡']
                                ];
                                foreach ($fuels as $key => $fuelData):
                                    $checked = ($selectedFuel === $key);
                                ?>
                                <label class="filter-checkbox-item">
                                    <input type="checkbox" name="yakit[]" value="<?php echo esc($key); ?>" <?php echo $checked ? 'checked' : ''; ?>>
                                    <span class="checkbox-box"></span>
                                    <span class="checkbox-label"><?php echo esc($fuelData['label']); ?></span>
                                </label>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="filter-divider"></div>

                        <!-- Vites Tipi -->
                        <div class="filter-group">
                            <div class="filter-group-title">
                                <span><?php e('catalog.transmission'); ?></span>
                            </div>
                            <div class="filter-checkbox-list">
                                <?php 
                                $transmissions = [
                                    'otomatik' => 'Otomatik Vites', 
                                    'manuel' => 'Manuel Vites'
                                ];
                                foreach ($transmissions as $key => $name):
                                    $checked = ($selectedTransmission === $key);
                                ?>
                                <label class="filter-checkbox-item">
                                    <input type="checkbox" name="vites[]" value="<?php echo esc($key); ?>" <?php echo $checked ? 'checked' : ''; ?>>
                                    <span class="checkbox-box"></span>
                                    <span class="checkbox-label"><?php echo esc($name); ?></span>
                                </label>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="filter-divider"></div>

                        <!-- Fiyat Aralığı -->
                        <div class="filter-group">
                            <div class="filter-group-title">
                                <span><?php e('catalog.price_range'); ?></span>
                            </div>
                            <div class="filter-price-inputs">
                                <div class="price-input-wrap">
                                    <span class="price-currency">₺</span>
                                    <input type="number" name="min_fiyat" class="filter-price-field" placeholder="Min" min="0" step="1000">
                                </div>
                                <span class="price-separator">–</span>
                                <div class="price-input-wrap">
                                    <span class="price-currency">₺</span>
                                    <input type="number" name="maks_fiyat" class="filter-price-field" placeholder="Maks" value="<?php echo esc($maxPrice); ?>" min="0" step="1000">
                                </div>
                            </div>
                        </div>

                        <div class="filter-divider"></div>

                        <!-- Özel Seçenekler -->
                        <div class="filter-group">
                            <div class="filter-group-title">
                                <span><?php echo (CURRENT_LANG === 'tr') ? 'Özel Filtreler' : 'Special Filters'; ?></span>
                            </div>
                            <div class="filter-checkbox-list">
                                <label class="filter-checkbox-item">
                                    <input type="checkbox" name="kampanya" value="1" <?php echo $isCampaign ? 'checked' : ''; ?>>
                                    <span class="checkbox-box"></span>
                                    <span class="checkbox-label"><?php e('catalog.campaign_only'); ?></span>
                                </label>
                                <label class="filter-checkbox-item">
                                    <input type="checkbox" name="hizli_teslim" value="1" <?php echo $isFastDelivery ? 'checked' : ''; ?>>
                                    <span class="checkbox-box"></span>
                                    <span class="checkbox-label"><?php e('catalog.fast_delivery_only'); ?></span>
                                </label>
                                <label class="filter-checkbox-item">
                                    <input type="checkbox" name="premium" value="1" <?php echo $isPremium ? 'checked' : ''; ?>>
                                    <span class="checkbox-box"></span>
                                    <span class="checkbox-label"><?php e('catalog.premium_only'); ?></span>
                                </label>
                            </div>
                        </div>
                    </form>
                </div>
            </aside>

            <!-- ─── VEHICLE RESULTS MAIN ───────────────────────────────── -->
            <main class="catalog-main">
                <!-- Mobile Filter Trigger (Mobile Only) -->
                <div class="catalog-mobile-trigger-bar">
                    <button type="button" class="btn btn-outline mobile-filter-trigger" id="catalog-drawer-trigger">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <line x1="4" y1="21" x2="4" y2="14"></line>
                            <line x1="4" y1="10" x2="4" y2="3"></line>
                            <line x1="12" y1="21" x2="12" y2="12"></line>
                            <line x1="12" y1="8" x2="12" y2="3"></line>
                            <line x1="20" y1="21" x2="20" y2="16"></line>
                            <line x1="20" y1="12" x2="20" y2="3"></line>
                        </svg>
                        <span><?php e('catalog.filters'); ?></span>
                    </button>
                </div>

                <!-- Active Filter Tags -->
                <div class="active-filters-bar" id="catalog-active-filters"></div>

                <!-- Vehicles Grid -->
                <div class="catalog-vehicle-grid" id="catalog-vehicle-grid">
                    <?php foreach ($vehicles as $vehicle): ?>
                        <?php include includePath('vehicle-card.php'); ?>
                    <?php endforeach; ?>
                </div>

                <!-- Empty State -->
                <div class="catalog-empty-state hidden" id="catalog-empty-state">
                    <div class="empty-state-icon">
                        <svg viewBox="0 0 24 24" width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </div>
                    <h3><?php e('catalog.no_results'); ?></h3>
                    <p><?php e('catalog.no_results_desc'); ?></p>
                    <button type="button" id="empty-state-reset-btn" class="btn btn-primary">
                        <?php e('catalog.show_all'); ?>
                    </button>
                </div>

                <!-- Bottom Fleet Consulting Banner -->
                <div class="catalog-bottom-consulting">
                    <div class="consulting-content">
                        <span class="editorial-tag"><?php echo (CURRENT_LANG === 'tr') ? 'ÖZEL FİLO ÇÖZÜMLERİ' : 'CUSTOM FLEET SOLUTIONS'; ?></span>
                        <h3><?php echo (CURRENT_LANG === 'tr') ? 'Aradığınız Modeli Bulamadınız mı?' : "Can't Find the Vehicle You're Looking For?"; ?></h3>
                        <p>
                            <?php echo (CURRENT_LANG === 'tr') 
                                ? 'Şirketinizin ihtiyaç duyduğu özel marka, model veya filo adetleri için kurumsal danışmanlarımız 15 dakika içinde size özel teklif oluştursun.' 
                                : 'For specific makes, models, or volume requirements, our fleet specialists will prepare a custom quotation within 15 minutes.'; ?>
                        </p>
                    </div>
                    <div class="consulting-actions">
                        <a href="<?php echo url('hizli-teklif.php'); ?>" class="btn btn-primary">
                            <?php echo (CURRENT_LANG === 'tr') ? 'Özel Teklif İste' : 'Request Custom Quote'; ?>
                        </a>
                        <a href="<?php echo url('iletisim.php'); ?>" class="btn btn-outline">
                            <?php echo (CURRENT_LANG === 'tr') ? 'Danışmanla Görüş' : 'Talk to Specialist'; ?>
                        </a>
                    </div>
                </div>
            </main>
        </div>
    </div>
</section>

<!-- ─── MOBILE FILTER DRAWER ───────────────────────────────────────── -->
<div class="catalog-drawer-backdrop" id="catalog-drawer-backdrop" aria-hidden="true"></div>
<div class="catalog-drawer" id="catalog-filter-drawer" role="dialog" aria-modal="true" aria-label="Filtreleme Menüsü" aria-hidden="true">
    <div class="catalog-drawer-header">
        <div class="catalog-filter-header-left">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
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
            <h3><?php e('catalog.filters'); ?></h3>
        </div>
        <button type="button" class="catalog-drawer-close" id="catalog-drawer-close" aria-label="<?php e('btn.close'); ?>">
            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
    </div>

    <div class="catalog-drawer-body">
        <form id="catalog-mobile-filter-form">
            <!-- Mobile Brand -->
            <div class="filter-group">
                <div class="filter-group-title">
                    <span><?php e('catalog.brand'); ?></span>
                </div>
                <div class="filter-checkbox-grid">
                    <?php foreach ($brands as $b): ?>
                    <label class="filter-checkbox-item">
                        <input type="checkbox" name="marka[]" value="<?php echo esc($b); ?>">
                        <span class="checkbox-box"></span>
                        <span class="checkbox-label"><?php echo esc($b); ?></span>
                    </label>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="filter-divider"></div>

            <!-- Mobile Body -->
            <div class="filter-group">
                <div class="filter-group-title">
                    <span><?php e('catalog.body_type'); ?></span>
                </div>
                <div class="filter-checkbox-list">
                    <?php foreach ($bodies as $key => $name): ?>
                    <label class="filter-checkbox-item">
                        <input type="checkbox" name="kasa[]" value="<?php echo esc($key); ?>">
                        <span class="checkbox-box"></span>
                        <span class="checkbox-label"><?php echo esc($name); ?></span>
                    </label>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="filter-divider"></div>

            <!-- Mobile Fuel -->
            <div class="filter-group">
                <div class="filter-group-title">
                    <span><?php e('catalog.fuel'); ?></span>
                </div>
                <div class="filter-checkbox-list">
                    <?php foreach ($fuels as $key => $fuelData): ?>
                    <label class="filter-checkbox-item">
                        <input type="checkbox" name="yakit[]" value="<?php echo esc($key); ?>">
                        <span class="checkbox-box"></span>
                        <span class="checkbox-label"><?php echo esc($fuelData['label']); ?></span>
                    </label>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="filter-divider"></div>

            <!-- Mobile Transmission -->
            <div class="filter-group">
                <div class="filter-group-title">
                    <span><?php e('catalog.transmission'); ?></span>
                </div>
                <div class="filter-checkbox-list">
                    <?php foreach ($transmissions as $key => $name): ?>
                    <label class="filter-checkbox-item">
                        <input type="checkbox" name="vites[]" value="<?php echo esc($key); ?>">
                        <span class="checkbox-box"></span>
                        <span class="checkbox-label"><?php echo esc($name); ?></span>
                    </label>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="filter-divider"></div>

            <!-- Mobile Price -->
            <div class="filter-group">
                <div class="filter-group-title">
                    <span><?php e('catalog.price_range'); ?></span>
                </div>
                <div class="filter-price-inputs">
                    <div class="price-input-wrap">
                        <span class="price-currency">₺</span>
                        <input type="number" name="min_fiyat" class="filter-price-field" placeholder="Min">
                    </div>
                    <span class="price-separator">–</span>
                    <div class="price-input-wrap">
                        <span class="price-currency">₺</span>
                        <input type="number" name="maks_fiyat" class="filter-price-field" placeholder="Maks">
                    </div>
                </div>
            </div>

            <div class="filter-divider"></div>

            <!-- Mobile Special -->
            <div class="filter-group">
                <div class="filter-group-title">
                    <span><?php echo (CURRENT_LANG === 'tr') ? 'Özel Filtreler' : 'Special Filters'; ?></span>
                </div>
                <div class="filter-checkbox-list">
                    <label class="filter-checkbox-item">
                        <input type="checkbox" name="kampanya" value="1">
                        <span class="checkbox-box"></span>
                        <span class="checkbox-label"><?php e('catalog.campaign_only'); ?></span>
                    </label>
                    <label class="filter-checkbox-item">
                        <input type="checkbox" name="hizli_teslim" value="1">
                        <span class="checkbox-box"></span>
                        <span class="checkbox-label"><?php e('catalog.fast_delivery_only'); ?></span>
                    </label>
                    <label class="filter-checkbox-item">
                        <input type="checkbox" name="premium" value="1">
                        <span class="checkbox-box"></span>
                        <span class="checkbox-label"><?php e('catalog.premium_only'); ?></span>
                    </label>
                </div>
            </div>
        </form>
    </div>

    <div class="catalog-drawer-footer">
        <button type="button" class="btn btn-ghost" id="catalog-mobile-clear-btn">
            <?php e('catalog.clear_filters'); ?>
        </button>
        <button type="button" class="btn btn-primary" id="catalog-drawer-apply-btn">
            <?php echo (CURRENT_LANG === 'tr') ? 'Sonuçları Göster' : 'Apply Filters'; ?>
        </button>
    </div>
</div>

<script src="<?php echo asset('js/catalog.js'); ?>"></script>

<?php include includePath('footer.php'); ?>
