<?php
/**
 * kzyfilo — Admin Teklif Listesi (admin/teklifler.php)
 */
require_once __DIR__ . '/includes/admin-header.php';
?>

<div class="flex flex-between items-center mb-8">
    <div>
        <h1 class="text-2xl fw-bold mb-1">Gelen Teklif Talepleri</h1>
        <p class="text-sm text-muted">Web sitesi üzerinden iletilen kurumsal ve hızlı teklif başvuruları</p>
    </div>
</div>

<div class="admin-card">
    <div class="admin-card-header">
        <div class="flex gap-2">
            <button class="btn btn-primary btn-sm">Tümü (18)</button>
            <button class="btn btn-secondary btn-sm">Yeni (4)</button>
            <button class="btn btn-secondary btn-sm">İnceleniyor (5)</button>
            <button class="btn btn-secondary btn-sm">Teklif Gönderildi (7)</button>
        </div>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Başvuru Sahibi</th>
                <th>Şirket</th>
                <th>İl / Şehir</th>
                <th>Araç & Adet</th>
                <th>Vade / Km</th>
                <th>Tarih</th>
                <th>Durum</th>
                <th>İşlem</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>#TK-1082</strong></td>
                <td>Ahmet Yılmaz</td>
                <td>Atlas Lojistik A.Ş.</td>
                <td>İstanbul</td>
                <td>Renault Clio (3 Adet)</td>
                <td>36 Ay / 15.000 km</td>
                <td>24.08.2026 10:15</td>
                <td><span class="status-badge status-new">Yeni</span></td>
                <td><a href="teklif-detay.php?id=1082" class="btn btn-outline btn-sm" style="padding: 4px 8px; font-size: 12px;">Detay</a></td>
            </tr>
            <tr>
                <td><strong>#TK-1081</strong></td>
                <td>Mehmet Kaya</td>
                <td>Kaya Mimarlık Ltd.</td>
                <td>Ankara</td>
                <td>Toyota Corolla Hybrid (1 Adet)</td>
                <td>24 Ay / 20.000 km</td>
                <td>24.08.2026 09:40</td>
                <td><span class="status-badge status-pending">İnceleniyor</span></td>
                <td><a href="teklif-detay.php?id=1081" class="btn btn-outline btn-sm" style="padding: 4px 8px; font-size: 12px;">Detay</a></td>
            </tr>
            <tr>
                <td><strong>#TK-1080</strong></td>
                <td>Selin Demir</td>
                <td>Demir Pharma</td>
                <td>İzmir</td>
                <td>MG ZS EV (5 Adet)</td>
                <td>48 Ay / 20.000 km</td>
                <td>23.08.2026 16:20</td>
                <td><span class="status-badge status-approved">Teklif Gönderildi</span></td>
                <td><a href="teklif-detay.php?id=1080" class="btn btn-outline btn-sm" style="padding: 4px 8px; font-size: 12px;">Detay</a></td>
            </tr>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/includes/admin-footer.php'; ?>
