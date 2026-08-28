<?php
/**
 * kzyfilo — Arama Sonuçları Sayfası (arama.php)
 * KZY Executive Motion — Comprehensive Corporate Search Results
 */
require_once __DIR__ . '/includes/config.php';

// Verileri yükle
$allVehicles = loadData('vehicles.php');

// Arama sorgusunu al
$searchQuery = trim($_GET['q'] ?? '');
$activeTab = trim($_GET['tab'] ?? 'all'); // 'all', 'vehicles', 'services'

// Türkçe karakterleri normalize eden arama yardımcısı
function normalizeSearchText($text) {
    $text = mb_strtolower((string)$text, 'UTF-8');
    $replacements = [
        'ç' => 'c', 'ğ' => 'g', 'ı' => 'i', 'i' => 'i', 'ö' => 'o', 'ş' => 's', 'ü' => 'u',
        'Ç' => 'c', 'Ğ' => 'g', 'I' => 'i', 'İ' => 'i', 'Ö' => 'o', 'Ş' => 's', 'Ü' => 'u'
    ];
    return str_replace(array_keys($replacements), array_values($replacements), $text);
}

$normalizedQuery = normalizeSearchText($searchQuery);
$queryTokens = array_filter(explode(' ', $normalizedQuery));

// ─── Kurumsal Hizmet ve Sayfa Listesi ────────────────────────────────
$siteServices = [
    [
        'title' => (CURRENT_LANG === 'tr') ? 'Uzun Dönem Araç Kiralama' : 'Long-Term Fleet Rental',
        'desc' => (CURRENT_LANG === 'tr') 
            ? '12 aydan 48 aya kadar kurumsal şirketlere özel operasyonel filo kiralama, sabit maliyet ve sıfır operasyonel risk.'
            : 'Operational fleet leasing for 12-48 months tailored for corporate businesses with fixed costs.',
        'url' => url('uzun-donem-arac-kiralama.php'),
        'badge' => (CURRENT_LANG === 'tr') ? 'Operasyonel Hizmet' : 'Operational Service',
        'icon' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>',
        'keywords' => 'uzun donem yillik operasyonel kiralama filo sozlesme binek ticari 12 ay 24 ay 36 ay 48 ay'
    ],
    [
        'title' => (CURRENT_LANG === 'tr') ? 'Filo Yönetimi & Danışmanlık' : 'Fleet Management & Consulting',
        'desc' => (CURRENT_LANG === 'tr')
            ? 'Şirketinizin araç parkını tek merkezden, telematik takip, yakıt optimizasyonu ve periyodik maliyet raporlamasıyla yönetin.'
            : 'Centralized fleet management with telematics tracking, fuel optimization and cost analysis.',
        'url' => url('filo-yonetimi.php'),
        'badge' => (CURRENT_LANG === 'tr') ? 'Filo Danışmanlığı' : 'Fleet Consulting',
        'icon' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path><path d="M22 12A10 10 0 0 0 12 2v10z"></path></svg>',
        'keywords' => 'filo yonetimi danismanlik masraf takip telematik yakit tasarruf operasyon raporlama'
    ],
    [
        'title' => (CURRENT_LANG === 'tr') ? 'Binek Araç Kiralama' : 'Passenger Fleet Leasing',
        'desc' => (CURRENT_LANG === 'tr')
            ? 'Yönetici sedanları, şirket saha temsilcisi araçları ve prestijli SUV modellerinden oluşan zengin binek filosu.'
            : 'Executive sedans, field fleet vehicles and premium SUVs for corporate companies.',
        'url' => url('binek-arac-kiralama.php'),
        'badge' => (CURRENT_LANG === 'tr') ? 'Araç Kategorisi' : 'Vehicle Category',
        'icon' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 17h14M5 17a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h1.5L8 4h8l1.5 3H19a2 2 0 0 1 2 2v6a2 2 0 0 1-2 2M5 17a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2"></path></svg>',
        'keywords' => 'binek sedan hatchback suv yonetici makam saha binek arac'
    ],
    [
        'title' => (CURRENT_LANG === 'tr') ? 'Ticari Araç Kiralama' : 'Commercial Fleet Rental',
        'desc' => (CURRENT_LANG === 'tr')
            ? 'Lojistik, dağıtım ve saha taşımacılığı için panelvan, hafif ticari ve van modellerinde avantajlı kiralama koşulları.'
            : 'Commercial fleet leasing for logistics, cargo and delivery operations.',
        'url' => url('ticari-arac-kiralama.php'),
        'badge' => (CURRENT_LANG === 'tr') ? 'Ticari Filo' : 'Commercial Fleet',
        'icon' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>',
        'keywords' => 'ticari panelvan van yuk tasima lojistik transit caddy doblo kangoo transit connect custom kurye'
    ],
    [
        'title' => (CURRENT_LANG === 'tr') ? 'Elektrikli Araç Kiralama (EV)' : 'Electric Fleet Leasing',
        'desc' => (CURRENT_LANG === 'tr')
            ? 'Sıfır emisyonlu kurumsal EV filo kiralama, şarj istasyonu altyapısı ve düşük enerji tüketim avantajları.'
            : 'Zero-emission electric vehicle leasing with charging solutions and tax benefits.',
        'url' => url('elektrikli-arac-kiralama.php'),
        'badge' => (CURRENT_LANG === 'tr') ? 'Yeşil Filo' : 'Green Fleet',
        'icon' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>',
        'keywords' => 'elektrikli ev hibrit hybrid sarj batarya sifir emisyon yesil cevre tog e-tron eqs taycan'
    ],
    [
        'title' => (CURRENT_LANG === 'tr') ? 'Hızlı Teklif Formu' : 'Fast Quotation Builder',
        'desc' => (CURRENT_LANG === 'tr')
            ? 'Aracınızı, sözleşme sürenizi ve yıllık kilometrenizi seçerek 4 adımda anında resmi kurumsal teklif oluşturun.'
            : 'Configure your vehicle, duration and mileage to generate an instant corporate quote.',
        'url' => url('hizli-teklif.php'),
        'badge' => (CURRENT_LANG === 'tr') ? 'Online Modül' : 'Online Tool',
        'icon' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>',
        'keywords' => 'teklif hizli fiyat hesapla simule et kiralama ucreti maliyet teklif al online form'
    ],
    [
        'title' => (CURRENT_LANG === 'tr') ? 'Araç Karşılaştırma Modülü' : 'Vehicle Comparison',
        'desc' => (CURRENT_LANG === 'tr')
            ? 'Farklı marka ve modellerin motor, yakıt tüketimi, donanım paketleri ve aylık bedellerini yan yana karşılaştırın.'
            : 'Compare technical specifications, fuel consumption and prices of different vehicles side by side.',
        'url' => url('arac-karsilastir.php'),
        'badge' => (CURRENT_LANG === 'tr') ? 'Karşılaştırma' : 'Comparison',
        'icon' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>',
        'keywords' => 'karsilastir karsilastirma teknik farklar kiyasla motor yakit bagaj'
    ],
    [
        'title' => (CURRENT_LANG === 'tr') ? 'Paket Karşılaştırma' : 'Service Packages Comparison',
        'desc' => (CURRENT_LANG === 'tr')
            ? 'Silver, Gold ve Platinum kurumsal filo bakım, sigorta, lastik ve ikame araç paketlerini inceleyin.'
            : 'Compare Silver, Gold and Platinum fleet maintenance, insurance and replacement packages.',
        'url' => url('paket-karsilastir.php'),
        'badge' => (CURRENT_LANG === 'tr') ? 'Hizmet Paketleri' : 'Service Packages',
        'icon' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>',
        'keywords' => 'paket paketler silver gold platinum kapsam kasko bakim ikame lastik sigorta'
    ],
    [
        'title' => (CURRENT_LANG === 'tr') ? 'Online İşlemler & Destek' : 'Online Operations & Support',
        'desc' => (CURRENT_LANG === 'tr')
            ? 'Periyodik bakım randevusu, 7/24 hasar ve kaza bildirimi, lastik değişimi ve fatura takibi.'
            : 'Schedule maintenance, report damage 24/7, request tire changes and view invoices.',
        'url' => url('online-islemler.php'),
        'badge' => (CURRENT_LANG === 'tr') ? 'Müşteri Portalı' : 'Client Portal',
        'icon' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>',
        'keywords' => 'online islemler bakim randevu hasar kaza lastik fatura destek musteri'
    ],
    [
        'title' => (CURRENT_LANG === 'tr') ? 'Ofislerimiz & Teslimat Noktaları' : 'Offices & Delivery Locations',
        'desc' => (CURRENT_LANG === 'tr')
            ? 'İstanbul Merkez, Ankara, İzmir ofislerimiz ve Türkiye genelinde kapıya teslimat / iade merkezlerimiz.'
            : 'Central offices in Istanbul, Ankara, Izmir and delivery points across Turkey.',
        'url' => url('ofisler.php'),
        'badge' => (CURRENT_LANG === 'tr') ? 'Lokasyonlar' : 'Locations',
        'icon' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>',
        'keywords' => 'ofis ofisler adres sube teslimat iade istanbul ankara izmir havalimani'
    ],
    [
        'title' => (CURRENT_LANG === 'tr') ? 'Sıkça Sorulan Sorular (SSS)' : 'Frequently Asked Questions',
        'desc' => (CURRENT_LANG === 'tr')
            ? 'Operasyonel kiralama avantajları, vergi muafiyeti, sözleşme yenileme ve erken iade şartları.'
            : 'Corporate leasing tax benefits, contract renewals and return conditions.',
        'url' => url('sss.php'),
        'badge' => (CURRENT_LANG === 'tr') ? 'Bilgi Merkezi' : 'Knowledge Base',
        'icon' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>',
        'keywords' => 'sss soru cevap vergi kdv amortisman sozlesme iptal sartlar merak edilenler'
    ],
    [
        'title' => (CURRENT_LANG === 'tr') ? 'İletişim & Kurumsal Danışmanlık' : 'Contact & Fleet Consultation',
        'desc' => (CURRENT_LANG === 'tr')
            ? 'Kurumsal filo danışmanlarımızla doğrudan görüşün: 0850 300 59 99 veya kurumsal@kzyfilo.com.tr.'
            : 'Get in touch with our fleet consultants: 0850 300 59 99 or kurumsal@kzyfilo.com.tr.',
        'url' => url('iletisim.php'),
        'badge' => (CURRENT_LANG === 'tr') ? 'Müşteri Hizmetleri' : 'Customer Support',
        'icon' => '<svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>',
        'keywords' => 'iletisim telefon email adres destek danisman musteri temsilcisi arayin ulasin'
    ]
];

