<?php
/**
 * kzyfilo — Online İşlemler (online-islemler.php)
 */
require_once __DIR__ . '/includes/config.php';

setPageMeta([
    'title' => t('online.title') . ' | ' . SITE_NAME,
    'description' => t('online.description'),
    'canonical' => canonical('online-islemler.php'),
]);

$breadcrumbs = [
    ['title' => t('online.title')]
];

include includePath('header.php');
include includePath('breadcrumbs.php');
?>

<div class="page-header">
    <div class="container text-center">
        <h1><?php e('online.title'); ?></h1>
        <p><?php e('online.description'); ?></p>
    </div>
</div>

<section class="section">
    <div class="container container-narrow">
        <form id="online-operations-form" class="card card-body" novalidate>
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
                <label class="form-label"><?php e('form.file_upload'); ?> (Opsiyonel)</label>
                <input type="file" class="form-input" accept="image/*,.pdf">
                <span class="form-hint">Kaza tespit tutanağı, ruhsat veya hasar fotoğrafları ekleyebilirsiniz.</span>
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
                    <?php echo (CURRENT_LANG === 'tr') ? 'Talebi İlet' : 'Submit Request'; ?> ✓
                </button>
            </div>
        </form>

        <div class="card card-body text-center hidden py-16" id="op-success-view">
            <div style="width: 72px; height: 72px; border-radius: 50%; background-color: var(--color-success-light); color: var(--color-success); display: flex; align-items: center; justify-content: center; margin: 0 auto var(--space-6);">
                <svg viewBox="0 0 24 24" width="40" height="40" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
            </div>
            <h2 class="text-2xl mb-3">Talebiniz Alındı</h2>
            <p class="text-muted max-w-md mx-auto mb-6">Operasyon ekibimiz en kısa sürede plakanıza bağlı sözleşme üzerinden işlemleri başlatacaktır.</p>
            <a href="<?php echo url('index.php'); ?>" class="btn btn-primary"><?php e('error.404_btn'); ?></a>
        </div>
    </div>
</section>

<script>
    document.getElementById('online-operations-form').addEventListener('submit', function(e) {
        e.preventDefault();
        // TODO: Backend API entegrasyonu
        this.classList.add('hidden');
        document.getElementById('op-success-view').classList.remove('hidden');
        window.showToast('Online işlem talebiniz iletildi. (Frontend Prototip)', 'success', 5000);
    });
</script>

<?php include includePath('footer.php'); ?>
