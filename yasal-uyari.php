<?php
/**
 * kzyfilo — Yasal Uyarý (yasal-uyari.php)
 */
require_once __DIR__ . '/includes/config.php';

setPageMeta([
    'title' => t('legal.legal_title') . ' | ' . SITE_NAME,
    'description' => 'kzyfilo web sitesi kullaným koþullarý ve yasal uyarý metni.',
    'canonical' => canonical('yasal-uyari.php'),
]);

$breadcrumbs = [
    ['title' => t('legal.legal_title')]
];

include includePath('header.php');
?>

<div class="page-header">
    <div class="container text-center">
        <h1><?php e('legal.legal_title'); ?></h1>
        <p>Web Sitesi Kullaným Koþullarý ve Yasal Þartlar</p>
    </div>

<?php include includePath('breadcrumbs.php'); ?>
</div>

<section class="section">
    <div class="container container-narrow">
        <div class="card card-body text-sm" style="line-height: 1.8;">
            <h3 class="text-base fw-bold mb-3">Fikri Mülkiyet Haklarý</h3>
            <p>
                Bu web sitesinde yer alan tüm ticari markalar, logolar, grafikler, metinler ve yazýlýmlar kzyfilo’ya ait olup ulusal ve uluslararasý telif hakký mevzuatýyla korunmaktadýr. Ýzinsiz kopyalanamaz ve çoðaltýlamaz.
            </p>

            <h3 class="text-base fw-bold my-4">Ýçerik ve Fiyatlandýrma Sorumluluðu</h3>
            <p>
                Sitede yer alan araç teknik özellikleri, kiralama paketleri ve fiyatlar bilgilendirme amaçlýdýr. Nihai kiralama koþullarý ve fiyatlar kzyfilo tarafýndan onaylanan resmi teklif ve sözleþme belgeleri ile kesinlik kazanýr.
            </p>
        </div>
    </div>
</section>

<?php include includePath('footer.php'); ?>
