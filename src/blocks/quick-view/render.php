<?php
/**
 * PHP rendering for the Quick View Button block.
 *
 * @param array    $attributes Block attributes.
 * @param string   $content    Block default content.
 * @param WP_Block $block      Block instance.
 *
 * @return string Returns the filtered post content of the current post.
 */
function wc_quick_view_ultimate_render_quick_view_button( $attributes, $content, $block ) {
    $quick_view_ultimate_enable = get_option('quick_view_ultimate_enable', 'no');
    if ( $quick_view_ultimate_enable !== 'yes' ) {
        return '';
    }
    
    // When this block is used, disable the automatic hooks to prevent duplicate buttons
    add_filter('wc_quick_view_block_used', '__return_true');
    
    // If not already done, remove the default hooks that add Quick View buttons
    if (!isset($GLOBALS['wc_qv_hooks_removed'])) {
        remove_action('woocommerce_before_shop_loop_item_title', array($GLOBALS['wc_quick_view_ultimate'], 'add_quick_view_ultimate_hover_each_products'), 11);
        remove_action('woocommerce_before_shop_loop_item_title', array($GLOBALS['wc_quick_view_ultimate'], 'add_quick_view_ultimate_under_image_each_products'), 11);
        $GLOBALS['wc_qv_hooks_removed'] = true;
    }

    // Start output buffering to capture the function output
    ob_start();
    
    // Get the display type from block attributes (default to 'under' if not set)
    $display_type = isset( $attributes['displayType'] ) ? $attributes['displayType'] : 'under';
    
    // Output the quick view button based on display type
    global $wc_quick_view_ultimate;
    if ( $display_type === 'hover' ) {
        $wc_quick_view_ultimate->quick_view_ultimate_hover();
    } else {
        $wc_quick_view_ultimate->quick_view_ultimate_under_image();
    }
    
    // Return the captured output
    return ob_get_clean();
}

/**
 * Register the dynamic block.
 *
 * @uses wc_quick_view_ultimate_render_quick_view_button()
 */
function wc_quick_view_ultimate_register_quick_view_block() {
    register_block_type_from_metadata(
        __DIR__,
        array(
            'render_callback' => 'wc_quick_view_ultimate_render_quick_view_button',
        )
    );
}

// Register the block
wc_quick_view_ultimate_register_quick_view_block(); 