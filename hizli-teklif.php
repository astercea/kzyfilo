<?php
/**
 * kzyfilo — Hızlı Teklif Formu (hizli-teklif.php)
 * KZY Executive Multi-Step Fleet Quote Configurator
 */
require_once __DIR__ . '/includes/config.php';

$vehicles = loadData('vehicles.php');
$packages = loadData('packages.php');

$selectedSlug = $_GET['arac'] ?? ($vehicles[0]['slug'] ?? '');

// Seçili aracı bul
$currentVehicle = null;
foreach ($vehicles as $v) {
    if ($v['slug'] === $selectedSlug) {
        $currentVehicle = $v;
        break;
    }
}
if (!$currentVehicle && !empty($vehicles)) {
    $currentVehicle = $vehicles[0];
}

setPageMeta([
    'title' => t('quote_form.quick_title') . ' | ' . SITE_NAME,
    'description' => 'Şirketinize en uygun binek, ticari veya elektrikli filo kiralama teklifini 4 adımda dakikalar içinde oluşturun.',
    'canonical' => canonical('hizli-teklif.php'),
]);

$breadcrumbs = [
    ['title' => t('quote_form.quick_title')]
];

include includePath('header.php');?>

<!-- ─── 1. PAGE HEADER ─────────────────────────────────────────────── -->
<div class="page-header">
    <div class="container">
        <h1><?php e('quote_form.quick_title'); ?></h1>
        <?php include includePath('breadcrumbs.php'); ?>
    </div>
</div>

