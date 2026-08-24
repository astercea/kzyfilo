<?php
/**
 * kzyfilo — Blog Listesi (blog.php)
 */
require_once __DIR__ . '/includes/config.php';

$articlesData = loadData('articles.php');
$allArticles = $articlesData['articles'] ?? [];
$blogPosts = array_filter($allArticles, fn($a) => $a['type'] === 'blog');

setPageMeta([
    'title' => t('content.blog_title') . ' | ' . SITE_NAME,
    'description' => t('content.blog_desc'),
    'canonical' => canonical('blog.php'),
]);

$breadcrumbs = [
    ['title' => t('content.blog_title')]
];

include includePath('header.php');?>

<div class="page-header">
    <div class="container">
        <h1><?php e('content.blog_title'); ?></h1>
        <?php include includePath('breadcrumbs.php'); ?>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="grid grid-3 gap-8">
            <?php foreach ($blogPosts as $post): ?>
                <article class="content-card">
                    <div class="content-card-image">
                        <a href="<?php echo url('blog-detay.php', ['slug' => $post['slug']]); ?>">
                            <img src="<?php echo esc($post['image']); ?>" alt="<?php echo esc($post['title']); ?>" loading="lazy" width="400" height="225">
                        </a>
                    </div>
                    <div class="content-card-body">
                        <div class="content-card-meta">
                            <span class="content-card-type">BLOG</span>
                            <span><?php echo date('d.m.Y', strtotime($post['date'])); ?></span>
                            <span>• <?php echo esc($post['read_time']); ?> <?php e('content.min_read'); ?></span>
                        </div>
                        <h4>
                            <a href="<?php echo url('blog-detay.php', ['slug' => $post['slug']]); ?>">
                                <?php echo esc($post['title']); ?>
                            </a>
                        </h4>
                        <p><?php echo esc($post['summary']); ?></p>
                        <a href="<?php echo url('blog-detay.php', ['slug' => $post['slug']]); ?>" class="content-card-link">
                            <span><?php e('content.read_more'); ?></span> →
                        </a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php include includePath('footer.php'); ?>
