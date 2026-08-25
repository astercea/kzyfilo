<?php
/**
 * kzyfilo — Header Bileşeni
 */
if (!defined('ROOT_DIR')) {
    require_once __DIR__ . '/config.php';
}
?>
<!DOCTYPE html>
<html lang="<?php echo CURRENT_LANG; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageMeta['title'] ?? SITE_NAME, ENT_QUOTES, 'UTF-8'); ?></title>
    
    <?php if (!empty($pageMeta['description'])): ?>
    <meta name="description" content="<?php echo htmlspecialchars($pageMeta['description'], ENT_QUOTES, 'UTF-8'); ?>">
    <?php endif; ?>
    
    <link rel="canonical" href="<?php echo htmlspecialchars($pageMeta['canonical'] ?? canonical(), ENT_QUOTES, 'UTF-8'); ?>">
    
    <!-- Open Graph -->
    <meta property="og:title" content="<?php echo htmlspecialchars($pageMeta['title'] ?? SITE_NAME, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($pageMeta['description'] ?? t('site_description'), ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:type" content="<?php echo htmlspecialchars($pageMeta['og_type'] ?? 'website', ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:url" content="<?php echo htmlspecialchars($pageMeta['canonical'] ?? canonical(), ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:image" content="<?php echo htmlspecialchars($pageMeta['og_image'] ?? asset('images/logo/kzy-filo-logo.svg'), ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:site_name" content="<?php echo SITE_NAME; ?>">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@600;700;800;900&family=Plus+Jakarta+Sans:wght@700;800;900&display=swap" rel="stylesheet">
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?php echo asset('css/reset.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('css/variables.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('css/base.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('css/layout.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('css/components.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('css/pages.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('css/responsive.css'); ?>">
</head>
<body>
    <div id="scroll-progress"></div>
    <a href="#main-content" class="skip-link"><?php e('header.skip_to_content'); ?></a>

    <div class="page-wrapper">
        <!-- ─── Site Header (Luxecar Style Direct Top Header) ─────── -->
        <?php $isHome = (basename($_SERVER['SCRIPT_NAME']) === 'index.php'); ?>
        <header class="site-header<?php echo $isHome ? ' is-transparent' : ''; ?>" id="site-header">
            <div class="header-container">
                <!-- Logo (Left) -->
                <a href="<?php echo url('index.php'); ?>" class="site-logo" aria-label="kzyfilo Ana Sayfa">
                    <img src="<?php echo asset('images/logo/kzy-filo-logo.svg'); ?>" alt="kzyfilo" width="210" height="52">
                </a>

                <!-- Desktop Navigation (Center) -->
                <nav class="main-nav" aria-label="Ana Menü">
                    <a href="<?php echo url('araclar.php'); ?>" class="nav-link<?php echo activeClass('araclar.php'); ?>">
                        <?php e('header.vehicles'); ?>
                    </a>

                    <!-- Solutions Mega Menu Trigger -->
                    <div class="nav-dropdown-wrapper">
                        <button type="button" class="nav-link nav-dropdown-btn" id="solutions-menu-btn" aria-expanded="false" aria-controls="solutions-mega-menu">
                            <span><?php e('header.solutions'); ?></span>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </button>

                        <!-- Mega Menu Panel -->
                        <div class="mega-menu" id="solutions-mega-menu" aria-labelledby="solutions-menu-btn">
                            <div class="container">
                                <div class="mega-menu-grid">
                                    <a href="<?php echo url('uzun-donem-arac-kiralama.php'); ?>" class="mega-menu-link">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                            <line x1="16" y1="2" x2="16" y2="6"></line>
                                            <line x1="8" y1="2" x2="8" y2="6"></line>
                                            <line x1="3" y1="10" x2="21" y2="10"></line>
                                        </svg>
                                        <span>
                                            <strong class="menu-label"><?php e('solutions_menu.long_term_rental'); ?></strong>
                                            <small><?php echo (CURRENT_LANG === 'tr') ? 'Şirketiniz için esnek vade ve avantajlar' : 'Flexible leasing options for your business'; ?></small>
                                        </span>
                                    </a>

                                    <a href="<?php echo url('filo-yonetimi.php'); ?>" class="mega-menu-link">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                        </svg>
                                        <span>
                                            <strong class="menu-label"><?php e('solutions_menu.fleet_management'); ?></strong>
                                            <small><?php echo (CURRENT_LANG === 'tr') ? 'Tüm filo süreçlerinde tam kontrol' : 'Total operational control for your fleet'; ?></small>
                                        </span>
                                    </a>

                                    <a href="<?php echo url('binek-arac-kiralama.php'); ?>" class="mega-menu-link">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.5 2.8C2.1 11 2 11.5 2 12v4c0 .6.4 1 1 1h2"></path>
                                            <circle cx="7" cy="17" r="2"></circle>
                                            <circle cx="17" cy="17" r="2"></circle>
                                        </svg>
                                        <span>
                                            <strong class="menu-label"><?php e('solutions_menu.passenger_rental'); ?></strong>
                                            <small><?php echo (CURRENT_LANG === 'tr') ? 'Sedan, hatchback ve SUV seçenekleri' : 'Sedan, hatchback, and SUV choices'; ?></small>
                                        </span>
                                    </a>

                                    <a href="<?php echo url('ticari-arac-kiralama.php'); ?>" class="mega-menu-link">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="1" y="3" width="15" height="13"></rect>
                                            <polygon points="16 8 20 8 23 11 23 16 16 16 8"></polygon>
                                            <circle cx="5.5" cy="18.5" r="2.5"></circle>
                                            <circle cx="18.5" cy="18.5" r="2.5"></circle>
                                        </svg>
                                        <span>
                                            <strong class="menu-label"><?php e('solutions_menu.commercial_rental'); ?></strong>
                                            <small><?php echo (CURRENT_LANG === 'tr') ? 'Hafif ticari ve panelvan modelleri' : 'Light commercial and van models'; ?></small>
                                        </span>
                                    </a>

                                    <a href="<?php echo url('elektrikli-arac-kiralama.php'); ?>" class="mega-menu-link">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                                        </svg>
                                        <span>
                                            <strong class="menu-label"><?php e('solutions_menu.electric_rental'); ?></strong>
                                            <small><?php echo (CURRENT_LANG === 'tr') ? 'Çevre dostu ve yenilikçi filo filosu' : 'Eco-friendly and innovative electric fleet'; ?></small>
                                        </span>
                                    </a>

                                    <a href="<?php echo url('ek-urun-ve-hizmetler.php'); ?>" class="mega-menu-link">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="3"></circle>
                                            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                                        </svg>
                                        <span>
                                            <strong class="menu-label"><?php e('solutions_menu.additional_services'); ?></strong>
                                            <small><?php echo (CURRENT_LANG === 'tr') ? 'Lastik, ikame araç, yol yardım vb.' : 'Tires, replacement cars, roadside assistance'; ?></small>
                                        </span>
                                    </a>

                                    <a href="<?php echo url('online-islemler.php'); ?>" class="mega-menu-link">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                                            <line x1="8" y1="21" x2="16" y2="21"></line>
                                            <line x1="12" y1="17" x2="12" y2="21"></line>
                                        </svg>
                                        <span>
                                            <strong class="menu-label"><?php e('solutions_menu.online_operations'); ?></strong>
                                            <small><?php echo (CURRENT_LANG === 'tr') ? 'Bakım, hasar ve online talepler' : 'Maintenance, damage, and online requests'; ?></small>
                                        </span>
                                    </a>

                                    <a href="<?php echo url('arac-teslim-ve-iade.php'); ?>" class="mega-menu-link">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="9 11 12 14 22 4"></polyline>
                                            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                        </svg>
                                        <span>
                                            <strong class="menu-label"><?php e('solutions_menu.delivery_return'); ?></strong>
                                            <small><?php echo (CURRENT_LANG === 'tr') ? 'Teslim alma ve iade yönergeleri' : 'Delivery and return procedures'; ?></small>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="<?php echo url('hakkimizda.php'); ?>" class="nav-link<?php echo activeClass('hakkimizda.php'); ?>">
                        <?php e('header.about'); ?>
                    </a>

                    <!-- Resources Dropdown -->
                    <div class="nav-dropdown-wrapper">
                        <button type="button" class="nav-link nav-dropdown-btn" id="resources-menu-btn" aria-expanded="false" aria-controls="resources-dropdown">
                            <span><?php e('header.resources'); ?></span>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </button>
                        <div class="mega-menu mega-menu-narrow" id="resources-dropdown" aria-labelledby="resources-menu-btn">
                            <div class="container">
                                <div class="mega-menu-grid" style="grid-template-columns: repeat(3, 1fr);">
                                    <a href="<?php echo url('blog.php'); ?>" class="mega-menu-link">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                                        </svg>
                                        <span><strong class="menu-label"><?php e('resources_menu.blog'); ?></strong></span>
                                    </a>
                                    <a href="<?php echo url('haberler.php'); ?>" class="mega-menu-link">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M19 20H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v1m2 13a2 2 0 0 1-2-2V7m2 13a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-2"></path>
                                        </svg>
                                        <span><strong class="menu-label"><?php e('resources_menu.news'); ?></strong></span>
                                    </a>
                                    <a href="<?php echo url('sss.php'); ?>" class="mega-menu-link">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                                        </svg>
                                        <span><strong class="menu-label"><?php e('resources_menu.faq'); ?></strong></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="<?php echo url('iletisim.php'); ?>" class="nav-link<?php echo activeClass('iletisim.php'); ?>">
                        <?php e('header.contact'); ?>
                    </a>
                </nav>

                <!-- Header Actions (Right) -->
                <div class="header-actions">
                    <!-- Search Icon Button -->
                    <a href="<?php echo url('araclar.php'); ?>" class="header-action-icon" title="Araç Ara" aria-label="Araç Ara">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </a>

                    <!-- Listem Button -->
                    <a href="<?php echo url('listem.php'); ?>" class="header-action-icon header-list-btn" id="header-list-btn" title="<?php e('header.my_list'); ?>" aria-label="<?php e('header.my_list'); ?>">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                        <span class="list-count" id="header-list-count" data-count="0">0</span>
                    </a>

                    <!-- CTA Button -->
                    <a href="<?php echo url('hizli-teklif.php'); ?>" class="btn btn-primary header-cta-btn">
                        <?php e('header.get_quote'); ?>
                    </a>

                    <!-- Minimalist 2-line Hamburger for Mobile & Drawer -->
                    <button type="button" class="hamburger-btn" id="hamburger-btn" aria-label="Menüyü Aç/Kapat" aria-expanded="false" aria-controls="mobile-menu">
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                    </button>
                </div>
            </div>
        </header>

        <!-- Mobile Navigation Menu Include -->
        <?php include includePath('mobile-menu.php'); ?>

        <main id="main-content" class="page-main">
