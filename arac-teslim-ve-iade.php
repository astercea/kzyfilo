<?php
/**
 * kzyfilo — Araç Teslim ve İade Rehberi (arac-teslim-ve-iade.php)
 * KZY Executive Delivery & Return Guide
 */
require_once __DIR__ . '/includes/config.php';

setPageMeta([
    'title' => t('solutions_menu.delivery_return') . ' | ' . SITE_NAME,
    'description' => 'kzyfilo sıfır km araç teslim alma aşamaları, gerekli belgeler ve sözleşme sonu şeffaf iade rehberi.',
    'canonical' => canonical('arac-teslim-ve-iade.php'),
]);

$breadcrumbs = [
    ['title' => t('services.title'), 'url' => url('hizmetler.php')],
    ['title' => t('solutions_menu.delivery_return')]
];

include includePath('header.php');?>

<!-- ─── 1. PAGE HEADER ─────────────────────────────────────────────── -->
<div class="page-header">
    <div class="container">
        <h1><?php e('solutions_menu.delivery_return'); ?></h1>
        <?php include includePath('breadcrumbs.php'); ?>
    </div>
</div>

<!-- ─── 2. İNTERAKTİF TESLİM & İADE REHBERİ (TABS) ─────────────────── -->
<section class="section section-ivory" data-reveal="fade-up">
    <div class="container">
        <div class="section-header text-center" style="max-width: 760px; margin: 0 auto var(--space-12);">
            <span class="editorial-tag">Şeffaf & Güvenilir Standartlar</span>
            <h2 style="font-size: clamp(2.2rem, 3.5vw, 3rem); font-weight: var(--font-weight-normal); margin-top: var(--space-2); margin-bottom: var(--space-3);">
                Teslim ve İade Süreç Rehberi
            </h2>
            <p style="font-size: 1.05rem; color: var(--color-text-muted); line-height: 1.65;">
                Sözleşmenizin başlangıcından bitimine kadar tüm teslimat ve iade adımları bağımsız ekspertiz ilkeleri ve tam şeffaflıkla yönetilir.
            </p>
        </div>

        <div class="solution-tab-wrap mb-16">
            <div class="solution-tab-nav" role="tablist">
                <button type="button" class="solution-tab-btn is-active" data-tab="tab-delivery" role="tab" aria-selected="true">
                    <span>1. Araç Teslim Alma Süreci</span>
                </button>
                <button type="button" class="solution-tab-btn" data-tab="tab-return" role="tab" aria-selected="false">
                    <span>2. Sözleşme Sonu İade Süreci</span>
                </button>
            </div>

            <!-- Tab 1: Teslim Alma -->
            <div class="solution-tab-pane is-active" id="tab-delivery" role="tabpanel">
                <div class="solution-process-grid" style="grid-template-columns: repeat(3, 1fr);">
                    <div class="solution-step-card">
                        <div class="solution-step-num">01</div>
                        <div class="solution-step-title">Sözleşme & Randevu</div>
                        <p class="solution-step-desc">Finansal onay ve sözleşme imzalanmasının ardından müşteri temsilciniz şirket adresinize teslimat randevusunu oluşturur.</p>
                    </div>
                    <div class="solution-step-card">
                        <div class="solution-step-num">02</div>
                        <div class="solution-step-title">Belge Kontrolü</div>
                        <p class="solution-step-desc">Teslim alacak yetkili sürücünün ehliyet/kimlik fotokopisi ve şirket teslim tutanağı yetkisi kontrol edilir.</p>
                    </div>
                    <div class="solution-step-card">
                        <div class="solution-step-num">03</div>
                        <div class="solution-step-title">Tutanak & Anahtar Teslimi</div>
                        <p class="solution-step-desc">Kilometre, yakıt durumu ve fabrika çıkış donanımları dijital tutanak altına alınarak anahtarlar teslim edilir.</p>
                    </div>
                </div>
            </div>

            <!-- Tab 2: İade -->
            <div class="solution-tab-pane" id="tab-return" role="tabpanel">
                <div class="solution-process-grid" style="grid-template-columns: repeat(3, 1fr);">
                    <div class="solution-step-card">
                        <div class="solution-step-num">01</div>
                        <div class="solution-step-title">15 Gün Önce Randevu</div>
                        <p class="solution-step-desc">Sözleşme bitim tarihinizden 15 gün önce yetkili iade noktası ve saatini belirlemek için danışmanınızla randevu netleştirilir.</p>
                    </div>
                    <div class="solution-step-card">
                        <div class="solution-step-num">02</div>
                        <div class="solution-step-title">Ekspertiz Standartları</div>
                        <p class="solution-step-desc">TOKKDER kabul edilebilir aşınma standartları kılavuzuna göre tarafsız görsel ve mekanik kontrol gerçekleştirilir.</p>
                    </div>
                    <div class="solution-step-card">
                        <div class="solution-step-num">03</div>
                        <div class="solution-step-title">İade Tutanağı & Kapanış</div>
                        <p class="solution-step-desc">Karşılıklı ıslak/dijital imzalı tutanak düzenlenerek sözleşme kapanışı tamamlanır; yeni filo siparişiniz hazırsa hemen teslim edilir.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ─── 3. İADE ÖNCESİ KONTROL LİSTESİ ──────────────────────────────── -->
