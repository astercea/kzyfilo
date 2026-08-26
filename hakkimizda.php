<?php
/**
 * kzyfilo — Hakkımızda (hakkimizda.php)
 * KZY Executive Corporate Profile & Heritage
 */
require_once __DIR__ . '/includes/config.php';

setPageMeta([
    'title' => t('about.title') . ' | ' . SITE_NAME,
    'description' => 'Kuzey Otomotiv Grubu güvencesiyle faaliyet gösteren Kzy Filo; özgün çalışma modeli, geniş araç filosu ve kurumsal filo çözümleri sunmaktadır.',
    'canonical' => canonical('hakkimizda.php'),
]);

$breadcrumbs = [
    ['title' => t('about.title')]
];

// Başlıca Kurumsal Referanslarımız
$references = [
    [
        'name' => 'FÖRCH TÜRKİYE',
        'url' => 'https://www.forch.com.tr',
        'domain' => 'www.forch.com.tr'
    ],
    [
        'name' => 'EKMOB SFA',
        'url' => 'https://www.ekmob.com',
        'domain' => 'www.ekmob.com'
    ],
    [
        'name' => 'GM BAKIR',
        'url' => 'https://www.gmcopperalloys.com',
        'domain' => 'www.gmcopperalloys.com'
    ],
    [
        'name' => 'GÜVEN TEST',
        'url' => 'https://www.guventest.com',
        'domain' => 'www.guventest.com'
    ],
    [
        'name' => 'LİMUNA SAĞLIK',
        'url' => 'https://www.luminahealthcaretr.com',
        'domain' => 'www.luminahealthcaretr.com'
    ],
    [
        'name' => 'MAXXMORA',
        'url' => 'https://www.maxxmora.com.tr',
        'domain' => 'www.maxxmora.com.tr'
    ],
    [
        'name' => 'OTOMOT FİLO',
        'url' => 'https://www.otomotfilo.com.tr',
        'domain' => 'www.otomotfilo.com.tr'
    ]
];

include includePath('header.php');?>

<!-- ─── 1. PAGE HEADER ─────────────────────────────────────────────── -->
<div class="page-header">
    <div class="container">
        <h1><?php e('about.title'); ?></h1>
        <?php include includePath('breadcrumbs.php'); ?>
    </div>
</div>

<!-- ─── 2. KURUMSAL KİMLİK & HİKAYE ─────────────────────────────────── -->
<section class="section section-ivory" data-reveal="fade-up">
    <div class="container">
        <div class="grid grid-2 gap-12 items-center mb-16">
            <!-- Sol: Kurumsal Anlatım -->
            <div>
                <span class="editorial-tag">Kuzey Otomotiv Grubu Güvencesiyle</span>
                <h2 style="font-size: clamp(2rem, 3.2vw, 2.75rem); font-weight: var(--font-weight-normal); margin-top: var(--space-2); margin-bottom: var(--space-6); line-height: 1.25;">
                    Geleceğin Mobilite ve Kurumsal Filo Yönetimi
                </h2>

                <p class="about-intro-lead">
                    Kzy Filo; sektörün en deneyimli otomotiv grup firmalarından olan, marka bayilikleri ve çeşitli diğer alanlarda faaliyet gösteren <strong>Kuzey Otomotiv Grubu</strong> sermayesinin araç kiralama ve mobilite çözümleri üreten bir parçasıdır.
                </p>

                <p class="about-text-p">
                    Bu güçlü, köklü yapının en dinamik ve prestijli hizmet temsilciliğinden olan <strong>Kzy Filo</strong>, yönetim anlayışında müşteri memnuniyetini odak noktasında tutan, fiyatlandırma politikalarında sektörün en uygun alternatifi olmayı hedefleyen ve yenilikçi hizmeti ön planda tutan bir firmadır.
                </p>

                <p class="about-text-p">
                    Kuzey Otomotiv Grubu bünyesinde faaliyet gösteren Kzy Filo araç kiralama şirketi, <strong>İstanbul merkezlidir ve tüm Türkiye’de</strong> genişlemeye devam etmektedir.
                </p>

                <p class="about-text-p">
                    Kzy Filo araç filolarında sunulan çeşitlilik; her tarz, ihtiyaç ve kapasiteye uyum sağlamak üzere kurgulanır. Aynı zamanda bu çeşitlilik fiyatlandırma paritelerine de yansıtılarak, herkes için kaliteli araç kiralama hizmetinin uygun fiyatlar dahilinde sunulması amaçlanır.
                </p>

                <p class="about-text-p" style="margin-bottom: 0;">
                    On yıllardır araç kiralama sektöründe tüketiciler için külfet haline gelen uygulama bütünlüğü; <strong>Kzy Filo'nun özgün çalışma modeliyle</strong> ortadan kalkmıştır. Standart araç kiralama modelleri yerine ihtiyaca ve zamana uygun; model ve istek kapsamında belirlenen paket hizmetleri, sayısız talep için alternatif hale gelmiştir. Bu sayede esnek ve sağlam, modern ve kazançlı, prestijli ve güvenilir bir araç kiralama hizmeti almak Kzy Filo ile hizmet rutinleri arasına girmiştir!
                </p>
            </div>

            <!-- Sağ: Mimari Görsel -->
            <div>
                <div style="border-radius: var(--radius-lg, 8px); overflow: hidden; box-shadow: 0 16px 40px rgba(0,0,0,0.08); border: 1px solid var(--color-border-light);">
                    <img src="<?php echo asset('images/about-hq.jpg'); ?>" alt="Kuzey Otomotiv Grubu & Kzy Filo Genel Merkez" style="width: 100%; height: auto; display: block; object-fit: cover;">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ─── 3. BAŞLICA REFERANSLARIMIZ ──────────────────────────────────── -->
