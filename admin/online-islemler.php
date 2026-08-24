<?php
/**
 * kzyfilo — Admin Online İşlem Talepleri (admin/online-islemler.php)
 */
require_once __DIR__ . '/includes/admin-header.php';
?>

<div class="flex flex-between items-center mb-8">
    <div>
        <h1 class="text-2xl fw-bold mb-1">Online Operasyonel İşlemler</h1>
        <p class="text-sm text-muted">Bakım, hasar, lastik ve yedek araç talepleri listesi</p>
    </div>
</div>

<div class="admin-card">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Plaka</th>
                <th>İşlem Türü</th>
                <th>Müşteri / Şirket</th>
                <th>Telefon</th>
                <th>Talep Açıklaması</th>
                <th>Tarih</th>
                <th>Durum</th>
                <th>İşlem</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><span class="badge badge-light" style="font-weight: bold;">34 KZY 599</span></td>
                <td><span class="badge badge-warning">Bakım Talebi</span></td>
                <td>Atlas Lojistik A.Ş.</td>
                <td>0532 555 12 34</td>
                <td>45.000 km periyodik bakım randevusu talep ediliyor.</td>
                <td>24.08.2026 09:30</td>
                <td><span class="status-badge status-new">Yeni</span></td>
                <td><button class="btn btn-primary btn-sm" onclick="adminNotice('Servis randevusu yönlendirildi')">Servise Yönlendir</button></td>
            </tr>
            <tr>
                <td><span class="badge badge-light" style="font-weight: bold;">06 FL 102</span></td>
                <td><span class="badge badge-info">Lastik Değişimi</span></td>
                <td>Kaya Mimarlık Ltd.</td>
                <td>0533 111 22 33</td>
                <td>Kış lastiği montaj randevusu talebi (Ankara).</td>
                <td>23.08.2026 15:00</td>
                <td><span class="status-badge status-approved">Randevu Verildi</span></td>
                <td><button class="btn btn-secondary btn-sm" onclick="adminNotice('Talep detayları')">Detay</button></td>
            </tr>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/includes/admin-footer.php'; ?>
