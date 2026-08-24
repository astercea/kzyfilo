<?php
/**
 * kzyfilo — Ana Sayfa (index.php)
 */
require_once __DIR__ . '/includes/config.php';

// Verileri yükle
$vehicles = loadData('vehicles.php');
$articlesData = loadData('articles.php');
$articles = $articlesData['articles'] ?? [];

// Sayfa meta bilgileri
setPageMeta([
    'title' => t('home.title') . ' | ' . SITE_NAME . ' - ' . t('site_tagline'),
    'description' => t('home.meta_desc'),
    'canonical' => canonical(),
]);

include includePath('header.php');
?>

<!-- ─── 1. HERO SLIDER ────────────────────────────────────────────── -->
<section class="hero" aria-label="Öne Çıkan Kampanyalar ve Araçlar">
    <div class="slider" id="hero-slider" tabindex="0" aria-roledescription="carousel" aria-label="Hero Carousel">
        <div class="slider-track">
            <!-- Slide 1: Kurumsal Filo Çözümleri -->
            <div class="slider-slide hero-slide is-active" role="group" aria-roledescription="slide" aria-label="1 / 3">
                <span class="hero-slide-number">01</span>
                <div class="hero-bg" data-parallax="10">
                    <img src="<?php echo asset('images/banners/hero-banner-1.jpg'); ?>" alt="kzyfilo Kurumsal Filo Kiralama" width="1920" height="640">
                </div>
                <div class="container">
                    <div class="hero-content" data-reveal="fade-right">
                        <span class="hero-subtitle">KZY Filo — Gece Yolculuğu Ayrıcalığı</span>
                        <h1 class="hero-title">Filonuzu Geleceğin Yoluna Taşıyın</h1>
                        <p class="hero-desc"><?php e('home.hero_desc_1'); ?></p>

                        <div class="hero-price">
                            <span class="demo-notice" style="color: var(--text-muted);"><?php e('demo_price'); ?></span>
                            <span class="hero-price-value">14.850 <?php e('currency'); ?></span>
                            <span class="hero-price-suffix"><?php e('per_month'); ?> <?php e('vat_excluded'); ?></span>
                        </div>

                        <div class="hero-actions">
                            <a href="<?php echo url('araclar.php'); ?>" class="btn btn-primary btn-lg">
                                <?php e('home.hero_cta_vehicles'); ?>
                            </a>
                            <a href="<?php echo url('hizli-teklif.php'); ?>" class="btn btn-outline btn-lg" style="color: #fff; border-color: rgba(255,255,255,0.25);">
                                <?php e('home.hero_cta_quote'); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2: Elektrikli Filo Dönüşümü -->
            <div class="slider-slide hero-slide" role="group" aria-roledescription="slide" aria-label="2 / 3">
                <span class="hero-slide-number">02</span>
                <div class="hero-bg" data-parallax="10">
                    <img src="<?php echo asset('images/banners/hero-banner-2.jpg'); ?>" alt="kzyfilo Elektrikli Filo Dönüşümü" width="1920" height="640">
                </div>
                <div class="container">
                    <div class="hero-content">
                        <span class="hero-subtitle"><?php echo (CURRENT_LANG === 'tr') ? 'Sürdürülebilir Mobilite' : 'Sustainable Mobility'; ?></span>
                        <h2 class="hero-title"><?php echo (CURRENT_LANG === 'tr') ? '%100 Elektrikli Filo Dönüşümü' : '100% Electric Fleet Transformation'; ?></h2>
                        <p class="hero-desc"><?php echo (CURRENT_LANG === 'tr') ? 'Sıfır emisyon ve düşük yakıt maliyetiyle geleceğin kurumsal filosunu bugün kurun.' : 'Build the corporate fleet of the future today with zero emissions and low fuel costs.'; ?></p>

                        <div class="hero-price">
                            <span class="demo-notice" style="color: var(--text-muted);"><?php e('demo_price'); ?></span>
                            <span class="hero-price-value">26.200 <?php e('currency'); ?></span>
                            <span class="hero-price-suffix"><?php e('per_month'); ?> <?php e('vat_excluded'); ?></span>
                        </div>

                        <div class="hero-actions">
                            <a href="<?php echo url('elektrikli-arac-kiralama.php'); ?>" class="btn btn-primary btn-lg">
                                <?php echo (CURRENT_LANG === 'tr') ? 'Elektrikli Modelleri İncele' : 'Explore Electric Models'; ?>
                            </a>
                            <a href="<?php echo url('filo-teklif.php'); ?>" class="btn btn-outline btn-lg" style="color: #fff; border-color: rgba(255,255,255,0.25);">
                                <?php e('home.hero_cta_quote'); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 3: Premium ve Yönetici Filosu -->
            <div class="slider-slide hero-slide" role="group" aria-roledescription="slide" aria-label="3 / 3">
                <span class="hero-slide-number">03</span>
                <div class="hero-bg" data-parallax="10">
                    <img src="<?php echo asset('images/banners/hero-banner-3.jpg'); ?>" alt="kzyfilo Yönetici ve Premium Filo" width="1920" height="640">
                </div>
                <div class="container">
                    <div class="hero-content">
                        <span class="hero-subtitle"><?php echo (CURRENT_LANG === 'tr') ? 'Yönetici & Premium Filo' : 'Executive & Premium Fleet'; ?></span>
                        <h2 class="hero-title"><?php echo (CURRENT_LANG === 'tr') ? 'Kurumsal Prestij ve Üst Düzey Konfor' : 'Corporate Prestige & Executive Comfort'; ?></h2>
                        <p class="hero-desc"><?php echo (CURRENT_LANG === 'tr') ? 'Üst segment sedan ve SUV modelleriyle yöneticilerinize kusursuz sürüş ayrıcalığı yaşatın.' : 'Provide your executives with premium driving privilege with luxury sedans and SUVs.'; ?></p>

                        <div class="hero-price">
                            <span class="demo-notice" style="color: var(--text-muted);"><?php e('demo_price'); ?></span>
                            <span class="hero-price-value">46.500 <?php e('currency'); ?></span>
                            <span class="hero-price-suffix"><?php e('per_month'); ?> <?php e('vat_excluded'); ?></span>
                        </div>

                        <div class="hero-actions">
                            <a href="<?php echo url('araclar.php', ['kategori' => 'premium']); ?>" class="btn btn-primary btn-lg">
                                <?php echo (CURRENT_LANG === 'tr') ? 'Premium Filoyu Keşfet' : 'Discover Premium Fleet'; ?>
                            </a>
                            <a href="<?php echo url('hizli-teklif.php'); ?>" class="btn btn-outline btn-lg" style="color: #fff; border-color: rgba(255,255,255,0.25);">
                                <?php e('home.hero_cta_quote'); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slider Controls -->
        <button type="button" class="slider-btn slider-prev" aria-label="<?php e('pagination.previous'); ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <polyline points="15 18 9 12 15 6"></polyline>
            </svg>
        </button>
        <button type="button" class="slider-btn slider-next" aria-label="<?php e('pagination.next'); ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <polyline points="9 18 15 12 9 6"></polyline>
            </svg>
        </button>

        <!-- Dots -->
        <div class="slider-dots" role="tablist" aria-label="Slayt Seçimi">
            <button type="button" class="slider-dot is-active" data-index="0" role="tab" aria-selected="true" aria-label="Slayt 1"></button>
            <button type="button" class="slider-dot" data-index="1" role="tab" aria-selected="false" aria-label="Slayt 2"></button>
            <button type="button" class="slider-dot" data-index="2" role="tab" aria-selected="false" aria-label="Slayt 3"></button>
        </div>
    </div>
