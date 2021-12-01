<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$bcol = 12/$columns;
$args = array(
	'post_type' => 'apus_brand',
	'posts_per_page' => $number
);
$loop = new WP_Query($args);
?>
<div class="widget widget-brands <?php echo esc_attr($el_class); ?>">
    <?php if ($title!=''): ?>
    	<div class="clearfix space-25">
        <h3 class="widget-title title-md text-white text-center">
            <span><?php echo esc_attr( $title ); ?></span>
            <?php if ( isset($subtitle) && $subtitle ): ?>
                <span class="subtitle"><?php echo esc_html($subtitle); ?></span>
            <?php endif; ?>
        </h3>
        </div>
    <?php endif; ?>
    <div class="widget-content">
    	<?php if ( $loop->have_posts() ): ?>
    		<?php if ( $layout_type == 'carousel' ): ?>
    			<div class="owl-carousel products" data-items="<?php echo esc_attr($columns); ?>" data-carousel="owl" data-pagination="false" data-nav="true">
		    		<?php while ( $loop->have_posts() ): $loop->the_post(); ?>
		    			<div class="item">
			                <?php $link = get_post_meta( get_the_ID(), 'apus_brand_link', true); ?>
			                <?php $link = $link ? $link : '#'; ?>
							<a href="<?php echo esc_url($link); ?>" target="_blank">
								<?php the_post_thumbnail( 'full' ); ?>
							</a>
				        </div>
		    		<?php endwhile; ?>
	    		</div>
	    	<?php else: ?>
	    		<div class="row">
		    		<?php while ( $loop->have_posts() ): $loop->the_post(); ?>
		    			<div class="col-md-<?php echo esc_attr($bcol); ?>">
			                <?php $link = get_post_meta( get_the_ID(), 'apus_brand_link', true); ?>
			                <?php $link = $link ? $link : '#'; ?>
							<a href="<?php echo esc_url($link); ?>" target="_blank">
								<?php the_post_thumbnail( 'thumbnail' ); ?>
							</a>
				        </div>
		    		<?php endwhile; ?>
	    		</div>
	    	<?php endif; ?>
    	<?php endif; ?>
    	<?php wp_reset_postdata(); ?>
    </div>
</div>