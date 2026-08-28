<?php
/**
 * kzyfilo — Mobil Navigasyon Menüsü (Drawer)
 */
if (!defined('ROOT_DIR')) {
    require_once __DIR__ . '/config.php';
}
?>
<!-- Mobile Menu Backdrop -->
<div class="mobile-menu-backdrop" id="mobile-menu-backdrop" aria-hidden="true"></div>

<!-- Mobile Menu Drawer -->
<div class="mobile-menu-drawer" id="mobile-menu" role="dialog" aria-modal="true" aria-label="Mobil Navigasyon" aria-hidden="true">
    <div class="mobile-menu-header">
        <a href="<?php echo url('index.php'); ?>" class="mobile-menu-logo" aria-label="kzyfilo">
            <img src="<?php echo asset('images/logo/kzy-filo-logo.svg'); ?>" alt="kzyfilo" width="140" height="34">
        </a>
        <button type="button" class="mobile-menu-close" id="mobile-menu-close" aria-label="<?php e('btn.close'); ?>">
            <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
    </div>

    <div class="mobile-menu-body">
        <!-- Quick Search Bar Trigger in Mobile Menu -->
        <div class="mobile-menu-search-wrap" style="padding: 12px 20px 4px;">
            <button type="button" class="mobile-search-btn header-search-trigger" style="width: 100%; display: flex; align-items: center; gap: 10px; padding: 10px 14px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12); border-radius: 8px; color: rgba(255,255,255,0.7); font-size: 0.88rem; cursor: pointer;">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <span>Araç veya hizmet ara...</span>
            </button>
        </div>

        <nav class="mobile-nav" aria-label="Mobil Menü Bağlantıları">
            <a href="<?php echo url('index.php'); ?>" class="mobile-nav-link<?php echo activeClass('index.php'); ?>">
                <?php e('header.home'); ?>
            </a>
            <a href="<?php echo url('araclar.php'); ?>" class="mobile-nav-link<?php echo activeClass('araclar.php'); ?>">
                <?php e('header.vehicles'); ?>
            </a>

            <!-- Çözümlerimiz Accordion -->
            <div class="mobile-nav-accordion">
                <button type="button" class="mobile-nav-accordion-btn" aria-expanded="false">
                    <span><?php e('header.solutions'); ?></span>
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="mobile-nav-accordion-content" hidden>
                    <a href="<?php echo url('uzun-donem-arac-kiralama.php'); ?>"><?php e('solutions_menu.long_term_rental'); ?></a>
                    <a href="<?php echo url('filo-yonetimi.php'); ?>"><?php e('solutions_menu.fleet_management'); ?></a>
                    <a href="<?php echo url('binek-arac-kiralama.php'); ?>"><?php e('solutions_menu.passenger_rental'); ?></a>
                    <a href="<?php echo url('ticari-arac-kiralama.php'); ?>"><?php e('solutions_menu.commercial_rental'); ?></a>
                    <a href="<?php echo url('elektrikli-arac-kiralama.php'); ?>"><?php e('solutions_menu.electric_rental'); ?></a>
                    <a href="<?php echo url('ek-urun-ve-hizmetler.php'); ?>"><?php e('solutions_menu.additional_services'); ?></a>
                    <a href="<?php echo url('online-islemler.php'); ?>"><?php e('solutions_menu.online_operations'); ?></a>
                    <a href="<?php echo url('arac-teslim-ve-iade.php'); ?>"><?php e('solutions_menu.delivery_return'); ?></a>
                </div>
            </div>

            <a href="<?php echo url('hakkimizda.php'); ?>" class="mobile-nav-link<?php echo activeClass('hakkimizda.php'); ?>">
                <?php e('header.about'); ?>
            </a>

            <!-- Kaynaklar Accordion -->
            <div class="mobile-nav-accordion">
                <button type="button" class="mobile-nav-accordion-btn" aria-expanded="false">
                    <span><?php e('header.resources'); ?></span>
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </button>
                <div class="mobile-nav-accordion-content" hidden>
                    <a href="<?php echo url('blog.php'); ?>"><?php e('resources_menu.blog'); ?></a>
                    <a href="<?php echo url('haberler.php'); ?>"><?php e('resources_menu.news'); ?></a>
                    <a href="<?php echo url('sss.php'); ?>"><?php e('resources_menu.faq'); ?></a>
                </div>
            </div>

            <a href="<?php echo url('iletisim.php'); ?>" class="mobile-nav-link<?php echo activeClass('iletisim.php'); ?>">
                <?php e('header.contact'); ?>
            </a>
            <a href="<?php echo url('listem.php'); ?>" class="mobile-nav-link<?php echo activeClass('listem.php'); ?>">
                <?php e('header.my_list'); ?>
            </a>
        </nav>

        <div class="mobile-menu-cta">
            <a href="<?php echo url('hizli-teklif.php'); ?>" class="btn btn-primary" style="width: 100%;">
                <?php e('header.get_quote'); ?>
            </a>
        </div>

        <div class="mobile-menu-contact">
            <a href="tel:<?php e('topbar.phone_full'); ?>" class="mobile-contact-item">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                </svg>
                <span><?php e('topbar.phone'); ?></span>
            </a>
            <a href="mailto:<?php e('topbar.email'); ?>" class="mobile-contact-item">
                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                    <polyline points="22,6 12,13 2,6"></polyline>
                </svg>
                <span><?php e('topbar.email'); ?></span>
            </a>
        </div>
    </div>
</div>
