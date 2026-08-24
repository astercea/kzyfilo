<?php
/**
 * kzyfilo — Hakkýmýzda (hakkimizda.php)
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

include includePath('header.php');
?>

<div class="page-header">
    <div class="container text-center">
        <h1><?php e('about.title'); ?></h1>
        <p><?php e('site_tagline'); ?></p>
    </div>

<?php include includePath('breadcrumbs.php'); ?>
</div>

<section class="section">
    <div class="container container-narrow">
        <div class="mb-12">
            <h2 class="text-3xl mb-4">Biz Kimiz?</h2>
            <p class="text-lg text-muted mb-4">
                kzyfilo; kurumsal þirketlere, KOBÝ'lere ve profesyonellere uzun dönem araç kiralama, filo optimizasyonu ve bütünleþik mobilite yönetimi hizmetleri sunan öncü ve güvenilir bir filo kiralama markasýdýr.
            </p>
            <p class="text-muted">
                Otomotiv sektöründeki köklü deneyimimiz, güçlü finansal yapýmýz ve müþteri odaklý hizmet felsefemiz ile þirketlerin operasyonel araç ihtiyaçlarýný sýfýr risk ve maksimum maliyet avantajý ile karþýlýyoruz.
            </p>
        </div>

        <!-- Misyon & Vizyon -->
        <div class="grid grid-2 gap-6 mb-16">
            <div class="card card-body">
                <h3 class="text-xl text-primary mb-3">Misyonumuz</h3>
                <p class="text-sm text-muted mb-0">
                    Ýþletmelerin mobilite ihtiyaçlarýný en doðru araç modelleri, þeffaf fiyatlandýrma ve kesintisiz 7/24 operasyonel destekle karþýlayarak onlarýn ana iþlerine odaklanmalarýný saðlamak.
                </p>
            </div>
            <div class="card card-body">
                <h3 class="text-xl text-primary mb-3">Vizyonumuz</h3>
                <p class="text-sm text-muted mb-0">
                    Yenilikçi telematik teknolojileri, sürdürülebilir elektrikli araç filolarý ve üstün müþteri deneyimi ile Türkiye'nin en çok tercih edilen kurumsal filo çözüm ortaðý olmak.
                </p>
            </div>
        </div>

        <!-- Deðerlerimiz -->
        <div class="mb-16">
            <h2 class="text-2xl mb-6 text-center">Kurumsal Deðerlerimiz</h2>
            <div class="grid grid-3 gap-6">
                <div class="service-feature-card">
                    <div class="service-feature-icon">??</div>
                    <h4 class="text-base mb-2">Güven ve Þeffaflýk</h4>
                    <p class="text-sm text-muted">Sürpriz masraf içermeyen net faturalandýrma ve açýk sözleþme þartlarý.</p>
                </div>
                <div class="service-feature-card">
                    <div class="service-feature-icon">?</div>
                    <h4 class="text-base mb-2">Hýz ve Çözüm Odaklýlýk</h4>
                    <p class="text-sm text-muted">Yetkili servis süreçlerinde ve ikame araç temininde anýnda reaksiyon.</p>
                </div>
                <div class="service-feature-card">
                    <div class="service-feature-icon">??</div>
                    <h4 class="text-base mb-2">Sürdürülebilirlik</h4>
                    <p class="text-sm text-muted">Çevreci hibrit ve elektrikli araç modelleriyle yeþil filo dönüþümüne öncülük.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include includePath('footer.php'); ?>
