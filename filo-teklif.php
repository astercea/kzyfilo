<?php
/**
 * kzyfilo — Filo Yönetimi Teklif Formu (filo-teklif.php)
 */
require_once __DIR__ . '/includes/config.php';

setPageMeta([
    'title' => t('quote_form.fleet_title') . ' | ' . SITE_NAME,
    'description' => t('quote_form.fleet_desc'),
    'canonical' => canonical('filo-teklif.php'),
]);

$breadcrumbs = [
    ['title' => t('quote_form.fleet_title')]
];

include includePath('header.php');
?>

<div class="page-header">
    <div class="container container-narrow text-center">
        <h1><?php e('quote_form.fleet_title'); ?></h1>
        <p><?php e('quote_form.fleet_desc'); ?></p>
    </div>

<?php include includePath('breadcrumbs.php'); ?>
</div>

<section class="section-sm">
    <div class="container container-narrow">
        <form id="fleet-management-quote-form" class="card card-body" novalidate>
            <h3 class="text-xl fw-bold mb-6"><?php echo (CURRENT_LANG === 'tr') ? 'Kurumsal Filo Teklif Talebi' : 'Corporate Fleet Quote Request'; ?></h3>

            <!-- Kişisel Bilgiler -->
            <div class="form-row">
                <div class="form-group">
                    <label for="fleet-name" class="form-label"><?php e('form.name'); ?> <span class="required">*</span></label>
                    <input type="text" id="fleet-name" name="name" class="form-input" required autocomplete="given-name">
                </div>
                <div class="form-group">
                    <label for="fleet-surname" class="form-label"><?php e('form.surname'); ?> <span class="required">*</span></label>
                    <input type="text" id="fleet-surname" name="surname" class="form-input" required autocomplete="family-name">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="fleet-phone" class="form-label"><?php e('form.phone'); ?> <span class="required">*</span></label>
                    <input type="tel" id="fleet-phone" name="phone" class="form-input" required placeholder="05XX XXX XX XX" autocomplete="tel">
                </div>
                <div class="form-group">
                    <label for="fleet-email" class="form-label"><?php e('form.email'); ?> <span class="required">*</span></label>
                    <input type="email" id="fleet-email" name="email" class="form-input" required placeholder="ad.soyad@sirket.com" autocomplete="email">
                </div>
            </div>

            <!-- Kurumsal Bilgiler -->
            <div class="form-row">
                <div class="form-group">
                    <label for="fleet-company" class="form-label"><?php e('form.company'); ?> <span class="required">*</span></label>
                    <input type="text" id="fleet-company" name="company" class="form-input" required placeholder="Şirket Ünvanı">
                </div>
                <div class="form-group">
                    <label for="fleet-city" class="form-label"><?php e('form.city'); ?> <span class="required">*</span></label>
                    <select id="fleet-city" name="city" class="form-select" required>
                        <option value="İstanbul" selected>İstanbul</option>
                        <option value="Ankara">Ankara</option>
                        <option value="İzmir">İzmir</option>
                        <option value="Bursa">Bursa</option>
                        <option value="Diğer">Diğer</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="fleet-current-count" class="form-label"><?php e('form.current_vehicles'); ?></label>
                    <input type="number" id="fleet-current-count" name="current_vehicles" class="form-input" placeholder="Örn: 15" min="0">
                </div>
                <div class="form-group">
                    <label for="fleet-target-count" class="form-label"><?php e('form.vehicle_count'); ?> <span class="required">*</span></label>
                    <input type="number" id="fleet-target-count" name="target_vehicles" class="form-input" required placeholder="Örn: 20" min="1">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label"><?php echo (CURRENT_LANG === 'tr') ? 'Talep Edilen Araç Segmentleri ve Hizmetler' : 'Requested Vehicle Segments and Services'; ?></label>
                <div class="grid grid-3 gap-3">
                    <label class="form-check">
                        <input type="checkbox" name="services[]" value="binek" checked>
                        <span class="text-sm">Binek Araç Filosu</span>
                    </label>
                    <label class="form-check">
                        <input type="checkbox" name="services[]" value="ticari">
                        <span class="text-sm">Ticari / Saha Filosu</span>
                    </label>
                    <label class="form-check">
                        <input type="checkbox" name="services[]" value="elektrikli">
                        <span class="text-sm">Elektrikli Filo</span>
                    </label>
                    <label class="form-check">
                        <input type="checkbox" name="services[]" value="telematics" checked>
                        <span class="text-sm">Telematik / Takip</span>
                    </label>
                    <label class="form-check">
                        <input type="checkbox" name="services[]" value="maintenance_manage" checked>
                        <span class="text-sm">Hasar / Bakım Yönetimi</span>
                    </label>
                    <label class="form-check">
                        <input type="checkbox" name="services[]" value="fuel_manage">
                        <span class="text-sm">Akaryakıt Yönetimi</span>
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label for="fleet-notes" class="form-label"><?php e('form.description'); ?></label>
                <textarea id="fleet-notes" name="notes" class="form-textarea" rows="4" placeholder="Şirketinizin özel filo gereksinimleri, tercih edilen markalar veya bütçe hedefleri..."></textarea>
            </div>

            <!-- KVKK Onayı -->
            <div class="form-group">
                <label class="form-check">
                    <input type="checkbox" id="fleet-kvkk" name="kvkk" required>
                    <span class="form-check-label">
                        <a href="<?php echo url('kvkk.php'); ?>" target="_blank" rel="noopener noreferrer" style="text-decoration: underline;"><?php e('form.kvkk_consent'); ?></a> <span class="required">*</span>
                    </span>
                </label>
            </div>

            <div class="mt-8 pt-6" style="border-top: 1px solid var(--color-border-light);">
                <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">
                    <?php e('quote_form.submit'); ?> ✓
                </button>
            </div>
        </form>

        <!-- Başarı Ekranı -->
        <div class="card card-body text-center hidden py-16" id="fleet-success-view">
            <div style="width: 72px; height: 72px; border-radius: 50%; background-color: var(--color-success-light); color: var(--color-success); display: flex; align-items: center; justify-content: center; margin: 0 auto var(--space-6);">
                <svg viewBox="0 0 24 24" width="40" height="40" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
            </div>
            <h2 class="text-2xl mb-3"><?php e('success.quote_submitted'); ?></h2>
            <p class="text-muted max-w-md mx-auto mb-6">
                <?php echo (CURRENT_LANG === 'tr') ? 'Kurumsal filo yönetim uzmanımız talebinizi inceleyerek en geç 1 iş günü içinde şirketiniz için hazırlanan kapsamlı teklif dosyasıyla iletişime geçecektir.' : 'Our corporate fleet specialist will review your request and get back to you within 1 business day.'; ?>
            </p>
            <div class="demo-notice mb-8 p-3" style="border-radius: var(--radius-md);">
                ℹ️ <?php e('success.quote_prototype_notice'); ?>
            </div>
            <div class="flex gap-4 justify-center">
                <a href="<?php echo url('index.php'); ?>" class="btn btn-primary"><?php e('error.404_btn'); ?></a>
                <a href="<?php echo url('filo-yonetimi.php'); ?>" class="btn btn-outline"><?php e('solutions_menu.fleet_management'); ?></a>
            </div>
        </div>
    </div>
</section>

<script src="<?php echo asset('js/forms.js'); ?>"></script>

<?php include includePath('footer.php'); ?>