// ─── Eşleştirme Algoritması ──────────────────────────────────────────
$matchingVehicles = [];
$matchingServices = [];

if (!empty($normalizedQuery)) {
    // 1. Araç Eşleştirmesi
    foreach ($allVehicles as $vehicle) {
        $searchHaystack = normalizeSearchText(implode(' ', [
            $vehicle['brand'] ?? '',
            $vehicle['model'] ?? '',
            $vehicle['version'] ?? '',
            $vehicle['category'] ?? '',
            $vehicle['segment'] ?? '',
            $vehicle['fuel'] ?? '',
            $vehicle['transmission'] ?? '',
            $vehicle['body_type'] ?? '',
            $vehicle['engine'] ?? '',
            $vehicle['description'] ?? ''
        ]));

        $match = true;
        foreach ($queryTokens as $token) {
            if (strpos($searchHaystack, $token) === false) {
                $match = false;
                break;
            }
        }

        if ($match) {
            $matchingVehicles[] = $vehicle;
        }
    }

    // 2. Hizmet & Sayfa Eşleştirmesi
    foreach ($siteServices as $service) {
        $searchHaystack = normalizeSearchText(implode(' ', [
            $service['title'] ?? '',
            $service['desc'] ?? '',
            $service['badge'] ?? '',
            $service['keywords'] ?? ''
        ]));

        $match = true;
        foreach ($queryTokens as $token) {
            if (strpos($searchHaystack, $token) === false) {
                $match = false;
                break;
            }
        }

        if ($match) {
            $matchingServices[] = $service;
        }
    }
} else {
    // Sorgu boş ise tüm araçlar ve popüler hizmetler listelensin
    $matchingVehicles = $allVehicles;
    $matchingServices = array_slice($siteServices, 0, 6);
}

