<?php
/**
 * kzyfilo — Hizmet Paketleri Demo Verisi
 * 
 * 3 Seviye: Başlangıç, Avantaj, Tam Güvence
 */

return [
    'basic' => [
        'id' => 'basic',
        'name' => 'Başlangıç Paketi',
        'tagline' => 'Temel Operasyonel İhtiyaçlar',
        'description' => 'Standart kiralama ve temel periyodik bakım hizmetlerini içeren ekonomik paket.',
        'is_popular' => false,
        'monthly_diff' => 0,
        'features' => [
            'periyodik_bakim' => ['name' => 'Yetkili Servis Periyodik Bakımları', 'included' => true],
            'zorunlu_trafik' => ['name' => 'Zorunlu Trafik Sigortası', 'included' => true],
            'kasko' => ['name' => 'Standart Kasko Poliçesi', 'included' => true],
            'yol_yardim' => ['name' => '7/24 Standart Yol Yardım', 'included' => true],
            'ikame_arac' => ['name' => 'İkame Araç (Yılda 2 defa, maks 5 gün)', 'included' => true],
            'lastik_degisim' => ['name' => 'Mevsimlik Lastik Değişimi & Saklama', 'included' => false],
            'mini_hasar' => ['name' => 'Mini Hasar Güvencesi (Beyansız)', 'included' => false],
            'vip_vale' => ['name' => 'VIP Vale & Adrese Teslim', 'included' => false],
            'arac_takip' => ['name' => 'Telematik & Araç Takip Sistemi', 'included' => false],
            'hgs_yonetimi' => ['name' => 'HGS Otomatik Yönetim & Raporlama', 'included' => false],
        ]
    ],

    'advantage' => [
        'id' => 'advantage',
        'name' => 'Avantaj Paketi',
        'tagline' => 'En Çok Tercih Edilen Kapsam',
        'description' => 'Mevsimlik lastik, ikame araç ve ek güvenceleriyle kesintisiz iş akışı sağlayan dengeli paket.',
        'is_popular' => true,
        'monthly_diff' => 1350,
        'features' => [
            'periyodik_bakim' => ['name' => 'Yetkili Servis Periyodik Bakımları', 'included' => true],
            'zorunlu_trafik' => ['name' => 'Zorunlu Trafik Sigortası', 'included' => true],
            'kasko' => ['name' => 'Genişletilmiş Kasko Poliçesi (Muafiyetsiz)', 'included' => true],
            'yol_yardim' => ['name' => '7/24 Kesintisiz Yol Yardım & Çekici', 'included' => true],
            'ikame_arac' => ['name' => 'Sınırsız İkame Araç (Benzer Segment)', 'included' => true],
            'lastik_degisim' => ['name' => 'Premium Kış/Yaz Lastik Değişimi & Otel', 'included' => true],
            'mini_hasar' => ['name' => 'Mini Hasar Güvencesi (Yıllık 3 adet)', 'included' => true],
            'vip_vale' => ['name' => 'VIP Servis Vale Hizmeti', 'included' => false],
            'arac_takip' => ['name' => 'Telematik & Araç Takip Sistemi', 'included' => false],
            'hgs_yonetimi' => ['name' => 'HGS Otomatik Yönetim & Raporlama', 'included' => true],
        ]
    ],

    'full' => [
        'id' => 'full',
        'name' => 'Tam Güvence Paketi',
        'tagline' => 'Eksiksiz 360° Filo Güvencesi',
        'description' => 'Vale hizmeti, telematik araç takibi, sınırsız lastik ve en üst düzey VIP güvenceleriyle tam kapsamlı çözüm.',
        'is_popular' => false,
        'monthly_diff' => 2950,
        'features' => [
            'periyodik_bakim' => ['name' => 'Öncelikli Yetkili Servis Bakımları', 'included' => true],
            'zorunlu_trafik' => ['name' => 'Zorunlu Trafik Sigortası', 'included' => true],
            'kasko' => ['name' => 'Tam Kapsamlı VIP Kasko & Ferdi Kaza', 'included' => true],
            'yol_yardim' => ['name' => '7/24 Öncelikli VIP Yol Yardım', 'included' => true],
            'ikame_arac' => ['name' => 'Anında Üst Segment İkame Araç', 'included' => true],
            'lastik_degisim' => ['name' => 'Sınırsız Premium Lastik & Lastik Oteli', 'included' => true],
            'mini_hasar' => ['name' => 'Sınırsız Beyansız Mini Hasar Güvencesi', 'included' => true],
            'vip_vale' => ['name' => 'Sınırsız Kapıdan Kapıya VIP Vale', 'included' => true],
            'arac_takip' => ['name' => 'Canlı Telematik Araç Takip & Yakıt Raporlama', 'included' => true],
            'hgs_yonetimi' => ['name' => 'Tam Entegre HGS ve Ceza Yönetimi', 'included' => true],
        ]
    ]
];