</section>

<!-- ─── 2. QUICK SEARCH PANEL ────────────────────────────────────── -->
<section class="quick-search" data-reveal="fade-up">
    <div class="container">
        <form action="<?php echo url('araclar.php'); ?>" method="GET" class="quick-search-panel" role="search" aria-label="Hızlı Araç Bulma" data-spotlight>
            <h3><?php e('home.search_title'); ?></h3>
            <div class="quick-search-grid">
                <!-- Marka -->
                <div class="quick-search-field">
                    <label for="search-brand"><?php e('catalog.brand'); ?></label>
                    <select id="search-brand" name="marka" class="form-select">
                        <option value=""><?php e('catalog.all'); ?></option>
                        <option value="Renault">Renault</option>
                        <option value="Fiat">Fiat</option>
                        <option value="Toyota">Toyota</option>
                        <option value="Hyundai">Hyundai</option>
                        <option value="BMW">BMW</option>
                        <option value="MG">MG</option>
                        <option value="Ford">Ford</option>
                        <option value="Volkswagen">Volkswagen</option>
                    </select>
                </div>

                <!-- Kasa Tipi -->
                <div class="quick-search-field">
                    <label for="search-body"><?php e('catalog.body_type'); ?></label>
                    <select id="search-body" name="kasa" class="form-select">
                        <option value=""><?php e('catalog.all'); ?></option>
                        <option value="sedan"><?php e('body_types.sedan'); ?></option>
                        <option value="hatchback"><?php e('body_types.hatchback'); ?></option>
                        <option value="suv"><?php e('body_types.suv'); ?></option>
                        <option value="minivan"><?php e('body_types.minivan'); ?></option>
                        <option value="panelvan"><?php e('body_types.panelvan'); ?></option>
                    </select>
                </div>

                <!-- Yakıt -->
                <div class="quick-search-field">
                    <label for="search-fuel"><?php e('catalog.fuel'); ?></label>
                    <select id="search-fuel" name="yakit" class="form-select">
                        <option value=""><?php e('catalog.all'); ?></option>
                        <option value="benzin"><?php e('fuel_types.benzin'); ?></option>
                        <option value="dizel"><?php e('fuel_types.dizel'); ?></option>
                        <option value="hibrit"><?php e('fuel_types.hibrit'); ?></option>
                        <option value="elektrik"><?php e('fuel_types.elektrik'); ?></option>
                    </select>
                </div>

                <!-- Vites -->
                <div class="quick-search-field">
                    <label for="search-trans"><?php e('catalog.transmission'); ?></label>
                    <select id="search-trans" name="vites" class="form-select">
                        <option value=""><?php e('catalog.all'); ?></option>
                        <option value="otomatik"><?php e('transmission_types.otomatik'); ?></option>
                        <option value="manuel"><?php e('transmission_types.manuel'); ?></option>
                    </select>
                </div>

                <!-- Kategori -->
                <div class="quick-search-field">
                    <label for="search-cat"><?php e('catalog.category'); ?></label>
                    <select id="search-cat" name="kategori" class="form-select">
                        <option value=""><?php e('catalog.all'); ?></option>
                        <option value="binek"><?php e('categories.binek'); ?></option>
                        <option value="ticari"><?php e('categories.ticari'); ?></option>
                        <option value="elektrikli"><?php e('categories.elektrikli'); ?></option>
                        <option value="kampanyali"><?php e('categories.kampanyali'); ?></option>
                    </select>
                </div>

                <!-- Fiyat -->
                <div class="quick-search-field">
                    <label for="search-price"><?php e('catalog.max_price'); ?></label>
                    <select id="search-price" name="maks_fiyat" class="form-select">
                        <option value=""><?php e('catalog.all'); ?></option>
                        <option value="20000">20.000 <?php e('currency'); ?> altı</option>
                        <option value="30000">30.000 <?php e('currency'); ?> altı</option>
                        <option value="40000">40.000 <?php e('currency'); ?> altı</option>
                        <option value="50000">50.000 <?php e('currency'); ?> altı</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="btn btn-primary" style="width: 100%; min-height: 44px;">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        <span><?php e('home.search_btn'); ?></span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- ─── 3. HORIZONTAL SCROLL SECTION: "Filonuz İçin Akıllı Seçenekler" ─ -->
