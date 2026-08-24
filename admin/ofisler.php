<?php
/**
 * kzyfilo — Admin Ofisler ve İade Noktaları Yönetimi (admin/ofisler.php)
 */
require_once __DIR__ . '/includes/admin-header.php';
$locationsData = loadData('locations.php');
$offices = $locationsData['offices'] ?? [];
$returnPoints = $locationsData['return_points'] ?? [];
?>

<div class="flex flex-between items-center mb-8">
    <div>
        <h1 class="text-2xl fw-bold mb-1">Ofisler & Araç İade Noktaları</h1>
        <p class="text-sm text-muted">Bölge müdürlükleri, şubeler ve teslim alma noktaları</p>
    </div>
</div>

<div class="admin-card mb-8">
    <div class="admin-card-header">
        <h3 class="text-base fw-bold">Şubeler ve Bölge Ofisleri</h3>
        <button class="btn btn-primary btn-sm" onclick="adminNotice('Yeni ofis ekleme formu')">+ Yeni Ofis Ekle</button>
    </div>
    <table class="admin-table">
        <thead>
            <tr>
                <th>Ofis Adı</th>
                <th>Şehir / İlçe</th>
                <th>Telefon</th>
                <th>Çalışma Saatleri</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($offices as $ofc): ?>
                <tr>
                    <td><strong><?php echo esc($ofc['name']); ?></strong></td>
                    <td><?php echo esc($ofc['city'] . ' / ' . $ofc['district']); ?></td>
                    <td><?php echo esc($ofc['phone']); ?></td>
                    <td><?php echo esc($ofc['hours']); ?></td>
                    <td><button class="btn btn-secondary btn-sm" onclick="adminNotice('Ofis düzenleme')">Düzenle</button></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="text-base fw-bold">Araç İade ve Ekspertiz Sahaları</h3>
        <button class="btn btn-primary btn-sm" onclick="adminNotice('Yeni iade noktası ekleme')">+ Yeni İade Noktası Ekle</button>
    </div>
    <table class="admin-table">
        <thead>
            <tr>
                <th>Nokta Adı</th>
                <th>Şehir</th>
                <th>Telefon</th>
                <th>Kabul Saatleri</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($returnPoints as $pt): ?>
                <tr>
                    <td><strong><?php echo esc($pt['name']); ?></strong></td>
                    <td><?php echo esc($pt['city']); ?></td>
                    <td><?php echo esc($pt['phone']); ?></td>
                    <td><?php echo esc($pt['hours']); ?></td>
                    <td><button class="btn btn-secondary btn-sm" onclick="adminNotice('İade noktası düzenleme')">Düzenle</button></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/includes/admin-footer.php'; ?>
