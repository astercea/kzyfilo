<?php
/**
 * kzyfilo — HTML Site Haritasý (site-haritasi.php)
 */
require_once __DIR__ . '/includes/config.php';

setPageMeta([
    'title' => t('sitemap.title') . ' | ' . SITE_NAME,
    'description' => t('sitemap.description'),
    'canonical' => canonical('site-haritasi.php'),
]);

$breadcrumbs = [
    ['title' => t('sitemap.title')]
];

include includePath('header.php');
?>

<div class="page-header">
    <div class="container text-center">
        <h1><?php e('sitemap.title'); ?></h1>
        <p><?php e('sitemap.description'); ?></p>
    </div>

<?php include includePath('breadcrumbs.php'); ?>
</div>

<section class="section">
    <div class="container container-narrow">
        <div class="grid grid-3 gap-8">
            <!-- 1. Ana Sayfa & Araçlar -->
            <div class="card card-body">
                <h3 class="text-lg fw-bold text-primary mb-4">?? Araçlar & Katalog</h3>
                <ul class="flex flex-col gap-2 text-sm">
                    <li><a href="<?php echo url('index.php'); ?>">• <?php e('header.home'); ?></a></li>
                    <li><a href="<?php echo url('araclar.php'); ?>">• <?php e('header.vehicles'); ?></a></li>
                    <li><a href="<?php echo url('arac-karsilastir.php'); ?>">• <?php e('compare.title'); ?></a></li>
                    <li><a href="<?php echo url('paket-karsilastir.php'); ?>">• <?php e('package_compare.title'); ?></a></li>
                    <li><a href="<?php echo url('listem.php'); ?>">• <?php e('my_list.title'); ?></a></li>
                    <li><a href="<?php echo url('hizli-teklif.php'); ?>">• <?php e('quote_form.quick_title'); ?></a></li>
                    <li><a href="<?php echo url('filo-teklif.php'); ?>">• <?php e('quote_form.fleet_title'); ?></a></li>
                </ul>
            </div>

            <!-- 2. Çözümlerimiz -->
            <div class="card card-body">
                <h3 class="text-lg fw-bold text-primary mb-4">?? Çözümlerimiz</h3>
                <ul class="flex flex-col gap-2 text-sm">
                    <li><a href="<?php echo url('hizmetler.php'); ?>">• Genel Çözümlerimiz</a></li>
                    <li><a href="<?php echo url('uzun-donem-arac-kiralama.php'); ?>">• <?php e('solutions_menu.long_term_rental'); ?></a></li>
                    <li><a href="<?php echo url('filo-yonetimi.php'); ?>">• <?php e('solutions_menu.fleet_management'); ?></a></li>
                    <li><a href="<?php echo url('binek-arac-kiralama.php'); ?>">• <?php e('solutions_menu.passenger_rental'); ?></a></li>
                    <li><a href="<?php echo url('ticari-arac-kiralama.php'); ?>">• <?php e('solutions_menu.commercial_rental'); ?></a></li>
                    <li><a href="<?php echo url('elektrikli-arac-kiralama.php'); ?>">• <?php e('solutions_menu.electric_rental'); ?></a></li>
                    <li><a href="<?php echo url('ek-urun-ve-hizmetler.php'); ?>">• <?php e('solutions_menu.additional_services'); ?></a></li>
                    <li><a href="<?php echo url('arac-teslim-ve-iade.php'); ?>">• <?php e('solutions_menu.delivery_return'); ?></a></li>
                </ul>
            </div>

            <!-- 3. Kurumsal & Ýletiþim -->
            <div class="card card-body">
                <h3 class="text-lg fw-bold text-primary mb-4">?? Kurumsal & Ýletiþim</h3>
                <ul class="flex flex-col gap-2 text-sm">
                    <li><a href="<?php echo url('hakkimizda.php'); ?>">• <?php e('header.about'); ?></a></li>
                    <li><a href="<?php echo url('referanslar.php'); ?>">• <?php e('references.title'); ?></a></li>
                    <li><a href="<?php echo url('iletisim.php'); ?>">• <?php e('header.contact'); ?></a></li>
                    <li><a href="<?php echo url('ofisler.php'); ?>">• <?php e('offices.title'); ?></a></li>
                    <li><a href="<?php echo url('arac-iade-noktalari.php'); ?>">• <?php e('return_points.title'); ?></a></li>
                    <li><a href="<?php echo url('online-islemler.php'); ?>">• <?php e('online.title'); ?></a></li>
                </ul>
            </div>

            <!-- 4. Kaynaklar -->
            <div class="card card-body">
                <h3 class="text-lg fw-bold text-primary mb-4">?? Kaynaklar & Medya</h3>
                <ul class="flex flex-col gap-2 text-sm">
                    <li><a href="<?php echo url('blog.php'); ?>">• <?php e('resources_menu.blog'); ?></a></li>
                    <li><a href="<?php echo url('haberler.php'); ?>">• <?php e('resources_menu.news'); ?></a></li>
                    <li><a href="<?php echo url('sss.php'); ?>">• <?php e('resources_menu.faq'); ?></a></li>
                </ul>
            </div>

            <!-- 5. Yasal & Politikalar -->
            <div class="card card-body">
                <h3 class="text-lg fw-bold text-primary mb-4">?? Yasal & Politikalar</h3>
                <ul class="flex flex-col gap-2 text-sm">
                    <li><a href="<?php echo url('kvkk.php'); ?>">• <?php e('legal.kvkk_title'); ?></a></li>
                    <li><a href="<?php echo url('gizlilik.php'); ?>">• <?php e('legal.privacy_title'); ?></a></li>
                    <li><a href="<?php echo url('cerez-politikasi.php'); ?>">• <?php e('legal.cookie_title'); ?></a></li>
                    <li><a href="<?php echo url('yasal-uyari.php'); ?>">• <?php e('legal.legal_title'); ?></a></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<?php include includePath('footer.php'); ?>