<section class="horizontal-scroll-wrapper" aria-label="Filonuz İçin Akıllı Seçenekler">
    <div class="horizontal-scroll-sticky">
        <div class="horizontal-center-aura" id="horizontal-center-aura" aria-hidden="true"></div>

        <div class="container horizontal-scroll-header" data-reveal="fade-down">
            <span class="horizontal-scroll-header-badge">KZY FİLO ÇÖZÜMLERİ</span>
            <h2 class="text-3xl" style="color: var(--text-white); margin-bottom: 4px;">Filonuz İçin Akıllı Seçenekler</h2>
            <p style="color: var(--text-muted); margin-bottom: 0;">Şirketinizin dinamiklerine özel uzun dönem kiralama ve filo mobilite paketleri.</p>
        </div>

        <div class="horizontal-scroll-container">
            <div class="horizontal-scroll-track">
                <!-- 1. Binek Araçlar -->
                <a href="<?php echo url('binek-arac-kiralama.php'); ?>" class="night-card" data-spotlight>
                    <div>
                        <div class="night-card-tag"><span class="night-card-icon">🚗</span> Konfor & Verimlilik</div>
                        <h3 class="night-card-title">Binek Araçlar</h3>
                        <p class="night-card-desc">Saha çalışanları ve orta kademe yöneticiler için ekonomik sedan, hatchback ve kompakt SUV modelleri.</p>
                    </div>
                    <div class="night-card-image-wrap">
                        <img src="<?php echo asset('images/vehicles/renault-megane.svg'); ?>" alt="Binek Araçlar" class="night-card-img" onerror="this.src='<?php echo asset('images/vehicles/placeholder.svg'); ?>'">
                    </div>
                    <div class="night-card-footer">
                        <span class="night-card-action">Modelleri İncele</span>
                        <div class="night-card-arrow">→</div>
                    </div>
                </a>

                <!-- 2. Ticari Araçlar -->
                <a href="<?php echo url('ticari-arac-kiralama.php'); ?>" class="night-card" data-spotlight>
                    <div>
                        <div class="night-card-tag"><span class="night-card-icon">🚚</span> Yüksek Kapasite</div>
                        <h3 class="night-card-title">Ticari Araçlar</h3>
                        <p class="night-card-desc">Lojistik ve dağıtım filonuz için geniş yük hacimli hafif ticari, van ve kamyonet çözümleri.</p>
                    </div>
                    <div class="night-card-image-wrap">
                        <img src="<?php echo asset('images/vehicles/ford-transit-custom.svg'); ?>" alt="Ticari Araçlar" class="night-card-img" onerror="this.src='<?php echo asset('images/vehicles/placeholder.svg'); ?>'">
                    </div>
                    <div class="night-card-footer">
                        <span class="night-card-action">Modelleri İncele</span>
                        <div class="night-card-arrow">→</div>
                    </div>
                </a>

                <!-- 3. Elektrikli Araçlar -->
                <a href="<?php echo url('elektrikli-arac-kiralama.php'); ?>" class="night-card" data-spotlight>
                    <div>
                        <div class="night-card-tag"><span class="night-card-icon">⚡</span> Sıfır Emisyon</div>
                        <h3 class="night-card-title">Elektrikli Araçlar</h3>
                        <p class="night-card-desc">%100 elektrikli, düşük tüketim maliyetli ve çevre dostu yeni nesil filo dönüşümü.</p>
                    </div>
                    <div class="night-card-image-wrap">
                        <img src="<?php echo asset('images/vehicles/mg-mg4-electric.svg'); ?>" alt="Elektrikli Araçlar" class="night-card-img" onerror="this.src='<?php echo asset('images/vehicles/placeholder.svg'); ?>'">
                    </div>
                    <div class="night-card-footer">
                        <span class="night-card-action">Modelleri İncele</span>
                        <div class="night-card-arrow">→</div>
                    </div>
                </a>

                <!-- 4. Premium Filo -->
                <a href="<?php echo url('araclar.php', ['kategori' => 'premium']); ?>" class="night-card" data-spotlight>
                    <div>
                        <div class="night-card-tag"><span class="night-card-icon">💎</span> Üst Düzey Prestij</div>
                        <h3 class="night-card-title">Premium Filo</h3>
                        <p class="night-card-desc">Üst düzey yöneticiler ve kurumsal prestij için lüks D segment sedan ve premium SUV ayrıcalığı.</p>
                    </div>
                    <div class="night-card-image-wrap">
                        <img src="<?php echo asset('images/vehicles/bmw-320i-sedan.svg'); ?>" alt="Premium Filo" class="night-card-img" onerror="this.src='<?php echo asset('images/vehicles/placeholder.svg'); ?>'">
                    </div>
                    <div class="night-card-footer">
                        <span class="night-card-action">Modelleri İncele</span>
                        <div class="night-card-arrow">→</div>
                    </div>
                </a>

                <!-- 5. Hızlı Teslim -->
                <a href="<?php echo url('araclar.php', ['hizli_teslim' => '1']); ?>" class="night-card" data-spotlight>
                    <div>
                        <div class="night-card-tag"><span class="night-card-icon">⏱️</span> Hazır Stok</div>
                        <h3 class="night-card-title">Hızlı Teslim Filo</h3>
                        <p class="night-card-desc">Sözleşme onayı sonrası beklemeden, derhal teslim edilen sıfır kilometre hazır stok araçları.</p>
                    </div>
                    <div class="night-card-image-wrap">
                        <img src="<?php echo asset('images/vehicles/fiat-egea-sedan.svg'); ?>" alt="Hızlı Teslim Filo" class="night-card-img" onerror="this.src='<?php echo asset('images/vehicles/placeholder.svg'); ?>'">
                    </div>
                    <div class="night-card-footer">
                        <span class="night-card-action">Stokları Gör</span>
                        <div class="night-card-arrow">→</div>
                    </div>
                </a>

                <!-- 6. Kampanyalı Araçlar -->
                <a href="<?php echo url('araclar.php', ['kategori' => 'kampanyali']); ?>" class="night-card" data-spotlight>
                    <div>
                        <div class="night-card-tag"><span class="night-card-icon">🏷️</span> Maliyet Avantajı</div>
                        <h3 class="night-card-title">Kampanyalı Araçlar</h3>
                        <p class="night-card-desc">Dönemsel avantajlı fiyatlar ve esnek ödeme planlarıyla bütçenizi koruyan kiralama fırsatları.</p>
                    </div>
                    <div class="night-card-image-wrap">
                        <img src="<?php echo asset('images/vehicles/hyundai-i20.svg'); ?>" alt="Kampanyalı Araçlar" class="night-card-img" onerror="this.src='<?php echo asset('images/vehicles/placeholder.svg'); ?>'">
                    </div>
                    <div class="night-card-footer">
                        <span class="night-card-action">Fırsatları İncele</span>
                        <div class="night-card-arrow">→</div>
                    </div>
                </a>

                <!-- 7. Filo Yönetimi -->
                <a href="<?php echo url('filo-yonetimi.php'); ?>" class="night-card" data-spotlight>
                    <div>
                        <div class="night-card-tag"><span class="night-card-icon">📊</span> Operasyonel Güç</div>
                        <h3 class="night-card-title">Bütünleşik Filo Yönetimi</h3>
                        <p class="night-card-desc">Periyodik bakım, muayene, vergi, lastik ve 7/24 ikame araç operasyonlarının sıfır riskle yönetimi.</p>
                    </div>
                    <div class="night-card-image-wrap">
                        <img src="<?php echo asset('images/vehicles/placeholder.svg'); ?>" alt="Filo Yönetimi" class="night-card-img">
                    </div>
                    <div class="night-card-footer">
                        <span class="night-card-action">Hizmet Detayları</span>
                        <div class="night-card-arrow">→</div>
                    </div>
                </a>

                <!-- 8. Ek Ürün ve Hizmetler -->
                <a href="<?php echo url('ek-urun-ve-hizmetler.php'); ?>" class="night-card" data-spotlight>
                    <div>
                        <div class="night-card-tag"><span class="night-card-icon">🛡️</span> Esnek Güvence</div>
                        <h3 class="night-card-title">Ek Ürün ve Hizmetler</h3>
                        <p class="night-card-desc">Kış lastiği saklama, mini hasar muafiyeti, yakıt optimizasyon çipi ve VIP transfer paketleri.</p>
                    </div>
                    <div class="night-card-image-wrap">
                        <img src="<?php echo asset('images/vehicles/placeholder.svg'); ?>" alt="Ek Hizmetler" class="night-card-img">
                    </div>
                    <div class="night-card-footer">
                        <span class="night-card-action">Paketleri Gör</span>
                        <div class="night-card-arrow">→</div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Custom Progress Line -->
        <div class="horizontal-progress-wrapper" data-reveal="fade-up">
            <div class="horizontal-progress-bar">
                <div class="horizontal-progress-fill" id="horizontal-progress-fill"></div>
                <div class="horizontal-progress-dot" id="horizontal-progress-dot"></div>
            </div>
        </div>
    </div>
