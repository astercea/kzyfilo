<?php
/**
 * kzyfilo — Compare Tray (Bottom Floating Drawer)
 * Allows users to see selected vehicles and open comparison
 */
?>
<div class="compare-tray" id="compare-tray" role="region" aria-label="Araç Karşılaştırma Paneli">
    <div class="compare-tray-content">
        <div class="compare-tray-items" id="compare-tray-items">
            <!-- Dynamically rendered by JS: up to 4 items horizontal container -->
        </div>
        <div class="compare-tray-actions">
            <button type="button" class="btn btn-ghost btn-sm" id="compare-tray-clear" style="color: rgba(255,255,255,0.65); font-size: 12.5px;">
                <?php echo (CURRENT_LANG === 'tr') ? 'Temizle' : 'Clear'; ?>
            </button>
            <a href="<?php echo url('arac-karsilastir.php'); ?>" class="btn btn-primary btn-sm" id="compare-tray-btn" style="font-weight: 700; padding: 8px 22px;">
                <span><?php echo (CURRENT_LANG === 'tr') ? 'Karşılaştır' : 'Compare'; ?></span>
            </a>
        </div>
    </div>
</div>
