<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$args = array(
	'post_type' => 'apus_testimonial',
	'posts_per_page' => $number,
	'post_status' => 'publish',
);
$loop = new WP_Query($args);
?>

<div class="widget-testimonials widget <?php echo esc_attr($el_class.' '.$style); ?>">
	
	<?php if ($title!=''): ?>
        <div class="clearfix space-25 text-center">
            <h3 class="widget-title title-md">
                <span><?php echo esc_attr( $title ); ?></span>
            </h3>
        </div>
    <?php endif; ?>
	<?php if ( $loop->have_posts() ): ?>

		<div class="owl-carousel" data-items="<?php echo esc_attr($columns); ?>" data-carousel="owl" data-smallmedium="2" data-extrasmall="1"  data-pagination="true" data-nav="true">
            <?php while ( $loop->have_posts() ): $loop->the_post(); global $product; ?>
                <div class="item text-center">
                    <?php get_template_part( 'vc_templates/testimonial/testimonial', 'v1' ); ?>
                </div>
            <?php endwhile; ?>
        </div>

	<?php endif; ?>
</div>
<?php wp_reset_postdata(); ?>