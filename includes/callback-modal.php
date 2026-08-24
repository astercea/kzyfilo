<?php
/**
 * kzyfilo — "Sizi Arayalım" Modal Bileşeni
 */
if (!defined('ROOT_DIR')) {
    require_once __DIR__ . '/config.php';
}
?>
<!-- Modal Backdrop -->
<div class="modal-backdrop" id="callback-modal-backdrop" aria-hidden="true"></div>

<!-- Modal Dialog -->
<div class="modal" id="callback-modal" role="dialog" aria-modal="true" aria-labelledby="callback-modal-title" aria-hidden="true">
    <div class="modal-header">
        <h3 id="callback-modal-title"><?php e('callback.title'); ?></h3>
        <button type="button" class="modal-close" id="callback-modal-close" aria-label="<?php e('btn.close'); ?>">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
    </div>

    <form id="callback-form" class="callback-form" novalidate>
        <div class="modal-body">
            <p class="text-sm text-muted mb-4"><?php e('callback.desc'); ?></p>

            <div class="form-group">
                <label for="callback-fullname" class="form-label">
                    <?php e('form.full_name'); ?> <span class="required">*</span>
                </label>
                <input type="text" id="callback-fullname" name="fullname" class="form-input" required placeholder="Örn: Ahmet Yılmaz" autocomplete="name">
                <span class="form-error" id="callback-fullname-error" aria-live="polite"></span>
            </div>

            <div class="form-group">
                <label for="callback-phone" class="form-label">
                    <?php e('form.phone'); ?> <span class="required">*</span>
                </label>
                <input type="tel" id="callback-phone" name="phone" class="form-input" required placeholder="05XX XXX XX XX" autocomplete="tel">
                <span class="form-error" id="callback-phone-error" aria-live="polite"></span>
            </div>

            <div class="form-group">
                <label for="callback-time" class="form-label"><?php e('callback.preferred_time'); ?></label>
                <select id="callback-time" name="preferred_time" class="form-select">
                    <option value="anytime"><?php e('callback.time_anytime'); ?></option>
                    <option value="morning"><?php e('callback.time_morning'); ?></option>
                    <option value="afternoon"><?php e('callback.time_afternoon'); ?></option>
                    <option value="evening"><?php e('callback.time_evening'); ?></option>
                </select>
            </div>

            <div class="form-group">
                <label for="callback-notes" class="form-label"><?php e('form.description'); ?></label>
                <textarea id="callback-notes" name="notes" class="form-textarea" rows="3" placeholder="İlgilendiğiniz araç veya sormak istediğiniz detaylar..."></textarea>
            </div>

            <div class="form-group">
                <label class="form-check">
                    <input type="checkbox" id="callback-kvkk" name="kvkk" required>
                    <span class="form-check-label">
                        <a href="<?php echo url('kvkk.php'); ?>" target="_blank" rel="noopener noreferrer" style="text-decoration: underline;"><?php e('form.kvkk_consent'); ?></a> <span class="required">*</span>
                    </span>
                </label>
                <span class="form-error" id="callback-kvkk-error" aria-live="polite"></span>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="callback-modal-cancel">
                <?php e('btn.cancel'); ?>
            </button>
            <button type="submit" class="btn btn-primary" id="callback-modal-submit">
                <?php e('callback.submit'); ?>
            </button>
        </div>
    </form>
</div>
