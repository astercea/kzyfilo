<?php
/**
 * kzyfilo — Favori Araç Listem (listem.php)
 * KZY Executive Motion — Redesigned Fleet Favorites & Consolidated Quotation System
 */
require_once __DIR__ . '/includes/config.php';

$vehicles = loadData('vehicles.php');

setPageMeta([
    'title' => t('my_list.title') . ' | ' . SITE_NAME,
    'description' => t('my_list.description'),
    'canonical' => canonical('listem.php'),
]);

$breadcrumbs = [
    ['title' => t('catalog.title'), 'url' => url('araclar.php')],
    ['title' => t('my_list.title')]
];

include includePath('header.php');
?>

<!-- ─── 1. PAGE HEADER & LIVE METRICS ──────────────────────────────── -->
<div class="page-header favorites-header-banner">
    <div class="container">
        <div class="favorites-header-content">
            <div class="favorites-header-left" data-reveal="fade-up">
                <span class="badge badge-accent mb-2">KZY Executive List</span>
                <h1 class="page-title"><?php e('my_list.title'); ?></h1>
                <p class="page-subtitle"><?php e('my_list.subtitle'); ?></p>
                <?php include includePath('breadcrumbs.php'); ?>
            </div>

            <!-- Canlı Liste İstatistikleri (Dinamik JS) -->
            <div class="favorites-header-metrics hidden" id="favorites-hero-metrics" data-reveal="fade-left">
                <div class="fav-metric-card">
                    <span class="fav-metric-label"><?php e('my_list.total_vehicles'); ?></span>
                    <div class="fav-metric-val">
                        <span id="metric-total-count">0</span>
                        <small>Model</small>
                    </div>
                </div>
                <div class="fav-metric-divider"></div>
                <div class="fav-metric-card">
                    <span class="fav-metric-label"><?php e('my_list.est_monthly'); ?></span>
                    <div class="fav-metric-val text-accent">
                        <span id="metric-total-price">0</span>
                        <small>₺ / ay</small>
                    </div>
                </div>
                <div class="fav-metric-divider"></div>
                <div class="fav-metric-card">
                    <span class="fav-metric-label">Vergi Avantajı</span>
                    <div class="fav-metric-val">
                        <span>%100</span>
                        <small>Gider Gösterme</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ─── 2. MAIN FAVORITES SECTION ──────────────────────────────────── -->
