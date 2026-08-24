<?php
/**
 * kzyfilo — Blog Detay Sayfası (blog-detay.php)
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

if (!$article) {
    $article = $allArticles[0] ?? null;
}

setPageMeta([
    'title' => ($article['title'] ?? 'Blog') . ' | ' . SITE_NAME,
    'description' => $article['summary'] ?? '',
    'canonical' => canonical('blog-detay.php?slug=' . ($article['slug'] ?? '')),
]);

$breadcrumbs = [
    ['title' => t('content.blog_title'), 'url' => url('blog.php')],
    ['title' => $article['title'] ?? 'Detay']
];

include includePath('header.php');?>

<div class="page-header">
    <div class="container container-narrow">
        <h1><?php echo esc($article['title']); ?></h1>
        <?php include includePath('breadcrumbs.php'); ?>
    </div>
</div>

<article class="section">
    <div class="container container-narrow">
        <div class="mb-6">
            <div class="flex items-center gap-3 text-xs text-muted mb-4">
                <span class="badge badge-primary"><?php echo strtoupper($article['type']); ?></span>
                <span><?php echo date('d F Y', strtotime($article['date'])); ?></span>
                <span>• <?php echo esc($article['read_time']); ?> <?php e('content.min_read'); ?></span>
            </div>
            <p class="text-lg text-muted"><?php echo esc($article['summary']); ?></p>
        </div>

        <div class="card overflow-hidden mb-8">
            <img src="<?php echo esc($article['image']); ?>" alt="<?php echo esc($article['title']); ?>" class="card-img" style="aspect-ratio: 16/9; max-height: 440px;">
        </div>

        <div class="content-body text-base text-dark" style="line-height: 1.8;">
            <p>
                Şirketlerin operasyonel giderleri arasında en önemli paya sahip olan araç filoları, stratejik bir yönetim yaklaşımı ile yönetilmediğinde ciddi maliyet artışlarına yol açabilir. 
                Gerek araç tedarik süreçlerinde doğru modellerin belirlenmesi, gerekse kullanım ömrü boyunca periyodik bakımların zamanında ve yetkili servislerde yapılması filo sağlığı açısından kritik rol oynamaktadır.
            </p>
            <h3 class="text-xl my-6">1. Segment ve İhtiyaç Analizi</h3>
            <p>
                Saha satış ekipleri, teknik servis çalışanları ve şirket yöneticileri için tahsis edilecek araçların kullanım amacı, yıllık katedilecek kilometre ve taşıma kapasitesi gereksinimleri detaylıca analiz edilmelidir. Doğru segment tercihi, yakıt ve kiralama maliyetlerinde doğrudan %20 tasarruf sağlar.
            </p>
            <h3 class="text-xl my-6">2. Telematik ve Dijital Takip Sistemleri</h3>
            <p>
                Araç takip sistemleri yalnızca anlık konum belirlemekle kalmaz; rölanti süreleri, aşırı hız ve agresif sürüş parametrelerini izleyerek hem yakıt tasarrufu sağlar hem de kaza risklerini asgariye indirir.
            </p>
            <h3 class="text-xl my-6">3. Kapsamlı Hizmet Paketleri ile Risk Yönetimi</h3>
            <p>
                Kasko, kış lastiği, ikame araç ve muafiyetsiz mini hasar güvenceleri gibi ek hizmetlerin paket dahilinde temin edilmesi, öngörülemeyen bütçe sapmalarının önüne geçer. kzyfilo Avantaj ve Tam Güvence paketleri, şirketlerin kesintisiz iş akışını garanti altına alır.
            </p>
        </div>

        <div class="flex gap-2 flex-wrap my-8 pt-6" style="border-top: 1px solid var(--color-border-light);">
            <strong class="text-sm mr-2"><?php echo (CURRENT_LANG === 'tr') ? 'Etiketler:' : 'Tags:'; ?></strong>
            <?php foreach ($article['tags'] ?? [] as $tag): ?>
                <span class="badge badge-light"><?php echo esc($tag); ?></span>
            <?php endforeach; ?>
        </div>

        <div class="card card-body p-8 bg-surface-soft text-center mt-12">
            <h3 class="text-xl mb-2">Filonuz İçin Profesyonel Danışmanlık Alın</h3>
            <p class="text-muted text-sm mb-4">Şirketinize en uygun filo modellerini birlikte planlayalım.</p>
            <a href="<?php echo url('hizli-teklif.php'); ?>" class="btn btn-primary"><?php e('header.get_quote'); ?></a>
        </div>
    </div>
</article>

<?php include includePath('footer.php'); ?>
