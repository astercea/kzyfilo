<?php
/**
 * kzyfilo — Admin Hizmet Paketleri Yönetimi (admin/paketler.php)
 */
require_once __DIR__ . '/includes/admin-header.php';
$packages = loadData('packages.php');
?>

<div class="flex flex-between items-center mb-8">
    <div>
        <h1 class="text-2xl fw-bold mb-1">Hizmet Paketleri Yönetimi</h1>
        <p class="text-sm text-muted">Kiralama paketleri, aylık fark tutarları ve dahil özellikler</p>
    </div>
    <button class="btn btn-primary btn-sm" onclick="adminNotice('Yeni paket ekleme modalı tetiklendi')">+ Yeni Paket Ekle</button>
</div>

<div class="grid grid-3 gap-6">
    <?php foreach ($packages as $pkg): ?>
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="text-base fw-bold"><?php echo esc($pkg['name']); ?></h3>
                <?php if (!empty($pkg['is_popular'])): ?>
                    <span class="badge badge-primary">Önerilen</span>
                <?php endif; ?>
            </div>
            <div class="admin-card-body">
                <p class="text-xs text-muted mb-4"><?php echo esc($pkg['description']); ?></p>
                <div class="text-xl fw-bold text-primary mb-4">
                    <?php echo ($pkg['monthly_diff'] === 0) ? 'Standart Bedel' : '+' . number_format($pkg['monthly_diff'], 0, ',', '.') . ' ₺ /ay'; ?>
                </div>
                <ul class="text-xs flex flex-col gap-2 mb-6">
                    <?php foreach ($pkg['features'] as $f): ?>
                        <li class="flex items-center gap-2 <?php echo $f['included'] ? 'text-dark' : 'text-muted'; ?>">
                            <span><?php echo $f['included'] ? '✓' : '✕'; ?></span>
                            <span><?php echo esc($f['name']); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <button class="btn btn-outline btn-sm" style="width: 100%;" onclick="adminNotice('Paket düzenleme formu açıldı')">Paketi Düzenle</button>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php require_once __DIR__ . '/includes/admin-footer.php'; ?>
