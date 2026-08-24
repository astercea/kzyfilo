<?php
/**
 * kzyfilo — Ofisler ve Araç İade Noktaları Demo Verisi
 */

return [
    'offices' => [
        [
            'id' => 1,
            'name' => 'kzyfilo Genel Müdürlük & Merkez Plaza',
            'city' => 'İstanbul',
            'district' => 'Bahçelievler',
            'address' => 'Çobançeşme Mah. Kımız Sk. No:38/A NISSAN KUZEY PLAZA, Bahçelievler/İstanbul',
            'phone' => '444 7 599',
            'mobile' => '+90 530 919 85 99',
            'email' => 'info@kzyfilo.com.tr',
            'hours' => 'Hafta İçi: 08:30 - 18:30 | Cumartesi: 09:00 - 14:00',
            'is_headquarters' => true,
            'services' => ['Kiralama Ofisi', 'Araç Teslimat', 'İade Kabul', 'VIP Vale']
        ],
        [
            'id' => 2,
            'name' => 'kzyfilo İstanbul Anadolu Yakası Şubesi',
            'city' => 'İstanbul',
            'district' => 'Ataşehir',
            'address' => 'Barbaros Mah. Mor Sümbül Sk. Varyap Meridian Grand Tower No:1/A, Ataşehir/İstanbul',
            'phone' => '0216 555 85 99',
            'mobile' => '+90 530 919 85 98',
            'email' => 'anadolu@kzyfilo.com.tr',
            'hours' => 'Hafta İçi: 09:00 - 18:00',
            'is_headquarters' => false,
            'services' => ['Kiralama Ofisi', 'Araç Teslimat', 'İade Kabul']
        ],
        [
            'id' => 3,
            'name' => 'kzyfilo Ankara Bölge Müdürlüğü',
            'city' => 'Ankara',
            'district' => 'Çankaya',
            'address' => 'Mustafa Kemal Mah. Dumlupınar Bulv. No:274 Tepe Prime Blokları C/14, Çankaya/Ankara',
            'phone' => '0312 444 75 99',
            'mobile' => '+90 530 919 85 97',
            'email' => 'ankara@kzyfilo.com.tr',
            'hours' => 'Hafta İçi: 09:00 - 18:00',
            'is_headquarters' => false,
            'services' => ['Kiralama Ofisi', 'Araç Teslimat', 'İade Kabul']
        ],
        [
            'id' => 4,
            'name' => 'kzyfilo İzmir Bölge Müdürlüğü',
            'city' => 'İzmir',
            'district' => 'Bayraklı',
            'address' => 'Adalet Mah. Manas Bulv. No:47 Folkart Towers B Kule K:22, Bayraklı/İzmir',
            'phone' => '0232 444 75 99',
            'mobile' => '+90 530 919 85 96',
            'email' => 'izmir@kzyfilo.com.tr',
            'hours' => 'Hafta İçi: 09:00 - 18:00',
            'is_headquarters' => false,
            'services' => ['Kiralama Ofisi', 'Araç Teslimat', 'İade Kabul']
        ]
    ],

    'return_points' => [
        [
            'id' => 1,
            'name' => 'İstanbul Avrupa İade Noktası — Kuzey Plaza',
            'city' => 'İstanbul',
            'district' => 'Bahçelievler',
            'address' => 'Çobançeşme Mah. Kımız Sk. No:38/A NISSAN KUZEY PLAZA, Bahçelievler/İstanbul',
            'phone' => '444 7 599',
            'hours' => 'Hafta İçi: 08:30 - 18:00',
            'inspector_available' => true
        ],
        [
            'id' => 2,
            'name' => 'İstanbul Havalimanı (IST) Lojistik İade Sahası',
            'city' => 'İstanbul',
            'district' => 'Arnavutköy',
            'address' => 'İstanbul Havalimanı Otoparklar Bölgesi Kapalı Alan P-6, Arnavutköy/İstanbul',
            'phone' => '444 7 599',
            'hours' => '7/24 Randevulu Kabul',
            'inspector_available' => true
        ],
        [
            'id' => 3,
            'name' => 'İstanbul Sabiha Gökçen (SAW) İade Sahası',
            'city' => 'İstanbul',
            'district' => 'Pendik',
            'address' => 'Sabiha Gökçen Havalimanı Karşılama ve Lojistik Sahası No:12, Pendik/İstanbul',
            'phone' => '444 7 599',
            'hours' => '7/24 Randevulu Kabul',
            'inspector_available' => true
        ],
        [
            'id' => 4,
            'name' => 'Ankara Esenboğa & Tepe Prime İade Noktası',
            'city' => 'Ankara',
            'district' => 'Çankaya',
            'address' => 'Mustafa Kemal Mah. Dumlupınar Bulv. No:274 C Blok Kapalı Otopark, Çankaya/Ankara',
            'phone' => '0312 444 75 99',
            'hours' => 'Hafta İçi: 09:00 - 17:30',
            'inspector_available' => true
        ],
        [
            'id' => 5,
            'name' => 'İzmir Bayraklı & Adnan Menderes İade Sahası',
            'city' => 'İzmir',
            'district' => 'Bayraklı',
            'address' => 'Adalet Mah. Manas Bulv. Folkart Towers B Kule Otopark Alanı, Bayraklı/İzmir',
            'phone' => '0232 444 75 99',
            'hours' => 'Hafta İçi: 09:00 - 17:30',
            'inspector_available' => true
        ]
    ]
];
