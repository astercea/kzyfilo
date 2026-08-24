<?php
/**
 * kzyfilo — Admin Referanslar Yönetimi (admin/referanslar.php)
 */
require_once __DIR__ . '/includes/admin-header.php';
?>

<div class="flex flex-between items-center mb-8">
    <div>
        <h1 class="text-2xl fw-bold mb-1">Kurumsal Referanslar Yönetimi</h1>
        <p class="text-sm text-muted">Müşteri logoları, şirket adları ve ana sayfadaki sıralama düzeni</p>
    </div>
    <button class="btn btn-primary btn-sm" onclick="adminNotice('Yeni referans ekleme formu')">+ Yeni Referans Ekle</button>
</div>

<div class="admin-card">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Sıra</th>
                <th>Firma / Müşteri Adı</th>
                <th>Sektör</th>
                <th>Logo</th>
                <th>Durum</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 1; $i <= 6; $i++): ?>
                <tr>
                    <td><strong><?php echo $i; ?></strong></td>
                    <td><strong>Kurumsal Referans <?php echo $i; ?></strong></td>
                    <td>Lojistik / Sanayi</td>
                    <td><span class="badge badge-light">Nötr Logo <?php echo $i; ?></span></td>
                    <td><span class="status-badge status-approved">Aktif</span></td>
                    <td>
                        <div class="flex gap-2">
                            <button class="btn btn-secondary btn-sm" onclick="adminNotice('Referans düzenleme')">Düzenle</button>
                            <button class="btn btn-ghost btn-sm text-error" onclick="adminNotice('Referans silindi')">Sil</button>
                        </div>
                    </td>
                </tr>
            <?php endfor; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/includes/admin-footer.php'; ?>
