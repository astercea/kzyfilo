<?php
/**
 * kzyfilo — Global Arama Menüsü / Launcher (includes/search-modal.php)
 * KZY Executive Motion — Minimalist Editorial Search Launcher
 */
if (!defined('ROOT_DIR')) {
    require_once __DIR__ . '/config.php';
}
?>
<!-- ─── Compact Under-Header Search Launcher ──────────────────────────── -->
<div class="site-search-overlay" id="site-search-modal" role="dialog" aria-modal="true" aria-label="<?php echo (CURRENT_LANG === 'tr') ? 'Site İçi Arama' : 'Site Search'; ?>" aria-hidden="true">
    <div class="site-search-backdrop" id="site-search-backdrop"></div>
    
    <div class="site-search-container">
        <div class="site-search-inner">
            
            <!-- Search Form & Underline Input with Inline Close X Button -->
            <form action="<?php echo url('arama.php'); ?>" method="GET" class="site-search-form" id="site-search-form" role="search">
                <div class="site-search-input-group">
                    <button type="submit" class="site-search-icon-btn" aria-label="<?php echo (CURRENT_LANG === 'tr') ? 'Ara' : 'Search'; ?>">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </button>
                    <input type="search" 
                           name="q" 
                           id="site-search-input" 
                           class="site-search-input" 
                           placeholder="<?php echo (CURRENT_LANG === 'tr') ? 'Marka, model veya hizmet arayın...' : 'Search brand, model or service...'; ?>" 
                           autocomplete="off" 
                           spellcheck="false"
                           required>
                    
                    <!-- Clear Text (X) Button -->
                    <button type="button" class="site-search-clear-btn hidden" id="site-search-clear" aria-label="<?php echo (CURRENT_LANG === 'tr') ? 'Temizle' : 'Clear'; ?>" title="Temizle">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>

                    <!-- Close Menu X Button (Aligned on the right of input bar) -->
                    <button type="button" class="site-search-close-btn" id="site-search-close" aria-label="<?php echo (CURRENT_LANG === 'tr') ? 'Aramayı Kapat' : 'Close Search'; ?>" title="Kapat (ESC)">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
            </form>

            <!-- Popular Quick Searches (Direct Links to Search Page) -->
            <div class="site-search-dropdown-body" id="site-search-dropdown-body">
                <div class="site-search-default-state" id="site-search-default-state">
                    <span class="site-search-subhead"><?php echo (CURRENT_LANG === 'tr') ? 'Popüler Aramalar' : 'Popular Searches'; ?></span>
                    <ul class="site-search-links">
                        <li>
                            <a href="<?php echo url('arama.php', ['q' => 'Renault Clio']); ?>" class="site-search-suggest-item">
                                <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                <span>Renault Clio 1.0 TCe</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo url('arama.php', ['q' => 'Fiat Egea']); ?>" class="site-search-suggest-item">
                                <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                <span>Fiat Egea Sedan</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo url('arama.php', ['q' => 'Toyota Corolla']); ?>" class="site-search-suggest-item">
                                <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                <span>Toyota Corolla Hybrid</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo url('arama.php', ['q' => 'BMW 320i']); ?>" class="site-search-suggest-item">
                                <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                <span>BMW 320i Sedan</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>
