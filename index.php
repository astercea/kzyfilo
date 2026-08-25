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
                Yolunuz Açık,<br>
                <strong>Filonuz Hazır.</strong>
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

        <!-- Hızlı Araç Arama Formu (Luxecar Stili Çerçevesiz Doğrudan Zemin Üzeri) -->
        <form action="<?php echo url('araclar.php'); ?>" method="GET" class="hero-search-bar" role="search" aria-label="Hızlı Araç Bulucu" data-reveal="fade-up">
            <div class="hero-search-grid">
                <!-- Marka -->
                <div class="hero-search-item">
                    <select id="search-brand" name="marka" class="hero-select" aria-label="Marka Seçin">
                        <option value=""><?php echo (CURRENT_LANG === 'tr') ? 'Marka Seçin' : 'Select Brand'; ?></option>
                        <option value="Renault">Renault</option>
                        <option value="Fiat">Fiat</option>
                        <option value="Toyota">Toyota</option>
                        <option value="BMW">BMW</option>
                        <option value="Mercedes-Benz">Mercedes-Benz</option>
                        <option value="MG">MG</option>
                        <option value="Ford">Ford</option>
                        <option value="Peugeot">Peugeot</option>
                    </select>
                </div>

                <!-- Kasa / Model Tipi -->
                <div class="hero-search-item">
                    <select id="search-cat" name="kategori" class="hero-select" aria-label="Kasa / Model Tipi">
                        <option value=""><?php echo (CURRENT_LANG === 'tr') ? 'Kasa / Model Tipi' : 'Body / Model'; ?></option>
                        <option value="binek">Sedan & Hatchback</option>
                        <option value="suv">SUV & Crossover</option>
                        <option value="ticari">Ticari & Panelvan</option>
                        <option value="premium">Executive & Premium</option>
                        <option value="elektrikli">Elektrikli & Hibrit</option>
                    </select>
                </div>

                <!-- Yakıt Türü -->
                <div class="hero-search-item">
                    <select id="search-fuel" name="yakit" class="hero-select" aria-label="Yakıt Türü">
                        <option value=""><?php echo (CURRENT_LANG === 'tr') ? 'Yakıt Türü' : 'Fuel Type'; ?></option>
                        <option value="benzin"><?php e('fuel_types.benzin'); ?></option>
                        <option value="dizel"><?php e('fuel_types.dizel'); ?></option>
                        <option value="hibrit"><?php e('fuel_types.hibrit'); ?></option>
                        <option value="elektrik"><?php e('fuel_types.elektrik'); ?></option>
                    </select>
                </div>

                <!-- Gönder Butonu (ARAÇ BUL) -->
                <div class="hero-search-item hero-search-btn-wrap">
                    <button type="submit" class="hero-search-btn">
                        <span><?php echo (CURRENT_LANG === 'tr') ? 'ARAÇ BUL' : 'SEARCH'; ?></span>
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
<section class="editorial-statement" aria-label="KZY Filo Vizyonu">
    <div class="container">
        <div class="editorial-quote-wrap">
            <h2 class="editorial-headline-scroll">
                Şirketiniz için esnek, operasyonel olarak güvenli ve sürdürülebilir uzun dönem mobilite çözümleri sunuyoruz.
            </h2>
        </div>
    </div>
</section>

<!-- ─── 4. SİNEMATİK TAM GENİŞLİKTE MEDYA ALANI (FULL-WIDTH SEAMLESS VIDEO) ─── -->
<section class="cinematic-media-section" aria-label="KZY Filo Deneyimi">
    <div class="cinematic-video-wrap">
        <video class="cinematic-video" autoplay muted loop playsinline poster="<?php echo asset('images/banners/hero-banner-2.jpg'); ?>">
            <source src="<?php echo asset('videos/fleet-driving.mp4'); ?>" type="video/mp4">
        </video>
    </div>
</section>

