<?php
/**
 * kzyfilo — Admin Teklif Detay Sayfası (admin/teklif-detay.php)
 */
require_once __DIR__ . '/includes/admin-header.php';
$id = $_GET['id'] ?? '1082';
?>

<div class="flex flex-between items-center mb-8">
    <div>
        <h1 class="text-2xl fw-bold mb-1">Teklif Başvuru Detayı (#TK-<?php echo esc($id); ?>)</h1>
        <p class="text-sm text-muted">Başvuru bilgileri, araç tercihleri ve durum güncellemesi</p>
    </div>
    <a href="teklifler.php" class="btn btn-secondary btn-sm">← Teklif Listesine Dön</a>
</div>

<div class="grid grid-2 gap-6">
    <!-- Müşteri ve Şirket Bilgileri -->
    <div class="admin-card">
        <div class="admin-card-header">
            <h3 class="text-base fw-bold">Müşteri & Kurumsal Bilgiler</h3>
        </div>
        <div class="admin-card-body">
            <table class="admin-table">
                <tbody>
                    <tr><td class="fw-semibold" style="width: 35%;">Ad Soyad:</td><td>Ahmet Yılmaz</td></tr>
                    <tr><td class="fw-semibold">Şirket Ünvanı:</td><td>Atlas Lojistik ve Taşımacılık A.Ş.</td></tr>
                    <tr><td class="fw-semibold">Telefon:</td><td>0532 555 12 34</td></tr>
                    <tr><td class="fw-semibold">E-posta:</td><td>ahmet@atlaslojistik.com</td></tr>
                    <tr><td class="fw-semibold">Şehir:</td><td>İstanbul</td></tr>
                    <tr><td class="fw-semibold">Sektör:</td><td>Uluslararası Taşımacılık / Lojistik</td></tr>
                    <tr><td class="fw-semibold">Başvuru Tarihi:</td><td>24.08.2026 10:15</td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Talep Edilen Araç ve Koşullar -->
    <div class="admin-card">
        <div class="admin-card-header">
            <h3 class="text-base fw-bold">Talep Edilen Araç & Kiralama Koşulları</h3>
        </div>
        <div class="admin-card-body">
            <table class="admin-table">
                <tbody>
                    <tr><td class="fw-semibold" style="width: 35%;">Seçilen Araç:</td><td>Renault Clio 1.0 TCe Evolution</td></tr>
                    <tr><td class="fw-semibold">Araç Adedi:</td><td>3 Adet</td></tr>
                    <tr><td class="fw-semibold">Kira Süresi:</td><td>36 Ay</td></tr>
                    <tr><td class="fw-semibold">Yıllık Kilometre:</td><td>15.000 km / yıl</td></tr>
                    <tr><td class="fw-semibold">Hizmet Paketi:</td><td>Avantaj Paketi</td></tr>
                    <tr><td class="fw-semibold">Tahmini Aylık Bedel:</td><td class="text-primary fw-bold">16.200 ₺ + KDV / Araç</td></tr>
                    <tr><td class="fw-semibold">Açıklama / Not:</td><td>Saha operasyon ekibi için acil teslimat talep ediliyor.</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Durum Güncelleme Kutusu -->
<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="text-base fw-bold">Durum Güncelleme ve Not Ekleme</h3>
    </div>
    <div class="admin-card-body">
        <form class="flex gap-4 items-end" onsubmit="event.preventDefault(); adminNotice('Teklif durumu güncellendi.');">
            <div class="form-group mb-0 flex-1">
                <label class="form-label">Başvuru Durumu</label>
                <select class="form-select">
                    <option value="new">Yeni</option>
                    <option value="pending" selected>İnceleniyor</option>
                    <option value="called">Müşteri Arandı</option>
                    <option value="preparing">Teklif Hazırlanıyor</option>
                    <option value="sent">Teklif Gönderildi</option>
                    <option value="won">Olumlu (Sözleşme Aşaması)</option>
                    <option value="lost">Olumsuz</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Durumu Güncelle</button>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/includes/admin-footer.php'; ?>
