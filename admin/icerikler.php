<?php
/**
 * kzyfilo — Admin İçerik Yönetimi (admin/icerikler.php)
 */
require_once __DIR__ . '/includes/admin-header.php';
$articlesData = loadData('articles.php');
$articles = $articlesData['articles'] ?? [];
?>

<div class="flex flex-between items-center mb-8">
    <div>
        <h1 class="text-2xl fw-bold mb-1">Blog ve Haber İçerikleri</h1>
        <p class="text-sm text-muted">Web sitesinde yayınlanan makaleler, kurumsal haberler ve duyurular</p>
    </div>
    <button class="btn btn-primary btn-sm" onclick="adminNotice('Yeni yazı ekleme modalı açıldı')">+ Yeni İçerik Ekle</button>
</div>

<div class="admin-card">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Tür</th>
                <th>Başlık</th>
                <th>Tarih</th>
                <th>Okuma Süresi</th>
                <th>Durum</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $art): ?>
                <tr>
                    <td><span class="badge badge-light"><?php echo strtoupper($art['type']); ?></span></td>
                    <td><strong><?php echo esc($art['title']); ?></strong></td>
                    <td><?php echo date('d.m.Y', strtotime($art['date'])); ?></td>
                    <td><?php echo esc($art['read_time']); ?> dk</td>
                    <td><span class="status-badge status-approved">Yayında</span></td>
                    <td>
                        <div class="flex gap-2">
                            <button class="btn btn-secondary btn-sm" onclick="adminNotice('İçerik düzenleme formu açıldı')">Düzenle</button>
                            <button class="btn btn-ghost btn-sm text-error" onclick="adminNotice('İçerik silindi')">Sil</button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/includes/admin-footer.php'; ?>
