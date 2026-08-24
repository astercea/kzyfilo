<?php
/**
 * kzyfilo — Admin Header & Navigation Component
 */
require_once dirname(__DIR__, 2) . '/includes/config.php';

$activeAdminPage = basename($_SERVER['SCRIPT_NAME']);
function adminActive(string $page, string $activePage): string {
    return $page === $activePage ? ' active' : '';
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kzyfilo Yönetim Paneli (Frontend Prototip)</title>
    <link rel="stylesheet" href="<?php echo asset('css/reset.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('css/variables.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('css/base.css'); ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL . 'admin/assets/admin.css'; ?>">
</head>
<body class="admin-body">
    <!-- ─── SIDEBAR ────────────────────────────────────────────────── -->
    <aside class="admin-sidebar">
        <div class="admin-brand">
            <img src="<?php echo asset('images/logo/kzy-filo-logo-white.svg'); ?>" alt="kzyfilo">
        </div>

        <nav class="admin-nav">
            <span class="admin-nav-section-title">Genel</span>
            <a href="index.php" class="admin-nav-link<?php echo adminActive('index.php', $activeAdminPage); ?>">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                <span>Dashboard</span>
            </a>

            <span class="admin-nav-section-title">Filo & Fiyat Yönetimi</span>
            <a href="araclar.php" class="admin-nav-link<?php echo adminActive('araclar.php', $activeAdminPage); ?>">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.5 2.8C2.1 11 2 11.5 2 12v4c0 .6.4 1 1 1h2"></path><circle cx="7" cy="17" r="2"></circle><circle cx="17" cy="17" r="2"></circle></svg>
                <span>Araç Kataloğu</span>
                <span class="admin-badge">8</span>
            </a>
            <a href="paketler.php" class="admin-nav-link<?php echo adminActive('paketler.php', $activeAdminPage); ?>">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                <span>Hizmet Paketleri</span>
            </a>
            <a href="fiyatlar.php" class="admin-nav-link<?php echo adminActive('fiyatlar.php', $activeAdminPage); ?>">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                <span>Fiyat Kombinasyonları</span>
            </a>

            <span class="admin-nav-section-title">Talep & Başvurular</span>
            <a href="teklifler.php" class="admin-nav-link<?php echo adminActive('teklifler.php', $activeAdminPage); ?>">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                <span>Teklif Talepleri</span>
                <span class="admin-badge" style="background-color: #ef4444;">4 Yeni</span>
            </a>
            <a href="aranma-talepleri.php" class="admin-nav-link<?php echo adminActive('aranma-talepleri.php', $activeAdminPage); ?>">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                <span>Aranma Talepleri</span>
            </a>
            <a href="online-islemler.php" class="admin-nav-link<?php echo adminActive('online-islemler.php', $activeAdminPage); ?>">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                <span>Online İşlemler</span>
            </a>

            <span class="admin-nav-section-title">İçerik & Kurumsal</span>
            <a href="icerikler.php" class="admin-nav-link<?php echo adminActive('icerikler.php', $activeAdminPage); ?>">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                <span>Blog & Haberler</span>
            </a>
            <a href="sss.php" class="admin-nav-link<?php echo adminActive('sss.php', $activeAdminPage); ?>">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                <span>SSS Yönetimi</span>
            </a>
            <a href="ofisler.php" class="admin-nav-link<?php echo adminActive('ofisler.php', $activeAdminPage); ?>">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                <span>Ofisler & İade Noktaları</span>
            </a>

            <span class="admin-nav-section-title">Sistem</span>
            <a href="seo.php" class="admin-nav-link<?php echo adminActive('seo.php', $activeAdminPage); ?>">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <span>SEO & Meta</span>
            </a>
            <a href="ayarlar.php" class="admin-nav-link<?php echo adminActive('ayarlar.php', $activeAdminPage); ?>">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                <span>Genel Ayarlar</span>
            </a>
            <a href="<?php echo url('index.php'); ?>" target="_blank" class="admin-nav-link mt-4" style="color: #38bdf8;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                <span>Siteyi Görüntüle ↗</span>
            </a>
        </nav>
    </aside>

    <!-- ─── WRAPPER ────────────────────────────────────────────────── -->
    <div class="admin-main-wrap">
        <header class="admin-topbar">
            <div class="flex items-center gap-3">
                <span class="badge badge-primary">kzyfilo</span>
                <span class="text-xs text-muted">Yönetim Paneli</span>
            </div>

            <div class="flex items-center gap-4">
                <span class="text-sm fw-semibold">Yönetici: <strong>Sistem Yöneticisi</strong></span>
                <div style="width: 36px; height: 36px; border-radius: 50%; background-color: var(--color-primary); color: #fff; display: flex; align-items: center; justify-content: center; font-weight: bold;">A</div>
            </div>
        </header>

        <main class="admin-content">
