<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

if ( empty( $product ) || ! $product->exists() ) {
	return;
}
$per_page = drone_apus_get_config('number_product_releated', 4);
$related = wc_get_related_products( $product->get_id(), $per_page );

if ( sizeof( $related ) == 0 ) return;

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'            => 'product',
	'ignore_sticky_posts'  => 1,
	'no_found_rows'        => 1,
	'posts_per_page'       => $per_page,
	'orderby'              => $orderby,
	'post__in'             => $related,
	'post__not_in'         => array( $product->get_id() )
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = drone_apus_get_config('releated_product_columns', 4);

if ( $products->have_posts() ) : ?>

	<div class="related products widget ">
	<div class="clearfix space-25 text-center">
		<h3 class="widget-title title-md"><span><?php esc_html_e( 'Related Products', 'drone' ); ?></span></h3>
	</div>
		<?php wc_get_template( 'layout-products/carousel.php' , array( 'loop'=>$products,'columns'=>$woocommerce_loop['columns'],'posts_per_page'=>$products->post_count ) ); ?>

	</div>

<?php endif;

wp_reset_postdata();