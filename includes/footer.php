<?php
/**
 * kzyfilo — Footer Bileşeni
 */
if (!defined('ROOT_DIR')) {
    require_once __DIR__ . '/config.php';
}
?>
        </main><!-- /#main-content -->

        <!-- ─── Footer ─────────────────────────────────────────────── -->
        <footer class="site-footer">
            <div class="container">
                <!-- ── Top Tier: 4 Columns ── -->
                <div class="footer-columns">
                    <!-- Column 1: Sayfalar -->
                    <div class="footer-col">
                        <h4 class="footer-col-title"><?php echo (CURRENT_LANG === 'tr') ? 'Sayfalar' : 'Pages'; ?></h4>
                        <ul class="footer-nav-list">
                            <li><a href="<?php echo url('index.php'); ?>"><?php echo (CURRENT_LANG === 'tr') ? 'Ana Sayfa' : 'Home'; ?></a></li>
                            <li><a href="<?php echo url('hakkimizda.php'); ?>"><?php echo (CURRENT_LANG === 'tr') ? 'Hakkımızda' : 'About Us'; ?></a></li>
                            <li><a href="<?php echo url('araclar.php'); ?>"><?php echo (CURRENT_LANG === 'tr') ? 'Araç Filomuz' : 'Our Fleet'; ?></a></li>
                            <li><a href="<?php echo url('iletisim.php'); ?>"><?php echo (CURRENT_LANG === 'tr') ? 'İletişim' : 'Contact Us'; ?></a></li>
                            <li><a href="<?php echo url('hizli-teklif.php'); ?>"><?php echo (CURRENT_LANG === 'tr') ? 'Hızlı Teklif' : 'Quick Quote'; ?></a></li>
                        </ul>
                    </div>

                    <!-- Column 2: Çözümlerimiz -->
                    <div class="footer-col">
                        <h4 class="footer-col-title"><?php echo (CURRENT_LANG === 'tr') ? 'Çözümlerimiz' : 'Solutions'; ?></h4>
                        <ul class="footer-nav-list">
                            <li><a href="<?php echo url('uzun-donem-arac-kiralama.php'); ?>"><?php e('solutions_menu.long_term_rental'); ?></a></li>
                            <li><a href="<?php echo url('filo-yonetimi.php'); ?>"><?php e('solutions_menu.fleet_management'); ?></a></li>
                            <li><a href="<?php echo url('binek-arac-kiralama.php'); ?>"><?php e('solutions_menu.passenger_rental'); ?></a></li>
                            <li><a href="<?php echo url('ticari-arac-kiralama.php'); ?>"><?php e('solutions_menu.commercial_rental'); ?></a></li>
                            <li><a href="<?php echo url('elektrikli-arac-kiralama.php'); ?>"><?php e('solutions_menu.electric_rental'); ?></a></li>
                            <li><a href="<?php echo url('ek-urun-ve-hizmetler.php'); ?>"><?php e('solutions_menu.additional_services'); ?></a></li>
                        </ul>
                    </div>

                    <!-- Column 3: Kurumsal & Rehber -->
                    <div class="footer-col">
                        <h4 class="footer-col-title"><?php echo (CURRENT_LANG === 'tr') ? 'Kurumsal & Rehber' : 'Corporate'; ?></h4>
                        <ul class="footer-nav-list">
                            <li><a href="<?php echo url('referanslar.php'); ?>"><?php e('references.title'); ?></a></li>
                            <li><a href="<?php echo url('ofisler.php'); ?>"><?php e('offices.title'); ?></a></li>
                            <li><a href="<?php echo url('sss.php'); ?>"><?php e('resources_menu.faq'); ?></a></li>
                            <li><a href="<?php echo url('blog.php'); ?>"><?php e('resources_menu.blog'); ?></a></li>
                            <li><a href="<?php echo url('arac-karsilastir.php'); ?>"><?php e('compare.compare_vehicles'); ?></a></li>
                            <li><a href="<?php echo url('kvkk.php'); ?>"><?php e('footer.kvkk'); ?></a></li>
                        </ul>
                    </div>

                    <!-- Column 4: İletişim / Get In Touch -->
                    <div class="footer-col">
                        <h4 class="footer-col-title"><?php echo (CURRENT_LANG === 'tr') ? 'İletişim' : 'Get In Touch'; ?></h4>
                        <div class="footer-contact-block">
                            <p class="footer-contact-line"><a href="tel:<?php e('topbar.phone_full'); ?>"><?php e('topbar.phone'); ?></a></p>
                            <p class="footer-contact-line"><a href="mailto:<?php e('topbar.email'); ?>"><?php e('topbar.email'); ?></a></p>
                            <p class="footer-contact-address"><?php e('footer.address'); ?></p>
                        </div>
                    </div>
                </div>

                <!-- ── Divider Line ── -->
                <div class="footer-divider"></div>

                <!-- ── Bottom Tier: Brand & Newsletter ── -->
                <div class="footer-bottom-tier">
                    <!-- Left: Brand Info & Socials -->
                    <div class="footer-top-brand">
                        <a href="<?php echo url('index.php'); ?>" class="footer-logo-link" aria-label="kzyfilo">
                            <img src="<?php echo asset('images/logo/kzy-filo-logo-white.svg'); ?>" alt="kzyfilo" width="280" height="70">
                        </a>
                        <p class="footer-brand-desc">
                            KZY Filo, modern kurumsal araç kiralama ve operasyonel filo yönetimi çözümleriyle işinizi ileriye taşır.
                        </p>
                        <div class="footer-social-circles">
                            <a href="#" aria-label="X (Twitter)" target="_blank" rel="noopener noreferrer" class="social-circle">
                                <svg viewBox="0 0 24 24" width="15" height="15" fill="currentColor" aria-hidden="true">
                                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                </svg>
                            </a>
                            <a href="#" aria-label="Instagram" target="_blank" rel="noopener noreferrer" class="social-circle">
                                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                </svg>
                            </a>
                            <a href="#" aria-label="Facebook" target="_blank" rel="noopener noreferrer" class="social-circle">
                                <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" aria-hidden="true">
                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                </svg>
                            </a>
                            <a href="https://wa.me/905309198599" aria-label="WhatsApp" target="_blank" rel="noopener noreferrer" class="social-circle">
                                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Right: Modern Newsletter Subscribe Box -->
                    <div class="footer-top-newsletter">
                        <h4 class="footer-newsletter-heading"><?php echo (CURRENT_LANG === 'tr') ? 'E-Bültenimize Abone Olun' : 'Subscribe to our newsletter'; ?></h4>
                        <form class="footer-newsletter-stack" onsubmit="event.preventDefault(); window.showToast('<?php echo (CURRENT_LANG === 'tr') ? 'Bülten kaydınız başarıyla alındı.' : 'Subscribed successfully.'; ?>', 'success'); this.reset();">
                            <input type="email" class="footer-input-field" placeholder="<?php echo (CURRENT_LANG === 'tr') ? 'ornek@sirket.com' : 'example@gmail.com'; ?>" required aria-label="E-posta">
                            <button type="submit" class="footer-submit-btn"><?php echo (CURRENT_LANG === 'tr') ? 'GÖNDER' : 'SUBMIT'; ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </footer>
    </div><!-- /.page-wrapper -->

    <!-- ─── Reusable Modals & Widgets ───────────────────────────────── -->
    <?php include includePath('compare-tray.php'); ?>
    <?php include includePath('cookie-banner.php'); ?>

    <!-- Toast Notification Container (Accessible Live Region) -->
    <div class="toast-container" id="toast-container" aria-live="polite" aria-atomic="true"></div>

    <!-- Core Scripts -->
    <script>
        // Global environment and localized texts
        window.KZY = {
            baseUrl: '<?php echo BASE_URL; ?>',
            lang: '<?php echo CURRENT_LANG; ?>',
            currency: '<?php e('currency'); ?>',
            i18n: {
                addedToList: '<?php e('success.added_to_list'); ?>',
                removedFromList: '<?php e('success.removed_from_list'); ?>',
                addedToCompare: '<?php e('success.added_to_compare'); ?>',
                removedFromCompare: '<?php e('success.removed_from_compare'); ?>',
                maxCompareWarning: '<?php e('compare.max_warning'); ?>',
                listCleared: '<?php e('success.list_cleared'); ?>'
            }
        };
    </script>
    <script src="<?php echo asset('js/app.js'); ?>"></script>
    <script src="<?php echo asset('js/scroll-reveal.js'); ?>"></script>
    <script src="<?php echo asset('js/custom-select.js'); ?>"></script>
    <script src="<?php echo asset('js/favorites.js'); ?>"></script>
</body>
</html>