</section>

<!-- ─── 4. ÖNE ÇIKAN ARAÇLAR CAROUSEL ─────────────────────────────── -->
<section class="section section-bg-soft" aria-labelledby="featured-title" data-reveal="fade-up">
    <div class="container">
        <div class="flex flex-between mb-8 flex-wrap gap-4">
            <div>
                <h2 id="featured-title"><?php e('home.featured_title'); ?></h2>
                <p class="text-muted"><?php e('home.featured_subtitle'); ?></p>
            </div>
            <div class="flex items-center gap-3">
                <a href="<?php echo url('araclar.php'); ?>" class="btn btn-outline btn-sm">
                    <?php e('btn.view_all'); ?>
                </a>
            </div>
        </div>

        <div class="carousel" id="featured-carousel">
            <div class="carousel-track">
                <?php foreach (array_slice($vehicles, 0, 6) as $vehicle): ?>
                    <?php include includePath('vehicle-card.php'); ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- ─── 4. ARAÇ KATEGORİLERİ ──────────────────────────────────────── -->
<section class="section" aria-labelledby="categories-title" data-reveal="fade-up">
    <div class="container">
        <div class="section-header">
            <h2 id="categories-title"><?php e('home.categories_title'); ?></h2>
            <p><?php e('home.categories_subtitle'); ?></p>
        </div>

        <div class="grid grid-6">
            <!-- Binek -->
            <a href="<?php echo url('araclar.php', ['kategori' => 'binek']); ?>" class="category-card" data-spotlight data-reveal="fade-up" data-reveal-delay="50">
                <div class="category-card-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.5 2.8C2.1 11 2 11.5 2 12v4c0 .6.4 1 1 1h2"></path>
                        <circle cx="7" cy="17" r="2"></circle>
                        <circle cx="17" cy="17" r="2"></circle>
                    </svg>
                </div>
                <h4><?php e('categories.binek'); ?></h4>
                <p><?php echo (CURRENT_LANG === 'tr') ? 'Sedan, HB, SUV' : 'Sedan, HB, SUV'; ?></p>
            </a>

            <!-- Ticari -->
            <a href="<?php echo url('araclar.php', ['kategori' => 'ticari']); ?>" class="category-card" data-spotlight data-reveal="fade-up" data-reveal-delay="100">
                <div class="category-card-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="1" y="3" width="15" height="13"></rect>
                        <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                        <circle cx="5.5" cy="18.5" r="2.5"></circle>
                        <circle cx="18.5" cy="18.5" r="2.5"></circle>
                    </svg>
                </div>
                <h4><?php e('categories.ticari'); ?></h4>
                <p><?php echo (CURRENT_LANG === 'tr') ? 'Panelvan & Kamyonet' : 'Van & Pickup'; ?></p>
            </a>

            <!-- Elektrikli -->
            <a href="<?php echo url('araclar.php', ['kategori' => 'elektrikli']); ?>" class="category-card" data-spotlight data-reveal="fade-up" data-reveal-delay="150">
                <div class="category-card-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                    </svg>
                </div>
                <h4><?php e('categories.elektrikli'); ?></h4>
                <p><?php echo (CURRENT_LANG === 'tr') ? '%100 Elektrik & Hibrit' : '100% Electric & Hybrid'; ?></p>
            </a>

            <!-- Kampanyalı -->
            <a href="<?php echo url('araclar.php', ['kampanya' => '1']); ?>" class="category-card" data-spotlight data-reveal="fade-up" data-reveal-delay="200">
                <div class="category-card-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                        <line x1="7" y1="7" x2="7.01" y2="7"></line>
                    </svg>
                </div>
                <h4><?php e('categories.kampanyali'); ?></h4>
                <p><?php echo (CURRENT_LANG === 'tr') ? 'Özel İndirimli Fiyatlar' : 'Special Discounted Rates'; ?></p>
            </a>

            <!-- Premium -->
            <a href="<?php echo url('araclar.php', ['premium' => '1']); ?>" class="category-card" data-spotlight data-reveal="fade-up" data-reveal-delay="250">
                <div class="category-card-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                </div>
                <h4><?php e('categories.premium'); ?></h4>
                <p><?php echo (CURRENT_LANG === 'tr') ? 'Üst Segment & Prestij' : 'Executive & Luxury'; ?></p>
            </a>

            <!-- Hızlı Teslim -->
            <a href="<?php echo url('araclar.php', ['hizli_teslim' => '1']); ?>" class="category-card" data-spotlight data-reveal="fade-up" data-reveal-delay="300">
                <div class="category-card-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                </div>
                <h4><?php e('categories.hizli-teslim'); ?></h4>
                <p><?php echo (CURRENT_LANG === 'tr') ? 'Hemen Teslim Araçlar' : 'Immediate Stock Delivery'; ?></p>
            </a>
        </div>
    </div>
