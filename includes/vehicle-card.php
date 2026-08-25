<?php
/**
 * kzyfilo — Araç Kartı Bileşeni
 * 
 * Beklenen Değişken: $vehicle (Array)
 */
if (!defined('ROOT_DIR')) {
    require_once __DIR__ . '/config.php';
}

if (!isset($vehicle) || !is_array($vehicle)) {
    return;
}

$vId = $vehicle['id'] ?? 0;
$vSlug = $vehicle['slug'] ?? '';
$vBrand = $vehicle['brand'] ?? '';
$vModel = $vehicle['model'] ?? '';
$vVersion = $vehicle['version'] ?? '';
$vFuel = $vehicle['fuel'] ?? '';
$vTransmission = $vehicle['transmission'] ?? '';
$vBody = $vehicle['body'] ?? '';
$vCategory = $vehicle['category'] ?? 'binek';
$vSeats = $vehicle['seats'] ?? 5;
$vPrice = $vehicle['starting_price'] ?? 0;
$vImage = $vehicle['image'] ?? asset('images/vehicles/placeholder.svg');
$vIsCampaign = !empty($vehicle['is_campaign']);
$vIsPremium = !empty($vehicle['is_premium']);
$vIsFastDelivery = !empty($vehicle['is_fast_delivery']);
$detailUrl = url('arac-detay.php', ['slug' => $vSlug]);
?>
<div class="vehicle-card" 
     data-id="<?php echo esc($vId); ?>" 
     data-slug="<?php echo esc($vSlug); ?>"
     data-brand="<?php echo esc($vBrand); ?>"
     data-body="<?php echo esc($vBody); ?>"
     data-fuel="<?php echo esc($vFuel); ?>"
     data-transmission="<?php echo esc($vTransmission); ?>"
     data-category="<?php echo esc($vCategory); ?>"
     data-price="<?php echo esc($vPrice); ?>"
     data-campaign="<?php echo $vIsCampaign ? '1' : '0'; ?>"
     data-premium="<?php echo $vIsPremium ? '1' : '0'; ?>"
     data-fast-delivery="<?php echo $vIsFastDelivery ? '1' : '0'; ?>">
    <div class="vehicle-card-image">
        <a href="<?php echo esc($detailUrl); ?>" tabindex="-1" aria-hidden="true">
            <img src="<?php echo esc($vImage); ?>" alt="<?php echo esc($vBrand . ' ' . $vModel); ?>" loading="lazy" width="360" height="225">
        </a>

        <!-- Badges -->
        <div class="vehicle-card-badges">
            <?php if ($vIsCampaign): ?>
                <span class="badge badge-primary"><?php e('vehicle_card.campaign'); ?></span>
            <?php endif; ?>
            <?php if ($vIsFastDelivery): ?>
                <span class="badge badge-success"><?php e('vehicle_card.fast_delivery'); ?></span>
            <?php endif; ?>
            <?php if ($vIsPremium): ?>
                <span class="badge badge-info"><?php e('vehicle_card.premium'); ?></span>
            <?php endif; ?>
        </div>

        <!-- Top Actions (Favorite Button) -->
        <div class="vehicle-card-actions-top">
            <button type="button" 
                    class="vehicle-card-action-btn btn-favorite-toggle" 
                    data-id="<?php echo esc($vId); ?>" 
                    title="<?php e('vehicle_card.add_to_list'); ?>" 
                    aria-label="<?php echo esc($vBrand . ' ' . $vModel . ' - ' . t('vehicle_card.add_to_list')); ?>">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                </svg>
            </button>
        </div>
    </div>

    <div class="vehicle-card-body">
        <div class="vehicle-card-brand"><?php echo esc($vBrand); ?></div>
        <h3 class="vehicle-card-model">
            <a href="<?php echo esc($detailUrl); ?>">
                <?php echo esc($vModel); ?>
            </a>
        </h3>

        <!-- Specs Strip -->
        <div class="vehicle-card-specs">
            <!-- Fuel -->
            <div class="vehicle-card-spec" title="<?php e('catalog.fuel'); ?>">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <line x1="3" y1="22" x2="15" y2="22"></line>
                    <line x1="4" y1="9" x2="14" y2="9"></line>
                    <path d="M14 22V4a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v18"></path>
                    <path d="M14 13h2a2 2 0 0 1 2 2v2a2 2 0 0 0 2 2h0a2 2 0 0 0 2-2V9.83a2 2 0 0 0-.59-1.42L18 5"></path>
                </svg>
                <span><?php e('fuel_types.' . $vFuel); ?></span>
            </div>

            <!-- Transmission -->
            <div class="vehicle-card-spec" title="<?php e('catalog.transmission'); ?>">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <circle cx="6" cy="6" r="3"></circle>
                    <circle cx="6" cy="18" r="3"></circle>
                    <circle cx="18" cy="6" r="3"></circle>
                    <line x1="6" y1="9" x2="6" y2="15"></line>
                    <line x1="9" y1="6" x2="15" y2="6"></line>
                </svg>
                <span><?php e('transmission_types.' . $vTransmission); ?></span>
            </div>

            <!-- Body -->
            <div class="vehicle-card-spec" title="<?php e('catalog.body_type'); ?>">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.5 2.8C2.1 11 2 11.5 2 12v4c0 .6.4 1 1 1h2"></path>
                    <circle cx="7" cy="17" r="2"></circle>
                    <circle cx="17" cy="17" r="2"></circle>
                </svg>
                <span><?php e('body_types.' . $vBody); ?></span>
            </div>

            <!-- Seats -->
            <div class="vehicle-card-spec" title="<?php e('catalog.seats'); ?>">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="8.5" cy="7" r="4"></circle>
                </svg>
                <span><?php echo esc($vSeats); ?> <?php e('vehicle_card.seats'); ?></span>
            </div>
        </div>

        <!-- Footer: Horizontal Price & 2 Bottom Buttons -->
        <div class="vehicle-card-footer">
            <div class="vehicle-card-price-row">
                <span class="vehicle-card-price-label"><?php e('vehicle_card.monthly_from'); ?></span>
                <div class="vehicle-card-price-val">
                    <span class="vehicle-card-price-amount"><?php echo number_format($vPrice, 0, ',', '.'); ?> <?php e('currency'); ?></span>
                    <span class="vehicle-card-price-suffix">/ <?php echo (CURRENT_LANG === 'tr') ? 'ay + KDV' : 'mo + VAT'; ?></span>
                </div>
            </div>

            <div class="vehicle-card-actions">
                <!-- Compare Button -->
                <button type="button" 
                        class="btn btn-outline btn-sm btn-compare-action" 
                        data-id="<?php echo esc($vId); ?>" 
                        title="<?php e('compare.compare_vehicles'); ?>" 
                        aria-label="<?php echo esc($vBrand . ' ' . $vModel . ' - ' . t('compare.compare_vehicles')); ?>">
                    <svg viewBox="0 0 24 24" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="margin-right: 5px;">
                        <path d="M12 3v18"></path>
                        <path d="M6 7l6-3 6 3"></path>
                        <path d="M3 13l3-6 3 6a3 3 0 0 1-6 0z"></path>
                        <path d="M15 13l3-6 3 6a3 3 0 0 1-6 0z"></path>
                        <path d="M4 21h16"></path>
                    </svg>
                    <span><?php e('compare.compare_vehicles'); ?></span>
                </button>

                <!-- Details Button -->
                <a href="<?php echo esc($detailUrl); ?>" class="btn btn-secondary btn-sm">
                    <?php e('vehicle_card.view_details'); ?>
                </a>
            </div>
        </div>
    </div>
</div>
