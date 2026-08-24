<?php
/**
 * kzyfilo — Hızlı Teklif Formu (hizli-teklif.php)
 */
require_once __DIR__ . '/includes/config.php';

$vehicles = loadData('vehicles.php');
$packages = loadData('packages.php');

$selectedSlug = $_GET['arac'] ?? '';

setPageMeta([
    'title' => t('quote_form.quick_title') . ' | ' . SITE_NAME,
    'description' => t('quote_form.quick_desc'),
    'canonical' => canonical('hizli-teklif.php'),
]);

$breadcrumbs = [
    ['title' => t('quote_form.quick_title')]
];

include includePath('header.php');?>

<div class="page-header">
    <div class="container">
        <h1><?php e('quote_form.quick_title'); ?></h1>
        <?php include includePath('breadcrumbs.php'); ?>
    </div>
</div>

<!-- ─── 4 ADIMLI İLERLEME ÇUBUĞU ──────────────────────────────────── -->
<div class="container container-narrow mt-6">
    <div class="progress-steps">
        <div class="progress-step is-active">
            <span class="progress-step-number">1</span>
            <span><?php e('quote_form.step_vehicle_info'); ?></span>
        </div>
        <div class="progress-step-connector"></div>
        <div class="progress-step">
            <span class="progress-step-number">2</span>
            <span><?php e('quote_form.step_personal'); ?></span>
        </div>
        <div class="progress-step-connector"></div>
        <div class="progress-step">
            <span class="progress-step-number">3</span>
            <span><?php e('quote_form.step_corporate'); ?></span>
        </div>
        <div class="progress-step-connector"></div>
        <div class="progress-step">
            <span class="progress-step-number">4</span>
            <span><?php e('quote_form.step_confirm'); ?></span>
        </div>
    </div>
</div>

