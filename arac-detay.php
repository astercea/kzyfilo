<?php
/**
 * kzyfilo — Araç Detay Sayfası (arac-detay.php)
 */
require_once __DIR__ . '/includes/config.php';

$vehicles = loadData('vehicles.php');
$packages = loadData('packages.php');
$faqsData = loadData('faqs.php');

$slug = $_GET['slug'] ?? '';
$vehicle = null;

if (!empty($slug)) {
    foreach ($vehicles as $v) {
        if ($v['slug'] === $slug) {
            $vehicle = $v;
            break;
        }
    }
}

// Slug girilmemişse veya bulunamazsa varsayılan olarak ilk aracı göster
if (!$vehicle) {
    $vehicle = $vehicles[0] ?? null;
}

if (!$vehicle) {
    http_response_code(404);
    setPageMeta([
        'title' => t('error.404_title') . ' | ' . SITE_NAME,
        'description' => t('error.404_desc')
    ]);
    include includePath('header.php');
    ?>
    <div class="container section">
        <div class="empty-state">
            <h2><?php e('error.404_title'); ?></h2>
            <p><?php echo (CURRENT_LANG === 'tr') ? 'Aradığınız araç filomuzda bulunamadı veya kaldırılmış olabilir.' : 'The requested vehicle could not be found or may have been removed.'; ?></p>
            <a href="<?php echo url('araclar.php'); ?>" class="btn btn-primary"><?php e('catalog.show_all'); ?></a>
        </div>
    </div>
    <?php
    include includePath('footer.php');
    exit;
}

$mainVehicle = $vehicle;
$vTitle = $vehicle['brand'] . ' ' . $vehicle['model'];
$vVersion = $vehicle['version'];

setPageMeta([
    'title' => $vTitle . ' ' . $vVersion . ' - ' . t('vehicle_detail.title') . ' | ' . SITE_NAME,
    'description' => $vehicle['description'] ?? '',
    'canonical' => canonical('arac-detay.php?slug=' . $vehicle['slug']),
    'og_image' => $vehicle['image'] ?? asset('images/logo/kzy-filo-logo.svg')
]);

$breadcrumbs = [
    ['title' => t('catalog.title'), 'url' => url('araclar.php')],
    ['title' => $vTitle]
];

include includePath('header.php');?>

