<?php
/**
 * kzyfilo — Gizlilik Politikasý (gizlilik.php)
 */
require_once __DIR__ . '/includes/config.php';

setPageMeta([
    'title' => t('legal.privacy_title') . ' | ' . SITE_NAME,
    'description' => 'kzyfilo Gizlilik Politikasý ve veri güvenliði esaslarý.',
    'canonical' => canonical('gizlilik.php'),
]);

$breadcrumbs = [
    ['title' => t('legal.privacy_title')]
];

include includePath('header.php');
?>

<div class="page-header">
    <div class="container text-center">
        <h1><?php e('legal.privacy_title'); ?></h1>
        <p>Gizliliðinize ve kurumsal veri güvenliðinize önem veriyoruz</p>
    </div>

<?php include includePath('breadcrumbs.php'); ?>
</div>

<section class="section">
    <div class="container container-narrow">
        <div class="card card-body text-sm" style="line-height: 1.8;">
            <p>
                kzyfilo (“kzyfilo.com.tr”), web sitemizi ziyaret eden kullanýcýlarýn ve hizmetlerimizden yararlanan kurumsal müþterilerimizin gizliliðini korumayý taahhüt eder. Bu Gizlilik Politikasý, sitemizi ziyaret ettiðinizde toplanan bilgilerin nasýl kullanýldýðýný ve korunduðunu açýklar.
            </p>
            <h3 class="text-base fw-bold my-4">Bilgi Toplama ve Kullanýmý</h3>
            <p>
                Teklif formlarý, iletiþim talepleri ve online iþlem bildirimleri esnasýnda sizlerden talep edilen ad, soyad, telefon, e-posta ve þirket bilgileri yalnýzca hizmet taleplerinizin karþýlanmasý ve iletiþim amacýyla kullanýlýr.
            </p>
            <h3 class="text-base fw-bold my-4">Bilgi Güvenliði</h3>
            <p>
                Kiþisel ve kurumsal verileriniz yetkisiz eriþim, kayýp veya kötüye kullanýma karþý uluslararasý standartlarda SSL þifreleme ve güvenlik duvarý altyapýlarý ile korunmaktadýr.
            </p>
        </div>
    </div>
</section>

<?php include includePath('footer.php'); ?>
