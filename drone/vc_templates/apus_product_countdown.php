<?php

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if (isset($categories) && !empty($categories)) {
    $categories = explode(',', $categories);
}
$loop = drone_apus_get_products( $categories, 'deals', 1, $number );
?>

<div class="widget_deals_products widget widget_products <?php echo esc_attr($el_class); ?>">
    <?php if ($title!=''): ?>
        <h3 class="widget-title">
            <span><?php echo $title; ?></span>
            <?php if ( isset($subtitle) && $subtitle ): ?>
                <span class="subtitle"><?php echo esc_html($subtitle); ?></span>
            <?php endif; ?>
        </h3>
    <?php endif; ?>
    <div class="widget-content woocommerce">
        <?php if ( $loop->have_posts() ): ?>
            <?php wc_get_template( 'layout-products/'.$layout_type.'.php' , array( 'loop' => $loop, 'columns' => $columns, 'number' => $number, 'product_item' => 'inner-countdown' ) ); ?>
        <?php endif; ?>
    </div>
</div>
