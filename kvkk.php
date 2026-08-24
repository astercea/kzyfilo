<?php
/**
 * kzyfilo — KVKK Aydınlatma Metni (kvkk.php)
 */
require_once __DIR__ . '/includes/config.php';

setPageMeta([
    'title' => t('legal.kvkk_title') . ' | ' . SITE_NAME,
    'description' => 'kzyfilo Kişisel Verilerin Korunması Kanunu (KVKK) Aydınlatma Metni.',
    'canonical' => canonical('kvkk.php'),
]);

$breadcrumbs = [
    ['title' => t('legal.kvkk_title')]
];

include includePath('header.php');
include includePath('breadcrumbs.php');
?>

<div class="page-header">
    <div class="container text-center">
        <h1><?php e('legal.kvkk_title'); ?></h1>
        <p>6698 Sayılı Kişisel Verilerin Korunması Kanunu Kapsamında Bilgilendirme</p>
    </div>
</div>

<section class="section">
    <div class="container container-narrow">
        <div class="card card-body text-sm" style="line-height: 1.8;">
            <h3 class="text-base fw-bold mb-3">1. Veri Sorumlusu</h3>
            <p>
                6698 sayılı Kişisel Verilerin Korunması Kanunu (“KVKK”) uyarınca, kzyfilo (“Şirket”) olarak, veri sorumlusu sıfatıyla, kişisel verilerinizi aşağıda açıklanan amaçlar kapsamında; hukuka ve dürüstlük kurallarına uygun bir şekilde işleyebilecek, kaydedebilecek, saklayabilecek ve mevzuatın izin verdiği hallerde üçüncü kişilere aktarabilecektir.
            </p>

            <h3 class="text-base fw-bold my-4">2. Kişisel Verilerin İşlenme Amaçları</h3>
            <p>
                Toplanan kişisel verileriniz; kurumsal filo kiralama ve filo yönetimi hizmetlerimizin sunulabilmesi, teklif ve sözleşme süreçlerinin yürütülmesi, müşteri ilişkileri yönetimi, faturalandırma ve yasal yükümlülüklerin yerine getirilmesi amaçlarıyla işlenmektedir.
            </p>

            <h3 class="text-base fw-bold my-4">3. İşlenen Kişisel Verilerin Aktarılması</h3>
            <p>
                Kişisel verileriniz; yetkili kamu kurum ve kuruluşlarına, adli makamlara, kanunen yetkili özel hukuk tüzel kişilerine ve hizmetlerimizin ifası amacıyla anlaşmalı yetkili servis, sigorta şirketleri ve finans kuruluşlarına kanunun 8. ve 9. maddelerine uygun olarak aktarılabilecektir.
            </p>

            <h3 class="text-base fw-bold my-4">4. İlgili Kişinin Hakları</h3>
            <p>
                KVKK’nın 11. maddesi uyarınca veri sahipleri; kişisel verilerinin işlenip işlenmediğini öğrenme, işlenmişse buna ilişkin bilgi talep etme, silinmesini veya düzeltilmesini isteme ve kanuna aykırı işleme sebebiyle zarara uğraması halinde zararın giderilmesini talep etme haklarına sahiptir.
            </p>

            <p class="mt-6 text-muted text-xs">
                Son Güncelleme: 24 Ağustos 2026 | kzyfilo Yönetimi
            </p>
        </div>
    </div>
</section>

<?php include includePath('footer.php'); ?>