$vehicleCount = count($matchingVehicles);
$serviceCount = count($matchingServices);
$totalResultsCount = $vehicleCount + $serviceCount;

// Sayfa Başlığı ve Meta
$pageTitle = !empty($searchQuery) 
    ? htmlspecialchars($searchQuery) . ' — ' . t('search.title') . ' | ' . SITE_NAME
    : t('search.title') . ' | ' . SITE_NAME;

setPageMeta([
    'title' => $pageTitle,
    'description' => t('search.subtitle'),
    'canonical' => canonical('arama.php', !empty($searchQuery) ? ['q' => $searchQuery] : []),
]);

$breadcrumbs = [
    ['title' => t('search.title')]
];

include includePath('header.php');
?>

<!-- ─── SEARCH PAGE HERO BANNER ──────────────────────────────────────── -->
<section class="search-page-hero">
    <div class="container">
        
        <div class="search-hero-content">
            <h1 class="search-hero-title">
                <?php if (!empty($searchQuery)): ?>
                    <span class="search-hero-label"><?php echo (CURRENT_LANG === 'tr') ? 'ARAMA SONUÇLARI' : 'SEARCH RESULTS'; ?></span>
                    <span class="search-hero-query">"<?php echo htmlspecialchars($searchQuery); ?>"</span>
                <?php else: ?>
                    <?php echo (CURRENT_LANG === 'tr') ? 'Filo ve Hizmet Araması' : 'Fleet & Service Search'; ?>
                <?php endif; ?>
            </h1>

            <p class="search-hero-subtitle">
                <?php if (!empty($searchQuery)): ?>
                    <?php if ($totalResultsCount > 0): ?>
                        <?php echo sprintf(
                            (CURRENT_LANG === 'tr') ? 'Aramanız için <strong>%d araç</strong> ve <strong>%d kurumsal çözüm</strong> listelendi.' : 'Found <strong>%d vehicles</strong> and <strong>%d corporate solutions</strong> for your search.',
                            $vehicleCount,
                            $serviceCount
                        ); ?>
                    <?php else: ?>
                        <?php echo (CURRENT_LANG === 'tr') ? 'Aradığınız sonuç bulunamadı.' : 'No results found for your search.'; ?>
                    <?php endif; ?>
                <?php else: ?>
                    <?php echo (CURRENT_LANG === 'tr') ? 'Aradığınız marka, model veya kurumsal kiralama hizmetini hemen bulun.' : 'Search for vehicle models, brands, or corporate rental services.'; ?>
                <?php endif; ?>
            </p>

            <!-- On-Page Search Input Bar -->
            <form action="<?php echo url('arama.php'); ?>" method="GET" class="search-page-form" role="search">
                <div class="search-page-input-wrap">
                    <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" class="search-page-input-icon">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input type="search" 
                           name="q" 
                           class="search-page-input" 
                           placeholder="<?php echo (CURRENT_LANG === 'tr') ? 'Marka, model veya hizmet arayın (örn: Clio, Egea, Hibrit, Ticari)...' : 'Search brand, model or service...'; ?>" 
                           value="<?php echo htmlspecialchars($searchQuery); ?>" 
                           autocomplete="off"
                           required>
                    <button type="submit" class="btn btn-primary search-page-submit-btn">
                        <span><?php echo (CURRENT_LANG === 'tr') ? 'Yeniden Ara' : 'Search'; ?></span>
                    </button>
                </div>
            </form>

            <!-- Quick Search Suggestion Tags -->
            <div class="search-quick-tags">
                <span class="search-quick-tags-label"><?php echo (CURRENT_LANG === 'tr') ? 'Popüler:' : 'Popular:'; ?></span>
                <a href="<?php echo url('arama.php', ['q' => 'Renault Clio']); ?>" class="search-quick-tag">Renault Clio</a>
                <a href="<?php echo url('arama.php', ['q' => 'Fiat Egea']); ?>" class="search-quick-tag">Fiat Egea</a>
                <a href="<?php echo url('arama.php', ['q' => 'Toyota Corolla']); ?>" class="search-quick-tag">Toyota Corolla Hybrid</a>
                <a href="<?php echo url('arama.php', ['q' => 'BMW 320i']); ?>" class="search-quick-tag">BMW 320i</a>
                <a href="<?php echo url('arama.php', ['q' => 'Ticari']); ?>" class="search-quick-tag">Ticari Araç</a>
                <a href="<?php echo url('arama.php', ['q' => 'Elektrikli']); ?>" class="search-quick-tag">Elektrikli & EV</a>
            </div>
        </div>
    </div>
