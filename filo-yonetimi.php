<?php
/**
 * kzyfilo — Filo Yönetimi Hizmet Sayfasý (filo-yonetimi.php)
 */
require_once __DIR__ . '/includes/config.php';

setPageMeta([
    'title' => t('solutions_menu.fleet_management') . ' | ' . SITE_NAME,
    'description' => 'Profesyonel filo yönetimi, telematik takip, yakýt ve bakým süreçleri ile þirketinizin operasyonel verimliliðini artýrýn.',
    'canonical' => canonical('filo-yonetimi.php'),
]);

$breadcrumbs = [
    ['title' => t('services.title'), 'url' => url('hizmetler.php')],
    ['title' => t('solutions_menu.fleet_management')]
];

include includePath('header.php');
?>

<div class="service-hero">
    <div class="container">
        <div class="max-w-xl">
            <span class="hero-subtitle">Kurumsal Mobilite Çözümleri</span>
            <h1 class="text-4xl mb-4"><?php e('solutions_menu.fleet_management'); ?></h1>
            <p class="text-lg text-muted mb-6">
                Araç takip, yakýt optimizasyonu, periyodik bakým planlama ve 7/24 operasyonel destek ile þirket filonuzu sýfýr aksamayla yönetiyoruz.
            </p>
            <div class="flex gap-4">
                <a href="<?php echo url('filo-teklif.php'); ?>" class="btn btn-primary btn-lg"><?php e('quote_form.fleet_title'); ?></a>
                <button type="button" class="btn btn-outline btn-lg" data-open-modal="callback"><?php e('home.cta_call'); ?></button>
            </div>
        </div>

<?php include includePath('breadcrumbs.php'); ?>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="section-header">
            <h2>Kapsamlý Filo Yönetim Hizmetlerimiz</h2>
            <p>Filonuzun tüm operasyonel yaþam döngüsünü profesyonelce yönetiyoruz</p>
        </div>

        <div class="service-features mb-16">
            <div class="service-feature-card">
                <div class="service-feature-icon">??</div>
                <h4 class="text-base mb-2">Canlý Telematik & Araç Takip</h4>
                <p class="text-sm text-muted">7/24 GPS takip, rota optimizasyonu, hýz ve rölanti raporlamasý ile saha ekiplerinizi kontrol altýnda tutun.</p>
            </div>
            <div class="service-feature-card">
                <div class="service-feature-icon">???</div>
                <h4 class="text-base mb-2">Bakým & Hasar Süreçleri</h4>
                <p class="text-sm text-muted">Yetkili servis randevularý, hasar dosya takibi, ekspertiz ve onarým onaylarý uzman ekibimiz tarafýndan yürütülür.</p>
            </div>
            <div class="service-feature-card">
                <div class="service-feature-icon">?</div>
                <h4 class="text-base mb-2">Akaryakýt & Taþýt Tanýma</h4>
                <p class="text-sm text-muted">Anlaþmalý istasyonlarda temassýz yakýt alýmý, indirimli fiyatlar ve tek merkezi fatura ile muhasebe kolaylýðý.</p>
            </div>
            <div class="service-feature-card">
                <div class="service-feature-icon">??</div>
                <h4 class="text-base mb-2">Lastik & Lastik Oteli</h4>
                <p class="text-sm text-muted">Mevsim geçiþlerinde lastik deðiþim randevularý ve sezon dýþý lastiklerinizin sigortalý depolanmasý.</p>
            </div>
            <div class="service-feature-card">
                <div class="service-feature-icon">??</div>
                <h4 class="text-base mb-2">7/24 Öncelikli Yol Yardým</h4>
                <p class="text-sm text-muted">Türkiye genelinde arýza ve kaza anýnda anýnda çekici, konaklama ve hýzlý ikame araç temini.</p>
            </div>
            <div class="service-feature-card">
                <div class="service-feature-icon">??</div>
                <h4 class="text-base mb-2">Aylýk Filo Analiz Raporlarý</h4>
                <p class="text-sm text-muted">Kilometre aþým riskleri, yakýt tüketim trendleri ve toplam sahip olma maliyeti (TCO) analizleri.</p>
            </div>
        </div>

        <!-- Filo Teklif Banner -->
        <div class="card card-body p-12 text-center" style="background: linear-gradient(135deg, var(--color-surface-soft) 0%, var(--color-background) 100%);">
            <h3 class="text-2xl mb-3">Filonuz Ýçin Özel Yönetim Teklifi Alýn</h3>
            <p class="text-muted max-w-lg mx-auto mb-6">Mevcut veya yeni kuracaðýnýz filonuz için bütçe hedeflerinize uygun teklif hazýrlayalým.</p>
            <a href="<?php echo url('filo-teklif.php'); ?>" class="btn btn-primary btn-lg"><?php e('quote_form.fleet_title'); ?> ›</a>
        </div>
    </div>
</section>

<?php include includePath('footer.php'); ?>
