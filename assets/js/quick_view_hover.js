// JavaScript Document
(function($) {
    'use strict';

	var card_class_trigger = '.products .product, .card-product, .wp-block-woocommerce-product-template .product, .wp-block-post-template .product' ;

	if (typeof quick_view_ultimate_card_class_trigger !== 'undefined') {
		card_class_trigger = card_class_trigger + ', ' + quick_view_ultimate_card_class_trigger;
	}
    
    $(document).ready(function() {
		$(document).on("mouseenter", card_class_trigger, function() {
			$(this).css('position', 'relative');
		});
		
        // Common function to handle hover effects for product elements
        function handleProductHover(selector) {
            $(document).on("mouseenter", selector, function() {
                $(this).addClass("product_hover");
                positionQuickViewButton($(this));
            });
            
            $(document).on("mouseleave", selector, function() {
                $(this).removeClass("product_hover");
            });
        }
        
        // Function to calculate and set the position of the quick view button
        function positionQuickViewButton($element) {
            var $container = $element.find(".quick_view_ultimate_container");
            var $content = $element.find(".quick_view_ultimate_content");
            var bt_position = $container.attr('position');
			var $thumbnail = $element.find('.thumbnail');
			var thumbnail_height = 0;
			if ($thumbnail.length > 0) {
				thumbnail_height = $thumbnail.outerHeight();
			} else {
				thumbnail_height = $element.find('img').outerHeight();
			}
            
            // Set position based on the attribute value
            switch (bt_position) {
                case 'center':
                    var margin = (thumbnail_height - $content.height()) / 2;
                    $container.css('top', margin + "px");
                    break;
                case 'bottom':
                    var margin = thumbnail_height - $content.height();
                    $container.css('top', margin + "px");
                    break;
                case 'top':
                    $container.css('top', "0px");
                    break;
            }
        }
        
        // Initialize hover handlers for different product containers
        handleProductHover(card_class_trigger);
        
        // Handle window resize to reposition buttons if needed
        $(window).on('resize', function() {
            $(".product_hover").each(function() {
                positionQuickViewButton($(this));
            });
        });
    });
})(jQuery);