</section>

<!-- ─── SEARCH RESULTS MAIN CONTENT ─────────────────────────────────── -->
<section class="section search-results-section">
    <div class="container">
        
        <?php if ($totalResultsCount > 0): ?>

            <!-- ─── SECTION 1: MATCHING FLEET VEHICLES ──────────────────────── -->
            <?php if ($vehicleCount > 0): ?>
                <div class="search-results-block search-vehicles-block" id="search-block-vehicles">
                    <div class="search-block-header">
                        <div class="search-block-header-info">
                            <span class="editorial-tag"><?php echo (CURRENT_LANG === 'tr') ? 'FİLO ARAÇLARI' : 'FLEET VEHICLES'; ?></span>
                            <h2><?php echo (CURRENT_LANG === 'tr') ? 'Eşleşen Filo Araçları' : 'Matching Fleet Vehicles'; ?></h2>
                            <p><?php echo (CURRENT_LANG === 'tr') ? 'Şirketiniz için hemen teklif alabileceğiniz uygun modeller.' : 'Vehicles ready for corporate fleet leasing quotation.'; ?></p>
                        </div>
                        <span class="search-block-count"><?php echo $vehicleCount; ?> <?php echo (CURRENT_LANG === 'tr') ? 'Araç' : 'Vehicles'; ?></span>
                    </div>

                    <div class="catalog-vehicle-grid search-vehicle-grid">
                        <?php foreach ($matchingVehicles as $vehicle): ?>
                            <?php include includePath('vehicle-card.php'); ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- ─── SECTION 2: MATCHING SERVICES & PAGES ────────────────────── -->
            <?php if ($serviceCount > 0): ?>
                <div class="search-results-block search-services-block" id="search-block-services">
                    <div class="search-block-header">
                        <div class="search-block-header-info">
                            <span class="editorial-tag"><?php echo (CURRENT_LANG === 'tr') ? 'KURUMSAL ÇÖZÜMLER' : 'CORPORATE SOLUTIONS'; ?></span>
                            <h2><?php echo (CURRENT_LANG === 'tr') ? 'İlgili Hizmetler ve Sayfalar' : 'Matching Services & Solutions'; ?></h2>
                            <p><?php echo (CURRENT_LANG === 'tr') ? 'Aramanızla ilgili operasyonel filo kiralama ve yönetim hizmetleri.' : 'Corporate fleet leasing and management services related to your search.'; ?></p>
                        </div>
                        <span class="search-block-count"><?php echo $serviceCount; ?> <?php echo (CURRENT_LANG === 'tr') ? 'Çözüm' : 'Solutions'; ?></span>
                    </div>

                    <div class="search-services-grid-page">
                        <?php foreach ($matchingServices as $service): ?>
                            <a href="<?php echo $service['url']; ?>" class="search-service-card-page">
                                <div class="search-service-card-top">
                                    <div class="search-service-card-icon">
                                        <?php echo $service['icon']; ?>
                                    </div>
                                    <span class="search-service-card-badge"><?php echo $service['badge']; ?></span>
                                </div>
                                <h3 class="search-service-card-title"><?php echo $service['title']; ?></h3>
                                <p class="search-service-card-desc"><?php echo $service['desc']; ?></p>
                                <div class="search-service-card-footer">
                                    <span class="search-service-card-link-text">
                                        <?php echo (CURRENT_LANG === 'tr') ? 'İncele & Teklif Al' : 'Explore Solution'; ?> &rarr;
                                    </span>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

        <?php else: ?>

            <!-- ─── EMPTY STATE: NO RESULTS FOUND ───────────────────────────── -->
            <div class="search-empty-state-page">
                <div class="search-empty-icon-wrap">
                    <svg viewBox="0 0 24 24" width="64" height="64" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        <line x1="8" y1="11" x2="14" y2="11"></line>
                    </svg>
                </div>

                <span class="editorial-tag"><?php echo (CURRENT_LANG === 'tr') ? 'SONUÇ BULUNAMADI' : 'NO MATCHES'; ?></span>
                <h2>"<?php echo htmlspecialchars($searchQuery); ?>" <?php echo (CURRENT_LANG === 'tr') ? 'için sonuç bulunamadı' : 'did not match any results'; ?></h2>
                <p>
                    <?php echo (CURRENT_LANG === 'tr') 
                        ? 'Aradığınız kriterlere uygun araç veya hizmet bulunamadı. Yazım hatası yapmış olabilirsiniz veya daha genel bir terim deneyebilirsiniz.'
                        : 'No fleet vehicles or services matched your search terms. Please check your spelling or try more general keywords.'; ?>
                </p>

                <!-- Search Suggestions Box -->
                <div class="search-empty-suggestions-box">
                    <h4><?php echo (CURRENT_LANG === 'tr') ? 'Arama İpuçları:' : 'Search Tips:'; ?></h4>
                    <ul>
                        <li><?php echo (CURRENT_LANG === 'tr') ? 'Kelimenin doğru yazıldığından emin olun (örn: "Clio", "Corolla", "Megane").' : 'Check for proper spelling of vehicle names.'; ?></li>
                        <li><?php echo (CURRENT_LANG === 'tr') ? 'Kategori araması yapmayı deneyin (örn: "Sedan", "SUV", "Ticari", "Hibrit").' : 'Try searching by category (e.g. "Sedan", "SUV", "Commercial", "Hybrid").'; ?></li>
                        <li><?php echo (CURRENT_LANG === 'tr') ? 'Geniş kapsamlı kurumsal araç kataloğumuzu doğrudan filtreleyin.' : 'Browse and filter our comprehensive corporate fleet catalog.'; ?></li>
                    </ul>
                </div>

                <div class="search-empty-actions">
                    <a href="<?php echo url('araclar.php'); ?>" class="btn btn-primary btn-lg">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                        <span><?php echo (CURRENT_LANG === 'tr') ? 'Tüm Araç Kataloğunu İncele' : 'Explore Vehicle Catalog'; ?></span>
                    </a>
                    <a href="<?php echo url('hizli-teklif.php'); ?>" class="btn btn-outline btn-lg">
                        <span><?php echo (CURRENT_LANG === 'tr') ? 'Özel Filo Teklifi İsteyin' : 'Request Custom Quote'; ?></span>
                    </a>
                </div>
            </div>

        <?php endif; ?>

    </div>
