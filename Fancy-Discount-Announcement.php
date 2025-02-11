<?php
// Display Original Price with Strikethrough & Discounted Price at Checkout
function show_discounted_price_pmpro() {
    global $pmpro_level;

    // Check if original price is set and different from discounted price
    if (!empty($pmpro_level->original_price) && $pmpro_level->original_price != $pmpro_level->initial_payment) {
        echo '<p class="discount-notice" style="font-size: 18px;">
        <span style="text-decoration: line-through; color: red;">Original Price: $' . number_format($pmpro_level->original_price, 2) . '</span>  
        <br><span style="color: green; font-weight: bold;">Now Only: $' . number_format($pmpro_level->initial_payment, 2) . '</span>
        <br>🎉 Limited-time 20% discount applied! Offer valid until March 31, 2025.
        </p>';
    }
}
add_action('pmpro_checkout_after_level_cost', 'show_discounted_price_pmpro');

?>
