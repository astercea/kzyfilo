<?php
/**
 * kzyfilo — Çerez Politikası (cerez-politikasi.php)
 */
require_once __DIR__ . '/includes/config.php';

setPageMeta([
    'title' => t('legal.cookie_title') . ' | ' . SITE_NAME,
    'description' => 'kzyfilo çerez kullanım politikası ve tercih yönetimi bilgilendirmesi.',
    'canonical' => canonical('cerez-politikasi.php'),
]);

$breadcrumbs = [
    ['title' => t('legal.cookie_title')]
];

include includePath('header.php');
include includePath('breadcrumbs.php');
?>

<div class="page-header">
    <div class="container text-center">
        <h1><?php e('legal.cookie_title'); ?></h1>
        <p>Web sitemizdeki çerez türleri ve kullanım amaçları</p>
    </div>
</div>

<section class="section">
    <div class="container container-narrow">
        <div class="card card-body text-sm" style="line-height: 1.8;">
            <h3 class="text-base fw-bold mb-3">Çerez (Cookie) Nedir?</h3>
            <p>
                Çerezler, ziyaret ettiğiniz web siteleri tarafından tarayıcınız aracılığıyla cihazınıza veya ağ sunucusuna depolanan küçük metin dosyalarıdır.
            </p>

            <h3 class="text-base fw-bold my-4">Kullandığımız Çerez Türleri</h3>
            <ul class="flex flex-col gap-3">
                <li>• <strong>Zorunlu Çerezler:</strong> Web sitesinin düzgün çalışabilmesi, oturum yönetimi ve dil tercihinin korunması için gereklidir.</li>
                <li>• <strong>Analitik Çerezler:</strong> Sitenin performansını ölçmek ve ziyaretçi deneyimini optimize etmek amacıyla anonim istatistiksel veriler toplar.</li>
                <li>• <strong>Pazarlama Çerezleri:</strong> İlgi alanlarınıza uygun teklif ve kampanyalar sunulabilmesi için kullanılır.</li>
            </ul>

            <h3 class="text-base fw-bold my-4">Çerez Tercihlerini Değiştirme</h3>
            <p>
                Sitemizin alt kısmında yer alan çerez tercih paneli veya tarayıcınızın ayarları üzerinden dilediğiniz zaman çerez kullanım tercihlerinizi güncelleyebilirsiniz.
            </p>
        </div>
    </div>
</section>

<?php include includePath('footer.php'); ?>
