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
                <div class="footer-main">
                    <!-- Brand & About -->
                    <div class="footer-brand">
                        <a href="<?php echo url('index.php'); ?>" aria-label="kzyfilo">
                            <img src="<?php echo asset('images/logo/kzy-filo-logo-white.svg'); ?>" alt="kzyfilo" width="180" height="44">
                        </a>
                        <p><?php e('footer.about_text'); ?></p>
                        <div class="footer-social">
                            <a href="#" aria-label="LinkedIn" target="_blank" rel="noopener noreferrer">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                                    <rect x="2" y="9" width="4" height="12"></rect>
                                    <circle cx="4" cy="4" r="2"></circle>
                                </svg>
                            </a>
                            <a href="#" aria-label="Instagram" target="_blank" rel="noopener noreferrer">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                </svg>
                            </a>
                            <a href="#" aria-label="YouTube" target="_blank" rel="noopener noreferrer">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"></path>
                                    <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon>
                                </svg>
                            </a>
                            <a href="#" aria-label="Facebook" target="_blank" rel="noopener noreferrer">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Solutions Column -->
                    <div>
                        <h4 class="footer-title"><?php e('footer.menu_solutions'); ?></h4>
                        <div class="footer-links">
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

                    <!-- Corporate Column -->
                    <div>
                        <h4 class="footer-title"><?php e('footer.menu_corporate'); ?></h4>
                        <div class="footer-links">
                            <a href="<?php echo url('hakkimizda.php'); ?>"><?php e('header.about'); ?></a>
                            <a href="<?php echo url('referanslar.php'); ?>"><?php e('references.title'); ?></a>
                            <a href="<?php echo url('ofisler.php'); ?>"><?php e('offices.title'); ?></a>
                            <a href="<?php echo url('arac-iade-noktalari.php'); ?>"><?php e('return_points.title'); ?></a>
                            <a href="<?php echo url('iletisim.php'); ?>"><?php e('header.contact'); ?></a>
                            <a href="<?php echo url('hizli-teklif.php'); ?>"><?php e('header.get_quote'); ?></a>
                            <a href="<?php echo url('filo-teklif.php'); ?>"><?php e('quote_form.fleet_title'); ?></a>
                        </div>
                    </div>

                    <!-- Resources Column -->
                    <div>
                        <h4 class="footer-title"><?php e('footer.menu_resources'); ?></h4>
                        <div class="footer-links">
                            <a href="<?php echo url('blog.php'); ?>"><?php e('resources_menu.blog'); ?></a>
                            <a href="<?php echo url('haberler.php'); ?>"><?php e('resources_menu.news'); ?></a>
                            <a href="<?php echo url('sss.php'); ?>"><?php e('resources_menu.faq'); ?></a>
                            <a href="<?php echo url('arac-karsilastir.php'); ?>"><?php e('compare.compare_vehicles'); ?></a>
                            <a href="<?php echo url('listem.php'); ?>"><?php e('header.my_list'); ?></a>
                            <a href="<?php echo url('site-haritasi.php'); ?>"><?php e('footer.sitemap'); ?></a>
                        </div>
                    </div>

                    <!-- Contact Column -->
                    <div>
                        <h4 class="footer-title"><?php e('footer.contact_info'); ?></h4>
                        <div class="footer-contact">
                            <div class="footer-contact-item">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                <span><?php e('footer.address'); ?></span>
                            </div>
                            <div class="footer-contact-item">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                </svg>
                                <a href="tel:<?php e('topbar.phone_full'); ?>"><?php e('topbar.phone'); ?></a>
                            </div>
                            <div class="footer-contact-item">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect>
                                    <line x1="12" y1="18" x2="12.01" y2="18"></line>
                                </svg>
                                <a href="tel:+905309198599"><?php e('topbar.mobile'); ?></a>
                            </div>
                            <div class="footer-contact-item">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                                <a href="mailto:<?php e('topbar.email'); ?>"><?php e('topbar.email'); ?></a>
                            </div>
                        </div>

                        <!-- Newsletter -->
                        <div class="footer-newsletter">
                            <h4 class="footer-title" style="margin-top: var(--space-5); margin-bottom: var(--space-2);"><?php echo (CURRENT_LANG === 'tr') ? 'E-Bülten' : 'Newsletter'; ?></h4>
                            <p style="font-size: var(--font-size-xs); color: rgba(255,255,255,0.5); margin-bottom: var(--space-2);"><?php echo (CURRENT_LANG === 'tr') ? 'Kampanya ve yeniliklerden haberdar olun.' : 'Stay updated with campaigns & news.'; ?></p>
                            <form class="footer-newsletter-form" onsubmit="event.preventDefault(); window.showToast('<?php echo (CURRENT_LANG === 'tr') ? 'Bülten kaydınız başarıyla alındı.' : 'Subscribed successfully.'; ?>', 'success'); this.reset();">
                                <input type="email" class="footer-newsletter-input" placeholder="<?php echo (CURRENT_LANG === 'tr') ? 'E-posta adresiniz' : 'Your email'; ?>" required aria-label="E-posta">
                                <button type="submit" class="footer-newsletter-btn"><?php echo (CURRENT_LANG === 'tr') ? 'Kayıt' : 'Join'; ?></button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Footer Bottom -->
                <div class="footer-bottom">
                    <p><?php echo t('footer.copyright', ['year' => date('Y')]); ?></p>
                    <div class="footer-bottom-links">
                        <a href="<?php echo url('kvkk.php'); ?>"><?php e('footer.kvkk'); ?></a>
                        <a href="<?php echo url('gizlilik.php'); ?>"><?php e('footer.privacy'); ?></a>
                        <a href="<?php echo url('cerez-politikasi.php'); ?>"><?php e('footer.cookies'); ?></a>
                        <a href="<?php echo url('yasal-uyari.php'); ?>"><?php e('footer.legal_notice'); ?></a>
                        <a href="<?php echo url('site-haritasi.php'); ?>"><?php e('footer.sitemap'); ?></a>
                    </div>
                </div>
            </div>
        </footer>
    </div><!-- /.page-wrapper -->

    <!-- ─── Reusable Modals & Widgets ───────────────────────────────── -->
    <?php include includePath('compare-tray.php'); ?>
    <?php include includePath('floating-contact.php'); ?>
    <?php include includePath('callback-modal.php'); ?>
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
