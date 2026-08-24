<?php
/**
 * kzyfilo — KVKK Aydýnlatma Metni (kvkk.php)
 */
require_once __DIR__ . '/includes/config.php';

setPageMeta([
    'title' => t('legal.kvkk_title') . ' | ' . SITE_NAME,
    'description' => 'kzyfilo Kiþisel Verilerin Korunmasý Kanunu (KVKK) Aydýnlatma Metni.',
    'canonical' => canonical('kvkk.php'),
]);

$breadcrumbs = [
    ['title' => t('legal.kvkk_title')]
];

include includePath('header.php');
?>

<div class="page-header">
    <div class="container text-center">
        <h1><?php e('legal.kvkk_title'); ?></h1>
        <p>6698 Sayýlý Kiþisel Verilerin Korunmasý Kanunu Kapsamýnda Bilgilendirme</p>
    </div>

<?php include includePath('breadcrumbs.php'); ?>
</div>

<section class="section">
    <div class="container container-narrow">
        <div class="card card-body text-sm" style="line-height: 1.8;">
            <h3 class="text-base fw-bold mb-3">1. Veri Sorumlusu</h3>
            <p>
                6698 sayýlý Kiþisel Verilerin Korunmasý Kanunu (“KVKK”) uyarýnca, kzyfilo (“Þirket”) olarak, veri sorumlusu sýfatýyla, kiþisel verilerinizi aþaðýda açýklanan amaçlar kapsamýnda; hukuka ve dürüstlük kurallarýna uygun bir þekilde iþleyebilecek, kaydedebilecek, saklayabilecek ve mevzuatýn izin verdiði hallerde üçüncü kiþilere aktarabilecektir.
            </p>

            <h3 class="text-base fw-bold my-4">2. Kiþisel Verilerin Ýþlenme Amaçlarý</h3>
            <p>
                Toplanan kiþisel verileriniz; kurumsal filo kiralama ve filo yönetimi hizmetlerimizin sunulabilmesi, teklif ve sözleþme süreçlerinin yürütülmesi, müþteri iliþkileri yönetimi, faturalandýrma ve yasal yükümlülüklerin yerine getirilmesi amaçlarýyla iþlenmektedir.
            </p>

            <h3 class="text-base fw-bold my-4">3. Ýþlenen Kiþisel Verilerin Aktarýlmasý</h3>
            <p>
                Kiþisel verileriniz; yetkili kamu kurum ve kuruluþlarýna, adli makamlara, kanunen yetkili özel hukuk tüzel kiþilerine ve hizmetlerimizin ifasý amacýyla anlaþmalý yetkili servis, sigorta þirketleri ve finans kuruluþlarýna kanunun 8. ve 9. maddelerine uygun olarak aktarýlabilecektir.
            </p>

            <h3 class="text-base fw-bold my-4">4. Ýlgili Kiþinin Haklarý</h3>
            <p>
                KVKK’nýn 11. maddesi uyarýnca veri sahipleri; kiþisel verilerinin iþlenip iþlenmediðini öðrenme, iþlenmiþse buna iliþkin bilgi talep etme, silinmesini veya düzeltilmesini isteme ve kanuna aykýrý iþleme sebebiyle zarara uðramasý halinde zararýn giderilmesini talep etme haklarýna sahiptir.
            </p>

            <p class="mt-6 text-muted text-xs">
                Son Güncelleme: 24 Aðustos 2026 | kzyfilo Yönetimi
            </p>
        </div>
    </div>
</section>

<?php include includePath('footer.php'); ?>
