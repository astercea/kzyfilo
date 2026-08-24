<?php
/**
 * kzyfilo — Admin Genel Ayarlar (admin/ayarlar.php)
 */
require_once __DIR__ . '/includes/admin-header.php';
?>

<div class="flex flex-between items-center mb-8">
    <div>
        <h1 class="text-2xl fw-bold mb-1">Genel Sistem Ayarları</h1>
        <p class="text-sm text-muted">Şirket iletişim bilgileri, varsayılan para birimi ve çalışma saatleri</p>
    </div>
</div>

<div class="admin-card">
    <div class="admin-card-body">
        <form onsubmit="event.preventDefault(); adminNotice('Genel ayarlar güncellendi.');">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Marka / Şirket Adı</label>
                    <input type="text" class="form-input" value="kzyfilo" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Varsayılan Dil</label>
                    <select class="form-select">
                        <option value="tr" selected>Türkçe (TR)</option>
                        <option value="en">English (EN)</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Santral / Çağrı Merkezi Telefonu</label>
                    <input type="text" class="form-input" value="444 7 599" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Mobil / WhatsApp Destek Hattı</label>
                    <input type="text" class="form-input" value="+90 530 919 85 99" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Kurumsal E-posta</label>
                    <input type="email" class="form-input" value="info@kzyfilo.com.tr" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Çalışma Saatleri</label>
                    <input type="text" class="form-input" value="Pzt - Cum: 08:30 - 18:30 | Cts: 09:00 - 14:00">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Genel Merkez Adresi</label>
                <textarea class="form-textarea" rows="2">Çobançeşme Mah. Kımız Sk. No:38/A NISSAN KUZEY PLAZA, Bahçelievler/İstanbul</textarea>
            </div>

            <div class="mt-6">
                <button type="submit" class="btn btn-primary">Ayarları Kaydet</button>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/includes/admin-footer.php'; ?>
