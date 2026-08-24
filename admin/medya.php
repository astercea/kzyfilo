<?php
/**
 * kzyfilo — Admin Medya Kütüphanesi (admin/medya.php)
 */
require_once __DIR__ . '/includes/admin-header.php';
?>

<div class="flex flex-between items-center mb-8">
    <div>
        <h1 class="text-2xl fw-bold mb-1">Medya ve Görsel Kütüphanesi</h1>
        <p class="text-sm text-muted">Araç fotoğrafları, logolar ve kurumsal içerik görselleri</p>
    </div>
    <button class="btn btn-primary btn-sm" onclick="adminNotice('Dosya yükleme penceresi açıldı')">+ Yeni Medya Yükle</button>
</div>

<!-- Yükleme Alanı Dropzone (Demo) -->
<div class="admin-card mb-8">
    <div class="admin-card-body text-center py-12" style="border: 2px dashed var(--admin-border); border-radius: 8px; cursor: pointer;" onclick="adminNotice('Dosya seçimi tetiklendi')">
        <div style="font-size: 36px; margin-bottom: 8px;">📁</div>
        <h3 class="text-base fw-bold mb-1">Görselleri buraya sürükleyin veya dosya seçin</h3>
        <p class="text-xs text-muted mb-0">PNG, JPG, SVG, WebP formatları desteklenmektedir (Maksimum 5 MB / Demo)</p>
    </div>
</div>

<!-- Görsel Grid -->
<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="text-base fw-bold">Yüklü Görseller</h3>
    </div>
    <div class="admin-card-body">
        <div class="grid grid-4 gap-6">
            <div class="card p-3 text-center">
                <img src="<?php echo asset('images/vehicles/placeholder.svg'); ?>" alt="Araç Görseli" width="200" height="120" style="border-radius: 6px; margin-bottom: 8px; object-fit: contain;">
                <div class="text-xs fw-bold text-dark mb-1">placeholder.svg</div>
                <div class="text-xs text-muted">800x500 • 12 KB</div>
            </div>
            <div class="card p-3 text-center">
                <img src="<?php echo asset('images/logo/kzy-filo-logo.svg'); ?>" alt="KZY Logo" width="200" height="120" style="border-radius: 6px; margin-bottom: 8px; object-fit: contain;">
                <div class="text-xs fw-bold text-dark mb-1">kzy-filo-logo.svg</div>
                <div class="text-xs text-muted">240x68 • 4 KB</div>
            </div>
            <div class="card p-3 text-center" style="background-color: #1e293b;">
                <img src="<?php echo asset('images/logo/kzy-filo-logo-white.svg'); ?>" alt="KZY Logo White" width="200" height="120" style="border-radius: 6px; margin-bottom: 8px; object-fit: contain;">
                <div class="text-xs fw-bold text-light mb-1" style="color: #ffffff;">kzy-filo-logo-white.svg</div>
                <div class="text-xs" style="color: #94a3b8;">240x68 • 4 KB</div>
            </div>
            <div class="card p-3 text-center">
                <img src="<?php echo asset('images/logo/kzy-star.svg'); ?>" alt="KZY Star" width="200" height="120" style="border-radius: 6px; margin-bottom: 8px; object-fit: contain;">
                <div class="text-xs fw-bold text-dark mb-1">kzy-star.svg</div>
                <div class="text-xs text-muted">100x90 • 2 KB</div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/includes/admin-footer.php'; ?>