<section class="section section-paper" data-reveal="fade-up">
    <div class="container">
        <div class="section-header text-center" style="max-width: 740px; margin: 0 auto var(--space-12);">
            <span class="editorial-tag">Güvenilir İş Birlikleri</span>
            <h2 style="font-size: clamp(2rem, 3vw, 2.6rem); font-weight: var(--font-weight-normal); margin-top: var(--space-2); margin-bottom: var(--space-3);">
                Başlıca Referanslarımız
            </h2>
            <p style="font-size: 1.05rem; color: var(--color-text-muted); line-height: 1.65;">
                Farklı sektörlerin öncü kurumlarına kesintisiz, güvenilir ve yüksek prestijli kurumsal filo çözümleri sunuyoruz.
            </p>
        </div>

        <div class="reference-grid mb-16">
            <?php foreach ($references as $ref): ?>
                <a href="<?php echo esc($ref['url']); ?>" target="_blank" rel="noopener noreferrer" class="reference-card" data-spotlight>
                    <div class="reference-card-top">
                        <h3 class="reference-name"><?php echo esc($ref['name']); ?></h3>
                        <div class="reference-arrow-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="7" y1="17" x2="17" y2="7"></line>
                                <polyline points="7 7 17 7 17 17"></polyline>
                            </svg>
                        </div>
                    </div>
                    <div class="reference-domain">
                        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="2" y1="12" x2="22" y2="12"></line>
                            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                        </svg>
                        <span><?php echo esc($ref['domain']); ?></span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ─── 4. KURUMSAL CTA BANNER ──────────────────────────────────────── -->
<section class="section-sm" style="padding-top: 0;">
    <div class="container">
        <div class="solution-cta-card" style="background-image: url('<?php echo asset('images/cta-fleet-bg.jpg'); ?>');">
            <h3>Şirketiniz İçin Güvenilir Filo Çözüm Ortağı</h3>
            <p>Kuzey Otomotiv Grubu güvencesiyle binek, ticari veya elektrikli araç filonuzu avantajlı koşullarla hemen yapılandırın.</p>
            <div class="solution-cta-actions">
                <a href="<?php echo url('hizli-teklif.php'); ?>" class="btn btn-primary btn-lg"><?php e('header.get_quote'); ?></a>
                <button type="button" class="btn btn-outline btn-lg" data-open-modal="callback"><?php e('home.cta_call'); ?></button>
            </div>
        </div>
    </div>
</section>

<?php include includePath('footer.php'); ?>