<section class="section-sm">
    <div class="container container-narrow">
        <!-- ─── ÇOK ADIMLI FORM ──────────────────────────────────────── -->
        <form id="multi-step-quote-form" class="card card-body" novalidate>
            
            <!-- ─── 1. ADIM: Araç ve Kiralama Bilgileri ──────────────────── -->
            <div class="form-step is-active" id="quote-step-1">
                <h3 class="form-step-title"><?php e('quote_form.step_vehicle_info'); ?></h3>

                <div class="form-group">
                    <label for="step1-vehicle" class="form-label">
                        <?php echo (CURRENT_LANG === 'tr') ? 'İlgilendiğiniz Araç' : 'Vehicle of Interest'; ?> <span class="required">*</span>
                    </label>
                    <select id="step1-vehicle" name="selected_vehicle" class="form-select" required>
                        <option value=""><?php e('form.select'); ?></option>
                        <?php foreach ($vehicles as $v): ?>
                            <option value="<?php echo esc($v['slug']); ?>" <?php echo ($selectedSlug === $v['slug']) ? 'selected' : ''; ?>>
                                <?php echo esc($v['brand'] . ' ' . $v['model'] . ' (' . $v['version'] . ')'); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <span class="form-error" id="step1-vehicle-error"></span>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label"><?php e('vehicle_detail.duration'); ?> <span class="required">*</span></label>
                        <select name="duration" class="form-select" required>
                            <option value="24">24 Ay</option>
                            <option value="36" selected>36 Ay</option>
                            <option value="48">48 Ay</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><?php e('vehicle_detail.annual_km'); ?> <span class="required">*</span></label>
                        <select name="annual_km" class="form-select" required>
                            <option value="15" selected>15.000 km / yıl</option>
                            <option value="20">20.000 km / yıl</option>
                            <option value="30">30.000 km / yıl</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label"><?php e('vehicle_detail.package'); ?></label>
                        <select name="package" class="form-select">
                            <option value="basic">Başlangıç Paketi</option>
                            <option value="advantage" selected>Avantaj Paketi (Önerilen)</option>
                            <option value="full">Tam Güvence Paketi</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label"><?php e('form.vehicle_count'); ?> <span class="required">*</span></label>
                        <select name="vehicle_count" class="form-select" required>
                            <option value="1" selected>1 Adet</option>
                            <option value="2">2 Adet</option>
                            <option value="3">3 Adet</option>
                            <option value="5">5 Adet</option>
                            <option value="10">10+ Adet</option>
                        </select>
                    </div>
                </div>

                <div class="form-actions">
                    <div></div>
                    <button type="button" class="btn btn-primary btn-step-next">
                        <?php e('quote_form.next'); ?> →
                    </button>
                </div>
            </div>

            <!-- ─── 2. ADIM: Kişisel Bilgiler ────────────────────────────── -->
            <div class="form-step" id="quote-step-2" hidden>
                <h3 class="form-step-title"><?php e('quote_form.step_personal'); ?></h3>

                <div class="form-row">
                    <div class="form-group">
                        <label for="step2-name" class="form-label"><?php e('form.name'); ?> <span class="required">*</span></label>
                        <input type="text" id="step2-name" name="name" class="form-input" required autocomplete="given-name">
                        <span class="form-error" id="step2-name-error"></span>
                    </div>

                    <div class="form-group">
                        <label for="step2-surname" class="form-label"><?php e('form.surname'); ?> <span class="required">*</span></label>
                        <input type="text" id="step2-surname" name="surname" class="form-input" required autocomplete="family-name">
                        <span class="form-error" id="step2-surname-error"></span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="step2-phone" class="form-label"><?php e('form.phone'); ?> <span class="required">*</span></label>
                        <input type="tel" id="step2-phone" name="phone" class="form-input" required placeholder="05XX XXX XX XX" autocomplete="tel">
                        <span class="form-error" id="step2-phone-error"></span>
                    </div>

                    <div class="form-group">
                        <label for="step2-email" class="form-label"><?php e('form.email'); ?> <span class="required">*</span></label>
                        <input type="email" id="step2-email" name="email" class="form-input" required placeholder="ornek@sirket.com" autocomplete="email">
                        <span class="form-error" id="step2-email-error"></span>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn btn-secondary btn-step-prev">
                        ← <?php e('quote_form.previous'); ?>
                    </button>
                    <button type="button" class="btn btn-primary btn-step-next">
                        <?php e('quote_form.next'); ?> →
                    </button>
                </div>
            </div>

            <!-- ─── 3. ADIM: Kurumsal Bilgiler ───────────────────────────── -->
            <div class="form-step" id="quote-step-3" hidden>
                <h3 class="form-step-title"><?php e('quote_form.step_corporate'); ?></h3>

                <div class="form-row">
                    <div class="form-group">
                        <label for="step3-company" class="form-label"><?php e('form.company'); ?> <span class="required">*</span></label>
                        <input type="text" id="step3-company" name="company" class="form-input" required placeholder="Şirket Tam Ticari Unvanı" autocomplete="organization">
                        <span class="form-error" id="step3-company-error"></span>
                    </div>

                    <div class="form-group">
                        <label for="step3-city" class="form-label"><?php e('form.city'); ?> <span class="required">*</span></label>
                        <select id="step3-city" name="city" class="form-select" required>
                            <option value=""><?php e('form.select'); ?></option>
                            <option value="İstanbul" selected>İstanbul</option>
                            <option value="Ankara">Ankara</option>
                            <option value="İzmir">İzmir</option>
                            <option value="Bursa">Bursa</option>
                            <option value="Antalya">Antalya</option>
                            <option value="Kocaeli">Kocaeli</option>
                            <option value="Diğer">Diğer</option>
                        </select>
                        <span class="form-error" id="step3-city-error"></span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="step3-sector" class="form-label"><?php e('form.sector'); ?></label>
                        <input type="text" id="step3-sector" name="sector" class="form-input" placeholder="Örn: Bilişim, Lojistik, Üretim">
                    </div>

                    <div class="form-group">
                        <label for="step3-start-date" class="form-label"><?php e('form.start_date'); ?></label>
                        <input type="date" id="step3-start-date" name="start_date" class="form-input">
                    </div>
                </div>

                <div class="form-group">
                    <label for="step3-notes" class="form-label"><?php e('form.description'); ?></label>
                    <textarea id="step3-notes" name="notes" class="form-textarea" rows="3" placeholder="Filonuz veya talebiniz ile ilgili ek açıklamalar..."></textarea>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn btn-secondary btn-step-prev">
                        ← <?php e('quote_form.previous'); ?>
                    </button>
                    <button type="button" class="btn btn-primary btn-step-next">
                        <?php e('quote_form.next'); ?> →
                    </button>
                </div>
            </div>

            <!-- ─── 4. ADIM: Onay ve Özet ────────────────────────────────── -->
            <div class="form-step" id="quote-step-4" hidden>
                <h3 class="form-step-title"><?php e('quote_form.step_confirm'); ?></h3>

                <!-- Talep Özeti Kartı -->
                <div class="card card-body mb-6" style="background-color: var(--color-surface-soft);">
                    <h4 class="text-sm fw-bold mb-3"><?php echo (CURRENT_LANG === 'tr') ? 'Teklif Talebinizin Özeti' : 'Summary of Your Quote Request'; ?></h4>
                    <div class="grid grid-2 gap-3 text-sm">
                        <div>
                            <span class="text-muted">Araç:</span> <strong id="summary-step-vehicle">—</strong>
                        </div>
                        <div>
                            <span class="text-muted">Kira Süresi / Km:</span> <strong id="summary-step-duration">—</strong>
                        </div>
                        <div>
                            <span class="text-muted">Yetkili Kişi:</span> <strong id="summary-step-name">—</strong>
                        </div>
                        <div>
                            <span class="text-muted">Telefon:</span> <strong id="summary-step-phone">—</strong>
                        </div>
                        <div>
                            <span class="text-muted">Şirket:</span> <strong id="summary-step-company">—</strong>
                        </div>
                    </div>
                </div>

                <!-- Onay Checkboxları -->
                <div class="form-group">
                    <label class="form-check">
                        <input type="checkbox" id="step4-kvkk" name="kvkk" required>
                        <span class="form-check-label">
                            <a href="<?php echo url('kvkk.php'); ?>" target="_blank" rel="noopener noreferrer" style="text-decoration: underline;"><?php e('form.kvkk_consent'); ?></a> <span class="required">*</span>
                        </span>
                    </label>
                    <span class="form-error" id="step4-kvkk-error"></span>
                </div>

                <div class="form-group">
                    <label class="form-check">
                        <input type="checkbox" name="marketing">
                        <span class="form-check-label"><?php e('form.marketing_consent'); ?></span>
                    </label>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn btn-secondary btn-step-prev">
                        ← <?php e('quote_form.previous'); ?>
                    </button>
                    <button type="submit" class="btn btn-primary btn-lg">
                        <?php e('quote_form.submit'); ?> ✓
                    </button>
                </div>
            </div>
        </form>

        <!-- ─── BAŞARI EKRANI (FRONTEND PROTOTİP) ─────────────────────── -->
        <div class="card card-body text-center hidden py-16" id="quote-success-view">
            <div style="width: 72px; height: 72px; border-radius: 50%; background-color: var(--color-success-light); color: var(--color-success); display: flex; align-items: center; justify-content: center; margin: 0 auto var(--space-6);">
                <svg viewBox="0 0 24 24" width="40" height="40" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
            </div>
            <h2 class="text-2xl mb-3"><?php e('success.quote_submitted'); ?></h2>
            <p class="text-muted max-w-md mx-auto mb-6">
                <?php echo (CURRENT_LANG === 'tr') ? 'Filo danışmanımız başvurunuzu inceledikten sonra belirttiğiniz iletişim kanalları üzerinden en kısa sürede size özel teklif dosyasıyla dönüş yapacaktır.' : 'Our fleet consultant will review your request and get back to you shortly with a customized quote.'; ?>
            </p>
            <div class="demo-notice mb-8 p-3" style="border-radius: var(--radius-md);">
                ℹ️ <?php e('success.quote_prototype_notice'); ?>
            </div>
            <div class="flex gap-4 justify-center">
                <a href="<?php echo url('index.php'); ?>" class="btn btn-primary"><?php e('error.404_btn'); ?></a>
                <a href="<?php echo url('araclar.php'); ?>" class="btn btn-outline"><?php e('home.hero_cta_vehicles'); ?></a>
            </div>
        </div>
    </div>
</section>

<script src="<?php echo asset('js/quote.js'); ?>"></script>
<script src="<?php echo asset('js/forms.js'); ?>"></script>

<?php include includePath('footer.php'); ?>
