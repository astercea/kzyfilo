<?php
/**
 * kzyfilo — Yüzer İletişim Butonu ve Açılır Menü
 */
if (!defined('ROOT_DIR')) {
    require_once __DIR__ . '/config.php';
}
?>
<div class="floating-contact" id="floating-contact">
    <!-- Pop-up Menu -->
    <div class="floating-contact-menu" id="floating-contact-menu" role="menu" aria-label="<?php e('floating.title'); ?>" aria-hidden="true">
        <div class="floating-contact-menu-title"><?php e('floating.title'); ?></div>
        
        <button type="button" class="floating-contact-link" id="trigger-callback-modal" role="menuitem">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
            </svg>
            <span><?php e('floating.callback'); ?></span>
        </button>

        <a href="https://wa.me/905309198599" target="_blank" rel="noopener noreferrer" class="floating-contact-link" role="menuitem">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
            </svg>
            <span><?php e('floating.whatsapp'); ?></span>
        </a>

        <a href="tel:<?php e('topbar.phone_full'); ?>" class="floating-contact-link" role="menuitem">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect>
                <line x1="12" y1="18" x2="12.01" y2="18"></line>
            </svg>
            <span><?php e('topbar.phone'); ?></span>
        </a>

        <a href="<?php echo url('iletisim.php'); ?>" class="floating-contact-link" role="menuitem">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                <polyline points="22,6 12,13 2,6"></polyline>
            </svg>
            <span><?php e('floating.contact_form'); ?></span>
        </a>

        <a href="<?php echo url('sss.php'); ?>" class="floating-contact-link" role="menuitem">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <circle cx="12" cy="12" r="10"></circle>
                <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                <line x1="12" y1="17" x2="12.01" y2="17"></line>
            </svg>
            <span><?php e('floating.faq'); ?></span>
        </a>
    </div>

    <!-- Toggle Button -->
    <button type="button" class="floating-contact-btn" id="floating-contact-btn" aria-label="<?php e('floating.title'); ?>" aria-expanded="false" aria-controls="floating-contact-menu">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
        </svg>
    </button>
</div>
