<?php
/**
 * kzyfilo — Uzun Dönem Araç Kiralama (uzun-donem-arac-kiralama.php)
 * KZY Executive Fleet Solutions
 */
require_once __DIR__ . '/includes/config.php';

$vehicles = loadData('vehicles.php');

setPageMeta([
    'title' => t('solutions_menu.long_term_rental') . ' | ' . SITE_NAME,
    'description' => 'Şirketiniz için 12-48 ay vadeli avantajlı uzun dönem kurumsal araç kiralama, sıfır risk ve tam vergi optimizasyonu.',
    'canonical' => canonical('uzun-donem-arac-kiralama.php'),
]);

$breadcrumbs = [
    ['title' => t('services.title'), 'url' => url('hizmetler.php')],
    ['title' => t('solutions_menu.long_term_rental')]
];

include includePath('header.php');?>

<!-- ─── 1. PAGE HEADER ─────────────────────────────────────────────── -->
<div class="page-header">
    <div class="container">
        <h1><?php e('solutions_menu.long_term_rental'); ?></h1>
        <?php include includePath('breadcrumbs.php'); ?>
    </div>
</div>

<!-- ─── 2. STRATEJİK AVANTAJLAR (SPOTLIGHT MİMARİ GRİD) ─────────────── -->
<section class="section section-ivory" data-reveal="fade-up">
    <div class="container">
        <div class="section-header text-center" style="max-width: 760px; margin: 0 auto var(--space-12);">
            <span class="editorial-tag">Finansal & Operasyonel Güvence</span>
            <h2 style="font-size: clamp(2.2rem, 3.5vw, 3rem); font-weight: var(--font-weight-normal); margin-top: var(--space-2); margin-bottom: var(--space-3);">
                Neden Uzun Dönem Filo Kiralama?
            </h2>
            <p style="font-size: 1.05rem; color: var(--color-text-muted); line-height: 1.65;">
                Şirket sermayenizi araç satın almaya bağlamadan, sabit aylık giderler, tam vergi avantajı ve sıfır operasyonel risk ile filonuzu yönetin.
            </p>
        </div>

        <div class="solution-benefit-grid mb-16">
            <!-- 1. Likidite -->
            <div class="solution-benefit-card" data-spotlight>
                <div class="solution-icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="1" x2="12" y2="23"></line>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                </div>
                <h3>Sermaye & Nakit Akışı Koruma</h3>
                <p>Yüksek peşinatlar ve banka kredi limitlerinizi tüketmeden filonuzu yenileyin, özkaynaklarınızı doğrudan ana faaliyetlerinize yönlendirin.</p>
            </div>

            <!-- 2. Vergi Avantajı -->
            <div class="solution-benefit-card" data-spotlight>
                <div class="solution-icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                </div>
                <h3>Tam Vergi & KDV İndirimi</h3>
                <p>Aylık kiralama faturalarınızı mevzuat sınırları dahilinde doğrudan gider kaydedin ve KDV indiriminden maksimum oranda yararlanın.</p>
            </div>

            <!-- 3. Bakım & Hasar -->
            <div class="solution-benefit-card" data-spotlight>
                <div class="solution-icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
                    </svg>
                </div>
                <h3>Sıfır Bakım & Hasar Sürprizi</h3>
                <p>Periyodik yetkili servis bakımları, kasko, trafik sigortası ve lastik değişim masrafları aylık kiranıza dahildir; beklenmedik masraflara son verin.</p>
            </div>

            <!-- 4. İkame Araç -->
            <div class="solution-benefit-card" data-spotlight>
                <div class="solution-icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2"></path>
                        <circle cx="7" cy="17" r="2"></circle>
                        <path d="M9 17h6"></path>
                        <circle cx="17" cy="17" r="2"></circle>
                    </svg>
                </div>
                <h3>Kesintisiz İkame Araç Desteği</h3>
                <p>Aracınız bakım veya hasar onarımındayken işlerinizin aksamaması için aynı segmentte yedek araç 24-48 saat içinde hızla tahsis edilir.</p>
            </div>

            <!-- 5. 2. El Riski Yok -->
            <div class="solution-benefit-card" data-spotlight>
                <div class="solution-icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                        <polyline points="17 6 23 6 23 12"></polyline>
                    </svg>
                </div>
                <h3>2. El Değer Kaybı Riski Sıfır</h3>
                <p>Kiralama süresi sonunda aracın ikinci el piyasa değer düşüşü, satılamama riski ve devir prosedürleri tamamen kzyfilo güvencesindedir.</p>
            </div>

            <!-- 6. Zaman Tasarrufu -->
            <div class="solution-benefit-card" data-spotlight>
                <div class="solution-icon-wrap">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                </div>
                <h3>Zaman & Operasyonel Verimlilik</h3>
                <p>MTV takipleri, muayene randevuları ve plaka tescil gibi zaman alıcı bürokratik işleri uzman danışmanlarımız yönetir.</p>
            </div>
        </div>
    </div>
