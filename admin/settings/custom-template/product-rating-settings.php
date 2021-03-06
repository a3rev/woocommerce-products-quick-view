<?php
/* "Copyright 2012 A3 Revolution Web Design" This software is distributed under the terms of GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007 */

namespace A3Rev\WCQV\FrameWork\Settings {

use A3Rev\WCQV\FrameWork;

// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;

/*-----------------------------------------------------------------------------------
WC Quick View Custom Template Product Rating Settings

-----------------------------------------------------------------------------------*/

class Custom_Template_Product_Rating
{

	/**
	 * @var string
	 * You must change to correct form key that you are working
	 */
	public $form_key = 'quick_view_template_product_rating_settings';

	/**
	 * @var array
	 */
	public $form_fields = array();

	/*-----------------------------------------------------------------------------------*/
	/* __construct() */
	/* Settings Constructor */
	/*-----------------------------------------------------------------------------------*/
	public function __construct() {
		$this->init_form_fields();
	}

	/*-----------------------------------------------------------------------------------*/
	/* init_form_fields() */
	/* Init all fields of this form */
	/*-----------------------------------------------------------------------------------*/
	public function init_form_fields() {

  		// Define settings
     	$this->form_fields = apply_filters( $this->form_key . '_settings_fields', array(

			array(
				'name'		=> __( 'Product Rating', 'woocommerce-products-quick-view' ),
                'type' 		=> 'heading',
                'class'		=> 'pro_feature_fields pro_feature_hidden',
                'id'		=> 'qv_template_rating_box',
                'is_box'	=> true,
           	),
			array(  
				'name' 		=> __( 'Product Rating', 'woocommerce-products-quick-view' ),
				'id' 		=> 'show_rating',
				'class'		=> 'show_rating',
				'type' 		=> 'onoff_checkbox',
				'default'	=> 1,
				'checked_value'		=> 1,
				'unchecked_value' 	=> 0,
				'checked_label'		=> __( 'ON', 'woocommerce-products-quick-view' ),
				'unchecked_label' 	=> __( 'OFF', 'woocommerce-products-quick-view' ),
			),
			
			array(
				'name'		=> '',
                'type' 		=> 'heading',
				'class'		=> 'show_rating_container'
           	),
			array(  
				'name' 		=> __( 'Rating Alignment', 'woocommerce-products-quick-view' ),
				'id' 		=> 'rating_alignment',
				'type' 		=> 'onoff_radio',
				'default' 	=> 'left',
				'onoff_options' => array(
					array(
						'val' 				=> 'left',
						'text' 				=> __( 'Left', 'woocommerce-products-quick-view' ),
						'checked_label'		=> __( 'ON', 'woocommerce-products-quick-view' ) ,
						'unchecked_label' 	=> __( 'OFF', 'woocommerce-products-quick-view' ) ,
					),
					array(
						'val' 				=> 'center',
						'text' 				=> __( 'Center', 'woocommerce-products-quick-view' ),
						'checked_label'		=> __( 'ON', 'woocommerce-products-quick-view' ) ,
						'unchecked_label' 	=> __( 'OFF', 'woocommerce-products-quick-view' ) ,
					),
					array(
						'val' 				=> 'right',
						'text' 				=> __( 'Right', 'woocommerce-products-quick-view' ),
						'checked_label'		=> __( 'ON', 'woocommerce-products-quick-view' ) ,
						'unchecked_label' 	=> __( 'OFF', 'woocommerce-products-quick-view' ) ,
					),
				),
			),
			array(  
				'name' 		=> __( 'Rating Margin', 'woocommerce-products-quick-view' ),
				'id' 		=> 'rating_margin',
				'type' 		=> 'array_textfields',
				'ids'		=> array( 
	 								array( 
											'id' 		=> 'rating_margin_top',
	 										'name' 		=> __( 'Top', 'woocommerce-products-quick-view' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> 5 ),
	 
	 								array(  'id' 		=> 'rating_margin_bottom',
	 										'name' 		=> __( 'Bottom', 'woocommerce-products-quick-view' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> 5 ),
											
									array( 
											'id' 		=> 'rating_margin_left',
	 										'name' 		=> __( 'Left', 'woocommerce-products-quick-view' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> 0 ),
											
									array( 
											'id' 		=> 'rating_margin_right',
	 										'name' 		=> __( 'Right', 'woocommerce-products-quick-view' ),
	 										'css'		=> 'width:40px;',
	 										'default'	=> 0 ),
	 							)
			),
			
        ));
	}
	
	public function include_script() {
	?>
<script>
(function($) {
$(document).ready(function() {
	if ( $("input.show_rating:checked").val() != '1') {
		$(".show_rating_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden', 'margin-bottom' : '0px'} );
	}
	
	$(document).on( "a3rev-ui-onoff_checkbox-switch", '.show_rating', function( event, value, status ) {
		$(".show_rating_container").attr('style','display:none;');
		if ( status == 'true' ) {
			$(".show_rating_container").slideDown();
		} else {
			$(".show_rating_container").slideUp();
		}
	});
	
});
})(jQuery);
</script>
    <?php	
	}
	
}

}
