<?php
/**
 * kzyfilo — Admin Blog Yönetimi (admin/blog.php)
 */
require_once __DIR__ . '/includes/admin-header.php';
$articlesData = loadData('articles.php');
$articles = $articlesData['articles'] ?? [];
$blogPosts = array_filter($articles, fn($a) => $a['type'] === 'blog');
?>

<div class="flex flex-between items-center mb-8">
    <div>
        <h1 class="text-2xl fw-bold mb-1">Blog Makaleleri Yönetimi</h1>
        <p class="text-sm text-muted">Filo yönetimi, vergi avantajları ve sektörel blog yazıları</p>
    </div>
    <button class="btn btn-primary btn-sm" onclick="adminNotice('Yeni blog yazısı ekleme modalı açıldı')">+ Yeni Blog Yazısı Ekle</button>
</div>

<div class="admin-card">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Görsel</th>
                <th>Başlık</th>
                <th>Tarih</th>
                <th>Okuma Süresi</th>
                <th>Etiketler</th>
                <th>Durum</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($blogPosts as $post): ?>
                <tr>
                    <td style="width: 70px;">
                        <img src="<?php echo esc($post['image']); ?>" alt="<?php echo esc($post['title']); ?>" width="60" height="38" style="border-radius: 4px; object-fit: cover;">
                    </td>
                    <td>
                        <strong><?php echo esc($post['title']); ?></strong>
                        <div class="text-xs text-muted"><?php echo esc($post['slug']); ?></div>
                    </td>
                    <td><?php echo date('d.m.Y', strtotime($post['date'])); ?></td>
                    <td><?php echo esc($post['read_time']); ?> dk</td>
                    <td>
                        <?php foreach ($post['tags'] ?? [] as $tg): ?>
                            <span class="badge badge-light text-xs"><?php echo esc($tg); ?></span>
                        <?php endforeach; ?>
                    </td>
                    <td><span class="status-badge status-approved">Yayında</span></td>
                    <td>
                        <div class="flex gap-2">
                            <button class="btn btn-secondary btn-sm" style="padding: 4px 8px; font-size: 12px;" onclick="adminNotice('Blog düzenleme')">Düzenle</button>
                            <button class="btn btn-ghost btn-sm text-error" style="padding: 4px 8px; font-size: 12px;" onclick="adminNotice('Blog yazısı silindi')">Sil</button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/includes/admin-footer.php'; ?>
