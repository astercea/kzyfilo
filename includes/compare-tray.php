<?php
/**
 * kzyfilo — Compare Tray (Bottom Floating Drawer)
 * Allows users to see selected vehicles and open comparison
 */
?>
<div class="compare-tray" id="compare-tray" role="region" aria-label="Araç Karşılaştırma Paneli">
    <div class="container">
        <div class="compare-tray-content">
            <div class="compare-tray-items" id="compare-tray-items">
                <!-- Dynamically rendered by JS -->
            </div>
            <div class="compare-tray-actions">
                <button type="button" class="btn btn-ghost btn-sm" id="compare-tray-clear" style="color: var(--color-stone);">
                    <?php echo (CURRENT_LANG === 'tr') ? 'Temizle' : 'Clear'; ?>
                </button>
                <a href="<?php echo url('arac-karsilastir.php'); ?>" class="btn btn-primary btn-sm" id="compare-tray-btn">
                    <span><?php echo (CURRENT_LANG === 'tr') ? 'Karşılaştır' : 'Compare'; ?></span>
                    <span class="badge badge-light" id="compare-tray-count" style="color: var(--color-orange); margin-left: 4px;">0/3</span>
                </a>
            </div>
        </div>
    </div>
</div>