</section>

<!-- ─── 5. İSTATİSTİKLER (DEMO) ───────────────────────────────────── -->
<section class="section section-dark" aria-labelledby="stats-title" data-reveal="fade-up">
    <div class="container">
        <div class="section-header">
            <h2 id="stats-title"><?php e('home.stats_title'); ?></h2>
            <p><span class="demo-notice" style="color: rgba(255,255,255,0.6);"><?php e('home.stats_subtitle'); ?></span></p>
        </div>

        <div class="stats-grid">
            <div class="stat-item" data-spotlight data-reveal="fade-up" data-reveal-delay="50">
                <div class="stat-number" data-counter="10000" data-counter-suffix="+">10.000+</div>
                <div class="stat-label"><?php echo (CURRENT_LANG === 'tr') ? 'Aktif Filo Aracı (Demo)' : 'Active Fleet Vehicles (Demo)'; ?></div>
            </div>
            <div class="stat-item" data-spotlight data-reveal="fade-up" data-reveal-delay="100">
                <div class="stat-number" data-counter="1250" data-counter-suffix="+">1.250+</div>
                <div class="stat-label"><?php echo (CURRENT_LANG === 'tr') ? 'Kurumsal Müşteri (Demo)' : 'Corporate Clients (Demo)'; ?></div>
            </div>
            <div class="stat-item" data-spotlight data-reveal="fade-up" data-reveal-delay="150">
                <div class="stat-number" data-counter="81" data-counter-suffix="">81</div>
                <div class="stat-label"><?php echo (CURRENT_LANG === 'tr') ? 'İlde Yetkili Servis Ağı' : 'Provinces Authorized Service'; ?></div>
            </div>
            <div class="stat-item" data-spotlight data-reveal="fade-up" data-reveal-delay="200">
                <div class="stat-number" data-counter="98" data-counter-prefix="%" data-counter-suffix="">%98</div>
                <div class="stat-label"><?php echo (CURRENT_LANG === 'tr') ? 'Müşteri Memnuniyeti (Demo)' : 'Customer Satisfaction (Demo)'; ?></div>
            </div>
            <div class="stat-item" data-spotlight data-reveal="fade-up" data-reveal-delay="250">
                <div class="stat-number" data-counter="24" data-counter-suffix="/7" data-counter-separator="false">7/24</div>
                <div class="stat-label"><?php echo (CURRENT_LANG === 'tr') ? 'Kesintisiz Yol Yardım' : 'Continuous Roadside Assist'; ?></div>
            </div>
        </div>
    </div>
