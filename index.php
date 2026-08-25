<?php
/**
 * kzyfilo — Ana Sayfa (index.php)
 * KZY Executive Motion — Editorial Long-Term Fleet Leasing Experience
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

<!-- ─── 1. HERO: SINEMATİK AÇILIŞ & HIZLI ARAÇ BULUCU ──────────────── -->
<section class="hero" aria-label="KZY Filo Kurumsal Mobilite">
    <div class="hero-slider" id="hero-slider">
        <div class="hero-slide is-active">
            <div class="hero-bg">
                <img src="<?php echo asset('images/banners/hero-banner-1.jpg'); ?>" alt="kzyfilo Kurumsal Filo Yönetimi" width="1920" height="1080">
            </div>
            <div class="hero-overlay"></div>
        </div>
    </div>

    <div class="container hero-container">
        <div class="hero-content" data-reveal="fade-up">
            <span class="hero-tag">Kurumsal Mobilite Çözümleri</span>
            <h1 class="hero-title">
                İşiniz Yolda Kalsın Diye<br>
                <strong>Filonuz Hep Hazır.</strong>
            </h1>
            <p class="hero-lead">
                Türkiye genelinde operasyonel güvence, sıfır kilometre araç filosu ve şirketinizin sermayesini koruyan esnek uzun dönem kiralama modelleri.
            </p>
            <div class="hero-actions">
                <a href="<?php echo url('hizli-teklif.php'); ?>" class="btn btn-primary btn-lg">
                    <span><?php e('header.get_quote'); ?></span>
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
                <a href="<?php echo url('araclar.php'); ?>" class="btn btn-outline btn-lg" style="color: #fff; border-color: rgba(255,255,255,0.3);">
                    <span><?php e('header.vehicles'); ?></span>
                </a>
            </div>
        </div>

        <!-- Hızlı Araç Arama Paneli -->
        <form action="<?php echo url('araclar.php'); ?>" method="GET" class="quick-search-panel" role="search" aria-label="Hızlı Araç Bulucu" data-reveal="fade-up">
            <h3>Filo Aracınızı Bulun</h3>
            <div class="quick-search-grid">
                <!-- Araç Tipi -->
                <div class="quick-search-field">
                    <label for="search-cat"><?php e('catalog.category'); ?></label>
                    <select id="search-cat" name="kategori" class="form-select">
                        <option value=""><?php e('catalog.all'); ?></option>
                        <option value="binek"><?php e('categories.binek'); ?></option>
                        <option value="ticari"><?php e('categories.ticari'); ?></option>
                        <option value="elektrikli"><?php e('categories.elektrikli'); ?></option>
                        <option value="premium"><?php e('categories.premium'); ?></option>
                    </select>
                </div>

                <!-- Marka -->
                <div class="quick-search-field">
                    <label for="search-brand"><?php e('catalog.brand'); ?></label>
                    <select id="search-brand" name="marka" class="form-select">
                        <option value=""><?php e('catalog.all'); ?></option>
                        <option value="Renault">Renault</option>
                        <option value="Fiat">Fiat</option>
                        <option value="Toyota">Toyota</option>
                        <option value="BMW">BMW</option>
                        <option value="MG">MG</option>
                        <option value="Ford">Ford</option>
                    </select>
                </div>

                <!-- Yakıt Tipi -->
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

                <!-- Kiralama Süresi -->
                <div class="quick-search-field">
                    <label for="search-term"><?php echo (CURRENT_LANG === 'tr') ? 'Kiralama Süresi' : 'Lease Term'; ?></label>
                    <select id="search-term" name="sure" class="form-select">
                        <option value="12">12 Ay</option>
                        <option value="24">24 Ay</option>
                        <option value="36" selected>36 Ay</option>
                        <option value="48">48 Ay</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="btn btn-primary" style="width: 100%; min-height: 44px;">
                        <span><?php e('home.search_btn'); ?></span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- ─── 2. ÖNE ÇIKAN ARAÇ KATALOĞU (AYDINLIK FİLDİŞİ) ───────────────── -->
<section class="section section-ivory" aria-labelledby="featured-title" data-reveal="fade-up">
    <div class="container">
        <div class="flex flex-between mb-10 flex-wrap gap-4">
            <div>
                <span class="editorial-tag"><?php echo (CURRENT_LANG === 'tr') ? 'Seçkin Filo Portföyü' : 'Curated Fleet Portfolio'; ?></span>
                <h2 id="featured-title" style="font-size: var(--font-size-section); font-weight: var(--font-weight-light); margin-top: var(--space-2);">
                    Öne Çıkan Filo Modelleri
                </h2>
            </div>
            <div class="flex items-center gap-3">
                <a href="<?php echo url('araclar.php'); ?>" class="btn btn-dark btn-sm">
                    <span><?php e('btn.view_all'); ?></span>
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            </div>
        </div>

        <div class="catalog-grid">
            <?php foreach (array_slice($vehicles, 0, 6) as $vehicle): ?>
                <?php include includePath('vehicle-card.php'); ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ─── 3. BÜYÜK EDİTORYAL MARKA BÖLÜMÜ ───────────────────────────── -->
<section class="editorial-statement" aria-label="KZY Filo Vizyonu" data-reveal="fade-up">
    <div class="container">
        <div class="editorial-quote-wrap">
            <h2 class="editorial-headline">
                Şirketiniz için esnek, operasyonel olarak güvenli ve sürdürülebilir uzun dönem mobilite çözümleri sunuyoruz.
            </h2>
            <div class="editorial-author-strip">
                <span class="editorial-badge">KZY Filo Yönetim Manifestosu</span>
                <span class="editorial-sub">Sermaye bağlamadan, bakım, hasar ve lastik risklerini uzmanına devredin.</span>
            </div>
        </div>
    </div>
</section>

<!-- ─── 4. SİNEMATİK TAM GENİŞLİKTE MEDYA ALANI ────────────────────── -->
<section class="cinematic-media" aria-label="KZY Filo Deneyimi" data-reveal="fade-up">
    <div class="container">
        <div class="cinematic-media-container">
            <img src="<?php echo asset('images/banners/hero-banner-2.jpg'); ?>" alt="KZY Filo Operasyonel Mükemmellik" loading="lazy">
            <div class="cinematic-overlay">
                <button type="button" class="cinematic-play-btn" onclick="window.showToast('<?php echo (CURRENT_LANG === 'tr') ? 'Tanıtım videosu yükleniyor...' : 'Loading video...'; ?>', 'primary');" aria-label="Tanıtım Videosunu Oynat">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <polygon points="5 3 19 12 5 21 5 3"></polygon>
                    </svg>
                </button>
                <div class="cinematic-caption">
                    <span class="badge badge-primary mb-2" style="background-color: var(--color-orange); color: #fff;">KZY Filo'yu Tanıyın</span>
                    <h3>Uçtan Uca Operasyonel Filo Yönetimi</h3>
                    <p>81 ilde anlaşmalı servis ağı, 7/24 kesintisiz yol yardımı ve anında ikame araç desteğiyle işinizin temposunu koruyoruz.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ─── 5. AYDINLIK ASİMETRİK HİZMETLER BÖLÜMÜ ─────────────────────── -->
<section class="section section-paper" aria-labelledby="services-title" data-reveal="fade-up">
    <div class="container">
        <div class="section-header">
            <span class="editorial-tag">Hizmetlerimiz</span>
            <h2 id="services-title">KZY ile Filo Yönetimi</h2>
            <p>Şirketinizin büyüklüğü ve operasyon ölçeği ne olursa olsun, filo maliyetlerinizi öngörülebilir kılan kurumsal hizmetler.</p>
        </div>

        <div class="services-asymmetric">
            <!-- 01: Uzun Dönem Araç Kiralama -->
            <div class="service-item" data-reveal="fade-up">
                <div class="service-media">
                    <img src="<?php echo asset('images/banners/hero-banner-1.jpg'); ?>" alt="Uzun Dönem Araç Kiralama" loading="lazy">
                </div>
                <div class="service-content">
                    <span class="service-num">01 / HİZMET</span>
                    <h3 class="service-title">Uzun Dönem Araç Kiralama</h3>
                    <p class="service-desc">
                        12 aydan 48 aya kadar sabit aylık kiralama bedelleriyle sıfır kilometre binek, SUV ve ticari araçları filonuza dahil edin; sermayenizi ana işinizde değerlendirin.
                    </p>
                    <div class="service-features">
                        <div class="service-feature">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span>Sabit aylık ödeme güvencesi & KDV avantajı</span>
                        </div>
                        <div class="service-feature">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span>İkinci el değer kaybı riski olmadan yenileme</span>
                        </div>
                    </div>
                    <a href="<?php echo url('uzun-donem-arac-kiralama.php'); ?>" class="btn btn-outline btn-sm">
                        <span>Hizmeti İncele</span>
                    </a>
                </div>
            </div>

            <!-- 02: Operasyon & Bakım Desteği -->
            <div class="service-item reverse" data-reveal="fade-up">
                <div class="service-media">
                    <img src="<?php echo asset('images/banners/hero-banner-3.jpg'); ?>" alt="Bakım ve Hasar Yönetimi" loading="lazy">
                </div>
                <div class="service-content">
                    <span class="service-num">02 / HİZMET</span>
                    <h3 class="service-title">Periyodik Bakım & Hasar Yönetimi</h3>
                    <p class="service-desc">
                        Türkiye genelinde yetkili servis ağı üzerinden üretici standartlarında periyodik bakım, orijinal yedek parça ve hasar durumunda tam kapsamlı süreç takibi.
                    </p>
                    <div class="service-features">
                        <div class="service-feature">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span>Randevulu periyodik bakım ve onarım desteği</span>
                        </div>
                        <div class="service-feature">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span>Kusursuz hasar dosya takibi & hızlı onarım</span>
                        </div>
                    </div>
                    <a href="<?php echo url('filo-yonetimi.php'); ?>" class="btn btn-outline btn-sm">
                        <span>Hizmeti İncele</span>
                    </a>
                </div>
            </div>

            <!-- 03: Lastik & 7/24 Kesintisiz Mobilite -->
            <div class="service-item" data-reveal="fade-up">
                <div class="service-media">
                    <img src="<?php echo asset('images/banners/hero-banner-2.jpg'); ?>" alt="Lastik ve Yol Yardım" loading="lazy">
                </div>
                <div class="service-content">
                    <span class="service-num">03 / HİZMET</span>
                    <h3 class="service-title">Lastik Yönetimi & 7/24 İkame Araç</h3>
                    <p class="service-desc">
                        Mevsimsel lastik değişimi, lastik oteli depolama hizmeti ve 24 saat içinde teslim edilen muadil ikame araç garantisiyle filonuz hiçbir zaman durmaz.
                    </p>
                    <div class="service-features">
                        <div class="service-feature">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span>Premium marka mevsimlik lastikler & saklama</span>
                        </div>
                        <div class="service-feature">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span>Kesintisiz yol yardımı ve anında ikame araç</span>
                        </div>
                    </div>
                    <a href="<?php echo url('ek-urun-ve-hizmetler.php'); ?>" class="btn btn-outline btn-sm">
                        <span>Hizmeti İncele</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ─── 6. KOYU KURUMSAL GÜVEN & RAKAMLAR ───────────────────────────── -->
<section class="section section-navy" aria-labelledby="stats-title" data-reveal="fade-up">
    <div class="container">
        <div class="section-header">
            <span class="editorial-tag">Rakamlarla KZY Filo</span>
            <h2 id="stats-title" style="color: var(--color-text-light);">Güvenilir Filo Gücü</h2>
            <p style="color: var(--color-text-muted-dark);">Türkiye'nin önde gelen kurumlarına sağladığımız operasyonel filo standartları.</p>
        </div>

        <div class="stats-grid">
            <div class="stat-item" data-reveal="fade-up" data-reveal-delay="50">
                <div class="stat-number">15+</div>
                <div class="stat-label">Yıllık Sektör Deneyimi</div>
            </div>
            <div class="stat-item" data-reveal="fade-up" data-reveal-delay="100">
                <div class="stat-number">2.500+</div>
                <div class="stat-label">Aktif Filo Aracı</div>
            </div>
            <div class="stat-item" data-reveal="fade-up" data-reveal-delay="150">
                <div class="stat-number">81</div>
                <div class="stat-label">İlde Servis Ağı</div>
            </div>
            <div class="stat-item" data-reveal="fade-up" data-reveal-delay="200">
                <div class="stat-number">%98.4</div>
                <div class="stat-label">Müşteri Memnuniyeti</div>
            </div>
            <div class="stat-item" data-reveal="fade-up" data-reveal-delay="250">
                <div class="stat-number">7/24</div>
                <div class="stat-label">Operasyonel Destek</div>
            </div>
        </div>
    </div>
</section>

<!-- ─── 7. 5 ADIMDA KİRALAMA SÜRECİ ─────────────────────────────────── -->
<section class="section section-paper" aria-labelledby="process-title" data-reveal="fade-up">
    <div class="container">
        <div class="section-header">
            <span class="editorial-tag">Kolay & Hızlı</span>
            <h2 id="process-title">5 Adımda Uzun Dönem Kiralama</h2>
            <p>İhtiyacınızı belirlemekten aracınızı teslim almaya kadar şeffaf ve yalın kiralama süreci.</p>
        </div>

        <div class="process-steps">
            <div class="process-step" data-reveal="fade-up" data-reveal-delay="50">
                <span class="process-step-connector"></span>
                <div class="process-step-number">01</div>
                <h4>İhtiyacını Belirle</h4>
                <p>Şirketinizin kilometre, yakıt ve kasa tipi beklentilerine göre araç gereksinimini netleştirin.</p>
            </div>
            <div class="process-step" data-reveal="fade-up" data-reveal-delay="100">
                <span class="process-step-connector"></span>
                <div class="process-step-number">02</div>
                <h4>Araç ve Paketi Seç</h4>
                <p>Kataloğumuzdan bütçenize en uygun araç modelini ve güvence paketini belirleyin.</p>
            </div>
            <div class="process-step" data-reveal="fade-up" data-reveal-delay="150">
                <span class="process-step-connector"></span>
                <div class="process-step-number">03</div>
                <h4>Teklifini Al</h4>
                <p>Online form üzerinden veya müşteri temsilciniz aracılığıyla size özel resmi teklifi inceleyin.</p>
            </div>
            <div class="process-step" data-reveal="fade-up" data-reveal-delay="200">
                <span class="process-step-connector"></span>
                <div class="process-step-number">04</div>
                <h4>Sözleşmeni Tamamla</h4>
                <p>Gerekli kurumsal evrakları dijital ortamda hızla tamamlayarak sözleşmeyi onaylayın.</p>
            </div>
            <div class="process-step" data-reveal="fade-up" data-reveal-delay="250">
                <div class="process-step-number">05</div>
                <h4>Aracını Teslim Al</h4>
                <p>Plakalandırılmış ve kontrolleri yapılmış sıfır kilometre aracınızı hemen teslim alın.</p>
            </div>
        </div>
    </div>
</section>

<!-- ─── 8. SSS (ÖZEL EDİTORYAL DÜZEN) ─────────────────────────────── -->
<section class="section section-ivory" aria-labelledby="faq-title" data-reveal="fade-up">
    <div class="container">
        <div class="faq-split-layout">
            <!-- Left: Sticky Intro & Callout Card -->
            <div class="faq-sticky-intro">
                <span class="editorial-tag">Merak Edilenler</span>
                <h2 id="faq-title" style="font-size: var(--font-size-section); font-weight: var(--font-weight-light); margin-top: var(--space-2); margin-bottom: var(--space-4);">
                    Sıkça Sorulan Sorular
                </h2>
                <p style="color: var(--color-text-muted); font-size: var(--font-size-base); line-height: var(--line-height-relaxed);">
                    Uzun dönem araç kiralama, filo yönetimi, vergi ve bakım süreçleri hakkında merak edilen tüm detaylar.
                </p>

                <div class="faq-contact-card">
                    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                        <span style="color: var(--color-orange); font-size: 1.2rem;">✦</span>
                        <h4 style="margin: 0; font-size: 1.1rem; color: #ffffff;">Özel Bir Sorunuz mu Var?</h4>
                    </div>
                    <p>
                        Filo danışmanlarımız şirketinizin operasyonel ihtiyaçlarına özel kiralama senaryolarını yanıtlasın.
                    </p>
                    <div class="faq-contact-card-actions">
                        <a href="<?php echo url('hizli-teklif.php'); ?>" class="btn btn-primary btn-sm">
                            <span>Teklif Talebi Oluştur</span>
                        </a>
                        <a href="<?php echo url('sss.php'); ?>" class="btn btn-outline btn-sm" style="color: #fff; border-color: rgba(255,255,255,0.25);">
                            <span>Tüm Sorular</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right: Numbered Accordion List -->
            <div class="accordion">
                <div class="accordion-item is-open">
                    <button type="button" class="accordion-trigger" aria-expanded="true">
                        <div class="accordion-title-wrap">
                            <span class="accordion-num">01</span>
                            <span>Uzun dönem araç kiralama şirketimize hangi vergisel avantajları sağlar?</span>
                        </div>
                        <div class="accordion-icon-btn">
                            <svg class="accordion-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </div>
                    </button>
                    <div class="accordion-panel" style="max-height: 250px; opacity: 1;">
                        <div class="accordion-panel-content">
                            Aylık kira bedelleri doğrudan gider olarak kaydedilebilir, KDV indirim konusu yapılabilir ve MTV, kasko, periyodik bakım gibi operasyonel masraflar şirket bilançosunda borç olarak görünmez. Böylece şirketinizin banka kredi limitleri korunur ve sermaye ana işinizde kalır.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <button type="button" class="accordion-trigger" aria-expanded="false">
                        <div class="accordion-title-wrap">
                            <span class="accordion-num">02</span>
                            <span>Hasar veya kaza durumunda ikame araç süreci nasıl işler?</span>
                        </div>
                        <div class="accordion-icon-btn">
                            <svg class="accordion-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </div>
                    </button>
                    <div class="accordion-panel">
                        <div class="accordion-panel-content">
                            Aracınızın 24 saatten uzun sürecek bakım ve hasar onarımlarında, seçtiğiniz hizmet paketi doğrultusunda aynı veya üst segment muadil ikame araç 24 saat içinde şirket adresinize teslim edilir. İş akışınız kesintiye uğramaz.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <button type="button" class="accordion-trigger" aria-expanded="false">
                        <div class="accordion-title-wrap">
                            <span class="accordion-num">03</span>
                            <span>Mevsimlik lastik değişimi ve saklama hizmeti pakete dahil midir?</span>
                        </div>
                        <div class="accordion-icon-btn">
                            <svg class="accordion-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </div>
                    </button>
                    <div class="accordion-panel">
                        <div class="accordion-panel-content">
                            Evet, sözleşme kapsamına göre kış ve yaz lastiği montajı, balans ayarları ve lastik oteli depolama hizmetleri Türkiye genelindeki anlaşmalı servis noktalarımızda ücretsiz sağlanır.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <button type="button" class="accordion-trigger" aria-expanded="false">
                        <div class="accordion-title-wrap">
                            <span class="accordion-num">04</span>
                            <span>Minimum kiralama süresi ve araç adedi sınırı nedir?</span>
                        </div>
                        <div class="accordion-icon-btn">
                            <svg class="accordion-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </div>
                    </button>
                    <div class="accordion-panel">
                        <div class="accordion-panel-content">
                            KZY Filo'da uzun dönem kiralama süresi 12 aydan başlayıp 48 aya kadar uzanmaktadır. 1 adet araçtan başlayarak yüzlerce araçlık filo ölçeğine kadar tüm kurumsal taleplerinizi karşılıyoruz.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <button type="button" class="accordion-trigger" aria-expanded="false">
                        <div class="accordion-title-wrap">
                            <span class="accordion-num">05</span>
                            <span>Periyodik bakım ve onarımlar nerede gerçekleştirilir?</span>
                        </div>
                        <div class="accordion-icon-btn">
                            <svg class="accordion-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </div>
                    </button>
                    <div class="accordion-panel">
                        <div class="accordion-panel-content">
                            Tüm periyodik bakımlar, 81 ildeki marka yetkili servislerinde üretici onaylı standartlarla ve orijinal yedek parçalarla yapılır. Randevu ve onay süreçleri KZY Filo operasyon ekibi tarafından yönetilir.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ─── 9. FİLO REHBERİ & GÜNCEL İÇERİKLER ──────────────────────────── -->
<?php if (!empty($articles)): ?>
<section class="section section-paper" aria-labelledby="articles-title" data-reveal="fade-up">
    <div class="container">
        <div class="flex flex-between mb-8 flex-wrap gap-4">
            <div>
                <span class="editorial-tag">Rehber & Haberler</span>
                <h2 id="articles-title" style="font-size: var(--font-size-section); font-weight: var(--font-weight-light); margin-top: var(--space-2);">
                    Filo Yönetimi Rehberi
                </h2>
            </div>
            <a href="<?php echo url('blog.php'); ?>" class="btn btn-outline btn-sm">
                <span>Tüm Makaleleri Oku</span>
            </a>
        </div>

        <div class="grid grid-3">
            <?php foreach (array_slice($articles, 0, 3) as $art): ?>
            <div class="content-card" data-reveal="fade-up">
                <div class="content-card-image">
                    <img src="<?php echo asset('images/banners/hero-banner-1.jpg'); ?>" alt="<?php echo htmlspecialchars($art['title'] ?? '', ENT_QUOTES); ?>" loading="lazy">
                </div>
                <div class="content-card-body">
                    <div class="content-card-meta">
                        <span class="content-card-type"><?php echo htmlspecialchars($art['category'] ?? 'Filo Rehberi', ENT_QUOTES); ?></span>
                        <span>•</span>
                        <span><?php echo htmlspecialchars($art['date'] ?? '', ENT_QUOTES); ?></span>
                    </div>
                    <h4>
                        <a href="<?php echo url('blog-detay.php', ['slug' => $art['slug'] ?? '']); ?>">
                            <?php echo htmlspecialchars($art['title'] ?? '', ENT_QUOTES); ?>
                        </a>
                    </h4>
                    <p><?php echo htmlspecialchars(mb_substr($art['summary'] ?? '', 0, 110) . '...', ENT_QUOTES); ?></p>
                    <a href="<?php echo url('blog-detay.php', ['slug' => $art['slug'] ?? '']); ?>" class="content-card-link">
                        <span>Devamını Oku</span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ─── 10. GÜÇLÜ KOYU KAPANIŞ CTA ALANI ───────────────────────────── -->
<section class="closing-cta" aria-labelledby="cta-title" data-reveal="fade-up">
    <div class="container">
        <div class="closing-cta-card">
            <div class="closing-cta-content">
                <span class="editorial-tag" style="color: var(--color-sand);">Kurumsal Filo Teklifi</span>
                <h2 id="cta-title">Filonuzu Birlikte Planlayalım.</h2>
                <p>
                    Şirketinizin büyüme hedeflerine ve operasyon ihtiyaçlarına özel filo teklifinizi hemen hazırlayalım. Uzman filo danışmanlarımız en geç 2 saat içinde size dönüş yapsın.
                </p>
                <div class="closing-cta-actions">
                    <a href="<?php echo url('hizli-teklif.php'); ?>" class="btn btn-primary btn-lg">
                        <span>Hızlı Teklif Al</span>
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                    <a href="<?php echo url('iletisim.php'); ?>" class="btn btn-outline btn-lg" style="color: #fff; border-color: rgba(255,255,255,0.25);">
                        <span>Bizimle İletişime Geç</span>
                    </a>
                </div>
            </div>

            <div class="closing-cta-stats">
                <div class="closing-stat-box">
                    <div class="closing-stat-val">2 Saat</div>
                    <div class="closing-stat-label">Hızlı Teklif Dönüşü</div>
                </div>
                <div class="closing-stat-box">
                    <div class="closing-stat-val">0 ₺</div>
                    <div class="closing-stat-label">Sürpriz Maliyet</div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include includePath('footer.php'); ?>
