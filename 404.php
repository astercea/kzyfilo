<?php
/**
 * kzyfilo — 404 Sayfa Bulunamadı (404.php)
 */
require_once __DIR__ . '/includes/config.php';

http_response_code(404);

setPageMeta([
    'title' => t('error.404_title') . ' | ' . SITE_NAME,
    'description' => t('error.404_desc'),
    'canonical' => canonical('404.php'),
]);

$breadcrumbs = [
    ['title' => t('error.404_title')]
];

include includePath('header.php');
include includePath('breadcrumbs.php');
?>

<section class="section">
    <div class="container text-center">
        <div class="empty-state">
            <div class="text-6xl fw-extrabold text-primary mb-4" style="font-size: 5rem;">404</div>
            <h1 class="text-3xl mb-3"><?php e('error.404_title'); ?></h1>
            <p class="text-muted max-w-md mx-auto mb-8"><?php e('error.404_desc'); ?></p>
            <div class="flex gap-4 justify-center">
                <a href="<?php echo url('index.php'); ?>" class="btn btn-primary btn-lg"><?php e('error.404_btn'); ?></a>
                <a href="<?php echo url('araclar.php'); ?>" class="btn btn-outline btn-lg"><?php e('home.hero_cta_vehicles'); ?></a>
            </div>
        </div>
    </div>
</section>

<?php include includePath('footer.php'); ?>
