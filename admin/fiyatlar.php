<?php
/**
 * kzyfilo — Admin Fiyat Kombinasyonları (admin/fiyatlar.php)
 */
require_once __DIR__ . '/includes/admin-header.php';
$vehicles = loadData('vehicles.php');
?>

<div class="flex flex-between items-center mb-8">
    <div>
        <h1 class="text-2xl fw-bold mb-1">Fiyat Kombinasyonları ve Matrisler</h1>
        <p class="text-sm text-muted">Araç, kiralama süresi (ay) ve yıllık km bazında kiralama bedelleri</p>
    </div>
    <button class="btn btn-primary btn-sm" onclick="adminNotice('Toplu fiyat güncelleme aracı tetiklendi')">Toplu Fiyat Güncelle</button>
</div>

<div class="admin-card">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Araç Modeli</th>
                <th>24 Ay / 15.000 km</th>
                <th>36 Ay / 15.000 km</th>
                <th>48 Ay / 15.000 km</th>
                <th>24 Ay / 20.000 km</th>
                <th>36 Ay / 20.000 km</th>
                <th>48 Ay / 20.000 km</th>
                <th>İşlem</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vehicles as $v): ?>
                <tr>
                    <td><strong><?php echo esc($v['brand'] . ' ' . $v['model']); ?></strong></td>
                    <td><?php echo number_format($v['prices']['24']['15']['basic'] ?? $v['starting_price'] * 1.15, 0, ',', '.'); ?> ₺</td>
                    <td><?php echo number_format($v['prices']['36']['15']['basic'] ?? $v['starting_price'] * 1.05, 0, ',', '.'); ?> ₺</td>
                    <td class="text-primary fw-bold"><?php echo number_format($v['starting_price'], 0, ',', '.'); ?> ₺</td>
                    <td><?php echo number_format($v['prices']['24']['20']['basic'] ?? $v['starting_price'] * 1.25, 0, ',', '.'); ?> ₺</td>
                    <td><?php echo number_format($v['prices']['36']['20']['basic'] ?? $v['starting_price'] * 1.12, 0, ',', '.'); ?> ₺</td>
                    <td><?php echo number_format($v['prices']['48']['20']['basic'] ?? $v['starting_price'] * 1.08, 0, ',', '.'); ?> ₺</td>
                    <td><button class="btn btn-secondary btn-sm" onclick="adminNotice('Fiyat matrisi düzenleme')">Düzenle</button></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/includes/admin-footer.php'; ?>
