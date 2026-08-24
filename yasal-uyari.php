<?php
/**
 * kzyfilo — Yasal Uyarı (yasal-uyari.php)
 */
require_once __DIR__ . '/includes/config.php';

setPageMeta([
    'title' => t('legal.legal_title') . ' | ' . SITE_NAME,
    'description' => 'kzyfilo web sitesi kullanım koşulları ve yasal uyarı metni.',
    'canonical' => canonical('yasal-uyari.php'),
]);

$breadcrumbs = [
    ['title' => t('legal.legal_title')]
];

include includePath('header.php');
include includePath('breadcrumbs.php');
?>

<div class="page-header">
    <div class="container text-center">
        <h1><?php e('legal.legal_title'); ?></h1>
        <p>Web Sitesi Kullanım Koşulları ve Yasal Şartlar</p>
    </div>
</div>

<section class="section">
    <div class="container container-narrow">
        <div class="card card-body text-sm" style="line-height: 1.8;">
            <h3 class="text-base fw-bold mb-3">Fikri Mülkiyet Hakları</h3>
            <p>
                Bu web sitesinde yer alan tüm ticari markalar, logolar, grafikler, metinler ve yazılımlar kzyfilo’ya ait olup ulusal ve uluslararası telif hakkı mevzuatıyla korunmaktadır. İzinsiz kopyalanamaz ve çoğaltılamaz.
            </p>

            <h3 class="text-base fw-bold my-4">İçerik ve Fiyatlandırma Sorumluluğu</h3>
            <p>
                Sitede yer alan araç teknik özellikleri, kiralama paketleri ve fiyatlar bilgilendirme amaçlıdır. Nihai kiralama koşulları ve fiyatlar kzyfilo tarafından onaylanan resmi teklif ve sözleşme belgeleri ile kesinlik kazanır.
            </p>
        </div>
    </div>
</section>

<?php include includePath('footer.php'); ?>
