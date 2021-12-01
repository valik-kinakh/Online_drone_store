<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.5.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$productConfig = array(     
  'product_enablezoom'         => 1,
  'product_zoommode'           => 'basic',
  'product_zoomeasing'         => 1,
  'product_zoomlensshape'      => "round",
  'product_zoomlenssize'       => "150",
  'product_zoomgallery'        => 0,
  'enable_product_customtab'   => 0,
  'product_customtab_name'     => '',
  'product_customtab_content'  => '',
  'product_related_column'     => 0,        
);

global $post, $woocommerce, $product;

?>
<div class="images">

	<?php
		if ( has_post_thumbnail() ) {

			$image_title 	= esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$image_caption 	= get_post( get_post_thumbnail_id() )->post_excerpt;
			$image_link  	= wp_get_attachment_url( get_post_thumbnail_id() );

			list( $popupsrc, $popup_width, $popup_height ) = wp_get_attachment_image_src( get_post_thumbnail_id(), "shop_magnifier" );

			$image       	= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
				'title'	=> $image_title,
				'alt'	=> $image_title,
				'data-zoom-image'	=> $image_link,
				'id'	=> 'image'
				) );

			$attachment_count = count( $product->get_gallery_image_ids() );

			if ( $attachment_count > 0 ) {
				$gallery = '[product-gallery]';
			} else {
				$gallery = '';
			}

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div class="woocommerce-main-image"><a href="%s" class="cloud-zoom featured-image" data-rel="useWrapper: false, showTitle: false, zoomWidth:\'auto\', zoomHeight:\'auto\', adjustY:0, adjustX:10">%s</a></div>',$image_link, $image ), $post->ID );

		} else {
			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'drone' ) ), $post->ID );
		}
	?>

	<?php do_action( 'woocommerce_product_thumbnails' ); ?>

</div>