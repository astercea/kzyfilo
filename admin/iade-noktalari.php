<?php
/**
 * kzyfilo — Admin Araç İade Noktaları Yönetimi (admin/iade-noktalari.php)
 */
require_once __DIR__ . '/includes/admin-header.php';
$locationsData = loadData('locations.php');
$returnPoints = $locationsData['return_points'] ?? [];
?>

<div class="flex flex-between items-center mb-8">
    <div>
        <h1 class="text-2xl fw-bold mb-1">Araç İade ve Teslimat Noktaları</h1>
        <p class="text-sm text-muted">Sözleşme sonu ekspertiz ve iade kabul merkezleri yönetimi</p>
    </div>
    <button class="btn btn-primary btn-sm" onclick="adminNotice('Yeni iade noktası ekleme')">+ Yeni İade Noktası Ekle</button>
</div>

<div class="admin-card">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Nokta Adı</th>
                <th>Şehir / Bölge</th>
                <th>İletişim Telefonu</th>
                <th>Kabul Saatleri</th>
                <th>Ekspertiz Durumu</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($returnPoints as $pt): ?>
                <tr>
                    <td><strong><?php echo esc($pt['name']); ?></strong></td>
                    <td><?php echo esc($pt['city'] . ' / ' . ($pt['district'] ?? '')); ?></td>
                    <td><?php echo esc($pt['phone']); ?></td>
                    <td><?php echo esc($pt['hours']); ?></td>
                    <td><span class="badge badge-success">Uzman Personel Aktif</span></td>
                    <td>
                        <div class="flex gap-2">
                            <button class="btn btn-secondary btn-sm" onclick="adminNotice('İade noktası düzenleme')">Düzenle</button>
                            <button class="btn btn-ghost btn-sm text-error" onclick="adminNotice('İade noktası silindi')">Sil</button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/includes/admin-footer.php'; ?>
