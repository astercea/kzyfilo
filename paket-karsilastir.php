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

$vTitle = $selectedVehicle['brand'] . ' ' . $selectedVehicle['model'];
$vVersion = $selectedVehicle['version'];

setPageMeta([
    'title' => t('package_compare.title') . ' - ' . $vTitle . ' | ' . SITE_NAME,
    'description' => t('package_compare.description'),
    'canonical' => canonical('paket-karsilastir.php'),
]);

$breadcrumbs = [
    ['title' => t('catalog.title'), 'url' => url('araclar.php')],
    ['title' => $vTitle, 'url' => url('arac-detay.php', ['slug' => $selectedVehicle['slug']])],
    ['title' => t('package_compare.title')]
];

include includePath('header.php');?>

<!-- ─── 1. ÜST BAŞLIK ─────────────────────────────────────────────── -->
<section class="section section-ivory" style="padding-top: var(--space-8); padding-bottom: var(--space-6);">
    <div class="container">
        <div>
            <h1 class="text-3xl fw-bold text-dark m-0" style="letter-spacing: -0.01em;">
                Hizmet Paketleri ve Güvence Karşılaştırması
            </h1>
            <p class="text-base text-muted mt-1 mb-0">
                Seçilen araç için operasyonel filo kiralama kapsamını ve ek güvence seçeneklerini belirleyin.
            </p>
        </div>
    </div>
</section>

