<?php
/**
 * kzyfilo — Dinamik Breadcrumb Bileşeni
 * 
 * Beklenen Değişken: $breadcrumbs (Array)
 * Format: [
 *    ['title' => 'Sayfa 1', 'url' => url('sayfa.php')],
 *    ['title' => 'Aktif Sayfa']
 * ]
 */
if (!defined('ROOT_DIR')) {
    require_once __DIR__ . '/config.php';
}

if (!isset($breadcrumbs) || !is_array($breadcrumbs) || empty($breadcrumbs)) {
    return;
}
?>
<nav class="breadcrumb-wrapper" aria-label="<?php e('breadcrumb.home'); ?>">
    <div class="container">
        <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
            <!-- Home Link -->
            <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a href="<?php echo url('index.php'); ?>" itemprop="item">
                    <span itemprop="name"><?php e('breadcrumb.home'); ?></span>
                </a>
                <meta itemprop="position" content="1">
            </li>

            <?php $pos = 2; foreach ($breadcrumbs as $item): ?>
                <li class="breadcrumb-separator" aria-hidden="true">/</li>
                <li class="breadcrumb-item<?php echo empty($item['url']) ? ' active' : ''; ?>" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <?php if (!empty($item['url'])): ?>
                        <a href="<?php echo esc($item['url']); ?>" itemprop="item">
                            <span itemprop="name"><?php echo esc($item['title']); ?></span>
                        </a>
                    <?php else: ?>
                        <span itemprop="name" aria-current="page"><?php echo esc($item['title']); ?></span>
                    <?php endif; ?>
                    <meta itemprop="position" content="<?php echo $pos++; ?>">
                </li>
            <?php endforeach; ?>
        </ol>
    </div>
</nav>
