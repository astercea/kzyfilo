<?php
/**
 * kzyfilo — Blog & Haber Detay Sayfası (blog-detay.php)
 * High-End Luxury Editorial Reading Experience
 */
require_once __DIR__ . '/includes/config.php';

$articlesData = loadData('articles.php');
$allArticles = $articlesData['articles'] ?? [];

$slug = $_GET['slug'] ?? '';
$article = null;

foreach ($allArticles as $a) {
    if ($a['slug'] === $slug) {
        $article = $a;
        break;
    }
}

if (!$article && !empty($allArticles)) {
    $article = $allArticles[0];
}

$isNews = ($article['type'] ?? '') === 'news';
$parentTitle = $isNews ? t('content.news_title') : t('content.blog_title');
$parentUrl = $isNews ? url('haberler.php') : url('blog.php');

setPageMeta([
    'title' => ($article['title'] ?? 'Blog') . ' | ' . SITE_NAME,
    'description' => $article['summary'] ?? '',
    'canonical' => canonical('blog-detay.php?slug=' . ($article['slug'] ?? '')),
]);

$breadcrumbs = [
    ['title' => $parentTitle, 'url' => $parentUrl],
    ['title' => $article['title'] ?? 'Detay']
];

include includePath('header.php');?>

<!-- ─── 1. PAGE HEADER ─────────────────────────────────────────────── -->
<div class="page-header page-header-editorial">
    <div class="container">
        <h1><?php echo esc($article['title']); ?></h1>
        <?php include includePath('breadcrumbs.php'); ?>
    </div>
</div>

