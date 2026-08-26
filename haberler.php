<?php
/**
 * kzyfilo — Haberler ve Duyurular (haberler.php)
 */
require_once __DIR__ . '/includes/config.php';

$articlesData = loadData('articles.php');
$allArticles = $articlesData['articles'] ?? [];
$newsItems = array_filter($allArticles, fn($a) => $a['type'] === 'news');

setPageMeta([
    'title' => t('content.news_title') . ' | ' . SITE_NAME,
    'description' => t('content.news_desc'),
    'canonical' => canonical('haberler.php'),
]);

$breadcrumbs = [
    ['title' => t('content.news_title')]
];

include includePath('header.php');?>

<div class="page-header page-header-editorial">
    <div class="container">
        <h1><?php e('content.news_title'); ?></h1>
        <?php include includePath('breadcrumbs.php'); ?>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="grid grid-3 gap-8">
            <?php foreach ($newsItems as $news): ?>
                <article class="content-card">
                    <div class="content-card-image">
                        <img src="<?php echo esc($news['image']); ?>" alt="<?php echo esc($news['title']); ?>" loading="lazy" width="400" height="225">
                    </div>
                    <div class="content-card-body">
                        <div class="content-card-meta">
                            <span class="content-card-type"><?php e('content.news'); ?></span>
                            <span><?php echo date('d.m.Y', strtotime($news['date'])); ?></span>
                        </div>
                        <h4><?php echo esc($news['title']); ?></h4>
                        <p><?php echo esc($news['summary']); ?></p>
                        <a href="<?php echo url('blog-detay.php', ['slug' => $news['slug']]); ?>" class="content-card-link">
                            <span><?php e('content.read_more'); ?></span>
                        </a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php include includePath('footer.php'); ?>
