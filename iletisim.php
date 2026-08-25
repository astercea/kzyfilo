<?php
/**
 * kzyfilo — İletişim Sayfası (iletisim.php)
 */
require_once __DIR__ . '/includes/config.php';

setPageMeta([
    'title' => t('contact.title') . ' | ' . SITE_NAME,
    'description' => t('contact.description'),
    'canonical' => canonical('iletisim.php'),
]);

$breadcrumbs = [
    ['title' => t('contact.title')]
];

include includePath('header.php');?>

<div class="page-header">
    <div class="container">
        <h1><?php e('contact.title'); ?></h1>
        <?php include includePath('breadcrumbs.php'); ?>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="layout-sidebar-right" data-reveal="fade-up">
            
            <!-- ─── Sol: İletişim Formu ────────────────────────────────── -->
            <div>
                <div class="card card-body">
                    <h2 class="text-2xl mb-6"><?php e('contact.form_title'); ?></h2>
                    <form id="contact-page-form" novalidate>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="c-name" class="form-label"><?php e('form.name'); ?> <span class="required">*</span></label>
                                <input type="text" id="c-name" name="name" class="form-input" required autocomplete="given-name">
                            </div>
                            <div class="form-group">
                                <label for="c-surname" class="form-label"><?php e('form.surname'); ?> <span class="required">*</span></label>
                                <input type="text" id="c-surname" name="surname" class="form-input" required autocomplete="family-name">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="c-phone" class="form-label"><?php e('form.phone'); ?> <span class="required">*</span></label>
                                <input type="tel" id="c-phone" name="phone" class="form-input" required placeholder="05XX XXX XX XX" autocomplete="tel">
                            </div>
                            <div class="form-group">
                                <label for="c-email" class="form-label"><?php e('form.email'); ?> <span class="required">*</span></label>
                                <input type="email" id="c-email" name="email" class="form-input" required placeholder="ornek@sirket.com" autocomplete="email">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="c-company" class="form-label"><?php e('form.company'); ?></label>
                            <input type="text" id="c-company" name="company" class="form-input" placeholder="Şirket Adı (Opsiyonel)">
                        </div>

                        <div class="form-group">
                            <label for="c-subject" class="form-label"><?php echo (CURRENT_LANG === 'tr') ? 'Konu' : 'Subject'; ?> <span class="required">*</span></label>
                            <select id="c-subject" name="subject" class="form-select" required>
                                <option value="quote"><?php echo (CURRENT_LANG === 'tr') ? 'Kurumsal Kiralama Teklifi' : 'Corporate Leasing Quote'; ?></option>
                                <option value="fleet"><?php echo (CURRENT_LANG === 'tr') ? 'Filo Yönetimi Danışmanlığı' : 'Fleet Management Consulting'; ?></option>
                                <option value="operations"><?php echo (CURRENT_LANG === 'tr') ? 'Mevcut Araç & Operasyonel Talep' : 'Existing Vehicle & Operational Request'; ?></option>
                                <option value="other"><?php echo (CURRENT_LANG === 'tr') ? 'Diğer Konular' : 'Other Inquiries'; ?></option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="c-message" class="form-label"><?php e('form.description'); ?> <span class="required">*</span></label>
                            <textarea id="c-message" name="message" class="form-textarea" rows="4" required placeholder="Mesajınızı buraya yazınız..."></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-check">
                                <input type="checkbox" id="c-kvkk" name="kvkk" required>
                                <span class="form-check-label">
                                    <a href="<?php echo url('kvkk.php'); ?>" target="_blank" rel="noopener noreferrer" style="text-decoration: underline;"><?php e('form.kvkk_consent'); ?></a> <span class="required">*</span>
                                </span>
                            </label>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">
                                <?php e('form.send'); ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- ─── Sağ: Gerçek İletişim Bilgileri Kartı ───────────────── -->
            <aside>
                <div class="card card-body flex flex-col gap-6">
                    <h3 class="text-xl"><?php e('footer.contact_info'); ?></h3>

                    <!-- Telefon -->
                    <div class="flex gap-3 items-start">
                        <div style="width: 40px; height: 40px; border-radius: 8px; background-color: var(--color-primary-light); color: var(--color-primary); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                        </div>
                        <div>
                            <span class="text-xs text-muted fw-semibold uppercase"><?php e('topbar.phone'); ?></span>
                            <div class="text-lg fw-bold"><a href="tel:<?php e('topbar.phone_full'); ?>"><?php e('topbar.phone'); ?></a></div>
                            <div class="text-sm text-muted"><a href="tel:+905309198599"><?php e('topbar.mobile'); ?></a></div>
                        </div>
                    </div>

                    <!-- E-posta -->
                    <div class="flex gap-3 items-start">
                        <div style="width: 40px; height: 40px; border-radius: 8px; background-color: var(--color-primary-light); color: var(--color-primary); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        </div>
                        <div>
                            <span class="text-xs text-muted fw-semibold uppercase"><?php e('contact.email_title'); ?></span>
                            <div class="text-base fw-bold"><a href="mailto:<?php e('topbar.email'); ?>"><?php e('topbar.email'); ?></a></div>
                        </div>
                    </div>

                    <!-- Adres -->
                    <div class="flex gap-3 items-start">
                        <div style="width: 40px; height: 40px; border-radius: 8px; background-color: var(--color-primary-light); color: var(--color-primary); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        </div>
                        <div>
                            <span class="text-xs text-muted fw-semibold uppercase"><?php e('contact.address_title'); ?></span>
                            <p class="text-sm text-dark mb-0"><?php e('footer.address'); ?></p>
                        </div>
                    </div>

                    <!-- WhatsApp CTA -->
                    <div class="pt-4" style="border-top: 1px solid var(--color-border-light);">
                        <a href="https://wa.me/905309198599" target="_blank" rel="noopener noreferrer" class="btn btn-secondary" style="width: 100%; border-color: var(--color-success); color: var(--color-success);">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                            <span><?php e('contact.whatsapp'); ?></span>
                        </a>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

<script>
    document.getElementById('contact-page-form').addEventListener('submit', function(e) {
        e.preventDefault();
        // TODO: Backend API iletişimi
        window.showToast('Mesajınız başarıyla iletildi. (Frontend Prototip)', 'success', 5000);
        this.reset();
    });
</script>

<?php include includePath('footer.php'); ?>
