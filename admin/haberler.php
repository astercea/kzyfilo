<?php
/**
 * kzyfilo — Admin Haber ve Duyuru Yönetimi (admin/haberler.php)
 */
require_once __DIR__ . '/includes/admin-header.php';
$articlesData = loadData('articles.php');
$articles = $articlesData['articles'] ?? [];
$newsItems = array_filter($articles, fn($a) => $a['type'] === 'news');
?>

<div class="flex flex-between items-center mb-8">
    <div>
        <h1 class="text-2xl fw-bold mb-1">Kurumsal Haberler ve Duyurular</h1>
        <p class="text-sm text-muted">Şirket haberleri, filo genişleme duyuruları ve basın bültenleri</p>
    </div>
    <button class="btn btn-primary btn-sm" onclick="adminNotice('Yeni haber ekleme modalı açıldı')">+ Yeni Haber Ekle</button>
</div>

<div class="admin-card">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Görsel</th>
                <th>Başlık</th>
                <th>Tarih</th>
                <th>Özet</th>
                <th>Durum</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($newsItems as $news): ?>
                <tr>
                    <td style="width: 70px;">
                        <img src="<?php echo esc($news['image']); ?>" alt="<?php echo esc($news['title']); ?>" width="60" height="38" style="border-radius: 4px; object-fit: cover;">
                    </td>
                    <td><strong><?php echo esc($news['title']); ?></strong></td>
                    <td><?php echo date('d.m.Y', strtotime($news['date'])); ?></td>
                    <td class="text-xs text-muted"><?php echo mb_substr($news['summary'], 0, 80) . '...'; ?></td>
                    <td><span class="status-badge status-approved">Yayında</span></td>
                    <td>
                        <div class="flex gap-2">
                            <button class="btn btn-secondary btn-sm" style="padding: 4px 8px; font-size: 12px;" onclick="adminNotice('Haber düzenleme')">Düzenle</button>
                            <button class="btn btn-ghost btn-sm text-error" style="padding: 4px 8px; font-size: 12px;" onclick="adminNotice('Haber silindi')">Sil</button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/includes/admin-footer.php'; ?>
