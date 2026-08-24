<?php
/**
 * kzyfilo — Paket Karşılaştırma ve Teklif Özeti (paket-karsilastir.php)
 */
require_once __DIR__ . '/includes/config.php';

$vehicles = loadData('vehicles.php');
$packages = loadData('packages.php');
$services = loadData('services.php');

$slug = $_GET['arac'] ?? '';
$selectedVehicle = null;

if (!empty($slug)) {
    foreach ($vehicles as $v) {
        if ($v['slug'] === $slug) {
            $selectedVehicle = $v;
            break;
        }
    }
}

// Araç seçilmemişse varsayılan olarak ilk aracı al
if (!$selectedVehicle) {
    $selectedVehicle = $vehicles[0];
}

setPageMeta([
    'title' => t('package_compare.title') . ' - ' . $selectedVehicle['brand'] . ' ' . $selectedVehicle['model'] . ' | ' . SITE_NAME,
    'description' => t('package_compare.description'),
    'canonical' => canonical('paket-karsilastir.php'),
]);

$breadcrumbs = [
    ['title' => t('catalog.title'), 'url' => url('araclar.php')],
    ['title' => $selectedVehicle['brand'] . ' ' . $selectedVehicle['model'], 'url' => url('arac-detay.php', ['slug' => $selectedVehicle['slug']])],
    ['title' => t('package_compare.title')]
];

include includePath('header.php');?>

<div class="page-header">
    <div class="container">
        <h1><?php e('package_compare.title'); ?></h1>
        <?php include includePath('breadcrumbs.php'); ?>
    </div>
</div>

<!-- ─── PROGRESS PIPELINE ─────────────────────────────────────────── -->
<div class="container" style="padding-top: var(--space-6);">
    <div class="progress-steps">
        <div class="progress-step is-completed">
            <span class="progress-step-number">✓</span>
            <span><?php e('package_compare.step_vehicle'); ?></span>
        </div>
        <div class="progress-step-connector"></div>
        <div class="progress-step is-completed">
            <span class="progress-step-number">✓</span>
            <span><?php e('package_compare.step_options'); ?></span>
        </div>
        <div class="progress-step-connector"></div>
        <div class="progress-step is-active">
            <span class="progress-step-number">3</span>
            <span><?php e('package_compare.step_packages'); ?></span>
        </div>
        <div class="progress-step-connector"></div>
        <div class="progress-step">
            <span class="progress-step-number">4</span>
            <span><?php e('package_compare.step_info'); ?></span>
        </div>
        <div class="progress-step-connector"></div>
        <div class="progress-step">
            <span class="progress-step-number">5</span>
            <span><?php e('package_compare.step_summary'); ?></span>
        </div>
    </div>
</div>

