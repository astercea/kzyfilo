<?php
/**
 * kzyfilo — Çerez Tercih Banner'ı
 */
if (!defined('ROOT_DIR')) {
    require_once __DIR__ . '/config.php';
}
?>
<div class="cookie-banner" id="cookie-banner" role="region" aria-label="<?php e('cookies.title'); ?>" aria-hidden="true">
    <div class="cookie-banner-content">
        <div class="cookie-banner-text">
            <h4><?php e('cookies.title'); ?></h4>
            <p><?php e('cookies.description'); ?> <a href="<?php echo url('cerez-politikasi.php'); ?>" style="text-decoration: underline;"><?php e('footer.cookies'); ?></a></p>

            <!-- Preferences Panel -->
            <div class="cookie-preferences" id="cookie-preferences">
                <div class="cookie-pref-item">
                    <div class="cookie-pref-info">
                        <h5><?php e('cookies.required'); ?></h5>
                        <p><?php e('cookies.required_desc'); ?></p>
                    </div>
                    <input type="checkbox" checked disabled aria-label="<?php e('cookies.required'); ?>">
                </div>

                <div class="cookie-pref-item">
                    <div class="cookie-pref-info">
                        <h5><?php e('cookies.analytics'); ?></h5>
                        <p><?php e('cookies.analytics_desc'); ?></p>
                    </div>
                    <input type="checkbox" id="cookie-analytics" aria-label="<?php e('cookies.analytics'); ?>">
                </div>

                <div class="cookie-pref-item">
                    <div class="cookie-pref-info">
                        <h5><?php e('cookies.marketing'); ?></h5>
                        <p><?php e('cookies.marketing_desc'); ?></p>
                    </div>
                    <input type="checkbox" id="cookie-marketing" aria-label="<?php e('cookies.marketing'); ?>">
                </div>
            </div>
        </div>

        <div class="cookie-banner-actions">
            <button type="button" class="btn btn-secondary btn-sm" id="cookie-manage-btn">
                <?php e('cookies.manage'); ?>
            </button>
            <button type="button" class="btn btn-secondary btn-sm" id="cookie-accept-required-btn">
                <?php e('cookies.accept_required'); ?>
            </button>
            <button type="button" class="btn btn-primary btn-sm" id="cookie-accept-all-btn">
                <?php e('cookies.accept_all'); ?>
            </button>
            <button type="button" class="btn btn-primary btn-sm hidden" id="cookie-save-btn">
                <?php e('cookies.save'); ?>
            </button>
        </div>
    </div>
</div>
