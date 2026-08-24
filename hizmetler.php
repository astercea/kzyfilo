<?php
/**
 * kzyfilo — Genel Çözümlerimiz Sayfası (hizmetler.php)
 */
require_once __DIR__ . '/includes/config.php';

setPageMeta([
    'title' => t('services.title') . ' | ' . SITE_NAME,
    'description' => t('services.description'),
    'canonical' => canonical('hizmetler.php'),
]);

$breadcrumbs = [
    ['title' => t('services.title')]
];

include includePath('header.php');
include includePath('breadcrumbs.php');
?>

<div class="page-header">
    <div class="container text-center">
        <h1><?php e('services.title'); ?></h1>
        <p><?php e('services.description'); ?></p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="grid grid-3 gap-8">
            <!-- 1. Uzun Dönem Araç Kiralama -->
            <div class="card card-body flex flex-col justify-between">
                <div>
                    <div class="service-feature-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                    </div>
                    <h3 class="text-xl mb-2"><?php e('solutions_menu.long_term_rental'); ?></h3>
                    <p class="text-sm text-muted mb-4"><?php echo (CURRENT_LANG === 'tr') ? '12 aydan 48 aya varan esnek kiralama vadeleri, sıfır sermaye bağlama ve tam vergi avantajı ile şirketinizi büyütün.' : 'Grow your business with flexible 12 to 48 months leases, zero capital lock-in, and total tax benefits.'; ?></p>
                </div>
                <a href="<?php echo url('uzun-donem-arac-kiralama.php'); ?>" class="btn btn-outline btn-sm">
                    <?php e('btn.learn_more'); ?> →
                </a>
            </div>

            <!-- 2. Filo Yönetimi -->
            <div class="card card-body flex flex-col justify-between">
                <div>
                    <div class="service-feature-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl mb-2"><?php e('solutions_menu.fleet_management'); ?></h3>
                    <p class="text-sm text-muted mb-4"><?php echo (CURRENT_LANG === 'tr') ? 'Bakım, hasar, telematik ve yakıt yönetimini tek çatı altında toplayarak filo maliyetlerinizi optimize edin.' : 'Optimize fleet costs by bringing maintenance, damage, telematics, and fuel management under one roof.'; ?></p>
                </div>
                <a href="<?php echo url('filo-yonetimi.php'); ?>" class="btn btn-outline btn-sm">
                    <?php e('btn.learn_more'); ?> →
                </a>
            </div>

            <!-- 3. Binek Araç Kiralama -->
            <div class="card card-body flex flex-col justify-between">
                <div>
                    <div class="service-feature-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.5 2.8C2.1 11 2 11.5 2 12v4c0 .6.4 1 1 1h2"></path>
                            <circle cx="7" cy="17" r="2"></circle>
                            <circle cx="17" cy="17" r="2"></circle>
                        </svg>
                    </div>
                    <h3 class="text-xl mb-2"><?php e('solutions_menu.passenger_rental'); ?></h3>
                    <p class="text-sm text-muted mb-4"><?php echo (CURRENT_LANG === 'tr') ? 'Saha satıştan üst düzey yönetici araçlarına kadar geniş sedan, hatchback ve SUV model seçenekleri.' : 'Extensive sedan, hatchback, and SUV models from field sales to executive fleet cars.'; ?></p>
                </div>
                <a href="<?php echo url('binek-arac-kiralama.php'); ?>" class="btn btn-outline btn-sm">
                    <?php e('btn.learn_more'); ?> →
                </a>
            </div>

            <!-- 4. Ticari Araç Kiralama -->
            <div class="card card-body flex flex-col justify-between">
                <div>
                    <div class="service-feature-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="1" y="3" width="15" height="13"></rect>
                            <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                            <circle cx="5.5" cy="18.5" r="2.5"></circle>
                            <circle cx="18.5" cy="18.5" r="2.5"></circle>
                        </svg>
                    </div>
                    <h3 class="text-xl mb-2"><?php e('solutions_menu.commercial_rental'); ?></h3>
                    <p class="text-sm text-muted mb-4"><?php echo (CURRENT_LANG === 'tr') ? 'Hafif ticari, minivan ve panelvan araçlarla lojistik ve saha operasyonlarınızda maksimum taşıma verimliliği.' : 'Maximum transport efficiency for logistics and field operations with light commercial and van vehicles.'; ?></p>
                </div>
                <a href="<?php echo url('ticari-arac-kiralama.php'); ?>" class="btn btn-outline btn-sm">
                    <?php e('btn.learn_more'); ?> →
                </a>
            </div>

            <!-- 5. Elektrikli Araç Kiralama -->
            <div class="card card-body flex flex-col justify-between">
                <div>
                    <div class="service-feature-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                        </svg>
                    </div>
                    <h3 class="text-xl mb-2"><?php e('solutions_menu.electric_rental'); ?></h3>
                    <p class="text-sm text-muted mb-4"><?php echo (CURRENT_LANG === 'tr') ? '%100 elektrikli ve hibrit filo filosuyla çevresel sürdürülebilirliğe katkı sağlayın, yakıttan tasarruf edin.' : 'Contribute to environmental sustainability and save on fuel with 100% electric and hybrid fleets.'; ?></p>
                </div>
                <a href="<?php echo url('elektrikli-arac-kiralama.php'); ?>" class="btn btn-outline btn-sm">
                    <?php e('btn.learn_more'); ?> →
                </a>
            </div>

            <!-- 6. Ek Ürün ve Hizmetler -->
            <div class="card card-body flex flex-col justify-between">
                <div>
                    <div class="service-feature-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="3"></circle>
                            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl mb-2"><?php e('solutions_menu.additional_services'); ?></h3>
                    <p class="text-sm text-muted mb-4"><?php echo (CURRENT_LANG === 'tr') ? 'Lastik oteli, ek sürücü, GPS takip, VIP teslimat ve mini hasar paketi gibi katma değerli çözümler.' : 'Value-added solutions such as tire hotel, extra driver, GPS tracking, VIP delivery, and mini damage cover.'; ?></p>
                </div>
                <a href="<?php echo url('ek-urun-ve-hizmetler.php'); ?>" class="btn btn-outline btn-sm">
                    <?php e('btn.learn_more'); ?> →
                </a>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section">
    <div class="container">
        <h2><?php e('home.cta_title'); ?></h2>
        <p><?php e('home.cta_desc'); ?></p>
        <div class="cta-actions">
            <a href="<?php echo url('araclar.php'); ?>" class="btn btn-primary btn-lg"><?php e('home.cta_vehicles'); ?></a>
            <a href="<?php echo url('hizli-teklif.php'); ?>" class="btn btn-secondary btn-lg"><?php e('home.cta_quote'); ?></a>
        </div>
    </div>
</section>

<?php include includePath('footer.php'); ?>
