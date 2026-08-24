<?php
/**
 * kzyfilo — Araç Teslim ve İade Rehberi (arac-teslim-ve-iade.php)
 */
require_once __DIR__ . '/includes/config.php';

setPageMeta([
    'title' => t('solutions_menu.delivery_return') . ' | ' . SITE_NAME,
    'description' => 'kzyfilo araç teslim alma, kullanım içi süreçler ve sözleşme sonu iade adımları rehberi.',
    'canonical' => canonical('arac-teslim-ve-iade.php'),
]);

$breadcrumbs = [
    ['title' => t('services.title'), 'url' => url('hizmetler.php')],
    ['title' => t('solutions_menu.delivery_return')]
];

include includePath('header.php');
include includePath('breadcrumbs.php');
?>

<div class="service-hero">
    <div class="container text-center">
        <span class="hero-subtitle">Şeffaf ve Güvenilir Süreçler</span>
        <h1 class="text-4xl mb-4"><?php e('solutions_menu.delivery_return'); ?></h1>
        <p class="text-lg text-muted max-w-xl mx-auto mb-6">
            Aracınızı teslim alırken ve sözleşme sonunda iade ederken izlenecek pratik adımlar, gerekli evraklar ve teslim noktaları.
        </p>
    </div>
</div>

<section class="section">
    <div class="container container-narrow">
        <!-- 1. Araç Teslim Alma Süreci -->
        <div class="mb-12">
            <h2 class="text-2xl mb-6">1. Araç Teslim Alma Süreci</h2>
            <div class="card card-body">
                <div class="flex flex-col gap-4 text-sm">
                    <div class="flex gap-3 items-start">
                        <span class="badge badge-primary">Adım 1</span>
                        <div>
                            <strong>Sözleşme Onayı ve Randevu</strong>
                            <p class="text-muted mb-0">Finansal onay ve sözleşme imzalanmasının ardından müşteri temsilciniz teslimat randevusunu oluşturur.</p>
                        </div>
                    </div>
                    <div class="flex gap-3 items-start">
                        <span class="badge badge-primary">Adım 2</span>
                        <div>
                            <strong>Gerekli Belgelerin İbrazı</strong>
                            <p class="text-muted mb-0">Yetkili şirket imza sirküleri, vekaletname (varsa) ve teslim alacak sürücünün ehliyet/kimlik belgesi kontrol edilir.</p>
                        </div>
                    </div>
                    <div class="flex gap-3 items-start">
                        <span class="badge badge-primary">Adım 3</span>
                        <div>
                            <strong>Teslim Tutanağı ve Araç İntikali</strong>
                            <p class="text-muted mb-0">Kilometre, yakıt seviyesi ve mevcut araç durumu tutanak altına alınarak anahtar teslim edilir.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Araç İade Süreci -->
        <div class="mb-12">
            <h2 class="text-2xl mb-6">2. Sözleşme Sonu İade Süreci</h2>
            <div class="card card-body">
                <div class="flex flex-col gap-4 text-sm">
                    <div class="flex gap-3 items-start">
                        <span class="badge badge-warning">Kontrol 1</span>
                        <div>
                            <strong>İade Öncesi Randevu</strong>
                            <p class="text-muted mb-0">Sözleşme bitim tarihinden en az 15 gün önce iade noktası ve saatini belirlemek için temsilcinizle iletişime geçiniz.</p>
                        </div>
                    </div>
                    <div class="flex gap-3 items-start">
                        <span class="badge badge-warning">Kontrol 2</span>
                        <div>
                            <strong>Ekipman ve Evrak Tamlığı</strong>
                            <p class="text-muted mb-0">Ruhsat, yedek anahtar, stepne/tamir kiti, yangın tüpü ve ilk yardım seti araç içinde eksiksiz bulunmalıdır.</p>
                        </div>
                    </div>
                    <div class="flex gap-3 items-start">
                        <span class="badge badge-warning">Kontrol 3</span>
                        <div>
                            <strong>Ekspertiz ve İade Tutanağı</strong>
                            <p class="text-muted mb-0">İade noktasındaki uzman ekspertiz ekibi tarafından kontrol yapılır ve karşılıklı ıslak/dijital imzalı tutanak düzenlenir.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- İade Noktalarına Yönlendirme -->
        <div class="card card-body p-8 text-center bg-surface-soft">
            <h3 class="text-xl mb-2">Size En Yakın İade Noktasını Bulun</h3>
            <p class="text-muted text-sm mb-6">İstanbul, Ankara, İzmir ve diğer illerdeki yetkili teslim ve iade noktalarımızın adres ve çalışma saatlerini inceleyin.</p>
            <a href="<?php echo url('arac-iade-noktalari.php'); ?>" class="btn btn-primary"><?php e('return_points.title'); ?> →</a>
        </div>
    </div>
</section>

<?php include includePath('footer.php'); ?>
