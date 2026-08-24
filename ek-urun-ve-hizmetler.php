<?php
/**
 * kzyfilo — Ek Ürün ve Hizmetler (ek-urun-ve-hizmetler.php)
 */
require_once __DIR__ . '/includes/config.php';

$services = loadData('services.php');

setPageMeta([
    'title' => t('solutions_menu.additional_services') . ' | ' . SITE_NAME,
    'description' => 'Filo kiralama deneyiminizi zenginleştiren ek ürün ve katma değerli operasyonel hizmetler.',
    'canonical' => canonical('ek-urun-ve-hizmetler.php'),
]);

$breadcrumbs = [
    ['title' => t('services.title'), 'url' => url('hizmetler.php')],
    ['title' => t('solutions_menu.additional_services')]
];

include includePath('header.php');?>

<div class="service-hero">
    <div class="container text-center">
        <span class="hero-subtitle">Katma Değerli Çözümler</span>
        <h1 class="text-4xl mb-4"><?php e('solutions_menu.additional_services'); ?></h1>
        <p class="text-lg text-muted max-w-xl mx-auto mb-6">
            Standart kiralamanın ötesinde, şirketinizin operasyonel ihtiyaçlarına tam uyum sağlayan esnek ve özel hizmet paketleri.
        </p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="grid grid-2 gap-6 mb-12">
            <?php foreach ($services as $service): ?>
                <div class="card card-body flex flex-col justify-between">
                    <div>
                        <div class="flex flex-between items-start mb-3">
                            <h3 class="text-xl"><?php echo esc($service['name']); ?></h3>
                            <span class="badge badge-primary">
                                +<?php echo number_format($service['price'], 0, ',', '.'); ?> ₺ <?php echo ($service['type'] === 'monthly') ? '/ay' : '(Tek Sefer)'; ?>
                            </span>
                        </div>
                        <p class="text-sm text-muted mb-4"><?php echo esc($service['description']); ?></p>
                        <p class="text-xs text-dark" style="background-color: var(--color-surface-soft); padding: 12px; border-radius: 8px;">
                            ℹ️ <?php echo esc($service['info']); ?>
                        </p>
                            <?php include includePath('breadcrumbs.php'); ?>
    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="card card-body text-center p-8 bg-surface-soft">
            <h3 class="text-xl mb-2">Filonuza Özel Ek Hizmet Tanımlayın</h3>
            <p class="text-muted text-sm mb-6">Teklif sürecinde ihtiyacınız olan tüm ek ürün ve hizmetleri tek tıkla kiralama paketinize ekleyebilirsiniz.</p>
            <a href="<?php echo url('hizli-teklif.php'); ?>" class="btn btn-primary"><?php e('header.get_quote'); ?></a>
        </div>
    </div>
</section>

<?php include includePath('footer.php'); ?>
