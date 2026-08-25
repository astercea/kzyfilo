<?php
/**
 * kzyfilo — Türkçe Dil Dosyası
 * 
 * Tüm arayüz metinleri bu dosyadan okunur.
 * Anahtarlar nokta notasyonu ile erişilir: t('header.phone')
 */

return [

    // ─── Genel ──────────────────────────────────────────────────────
    'site_name' => 'kzyfilo',
    'site_tagline' => 'Kurumsal Araç Kiralama & Filo Yönetimi',
    'site_description' => 'kzyfilo ile uzun dönem araç kiralama ve filo yönetimi çözümlerini keşfedin. Şirketinize özel araç kiralama teklifleri alın.',
    'demo_notice' => 'Bu sayfada gösterilen fiyatlar ve içerikler demo amaçlıdır.',
    'demo_price' => 'Demo fiyat',
    'sample_price' => 'Örnek fiyat',
    'currency' => '₺',
    'per_month' => '/ay',
    'vat_excluded' => '+ KDV',
    'vat_included' => 'KDV Dahil',
    'starting_from' => 'Başlayan fiyatlarla',
    'loading' => 'Yükleniyor...',

    // ─── Üst Bilgi Çubuğu ──────────────────────────────────────────
    'topbar' => [
        'phone' => '444 7 599',
        'phone_full' => '+904447599',
        'mobile' => '+90 530 919 85 99',
        'email' => 'info@kzyfilo.com.tr',
        'working_hours' => 'Pzt - Cuma: 09:00 - 18:00',
    ],

    // ─── Header / Navigasyon ────────────────────────────────────────
    'header' => [
        'home' => 'Ana Sayfa',
        'vehicles' => 'Araçlar',
        'solutions' => 'Çözümlerimiz',
        'about' => 'Hakkımızda',
        'resources' => 'Kaynaklar',
        'contact' => 'İletişim',
        'my_list' => 'Listem',
        'get_quote' => 'Teklif Al',
        'skip_to_content' => 'İçeriğe geç',
    ],

    // ─── Mega Menü — Çözümlerimiz ───────────────────────────────────
    'solutions_menu' => [
        'long_term_rental' => 'Uzun Dönem Araç Kiralama',
        'fleet_management' => 'Filo Yönetimi',
        'passenger_rental' => 'Binek Araç Kiralama',
        'commercial_rental' => 'Ticari Araç Kiralama',
        'electric_rental' => 'Elektrikli Araç Kiralama',
        'additional_services' => 'Ek Ürün ve Hizmetler',
        'online_operations' => 'Online İşlemler',
        'delivery_return' => 'Araç Teslim ve İade',
    ],

    // ─── Mega Menü — Kaynaklar ──────────────────────────────────────
    'resources_menu' => [
        'blog' => 'Blog',
        'news' => 'Haberler',
        'faq' => 'SSS',
    ],

    // ─── Araç Kartı ─────────────────────────────────────────────────
    'vehicle_card' => [
        'fuel' => 'Yakıt',
        'transmission' => 'Vites',
        'body' => 'Kasa',
        'seats' => 'Kişi',
        'monthly_from' => 'Aylık',
        'view_details' => 'Aracı İncele',
        'add_to_list' => 'Listeme Ekle',
        'remove_from_list' => 'Listemden Çıkar',
        'compare' => 'Karşılaştır',
        'campaign' => 'Kampanyalı',
        'premium' => 'Premium',
        'fast_delivery' => 'Hızlı Teslim',
    ],

    // ─── Araç Özellikleri ───────────────────────────────────────────
    'fuel_types' => [
        'benzin' => 'Benzin',
        'dizel' => 'Dizel',
        'hibrit' => 'Hibrit',
        'elektrik' => 'Elektrik',
        'benzin-lpg' => 'Benzin + LPG',
    ],

    'transmission_types' => [
        'otomatik' => 'Otomatik',
        'manuel' => 'Manuel',
        'yarim-otomatik' => 'Yarı Otomatik',
    ],

    'body_types' => [
        'sedan' => 'Sedan',
        'hatchback' => 'Hatchback',
        'suv' => 'SUV',
        'crossover' => 'Crossover',
        'station-wagon' => 'Station Wagon',
        'minivan' => 'Minivan',
        'panelvan' => 'Panelvan',
        'pickup' => 'Pickup',
    ],

    'categories' => [
        'binek' => 'Binek Araçlar',
        'ticari' => 'Ticari Araçlar',
        'elektrikli' => 'Elektrikli Araçlar',
        'kampanyali' => 'Kampanyalı Araçlar',
        'premium' => 'Premium Araçlar',
        'hizli-teslim' => 'Hızlı Teslim Araçlar',
    ],

    // ─── Katalog / Filtreleme ───────────────────────────────────────
    'catalog' => [
        'title' => 'Araç Kataloğu',
        'description' => 'kzyfilo araç seçeneklerini inceleyin ve size uygun aracı bulun.',
        'filters' => 'Filtreler',
        'filter' => 'Filtrele',
        'clear_filters' => 'Filtreleri Temizle',
        'active_filters' => 'Aktif Filtreler',
        'results_count' => ':count araç bulundu',
        'no_results' => 'Aradığınız kriterlere uygun araç bulunamadı.',
        'no_results_desc' => 'Filtrelerinizi değiştirerek tekrar deneyin veya tüm araçlarımızı inceleyin.',
        'show_all' => 'Tüm Araçları Göster',
        'sort_by' => 'Sıralama',
        'sort_recommended' => 'Önerilen',
        'sort_price_asc' => 'Fiyat (Düşükten Yükseğe)',
        'sort_price_desc' => 'Fiyat (Yüksekten Düşüğe)',
        'sort_brand_az' => 'Marka (A - Z)',
        'sort_newest' => 'En Yeni',
        'brand' => 'Marka',
        'model' => 'Model',
        'fuel' => 'Yakıt Tipi',
        'transmission' => 'Vites',
        'body_type' => 'Kasa Tipi',
        'segment' => 'Segment',
        'seats' => 'Kişi Kapasitesi',
        'price_range' => 'Aylık Fiyat Aralığı',
        'min_price' => 'Min Fiyat',
        'max_price' => 'Maks Fiyat',
        'category' => 'Kategori',
        'all' => 'Tümü',
        'campaign_only' => 'Kampanyalı',
        'premium_only' => 'Premium',
        'fast_delivery_only' => 'Hızlı Teslim',
    ],

    // ─── Araç Detay ─────────────────────────────────────────────────
    'vehicle_detail' => [
        'title' => 'Araç Detayı',
        'share' => 'Paylaş',
        'add_compare' => 'Karşılaştırmaya Ekle',
        'monthly_rental' => 'Aylık Kira Bedeli',
        'package' => 'Hizmet Paketi',
        'deposit' => 'Peşinat',
        'duration' => 'Kira Süresi',
        'annual_km' => 'Yıllık Kilometre',
        'vehicle_count' => 'Araç Adedi',
        'custom_offer' => 'Bu seçenekler için size özel teklif hazırlayalım.',
        'quick_quote' => 'Hızlı Teklif Al',
        'compare_packages' => 'Paketleri Karşılaştır',
        'add_to_list' => 'Listeme Ekle',
        'call_me' => 'Sizi Arayalım',
        'similar_vehicles' => 'Benzer Araçlar',
        'tab_specs' => 'Teknik Detaylar',
        'tab_services' => 'Dahil ve Ek Hizmetler',
        'tab_lease_terms' => 'Kiralama Koşulları',
        'tab_rental' => 'Kira Detayları',
        'tab_faq' => 'SSS',
    ],

    // ─── Teknik Özellik Kategorileri ────────────────────────────────
    'spec_categories' => [
        'engine' => 'Motor',
        'fuel_performance' => 'Yakıt ve Performans',
        'dimensions' => 'Boyut ve Ağırlık',
        'exterior' => 'Dış Donanım',
        'safety' => 'Güvenlik',
        'interior' => 'İç Tasarım ve Konfor',
        'connectivity' => 'Bağlantı ve Teknoloji',
    ],

    // ─── Karşılaştırma ──────────────────────────────────────────────
    'compare' => [
        'title' => 'Araç Karşılaştırma',
        'description' => 'Seçtiğiniz araçları teknik özellikleri ve fiyatlarıyla yan yana karşılaştırın.',
        'compare_vehicles' => 'Karşılaştır',
        'add_vehicle' => 'Karşılaştırılacak Araç Ekle',
        'add_nth_vehicle' => '+ :n. Aracı Ekle',
        'remove' => 'Listeden Çıkar',
        'clear_all' => 'Karşılaştırmayı Temizle',
        'empty_title' => 'Karşılaştırma Listeniz Boş',
        'empty_desc' => 'Araç kataloğundan dilediğiniz araçları seçerek 4 araca kadar yan yana karşılaştırabilirsiniz.',
        'go_to_catalog' => 'Araç Kataloğuna Git',
        'highlight_diff' => 'Farklılıkları Vurgula',
        'max_warning' => 'En fazla 4 araç karşılaştırabilirsiniz.',
        'compare_now' => 'Karşılaştır',
    ],

    // ─── Listem ─────────────────────────────────────────────────────
    'my_list' => [
        'title' => 'Listem',
        'description' => 'Beğendiğiniz araçları listeleyin, karşılaştırın ve toplu teklif alın.',
        'clear_all' => 'Tüm Listeyi Temizle',
        'compare_selected' => 'Seçilenleri Karşılaştır',
        'bulk_quote' => 'Toplu Teklif Al',
        'share_list' => 'Listeyi Paylaş',
        'empty_title' => 'Listeniz Boş',
        'empty_desc' => 'Araç kataloğundan beğendiğiniz araçları listenize ekleyebilirsiniz.',
        'go_to_catalog' => 'Araçları İncele',
    ],

    // ─── Paket Karşılaştırma ────────────────────────────────────────
    'package_compare' => [
        'title' => 'Paket Karşılaştırma',
        'description' => 'Aracınız için en uygun hizmet paketini seçin.',
        'step_vehicle' => 'Araç Seçimi',
        'step_options' => 'Kiralama Seçenekleri',
        'step_packages' => 'Paket ve Ek Hizmetler',
        'step_info' => 'Bilgileriniz',
        'step_summary' => 'Teklif Özeti',
        'select_package' => 'Paketi Seç',
        'selected' => 'Seçildi',
        'most_popular' => 'En Çok Tercih Edilen',
        'compare_all' => 'Tüm Özellikleri Karşılaştır',
        'included' => 'Dahil',
        'not_included' => 'Dahil Değil',
        'additional_services' => 'Ek Hizmetler',
        'add_service' => 'Ekle',
        'remove_service' => 'Çıkar',
        'more_info' => 'Detaylı Bilgi',
        'monthly_fee' => 'Aylık',
        'one_time_fee' => 'Tek Seferlik',
        'continue_quote' => 'Teklife Devam Et',
    ],

    // ─── Teklif Özeti ───────────────────────────────────────────────
    'quote_summary' => [
        'title' => 'Teklif Özeti',
        'vehicle_rent' => 'Araç Aylık Kira Bedeli',
        'package_fee' => 'Paket Bedeli',
        'monthly_extras' => 'Aylık Ek Hizmetler',
        'one_time_extras' => 'Tek Seferlik Hizmetler',
        'discount' => 'İndirim',
        'subtotal' => 'KDV Hariç Aylık Toplam',
        'vat' => 'KDV (%20)',
        'total' => 'KDV Dahil Aylık Toplam',
        'price_disclaimer' => 'Gösterilen tutar, seçilen bilgilere göre oluşturulan tahmini aylık bedeldir. Nihai fiyat kzyfilo tarafından hazırlanacak teklif sonrasında kesinleşir.',
    ],

    // ─── Teklif Formu ───────────────────────────────────────────────
    'quote_form' => [
        'quick_title' => 'Hızlı Teklif Al',
        'quick_desc' => 'Araç ve kiralama bilgilerinizi girerek hızlıca teklif talep edin.',
        'fleet_title' => 'Filo Yönetimi Teklifi',
        'fleet_desc' => 'Kurumsal filo ihtiyaçlarınız için size özel teklif alın.',
        'step_vehicle_info' => 'Araç ve Kiralama Bilgileri',
        'step_personal' => 'Kişisel Bilgiler',
        'step_corporate' => 'Kurumsal Bilgiler',
        'step_confirm' => 'Onay ve Özet',
        'next' => 'Devam Et',
        'previous' => 'Geri',
        'submit' => 'Teklif Talep Et',
    ],

    // ─── Form Alanları ──────────────────────────────────────────────
    'form' => [
        'name' => 'Ad',
        'surname' => 'Soyad',
        'full_name' => 'Ad Soyad',
        'phone' => 'Telefon',
        'email' => 'E-posta',
        'company' => 'Şirket Adı',
        'city' => 'Şehir',
        'sector' => 'Sektör',
        'vehicle_count' => 'Talep Edilen Araç Sayısı',
        'current_vehicles' => 'Mevcut Araç Sayısı',
        'start_date' => 'Başlangıç Tarihi',
        'description' => 'Açıklama',
        'preferred_time' => 'Tercih Edilen Aranma Zamanı',
        'plate' => 'Plaka',
        'operation_type' => 'İşlem Türü',
        'file_upload' => 'Dosya Yükle',
        'required' => 'Zorunlu alan',
        'optional' => 'İsteğe bağlı',
        'select' => 'Seçiniz',
        'kvkk_consent' => 'KVKK Aydınlatma Metni\'ni okudum ve onaylıyorum.',
        'marketing_consent' => 'Ticari elektronik ileti almak istiyorum.',
        'contact_email' => 'E-posta ile iletişim',
        'contact_sms' => 'SMS ile iletişim',
        'contact_phone' => 'Telefon ile iletişim',
        'send' => 'Gönder',
        'sending' => 'Gönderiliyor...',
    ],

    // ─── Form Hata Mesajları ────────────────────────────────────────
    'errors' => [
        'required' => 'Bu alan zorunludur.',
        'email' => 'Geçerli bir e-posta adresi giriniz.',
        'phone' => 'Geçerli bir telefon numarası giriniz.',
        'min_length' => 'En az :min karakter giriniz.',
        'max_length' => 'En fazla :max karakter girebilirsiniz.',
        'kvkk_required' => 'KVKK onayı zorunludur.',
        'invalid_value' => 'Geçersiz değer.',
    ],

    // ─── Başarı Mesajları ───────────────────────────────────────────
    'success' => [
        'quote_submitted' => 'Teklif talebiniz alınmıştır.',
        'quote_prototype_notice' => 'Bu bir frontend prototipdir. Gerçek teklif kaydı oluşturulmamıştır.',
        'added_to_list' => 'Araç listenize eklendi.',
        'removed_from_list' => 'Araç listenizden çıkarıldı.',
        'added_to_compare' => 'Araç karşılaştırma listesine eklendi.',
        'removed_from_compare' => 'Araç karşılaştırma listesinden çıkarıldı.',
        'list_cleared' => 'Listeniz temizlendi.',
    ],

    // ─── Ana Sayfa ──────────────────────────────────────────────────
    'home' => [
        'title' => 'Ana Sayfa',
        'meta_desc' => 'kzyfilo ile kurumsal araç kiralama ve filo yönetimi çözümlerini keşfedin.',
        'hero_subtitle' => 'Kurumsal Filo Çözümleri',
        'hero_title_1' => 'İşletmeniz İçin Akıllı Filo Yönetimi',
        'hero_desc_1' => 'Uzun dönem araç kiralama ile işletme maliyetlerinizi optimize edin.',
        'hero_cta_vehicles' => 'Araçları İncele',
        'hero_cta_quote' => 'Teklif Al',
        'search_title' => 'Araç Bul',
        'search_btn' => 'Araç Bul',
        'featured_title' => 'Akıllı Filo Çözümünüzü Seçmeye Hazır mısınız?',
        'featured_subtitle' => 'Kurumsal araç kiralama seçeneklerimizi inceleyin',
        'categories_title' => 'Araç Kategorileri',
        'categories_subtitle' => 'İhtiyacınıza uygun araç kategorisini seçin',
        'stats_title' => 'Rakamlarla kzyfilo',
        'stats_subtitle' => 'Demo veriler',
        'process_title' => 'Nasıl Çalışır?',
        'process_subtitle' => 'Beş adımda kurumsal araç kiralama',
        'process_step1_title' => 'Araçları Filtrele',
        'process_step1_desc' => 'Araçları filtrele ve ihtiyacına uygun aracı seç.',
        'process_step2_title' => 'Seçeneklerini Belirle',
        'process_step2_desc' => 'Paket, süre ve kilometre seçeneklerini belirle.',
        'process_step3_title' => 'Listene Ekle',
        'process_step3_desc' => 'Beğendiğin aracı listene ekle.',
        'process_step4_title' => 'Bilgilerini Doldur',
        'process_step4_desc' => 'Kişisel ve kurumsal bilgilerini doldur.',
        'process_step5_title' => 'Teklif Bekle',
        'process_step5_desc' => 'kzyfilo temsilcisinin seninle iletişime geçmesini bekle.',
        'solutions_title' => 'Filo Çözümlerimiz',
        'solutions_subtitle' => 'İşletmenize değer katan çözümler',
        'sol_finance' => 'Esnek Finans Yönetimi',
        'sol_finance_desc' => 'Bütçenize uygun ödeme planları ile finansal esneklik sağlayın.',
        'sol_invoice' => 'Sürprizsiz Fatura',
        'sol_invoice_desc' => 'Önceden belirlenmiş sabit aylık ödemelerle bütçenizi kontrol altında tutun.',
        'sol_time' => 'Zamandan Tasarruf',
        'sol_time_desc' => 'Araç yönetim süreçlerini bize bırakın, işinize odaklanın.',
        'sol_operations' => 'Operasyonel Kolaylık',
        'sol_operations_desc' => 'Bakım, sigorta, lastik ve tüm operasyonel süreçler bizde.',
        'sol_maintenance' => 'Bakım ve Hasar Yönetimi',
        'sol_maintenance_desc' => 'Yetkili servislerde periyodik bakım ve profesyonel hasar yönetimi.',
        'sol_roadside' => 'Yol Yardım Hizmetleri',
        'sol_roadside_desc' => '7/24 yol yardım desteği ile her an yanınızdayız.',
        'references_title' => 'Referanslarımız',
        'references_subtitle' => 'Bize güvenen kurumlar',
        'resources_title' => 'Kaynaklar',
        'resources_subtitle' => 'Blog, haberler ve güncel içerikler',
        'cta_title' => 'Filonuz için doğru aracı birlikte seçelim.',
        'cta_desc' => 'Kurumsal araç kiralama ihtiyaçlarınız için hemen iletişime geçin.',
        'cta_vehicles' => 'Araçları İncele',
        'cta_quote' => 'Teklif Al',
        'cta_call' => 'Sizi Arayalım',
    ],

    // ─── Footer ─────────────────────────────────────────────────────
    'footer' => [
        'about_text' => 'kzyfilo, şirketlere ve profesyonellere uzun dönem araç kiralama ve filo yönetimi hizmetleri sunan kurumsal bir markadır.',
        'menu_solutions' => 'Çözümlerimiz',
        'menu_corporate' => 'Kurumsal',
        'menu_resources' => 'Kaynaklar',
        'menu_legal' => 'Yasal',
        'sitemap' => 'Site Haritası',
        'kvkk' => 'KVKK',
        'privacy' => 'Gizlilik Politikası',
        'cookies' => 'Çerez Politikası',
        'legal_notice' => 'Yasal Uyarı',
        'contact_info' => 'İletişim Bilgileri',
        'address' => 'Çobançeşme Mah. Kımız Sk. No:38/A NISSAN KUZEY PLAZA, Bahçelievler/İstanbul',
        'copyright' => '© :year kzyfilo. Tüm hakları saklıdır.',
        'all_rights' => 'Tüm hakları saklıdır.',
    ],

    // ─── Floating Contact ───────────────────────────────────────────
    'floating' => [
        'title' => 'Size Nasıl Yardımcı Olabiliriz?',
        'contact_form' => 'İletişim Formu',
        'phone' => 'Telefon',
        'whatsapp' => 'WhatsApp',
        'faq' => 'SSS',
        'callback' => 'Sizi Arayalım',
    ],

    // ─── Sizi Arayalım Modal ────────────────────────────────────────
    'callback' => [
        'title' => 'Sizi Arayalım',
        'desc' => 'Bilgilerinizi bırakın, sizi arayalım.',
        'preferred_time' => 'Tercih Edilen Aranma Zamanı',
        'time_morning' => 'Sabah (09:00 - 12:00)',
        'time_afternoon' => 'Öğleden Sonra (12:00 - 15:00)',
        'time_evening' => 'Akşam (15:00 - 18:00)',
        'time_anytime' => 'Fark Etmez',
        'submit' => 'Aranma Talebi Oluştur',
    ],

    // ─── Çerez Banner ───────────────────────────────────────────────
    'cookies' => [
        'title' => 'Çerez Tercihleri',
        'description' => 'Bu web sitesi, deneyiminizi geliştirmek için çerezleri kullanmaktadır. Tercihlerinizi aşağıdan yönetebilirsiniz.',
        'required' => 'Zorunlu Çerezler',
        'required_desc' => 'Sitenin temel işlevleri için gerekli çerezlerdir.',
        'analytics' => 'Analitik Çerezler',
        'analytics_desc' => 'Site kullanımını analiz etmemize yardımcı olur.',
        'marketing' => 'Pazarlama Çerezleri',
        'marketing_desc' => 'Size özel reklamlar göstermek için kullanılır.',
        'accept_all' => 'Tümünü Kabul Et',
        'accept_required' => 'Yalnızca Zorunlu',
        'manage' => 'Tercihleri Yönet',
        'save' => 'Tercihleri Kaydet',
    ],

    // ─── Breadcrumb ─────────────────────────────────────────────────
    'breadcrumb' => [
        'home' => 'Ana Sayfa',
    ],

    // ─── 404 / 500 ──────────────────────────────────────────────────
    'error' => [
        '404_title' => 'Sayfa Bulunamadı',
        '404_desc' => 'Aradığınız sayfa bulunamadı veya kaldırılmış olabilir.',
        '404_btn' => 'Ana Sayfaya Dön',
        '500_title' => 'Sunucu Hatası',
        '500_desc' => 'Beklenmeyen bir hata oluştu. Lütfen daha sonra tekrar deneyin.',
        '500_btn' => 'Ana Sayfaya Dön',
    ],

    // ─── İletişim ───────────────────────────────────────────────────
    'contact' => [
        'title' => 'İletişim',
        'description' => 'kzyfilo ile iletişime geçin. Sorularınız ve teklif talepleriniz için bize ulaşın.',
        'address_title' => 'Adres',
        'phone_title' => 'Telefon',
        'email_title' => 'E-posta',
        'hours_title' => 'Çalışma Saatleri',
        'form_title' => 'Bize Yazın',
        'whatsapp' => 'WhatsApp ile İletişim',
    ],

    // ─── SSS ────────────────────────────────────────────────────────
    'faq' => [
        'title' => 'Sıkça Sorulan Sorular',
        'description' => 'Uzun dönem araç kiralama ve filo yönetimi hakkında merak edilenler.',
    ],

    // ─── Hakkımızda ─────────────────────────────────────────────────
    'about' => [
        'title' => 'Hakkımızda',
        'description' => 'kzyfilo hakkında bilgi edinin.',
    ],

    // ─── Hizmet Sayfaları ───────────────────────────────────────────
    'services' => [
        'title' => 'Çözümlerimiz',
        'description' => 'kzyfilo kurumsal filo çözümlerini keşfedin.',
        'long_term_title' => 'Uzun Dönem Araç Kiralama',
        'long_term_desc' => 'İşletmeniz için esnek ve avantajlı uzun dönem araç kiralama çözümleri.',
        'fleet_title' => 'Filo Yönetimi',
        'fleet_desc' => 'Profesyonel filo yönetimi ile operasyonel verimliliğinizi artırın.',
        'passenger_title' => 'Binek Araç Kiralama',
        'passenger_desc' => 'Kurumsal binek araç kiralama çözümleri.',
        'commercial_title' => 'Ticari Araç Kiralama',
        'commercial_desc' => 'İşletmenize uygun ticari araç kiralama seçenekleri.',
        'electric_title' => 'Elektrikli Araç Kiralama',
        'electric_desc' => 'Sürdürülebilir filo yönetimi için elektrikli araç kiralama.',
        'additional_title' => 'Ek Ürün ve Hizmetler',
        'additional_desc' => 'Filo yönetiminizi destekleyen ek ürün ve hizmetler.',
        'delivery_title' => 'Araç Teslim ve İade',
        'delivery_desc' => 'Araç teslim alma ve iade süreçleri hakkında bilgi alın.',
    ],

    // ─── Online İşlemler ────────────────────────────────────────────
    'online' => [
        'title' => 'Online İşlemler',
        'description' => 'Araçlarınızla ilgili taleplerinizi online olarak iletin.',
        'maintenance' => 'Bakım Talebi',
        'damage' => 'Hasar Bildirimi',
        'tire' => 'Lastik İşlemi',
        'replacement' => 'Yedek Araç Talebi',
        'hgs' => 'HGS İşlemi',
        'fine' => 'Ceza İşlemi',
        'change' => 'Araç Değişikliği',
        'return' => 'Araç İade Talebi',
        'other' => 'Diğer',
    ],

    // ─── Blog / Haberler ────────────────────────────────────────────
    'content' => [
        'blog' => 'Blog',
        'news' => 'Haberler',
        'announcement' => 'Duyuru',
        'podcast' => 'Podcast',
        'read_more' => 'Devamını Oku',
        'listen' => 'Dinle',
        'min_read' => 'dk okuma',
        'min_listen' => 'dk dinleme',
        'published' => 'Yayınlanma',
        'blog_title' => 'Blog',
        'blog_desc' => 'kzyfilo blog yazıları ve sektörel içerikler.',
        'news_title' => 'Haberler',
        'news_desc' => 'kzyfilo haberleri ve duyuruları.',
        'podcast_title' => 'Podcast',
        'podcast_desc' => 'kzyfilo podcast içerikleri.',
    ],

    // ─── Genel Butonlar ─────────────────────────────────────────────
    'btn' => [
        'view_all' => 'Tümünü Gör',
        'learn_more' => 'Daha Fazla',
        'back' => 'Geri',
        'close' => 'Kapat',
        'save' => 'Kaydet',
        'cancel' => 'İptal',
        'confirm' => 'Onayla',
        'scroll_top' => 'Sayfa Başına Dön',
        'get_directions' => 'Yol Tarifi Al',
    ],

    // ─── Referanslar ────────────────────────────────────────────────
    'references' => [
        'title' => 'Referanslar',
        'description' => 'kzyfilo referansları.',
    ],

    // ─── Ofisler ────────────────────────────────────────────────────
    'offices' => [
        'title' => 'Ofisler',
        'description' => 'kzyfilo ofis ve şube bilgileri.',
        'filter_city' => 'Şehir Seçin',
        'all_cities' => 'Tüm Şehirler',
        'working_hours' => 'Çalışma Saatleri',
    ],

    // ─── İade Noktaları ─────────────────────────────────────────────
    'return_points' => [
        'title' => 'Araç İade Noktaları',
        'description' => 'kzyfilo araç iade noktaları.',
        'create_request' => 'İade Talebi Oluştur',
    ],

    // ─── Yasal ──────────────────────────────────────────────────────
    'legal' => [
        'kvkk_title' => 'KVKK Aydınlatma Metni',
        'privacy_title' => 'Gizlilik Politikası',
        'cookie_title' => 'Çerez Politikası',
        'legal_title' => 'Yasal Uyarı',
    ],

    // ─── Site Haritası ──────────────────────────────────────────────
    'sitemap' => [
        'title' => 'Site Haritası',
        'description' => 'kzyfilo web sitesi sayfaları.',
    ],

    // ─── Pagination ─────────────────────────────────────────────────
    'pagination' => [
        'previous' => 'Önceki',
        'next' => 'Sonraki',
        'page' => 'Sayfa :page',
    ],
];