<section class="section favorites-main-section">
    <div class="container">
        
        <!-- ─── A) AKTİF LİSTE GÖRÜNÜMÜ (1+ ARAÇ VARKEN) ──────────────── -->
        <div id="favorites-active-view" class="hidden">
            
            <!-- Akıllı Yönetim & Aksiyon Araç Çubuğu -->
            <div class="favorites-toolbar" id="favorites-toolbar">
                
                <!-- Sol: Kategori Filtre Tabları -->
                <div class="favorites-toolbar-filters">
                    <button type="button" class="fav-filter-tab is-active" data-cat="all">
                        <span>Tümü</span>
                        <span class="fav-filter-count" id="count-tab-all">0</span>
                    </button>
                    <button type="button" class="fav-filter-tab" data-cat="binek">
                        <span>Binek</span>
                        <span class="fav-filter-count" id="count-tab-binek">0</span>
                    </button>
                    <button type="button" class="fav-filter-tab" data-cat="ticari">
                        <span>Ticari</span>
                        <span class="fav-filter-count" id="count-tab-ticari">0</span>
                    </button>
                    <button type="button" class="fav-filter-tab" data-cat="ev">
                        <span>Elektrikli & Hybrid</span>
                        <span class="fav-filter-count" id="count-tab-ev">0</span>
                    </button>
                </div>

                <!-- Sağ: Görünüm & Toplu Aksiyonlar -->
                <div class="favorites-toolbar-actions">
                    <!-- Sıralama Dropdown -->
                    <div class="fav-sort-wrap">
                        <select id="fav-sort-select" class="form-select fav-sort-select" aria-label="Sıralama">
                            <option value="default"><?php e('my_list.sort_default'); ?></option>
                            <option value="price-asc"><?php e('my_list.sort_price_asc'); ?></option>
                            <option value="price-desc"><?php e('my_list.sort_price_desc'); ?></option>
                            <option value="brand-asc"><?php e('my_list.sort_brand_asc'); ?></option>
                        </select>
                    </div>

                    <!-- Görünüm Seçici (Grid vs List) -->
                    <div class="fav-view-toggle">
                        <button type="button" class="fav-view-btn is-active" id="btn-view-grid" title="<?php e('my_list.view_grid'); ?>">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="3" width="7" height="7"></rect>
                                <rect x="14" y="3" width="7" height="7"></rect>
                                <rect x="14" y="14" width="7" height="7"></rect>
                                <rect x="3" y="14" width="7" height="7"></rect>
                            </svg>
                        </button>
                        <button type="button" class="fav-view-btn" id="btn-view-list" title="<?php e('my_list.view_list'); ?>">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="8" y1="6" x2="21" y2="6"></line>
                                <line x1="8" y1="12" x2="21" y2="12"></line>
                                <line x1="8" y1="18" x2="21" y2="18"></line>
                                <line x1="3" y1="6" x2="3.01" y2="6"></line>
                                <line x1="3" y1="12" x2="3.01" y2="12"></line>
                                <line x1="3" y1="18" x2="3.01" y2="18"></line>
                            </svg>
                        </button>
                    </div>

                    <div class="fav-actions-divider"></div>

                    <!-- Toplu Teklif Butonu (Vurgulu) -->
                    <button type="button" class="btn btn-primary btn-sm btn-bulk-quote-trigger" id="btn-bulk-quote-open">
                        <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2">
                            <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                        </svg>
                        <span><?php e('my_list.bulk_quote'); ?></span>
                    </button>

                    <!-- Karşılaştırmaya Aktar -->
                    <button type="button" class="btn btn-outline btn-sm" id="btn-export-compare" title="<?php e('my_list.compare_selected'); ?>">
                        <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 3v18"></path>
                            <path d="M6 7l6-3 6 3"></path>
                            <path d="M3 13l3-6 3 6a3 3 0 0 1-6 0z"></path>
                            <path d="M15 13l3-6 3 6a3 3 0 0 1-6 0z"></path>
                            <path d="M4 21h16"></path>
                        </svg>
                        <span><?php e('my_list.compare_selected'); ?></span>
                    </button>

                    <!-- Paylaş -->
                    <button type="button" class="btn btn-ghost btn-sm" id="btn-share-list" title="<?php e('my_list.share_list'); ?>">
                        <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="18" cy="5" r="3"></circle>
                            <circle cx="6" cy="12" r="3"></circle>
                            <circle cx="18" cy="19" r="3"></circle>
                            <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                            <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
                        </svg>
                        <span>Paylaş</span>
                    </button>

                    <!-- Yazdır / PDF -->
                    <button type="button" class="btn btn-ghost btn-sm" id="btn-print-list" title="<?php e('my_list.print_list'); ?>">
                        <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 6 2 18 2 18 9"></polyline>
                            <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                            <rect x="6" y="14" width="12" height="8"></rect>
                        </svg>
                    </button>

                    <!-- Tümünü Temizle -->
                    <button type="button" class="btn btn-ghost btn-sm text-error" id="btn-clear-favorites" title="<?php e('my_list.clear_all'); ?>">
                        <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                        </svg>
                        <span><?php e('my_list.clear_all'); ?></span>
                    </button>
                </div>
            </div>

            <!-- 2 Sütunlu Ana Gövde Düzeni (Sol: Araçlar, Sağ: Sticky Filo Özeti) -->
            <div class="favorites-layout-grid">
                
                <!-- Sol Sütun: Araç Kartları / Tablosu -->
                <div class="favorites-content-col">
                    <div class="favorites-vehicle-grid" id="favorites-vehicle-grid">
                        <!-- Populated dynamically via JS -->
                    </div>
                </div>

                <!-- Sağ Sütun: Sabit Sticky Executive Kurumsal Filo Teklif Özeti -->
                <aside class="favorites-sidebar-col">
                    <div class="favorites-summary-card" id="favorites-summary-card">
                        
                        <div class="fav-summary-header">
                            <div class="fav-summary-badge">
                                <span class="pulse-dot"></span>
                                <span>Canlı Filo Simülasyonu</span>
                            </div>
                            <h3 class="fav-summary-title"><?php e('my_list.summary_title'); ?></h3>
                            <p class="fav-summary-desc"><?php e('my_list.summary_desc'); ?></p>
                        </div>

                        <!-- Seçili Modeller Listesi (Mini Chip'ler) -->
                        <div class="fav-summary-chips" id="fav-summary-chips-container">
                            <!-- Populated dynamically -->
                        </div>

                        <!-- Finansal Maliyet Kırılımı -->
                        <div class="fav-summary-pricing">
                            <div class="fav-pricing-row">
                                <span class="fav-pricing-label"><?php e('my_list.total_vehicles'); ?></span>
                                <span class="fav-pricing-val" id="summary-vehicle-count">0 Adet</span>
                            </div>
                            <div class="fav-pricing-row">
                                <span class="fav-pricing-label"><?php e('my_list.est_monthly'); ?> (KDV Hariç)</span>
                                <span class="fav-pricing-val font-semibold" id="summary-subtotal">0 ₺ / ay</span>
                            </div>
                            <div class="fav-pricing-row text-muted">
                                <span class="fav-pricing-label"><?php e('my_list.est_monthly_vat'); ?></span>
                                <span class="fav-pricing-val" id="summary-vat">0 ₺ / ay</span>
                            </div>
                            <div class="fav-pricing-divider"></div>
                            <div class="fav-pricing-total">
                                <div>
                                    <span class="fav-total-title"><?php e('my_list.est_total_monthly'); ?></span>
                                    <small class="fav-total-note">Aylık Tahmini Toplam Kira</small>
                                </div>
                                <div class="fav-total-amount" id="summary-grand-total">0 ₺</div>
                            </div>
                        </div>

                        <!-- Dahil Olan Kurumsal Avantajlar -->
                        <div class="fav-summary-benefits">
                            <span class="fav-benefits-title"><?php e('my_list.included_services'); ?></span>
                            <ul class="fav-benefits-list">
                                <li>
                                    <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    <span><?php e('my_list.service_maintenance'); ?></span>
                                </li>
                                <li>
                                    <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    <span><?php e('my_list.service_insurance'); ?></span>
                                </li>
                                <li>
                                    <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    <span><?php e('my_list.service_assistance'); ?></span>
                                </li>
                                <li>
                                    <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    <span><?php e('my_list.service_replacement'); ?></span>
                                </li>
                                <li>
                                    <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    <span><?php e('my_list.service_tyres'); ?></span>
                                </li>
                            </ul>
                        </div>

                        <!-- Aksiyon Butonları -->
                        <div class="fav-summary-actions">
                            <button type="button" class="btn btn-primary btn-lg w-full btn-bulk-quote-trigger" id="btn-sidebar-bulk-quote">
                                <span><?php e('my_list.request_fleet_quote'); ?></span>
                                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                            </button>

                            <a href="tel:08503005999" class="btn btn-outline btn-sm w-full fav-call-btn">
                                <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                                <span>0850 300 59 99 — <?php e('my_list.connect_advisor'); ?></span>
                            </a>
                        </div>

                        <p class="fav-vat-disclaimer"><?php e('my_list.vat_note'); ?></p>
                    </div>
                </aside>

            </div>
        </div>

        <!-- ─── B) BOŞ DURUM & POPÜLER ARAÇ ÖNERİLERİ (0 ARAÇ VARKEN) ── -->
        <div id="favorites-empty-view" class="favorites-empty-wrapper">
            
            <div class="favorites-empty-hero card" data-reveal="fade-up">
                <div class="fav-empty-icon-wrap">
                    <div class="fav-empty-icon-pulse"></div>
                    <svg viewBox="0 0 24 24" width="44" height="44" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                    </svg>
                </div>
                <h2 class="fav-empty-title"><?php e('my_list.empty_title'); ?></h2>
                <p class="fav-empty-desc"><?php e('my_list.empty_desc'); ?></p>
                
                <!-- Hızlı Keşif Kategori Butonları -->
                <div class="fav-empty-quick-links">
                    <a href="<?php echo url('araclar.php'); ?>" class="btn btn-primary btn-lg">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polygon points="10 8 16 12 10 16 10 8"></polygon></svg>
                        <span><?php e('my_list.go_to_catalog'); ?></span>
                    </a>
                    <a href="<?php echo url('araclar.php', ['kategori' => 'binek']); ?>" class="btn btn-outline btn-lg">
                        <span>Binek Araçlar</span>
                    </a>
                    <a href="<?php echo url('araclar.php', ['kategori' => 'ticari']); ?>" class="btn btn-outline btn-lg">
                        <span>Ticari Filo</span>
                    </a>
                    <a href="<?php echo url('elektrikli-arac-kiralama.php'); ?>" class="btn btn-outline btn-lg">
                        <span>Elektrikli Araçlar</span>
                    </a>
                </div>
            </div>



        </div>

    </div>