<!-- ─── 5. AYDINLIK KURUMSAL HİZMETLER BÖLÜMÜ (ARCHITECTURAL MOSAIC) ─── -->
<section class="section section-paper" aria-labelledby="services-title" data-reveal="fade-up">
    <div class="container">
        <div class="section-header text-center" style="max-width: 760px; margin: 0 auto var(--space-12);">
            <span class="editorial-tag">Hizmetlerimiz</span>
            <h2 id="services-title" style="font-size: clamp(2.2rem, 3.5vw, 3rem); font-weight: var(--font-weight-normal); margin-top: var(--space-2); margin-bottom: var(--space-3);">
                KZY ile Filo Yönetimi
            </h2>
            <p style="font-size: 1.1rem; color: rgba(18, 24, 34, 0.72); line-height: 1.65;">
                Şirketinizin büyüklüğü ve operasyon ölçeği ne olursa olsun, filo maliyetlerinizi öngörülebilir kılan kurumsal hizmetler.
            </p>
        </div>

        <div class="services-mosaic-matrix">
            <!-- Row 1 - Cell 1: Text (Filo Kiralama) -->
            <div class="mosaic-cell mosaic-cell-text" data-reveal="fade-up" data-reveal-delay="50">
                <div class="mosaic-icon-circle">
                    <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2"></path>
                        <circle cx="7" cy="17" r="2"></circle>
                        <path d="M9 17h6"></path>
                        <circle cx="17" cy="17" r="2"></circle>
                    </svg>
                </div>
                <h3 class="mosaic-title">Uzun Dönem Filo Kiralama</h3>
                <p class="mosaic-desc">
                    12 aydan 48 aya kadar sabit maliyet ve KDV avantajıyla sıfır kilometre binek, SUV ve ticari araçları filonuza dahil edin.
                </p>
                <a href="<?php echo url('uzun-donem-arac-kiralama.php'); ?>" class="mosaic-link">
                    <span>Hizmeti İncele</span>
                    <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </a>
            </div>

            <!-- Row 1 - Cell 2: Image 1 -->
            <div class="mosaic-cell mosaic-cell-media" data-reveal="fade-up" data-reveal-delay="100">
                <img src="<?php echo asset('images/services/service-fleet-rental.jpg'); ?>" alt="Uzun Dönem Araç Kiralama" loading="lazy">
            </div>

            <!-- Row 1 - Cell 3: Text (Öngörülebilir Bütçe) -->
            <div class="mosaic-cell mosaic-cell-text" data-reveal="fade-up" data-reveal-delay="150">
                <div class="mosaic-icon-circle">
                    <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                </div>
                <h3 class="mosaic-title">Öngörülebilir Filo Bütçesi</h3>
                <p class="mosaic-desc">
                    Sürpriz bakım, kasko veya amortisman gideri olmadan her ay net ve şeffaf operasyonel bütçe kontrolü sağlayın.
                </p>
                <a href="<?php echo url('hizli-teklif.php'); ?>" class="mosaic-link">
                    <span>Teklif Oluştur</span>
                    <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </a>
            </div>

            <!-- Row 2 - Cell 4: Image 2 -->
            <div class="mosaic-cell mosaic-cell-media" data-reveal="fade-up" data-reveal-delay="200">
                <img src="<?php echo asset('images/services/service-maintenance.jpg'); ?>" alt="Periyodik Bakım ve Onarım" loading="lazy">
            </div>

            <!-- Row 2 - Cell 5: Text (7/24 Destek) -->
            <div class="mosaic-cell mosaic-cell-text" data-reveal="fade-up" data-reveal-delay="250">
                <div class="mosaic-icon-circle">
                    <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                    </svg>
                </div>
                <h3 class="mosaic-title">7/24 Kesintisiz Mobilite</h3>
                <p class="mosaic-desc">
                    Bakım ve hasar anında 24 saat içinde adresinize teslim edilen muadil ikame araç garantisiyle işleriniz asla durmaz.
                </p>
                <a href="<?php echo url('ek-urun-ve-hizmetler.php'); ?>" class="mosaic-link">
                    <span>Hizmeti İncele</span>
                    <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </a>
            </div>

            <!-- Row 2 - Cell 6: Image 3 -->
            <div class="mosaic-cell mosaic-cell-media" data-reveal="fade-up" data-reveal-delay="300">
                <img src="<?php echo asset('images/services/service-tires.jpg'); ?>" alt="Lastik Yönetimi ve Mobilite" loading="lazy">
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
            <div class="process-step" data-reveal="fade-up" data-reveal-delay="100">
                <span class="process-step-connector"></span>
                <div class="process-step-number">01</div>
                <h4>İhtiyacını Belirle</h4>
                <p>Şirketinizin kilometre, yakıt ve kasa tipi beklentilerine göre araç gereksinimini netleştirin.</p>
            </div>
            <div class="process-step" data-reveal="fade-up" data-reveal-delay="300">
                <span class="process-step-connector"></span>
                <div class="process-step-number">02</div>
                <h4>Araç ve Paketi Seç</h4>
                <p>Kataloğumuzdan bütçenize en uygun araç modelini ve güvence paketini belirleyin.</p>
            </div>
            <div class="process-step" data-reveal="fade-up" data-reveal-delay="500">
                <span class="process-step-connector"></span>
                <div class="process-step-number">03</div>
                <h4>Teklifini Al</h4>
                <p>Online form üzerinden veya müşteri temsilciniz aracılığıyla size özel resmi teklifi inceleyin.</p>
            </div>
            <div class="process-step" data-reveal="fade-up" data-reveal-delay="700">
                <span class="process-step-connector"></span>
                <div class="process-step-number">04</div>
                <h4>Sözleşmeni Tamamla</h4>
                <p>Gerekli kurumsal evrakları dijital ortamda hızla tamamlayarak sözleşmeyi onaylayın.</p>
            </div>
            <div class="process-step" data-reveal="fade-up" data-reveal-delay="900">
                <div class="process-step-number">05</div>
                <h4>Aracını Teslim Al</h4>
                <p>Plakalandırılmış ve kontrolleri yapılmış sıfır kilometre aracınızı hemen teslim alın.</p>
            </div>
        </div>
    </div>