</section>

<!-- ─── 6. 5 ADIMLI KİRALAMA SÜRECİ ───────────────────────────────── -->
<section class="section section-bg-soft" aria-labelledby="process-title" data-reveal="fade-up">
    <div class="container">
        <div class="section-header">
            <h2 id="process-title"><?php e('home.process_title'); ?></h2>
            <p><?php e('home.process_subtitle'); ?></p>
        </div>

        <div class="process-steps">
            <!-- Adım 1 -->
            <div class="process-step" data-reveal="fade-up" data-reveal-delay="50">
                <div class="process-step-number">1</div>
                <div class="process-step-connector" aria-hidden="true"></div>
                <h4><?php e('home.process_step1_title'); ?></h4>
                <p><?php e('home.process_step1_desc'); ?></p>
            </div>

            <!-- Adım 2 -->
            <div class="process-step" data-reveal="fade-up" data-reveal-delay="100">
                <div class="process-step-number">2</div>
                <div class="process-step-connector" aria-hidden="true"></div>
                <h4><?php e('home.process_step2_title'); ?></h4>
                <p><?php e('home.process_step2_desc'); ?></p>
            </div>

            <!-- Adım 3 -->
            <div class="process-step" data-reveal="fade-up" data-reveal-delay="150">
                <div class="process-step-number">3</div>
                <div class="process-step-connector" aria-hidden="true"></div>
                <h4><?php e('home.process_step3_title'); ?></h4>
                <p><?php e('home.process_step3_desc'); ?></p>
            </div>

            <!-- Adım 4 -->
            <div class="process-step" data-reveal="fade-up" data-reveal-delay="200">
                <div class="process-step-number">4</div>
                <div class="process-step-connector" aria-hidden="true"></div>
                <h4><?php e('home.process_step4_title'); ?></h4>
                <p><?php e('home.process_step4_desc'); ?></p>
            </div>

            <!-- Adım 5 -->
            <div class="process-step" data-reveal="fade-up" data-reveal-delay="250">
                <div class="process-step-number">5</div>
                <h4><?php e('home.process_step5_title'); ?></h4>
                <p><?php e('home.process_step5_desc'); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- ─── 7. FİLO ÇÖZÜMLERİMİZ (ACCORDION) ──────────────────────────── -->
