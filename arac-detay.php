<?php
/**
 * kzyfilo — Araç Detay Sayfası (arac-detay.php)
 * High-End Interactive Vehicle Showroom & Live Configurator
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

<!-- ─── 1. ANA SHOWROOM & KONFİGÜRATÖR DÜZENİ ──────────────────────── -->
<section class="section section-ivory" style="padding-top: var(--space-8);">
    <div class="container">
        
        <!-- Üst Başlık (Her iki sütunun üstünde yer alır) -->
        <div class="mb-6">
            <h1 class="text-3xl fw-bold text-dark m-0" style="letter-spacing: -0.01em;">
                <?php echo esc($vTitle); ?>
            </h1>
            <p class="text-base text-muted mt-1 mb-0"><?php echo esc($vVersion); ?></p>
        </div>

        <div class="vehicle-hero-layout">
            
            <!-- ─── SOL SÜTUN: SHOWROOM VİTRİNİ & HIZLI ÖZELLİKLER ────── -->
            <div class="vehicle-left-col">
                <!-- Showroom Görsel Sahnesi -->
                <div class="vehicle-showroom-stage" data-spotlight>
                    <img src="<?php echo esc($vehicle['image']); ?>" 
                         alt="<?php echo esc($vTitle); ?>" 
                         class="vehicle-showroom-img" 
                         id="detail-main-image">
                </div>

                <!-- Hızlı Özellikler Şeridi (Çerçevesiz & Büyük Metinli) -->
                <div class="fast-specs-grid">
                    <div class="fast-spec-pill">
                        <span class="fast-spec-label"><?php e('catalog.fuel'); ?></span>
                        <span class="fast-spec-val"><?php e('fuel_types.' . $vehicle['fuel']); ?></span>
                    </div>
                    <div class="fast-spec-pill">
                        <span class="fast-spec-label"><?php e('catalog.transmission'); ?></span>
                        <span class="fast-spec-val"><?php e('transmission_types.' . $vehicle['transmission']); ?></span>
                    </div>
                    <div class="fast-spec-pill">
                        <span class="fast-spec-label"><?php e('catalog.body_type'); ?></span>
                        <span class="fast-spec-val"><?php e('body_types.' . $vehicle['body']); ?></span>
                    </div>
                    <div class="fast-spec-pill">
                        <span class="fast-spec-label"><?php e('catalog.seats'); ?></span>
                        <span class="fast-spec-val"><?php echo esc($vehicle['seats']); ?> Kişi</span>
                    </div>
                </div>

                <!-- Kurumsal Avantajlar Şeridi (Çerçevesiz & Sade) -->
                <div class="vehicle-guarantees-bar">
                    <div class="vehicle-guarantee-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                        <div>
                            <div class="guarantee-title">7/24 Kesintisiz İkame</div>
                            <div class="guarantee-sub">Anında muadil araç temini</div>
                        </div>
                    </div>
                    <div class="vehicle-guarantee-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        </svg>
                        <div>
                            <div class="guarantee-title">Tam Kapsamlı Kasko</div>
                            <div class="guarantee-sub">Sıfır riskli kurumsal poliçe</div>
                        </div>
                    </div>
                    <div class="vehicle-guarantee-item">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
                        </svg>
                        <div>
                            <div class="guarantee-title">Yetkili Servis Bakımı</div>
                            <div class="guarantee-sub">Tüm periyodik bakımlar</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ─── SAĞ SÜTUN: CANLI FİYAT HESAPLAMA & TEKLİF KARTI ───── -->
            <aside>
                <div class="vehicle-configurator-box">
                    <div class="mb-4">
                        <span class="editorial-tag m-0">Kurumsal Filo Fiyatlandırması</span>
                    </div>

                    <!-- Canlı Hesaplanan Tutar Alanı -->
                    <div class="configurator-price-display" id="calc-price-container">
                        <div class="configurator-price-header">
                            <span class="price-header-label"><?php e('quote_calc.estimated_monthly'); ?></span>
                        </div>
                        <div class="configurator-price-body">
                            <div class="configurator-price-val">
                                <span id="calc-monthly-price"><?php echo number_format($vehicle['starting_price'], 0, ',', '.'); ?></span><span class="currency">₺</span>
                            </div>
                            <div class="configurator-price-sub">
                                <span class="tax-info">/ Ay + KDV</span>
                                <span class="included-tag">Tam Bakım & Kasko Dahil</span>
                            </div>
                        </div>
                    </div>

                    <form id="vehicle-quote-calculator-form" novalidate>
                        <!-- Kiralama Süresi Segment Seçici -->
                        <div class="form-group mb-4">
                            <label class="form-label"><?php e('quote_calc.duration'); ?></label>
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
                            <label for="calc-km-select" class="form-label"><?php e('quote_calc.annual_km'); ?></label>
                            <select id="calc-km-select" name="annual_km" class="form-select">
                                <option value="15">15.000 km / Yıl</option>
                                <option value="20">20.000 km / Yıl</option>
                                <option value="30">30.000 km / Yıl</option>
                            </select>
                        </div>

                        <!-- Hizmet Paketi -->
                        <div class="form-group mb-4">
                            <label for="calc-package-select" class="form-label"><?php e('quote_calc.package'); ?></label>
                            <select id="calc-package-select" name="package" class="form-select">
                                <option value="basic">Başlangıç Paketi</option>
                                <option value="advantage" selected>Avantaj Paketi (Önerilen)</option>
                                <option value="full">Tam Güvence Paketi</option>
                            </select>
                        </div>

                        <!-- Peşinat & Adet Satırı -->
                        <div class="grid grid-2 gap-3 mb-6">
                            <div class="form-group mb-0">
                                <label for="calc-deposit-select" class="form-label"><?php e('quote_calc.deposit'); ?></label>
                                <select id="calc-deposit-select" name="deposit" class="form-select">
                                    <option value="0">Peşinatsız (%0)</option>
                                    <option value="50000">50.000 ₺</option>
                                    <option value="100000">100.000 ₺</option>
                                    <option value="150000">150.000 ₺</option>
                                </select>
                            </div>

                            <div class="form-group mb-0">
                                <label for="calc-count-select" class="form-label"><?php e('quote_calc.count'); ?></label>
                                <select id="calc-count-select" name="vehicle_count" class="form-select">
                                    <option value="1">1 Adet</option>
                                    <option value="2">2 Adet</option>
                                    <option value="3">3 Adet</option>
                                    <option value="5">5 Adet</option>
                                    <option value="10">10+ Adet (Filo)</option>
                                </select>
                            </div>
                        </div>

                        <div class="alert alert-info hidden mb-4" id="calc-custom-offer-notice">
                            <?php e('quote_calc.custom_offer_notice'); ?>
                        </div>

                        <!-- Eylem Butonları -->
                        <div class="flex flex-col gap-3">
                            <a href="<?php echo url('hizli-teklif.php', ['arac' => $vehicle['slug']]); ?>" class="btn btn-primary btn-lg" id="btn-goto-quote" style="justify-content: center; padding: 14px 24px;">
                                Hızlı Teklif Al
                            </a>

                            <div class="grid grid-2 gap-2">
                                <a href="<?php echo url('paket-karsilastir.php', ['arac' => $vehicle['slug']]); ?>" class="btn btn-outline" id="btn-goto-packages" style="justify-content: center; font-size: 13px;">
                                    <?php e('vehicle_detail.compare_packages'); ?>
                                </a>
                                <button type="button" class="btn btn-secondary" style="width: 100%; justify-content: center; font-size: 13px;" data-open-modal="callback">
                                    <?php e('vehicle_detail.call_me'); ?>
                                </button>
                            </div>
                        </div>

                        <div class="quote-summary-disclaimer mt-4 text-center">
                            <?php e('quote_summary.price_disclaimer'); ?>
                        </div>
                    </form>
                </div>
            </aside>
        </div>

    </div>
</section>

<!-- ─── 3. DETAYLI TEKNİK ÖZELLİKLER ─────────────────────────────── -->
<section class="section section-paper" style="padding-top: var(--space-10);">
    <div class="container">
        
        <div class="mb-6">
            <h2 class="text-2xl fw-bold text-dark m-0">Teknik Özellikler ve Donanım</h2>
        </div>

        <div class="specs-modern-grid">
            <?php foreach ($vehicle['specs'] as $groupKey => $groupData): 
                $groupTitle = t('spec_categories.' . $groupKey);
                if (empty($groupTitle)) {
                    $groupTitle = ucfirst($groupKey);
                }
            ?>
                <div class="specs-modern-group">
                    <h3 class="specs-modern-title">
                        <?php echo esc($groupTitle); ?>
                    </h3>
                    <div>
                        <?php foreach ($groupData as $label => $val): ?>
                            <div class="specs-modern-row">
                                <span class="specs-modern-label"><?php echo esc($label); ?></span>
                                <span class="specs-modern-value"><?php echo esc($val); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<!-- ─── 4. BENZER ARAÇLAR BÖLÜMÜ ────────────────────────────────────── -->
<section class="section" style="padding-top: var(--space-12);">
    <div class="container">
        <div class="flex flex-between mb-8 flex-wrap gap-4 items-center">
            <div>
                <h2 class="text-2xl fw-bold text-dark m-0"><?php e('vehicle_detail.similar_vehicles'); ?></h2>
            </div>
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
</section>

<!-- ─── 5. ALT KURUMSAL CTA BANNER ──────────────────────────────────── -->
<section class="section-sm" style="padding-top: 0;">
    <div class="container">
        <div class="solution-cta-card" style="background-image: url('<?php echo asset('images/cta-catalog-bg.jpg'); ?>');">
            <h3>Filonuz İçin Özel Teklif Alın</h3>
            <p>Kuzey Otomotiv Grubu sermaye gücüyle avantajlı fiyat ve esnek operasyonel filo kiralama çözümlerinden yararlanın.</p>
            <div class="solution-cta-actions">
                <a href="<?php echo url('hizli-teklif.php', ['arac' => $mainVehicle['slug']]); ?>" class="btn btn-primary btn-lg"><?php e('header.get_quote'); ?></a>
                <button type="button" class="btn btn-outline btn-lg" data-open-modal="callback"><?php e('home.cta_call'); ?></button>
            </div>
        </div>
    </div>
</section>

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
