<?php
/**
 * kzyfilo — Filo Yönetimi Hizmet Sayfası (filo-yonetimi.php)
 */
require_once __DIR__ . '/includes/config.php';

setPageMeta([
    'title' => t('solutions_menu.fleet_management') . ' | ' . SITE_NAME,
    'description' => 'Profesyonel filo yönetimi, telematik takip, yakıt ve bakım süreçleri ile şirketinizin operasyonel verimliliğini artırın.',
    'canonical' => canonical('filo-yonetimi.php'),
]);

$breadcrumbs = [
    ['title' => t('services.title'), 'url' => url('hizmetler.php')],
    ['title' => t('solutions_menu.fleet_management')]
];

include includePath('header.php');
include includePath('breadcrumbs.php');
?>

<div class="service-hero">
    <div class="container">
        <div class="max-w-xl">
            <span class="hero-subtitle">Kurumsal Mobilite Çözümleri</span>
            <h1 class="text-4xl mb-4"><?php e('solutions_menu.fleet_management'); ?></h1>
            <p class="text-lg text-muted mb-6">
                Araç takip, yakıt optimizasyonu, periyodik bakım planlama ve 7/24 operasyonel destek ile şirket filonuzu sıfır aksamayla yönetiyoruz.
            </p>
            <div class="flex gap-4">
                <a href="<?php echo url('filo-teklif.php'); ?>" class="btn btn-primary btn-lg"><?php e('quote_form.fleet_title'); ?></a>
                <button type="button" class="btn btn-outline btn-lg" data-open-modal="callback"><?php e('home.cta_call'); ?></button>
            </div>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="section-header">
            <h2>Kapsamlı Filo Yönetim Hizmetlerimiz</h2>
            <p>Filonuzun tüm operasyonel yaşam döngüsünü profesyonelce yönetiyoruz</p>
        </div>

        <div class="service-features mb-16">
            <div class="service-feature-card">
                <div class="service-feature-icon">📊</div>
                <h4 class="text-base mb-2">Canlı Telematik & Araç Takip</h4>
                <p class="text-sm text-muted">7/24 GPS takip, rota optimizasyonu, hız ve rölanti raporlaması ile saha ekiplerinizi kontrol altında tutun.</p>
            </div>
            <div class="service-feature-card">
                <div class="service-feature-icon">🛠️</div>
                <h4 class="text-base mb-2">Bakım & Hasar Süreçleri</h4>
                <p class="text-sm text-muted">Yetkili servis randevuları, hasar dosya takibi, ekspertiz ve onarım onayları uzman ekibimiz tarafından yürütülür.</p>
            </div>
            <div class="service-feature-card">
                <div class="service-feature-icon">⛽</div>
                <h4 class="text-base mb-2">Akaryakıt & Taşıt Tanıma</h4>
                <p class="text-sm text-muted">Anlaşmalı istasyonlarda temassız yakıt alımı, indirimli fiyatlar ve tek merkezi fatura ile muhasebe kolaylığı.</p>
            </div>
            <div class="service-feature-card">
                <div class="service-feature-icon">🛞</div>
                <h4 class="text-base mb-2">Lastik & Lastik Oteli</h4>
                <p class="text-sm text-muted">Mevsim geçişlerinde lastik değişim randevuları ve sezon dışı lastiklerinizin sigortalı depolanması.</p>
            </div>
            <div class="service-feature-card">
                <div class="service-feature-icon">🚨</div>
                <h4 class="text-base mb-2">7/24 Öncelikli Yol Yardım</h4>
                <p class="text-sm text-muted">Türkiye genelinde arıza ve kaza anında anında çekici, konaklama ve hızlı ikame araç temini.</p>
            </div>
            <div class="service-feature-card">
                <div class="service-feature-icon">📈</div>
                <h4 class="text-base mb-2">Aylık Filo Analiz Raporları</h4>
                <p class="text-sm text-muted">Kilometre aşım riskleri, yakıt tüketim trendleri ve toplam sahip olma maliyeti (TCO) analizleri.</p>
            </div>
        </div>

        <!-- Filo Teklif Banner -->
        <div class="card card-body p-12 text-center" style="background: linear-gradient(135deg, var(--color-surface-soft) 0%, var(--color-background) 100%);">
            <h3 class="text-2xl mb-3">Filonuz İçin Özel Yönetim Teklifi Alın</h3>
            <p class="text-muted max-w-lg mx-auto mb-6">Mevcut veya yeni kuracağınız filonuz için bütçe hedeflerinize uygun teklif hazırlayalım.</p>
            <a href="<?php echo url('filo-teklif.php'); ?>" class="btn btn-primary btn-lg"><?php e('quote_form.fleet_title'); ?> →</a>
        </div>
    </div>
</section>

<?php include includePath('footer.php'); ?>