<section class="section" aria-labelledby="solutions-title" data-reveal="fade-up">
    <div class="container">
        <div class="section-header">
            <h2 id="solutions-title"><?php e('home.solutions_title'); ?></h2>
            <p><?php e('home.solutions_subtitle'); ?></p>
        </div>

        <div class="accordion container-narrow" id="solutions-accordion">
            <!-- 1. Esnek Finans -->
            <div class="accordion-item is-open" data-reveal="fade-up" data-reveal-delay="50">
                <button type="button" class="accordion-trigger" aria-expanded="true">
                    <span><?php e('home.sol_finance'); ?></span>
                    <svg class="accordion-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="accordion-panel" style="max-height: 200px;">
                    <div class="accordion-panel-content">
                        <?php e('home.sol_finance_desc'); ?>
                    </div>
                </div>
            </div>

            <!-- 2. Sürprizsiz Fatura -->
            <div class="accordion-item" data-reveal="fade-up" data-reveal-delay="100">
                <button type="button" class="accordion-trigger" aria-expanded="false">
                    <span><?php e('home.sol_invoice'); ?></span>
                    <svg class="accordion-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="accordion-panel">
                    <div class="accordion-panel-content">
                        <?php e('home.sol_invoice_desc'); ?>
                    </div>
                </div>
            </div>

            <!-- 3. Zamandan Tasarruf -->
            <div class="accordion-item" data-reveal="fade-up" data-reveal-delay="150">
                <button type="button" class="accordion-trigger" aria-expanded="false">
                    <span><?php e('home.sol_time'); ?></span>
                    <svg class="accordion-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="accordion-panel">
                    <div class="accordion-panel-content">
                        <?php e('home.sol_time_desc'); ?>
                    </div>
                </div>
            </div>

            <!-- 4. Operasyonel Kolaylık -->
            <div class="accordion-item" data-reveal="fade-up" data-reveal-delay="200">
                <button type="button" class="accordion-trigger" aria-expanded="false">
                    <span><?php e('home.sol_operations'); ?></span>
                    <svg class="accordion-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="accordion-panel">
                    <div class="accordion-panel-content">
                        <?php e('home.sol_operations_desc'); ?>
                    </div>
                </div>
            </div>

            <!-- 5. Bakım ve Hasar -->
            <div class="accordion-item" data-reveal="fade-up" data-reveal-delay="250">
                <button type="button" class="accordion-trigger" aria-expanded="false">
                    <span><?php e('home.sol_maintenance'); ?></span>
                    <svg class="accordion-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="accordion-panel">
                    <div class="accordion-panel-content">
                        <?php e('home.sol_maintenance_desc'); ?>
                    </div>
                </div>
            </div>

            <!-- 6. Yol Yardım -->
            <div class="accordion-item" data-reveal="fade-up" data-reveal-delay="300">
                <button type="button" class="accordion-trigger" aria-expanded="false">
                    <span><?php e('home.sol_roadside'); ?></span>
                    <svg class="accordion-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="accordion-panel">
                    <div class="accordion-panel-content">
                        <?php e('home.sol_roadside_desc'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ─── 8. REFERANSLAR (NÖTR LOGOLAR) ─────────────────────────────── -->
<section class="section section-bg-soft" aria-labelledby="references-title" data-reveal="fade-up">
    <div class="container">
        <div class="section-header">
            <h2 id="references-title"><?php e('home.references_title'); ?></h2>
            <p><?php e('home.references_subtitle'); ?></p>
        </div>

        <div class="references-grid">
            <?php for ($i = 1; $i <= 6; $i++): ?>
                <div class="reference-logo" data-reveal="fade-up" data-reveal-delay="<?php echo $i * 50; ?>">
                    <span class="text-sm fw-semibold text-muted">KURUMSAL REFERANS <?php echo $i; ?> (DEMO)</span>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</section>

<!-- ─── 9. KAYNAKLAR (BLOG / HABERLER) ────────────────────────────── -->
<section class="section" aria-labelledby="resources-title" data-reveal="fade-up">
    <div class="container">
        <div class="flex flex-between mb-8 flex-wrap gap-4">
            <div>
                <h2 id="resources-title"><?php e('home.resources_title'); ?></h2>
                <p class="text-muted"><?php e('home.resources_subtitle'); ?></p>
            </div>
            <div>
                <a href="<?php echo url('blog.php'); ?>" class="btn btn-outline btn-sm">
                    <?php e('btn.view_all'); ?>
                </a>
            </div>
        </div>

        <div class="grid grid-3">
            <?php $aIndex = 0; foreach (array_slice($articles, 0, 3) as $article): $aIndex++; ?>
                <article class="content-card" data-reveal="fade-up" data-reveal-delay="<?php echo $aIndex * 100; ?>">
                    <div class="content-card-image">
                        <img src="<?php echo esc($article['image']); ?>" alt="<?php echo esc($article['title']); ?>" loading="lazy" width="400" height="225">
                    </div>
                    <div class="content-card-body">
                        <div class="content-card-meta">
                            <span class="content-card-type"><?php echo strtoupper($article['type']); ?></span>
                            <span><?php echo date('d.m.Y', strtotime($article['date'])); ?></span>
                            <span>• <?php echo esc($article['read_time']); ?> <?php e('content.min_read'); ?></span>
                        </div>
                        <h4>
                            <a href="<?php echo url('blog-detay.php', ['slug' => $article['slug']]); ?>">
                                <?php echo esc($article['title']); ?>
                            </a>
                        </h4>
                        <p><?php echo esc($article['summary']); ?></p>
                        <a href="<?php echo url('blog-detay.php', ['slug' => $article['slug']]); ?>" class="content-card-link">
                            <span><?php e('content.read_more'); ?></span>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ─── 10. ALT CTA BÖLÜMÜ ───────────────────────────────────────── -->
<section class="cta-section" aria-labelledby="cta-title" data-reveal="fade-up">
    <div class="container">
        <h2 id="cta-title"><?php e('home.cta_title'); ?></h2>
        <p><?php e('home.cta_desc'); ?></p>
        <div class="cta-actions">
            <a href="<?php echo url('araclar.php'); ?>" class="btn btn-primary btn-lg">
                <?php e('home.cta_vehicles'); ?>
            </a>
            <a href="<?php echo url('hizli-teklif.php'); ?>" class="btn btn-secondary btn-lg">
                <?php e('home.cta_quote'); ?>
            </a>
            <button type="button" class="btn btn-outline btn-lg" style="color: #ffffff; border-color: #ffffff;" data-open-modal="callback">
                <?php e('home.cta_call'); ?>
            </button>
        </div>
    </div>
</section>

<script src="<?php echo asset('js/slider.js'); ?>"></script>

<?php include includePath('footer.php'); ?>