<!-- ─── 2. HIGH-END EDITORIAL ARTICLE CONTENT ────────────────────────── -->
<article class="section section-ivory" style="padding-top: var(--space-12); padding-bottom: var(--space-20);">
    <div class="container" style="max-width: 860px; margin: 0 auto;">
        
        <!-- Üst Editoryal Meta Satırı -->
        <div class="flex items-center justify-between flex-wrap gap-4 pb-6 mb-8" style="border-bottom: 1px solid rgba(0, 0, 0, 0.08);">
            <div class="flex items-center gap-3 text-xs uppercase" style="letter-spacing: 0.1em; color: var(--color-text-muted);">
                <span style="color: var(--color-orange); font-weight: 700;">
                    <?php echo $isNews ? 'Haber & Duyuru' : 'Filo Yönetimi'; ?>
                </span>
                <span>•</span>
                <span><?php echo date('d.m.Y', strtotime($article['date'])); ?></span>
                <span>•</span>
                <span><?php echo esc($article['read_time']); ?> Dakika Okuma</span>
            </div>
            <div class="text-xs text-muted" style="letter-spacing: 0.05em;">
                Kzy Filo Kurumsal Danışmanlığı
            </div>
        </div>

        <!-- Öne Çıkan Ana Görsel (En Üstte Geniş & Şık Yerleşim) -->
        <?php if (!empty($article['image'])): ?>
        <figure style="margin: 0 0 var(--space-10) 0;">
            <div style="border-radius: var(--radius-lg, 8px); overflow: hidden; box-shadow: 0 12px 36px rgba(0, 0, 0, 0.05); background-color: #f7f6f2;">
                <img src="<?php echo esc($article['image']); ?>" alt="<?php echo esc($article['title']); ?>" style="width: 100%; height: auto; max-height: 480px; display: block; object-fit: cover;">
            </div>
        </figure>
        <?php endif; ?>

        <!-- Vurgulu Editoryal Giriş Paragrafı -->
        <div class="mb-10" style="font-size: 1.3rem; font-weight: 500; line-height: 1.75; color: #121822; letter-spacing: -0.01em;">
            <?php echo esc($article['summary']); ?>
        </div>

        <!-- Akıcı Metin Gövdesi -->
        <div class="article-pure-content" style="font-size: 1.15rem; line-height: 1.95; color: #283342;">
            <p style="margin-bottom: var(--space-8);">
                Şirketlerin operasyonel giderleri arasında en önemli paya sahip olan araç filoları, stratejik bir yönetim yaklaşımı ile kurgulanmadığında ciddi maliyet artışlarına ve sermaye kayıplarına yol açabilir. 
                Gerek araç tedarik süreçlerinde doğru modellerin belirlenmesi, gerekse kullanım ömrü boyunca periyodik bakımların zamanında ve yetkili servislerde yapılması filo sağlığı açısından kritik rol oynamaktadır.
            </p>

            <!-- Zarif Alıntı / Vurgu Satırı -->
            <div style="margin: var(--space-10) 0; padding: var(--space-6) var(--space-8); border-left: 3px solid var(--color-orange); background: linear-gradient(90deg, rgba(241, 90, 36, 0.03) 0%, transparent 100%);">
                <p style="font-size: 1.25rem; font-style: italic; color: #121822; line-height: 1.65; margin: 0; font-weight: 500;">
                    "Doğru segment tercihi ve profesyonel filo yönetimi, şirketlerin ana sermayelerini korurken operasyonel verimliliği %30'a varan oranda artırır."
                </p>
            </div>

            <!-- Bölüm 1 -->
            <h2 style="font-size: 1.55rem; font-weight: 700; color: #121822; margin-top: var(--space-12); margin-bottom: var(--space-4); font-family: var(--font-display, inherit); display: flex; align-items: baseline; gap: 10px;">
                <span style="color: var(--color-orange); font-size: 1.1rem; font-weight: 800; font-family: var(--font-display);">01.</span>
                <span>Segment ve İhtiyaç Analizi</span>
            </h2>
            <p style="margin-bottom: var(--space-8);">
                Saha satış ekipleri, teknik servis çalışanları ve şirket yöneticileri için tahsis edilecek araçların kullanım amacı, yıllık katedilecek kilometre ve taşıma kapasitesi gereksinimleri detaylıca analiz edilmelidir. Doğru segment tercihi, yakıt ve kiralama maliyetlerinde doğrudan %20 tasarruf sağlar.
            </p>

            <!-- Bölüm 2 -->
            <h2 style="font-size: 1.55rem; font-weight: 700; color: #121822; margin-top: var(--space-12); margin-bottom: var(--space-4); font-family: var(--font-display, inherit); display: flex; align-items: baseline; gap: 10px;">
                <span style="color: var(--color-orange); font-size: 1.1rem; font-weight: 800; font-family: var(--font-display);">02.</span>
                <span>Telematik ve Dijital Takip Sistemleri</span>
            </h2>
            <p style="margin-bottom: var(--space-8);">
                Araç takip sistemleri yalnızca anlık konum belirlemekle kalmaz; rölanti süreleri, aşırı hız ve agresif sürüş parametrelerini izleyerek hem yakıt tüketimini optimize eder hem de kaza risklerini asgariye indirir. Telematik verileri ışığında sürücü alışkanlıklarının iyileştirilmesi, filo işletme giderlerinde yıllık bazda büyük fark yaratır.
            </p>

            <!-- Bölüm 3 -->
            <h2 style="font-size: 1.55rem; font-weight: 700; color: #121822; margin-top: var(--space-12); margin-bottom: var(--space-4); font-family: var(--font-display, inherit); display: flex; align-items: baseline; gap: 10px;">
                <span style="color: var(--color-orange); font-size: 1.1rem; font-weight: 800; font-family: var(--font-display);">03.</span>
                <span>Kapsamlı Hizmet Paketleri ile Kesintisiz Mobilite</span>
            </h2>
            <p style="margin-bottom: var(--space-8);">
                Kasko, kış lastiği, muadil ikame araç temini ve yetkili servis güvenceleri gibi ek hizmetlerin paket dahilinde temin edilmesi, öngörülemeyen bütçe sapmalarının önüne geçer. <strong>Kzy Filo Avantaj ve Tam Güvence</strong> paketleri, şirketinizin iş akışını 7/24 kesintisiz korur.
            </p>
        </div>

        <!-- Sayfa Sonu Dönüş Butonu -->
        <div style="margin-top: var(--space-16); padding-top: var(--space-8); border-top: 1px solid rgba(0, 0, 0, 0.08); text-align: center;">
            <a href="<?php echo esc($parentUrl); ?>" class="btn btn-outline" style="padding: 12px 32px; font-weight: 600;">
                <?php echo esc($parentTitle); ?> Sayfasına Dön
            </a>
        </div>
    </div>
</article>

<?php include includePath('footer.php'); ?>