</section>

<!-- ─── BOTTOM CORPORATE FLEET CONSULTATION BANNER ────────────────────── -->
<section class="section search-bottom-cta-section">
    <div class="container">
        <div class="search-bottom-cta-card">
            <div class="search-bottom-cta-content">
                <span class="editorial-tag"><?php echo (CURRENT_LANG === 'tr') ? 'ÖZEL KURUMSAL ÇÖZÜMLER' : 'CUSTOM FLEET SOLUTIONS'; ?></span>
                <h2><?php echo (CURRENT_LANG === 'tr') ? 'Aradığınız Özel Modeli veya Filo Adedini Bulamadınız mı?' : "Can't Find Your Desired Model or Fleet Size?"; ?></h2>
                <p>
                    <?php echo (CURRENT_LANG === 'tr')
                        ? 'Şirketinizin ihtiyaç duyduğu özel marka, model, donanım veya adetler için kurumsal filo danışmanlarımız 15 dakika içinde şirketinize özel teklif hazırlasın.'
                        : 'Our corporate fleet consultants will prepare a customized proposal tailored to your business needs within 15 minutes.'; ?>
                </p>
                <div class="search-bottom-cta-buttons">
                    <a href="<?php echo url('hizli-teklif.php'); ?>" class="btn btn-primary">
                        <?php echo (CURRENT_LANG === 'tr') ? 'Hızlı Teklif İste' : 'Request Quick Quote'; ?>
                    </a>
                    <a href="tel:08503005999" class="btn btn-outline" style="color: #ffffff; border-color: rgba(255,255,255,0.3);">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                        <span>0850 300 59 99</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include includePath('footer.php'); ?>
