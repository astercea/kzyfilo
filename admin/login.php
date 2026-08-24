<?php
/**
 * kzyfilo — Admin Giriş Ekranı (admin/login.php)
 */
require_once dirname(__DIR__) . '/includes/config.php';
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yönetim Paneli Girişi | kzyfilo</title>
    <link rel="stylesheet" href="<?php echo asset('css/reset.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('css/variables.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('css/base.css'); ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL . 'admin/assets/admin.css'; ?>">
</head>
<body style="background-color: #0f172a; display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; padding: 20px;">
    <div style="width: 100%; max-width: 420px; background-color: #1e293b; border-radius: 12px; padding: 36px; box-shadow: 0 10px 25px rgba(0,0,0,0.3); border: 1px solid rgba(255,255,255,0.08);">
        <div style="text-align: center; margin-bottom: 28px;">
            <img src="<?php echo asset('images/logo/kzy-filo-logo-white.svg'); ?>" alt="kzyfilo" style="height: 44px; margin-bottom: 12px;">
            <h2 style="color: #ffffff; font-size: 18px; margin: 0; font-weight: 700;">Yönetim Paneli Girişi</h2>
            <p style="color: #94a3b8; font-size: 13px; margin-top: 4px;">Kurumsal Filo Yönetim Portalı</p>
        </div>

        <form onsubmit="event.preventDefault(); window.location.href='index.php';">
            <div class="form-group mb-4">
                <label style="color: #cbd5e1; font-size: 13px; display: block; margin-bottom: 6px; font-weight: 500;">E-posta veya Kullanıcı Adı</label>
                <input type="text" class="form-input" value="admin@kzyfilo.com.tr" required style="background-color: #0f172a; border-color: #334155; color: #ffffff;">
            </div>

            <div class="form-group mb-6">
                <label style="color: #cbd5e1; font-size: 13px; display: block; margin-bottom: 6px; font-weight: 500;">Şifre</label>
                <input type="password" class="form-input" value="••••••••••••" required style="background-color: #0f172a; border-color: #334155; color: #ffffff;">
            </div>

            <div class="demo-notice mb-6 p-2 text-center" style="border-radius: 6px; width: 100%; display: block; font-size: 11px;">
                ℹ️ Frontend Prototip: Giriş butonuna tıklayarak doğrudan panele geçebilirsiniz.
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px; font-size: 15px; font-weight: 600;">
                Giriş Yap →
            </button>
        </form>

        <div style="text-align: center; margin-top: 24px; border-top: 1px solid rgba(255,255,255,0.08); padding-top: 16px;">
            <a href="<?php echo url('index.php'); ?>" style="color: #94a3b8; font-size: 13px; text-decoration: none;">← Web Sitesine Geri Dön</a>
        </div>
    </div>
</body>
</html>
