<?php
/**
 * Single Product Thumbnails
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     3.5.1
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
$id = rand();
global $post, $product, $woocommerce;

$images = $product->get_gallery_image_ids();

$attachment_ids =  array_merge_recursive( array( get_post_thumbnail_id() ) , $images ) ;
 
if ( $attachment_ids ) {
    $loop       = 0;
    $columns    = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
    ?>
    <div class="thumbnails-image">
        <div class="owl-carousel" data-items="<?php echo esc_attr($columns); ?>" data-carousel="owl" data-smallmedium="2" data-extrasmall="2" data-pagination="false" data-nav="true">

        <?php

        foreach ( $attachment_ids as $attachment_id ) {
            $classes = array( 'thumb-link' );
            if ( $loop == 0 || $loop % $columns == 0 )
                $classes[] = 'first';

            if ( ( $loop + 1 ) % $columns == 0 )
                $classes[] = 'last';

            $image_full_link = wp_get_attachment_url( $attachment_id );
            $image_link = wp_get_attachment_url( $attachment_id, 'shop_single' );

            if ( ! $image_link )
                continue;

            $image_title    = esc_attr( get_the_title( $attachment_id ) );
            $image_caption  = esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );

            $image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), 0, $attr = array(
                'title' => $image_title,
                'alt'   => $image_title,
                'data-zoom-image'=> $image_link
                ) );

            $image_class = esc_attr( implode( ' ', $classes ) );
    
            echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" data-image="%s" class="%s" title="%s">%s</a>', $image_link, $image_full_link, $image_class, $image_caption, $image ), $attachment_id, $post->ID, $image_class );
 
            $loop++;
        }

    ?>

        </div>

    </div>
    <?php
}
