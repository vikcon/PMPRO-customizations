<?php
// Auto apply discount only for Membership Level 2
function apply_auto_discount_pmpro($level) {
    // Set the expiration date for the discount
    $expiration_date = '2025-03-31'; // YYYY-MM-DD
    $current_date = date('Y-m-d');

    // Check if today is before the expiration date AND the membership level ID is 2
    if ($current_date <= $expiration_date && $level->id == 2) {
        // Store original price
        $level->original_price = $level->initial_payment;

        // Calculate the new discounted price (20% off)
        $discount_percentage = 20;
        $discounted_price = $level->initial_payment * (1 - ($discount_percentage / 100));

        // Apply the discounted price
        $level->initial_payment = round($discounted_price, 2);
    }

    return $level;
}
add_filter('pmpro_checkout_level', 'apply_auto_discount_pmpro');


?>
