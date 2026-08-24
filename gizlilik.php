<?php
/**
 * kzyfilo — Gizlilik Politikası (gizlilik.php)
 */
require_once __DIR__ . '/includes/config.php';

setPageMeta([
    'title' => t('legal.privacy_title') . ' | ' . SITE_NAME,
    'description' => 'kzyfilo Gizlilik Politikası ve veri güvenliği esasları.',
    'canonical' => canonical('gizlilik.php'),
]);

$breadcrumbs = [
    ['title' => t('legal.privacy_title')]
];

include includePath('header.php');
include includePath('breadcrumbs.php');
?>

<div class="page-header">
    <div class="container text-center">
        <h1><?php e('legal.privacy_title'); ?></h1>
        <p>Gizliliğinize ve kurumsal veri güvenliğinize önem veriyoruz</p>
    </div>
</div>

<section class="section">
    <div class="container container-narrow">
        <div class="card card-body text-sm" style="line-height: 1.8;">
            <p>
                kzyfilo (“kzyfilo.com.tr”), web sitemizi ziyaret eden kullanıcıların ve hizmetlerimizden yararlanan kurumsal müşterilerimizin gizliliğini korumayı taahhüt eder. Bu Gizlilik Politikası, sitemizi ziyaret ettiğinizde toplanan bilgilerin nasıl kullanıldığını ve korunduğunu açıklar.
            </p>
            <h3 class="text-base fw-bold my-4">Bilgi Toplama ve Kullanımı</h3>
            <p>
                Teklif formları, iletişim talepleri ve online işlem bildirimleri esnasında sizlerden talep edilen ad, soyad, telefon, e-posta ve şirket bilgileri yalnızca hizmet taleplerinizin karşılanması ve iletişim amacıyla kullanılır.
            </p>
            <h3 class="text-base fw-bold my-4">Bilgi Güvenliği</h3>
            <p>
                Kişisel ve kurumsal verileriniz yetkisiz erişim, kayıp veya kötüye kullanıma karşı uluslararası standartlarda SSL şifreleme ve güvenlik duvarı altyapıları ile korunmaktadır.
            </p>
        </div>
    </div>
</section>

<?php include includePath('footer.php'); ?>