<section class="section section-ivory" style="position: relative; z-index: 10;">
    <div class="container">
        <div class="quote-layout-grid">
            
            <!-- ─── SOL: ÇOK ADIMLI TEKLİF SİHİRBAZI ──────────────────────── -->
            <div>
                <div class="quote-wizard-card">
                    <!-- İlerleme Çubuğu -->
                    <div class="progress-steps">
                        <div class="progress-step is-active" data-step="0">
                            <span class="progress-step-number">1</span>
                            <span>Araç & Kiralama</span>
                        </div>
                        <div class="progress-step-connector"></div>
                        <div class="progress-step" data-step="1">
                            <span class="progress-step-number">2</span>
                            <span>Yetkili Bilgileri</span>
                        </div>
                        <div class="progress-step-connector"></div>
                        <div class="progress-step" data-step="2">
                            <span class="progress-step-number">3</span>
                            <span>Şirket Bilgileri</span>
                        </div>
                        <div class="progress-step-connector"></div>
                        <div class="progress-step" data-step="3">
                            <span class="progress-step-number">4</span>
                            <span>Onay & Gönder</span>
                        </div>
                    </div>

                    <!-- Form -->
                    <form id="multi-step-quote-form" novalidate>
                        
                        <!-- ─── 1. ADIM: Araç ve Kiralama Bilgileri ──────────────────── -->
                        <div class="form-step is-active" id="quote-step-1">
                            <h2 class="form-step-title">Araç ve Kiralama Tercihleri</h2>

                            <!-- Araç Seçimi -->
                            <div class="form-group mb-6">
                                <label for="step1-vehicle" class="form-label">
                                    Kiralamak İstediğiniz Araç Modeli <span class="required">*</span>
                                </label>
                                <select id="step1-vehicle" name="selected_vehicle" class="form-select" required style="font-weight: 600; font-size: 1.05rem; padding: 12px 16px;">
                                    <option value="">Lütfen Bir Araç Seçiniz</option>
                                    <?php foreach ($vehicles as $v): ?>
                                        <option value="<?php echo esc($v['slug']); ?>" 
                                                data-brand="<?php echo esc($v['brand']); ?>"
                                                data-model="<?php echo esc($v['model']); ?>"
                                                data-version="<?php echo esc($v['version']); ?>"
                                                data-img="<?php echo esc($v['image']); ?>"
                                                data-price="<?php echo esc(number_format($v['starting_price'], 0, ',', '.')); ?>"
                                                <?php echo ($selectedSlug === $v['slug']) ? 'selected' : ''; ?>>
                                            <?php echo esc($v['brand'] . ' ' . $v['model'] . ' (' . $v['version'] . ') — ' . number_format($v['starting_price'], 0, ',', '.') . ' ₺/ay'); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="form-error" id="step1-vehicle-error"></span>
                            </div>

                            <!-- Kiralama Süresi (Görsel Kartlar) -->
                            <div class="form-group mb-6">
                                <label class="form-label">Kiralama Süresi <span class="required">*</span></label>
                                <div class="option-cards-grid">
                                    <label class="option-card-label">
                                        <input type="radio" name="duration" value="12">
                                        <div class="option-card-content">
                                            <div class="option-card-title">12 Ay</div>
                                            <div class="option-card-sub">Kısa Dönem</div>
                                        </div>
                                    </label>
                                    <label class="option-card-label">
                                        <input type="radio" name="duration" value="24">
                                        <div class="option-card-content">
                                            <div class="option-card-title">24 Ay</div>
                                            <div class="option-card-sub">Standart</div>
                                        </div>
                                    </label>
                                    <label class="option-card-label">
                                        <input type="radio" name="duration" value="36" checked>
                                        <div class="option-card-content">
                                            <div class="option-card-title">36 Ay</div>
                                            <div class="option-card-sub">En Popüler</div>
                                        </div>
                                    </label>
                                    <label class="option-card-label">
                                        <input type="radio" name="duration" value="48">
                                        <div class="option-card-content">
                                            <div class="option-card-title">48 Ay</div>
                                            <div class="option-card-sub">En Avantajlı</div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- Yıllık Kilometre Limiti (Görsel Kartlar) -->
                            <div class="form-group mb-6">
                                <label class="form-label">Yıllık Kilometre Limiti <span class="required">*</span></label>
                                <div class="option-cards-grid">
                                    <label class="option-card-label">
                                        <input type="radio" name="annual_km" value="15" checked>
                                        <div class="option-card-content">
                                            <div class="option-card-title">15.000 km</div>
                                            <div class="option-card-sub">Şehir İçi</div>
                                        </div>
                                    </label>
                                    <label class="option-card-label">
                                        <input type="radio" name="annual_km" value="20">
                                        <div class="option-card-content">
                                            <div class="option-card-title">20.000 km</div>
                                            <div class="option-card-sub">Standart</div>
                                        </div>
                                    </label>
                                    <label class="option-card-label">
                                        <input type="radio" name="annual_km" value="30">
                                        <div class="option-card-content">
                                            <div class="option-card-title">30.000 km</div>
                                            <div class="option-card-sub">Yoğun Kullanım</div>
                                        </div>
                                    </label>
                                    <label class="option-card-label">
                                        <input type="radio" name="annual_km" value="45">
                                        <div class="option-card-content">
                                            <div class="option-card-title">45.000 km+</div>
                                            <div class="option-card-sub">Saha & Filo</div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- Paket ve Araç Sayısı -->
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Hizmet & Güvence Paketi</label>
                                    <select name="package" class="form-select">
                                        <option value="basic">Başlangıç Paketi (Kasko + Bakım)</option>
                                        <option value="advantage" selected>Avantaj Paketi (Önerilen - Lastik + İkame)</option>
                                        <option value="full">Tam Güvence Paketi (Full Kapsamlı Mobilite)</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Talep Edilen Araç Adedi <span class="required">*</span></label>
                                    <select name="vehicle_count" class="form-select" required>
                                        <option value="1" selected>1 Adet Araç</option>
                                        <option value="2">2 Adet Araç</option>
                                        <option value="3">3 Adet Araç</option>
                                        <option value="5">5 Adet Araç</option>
                                        <option value="10">10+ Adet (Kurumsal Filo)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-actions mt-8" style="display: flex; justify-content: flex-end;">
                                <button type="button" class="btn btn-primary btn-lg btn-step-next" style="padding: 14px 36px;">
                                    Sonraki Adım
                                </button>
                            </div>
                        </div>

                        <!-- ─── 2. ADIM: Yetkili & İletişim Bilgileri ───────────────── -->
                        <div class="form-step" id="quote-step-2" hidden>
                            <h2 class="form-step-title">Yetkili & İletişim Bilgileri</h2>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="step2-name" class="form-label"><?php e('form.name'); ?> <span class="required">*</span></label>
                                    <input type="text" id="step2-name" name="name" class="form-input" required placeholder="Adınız" autocomplete="given-name">
                                    <span class="form-error" id="step2-name-error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="step2-surname" class="form-label"><?php e('form.surname'); ?> <span class="required">*</span></label>
                                    <input type="text" id="step2-surname" name="surname" class="form-input" required placeholder="Soyadınız" autocomplete="family-name">
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
                                    <label for="step2-email" class="form-label">Kurumsal E-posta Adresi <span class="required">*</span></label>
                                    <input type="email" id="step2-email" name="email" class="form-input" required placeholder="adiniz@sirketiniz.com" autocomplete="email">
                                    <span class="form-error" id="step2-email-error"></span>
                                </div>
                            </div>

                            <div class="form-actions mt-8" style="display: flex; justify-content: space-between; align-items: center;">
                                <button type="button" class="btn btn-secondary btn-step-prev">
                                    Önceki Adım
                                </button>
                                <button type="button" class="btn btn-primary btn-lg btn-step-next" style="padding: 14px 36px;">
                                    Sonraki Adım
                                </button>
                            </div>
                        </div>

                        <!-- ─── 3. ADIM: Kurumsal Şirket Bilgileri ──────────────────── -->
                        <div class="form-step" id="quote-step-3" hidden>
                            <h2 class="form-step-title">Kurumsal Şirket Bilgileri</h2>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="step3-company" class="form-label">Şirket Ticari Unvanı <span class="required">*</span></label>
                                    <input type="text" id="step3-company" name="company" class="form-input" required placeholder="Örn: ABC Lojistik ve Ticaret A.Ş." autocomplete="organization">
                                    <span class="form-error" id="step3-company-error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="step3-city" class="form-label">Faaliyet Şehri <span class="required">*</span></label>
                                    <select id="step3-city" name="city" class="form-select" required>
                                        <option value="">Lütfen Şehir Seçiniz</option>
                                        <option value="İstanbul" selected>İstanbul</option>
                                        <option value="Ankara">Ankara</option>
                                        <option value="İzmir">İzmir</option>
                                        <option value="Bursa">Bursa</option>
                                        <option value="Antalya">Antalya</option>
                                        <option value="Kocaeli">Kocaeli</option>
                                        <option value="Gaziantep">Gaziantep</option>
                                        <option value="Diğer">Diğer İller</option>
                                    </select>
                                    <span class="form-error" id="step3-city-error"></span>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="step3-sector" class="form-label">Faaliyet Gösterilen Sektör</label>
                                    <input type="text" id="step3-sector" name="sector" class="form-input" placeholder="Örn: Bilişim, Sağlık, Perakende, Üretim">
                                </div>

                                <div class="form-group">
                                    <label for="step3-start-date-display" class="form-label">Talep Edilen Başlangıç Tarihi</label>
                                    <div class="custom-datepicker" id="kzy-start-datepicker">
                                        <div class="custom-datepicker-input-group">
                                            <input type="text" 
                                                   id="step3-start-date-display" 
                                                   class="form-input custom-datepicker-input" 
                                                   placeholder="Tarih seçiniz (Örn: 15.09.2026)" 
                                                   readonly 
                                                   autocomplete="off">
                                            <input type="hidden" id="step3-start-date" name="start_date" value="">
                                            <button type="button" class="custom-datepicker-toggle-btn" aria-label="Takvimi Aç" tabindex="-1">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                                </svg>
                                            </button>
                                        </div>

                                        <!-- Açılır Takvim Menüsü (Simgenin / Input'un Tam Altında) -->
                                        <div class="custom-datepicker-dropdown" id="kzy-datepicker-popup" hidden>
                                            <div class="datepicker-header">
                                                <button type="button" class="datepicker-nav-btn datepicker-prev" aria-label="Önceki Ay">
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"></polyline></svg>
                                                </button>
                                                <div class="datepicker-month-year">
                                                    <span class="datepicker-month-name">Ağustos</span>
                                                    <span class="datepicker-year-name">2026</span>
                                                </div>
                                                <button type="button" class="datepicker-nav-btn datepicker-next" aria-label="Sonraki Ay">
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                                </button>
                                            </div>

                                            <!-- Hafta Günleri -->
                                            <div class="datepicker-weekdays">
                                                <span>Pt</span><span>Sa</span><span>Ça</span><span>Pe</span><span>Cu</span><span>Ct</span><span>Pz</span>
                                            </div>

                                            <!-- Gün Izgarası -->
                                            <div class="datepicker-days-grid"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="step3-notes" class="form-label">Filonuzla İlgili Ek Talepler veya Notlar</label>
                                <textarea id="step3-notes" name="notes" class="form-textarea" rows="3" placeholder="Logo giydirme, özel teslimat lokasyonları veya filo tercihlerinizi belirtebilirsiniz..."></textarea>
                            </div>

                            <div class="form-actions mt-8" style="display: flex; justify-content: space-between; align-items: center;">
                                <button type="button" class="btn btn-secondary btn-step-prev">
                                    Önceki Adım
                                </button>
                                <button type="button" class="btn btn-primary btn-lg btn-step-next" style="padding: 14px 36px;">
                                    Sonraki Adım
                                </button>
                            </div>
                        </div>

                        <!-- ─── 4. ADIM: Onay ve Özet ────────────────────────────────── -->
                        <div class="form-step" id="quote-step-4" hidden>
                            <h2 class="form-step-title">Talep Özeti ve Başvuru Onayı</h2>

                            <!-- Şık ve Sade Talep Özeti Kartı -->
                            <div class="quote-summary-card">
                                <div class="quote-summary-card-header">
                                    <div class="quote-summary-card-header-left">
                                        <div class="quote-summary-header-icon">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                                <polyline points="14 2 14 8 20 8"></polyline>
                                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                                <polyline points="10 9 9 9 8 9"></polyline>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="quote-summary-card-title">Özet Bilgileriniz</h3>
                                            <p class="quote-summary-card-subtitle">Başvurunuzu onaylamadan önce iletişim ve şirket bilgilerinizi kontrol ediniz.</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="quote-summary-edit-btn" data-goto-step="1" title="Bilgileri Düzenle">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                            Düzenle
                                        </button>
                                    </div>
                                </div>

                                <div class="quote-summary-card-body">
                                    <div class="quote-summary-fields-grid">
                                        <div class="quote-summary-field-item">
                                            <span class="quote-summary-field-label">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                                Yetkili Adı Soyadı
                                            </span>
                                            <strong class="quote-summary-field-val" id="summary-step-name">—</strong>
                                        </div>

                                        <div class="quote-summary-field-item">
                                            <span class="quote-summary-field-label">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                                                İletişim Telefonu
                                            </span>
                                            <strong class="quote-summary-field-val" id="summary-step-phone">—</strong>
                                        </div>

                                        <div class="quote-summary-field-item">
                                            <span class="quote-summary-field-label">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                                Kurumsal E-posta
                                            </span>
                                            <strong class="quote-summary-field-val" id="summary-step-email">—</strong>
                                        </div>

                                        <div class="quote-summary-field-item">
                                            <span class="quote-summary-field-label">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                                                Şirket Ticari Unvanı
                                            </span>
                                            <strong class="quote-summary-field-val" id="summary-step-company">—</strong>
                                        </div>

                                        <div class="quote-summary-field-item">
                                            <span class="quote-summary-field-label">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                                Faaliyet Şehri
                                            </span>
                                            <strong class="quote-summary-field-val" id="summary-step-city">İstanbul</strong>
                                        </div>

                                        <div class="quote-summary-field-item">
                                            <span class="quote-summary-field-label">
                                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                                Talep Başlangıç Tarihi
                                            </span>
                                            <strong class="quote-summary-field-val" id="summary-step-startdate">Hemen / İlk Müsaitlik</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Onay Checkboxları -->
                            <div class="form-group mb-4">
                                <label class="form-check" style="display: flex; align-items: flex-start; gap: 10px; cursor: pointer;">
                                    <input type="checkbox" id="step4-kvkk" name="kvkk" required style="margin-top: 3px;">
                                    <span class="form-check-label text-sm" style="color: var(--color-text-muted); line-height: 1.5;">
                                        <a href="<?php echo url('kvkk.php'); ?>" target="_blank" rel="noopener noreferrer" style="color: #121822; text-decoration: underline; font-weight: 600;">KVKK Aydınlatma Metni</a>'ni okudum, kişisel verilerimin teklif oluşturma amacıyla işlenmesini onaylıyorum. <span class="required">*</span>
                                    </span>
                                </label>
                                <span class="form-error" id="step4-kvkk-error"></span>
                            </div>

                            <div class="form-group mb-6">
                                <label class="form-check" style="display: flex; align-items: flex-start; gap: 10px; cursor: pointer;">
                                    <input type="checkbox" name="marketing" style="margin-top: 3px;">
                                    <span class="form-check-label text-sm" style="color: var(--color-text-muted); line-height: 1.5;">
                                        Kzy Filo'nun kurumsal filo kampanyaları ve avantajlı fiyat teklifleri hakkında ticari elektronik ileti almayı kabul ediyorum.
                                    </span>
                                </label>
                            </div>

                            <div class="form-actions mt-8" style="display: flex; justify-content: space-between; align-items: center;">
                                <button type="button" class="btn btn-secondary btn-step-prev">
                                    Önceki Adım
                                </button>
                                <button type="submit" class="btn btn-primary btn-lg" style="padding: 14px 42px;">
                                    Teklif Talebini Gönder
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- ─── BAŞARI EKRANI (PROTOTİP) ───────────────────────── -->
                    <div class="text-center hidden py-12" id="quote-success-view">
                        <div style="width: 72px; height: 72px; border-radius: 50%; background-color: rgba(13, 122, 70, 0.1); color: #0d7a46; display: flex; align-items: center; justify-content: center; margin: 0 auto var(--space-6);">
                            <svg viewBox="0 0 24 24" width="38" height="38" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <h2 class="text-2xl fw-bold text-dark mb-3">Teklif Talebiniz Başarıyla Alındı</h2>
                        <p class="text-muted max-w-md mx-auto mb-6" style="line-height: 1.65;">
                            Kurumsal filo danışmanımız başvurunuzu inceledikten sonra belirttiğiniz iletişim kanalları üzerinden <strong>15 dakika içinde</strong> size özel teklif dosyasıyla dönüş yapacaktır.
                        </p>
                        <div class="flex gap-4 justify-center mt-8">
                            <a href="<?php echo url('index.php'); ?>" class="btn btn-primary">Ana Sayfaya Dön</a>
                            <a href="<?php echo url('araclar.php'); ?>" class="btn btn-outline">Diğer Araçları İncele</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ─── SAĞ: CANLI ÖZET & GÜVENCE KENAR ÇUBUĞU ──────────────── -->
            <aside>
                <div class="quote-sidebar-card">
                    <div class="mb-3">
                        <div class="sidebar-vehicle-top-title" id="sidebar-vehicle-title">
                            <?php echo esc(($currentVehicle['brand'] ?? 'Renault') . ' ' . ($currentVehicle['model'] ?? 'Clio')); ?>
                        </div>
                    </div>

                    <!-- Seçili Araç Görsel Önizlemesi (Kutuya Tam Sığdırılmış, Metinsiz) -->
                    <div class="sidebar-vehicle-preview" id="sidebar-preview-box">
                        <img src="<?php echo esc($currentVehicle['image'] ?? asset('images/vehicles/renault-clio.jpg')); ?>" 
                             id="sidebar-vehicle-img" 
                             alt="<?php echo esc($currentVehicle['brand'] ?? 'Araç'); ?>" 
                             class="sidebar-vehicle-img">
                    </div>

                    <!-- Seçim Parametreleri Listesi -->
                    <div class="sidebar-specs-list">
                        <div class="sidebar-spec-row">
                            <span>Kiralama Süresi:</span>
                            <strong id="sidebar-spec-duration">36 Ay</strong>
                        </div>
                        <div class="sidebar-spec-row">
                            <span>Yıllık Kilometre:</span>
                            <strong id="sidebar-spec-km">15.000 km</strong>
                        </div>
                        <div class="sidebar-spec-row">
                            <span>Araç Adedi:</span>
                            <strong id="sidebar-spec-count">1 Adet</strong>
                        </div>
                    </div>

                    <!-- Standart Kurumsal Avantajlar -->
                    <div class="sidebar-benefits">
                        <div class="sidebar-benefit-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                            </svg>
                            <div><strong>Tam Kasko & Trafik:</strong> Sıfır riskli kurumsal sigorta teminatı</div>
                        </div>
                        <div class="sidebar-benefit-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            <div><strong>7/24 Kesintisiz İkame:</strong> Arıza durumunda derhal muadil araç</div>
                        </div>
                        <div class="sidebar-benefit-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                            <div><strong>Yetkili Servis Bakımı:</strong> Periyodik bakım ve lastik yönetimi</div>
                        </div>
                    </div>

                    <!-- Danışman İletişim Kutusu (Yeniden Tasarlandı) -->
                    <a href="tel:<?php echo preg_replace('/[^0-9]/', '', t('topbar.phone_full') ?: '08503005999'); ?>" class="sidebar-contact-card mt-4" title="Filo Danışmanını Ara">
                        <div class="sidebar-contact-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                            </svg>
                        </div>
                        <div class="sidebar-contact-info">
                            <span class="sidebar-contact-label">Kurumsal Danışma Hattı</span>
                            <strong class="sidebar-contact-phone"><?php e('topbar.phone'); ?></strong>
                        </div>
                    </a>
                </div>
            </aside>
        </div>
    </div>
</section>

<!-- ─── JAVASCRIPT YÖNETİMİ ─────────────────────────────────────────── -->
<script src="<?php echo asset('js/quote.js'); ?>"></script>
<script src="<?php echo asset('js/forms.js'); ?>"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const vehicleSelect = document.getElementById('step1-vehicle');
    const sidebarImg = document.getElementById('sidebar-vehicle-img');
    const sidebarTitle = document.getElementById('sidebar-vehicle-title');
    const sidebarVersion = document.getElementById('sidebar-vehicle-version');
    const sidebarDuration = document.getElementById('sidebar-spec-duration');
    const sidebarKm = document.getElementById('sidebar-spec-km');
    const sidebarCount = document.getElementById('sidebar-spec-count');
    const countSelect = document.querySelector('select[name="vehicle_count"]');

    function updateSidebarVehicle() {
        if (!vehicleSelect) return;
        const selectedOpt = vehicleSelect.options[vehicleSelect.selectedIndex];
        if (selectedOpt && selectedOpt.value) {
            const brand = selectedOpt.getAttribute('data-brand') || '';
            const model = selectedOpt.getAttribute('data-model') || '';
            const version = selectedOpt.getAttribute('data-version') || '';
            const img = selectedOpt.getAttribute('data-img') || '';

            if (sidebarTitle) sidebarTitle.textContent = brand + ' ' + model;
            if (sidebarVersion) sidebarVersion.textContent = version;
            if (sidebarImg && img) sidebarImg.src = img;
        }
    }

    function updateSidebarParams() {
        const durRadio = document.querySelector('input[name="duration"]:checked');
        const kmRadio = document.querySelector('input[name="annual_km"]:checked');
        
        if (durRadio && sidebarDuration) {
            sidebarDuration.textContent = durRadio.value + ' Ay';
        }
        if (kmRadio && sidebarKm) {
            sidebarKm.textContent = kmRadio.value + '.000 km';
        }
        if (countSelect && sidebarCount) {
            sidebarCount.textContent = countSelect.value + ' Adet';
        }
    }

    if (vehicleSelect) {
        vehicleSelect.addEventListener('change', updateSidebarVehicle);
    }

    document.querySelectorAll('input[name="duration"], input[name="annual_km"]').forEach(function(radio) {
        radio.addEventListener('change', updateSidebarParams);
    });

    if (countSelect) {
        countSelect.addEventListener('change', updateSidebarParams);
    }

    // İlk yükleme
    updateSidebarVehicle();
    updateSidebarParams();
});
</script>

<?php include includePath('footer.php'); ?>
