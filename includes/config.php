<?php
/**
 * kzyfilo — Merkezi Yapılandırma ve Helper Fonksiyonlar
 * 
 * Bu dosya tüm sayfalarda include edilir. Base path, dil yükleme,
 * güvenli çıktı ve yardımcı fonksiyonları içerir.
 */

// Hata raporlama (geliştirme ortamı)
error_reporting(E_ALL);
ini_set('display_errors', '1');

// UTF-8 Karakter Kodlaması
if (!headers_sent()) {
    header('Content-Type: text/html; charset=UTF-8');
}
if (function_exists('mb_internal_encoding')) {
    mb_internal_encoding('UTF-8');
}

// Oturum başlat (dil seçimi için)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ─── Base Path Hesaplama ────────────────────────────────────────────
// XAMPP altında farklı klasör isimlerinde çalışabilmesi için
// script konumuna göre otomatik hesaplama yapılır.

define('ROOT_DIR', dirname(__DIR__) . DIRECTORY_SEPARATOR);

// Web base path: /kzyfilo/ veya /proje-adi/ gibi
$scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
$includesPos = strpos($scriptDir, '/includes');
$adminPos = strpos($scriptDir, '/admin');

if ($includesPos !== false) {
    $basePath = substr($scriptDir, 0, $includesPos);
} elseif ($adminPos !== false) {
    $basePath = substr($scriptDir, 0, $adminPos);
} else {
    $basePath = $scriptDir;
}

// Kök klasördeki sayfalar için
if ($basePath === '' || $basePath === '.') {
    $basePath = dirname($_SERVER['SCRIPT_NAME']);
    $basePath = str_replace('\\', '/', $basePath);
}

$basePath = rtrim($basePath, '/') . '/';
define('BASE_URL', $basePath);

// Canlı domain (yalnızca SEO alanları için)
define('SITE_DOMAIN', 'https://kzyfilo.com.tr');
define('SITE_NAME', 'kzyfilo');
define('SITE_PHONE', '0850 300 59 99');
define('SITE_EMAIL', 'info@kzyfilo.com.tr');

// ─── Dil Sistemi ────────────────────────────────────────────────────

// Desteklenen diller
define('SUPPORTED_LANGS', ['tr', 'en']);
define('DEFAULT_LANG', 'tr');

/**
 * Aktif dili belirle
 * Öncelik: GET parametresi > Session > Cookie > Varsayılan
 */
function getCurrentLang(): string {
    // 1. GET parametresi
    if (isset($_GET['lang']) && in_array($_GET['lang'], SUPPORTED_LANGS, true)) {
        $lang = $_GET['lang'];
        $_SESSION['lang'] = $lang;
        setcookie('kzy_lang', $lang, time() + (365 * 24 * 60 * 60), BASE_URL);
        return $lang;
    }

    // 2. Session
    if (isset($_SESSION['lang']) && in_array($_SESSION['lang'], SUPPORTED_LANGS, true)) {
        return $_SESSION['lang'];
    }

    // 3. Cookie
    if (isset($_COOKIE['kzy_lang']) && in_array($_COOKIE['kzy_lang'], SUPPORTED_LANGS, true)) {
        $_SESSION['lang'] = $_COOKIE['kzy_lang'];
        return $_COOKIE['kzy_lang'];
    }

    // 4. Varsayılan
    return DEFAULT_LANG;
}

$currentLang = getCurrentLang();
define('CURRENT_LANG', $currentLang);

// Dil dosyalarını yükle
$langFile = ROOT_DIR . 'lang/' . CURRENT_LANG . '.php';
$fallbackFile = ROOT_DIR . 'lang/' . DEFAULT_LANG . '.php';

$lang = [];
$fallbackLang = [];

if (file_exists($fallbackFile)) {
    $fallbackLang = require $fallbackFile;
}
if (file_exists($langFile)) {
    $lang = require $langFile;
}

// Fallback: İngilizce çeviri eksikse Türkçe gösterilecek
if (CURRENT_LANG !== DEFAULT_LANG) {
    $lang = array_merge($fallbackLang, $lang);
} else {
    $lang = $fallbackLang;
}

