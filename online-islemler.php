<?php
/**
 * kzyfilo — Online İşlemler (online-islemler.php)
 * KZY Executive Digital Fleet Operations
 */
require_once __DIR__ . '/includes/config.php';

setPageMeta([
    'title' => t('online.title') . ' | ' . SITE_NAME,
    'description' => 'kzyfilo müşterilerine özel online periyodik bakım, hasar bildirimi, lastik randevusu ve ikame araç talep paneli.',
    'canonical' => canonical('online-islemler.php'),
]);

$breadcrumbs = [
    ['title' => t('online.title')]
];

include includePath('header.php');?>

<!-- ─── 1. PAGE HEADER ─────────────────────────────────────────────── -->
<div class="page-header">
    <div class="container">
        <h1><?php e('online.title'); ?></h1>
        <?php include includePath('breadcrumbs.php'); ?>
    </div>
</div>

<!-- ─── 2. HIZLI İŞLEM KARTLARI ─────────────────────────────────────── -->
<section class="section section-ivory" data-reveal="fade-up">
    <div class="container">
        <div class="grid grid-4 gap-6 mb-12">
            <div class="card card-body" data-spotlight style="background: #ffffff;">
                <div class="solution-icon-wrap" style="width: 44px; height: 44px; margin-bottom: var(--space-3);">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
                    </svg>
                </div>
                <h4 style="font-size: 1.05rem; font-weight: 700; color: #121822; margin-bottom: 4px;">Periyodik Bakım</h4>
                <p style="font-size: 0.85rem; color: var(--color-text-muted); margin-bottom: 0;">Kilometre dolumu veya yıllık bakım randevusu oluşturun.</p>
            </div>
            <div class="card card-body" data-spotlight style="background: #ffffff;">
                <div class="solution-icon-wrap" style="width: 44px; height: 44px; margin-bottom: var(--space-3);">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                        <line x1="12" y1="9" x2="12" y2="13"></line>
                        <line x1="12" y1="17" x2="12.01" y2="17"></line>
                    </svg>
                </div>
                <h4 style="font-size: 1.05rem; font-weight: 700; color: #121822; margin-bottom: 4px;">Hasar & Kaza Bildirimi</h4>
                <p style="font-size: 0.85rem; color: var(--color-text-muted); margin-bottom: 0;">Tutanak ve fotoğrafları yükleyerek dosya açın.</p>
            </div>
            <div class="card card-body" data-spotlight style="background: #ffffff;">
                <div class="solution-icon-wrap" style="width: 44px; height: 44px; margin-bottom: var(--space-3);">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <circle cx="12" cy="12" r="4"></circle>
                    </svg>
                </div>
                <h4 style="font-size: 1.05rem; font-weight: 700; color: #121822; margin-bottom: 4px;">Lastik Randevusu</h4>
                <p style="font-size: 0.85rem; color: var(--color-text-muted); margin-bottom: 0;">Mevsimsel lastik değişimi ve rot balans talebi iletin.</p>
            </div>
            <div class="card card-body" data-spotlight style="background: #ffffff;">
                <div class="solution-icon-wrap" style="width: 44px; height: 44px; margin-bottom: var(--space-3);">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2"></path>
                        <circle cx="7" cy="17" r="2"></circle>
                        <path d="M9 17h6"></path>
                        <circle cx="17" cy="17" r="2"></circle>
                    </svg>
                </div>
                <h4 style="font-size: 1.05rem; font-weight: 700; color: #121822; margin-bottom: 4px;">İkame Araç Talebi</h4>
                <p style="font-size: 0.85rem; color: var(--color-text-muted); margin-bottom: 0;">Servisteki aracınız için hızlı yedek araç yönlendirin.</p>
            </div>
        </div>

        <!-- ─── 3. FORM & YARDIM İKİLİ PANEL ───────────────────────────── -->
        <div class="grid grid-2 gap-8 items-start">
            <!-- Sol: Form -->
            <div>
                <form id="online-operations-form" class="card card-body" novalidate style="background: #ffffff; padding: var(--space-8);">
                    <h3 class="text-xl fw-bold mb-6"><?php echo (CURRENT_LANG === 'tr') ? 'Online İşlem Talep Formu' : 'Online Operation Request Form'; ?></h3>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="op-plate" class="form-label"><?php e('form.plate'); ?> <span class="required">*</span></label>
                            <input type="text" id="op-plate" name="plate" class="form-input" required placeholder="34 KZY 599" style="text-transform: uppercase;">
                        </div>
                        <div class="form-group">
                            <label for="op-type" class="form-label"><?php e('form.operation_type'); ?> <span class="required">*</span></label>
                            <select id="op-type" name="operation_type" class="form-select" required>
                                <option value=""><?php e('form.select'); ?></option>
                                <option value="maintenance"><?php e('online.maintenance'); ?></option>
                                <option value="damage"><?php e('online.damage'); ?></option>
                                <option value="tire"><?php e('online.tire'); ?></option>
                                <option value="replacement"><?php e('online.replacement'); ?></option>
                                <option value="hgs"><?php e('online.hgs'); ?></option>
                                <option value="fine"><?php e('online.fine'); ?></option>
                                <option value="change"><?php e('online.change'); ?></option>
                                <option value="return"><?php e('online.return'); ?></option>
                                <option value="other"><?php e('online.other'); ?></option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="op-fullname" class="form-label"><?php e('form.full_name'); ?> <span class="required">*</span></label>
                            <input type="text" id="op-fullname" name="fullname" class="form-input" required autocomplete="name">
                        </div>
                        <div class="form-group">
                            <label for="op-phone" class="form-label"><?php e('form.phone'); ?> <span class="required">*</span></label>
                            <input type="tel" id="op-phone" name="phone" class="form-input" required placeholder="05XX XXX XX XX" autocomplete="tel">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="op-company" class="form-label"><?php e('form.company'); ?> <span class="required">*</span></label>
                        <input type="text" id="op-company" name="company" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label for="op-description" class="form-label"><?php e('form.description'); ?> <span class="required">*</span></label>
                        <textarea id="op-description" name="description" class="form-textarea" rows="4" required placeholder="Talep detayları, kilometre bilgisi veya servis tercihi..."></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="op-file">
                            <?php e('form.file_upload'); ?> <span class="text-muted fw-normal" style="font-size: 12px;">(Opsiyonel)</span>
                        </label>
                        
                        <div class="compact-file-upload">
                            <input type="file" id="op-file" name="file" class="compact-file-input" accept="image/*,.pdf">
                            <div class="btn-compact-upload">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="17 8 12 3 7 8"></polyline>
                                    <line x1="12" y1="3" x2="12" y2="15"></line>
                                </svg>
                                <span>Dosya Seç</span>
                            </div>
                            <span class="compact-file-name" id="compact-file-name">Dosya seçilmedi</span>
                            <button type="button" class="compact-file-clear hidden" id="compact-file-clear" title="Dosyayı Kaldır" aria-label="Dosyayı Kaldır">
                                <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                            </button>
                        </div>
                        <span class="form-hint" style="font-size: 11.5px; color: var(--color-text-muted); margin-top: 6px; display: block;">
                            Kaza tespit tutanağı, ruhsat veya hasar fotoğrafları (PDF, JPG, PNG — Maks. 10 MB)
                        </span>
                    </div>

                    <div class="form-group">
                        <label class="form-check">
                            <input type="checkbox" id="op-kvkk" name="kvkk" required>
                            <span class="form-check-label">
                                <a href="<?php echo url('kvkk.php'); ?>" target="_blank" rel="noopener noreferrer" style="text-decoration: underline;"><?php e('form.kvkk_consent'); ?></a> <span class="required">*</span>
                            </span>
                        </label>
                    </div>

                    <div class="mt-8 pt-6" style="border-top: 1px solid var(--color-border-light);">
                        <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">
                            <?php echo (CURRENT_LANG === 'tr') ? 'Talebi İlet' : 'Submit Request'; ?>
                        </button>
                    </div>
                </form>

                <div class="card card-body text-center hidden py-16" id="op-success-view" style="background: #ffffff;">
                    <div style="width: 72px; height: 72px; border-radius: 50%; background-color: var(--color-success-light); color: var(--color-success); display: flex; align-items: center; justify-content: center; margin: 0 auto var(--space-6);">
                        <svg viewBox="0 0 24 24" width="40" height="40" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </div>
                    <h2 class="text-2xl mb-3">Talebiniz Alındı</h2>
                    <p class="text-muted max-w-md mx-auto mb-6">Operasyon ekibimiz en kısa sürede plakanıza bağlı sözleşme üzerinden işlemleri başlatacaktır.</p>
                    <div class="demo-notice mb-8 p-3" style="border-radius: var(--radius-md);">
                        <?php e('success.quote_prototype_notice'); ?>
                    </div>
                    <a href="<?php echo url('index.php'); ?>" class="btn btn-primary"><?php e('error.404_btn'); ?></a>
                </div>
            </div>

            <!-- Sağ: Acil Destek & Rehber Paneli -->
            <div class="flex flex-col gap-6">
                <!-- 7/24 Acil Çağrı Kartı -->
                <div class="card card-body" style="background-color: #0c131c; color: #ffffff; padding: var(--space-8);">
                    <span class="editorial-tag" style="color: var(--color-sand);">7/24 Acil Yol Yardım</span>
                    <h3 style="color: #ffffff; font-size: 1.4rem; margin-top: var(--space-2); margin-bottom: var(--space-3);">
                        Kaza veya Acil Arıza Durumunda
                    </h3>
                    <p style="font-size: 0.95rem; color: rgba(255, 255, 255, 0.75); line-height: 1.6; margin-bottom: var(--space-6);">
                        Beklemeden 7/24 kesintisiz operasyon merkezimizi arayarak anında çekici, ambulans veya yerinde teknik destek talep edebilirsiniz.
                    </p>
                    <a href="tel:08503005999" class="btn btn-primary btn-lg" style="width: 100%; justify-content: center; gap: 8px;">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                        </svg>
                        <span>0850 300 59 99</span>
                    </a>
                </div>

                <!-- Bilgi Notları -->
                <div class="card card-body" style="background: #ffffff; padding: var(--space-6);">
                    <h4 style="font-size: 1.1rem; font-weight: 700; color: #121822; margin-bottom: var(--space-4);">İşlem Süreci Bilgilendirmesi</h4>
                    <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 12px; font-size: 0.9rem; color: var(--color-text-muted);">
                        <li style="display: flex; gap: 10px;">
                            <strong style="color: var(--color-orange);">1.</strong> Talebiniz iletildikten sonra SMS/E-posta ile takip numarası gönderilir.
                        </li>
                        <li style="display: flex; gap: 10px;">
                            <strong style="color: var(--color-orange);">2.</strong> Yetkili servis randevusu plakanız adına açılarak size konum iletilir.
                        </li>
                        <li style="display: flex; gap: 10px;">
                            <strong style="color: var(--color-orange);">3.</strong> 24 saati aşan onarımlarda aynı segment ikame aracınız hazırlanır.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // Kompakt Dosya Yükleme & Gösterim Mantığı
    const fileInput = document.getElementById('op-file');
    const compactFileName = document.getElementById('compact-file-name');
    const compactFileClear = document.getElementById('compact-file-clear');

    if (fileInput) {
        fileInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const file = this.files[0];
                compactFileName.textContent = file.name;
                compactFileName.classList.add('is-selected');
                compactFileClear.classList.remove('hidden');
                fileInput.style.pointerEvents = 'none';
            }
        });
    }

    if (compactFileClear) {
        compactFileClear.addEventListener('click', function(e) {
            e.stopPropagation();
            fileInput.value = '';
            compactFileName.textContent = 'Dosya seçilmedi';
            compactFileName.classList.remove('is-selected');
            compactFileClear.classList.add('hidden');
            fileInput.style.pointerEvents = 'auto';
        });
    }

    // Form Gönderim
    document.getElementById('online-operations-form').addEventListener('submit', function(e) {
        e.preventDefault();
        this.classList.add('hidden');
        document.getElementById('op-success-view').classList.remove('hidden');
        if (typeof window.showToast === 'function') {
            window.showToast('Online işlem talebiniz iletildi. (Frontend Prototip)', 'success', 5000);
        }
    });
</script>

<?php include includePath('footer.php'); ?>
