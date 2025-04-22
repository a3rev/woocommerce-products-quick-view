<?php
/**
 * Register blocks for WooCommerce Quick View Ultimate
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function wc_quick_view_ultimate_create_a3blocks_section() {
    add_filter( 'block_categories_all', function( $categories ) {

		$category_slugs = wp_list_pluck( $categories, 'slug' );

		if ( in_array( 'a3rev-blocks', $category_slugs ) ) {
			return $categories;
		}

		return array_merge(
			array(
				array(
					'slug' => 'a3rev-blocks',
					'title' => __( 'a3rev Blocks' ),
					'icon' => '',
				),
			),
			$categories
		);
	}, 2 );
}

/**
 * Register all blocks and their assets
 */
function wc_quick_view_ultimate_register_blocks() {
	wc_quick_view_ultimate_create_a3blocks_section();
	
    // Automatically load dependencies and version
    $asset_file_path = plugin_dir_path( __FILE__ ) . 'quick-view/build/block.asset.php';
    
    // If the asset file doesn't exist yet, create a default one
    if ( ! file_exists( $asset_file_path ) ) {
        $asset_file = [
            'dependencies' => [
                'wp-blocks',
                'wp-element',
                'wp-i18n',
                'wp-components',
                'wp-block-editor',
            ],
            'version' => WC_QUICK_VIEW_ULTIMATE_VERSION,
        ];
    } else {
        $asset_file = include $asset_file_path;
    }
    
    // Register scripts and styles if needed (for when the block is used in the editor)
    wp_register_script(
        'wc-quick-view-ultimate-editor-script',
        WC_QUICK_VIEW_ULTIMATE_URL . '/src/blocks/quick-view/build/index.js',
        $asset_file['dependencies'],
        $asset_file['version'],
        true
    );
    
    wp_register_style(
        'wc-quick-view-ultimate-editor-style',
        WC_QUICK_VIEW_ULTIMATE_URL . '/src/blocks/quick-view/build/index.css',
        [],
        $asset_file['version']
    );
    
    // Register the quick-view block
    require_once plugin_dir_path( __FILE__ ) . 'quick-view/render.php';
}

/**
 * Initialize the blocks
 */
function wc_quick_view_ultimate_blocks_init() {
    add_action( 'init', 'wc_quick_view_ultimate_register_blocks' );
}

wc_quick_view_ultimate_blocks_init(); 