<?php
/**
 * kzyfilo — Uzun Dönem Araç Kiralama (uzun-donem-arac-kiralama.php)
 */
require_once __DIR__ . '/includes/config.php';

$vehicles = loadData('vehicles.php');
$faqsData = loadData('faqs.php');

setPageMeta([
    'title' => t('solutions_menu.long_term_rental') . ' | ' . SITE_NAME,
    'description' => 'Şirketiniz için 12-48 ay vadeli avantajlı uzun dönem kurumsal araç kiralama çözümleri.',
    'canonical' => canonical('uzun-donem-arac-kiralama.php'),
]);

$breadcrumbs = [
    ['title' => t('services.title'), 'url' => url('hizmetler.php')],
    ['title' => t('solutions_menu.long_term_rental')]
];

include includePath('header.php');?>

<div class="service-hero">
    <div class="container">
        <div class="max-w-xl">
            <span class="hero-subtitle"><?php e('site_name'); ?> Filo Çözümleri</span>
            <h1 class="text-4xl mb-4"><?php e('solutions_menu.long_term_rental'); ?></h1>
            <p class="text-lg text-muted mb-6">
                Şirket sermayenizi araç satın almaya bağlamadan, sabit aylık giderler, tam vergi avantajı ve sıfır operasyonel risk ile filonuzu yenileyin.
            </p>
            <div class="flex gap-4">
                <a href="<?php echo url('hizli-teklif.php'); ?>" class="btn btn-primary btn-lg"><?php e('header.get_quote'); ?></a>
                <a href="<?php echo url('araclar.php'); ?>" class="btn btn-outline btn-lg"><?php e('home.hero_cta_vehicles'); ?></a>
                    <?php include includePath('breadcrumbs.php'); ?>
    </div>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="section-header">
            <h2>Neden Uzun Dönem Filo Kiralama?</h2>
            <p>Satın alma yerine operasyonel kiralamayı tercih etmeniz için 6 stratejik neden</p>
        </div>

        <div class="service-features mb-16">
            <div class="service-feature-card">
                <div class="service-feature-icon">💰</div>
                <h4 class="text-base mb-2">Finansal Esneklik</h4>
                <p class="text-sm text-muted">Büyük peşinatlar ve banka kredi limitlerinizi tüketmeden filonuzu kurun, nakit akışınızı ana işinize yönlendirin.</p>
            </div>
            <div class="service-feature-card">
                <div class="service-feature-icon">📑</div>
                <h4 class="text-base mb-2">Tam Vergi Avantajı</h4>
                <p class="text-sm text-muted">Aylık kira faturalarını mevzuat sınırları dahilinde doğrudan gider gösterin, KDV indiriminden faydalanın.</p>
            </div>
            <div class="service-feature-card">
                <div class="service-feature-icon">🔧</div>
                <h4 class="text-base mb-2">Bakım & Hasar Güvencesi</h4>
                <p class="text-sm text-muted">Yetkili servis bakımları, kasko, sigorta ve lastik değişim masrafları aylık kiranıza dahildir.</p>
            </div>
            <div class="service-feature-card">
                <div class="service-feature-icon">🚗</div>
                <h4 class="text-base mb-2">İkame Araç Desteği</h4>
                <p class="text-sm text-muted">Aracınız servisteyken işlerinizin aksamaması için aynı segmentte yedek araç anında tahsis edilir.</p>
            </div>
            <div class="service-feature-card">
                <div class="service-feature-icon">📉</div>
                <h4 class="text-base mb-2">İkinci El Değer Kaybı Riski Yok</h4>
                <p class="text-sm text-muted">Kiralama süresi sonunda aracın piyasa değer kaybı veya satış zahmeti tamamen kzyfilo sorumluluğundadır.</p>
            </div>
            <div class="service-feature-card">
                <div class="service-feature-icon">⏱️</div>
                <h4 class="text-base mb-2">Zaman ve İş Gücü Tasarrufu</h4>
                <p class="text-sm text-muted">Muayene, MTV, trafik cezaları ve operasyonel takipleri uzman ekibimiz yönetir, siz işinize odaklanırsınız.</p>
            </div>
        </div>

        <!-- Öne Çıkan Araçlar -->
        <div class="mb-16">
            <div class="flex flex-between mb-8">
                <h2 class="text-2xl">Uzun Dönem İçin Popüler Araçlar</h2>
                <a href="<?php echo url('araclar.php'); ?>" class="btn btn-outline btn-sm"><?php e('btn.view_all'); ?></a>
            </div>
            <div class="grid grid-3 gap-6">
                <?php foreach (array_slice($vehicles, 0, 3) as $vehicle): ?>
                    <?php include includePath('vehicle-card.php'); ?>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- SSS -->
        <div class="container-narrow">
            <h2 class="text-2xl text-center mb-8">Sıkça Sorulan Sorular</h2>
            <div class="accordion">
                <?php foreach ($faqsData['general']['items'] as $faq): ?>
                    <div class="accordion-item">
                        <button type="button" class="accordion-trigger" aria-expanded="false">
                            <span><?php echo esc($faq['question']); ?></span>
                            <svg class="accordion-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </button>
                        <div class="accordion-panel">
                            <div class="accordion-panel-content"><?php echo esc($faq['answer']); ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section">
    <div class="container">
        <h2>Filonuzu Uzun Dönem Kiralamayla Hemen Büyütün</h2>
        <p>Uzman filo danışmanlarımız şirketinizin ihtiyaçlarına özel teklif hazırlamak için hazır.</p>
        <div class="cta-actions">
            <a href="<?php echo url('hizli-teklif.php'); ?>" class="btn btn-primary btn-lg"><?php e('header.get_quote'); ?></a>
            <button type="button" class="btn btn-outline btn-lg" style="color: #ffffff; border-color: #ffffff;" data-open-modal="callback"><?php e('home.cta_call'); ?></button>
        </div>
    </div>
</section>

<?php include includePath('footer.php'); ?>
