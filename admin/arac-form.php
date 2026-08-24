<?php
/**
 * kzyfilo — Admin Araç Ekle / Düzenle Formu (admin/arac-form.php)
 */
require_once __DIR__ . '/includes/admin-header.php';
$id = $_GET['id'] ?? null;
?>

<div class="flex flex-between items-center mb-8">
    <div>
        <h1 class="text-2xl fw-bold mb-1"><?php echo $id ? 'Araç Bilgilerini Düzenle' : 'Yeni Araç Ekle'; ?></h1>
        <p class="text-sm text-muted">Kataloğa yeni araç modeli ekleme veya mevcut aracı güncelleme formu</p>
    </div>
    <a href="araclar.php" class="btn btn-secondary btn-sm">← Araç Listesine Dön</a>
</div>

<div class="admin-card">
    <div class="admin-card-body">
        <form onsubmit="event.preventDefault(); adminNotice('Araç bilgileri başarıyla kaydedildi.');">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Marka <span class="required">*</span></label>
                    <input type="text" class="form-input" required value="<?php echo $id ? 'Renault' : ''; ?>" placeholder="Örn: Renault, BMW, Toyota">
                </div>
                <div class="form-group">
                    <label class="form-label">Model <span class="required">*</span></label>
                    <input type="text" class="form-input" required value="<?php echo $id ? 'Clio' : ''; ?>" placeholder="Örn: Clio, 320i, Corolla">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Versiyon / Donanım <span class="required">*</span></label>
                    <input type="text" class="form-input" required value="<?php echo $id ? '1.0 TCe Evolution 90 BG' : ''; ?>" placeholder="Örn: 1.0 TCe Evolution 90 BG">
                </div>
                <div class="form-group">
                    <label class="form-label">Başlangıç Demo Fiyatı (₺/ay) <span class="required">*</span></label>
                    <input type="number" class="form-input" required value="<?php echo $id ? '14850' : '15000'; ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Kategori</label>
                    <select class="form-select">
                        <option value="binek">Binek</option>
                        <option value="ticari">Ticari</option>
                        <option value="elektrikli">Elektrikli</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Kasa Tipi</label>
                    <select class="form-select">
                        <option value="hatchback">Hatchback</option>
                        <option value="sedan">Sedan</option>
                        <option value="suv">SUV</option>
                        <option value="minivan">Minivan</option>
                        <option value="panelvan">Panelvan</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Yakıt Tipi</label>
                    <select class="form-select">
                        <option value="benzin">Benzin</option>
                        <option value="dizel">Dizel</option>
                        <option value="hibrit">Hibrit</option>
                        <option value="elektrik">Elektrik</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Vites Tipi</label>
                    <select class="form-select">
                        <option value="otomatik">Otomatik</option>
                        <option value="manuel">Manuel</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Açıklama</label>
                <textarea class="form-textarea" rows="3" placeholder="Araç hakkında kısa tanıtım metni..."><?php echo $id ? 'Şehir içi kullanımda yüksek yakıt verimliliği ve konfor sunan yeni model.' : ''; ?></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Etiketler</label>
                <div class="flex gap-4">
                    <label class="form-check">
                        <input type="checkbox" checked>
                        <span>Kampanyalı Araç</span>
                    </label>
                    <label class="form-check">
                        <input type="checkbox" checked>
                        <span>Hızlı Teslimat</span>
                    </label>
                    <label class="form-check">
                        <input type="checkbox">
                        <span>Premium Araç</span>
                    </label>
                </div>
            </div>

            <div class="mt-8 pt-6" style="border-top: 1px solid var(--admin-border);">
                <button type="submit" class="btn btn-primary"><?php echo $id ? 'Değişiklikleri Kaydet' : 'Aracı Kataloğa Ekle'; ?></button>
                <a href="araclar.php" class="btn btn-secondary ml-3">İptal</a>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/includes/admin-footer.php'; ?>