</section>

<!-- ─── 3. TOPLU FİLO TEKLİFİ MODAL (POPUP) ────────────────────────── -->
<div class="modal-backdrop" id="modal-bulk-quote" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 680px; padding: 28px;">
        <div class="flex flex-between items-center mb-4">
            <div>
                <span class="badge badge-accent mb-1">Konsolide Teklif</span>
                <h3 style="margin: 0; font-size: 1.35rem; font-weight: 700; color: var(--color-navy-950);">Toplu Filo Teklifi Talep Edin</h3>
                <p class="text-xs text-muted m-0">Listenizdeki tüm araçlar için tek bir kurumsal sözleşmeyle özel filo indirimi hazırlayalım.</p>
            </div>
            <button type="button" class="btn btn-ghost btn-sm" id="btn-close-bulk-modal" style="padding: 6px; border-radius: 50%;">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>

        <!-- Seçili Araçlar Çubuğu -->
        <div class="modal-selected-vehicles-strip mb-4">
            <span class="text-xs fw-semibold text-muted mb-2 d-block">Talep Kapsamındaki Araçlarınız:</span>
            <div class="modal-vehicle-chips" id="modal-vehicle-chips-list">
                <!-- Filled dynamically -->
            </div>
        </div>

        <!-- Form Alanları -->
        <form id="bulk-quote-modal-form" novalidate>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="bulk-name">Yetkili Adı Soyadı <span class="required">*</span></label>
                    <input type="text" id="bulk-name" name="name" class="form-input" required placeholder="Adınız Soyadınız">
                </div>
                <div class="form-group">
                    <label class="form-label" for="bulk-company">Şirket / Kurum Unvanı <span class="required">*</span></label>
                    <input type="text" id="bulk-company" name="company" class="form-input" required placeholder="Şirket Tam Adı">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="bulk-phone">Telefon Numarası <span class="required">*</span></label>
                    <input type="tel" id="bulk-phone" name="phone" class="form-input" required placeholder="05XX XXX XX XX">
                </div>
                <div class="form-group">
                    <label class="form-label" for="bulk-email">Kurumsal E-posta <span class="required">*</span></label>
                    <input type="email" id="bulk-email" name="email" class="form-input" required placeholder="ad.soyad@sirket.com">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="bulk-duration">Hedeflenen Kiralama Süresi</label>
                    <select id="bulk-duration" name="duration" class="form-select">
                        <option value="12">12 Ay (1 Yıl)</option>
                        <option value="24">24 Ay (2 Yıl)</option>
                        <option value="36" selected>36 Ay (3 Yıl - En Çok Tercih Edilen)</option>
                        <option value="48">48 Ay (4 Yıl)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="bulk-km">Yıllık Kilometre Limiti</label>
                    <select id="bulk-km" name="km" class="form-select">
                        <option value="15000">15.000 km / yıl</option>
                        <option value="20000">20.000 km / yıl</option>
                        <option value="30000" selected>30.000 km / yıl</option>
                        <option value="45000">45.000 km / yıl</option>
                    </select>
                </div>
            </div>

            <div class="form-group mb-4">
                <label class="form-label" for="bulk-notes">Ek Talepler veya Belirtmek İstedikleriniz (Opsiyonel)</label>
                <textarea id="bulk-notes" name="notes" class="form-input" rows="2" placeholder="Teslimat şehri, adet tercihleri veya özel istekleriniz..."></textarea>
            </div>

            <div class="form-group mb-4">
                <label class="form-checkbox">
                    <input type="checkbox" name="kvkk" required checked>
                    <span class="checkbox-box"></span>
                    <span class="checkbox-label text-xs">
                        <a href="<?php echo url('kvkk.php'); ?>" target="_blank" style="color: var(--color-orange); text-decoration: underline;">KVKK Aydınlatma Metni</a>'ni okudum ve kabul ediyorum.
                    </span>
                </label>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="btn btn-primary btn-lg flex-1" id="btn-submit-bulk-quote">
                    <span>Teklif Talebini İlet</span>
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    window.allVehiclesData = <?php echo json_encode($vehicles); ?>;
</script>
<script src="<?php echo asset('js/vehicle-compare.js'); ?>"></script>

<?php include includePath('footer.php'); ?>