<section class="section-sm">
    <div class="container">
        <div class="layout-sidebar-right" data-reveal="fade-up">
            
            <!-- ─── LEFT: Packages & Addon Services ────────────────────── -->
            <div>
                <div class="mb-8">
                    <h1 class="text-2xl mb-2"><?php e('package_compare.title'); ?></h1>
                    <p class="text-muted"><?php e('package_compare.description'); ?></p>
                </div>

                <!-- 3 Package Cards Grid -->
                <div class="package-cards mb-12">
                    <?php foreach ($packages as $pkgId => $pkg): ?>
                        <div class="package-card <?php echo !empty($pkg['is_popular']) ? 'is-popular is-selected' : ''; ?>" data-spotlight data-package="<?php echo esc($pkgId); ?>">
                            <?php if (!empty($pkg['is_popular'])): ?>
                                <span class="package-popular-tag"><?php e('package_compare.most_popular'); ?></span>
                            <?php endif; ?>

                            <div class="package-card-header">
                                <h3 class="package-card-name"><?php echo esc($pkg['name']); ?></h3>
                                <p class="package-card-desc"><?php echo esc($pkg['tagline']); ?></p>
                                <div class="package-card-price">
                                    <?php if ($pkg['monthly_diff'] === 0): ?>
                                        <span>Standart</span>
                                    <?php else: ?>
                                        +<?php echo number_format($pkg['monthly_diff'], 0, ',', '.'); ?> ₺ <span>/ay</span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Features List -->
                            <div class="package-features">
                                <?php foreach ($pkg['features'] as $fKey => $feat): ?>
                                    <div class="package-feature <?php echo $feat['included'] ? 'is-included' : 'is-excluded'; ?>">
                                        <?php if ($feat['included']): ?>
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                <polyline points="20 6 9 17 4 12"></polyline>
                                            </svg>
                                        <?php else: ?>
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                            </svg>
                                        <?php endif; ?>
                                        <span><?php echo esc($feat['name']); ?></span>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <button type="button" class="btn <?php echo !empty($pkg['is_popular']) ? 'btn-primary' : 'btn-outline'; ?> btn-sm btn-select-package">
                                <?php echo !empty($pkg['is_popular']) ? 'Seçildi ✓' : t('package_compare.select_package'); ?>
                            </button>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Detailed Specs Comparison Accordion Table -->
                <div class="accordion mb-12">
                    <div class="accordion-item">
                        <button type="button" class="accordion-trigger" aria-expanded="false">
                            <span><?php e('package_compare.compare_all'); ?></span>
                            <svg class="accordion-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </button>
                        <div class="accordion-panel">
                            <div class="accordion-panel-content">
                                <table style="width: 100%; border-collapse: collapse;">
                                    <thead>
                                        <tr style="border-bottom: 2px solid var(--color-border);">
                                            <th style="text-align: left; padding: 12px 8px;">Hizmet Özelliği</th>
                                            <th style="text-align: center; padding: 12px 8px;">Başlangıç</th>
                                            <th style="text-align: center; padding: 12px 8px;">Avantaj</th>
                                            <th style="text-align: center; padding: 12px 8px;">Tam Güvence</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($packages['full']['features'] as $fKey => $fullFeat): ?>
                                            <tr style="border-bottom: 1px solid var(--color-border-light);">
                                                <td style="padding: 10px 8px; font-size: 13px;"><?php echo esc($fullFeat['name']); ?></td>
                                                <td style="text-align: center; padding: 10px 8px;">
                                                    <?php echo !empty($packages['basic']['features'][$fKey]['included']) ? '<span style="color: var(--color-success); font-weight: bold;">✓</span>' : '<span style="color: var(--color-border);">✕</span>'; ?>
                                                </td>
                                                <td style="text-align: center; padding: 10px 8px;">
                                                    <?php echo !empty($packages['advantage']['features'][$fKey]['included']) ? '<span style="color: var(--color-success); font-weight: bold;">✓</span>' : '<span style="color: var(--color-border);">✕</span>'; ?>
                                                </td>
                                                <td style="text-align: center; padding: 10px 8px;">
                                                    <span style="color: var(--color-success); font-weight: bold;">✓</span>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ─── EK ÜRÜN VE HİZMETLER ──────────────────────────── -->
                <div>
                    <h2 class="text-xl fw-bold mb-3"><?php e('package_compare.additional_services'); ?></h2>
                    <p class="text-sm text-muted mb-6"><?php echo (CURRENT_LANG === 'tr') ? 'İhtiyacınıza göre kiralama paketinize dilediğiniz ek hizmetleri dahil edebilirsiniz.' : 'Add any additional services to your leasing package according to your business needs.'; ?></p>

                    <div class="flex flex-col gap-3">
                        <?php foreach ($services as $service): ?>
                            <div class="addon-card" data-addon="<?php echo esc($service['id']); ?>">
                                <div class="addon-card-info">
                                    <div>
                                        <h5><?php echo esc($service['name']); ?></h5>
                                        <p><?php echo esc($service['description']); ?></p>
                                    </div>
                                </div>

                                <div class="flex items-center">
                                    <div class="addon-card-price">
                                        <div class="price">+<?php echo number_format($service['price'], 0, ',', '.'); ?> ₺</div>
                                        <div class="price-type"><?php echo ($service['type'] === 'monthly') ? t('package_compare.monthly_fee') : t('package_compare.one_time_fee'); ?></div>
                                    </div>

                                    <button type="button" class="btn btn-outline btn-sm btn-toggle-addon">
                                        + <?php e('package_compare.add_service'); ?>
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- ─── RIGHT: Sticky Dynamic Price Breakdown Panel ────────── -->
            <aside>
                <div class="quote-summary-panel">
                    <h3 class="text-lg fw-bold mb-4"><?php e('quote_summary.title'); ?></h3>

                    <!-- Selected Vehicle Snippet -->
                    <div class="quote-summary-vehicle">
                        <img src="<?php echo esc($selectedVehicle['image']); ?>" alt="<?php echo esc($selectedVehicle['brand'] . ' ' . $selectedVehicle['model']); ?>">
                        <div class="quote-summary-vehicle-info">
                            <h4><?php echo esc($selectedVehicle['brand'] . ' ' . $selectedVehicle['model']); ?></h4>
                            <div class="quote-summary-vehicle-specs">
                                <span><?php e('fuel_types.' . $selectedVehicle['fuel']); ?></span>
                                <span>•</span>
                                <span><?php e('transmission_types.' . $selectedVehicle['transmission']); ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Itemized Breakdown Lines -->
                    <div class="quote-summary-line">
                        <span class="quote-summary-label"><?php e('quote_summary.vehicle_rent'); ?>:</span>
                        <span class="quote-summary-value" id="summary-vehicle-base">16.900 ₺</span>
                    </div>

                    <div class="quote-summary-line">
                        <span class="quote-summary-label"><?php e('quote_summary.package_fee'); ?>:</span>
                        <span class="quote-summary-value" id="summary-package-diff">1.350 ₺</span>
                    </div>

                    <div class="quote-summary-line">
                        <span class="quote-summary-label"><?php e('quote_summary.monthly_extras'); ?>:</span>
                        <span class="quote-summary-value" id="summary-monthly-addons">0 ₺</span>
                    </div>

                    <!-- One-time row (Shown separately as required) -->
                    <div class="quote-summary-line hidden" id="summary-onetime-row" style="background-color: var(--color-surface-soft); padding: 4px 8px; border-radius: 4px;">
                        <span class="quote-summary-label text-xs"><?php e('quote_summary.one_time_extras'); ?>:</span>
                        <span class="quote-summary-value text-xs text-primary" id="summary-onetime-addons">0 ₺</span>
                    </div>

                    <div class="quote-summary-line" style="border-top: 1px solid var(--color-border-light); margin-top: 8px; padding-top: 8px;">
                        <span class="quote-summary-label"><?php e('quote_summary.subtotal'); ?>:</span>
                        <span class="quote-summary-value" id="summary-subtotal">18.250 ₺</span>
                    </div>

                    <div class="quote-summary-line">
                        <span class="quote-summary-label"><?php e('quote_summary.vat'); ?>:</span>
                        <span class="quote-summary-value" id="summary-vat">3.650 ₺</span>
                    </div>

                    <div class="quote-summary-line is-total">
                        <span class="quote-summary-label"><?php e('quote_summary.total'); ?>:</span>
                        <span class="quote-summary-value" id="summary-total">21.900 ₺</span>
                    </div>

                    <!-- CTA Continue to Quote -->
                    <div class="mt-6">
                        <a href="<?php echo url('hizli-teklif.php', ['arac' => $selectedVehicle['slug']]); ?>" class="btn btn-primary" style="width: 100%;">
                            <?php e('package_compare.continue_quote'); ?>
                        </a>
                    </div>

                    <div class="quote-summary-disclaimer">
                        <?php e('quote_summary.price_disclaimer'); ?>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

<script>
    window.addonsData = <?php echo json_encode($services); ?>;
</script>
<script src="<?php echo asset('js/quote.js'); ?>"></script>
<script src="<?php echo asset('js/package-compare.js'); ?>"></script>

<?php include includePath('footer.php'); ?>
