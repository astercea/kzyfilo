<?php
/**
 * kzyfilo — Admin Aranma Talepleri (admin/aranma-talepleri.php)
 */
require_once __DIR__ . '/includes/admin-header.php';
?>

<div class="flex flex-between items-center mb-8">
    <div>
        <h1 class="text-2xl fw-bold mb-1">"Sizi Arayalım" Talepleri</h1>
        <p class="text-sm text-muted">Web sitesi üzerinden gelen geri arama bildirimleri</p>
    </div>
</div>

<div class="admin-card">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Ad Soyad</th>
                <th>Telefon</th>
                <th>Tercih Edilen Zaman</th>
                <th>Açıklama / Not</th>
                <th>Tarih</th>
                <th>Durum</th>
                <th>İşlem</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Serkan Aydın</strong></td>
                <td>0542 123 45 67</td>
                <td>Öğleden Sonra (12:00 - 15:00)</td>
                <td>Clio ve Egea kiralama için fiyat almak istiyor.</td>
                <td>24.08.2026 10:45</td>
                <td><span class="status-badge status-new">Bekliyor</span></td>
                <td><button class="btn btn-primary btn-sm" onclick="adminNotice('Müşteri arandı olarak işaretlendi')">Arandı</button></td>
            </tr>
            <tr>
                <td><strong>Gamze Çelik</strong></td>
                <td>0533 987 65 43</td>
                <td>Sabah (09:00 - 12:00)</td>
                <td>Elektrikli araç şarj danışmanlığı hakkında görüşmek istiyor.</td>
                <td>24.08.2026 09:10</td>
                <td><span class="status-badge status-approved">Tamamlandı</span></td>
                <td><button class="btn btn-secondary btn-sm" onclick="adminNotice('Detay görüntülendi')">Detay</button></td>
            </tr>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/includes/admin-footer.php'; ?>