</section>

<!-- ─── 8. GÜÇLÜ KOYU KAPANIŞ CTA ALANI (TEK ARKA PLAN BANNER) ─────── -->
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
                    <a href="<?php echo url('iletisim.php'); ?>" class="btn btn-outline btn-lg" style="color: #fff; border-color: rgba(255,255,255,0.35);">
                        <span>Bizimle İletişime Geç</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ─── 9. SSS (ÖZEL EDİTORYAL DÜZEN) ─────────────────────────────── -->
<section class="section section-ivory" aria-labelledby="faq-title" data-reveal="fade-up">
    <div class="container">
        <div class="faq-split-layout">
            <!-- Left: Intro (Vertically Centered) -->
            <div class="faq-sticky-intro">
                <span class="editorial-tag">Merak Edilenler</span>
                <h2 id="faq-title" class="faq-main-title">
                    Sıkça Sorulan Sorular
                </h2>
                <p class="faq-main-desc">
                    Uzun dönem araç kiralama, filo yönetimi, vergisel avantajlar ve operasyonel süreçler hakkında merak ettiğiniz tüm yanıtlar.
                </p>
                <a href="<?php echo url('sss.php'); ?>" class="btn btn-outline btn-read-articles">
                    <span>Tüm Soruları İncele</span>
                </a>
            </div>

            <!-- Right: Numbered Accordion List -->
            <div class="accordion">
                <div class="accordion-item">
                    <button type="button" class="accordion-trigger" aria-expanded="false">
                        <div class="accordion-title-wrap">
                            <span class="accordion-num">01</span>
                            <span>Uzun dönem araç kiralama şirketimize hangi vergisel avantajları sağlar?</span>
                        </div>
                        <div class="accordion-icon-btn">
                            <svg class="accordion-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </div>
                    </button>
                    <div class="accordion-panel">
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

<!-- ─── 10. FİLO REHBERİ & GÜNCEL İÇERİKLER ──────────────────────────── -->
<?php if (!empty($articles)): ?>
<section class="section section-paper" aria-labelledby="articles-title" data-reveal="fade-up">
    <div class="container">
        <div class="flex flex-between mb-8 flex-wrap gap-4" style="align-items: flex-end;">
            <div>
                <span class="editorial-tag">Rehber & Haberler</span>
                <h2 id="articles-title" style="font-size: clamp(2rem, 3.5vw, 2.8rem); font-weight: var(--font-weight-normal); margin-top: var(--space-2); margin-bottom: 0;">
                    Filo Yönetimi Rehberi
                </h2>
            </div>
            <a href="<?php echo url('blog.php'); ?>" class="btn btn-outline btn-read-articles">
                <span>Tüm Makaleleri Oku</span>
            </a>
        </div>

        <div class="grid grid-3">
            <?php foreach (array_slice($articles, 0, 3) as $art): ?>
            <div class="content-card" data-reveal="fade-up">
                <div class="content-card-image">
                    <img src="<?php echo !empty($art['image']) ? $art['image'] : asset('images/blog/blog-1.jpg'); ?>" alt="<?php echo htmlspecialchars($art['title'] ?? '', ENT_QUOTES); ?>" loading="lazy">
                </div>
                <div class="content-card-body">
                    <h4>
                        <a href="<?php echo url('blog-detay.php', ['slug' => $art['slug'] ?? '']); ?>">
                            <?php echo htmlspecialchars($art['title'] ?? '', ENT_QUOTES); ?>
                        </a>
                    </h4>
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

<?php include includePath('footer.php'); ?>