<!-- ─── 2. ANA PAKET SEÇİMİ & SAĞ ÖZET DÜZENİ ─────────────────────── -->
<section class="section section-paper" style="padding-top: var(--space-8);">
    <div class="container">
        
        <div class="layout-sidebar-right">
            
            <!-- ─── SOL SÜTUN: PAKETLER & EK HİZMETLER ────────────────── -->
            <div>
                
                <!-- 3 Hizmet Paketi Kartları (Doğrudan Sağdaki Kutuyla Aynı Hizada Başlar) -->
                <div class="package-cards mb-12">
                    <?php foreach ($packages as $pkgId => $pkg): ?>
                        <div class="package-card <?php echo !empty($pkg['is_popular']) ? 'is-popular is-selected' : ''; ?>" data-package="<?php echo esc($pkgId); ?>">
                            <?php if (!empty($pkg['is_popular'])): ?>
                                <span class="package-popular-tag">EN ÇOK TERCİH EDİLEN</span>
                            <?php endif; ?>

                            <div class="package-card-header">
                                <h3 class="package-card-name"><?php echo esc($pkg['name']); ?></h3>
                                <p class="package-card-desc"><?php echo esc($pkg['tagline']); ?></p>
                                <div class="package-card-price">
                                    <?php if ($pkg['monthly_diff'] === 0): ?>
                                        <span>Standart Dahil</span>
                                    <?php else: ?>
                                        +<?php echo number_format($pkg['monthly_diff'], 0, ',', '.'); ?> ₺ <span>/ ay</span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Özellikler Listesi -->
                            <div class="package-features">
                                <?php foreach ($pkg['features'] as $fKey => $feat): ?>
                                    <div class="package-feature <?php echo $feat['included'] ? 'is-included' : 'is-excluded'; ?>">
                                        <?php if ($feat['included']): ?>
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="20 6 9 17 4 12"></polyline>
                                            </svg>
                                        <?php else: ?>
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                            </svg>
                                        <?php endif; ?>
                                        <span><?php echo esc($feat['name']); ?></span>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <button type="button" class="btn <?php echo !empty($pkg['is_popular']) ? 'btn-primary' : 'btn-outline'; ?> btn-sm btn-select-package" style="width: 100%; justify-content: center;">
                                <?php echo !empty($pkg['is_popular']) ? 'Seçildi ✓' : 'Paketi Seç'; ?>
                            </button>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Detaylı Karşılaştırma Matrisi -->
                <div class="mb-12">
                    <div class="mb-4">
                        <h2 class="text-xl fw-bold text-dark m-0">Detaylı Hizmet Karşılaştırma Tablosu</h2>
                        <p class="text-sm text-muted mt-1 mb-0">Paketler arasındaki tüm operasyonel teminat ve hizmet farklarını inceleyin.</p>
                    </div>

                    <div class="bg-white" style="border: 1px solid var(--color-border-light); border-radius: var(--radius-lg, 8px); overflow: hidden; box-shadow: 0 4px 16px rgba(0,0,0,0.02);">
                        <table style="width: 100%; border-collapse: collapse; font-size: 13px;">
                            <thead>
                                <tr style="background-color: #f7f6f2; border-bottom: 2px solid var(--color-border-light);">
                                    <th style="text-align: left; padding: 14px 18px; font-weight: 700; color: #121822;">Hizmet Özelliği</th>
                                    <th style="text-align: center; padding: 14px 12px; font-weight: 700; color: #121822; width: 22%;">Başlangıç</th>
                                    <th style="text-align: center; padding: 14px 12px; font-weight: 700; color: var(--color-orange); width: 22%; background: rgba(241, 90, 36, 0.04);">Avantaj</th>
                                    <th style="text-align: center; padding: 14px 12px; font-weight: 700; color: #121822; width: 22%;">Tam Güvence</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($packages['full']['features'] as $fKey => $fullFeat): ?>
                                    <tr style="border-bottom: 1px solid var(--color-border-light);">
                                        <td style="padding: 12px 18px; color: #121822; font-weight: 500;">
                                            <?php echo esc($fullFeat['name']); ?>
                                        </td>
                                        <td style="text-align: center; padding: 12px;">
                                            <?php echo !empty($packages['basic']['features'][$fKey]['included']) ? '<span style="color: #10b981; font-weight: bold; font-size: 16px;">✓</span>' : '<span style="color: #cbd5e1; font-size: 14px;">✕</span>'; ?>
                                        </td>
                                        <td style="text-align: center; padding: 12px; background: rgba(241, 90, 36, 0.02);">
                                            <?php echo !empty($packages['advantage']['features'][$fKey]['included']) ? '<span style="color: #10b981; font-weight: bold; font-size: 16px;">✓</span>' : '<span style="color: #cbd5e1; font-size: 14px;">✕</span>'; ?>
                                        </td>
                                        <td style="text-align: center; padding: 12px;">
                                            <span style="color: #10b981; font-weight: bold; font-size: 16px;">✓</span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Ek Ürün ve Hizmetler -->
                <div>
                    <div class="mb-4">
                        <h2 class="text-xl fw-bold text-dark m-0">Ek Opsiyonel Hizmetler</h2>
                        <p class="text-sm text-muted mt-1 mb-0">İhtiyacınıza göre kiralama paketinize dilediğiniz ek filo hizmetlerini ekleyin.</p>
                    </div>

                    <div class="flex flex-col gap-3">
                        <?php foreach ($services as $service): ?>
                            <div class="addon-card" data-addon="<?php echo esc($service['id']); ?>">
                                <div class="addon-card-info">
                                    <div style="width: 40px; height: 40px; border-radius: 6px; background: #f7f6f2; display: flex; align-items: center; justify-content: center; flex-shrink: 0; color: var(--color-orange);">
                                        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h5><?php echo esc($service['name']); ?></h5>
                                        <p><?php echo esc($service['description']); ?></p>
                                    </div>
                                </div>

                                <div class="flex items-center">
                                    <div class="addon-card-price">
                                        <div class="price">+<?php echo number_format($service['price'], 0, ',', '.'); ?> ₺</div>
                                        <div class="price-type"><?php echo ($service['type'] === 'monthly') ? 'Aylık' : 'Tek Seferlik'; ?></div>
                                    </div>

                                    <button type="button" class="btn btn-outline btn-sm btn-toggle-addon" style="white-space: nowrap; min-width: 90px; justify-content: center;">
                                        + Ekle
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>

            <!-- ─── SAĞ SÜTUN: YAPIŞKAN CANLI FİYAT HESAPLAMA PANELİ ───── -->
            <aside>
                <div class="quote-summary-panel">
                    <div class="mb-4">
                        <span class="editorial-tag m-0">Canlı Fiyatlandırma</span>
                        <h3 class="text-lg fw-bold text-dark mt-1 mb-0">Teklif Özeti</h3>
                    </div>

                    <!-- Seçilen Araç Önizlemesi -->
                    <div class="quote-summary-vehicle">
                        <img src="<?php echo esc($selectedVehicle['image']); ?>" alt="<?php echo esc($vTitle); ?>">
                        <div class="quote-summary-vehicle-info">
                            <h4><?php echo esc($vTitle); ?></h4>
                            <div class="quote-summary-vehicle-specs">
                                <span><?php e('fuel_types.' . $selectedVehicle['fuel']); ?></span>
                                <span>•</span>
                                <span><?php e('transmission_types.' . $selectedVehicle['transmission']); ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Kırılım Satırları -->
                    <div class="quote-summary-line">
                        <span class="quote-summary-label">Temel Araç Kirası:</span>
                        <span class="quote-summary-value" id="summary-vehicle-base"><?php echo number_format($selectedVehicle['starting_price'], 0, ',', '.'); ?> ₺</span>
                    </div>

                    <div class="quote-summary-line">
                        <span class="quote-summary-label">Seçilen Paket Farkı:</span>
                        <span class="quote-summary-value" id="summary-package-diff">1.350 ₺</span>
                    </div>

                    <div class="quote-summary-line">
                        <span class="quote-summary-label">Aylık Ek Hizmetler:</span>
                        <span class="quote-summary-value" id="summary-monthly-addons">0 ₺</span>
                    </div>

                    <!-- Tek Seferlik Ekstra Satırı (Varsa Gösterilir) -->
                    <div class="quote-summary-line hidden" id="summary-onetime-row" style="background-color: #f7f6f2; padding: 6px 10px; border-radius: 4px; margin: 6px 0;">
                        <span class="quote-summary-label text-xs">Tek Seferlik Hizmetler:</span>
                        <span class="quote-summary-value text-xs" style="color: var(--color-orange);" id="summary-onetime-addons">0 ₺</span>
                    </div>

                    <div class="quote-summary-line" style="border-top: 1px solid rgba(0,0,0,0.06); margin-top: 10px; padding-top: 10px;">
                        <span class="quote-summary-label">Ara Toplam:</span>
                        <span class="quote-summary-value" id="summary-subtotal">16.200 ₺</span>
                    </div>

                    <div class="quote-summary-line">
                        <span class="quote-summary-label">KDV (%20):</span>
                        <span class="quote-summary-value" id="summary-vat">3.240 ₺</span>
                    </div>

                    <!-- Toplam Aylık Kira -->
                    <div class="quote-summary-line is-total">
                        <span class="quote-summary-label">Toplam Aylık Tutar:</span>
                        <span class="quote-summary-value" id="summary-total">19.440 ₺</span>
                    </div>

                    <!-- Eylem Butonu -->
                    <div class="mt-6">
                        <a href="<?php echo url('hizli-teklif.php', ['arac' => $selectedVehicle['slug']]); ?>" class="btn btn-primary btn-lg" style="width: 100%; justify-content: center; padding: 14px 20px;">
                            Hemen Teklif Al
                        </a>
                    </div>

                    <div class="quote-summary-disclaimer">
                        Belirtilen tutar tahmini aylık kira bedelidir. Kesin teklif kzyfilo uzman ekibi tarafından onaylanarak iletilir.
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
