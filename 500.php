<?php
/**
 * kzyfilo — 500 Sunucu Hatası (500.php)
 */
require_once __DIR__ . '/includes/config.php';

http_response_code(500);

setPageMeta([
    'title' => t('error.500_title') . ' | ' . SITE_NAME,
    'description' => t('error.500_desc'),
    'canonical' => canonical('500.php'),
]);

$breadcrumbs = [
    ['title' => t('error.500_title')]
];

include includePath('header.php');
include includePath('breadcrumbs.php');
?>

<section class="section">
    <div class="container text-center">
        <div class="empty-state">
            <div class="text-6xl fw-extrabold text-error mb-4" style="font-size: 5rem;">500</div>
            <h1 class="text-3xl mb-3"><?php e('error.500_title'); ?></h1>
            <p class="text-muted max-w-md mx-auto mb-8"><?php e('error.500_desc'); ?></p>
            <div class="flex gap-4 justify-center">
                <a href="<?php echo url('index.php'); ?>" class="btn btn-primary btn-lg"><?php e('error.500_btn'); ?></a>
                <a href="<?php echo url('iletisim.php'); ?>" class="btn btn-outline btn-lg"><?php e('header.contact'); ?></a>
            </div>
        </div>
    </div>
</section>

<?php include includePath('footer.php'); ?>
