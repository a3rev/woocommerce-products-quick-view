<?php
/* "Copyright 2012 A3 Revolution Web Design" This software is distributed under the terms of GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007 */

namespace A3Rev\WCQV\FrameWork\Pages {

use A3Rev\WCQV\FrameWork;

// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit; 

/*-----------------------------------------------------------------------------------
WC Quick View Admin Page

TABLE OF CONTENTS

- var menu_slug
- var page_data

- __construct()
- page_init()
- page_data()
- add_admin_menu()
- tabs_include()
- admin_settings_page()

-----------------------------------------------------------------------------------*/

class Quick_View extends FrameWork\Admin_UI
{	
	/**
	 * @var string
	 */
	private $menu_slug = 'wc-quick-view';
	
	/**
	 * @var array
	 */
	private $page_data;
	
	/*-----------------------------------------------------------------------------------*/
	/* __construct() */
	/* Settings Constructor */
	/*-----------------------------------------------------------------------------------*/
	public function __construct() {
		$this->page_init();
		$this->tabs_include();
	}
	
	/*-----------------------------------------------------------------------------------*/
	/* page_init() */
	/* Page Init */
	/*-----------------------------------------------------------------------------------*/
	public function page_init() {
		
		add_filter( $this->plugin_name . '_add_admin_menu', array( $this, 'add_admin_menu' ) );
	}
	
	/*-----------------------------------------------------------------------------------*/
	/* page_data() */
	/* Get Page Data */
	/*-----------------------------------------------------------------------------------*/
	public function page_data() {

		$page_data = array(
			'type'				=> 'submenu',
			'parent_slug'		=> 'woocommerce',
			'page_title'		=> __( 'Quick View', 'woocommerce-products-quick-view' ),
			'menu_title'		=> __( 'Quick View', 'woocommerce-products-quick-view' ),
			'capability'		=> 'manage_options',
			'menu_slug'			=> $this->menu_slug,
			'function'			=> 'wc_qv_admin_page_show',
			'admin_url'			=> 'admin.php',
			'callback_function' => '',
			'script_function' 	=> '',
			'view_doc'			=> '',
		);
		
		if ( $this->page_data ) return $this->page_data;
		return $this->page_data = $page_data;
		
	}
	
	/*-----------------------------------------------------------------------------------*/
	/* add_admin_menu() */
	/* Add This page to menu on left sidebar */
	/*-----------------------------------------------------------------------------------*/
	public function add_admin_menu( $admin_menu ) {
		
		if ( ! is_array( $admin_menu ) ) $admin_menu = array();
		$admin_menu[] = $this->page_data();

		return $admin_menu;
	}
	
	/*-----------------------------------------------------------------------------------*/
	/* tabs_include() */
	/* Include all tabs into this page
	/*-----------------------------------------------------------------------------------*/
	public function tabs_include() {
		
		global $wc_qv_admin_settings_tab;
		$wc_qv_admin_settings_tab = new FrameWork\Tabs\Admin_Settings();

		global $wc_qv_admin_button_style_tab;
		$wc_qv_admin_button_style_tab = new FrameWork\Tabs\Button_Style();

		global $wc_qv_admin_popup_style_tab;
		$wc_qv_admin_popup_style_tab = new FrameWork\Tabs\Popup_Style();

		global $wc_qv_custom_template_global_settings_tab;
		$wc_qv_custom_template_global_settings_tab = new FrameWork\Tabs\Custom_Template_Global();
		
	}
	
	/*-----------------------------------------------------------------------------------*/
	/* admin_settings_page() */
	/* Show Settings Page */
	/*-----------------------------------------------------------------------------------*/
	public function admin_settings_page() {		
		$GLOBALS[$this->plugin_prefix.'admin_init']->admin_settings_page( $this->page_data() );
	}
	
}

}

// global code
namespace {

/** 
 * wc_qv_admin_page_show()
 * Define the callback function to show page content
 */
function wc_qv_admin_page_show() {
	global $wc_qv_admin_page;
	$wc_qv_admin_page->admin_settings_page();
}

}
