<?php
/**
 * kzyfilo — Admin SEO & Meta Yönetimi (admin/seo.php)
 */
require_once __DIR__ . '/includes/admin-header.php';
?>

<div class="flex flex-between items-center mb-8">
    <div>
        <h1 class="text-2xl fw-bold mb-1">SEO ve Meta Etiket Ayarları</h1>
        <p class="text-sm text-muted">Arama motoru optimizasyonu, canonical ve sosyal medya etiketleri</p>
    </div>
</div>

<div class="admin-card">
    <div class="admin-card-body">
        <form onsubmit="event.preventDefault(); adminNotice('SEO ayarları güncellendi.');">
            <div class="form-group">
                <label class="form-label">Varsayılan Site Başlığı (Title)</label>
                <input type="text" class="form-input" value="kzyfilo | Kurumsal Araç Kiralama & Filo Yönetimi">
            </div>

            <div class="form-group">
                <label class="form-label">Varsayılan Meta Description</label>
                <textarea class="form-textarea" rows="3">kzyfilo; kurumsal şirketlere, KOBİ'lere ve profesyonellere uzun dönem araç kiralama ve filo yönetimi hizmetleri sunar. Esnek paketler ve anında teklif.</textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Canlı Domain (Canonical Base URL)</label>
                <input type="url" class="form-input" value="https://kzyfilo.com.tr" readonly style="background-color: var(--color-surface-soft);">
                <span class="form-hint">Canlı canonical URL'ler ve sitemap için referans domain.</span>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Google Tag Manager / Analytics ID</label>
                    <input type="text" class="form-input" placeholder="GTM-XXXXXXX veya G-XXXXXXXXXX">
                </div>
                <div class="form-group">
                    <label class="form-label">Google Search Console Doğrulama Kodu</label>
                    <input type="text" class="form-input" placeholder="google-site-verification=...">
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="btn btn-primary">SEO Ayarlarını Kaydet</button>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/includes/admin-footer.php'; ?>
