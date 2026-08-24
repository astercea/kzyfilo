<?php
/**
 * kzyfilo — Admin Araç Yönetimi Listesi (admin/araclar.php)
 */
require_once __DIR__ . '/includes/admin-header.php';
$vehicles = loadData('vehicles.php');
?>

<div class="flex flex-between items-center mb-8">
    <div>
        <h1 class="text-2xl fw-bold mb-1">Araç Kataloğu Yönetimi</h1>
        <p class="text-sm text-muted">Filoda listelenen aktif araç modelleri ve yayın durumları</p>
    </div>
    <a href="arac-form.php" class="btn btn-primary btn-sm">+ Yeni Araç Ekle</a>
</div>

<div class="admin-card">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Görsel</th>
                <th>Marka / Model / Versiyon</th>
                <th>Kategori</th>
                <th>Yakıt / Vites</th>
                <th>Başlangıç Fiyatı</th>
                <th>Etiketler</th>
                <th>Durum</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vehicles as $v): ?>
                <tr>
                    <td style="width: 70px;">
                        <img src="<?php echo esc($v['image']); ?>" alt="<?php echo esc($v['brand']); ?>" width="60" height="38" style="border-radius: 4px; object-fit: cover;">
                    </td>
                    <td>
                        <div class="fw-bold text-dark"><?php echo esc($v['brand'] . ' ' . $v['model']); ?></div>
                        <div class="text-xs text-muted"><?php echo esc($v['version']); ?></div>
                    </td>
                    <td><span class="badge badge-light"><?php echo strtoupper($v['category']); ?></span></td>
                    <td><?php echo ucfirst($v['fuel']); ?> / <?php echo ucfirst($v['transmission']); ?></td>
                    <td class="fw-bold text-primary"><?php echo number_format($v['starting_price'], 0, ',', '.'); ?> ₺</td>
                    <td>
                        <?php if (!empty($v['is_campaign'])): ?><span class="badge badge-primary" style="font-size: 10px;">Kampanya</span><?php endif; ?>
                        <?php if (!empty($v['is_fast_delivery'])): ?><span class="badge badge-success" style="font-size: 10px;">Hızlı Teslim</span><?php endif; ?>
                        <?php if (!empty($v['is_premium'])): ?><span class="badge badge-info" style="font-size: 10px;">Premium</span><?php endif; ?>
                    </td>
                    <td><span class="status-badge status-approved">Yayında</span></td>
                    <td>
                        <div class="flex gap-2">
                            <a href="arac-form.php?id=<?php echo esc($v['id']); ?>" class="btn btn-secondary btn-sm" style="padding: 4px 8px; font-size: 12px;">Düzenle</a>
                            <button type="button" class="btn btn-ghost btn-sm text-error" style="padding: 4px 8px; font-size: 12px;" onclick="adminNotice('Araç silme işlemi tetiklendi')">Sil</button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/includes/admin-footer.php'; ?>
