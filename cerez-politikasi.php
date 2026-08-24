<?php
/**
 * kzyfilo — Çerez Politikasý (cerez-politikasi.php)
 */
require_once __DIR__ . '/includes/config.php';

setPageMeta([
    'title' => t('legal.cookie_title') . ' | ' . SITE_NAME,
    'description' => 'kzyfilo çerez kullaným politikasý ve tercih yönetimi bilgilendirmesi.',
    'canonical' => canonical('cerez-politikasi.php'),
]);

$breadcrumbs = [
    ['title' => t('legal.cookie_title')]
];

include includePath('header.php');
?>

<div class="page-header">
    <div class="container text-center">
        <h1><?php e('legal.cookie_title'); ?></h1>
        <p>Web sitemizdeki çerez türleri ve kullaným amaçlarý</p>
    </div>

<?php include includePath('breadcrumbs.php'); ?>
</div>

<section class="section">
    <div class="container container-narrow">
        <div class="card card-body text-sm" style="line-height: 1.8;">
            <h3 class="text-base fw-bold mb-3">Çerez (Cookie) Nedir?</h3>
            <p>
                Çerezler, ziyaret ettiðiniz web siteleri tarafýndan tarayýcýnýz aracýlýðýyla cihazýnýza veya að sunucusuna depolanan küçük metin dosyalarýdýr.
            </p>

            <h3 class="text-base fw-bold my-4">Kullandýðýmýz Çerez Türleri</h3>
            <ul class="flex flex-col gap-3">
                <li>• <strong>Zorunlu Çerezler:</strong> Web sitesinin düzgün çalýþabilmesi, oturum yönetimi ve dil tercihinin korunmasý için gereklidir.</li>
                <li>• <strong>Analitik Çerezler:</strong> Sitenin performansýný ölçmek ve ziyaretçi deneyimini optimize etmek amacýyla anonim istatistiksel veriler toplar.</li>
                <li>• <strong>Pazarlama Çerezleri:</strong> Ýlgi alanlarýnýza uygun teklif ve kampanyalar sunulabilmesi için kullanýlýr.</li>
            </ul>

            <h3 class="text-base fw-bold my-4">Çerez Tercihlerini Deðiþtirme</h3>
            <p>
                Sitemizin alt kýsmýnda yer alan çerez tercih paneli veya tarayýcýnýzýn ayarlarý üzerinden dilediðiniz zaman çerez kullaným tercihlerinizi güncelleyebilirsiniz.
            </p>
        </div>
    </div>
</section>

<?php include includePath('footer.php'); ?>
