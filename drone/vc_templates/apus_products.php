<?php

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if ( $type == '' ) return;


global $woocommerce;

$_id = drone_apus_random_key();
$_count = 1;

if ( !empty($categories) ) {
	$categories = array_map('trim', explode(',', $categories));
} else {
	$categories = array();
}
$loop = drone_apus_get_products( $categories, $type, 1, $number );
?>
<div class="widget widget-<?php echo esc_attr($layout_type); ?> widget-products products <?php echo esc_attr($el_class); ?>">

	<?php if ($title!=''): ?>
        <h3 class="widget-title">
            <span><?php echo $title; ?></span>
            <?php if ( isset($subtitle) && $subtitle ): ?>
                <span class="subtitle"><?php echo esc_html($subtitle); ?></span>
            <?php endif; ?>
        </h3>
    <?php endif; ?>

	<?php if ( $loop->have_posts() ) : ?>
		<div class="widget-content woocommerce">
			<div class="<?php echo esc_attr( $layout_type ); ?>-wrapper">
				<?php wc_get_template( 'layout-products/'.$layout_type.'.php' , array( 'loop' => $loop, 'columns' => $columns, 'number' => $number ) ); ?>
			</div>
		</div>
	<?php endif; ?>

</div>
