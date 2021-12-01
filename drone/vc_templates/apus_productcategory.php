<?php

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );



if ( isset($category) || !empty($category) ):
	$loop = drone_apus_get_products( array($category), '', 1, $number);
?>
	<div class="widget widget-products <?php echo esc_attr($layout_type); ?> <?php echo esc_attr($el_class); ?>">
		<?php if ($title!=''): ?>
            <h3 class="widget-title">
                <span><?php echo $title; ?></span>
                <?php if ( isset($subtitle) && $subtitle ): ?>
                    <span class="subtitle"><?php echo esc_html($subtitle); ?></span>
                <?php endif; ?>
            </h3>
        <?php endif; ?>
		<div class="widget-content">
			<?php if ( $loop->have_posts() ): ?>
				<div class="products grid-wrapper woocommerce">
					<?php if ($image_cat): ?>
						<div class="widget-banner">
							<?php echo wp_get_attachment_image( $image_cat , 'full'); ?>
						</div>
					<?php endif ?>

					<?php wc_get_template( 'layout-products/'.$layout_type.'.php' , array( 'loop' => $loop, 'columns' => $columns, 'number' => $number ) ); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
<?php endif; ?>