/**
 * Çeviri anahtarını güvenli biçimde döndür
 * Anahtar bulunamazsa Türkçe fallback, o da yoksa anahtar adı döner
 * 
 * @param string $key Çeviri anahtarı (nokta notasyonu: 'header.home')
 * @param array $params İsteğe bağlı parametre değişimi
 * @return string
 */
function t(string $key, array $params = []): string {
    global $lang;

    // Nokta notasyonu desteği: 'header.menu.home' → $lang['header']['menu']['home']
    $keys = explode('.', $key);
    $value = $lang;

    foreach ($keys as $k) {
        if (is_array($value) && isset($value[$k])) {
            $value = $value[$k];
        } else {
            // Anahtar bulunamadı — boş string döndür, bozuk anahtar gösterme
            return '';
        }
    }

    if (!is_string($value)) {
        return '';
    }

    // Parametre değişimi: :param → değer
    foreach ($params as $paramKey => $paramValue) {
        $value = str_replace(':' . $paramKey, (string)$paramValue, $value);
    }

    return $value;
}

/**
 * Çeviri anahtarını HTML-safe olarak ekrana yaz
 */
function e(string $key, array $params = []): void {
    echo htmlspecialchars(t($key, $params), ENT_QUOTES, 'UTF-8');
}

/**
 * Değeri HTML-safe olarak döndür
 */
function esc(string $value): string {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

/**
 * Değeri HTML-safe olarak ekrana yaz
 */
function out(string $value): void {
    echo htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

// ─── URL Helper Fonksiyonları ────────────────────────────────────────

/**
 * Sayfa URL'i oluştur (dil parametresi dahil)
 */
function url(string $page = '', array $params = []): string {
    $url = BASE_URL . ltrim($page, '/');
    
    // Dil varsayılan değilse parametre ekle
    if (CURRENT_LANG !== DEFAULT_LANG) {
        $params['lang'] = CURRENT_LANG;
    }

    if (!empty($params)) {
        $url .= '?' . http_build_query($params);
    }

    return $url;
}

/**
 * Asset URL'i oluştur (Otomatik versiyonlama ile önbellek bayatlamasını önler)
 */
function asset(string $path): string {
    $fullPath = ROOT_DIR . 'assets/' . ltrim($path, '/');
    $version = file_exists($fullPath) ? filemtime($fullPath) : '1.0';
    return BASE_URL . 'assets/' . ltrim($path, '/') . '?v=' . $version;
}

/**
 * Canonical URL oluştur (canlı domain ile)
 */
function canonical(string $path = ''): string {
    return SITE_DOMAIN . '/' . ltrim($path, '/');
}

/**
 * Aktif sayfa kontrolü (navigasyon vurgulama için)
 */
function isActivePage(string $page): bool {
    $currentPage = basename($_SERVER['SCRIPT_NAME']);
    return $currentPage === $page;
}

/**
 * Aktif sayfa CSS sınıfı
 */
function activeClass(string $page): string {
    return isActivePage($page) ? ' active' : '';
}

/**
 * Sayfa başlığı oluştur
 */
function pageTitle(string $titleKey): string {
    $title = t($titleKey);
    if (empty($title)) {
        return SITE_NAME;
    }
    return $title . ' | ' . SITE_NAME;
}

// ─── Include Helper ─────────────────────────────────────────────────

/**
 * Include dosyası yolu (güvenli)
 */
function includePath(string $file): string {
    return ROOT_DIR . 'includes/' . $file;
}

/**
 * Data dosyası yükle
 */
function loadData(string $file): array {
    $path = ROOT_DIR . 'data/' . $file;
    if (file_exists($path)) {
        $data = require $path;
        return is_array($data) ? $data : [];
    }
    return [];
}

// ─── Sayfa Meta Bilgileri ───────────────────────────────────────────

$pageMeta = [
    'title' => SITE_NAME,
    'description' => '',
    'canonical' => '',
    'og_image' => asset('images/logo/kzy-filo-logo.svg'),
    'og_type' => 'website',
];

/**
 * Sayfa meta bilgilerini ayarla
 */
function setPageMeta(array $meta): void {
    global $pageMeta;
    $pageMeta = array_merge($pageMeta, $meta);
}
