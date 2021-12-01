(function($) {
	
    // add to cart modal
    var product_info = null;
    jQuery('body').bind('adding_to_cart', function( button, data , data2 ) {
       product_info = data2;
    });

    jQuery('body').bind('added_to_cart', function( fragments, cart_hash ){
        if ( product_info ) {
            jQuery('#apus-cart-modal').modal();
            var url = drone_ajax.ajaxurl + '?action=drone_add_to_cart_product&product_id=' + product_info.product_id;
            jQuery.get(url,function(data,status) {
                jQuery('#apus-cart-modal .modal-body .modal-body-content').html(data);
            });
            jQuery('#apus-cart-modal').on('hidden.bs.modal',function() {
                jQuery(this).find('.modal-body .modal-body-content').empty();
            });
        }
    });

	// Ajax QuickView
	jQuery(document).ready(function(){
		jQuery('a.quickview').click(function (e) {
			e.preventDefault();
		    var productslug = jQuery(this).data('productslug');
		    var url = drone_ajax.ajaxurl + '?action=drone_quickview_product&productslug=' + productslug;
		    jQuery.get(url,function(data,status){
		    	jQuery('#apus-quickview-modal .modal-body .modal-body-content').html(data);
		    });
		});
		jQuery('#apus-quickview-modal').on('hidden.bs.modal',function(){
			jQuery(this).find('.modal-body .modal-body-content').empty();
		});
	
	});
	
	// thumb image
	$('.thumbnails-image .thumb-link').click(function(e){
		e.preventDefault();
		var image_url = $(this).attr('href');
		var image_full_url = $(this).data('image');
		$('.woocommerce-main-image .featured-image').attr('href', image_full_url);
		$('.woocommerce-main-image .featured-image img').attr('src', image_url);
		$('.cloud-zoom').CloudZoom();
	});
})(jQuery)