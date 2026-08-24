<?php
/**
 * kzyfilo — Ek Ürün ve Hizmetler Demo Verisi
 */

return [
    [
        'id' => 'winter_tires',
        'name' => 'Kış Lastiği & Lastik Oteli',
        'description' => 'Mevsim geçişlerinde ücretsiz montaj, balans ve güvenli depolama hizmeti.',
        'price' => 450,
        'type' => 'monthly', // monthly veya one_time
        'icon' => 'tire',
        'info' => 'Kış aylarında zorunlu olan kış lastiği gereksinimini kaliteli marka lastiklerle karşılar, sezon bitiminde depolama sorununu çözer.'
    ],
    [
        'id' => 'extra_driver',
        'name' => 'Ek Sürücü Yetkisi',
        'description' => 'Şirketinizde aracı kullanacak ilave sürücülerin sigorta kapsamına dahil edilmesi.',
        'price' => 200,
        'type' => 'monthly',
        'icon' => 'user-plus',
        'info' => 'Belirleyeceğiniz şirket çalışanlarının kasko ve sigorta teminatları altında aracı güvenle kullanabilmesini sağlar.'
    ],
    [
        'id' => 'telematics_gps',
        'name' => 'Canlı GPS Araç Takip & Raporlama',
        'description' => 'Mobil uygulama ve web panelinden 7/24 konum, hız, rota ve yakıt verimliliği takibi.',
        'price' => 350,
        'type' => 'monthly',
        'icon' => 'navigation',
        'info' => 'Saha ekiplerinin rota optimizasyonunu sağlar, yakıt tasarrufu ve filo güvenliği sunar.'
    ],
    [
        'id' => 'vip_delivery',
        'name' => 'Adrese Özel VIP Teslimat',
        'description' => 'Aracınızın şirket adresinize veya dilediğiniz lokasyona uzman personel ile teslimi.',
        'price' => 1500,
        'type' => 'one_time',
        'icon' => 'map-pin',
        'info' => 'Zaman kaybetmeden, evrak ve teslim tutanağı dahil olmak üzere aracınızı kapınızda teslim alma ayrıcalığı.'
    ],
    [
        'id' => 'fuel_management',
        'name' => 'Otobil / Taşıt Tanıma Entegrasyonu',
        'description' => 'Anlaşmalı akaryakıt istasyonlarında araçtan inmeden temassız yakıt ikmali ve merkezi faturalandırma.',
        'price' => 150,
        'type' => 'monthly',
        'icon' => 'fuel',
        'info' => 'Tüm yakıt harcamalarınızı tek faturada toplayarak muhasebe süreçlerini kolaylaştırır ve indirimli yakıt avantajı sunar.'
    ],
    [
        'id' => 'mini_damage_waiver',
        'name' => 'Ekstra Mini Hasar Güvencesi',
        'description' => 'Tutanak veya beyana gerek kalmaksızın küçük boya, göçük ve cam hasarlarının onarımı.',
        'price' => 280,
        'type' => 'monthly',
        'icon' => 'shield',
        'info' => 'Günlük kullanımda oluşabilecek küçük çizik, göçük ve cam kırılmalarını kaskoyu bozmadan onarır.'
    ]
];