</section>

<!-- ─── 3. SATIN ALMA VS. UZUN DÖNEM KİRALAMA MATRİSİ ───────────────── -->
<section class="section section-paper" data-reveal="fade-up">
    <div class="container">
        <div class="section-header text-center" style="max-width: 720px; margin: 0 auto var(--space-10);">
            <span class="editorial-tag">Finansal Karşılaştırma</span>
            <h2 style="font-size: clamp(2rem, 3vw, 2.6rem); font-weight: var(--font-weight-normal); margin-top: var(--space-2);">
                Satın Alma vs. Uzun Dönem Kiralama
            </h2>
        </div>

        <div class="comparison-matrix-wrap mb-12">
            <table class="comparison-matrix-table">
                <thead>
                    <tr>
                        <th style="width: 34%;">Karşılaştırma Kriteri</th>
                        <th style="width: 33%;">Özkaynak / Kredi ile Satın Alma</th>
                        <th class="col-highlight" style="width: 33%;">kzyfilo Uzun Dönem Kiralama</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Sermaye & Peşinat</strong></td>
                        <td><span class="matrix-con">✗</span> Yüksek nakit çıkışı veya kredi limiti bloke olur</td>
                        <td class="col-highlight"><span class="matrix-pro">✓</span> Sıfır peşinat, sermaye ana işinizde kalır</td>
                    </tr>
                    <tr>
                        <td><strong>Vergi & Gider Avantajı</strong></td>
                        <td><span class="matrix-con">✗</span> Sınırlı amortisman ve KDV indirim kısıtları</td>
                        <td class="col-highlight"><span class="matrix-pro">✓</span> Aylık kiranın tamamı doğrudan gider yazılır</td>
                    </tr>
                    <tr>
                        <td><strong>Bakım, Lastik & Sigortalar</strong></td>
                        <td><span class="matrix-con">✗</span> Tüm yetkili servis ve kasko faturaları şirkete aittir</td>
                        <td class="col-highlight"><span class="matrix-pro">✓</span> Kasko, sigorta, periyodik bakım ve lastik fiyata dahil</td>
                    </tr>
                    <tr>
                        <td><strong>Arıza Anında İkame Araç</strong></td>
                        <td><span class="matrix-con">✗</span> Sigorta şirketinin kısıtlı süreli ikame aracı</td>
                        <td class="col-highlight"><span class="matrix-pro">✓</span> Sözleşme boyunca eşdeğer kesintisiz ikame araç</td>
                    </tr>
                    <tr>
                        <td><strong>2. El Değer Kaybı & Satış</strong></td>
                        <td><span class="matrix-con">✗</span> Piyasa dalgalanmaları ve ikinci el satış zahmeti</td>
                        <td class="col-highlight"><span class="matrix-pro">✓</span> Süre sonunda araç teslim edilir, yeni model seçilir</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- ─── 4. POPÜLER FİLO MODELLERİ ───────────────────────────────────── -->
<section class="section section-ivory" data-reveal="fade-up">
    <div class="container">
        <div class="flex flex-between mb-8 flex-wrap gap-4 items-center">
            <div>
                <span class="editorial-tag">Filo Portföyü</span>
                <h2 style="font-size: clamp(1.8rem, 2.5vw, 2.4rem); font-weight: var(--font-weight-normal); margin-top: var(--space-1);">
                    Uzun Dönem İçin Popüler Araçlar
                </h2>
            </div>
            <a href="<?php echo url('araclar.php'); ?>" class="btn btn-dark btn-sm">
                <span><?php e('btn.view_all'); ?></span>
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </a>
        </div>

        <div class="catalog-grid mb-12">
            <?php foreach (array_slice($vehicles, 0, 3) as $vehicle): ?>
                <?php include includePath('vehicle-card.php'); ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- ─── 6. KURUMSAL CTA BANNER ──────────────────────────────────────── -->
<section class="section-sm" style="padding-top: 0;">
    <div class="container">
        <div class="solution-cta-card">
            <h3>Filonuzu Uzun Dönem Kiralamayla Hemen Büyütün</h3>
            <p>Şirketinizin ihtiyaç duyduğu binek, ticari veya hibrit araçları en avantajlı kurumsal şartlarla hemen kiralayın.</p>
            <div class="solution-cta-actions">
                <a href="<?php echo url('hizli-teklif.php'); ?>" class="btn btn-primary btn-lg"><?php e('header.get_quote'); ?></a>
                <button type="button" class="btn btn-outline btn-lg" data-open-modal="callback"><?php e('home.cta_call'); ?></button>
            </div>
        </div>
    </div>
</section>

<?php include includePath('footer.php'); ?>
