<?php
/**
 * kzyfilo — Hakkımızda (hakkimizda.php)
 */
require_once __DIR__ . '/includes/config.php';

setPageMeta([
    'title' => t('about.title') . ' | ' . SITE_NAME,
    'description' => t('about.description'),
    'canonical' => canonical('hakkimizda.php'),
]);

$breadcrumbs = [
    ['title' => t('about.title')]
];

include includePath('header.php');?>

<div class="page-header">
    <div class="container">
        <h1><?php e('about.title'); ?></h1>
        <?php include includePath('breadcrumbs.php'); ?>
    </div>
</div>

<section class="section">
    <div class="container container-narrow" data-reveal="fade-up">
        <div class="mb-12">
            <h2 class="text-3xl mb-4">Biz Kimiz?</h2>
            <p class="text-lg text-muted mb-4">
                kzyfilo; kurumsal şirketlere, KOBİ'lere ve profesyonellere uzun dönem araç kiralama, filo optimizasyonu ve bütünleşik mobilite yönetimi hizmetleri sunan öncü ve güvenilir bir filo kiralama markasıdır.
            </p>
            <p class="text-muted">
                Otomotiv sektöründeki köklü deneyimimiz, güçlü finansal yapımız ve müşteri odaklı hizmet felsefemiz ile şirketlerin operasyonel araç ihtiyaçlarını sıfır risk ve maksimum maliyet avantajı ile karşılıyoruz.
            </p>
        </div>

        <!-- Misyon & Vizyon -->
        <div class="grid grid-2 gap-6 mb-16">
            <div class="card card-body" data-spotlight>
                <h3 class="text-xl text-primary mb-3">Misyonumuz</h3>
                <p class="text-sm text-muted mb-0">
                    İşletmelerin mobilite ihtiyaçlarını en doğru araç modelleri, şeffaf fiyatlandırma ve kesintisiz 7/24 operasyonel destekle karşılayarak onların ana işlerine odaklanmalarını sağlamak.
                </p>
            </div>
            <div class="card card-body" data-spotlight>
                <h3 class="text-xl text-primary mb-3">Vizyonumuz</h3>
                <p class="text-sm text-muted mb-0">
                    Yenilikçi telematik teknolojileri, sürdürülebilir elektrikli araç filoları ve üstün müşteri deneyimi ile Türkiye'nin en çok tercih edilen kurumsal filo çözüm ortağı olmak.
                </p>
            </div>
        </div>

        <!-- Değerlerimiz -->
        <div class="mb-16">
            <h2 class="text-2xl mb-6 text-center">Kurumsal Değerlerimiz</h2>
            <div class="grid grid-3 gap-6">
                <div class="service-feature-card" data-spotlight>
                    <div class="service-feature-icon">🤝</div>
                    <h4 class="text-base mb-2">Güven ve Şeffaflık</h4>
                    <p class="text-sm text-muted">Sürpriz masraf içermeyen net faturalandırma ve açık sözleşme şartları.</p>
                </div>
                <div class="service-feature-card">
                    <div class="service-feature-icon">⚡</div>
                    <h4 class="text-base mb-2">Hız ve Çözüm Odaklılık</h4>
                    <p class="text-sm text-muted">Yetkili servis süreçlerinde ve ikame araç temininde anında reaksiyon.</p>
                </div>
                <div class="service-feature-card">
                    <div class="service-feature-icon">🌱</div>
                    <h4 class="text-base mb-2">Sürdürülebilirlik</h4>
                    <p class="text-sm text-muted">Çevreci hibrit ve elektrikli araç modelleriyle yeşil filo dönüşümüne öncülük.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include includePath('footer.php'); ?>