<div class="section">
    <div class="container">
        
        <!-- ─── 1. TOP HERO STAGE: TITLE, ENLARGED PHOTO & FAST SPECS ─── -->
        <div class="detail-hero-stage mb-12">
            <div class="detail-header mb-6">
                <h1 class="text-3xl mb-1"><?php echo esc($vTitle); ?></h1>
                <p class="text-base text-muted"><?php echo esc($vVersion); ?></p>
            </div>

            <!-- Centered & Enlarged Main Image Stage -->
            <div class="detail-stage-card card mb-8">
                <img src="<?php echo esc($vehicle['image']); ?>" alt="<?php echo esc($vTitle); ?>" class="card-img" id="detail-main-image">
            </div>

            <!-- Fast Spec Badges Strip -->
            <div class="detail-specs-grid grid grid-4 gap-4">
                <div class="card p-3 text-center">
                    <span class="text-xs text-muted block mb-1"><?php e('catalog.fuel'); ?></span>
                    <strong><?php e('fuel_types.' . $vehicle['fuel']); ?></strong>
                </div>
                <div class="card p-3 text-center">
                    <span class="text-xs text-muted block mb-1"><?php e('catalog.transmission'); ?></span>
                    <strong><?php e('transmission_types.' . $vehicle['transmission']); ?></strong>
                </div>
                <div class="card p-3 text-center">
                    <span class="text-xs text-muted block mb-1"><?php e('catalog.body_type'); ?></span>
                    <strong><?php e('body_types.' . $vehicle['body']); ?></strong>
                </div>
                <div class="card p-3 text-center">
                    <span class="text-xs text-muted block mb-1"><?php e('catalog.seats'); ?></span>
                    <strong><?php echo esc($vehicle['seats']); ?> <?php e('vehicle_card.seats'); ?></strong>
                </div>
            </div>
        </div>

        <!-- ─── 2. TWO-COLUMN GRID: TECHNICAL TABS (LEFT) & QUOTE CALCULATOR (RIGHT) ─── -->
        <div class="detail-content-grid">
            
            <!-- Left: Detailed Specs Tabs -->
            <div class="detail-tabs-wrap">
                <h2 class="detail-section-title mb-4">TEKNİK DETAYLAR VE HİZMETLER</h2>
                <div class="tabs-container card p-6">
                    <div class="tabs-nav mb-6" role="tablist">
                        <button type="button" class="tab-btn is-active" role="tab" aria-selected="true" data-tab="specs"><?php e('vehicle_detail.tab_specs'); ?></button>
                        <button type="button" class="tab-btn" role="tab" aria-selected="false" data-tab="services"><?php e('vehicle_detail.tab_services'); ?></button>
                        <button type="button" class="tab-btn" role="tab" aria-selected="false" data-tab="terms"><?php e('vehicle_detail.tab_lease_terms'); ?></button>
                        <button type="button" class="tab-btn" role="tab" aria-selected="false" data-tab="faq"><?php e('vehicle_detail.tab_faq'); ?></button>
                    </div>

                    <!-- Tab 1: Technical Specs -->
                    <div class="tab-panel is-active" id="tab-specs" role="tabpanel">
                        <?php foreach ($vehicle['specs'] as $groupKey => $groupData): ?>
                            <div class="mb-6">
                                <h4 class="specs-group-title">
                                    <?php echo esc($groupKey); ?>
                                </h4>
                                <div class="specs-table">
                                    <?php foreach ($groupData as $label => $val): ?>
                                        <div class="specs-row">
                                            <span class="specs-label"><?php echo esc($label); ?></span>
                                            <span class="specs-value"><?php echo esc($val); ?></span>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Tab 2: Included & Extra Services -->
                    <div class="tab-panel hidden" id="tab-services" role="tabpanel">
                        <div class="tab-section-intro mb-6">
                            <h3 class="text-base fw-bold text-dark mb-1">Standart Kiralamaya Dahil Olan Hizmetler</h3>
                            <p class="text-sm text-muted mb-0">Kzyfilo uzun dönem kiralamalarında operasyonel tüm süreçler güvencemiz altındadır.</p>
                        </div>

                        <div class="services-feature-grid grid grid-2 gap-4 mb-6">
                            <div class="service-feature-card">
                                <div class="service-feature-icon">✓</div>
                                <div class="service-feature-text">
                                    <strong>Periyodik Bakım & Onarım</strong>
                                    <p>Üretici standartlarında yetkili servis güvencesiyle tüm periyodik bakımlar dahil.</p>
                                </div>
                            </div>
                            <div class="service-feature-card">
                                <div class="service-feature-icon">✓</div>
                                <div class="service-feature-text">
                                    <strong>Kasko & Trafik Sigortası</strong>
                                    <p>Muafiyetsiz tam kapsamlı filo kaskosu ve zorunlu mali sorumluluk sigortası.</p>
                                </div>
                            </div>
                            <div class="service-feature-card">
                                <div class="service-feature-icon">✓</div>
                                <div class="service-feature-text">
                                    <strong>7/24 Kesintisiz Yol Yardımı</strong>
                                    <p>Türkiye genelinde çekici, lastik yardımı ve acil destek hizmetleri.</p>
                                </div>
                            </div>
                            <div class="service-feature-card">
                                <div class="service-feature-icon">✓</div>
                                <div class="service-feature-text">
                                    <strong>İkame Araç Temini</strong>
                                    <p>Bakım ve kaza süreçlerinde 24 saat içinde kesintisiz yedek araç temini.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Promo Upgrade Box -->
                        <div class="package-promo-card">
                            <div class="package-promo-content">
                                <div class="package-promo-badge">GÜVENCE SEÇENEKLERİ</div>
                                <h4 class="package-promo-title">Daha Fazla Güvence mi İstiyorsunuz?</h4>
                                <p class="package-promo-desc">Kış lastiği, mini hasar muafiyeti ve esnek kilometre paketlerini inceleyin.</p>
                            </div>
                            <div class="package-promo-action">
                                <a href="<?php echo url('paket-karsilastir.php', ['arac' => $vehicle['slug']]); ?>" class="btn btn-primary">
                                    <?php e('vehicle_detail.compare_packages'); ?>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 3: Lease Terms -->
                    <div class="tab-panel hidden" id="tab-terms" role="tabpanel">
                        <div class="tab-section-intro mb-6">
                            <h3 class="text-base fw-bold text-dark mb-1">Operasyonel Kiralama Koşulları ve Avantajları</h3>
                            <p class="text-sm text-muted mb-0">Şirketinizin nakit akışını koruyan, vergi avantajı sağlayan kurumsal filo çözümleri.</p>
                        </div>

                        <div class="terms-cards-grid grid grid-2 gap-4">
                            <div class="term-card">
                                <div class="term-card-header">
                                    <span class="term-icon">⏱️</span>
                                    <h4 class="term-title">Süre ve Kilometre Seçenekleri</h4>
                                </div>
                                <p class="term-desc">24, 36 ve 48 aylık esnek sözleşme süreleri; yıllık 15.000 km, 20.000 km veya 30.000 km kullanım paketleriyle filonuza tam uyum.</p>
                            </div>

                            <div class="term-card">
                                <div class="term-card-header">
                                    <span class="term-icon">📊</span>
                                    <h4 class="term-title">Vergi ve Muhasebe Avantajı</h4>
                                </div>
                                <p class="term-desc">Aylık faturalar doğrudan gider olarak kaydedilebilir. KDV mahsubu yapılabilir ve araç bedeli bilançoda borç olarak görünmez.</p>
                            </div>

                            <div class="term-card">
                                <div class="term-card-header">
                                    <span class="term-icon">🛠️</span>
                                    <h4 class="term-title">Sıfır Operasyonel Yük</h4>
                                </div>
                                <p class="term-desc">MTV, periyodik muayene, hasar takibi ve lastik saklama/değişim gibi tüm zaman alıcı süreçler Kzyfilo tarafından yönetilir.</p>
                            </div>

                            <div class="term-card">
                                <div class="term-card-header">
                                    <span class="term-icon">🤝</span>
                                    <h4 class="term-title">Hızlı Teslimat ve Esneklik</h4>
                                </div>
                                <p class="term-desc">Kredi değerlendirme süreci sonrası stoktaki araçlar hızla kapınıza teslim edilir; sözleşme sonunda model yenileme kolaylığı sunulur.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 4: FAQ -->
                    <div class="tab-panel hidden" id="tab-faq" role="tabpanel">
                        <div class="tab-section-intro mb-6">
                            <h3 class="text-base fw-bold text-dark mb-1">Sıkça Sorulan Sorular</h3>
                            <p class="text-sm text-muted mb-0">Araç kiralama süreci, faturalandırma ve servis hakkında en çok merak edilenler.</p>
                        </div>

                        <?php 
                        $detailFaqs = [];
                        if (!empty($faqsData) && is_array($faqsData)) {
                            foreach ($faqsData as $catKey => $cat) {
                                if (!empty($cat['items']) && is_array($cat['items'])) {
                                    foreach ($cat['items'] as $item) {
                                        $detailFaqs[] = $item;
                                    }
                                }
                            }
                        }
                        $detailFaqs = array_slice($detailFaqs, 0, 6);
                        ?>

                        <div class="accordion">
                            <?php foreach ($detailFaqs as $faq): ?>
                                <div class="accordion-item">
                                    <button type="button" class="accordion-trigger" aria-expanded="false">
                                        <span><?php echo esc($faq['question']); ?></span>
                                        <svg class="accordion-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                    </button>
                                    <div class="accordion-panel">
                                        <div class="accordion-panel-content"><?php echo esc($faq['answer']); ?></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Dynamic Quote Calculator Sticky Sidebar -->
            <aside class="detail-sidebar">
                <h2 class="detail-section-title mb-4">TEKLİFİNİZİ OLUŞTURUN</h2>
                <div class="quote-sidebar-card card card-body sticky-panel" id="detail-quote-calculator">
                    <div class="quote-sidebar-header">
                        <h3 class="text-base fw-bold mb-0">Hızlı Fiyat Hesaplama</h3>
                        <span class="badge badge-primary"><?php e('demo_price'); ?></span>
                    </div>

                    <form id="vehicle-quote-calculator-form" novalidate>
                        <!-- Kiralama Süresi -->
                        <div class="form-group mb-4">
                            <label class="form-label"><?php e('quote_calc.duration'); ?> <span class="required">*</span></label>
                            <div class="btn-group-segmented">
                                <label class="segmented-label">
                                    <input type="radio" name="duration" value="24">
                                    <span>24 Ay</span>
                                </label>
                                <label class="segmented-label">
                                    <input type="radio" name="duration" value="36" checked>
                                    <span>36 Ay</span>
                                </label>
                                <label class="segmented-label">
                                    <input type="radio" name="duration" value="48">
                                    <span>48 Ay</span>
                                </label>
                            </div>
                        </div>

                        <!-- Yıllık Kilometre -->
                        <div class="form-group mb-4">
                            <label for="calc-km-select" class="form-label"><?php e('quote_calc.annual_km'); ?> <span class="required">*</span></label>
                            <select id="calc-km-select" name="annual_km" class="form-select">
                                <option value="15">15.000 km / Yıl</option>
                                <option value="20">20.000 km / Yıl</option>
                                <option value="30">30.000 km / Yıl</option>
                            </select>
                        </div>

                        <!-- Hizmet Paketi -->
                        <div class="form-group mb-4">
                            <label for="calc-package-select" class="form-label"><?php e('quote_calc.package'); ?> <span class="required">*</span></label>
                            <select id="calc-package-select" name="package" class="form-select">
                                <option value="basic">Başlangıç Paketi</option>
                                <option value="advantage" selected>Avantaj Paketi (Önerilen)</option>
                                <option value="full">Tam Güvence Paketi</option>
                            </select>
                        </div>

                        <!-- Peşinat Seçeneği -->
                        <div class="form-group mb-4">
                            <label for="calc-deposit-select" class="form-label"><?php e('quote_calc.deposit'); ?></label>
                            <select id="calc-deposit-select" name="deposit" class="form-select">
                                <option value="0">Peşinatsız (%0)</option>
                                <option value="50000">50.000 ₺ Peşinat</option>
                                <option value="100000">100.000 ₺ Peşinat</option>
                                <option value="150000">150.000 ₺ Peşinat</option>
                            </select>
                        </div>

                        <!-- Araç Adedi -->
                        <div class="form-group mb-6">
                            <label for="calc-count-select" class="form-label"><?php e('quote_calc.count'); ?></label>
                            <select id="calc-count-select" name="vehicle_count" class="form-select">
                                <option value="1">1 Adet</option>
                                <option value="2">2 Adet</option>
                                <option value="3">3 Adet</option>
                                <option value="5">5 Adet</option>
                                <option value="10">10+ Adet (Özel Filo Teklifi)</option>
                            </select>
                        </div>

                        <!-- Live Price Display -->
                        <div class="quote-price-box mb-6" id="calc-price-container">
                            <span class="text-xs text-muted block mb-1"><?php e('quote_calc.estimated_monthly'); ?> (Araç Başı):</span>
                            <div class="text-3xl fw-extrabold text-primary">
                                <span id="calc-monthly-price"><?php echo number_format($vehicle['starting_price'], 0, ',', '.'); ?></span> ₺
                                <span class="text-xs text-muted fw-normal">/ay + KDV</span>
                            </div>
                        </div>

                        <div class="alert alert-info hidden mb-6" id="calc-custom-offer-notice">
                            <?php e('quote_calc.custom_offer_notice'); ?>
                        </div>

                        <!-- CTAs -->
                        <div class="flex flex-col gap-3">
                            <a href="<?php echo url('hizli-teklif.php', ['arac' => $vehicle['slug']]); ?>" class="btn btn-primary btn-lg" id="btn-goto-quote">
                                <?php e('vehicle_detail.get_quick_quote'); ?>
                            </a>

                            <a href="<?php echo url('paket-karsilastir.php', ['arac' => $vehicle['slug']]); ?>" class="btn btn-outline" id="btn-goto-packages">
                                <?php e('vehicle_detail.compare_packages'); ?>
                            </a>

                            <button type="button" class="btn btn-secondary" style="width: 100%;" data-open-modal="callback">
                                <?php e('vehicle_detail.call_me'); ?>
                            </button>
                        </div>

                        <div class="quote-summary-disclaimer mt-4">
                            <?php e('quote_summary.price_disclaimer'); ?>
                        </div>
                    </form>
                </div>
            </aside>
        </div>

        <!-- ─── SIMILAR VEHICLES ───────────────────────────────────────── -->
        <div class="similar-vehicles-section mt-16">
            <div class="flex flex-between mb-8 flex-wrap gap-4 items-center">
                <h2 class="similar-vehicles-title"><?php e('vehicle_detail.similar_vehicles'); ?></h2>
                <a href="<?php echo url('araclar.php', ['kategori' => $mainVehicle['category']]); ?>" class="btn btn-outline btn-sm">
                    <?php e('btn.view_all'); ?>
                </a>
            </div>

            <div class="grid grid-3 gap-6">
                <?php 
                $similarCount = 0;
                foreach ($vehicles as $simV):
                    if ($simV['id'] !== $mainVehicle['id'] && $similarCount < 3):
                        $similarCount++;
                        $vehicle = $simV;
                        include includePath('vehicle-card.php');
                    endif;
                endforeach; 
                ?>
            </div>
        </div>
    </div>
</div>

<script>
    window.currentVehicle = {
        id: <?php echo json_encode($mainVehicle['id']); ?>,
        slug: <?php echo json_encode($mainVehicle['slug']); ?>,
        brand: <?php echo json_encode($mainVehicle['brand']); ?>,
        model: <?php echo json_encode($mainVehicle['model']); ?>
    };
    window.vehiclePriceMatrix = <?php echo json_encode($mainVehicle['prices'] ?? []); ?>;
</script>
<script src="<?php echo asset('js/quote.js'); ?>"></script>

<?php include includePath('footer.php'); ?>
