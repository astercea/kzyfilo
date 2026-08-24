<?php
/**
 * kzyfilo — Dil Seçici Bileşeni
 * 
 * Sayfanın mevcut URL'sini koruyarak dili TR / EN arasında değiştirir.
 */
$otherLang = (CURRENT_LANG === 'tr') ? 'en' : 'tr';
$otherLangLabel = (CURRENT_LANG === 'tr') ? 'EN' : 'TR';
$otherLangTitle = (CURRENT_LANG === 'tr') ? 'Switch to English' : 'Türkçe\'ye Geç';

// Mevcut query parametrelerini koruyarak lang parametresini güncelle
$queryParams = $_GET;
$queryParams['lang'] = $otherLang;
$switchUrl = '?' . http_build_query($queryParams);
?>
<div class="lang-switcher">
    <a href="<?php echo htmlspecialchars($switchUrl, ENT_QUOTES, 'UTF-8'); ?>" 
       class="lang-btn" 
       title="<?php echo htmlspecialchars($otherLangTitle, ENT_QUOTES, 'UTF-8'); ?>"
       aria-label="<?php echo htmlspecialchars($otherLangTitle, ENT_QUOTES, 'UTF-8'); ?>">
        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="2" y1="12" x2="22" y2="12"></line>
            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
        </svg>
        <span class="lang-code"><?php echo $otherLangLabel; ?></span>
    </a>
</div>
