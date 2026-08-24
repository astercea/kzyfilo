<?php
/**
 * kzyfilo — Referanslarımız (referanslar.php)
 */
require_once __DIR__ . '/includes/config.php';

setPageMeta([
    'title' => t('references.title') . ' | ' . SITE_NAME,
    'description' => t('references.description'),
    'canonical' => canonical('referanslar.php'),
]);

$breadcrumbs = [
    ['title' => t('references.title')]
];

include includePath('header.php');
include includePath('breadcrumbs.php');
?>

<div class="page-header">
    <div class="container text-center">
        <h1><?php e('references.title'); ?></h1>
        <p>Bize güvenen yüzlerce seçkin kurumsal marka ve iş ortağımız</p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="section-header">
            <h2>Farklı Sektörlerden Güçlü İş Birlikleri</h2>
            <p>Sanayi, perakende, lojistik, teknoloji ve finans sektörlerinde filolarını kzyfilo'ya emanet eden şirketler (Demo).</p>
        </div>

        <div class="grid grid-4 gap-6 mb-16">
            <?php for ($i = 1; $i <= 12; $i++): ?>
                <div class="card card-body text-center flex flex-col justify-center items-center py-8">
                    <div style="width: 60px; height: 60px; border-radius: 50%; background-color: var(--color-surface-soft); display: flex; align-items: center; justify-content: center; margin-bottom: var(--space-3); color: var(--color-muted);">
                        🏢
                    </div>
                    <strong class="text-sm text-dark">KURUMSAL MÜŞTERİ <?php echo $i; ?></strong>
                    <span class="text-xs text-muted">Sektörel Lider (Demo)</span>
                </div>
            <?php endfor; ?>
        </div>

        <div class="card card-body p-12 text-center bg-surface-soft">
            <h3 class="text-2xl mb-3">Şirketiniz İçin Güvenilir Filo Çözüm Ortağı</h3>
            <p class="text-muted max-w-lg mx-auto mb-6">Kurumsal referanslarımızın arasına katılmak ve filonuzu profesyonelce yönetmek için teklif alın.</p>
            <a href="<?php echo url('hizli-teklif.php'); ?>" class="btn btn-primary btn-lg"><?php e('header.get_quote'); ?> →</a>
        </div>
    </div>
</section>

<?php include includePath('footer.php'); ?>
