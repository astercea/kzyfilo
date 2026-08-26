<?php
/**
 * kzyfilo — Filo Yönetimi & Danışmanlığı (filo-yonetimi.php)
 * KZY Executive Fleet Management Solutions
 */
require_once __DIR__ . '/includes/config.php';

setPageMeta([
    'title' => t('solutions_menu.fleet_management') . ' | ' . SITE_NAME,
    'description' => 'Profesyonel 360° filo yönetimi, telematik takip, yakıt entegrasyonu, bakım ve hasar süreçleri ile şirketinizin operasyonel verimliliğini artırın.',
    'canonical' => canonical('filo-yonetimi.php'),
]);

$breadcrumbs = [
    ['title' => t('services.title'), 'url' => url('hizmetler.php')],
    ['title' => t('solutions_menu.fleet_management')]
];

include includePath('header.php');?>

<!-- ─── 1. PAGE HEADER ─────────────────────────────────────────────── -->
<div class="page-header">
    <div class="container">
        <h1><?php e('solutions_menu.fleet_management'); ?></h1>
        <?php include includePath('breadcrumbs.php'); ?>
    </div>
</div>

<!-- ─── 2. 360° FİLO YÖNETİM MODÜLLERİ ──────────────────────────────── -->
<section class="section section-ivory" data-reveal="fade-up">
    <div class="container">
        <div class="section-header text-center" style="max-width: 760px; margin: 0 auto var(--space-12);">
            <span class="editorial-tag">Bütünleşik Mobilite</span>
            <h2 style="font-size: clamp(2.2rem, 3.5vw, 3rem); font-weight: var(--font-weight-normal); margin-top: var(--space-2); margin-bottom: var(--space-3);">
                360° Kapsamlı Filo Yönetim Modülleri
            </h2>
            <p style="font-size: 1.05rem; color: var(--color-text-muted); line-height: 1.65;">
                Filonuz ister 5 ister 500 araçtan oluşsun; operasyonel yaşam döngüsünün her adımını gelişmiş teknolojimiz ve uzman ekibimizle yönetiyoruz.
            </p>
        </div>

        <div class="solution-benefit-grid mb-16">
            <!-- 1. Telematik -->
            <div class="solution-benefit-card" data-spotlight>
                <div class="solution-icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="2" y1="12" x2="22" y2="12"></line>
                        <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                    </svg>
                </div>
                <h3>7/24 Canlı Telematik & Araç Takip</h3>
                <p>Anlık konum, rölanti süreleri, aşırı hız alarmları ve rota optimizasyonu ile saha ekiplerinizin güvenliğini ve verimliliğini artırın.</p>
            </div>

            <!-- 2. Bakım & Hasar -->
            <div class="solution-benefit-card" data-spotlight>
                <div class="solution-icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
                    </svg>
                </div>
                <h3>Bakım & Hasar Süreç Yönetimi</h3>
                <p>Yetkili servis randevuları, parça tedariki, eksper kontrolleri ve kasko dosya takibi profesyonel operasyon masamız tarafından yürütülür.</p>
            </div>

            <!-- 3. Taşıt Tanıma -->
            <div class="solution-benefit-card" data-spotlight>
                <div class="solution-icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" y1="22" x2="15" y2="22"></line>
                        <line x1="4" y1="9" x2="14" y2="9"></line>
                        <path d="M14 22V4a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v18"></path>
                        <path d="M14 13h2a2 2 0 0 1 2 2v2a2 2 0 0 0 2 2h0a2 2 0 0 0 2-2V9.83a2 2 0 0 0-.59-1.42L18 5"></path>
                    </svg>
                </div>
                <h3>Akaryakıt & Taşıt Tanıma Sistemi</h3>
                <p>Anlaşmalı istasyon ağlarında sürücüye nakit vermeden otomatik yakıt alımı, indirimli fiyatlar ve tek merkezi e-fatura.</p>
            </div>

            <!-- 4. Lastik Oteli -->
            <div class="solution-benefit-card" data-spotlight>
                <div class="solution-icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <circle cx="12" cy="12" r="4"></circle>
                        <line x1="4.93" y1="4.93" x2="9.17" y2="9.17"></line>
                        <line x1="14.83" y1="14.83" x2="19.07" y2="19.07"></line>
                        <line x1="14.83" y1="9.17" x2="19.07" y2="4.93"></line>
                        <line x1="4.93" y1="19.07" x2="9.17" y2="14.83"></line>
                    </svg>
                </div>
                <h3>Lastik Oteli & Mevsim Değişimi</h3>
                <p>Kış ve yaz lastiği geçişlerinde Türkiye çapında randevu planlaması ve sezon dışı lastiklerinizin iklimlendirmeli depolarda saklanması.</p>
            </div>

            <!-- 5. Yol Yardım -->
            <div class="solution-benefit-card" data-spotlight>
                <div class="solution-icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2"></path>
                        <circle cx="7" cy="17" r="2"></circle>
                        <path d="M9 17h6"></path>
                        <circle cx="17" cy="17" r="2"></circle>
                    </svg>
                </div>
                <h3>7/24 Kesintisiz Yol Yardım & İkame</h3>
                <p>Türkiye'nin her noktasında kaza ve arıza durumunda öncelikli çekici, konaklama, transfer ve hızlı ikame araç desteği.</p>
            </div>

            <!-- 6. TCO Raporlama -->
            <div class="solution-benefit-card" data-spotlight>
                <div class="solution-icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="20" x2="18" y2="10"></line>
                        <line x1="12" y1="20" x2="12" y2="4"></line>
                        <line x1="6" y1="20" x2="6" y2="14"></line>
                    </svg>
                </div>
                <h3>Toplam Maliyet (TCO) & KPI Analizi</h3>
                <p>Yıllık kilometre aşım riskleri, yakıt tüketim trendleri ve sürücü puanlamaları ile yönetim kurulunuza şeffaf raporlar sunun.</p>
            </div>
        </div>
    </div>