<section class="section section-paper" data-reveal="fade-up">
    <div class="container">
        <div class="section-header text-center" style="max-width: 720px; margin: 0 auto var(--space-10);">
            <span class="editorial-tag">Hazırlık Rehberi</span>
            <h2 style="font-size: clamp(2rem, 3vw, 2.6rem); font-weight: var(--font-weight-normal); margin-top: var(--space-2);">
                İade Öncesi Kontrol Listesi
            </h2>
            <p style="color: var(--color-text-muted); font-size: 1.05rem;">
                Aracınızı iade ederken eksiksiz teslim etmeniz gereken evrak ve donanımlar.
            </p>
        </div>

        <div class="checklist-grid mb-12">
            <div class="checklist-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
                <div>
                    <strong>Araç Ruhsatı ve Belgeler</strong>
                    <p>Orijinal tescil belgesi, trafik ve kasko poliçe fotokopileri eksiksiz torpido gözünde bulunmalıdır.</p>
                </div>
            </div>

            <div class="checklist-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
                <div>
                    <strong>Yedek Anahtar</strong>
                    <p>Teslimat anında verilen orijinal yedek anahtar çalışır ve hasarsız durumda iade edilmelidir.</p>
                </div>
            </div>

            <div class="checklist-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
                <div>
                    <strong>Stepne veya Lastik Tamir Kiti</strong>
                    <p>Fabrika orijinal stepnesi, kriko, bijon anahtarı veya elektrikli tamir kompresörü bagajda yer almalıdır.</p>
                </div>
            </div>

            <div class="checklist-item">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
                <div>
                    <strong>Zorunlu Trafik & İlkyardım Seti</strong>
                    <p>Yangın söndürme tüpü, reflektörler ve ilk yardım çantası eksiksiz araç içinde teslim edilmelidir.</p>
                </div>
            </div>
        </div>

        <!-- İade Noktalarına Yönlendirme Kartı -->
        <div class="card return-points-banner" style="position: relative; background: #faf9f5 url('<?php echo asset('images/return-map-bg.jpg'); ?>') center/cover no-repeat; border: 1px solid var(--color-border-light); border-radius: var(--radius-lg, 8px); overflow: hidden; padding: var(--space-12) var(--space-8); text-align: center; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);">
            <div style="position: absolute; inset: 0; background: linear-gradient(135deg, rgba(250, 249, 245, 0.88) 0%, rgba(247, 246, 242, 0.82) 100%); pointer-events: none;"></div>
            <div style="position: relative; z-index: 2; max-width: 640px; margin: 0 auto;">
                <h3 style="font-size: clamp(1.4rem, 2.5vw, 1.85rem); font-weight: 600; color: #121822; margin-top: 0; margin-bottom: var(--space-3);">
                    Size En Yakın İade Noktasını Bulun
                </h3>
                <p class="text-muted text-sm max-w-lg mx-auto mb-6" style="line-height: 1.65; font-size: 0.95rem;">
                    İstanbul, Ankara, İzmir ve diğer tüm illerdeki yetkili teslim ve iade merkezlerimizin konum, adres ve operasyonel çalışma saatlerini inceleyin.
                </p>
                <a href="<?php echo url('arac-iade-noktalari.php'); ?>" class="btn btn-primary btn-lg">
                    <?php e('return_points.title'); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ─── 4. KURUMSAL CTA BANNER ──────────────────────────────────────── -->
<section class="section-sm" style="padding-top: 0;">
    <div class="container">
        <div class="solution-cta-card">
            <h3>Sözleşmenizi Yenileyin veya Yeni Araç Seçin</h3>
            <p>Mevcut kiralama döneminiz biterken filonuzu yeni model sıfır km araçlarla kesintisiz güncelleyin.</p>
            <div class="solution-cta-actions">
                <a href="<?php echo url('araclar.php'); ?>" class="btn btn-primary btn-lg"><?php e('home.hero_cta_vehicles'); ?></a>
                <button type="button" class="btn btn-outline btn-lg" data-open-modal="callback"><?php e('home.cta_call'); ?></button>
            </div>
        </div>
    </div>
</section>

<script>
    // Tab Değiştirme Mantığı
    document.querySelectorAll('.solution-tab-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const targetId = this.getAttribute('data-tab');
            document.querySelectorAll('.solution-tab-btn').forEach(b => {
                b.classList.remove('is-active');
                b.setAttribute('aria-selected', 'false');
            });
            document.querySelectorAll('.solution-tab-pane').forEach(p => p.classList.remove('is-active'));
            
            this.classList.add('is-active');
            this.setAttribute('aria-selected', 'true');
            const targetPane = document.getElementById(targetId);
            if (targetPane) {
                targetPane.classList.add('is-active');
            }
        });
    });
</script>

<?php include includePath('footer.php'); ?>
