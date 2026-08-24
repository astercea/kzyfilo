<?php
/**
 * kzyfilo — Araç Teslim ve Ýade Rehberi (arac-teslim-ve-iade.php)
 */
require_once __DIR__ . '/includes/config.php';

setPageMeta([
    'title' => t('solutions_menu.delivery_return') . ' | ' . SITE_NAME,
    'description' => 'kzyfilo araç teslim alma, kullaným içi süreçler ve sözleþme sonu iade adýmlarý rehberi.',
    'canonical' => canonical('arac-teslim-ve-iade.php'),
]);

$breadcrumbs = [
    ['title' => t('services.title'), 'url' => url('hizmetler.php')],
    ['title' => t('solutions_menu.delivery_return')]
];

include includePath('header.php');
?>

<div class="service-hero">
    <div class="container text-center">
        <span class="hero-subtitle">Þeffaf ve Güvenilir Süreçler</span>
        <h1 class="text-4xl mb-4"><?php e('solutions_menu.delivery_return'); ?></h1>
        <p class="text-lg text-muted max-w-xl mx-auto mb-6">
            Aracýnýzý teslim alýrken ve sözleþme sonunda iade ederken izlenecek pratik adýmlar, gerekli evraklar ve teslim noktalarý.
        </p>
    </div>
</div>

<?php include includePath('breadcrumbs.php'); ?>

<section class="section">
    <div class="container container-narrow">
        <!-- 1. Araç Teslim Alma Süreci -->
        <div class="mb-12">
            <h2 class="text-2xl mb-6">1. Araç Teslim Alma Süreci</h2>
            <div class="card card-body">
                <div class="flex flex-col gap-4 text-sm">
                    <div class="flex gap-3 items-start">
                        <span class="badge badge-primary">Adým 1</span>
                        <div>
                            <strong>Sözleþme Onayý ve Randevu</strong>
                            <p class="text-muted mb-0">Finansal onay ve sözleþme imzalanmasýnýn ardýndan müþteri temsilciniz teslimat randevusunu oluþturur.</p>
                        </div>
                    </div>
                    <div class="flex gap-3 items-start">
                        <span class="badge badge-primary">Adým 2</span>
                        <div>
                            <strong>Gerekli Belgelerin Ýbrazý</strong>
                            <p class="text-muted mb-0">Yetkili þirket imza sirküleri, vekaletname (varsa) ve teslim alacak sürücünün ehliyet/kimlik belgesi kontrol edilir.</p>
                        </div>
                    </div>
                    <div class="flex gap-3 items-start">
                        <span class="badge badge-primary">Adým 3</span>
                        <div>
                            <strong>Teslim Tutanaðý ve Araç Ýntikali</strong>
                            <p class="text-muted mb-0">Kilometre, yakýt seviyesi ve mevcut araç durumu tutanak altýna alýnarak anahtar teslim edilir.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Araç Ýade Süreci -->
        <div class="mb-12">
            <h2 class="text-2xl mb-6">2. Sözleþme Sonu Ýade Süreci</h2>
            <div class="card card-body">
                <div class="flex flex-col gap-4 text-sm">
                    <div class="flex gap-3 items-start">
                        <span class="badge badge-warning">Kontrol 1</span>
                        <div>
                            <strong>Ýade Öncesi Randevu</strong>
                            <p class="text-muted mb-0">Sözleþme bitim tarihinden en az 15 gün önce iade noktasý ve saatini belirlemek için temsilcinizle iletiþime geçiniz.</p>
                        </div>
                    </div>
                    <div class="flex gap-3 items-start">
                        <span class="badge badge-warning">Kontrol 2</span>
                        <div>
                            <strong>Ekipman ve Evrak Tamlýðý</strong>
                            <p class="text-muted mb-0">Ruhsat, yedek anahtar, stepne/tamir kiti, yangýn tüpü ve ilk yardým seti araç içinde eksiksiz bulunmalýdýr.</p>
                        </div>
                    </div>
                    <div class="flex gap-3 items-start">
                        <span class="badge badge-warning">Kontrol 3</span>
                        <div>
                            <strong>Ekspertiz ve Ýade Tutanaðý</strong>
                            <p class="text-muted mb-0">Ýade noktasýndaki uzman ekspertiz ekibi tarafýndan kontrol yapýlýr ve karþýlýklý ýslak/dijital imzalý tutanak düzenlenir.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ýade Noktalarýna Yönlendirme -->
        <div class="card card-body p-8 text-center bg-surface-soft">
            <h3 class="text-xl mb-2">Size En Yakýn Ýade Noktasýný Bulun</h3>
            <p class="text-muted text-sm mb-6">Ýstanbul, Ankara, Ýzmir ve diðer illerdeki yetkili teslim ve iade noktalarýmýzýn adres ve çalýþma saatlerini inceleyin.</p>
            <a href="<?php echo url('arac-iade-noktalari.php'); ?>" class="btn btn-primary"><?php e('return_points.title'); ?> ›</a>
        </div>
    </div>
</section>

<?php include includePath('footer.php'); ?>