</section>

<!-- ─── 3. METRİK STRİP ─────────────────────────────────────────────── -->
<section class="section section-paper" style="padding-top: 0;" data-reveal="fade-up">
    <div class="container">
        <div class="solution-metric-strip mb-16">
            <div class="solution-metric-item">
                <div class="solution-metric-val">%30</div>
                <div class="solution-metric-label">Operasyonel Tasarruf</div>
                <p class="solution-metric-sub">Yakıt ve servis optimizasyonu ile düşürülen giderler</p>
            </div>
            <div class="solution-metric-item">
                <div class="solution-metric-val">%99.8</div>
                <div class="solution-metric-label">Filo Çalışma Sürekliliği</div>
                <p class="solution-metric-sub">Hızlı ikame araç ve periyodik planlı bakım garantisi</p>
            </div>
            <div class="solution-metric-item">
                <div class="solution-metric-val">15 Dk</div>
                <div class="solution-metric-label">Ortalama Destek Yanıtı</div>
                <p class="solution-metric-sub">7/24 operasyon merkezi müdahale ve çekici yönlendirme süresi</p>
            </div>
        </div>
    </div>
</section>

<!-- ─── 4. ÇALIŞMA METODOLOJİSİ ────────────────────────────────────── -->
<section class="section section-ivory" data-reveal="fade-up">
    <div class="container">
        <div class="section-header text-center" style="max-width: 720px; margin: 0 auto var(--space-12);">
            <span class="editorial-tag">Nasıl Çalışıyoruz?</span>
            <h2 style="font-size: clamp(2rem, 3vw, 2.6rem); font-weight: var(--font-weight-normal); margin-top: var(--space-2);">
                4 Aşamalı Filo Entegrasyonu
            </h2>
        </div>

        <div class="solution-process-grid mb-16">
            <div class="solution-step-card">
                <div class="solution-step-num">01</div>
                <div class="solution-step-title">Filo Denetimi</div>
                <p class="solution-step-desc">Mevcut filonuzun yaş, kilometre, bakım ve yakıt verilerini analiz ederek verimsiz noktaları tespit ederiz.</p>
            </div>
            <div class="solution-step-card">
                <div class="solution-step-num">02</div>
                <div class="solution-step-title">Özel Çözüm Tasarımı</div>
                <p class="solution-step-desc">Şirketinize en uygun telematik altyapısı, servis anlaşmaları ve kiralama/yönetim modelini kurgularız.</p>
            </div>
            <div class="solution-step-card">
                <div class="solution-step-num">03</div>
                <div class="solution-step-title">Sistem Entegrasyonu</div>
                <p class="solution-step-desc">Taşıt tanıma, GPS cihazları ve sürücü mobil uygulamaları filonuza entegre edilir.</p>
            </div>
            <div class="solution-step-card">
                <div class="solution-step-num">04</div>
                <div class="solution-step-title">7/24 Aktif Yönetim</div>
                <p class="solution-step-desc">Filo yöneticiniz periyodik raporlamalarla tasarruf fırsatlarını sürekli olarak hayata geçirir.</p>
            </div>
        </div>
    </div>
</section>

<!-- ─── 5. KURUMSAL TEKLİF CTA BANNER ──────────────────────────────── -->
<section class="section-sm" style="padding-top: 0;">
    <div class="container">
        <div class="solution-cta-card">
            <h3>Filonuz İçin Özel Yönetim Teklifi Alın</h3>
            <p>Mevcut araçlarınız veya sıfırdan kuracağınız kurumsal filo için bütçenize en uygun yönetim planını hazırlayalım.</p>
            <div class="solution-cta-actions">
                <a href="<?php echo url('filo-teklif.php'); ?>" class="btn btn-primary btn-lg"><?php e('quote_form.fleet_title'); ?></a>
                <button type="button" class="btn btn-outline btn-lg" data-open-modal="callback"><?php e('home.cta_call'); ?></button>
            </div>
        </div>
    </div>
</section>

<?php include includePath('footer.php'); ?>
