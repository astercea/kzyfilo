<?php
/**
 * kzyfilo — Admin Dashboard (admin/index.php)
 */
require_once __DIR__ . '/includes/admin-header.php';
$vehicles = loadData('vehicles.php');
?>

<div class="flex flex-between items-center mb-8">
    <div>
        <h1 class="text-2xl fw-bold mb-1">Gösterge Paneli (Dashboard)</h1>
        <p class="text-sm text-muted">Filo performansı, aktif başvurular ve sistem genel görünümü</p>
    </div>
    <a href="arac-form.php" class="btn btn-primary btn-sm">+ Yeni Araç Ekle</a>
</div>

<!-- ─── 4'LÜ İSTATİSTİK KARTLARI ───────────────────────────────────── -->
<div class="admin-stats-grid">
    <div class="admin-stat-card">
        <div class="admin-stat-icon" style="background-color: #eff6ff; color: #2563eb;">📑</div>
        <div>
            <div class="admin-stat-val">28</div>
            <div class="admin-stat-lbl">Bu Hafta Gelen Teklifler</div>
        </div>
    </div>

    <div class="admin-stat-card">
        <div class="admin-stat-icon" style="background-color: #fef8e7; color: #d99500;">⏳</div>
        <div>
            <div class="admin-stat-val">6</div>
            <div class="admin-stat-lbl">İncelenmeyi Bekleyen</div>
        </div>
    </div>

    <div class="admin-stat-card">
        <div class="admin-stat-icon" style="background-color: #e8f5ef; color: #138a5b;">🚗</div>
        <div>
            <div class="admin-stat-val"><?php echo count($vehicles); ?></div>
            <div class="admin-stat-lbl">Aktif Yayında Araç</div>
        </div>
    </div>

    <div class="admin-stat-card">
        <div class="admin-stat-icon" style="background-color: #f1f5f9; color: #475569;">📞</div>
        <div>
            <div class="admin-stat-val">14</div>
            <div class="admin-stat-lbl">Aranma Talepleri</div>
        </div>
    </div>
</div>

<!-- ─── SON GELEN TEKLİF TALEPLERİ TABLOSU ────────────────────────── -->
<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="text-base fw-bold">Son Gelen Teklif Talepleri</h3>
        <a href="teklifler.php" class="text-xs text-primary fw-semibold">Tümünü Gör →</a>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Başvuru No</th>
                <th>Müşteri / Şirket</th>
                <th>İlgilenilen Araç</th>
                <th>Vade / Km</th>
                <th>Tarih</th>
                <th>Durum</th>
                <th>İşlem</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>#TK-1082</strong></td>
                <td>
                    <strong>Ahmet Yılmaz</strong>
                    <div class="text-xs text-muted">Atlas Lojistik A.Ş. (İstanbul)</div>
                </td>
                <td>Renault Clio (1.0 TCe)</td>
                <td>36 Ay / 15.000 km</td>
                <td>24.08.2026 10:15</td>
                <td><span class="status-badge status-new">Yeni</span></td>
                <td><a href="teklif-detay.php?id=1082" class="btn btn-outline btn-sm" style="padding: 4px 8px; font-size: 12px;">İncele</a></td>
            </tr>
            <tr>
                <td><strong>#TK-1081</strong></td>
                <td>
                    <strong>Mehmet Kaya</strong>
                    <div class="text-xs text-muted">Kaya Mimarlık Ltd. (Ankara)</div>
                </td>
                <td>Toyota Corolla Hybrid</td>
                <td>24 Ay / 20.000 km</td>
                <td>24.08.2026 09:40</td>
                <td><span class="status-badge status-pending">Teklif Hazırlanıyor</span></td>
                <td><a href="teklif-detay.php?id=1081" class="btn btn-outline btn-sm" style="padding: 4px 8px; font-size: 12px;">İncele</a></td>
            </tr>
            <tr>
                <td><strong>#TK-1080</strong></td>
                <td>
                    <strong>Selin Demir</strong>
                    <div class="text-xs text-muted">Demir Pharma (İzmir)</div>
                </td>
                <td>MG ZS EV (%100 Elektrikli)</td>
                <td>48 Ay / 20.000 km</td>
                <td>23.08.2026 16:20</td>
                <td><span class="status-badge status-approved">Teklif Gönderildi</span></td>
                <td><a href="teklif-detay.php?id=1080" class="btn btn-outline btn-sm" style="padding: 4px 8px; font-size: 12px;">İncele</a></td>
            </tr>
            <tr>
                <td><strong>#TK-1079</strong></td>
                <td>
                    <strong>Burak Özkan</strong>
                    <div class="text-xs text-muted">Özkan Bilişim (İstanbul)</div>
                </td>
                <td>BMW 320i Sedan</td>
                <td>36 Ay / 15.000 km</td>
                <td>23.08.2026 14:10</td>
                <td><span class="status-badge status-approved">Müşteri Arandı</span></td>
                <td><a href="teklif-detay.php?id=1079" class="btn btn-outline btn-sm" style="padding: 4px 8px; font-size: 12px;">İncele</a></td>
            </tr>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/includes/admin-footer.php'; ?>
