<?php

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$_id = drone_apus_random_key();

if (isset($categoriestabs) && !empty($categoriestabs)):
    $categoriestabs = (array) vc_param_group_parse_atts( $categoriestabs );
    $i = 0;
?>

    <div class="widget widget-products widget-categoriestabs <?php echo esc_attr($el_class); ?>">
        <?php if ($title!=''): ?>
            <h3 class="widget-title">
                <span><?php echo esc_attr( $title ); ?></span>
                <?php if ( isset($subtitle) && $subtitle ): ?>
                    <span class="subtitle"><?php echo esc_html($subtitle); ?></span>
                <?php endif; ?>
            </h3>
        <?php endif; ?>
        <div class="widget-content woocommerce">
            <ul role="tablist" class="nav nav-tabs">
                <?php foreach ($categoriestabs as $tab) : ?>
                    <?php $category = get_term_by( 'slug', $tab['category'], 'product_cat' ); ?>
                    <li<?php echo ($i == 0 ? ' class="active"' : ''); ?>>
                        <a href="#tab-<?php echo esc_attr($_id);?>-<?php echo esc_attr($tab['category']); ?>" data-toggle="tab">
                            <?php if ( isset($tab['icon']) && !empty($tab['icon']) ): ?>
                                <?php $img = wp_get_attachment_image_src($item['icon'], 'full'); ?>
                                <?php if ( isset($img[0]) ) { ?>
                                    <img src="<?php echo esc_url( $img[0] );?>" alt="<?php echo esc_attr( $title ); ?>"  />
                                <?php } ?>
                            <?php elseif ( isset($tab['icon_font']) && $tab['icon_font'] ): ?>
                                <i class="<?php echo esc_attr($tab['icon_font']); ?>"></i>
                            <?php endif; ?>
                            <?php echo $category->name; ?>
                        </a>
                    </li>
                <?php $i++; endforeach; ?>
            </ul>
            <div class="widget-inner">
                <?php if( !empty($image_cat) ) : ?>
                    <?php $img = wp_get_attachment_image_src($image_cat,'full'); ?>
                    <div class="col-lg-3 hidden-md hidden-sm hidden-xs <?php echo esc_attr( $image_float );?>">
                        <img src="<?php echo esc_url_raw($img[0]); ?>" alt="">
                    </div>
                <?php endif; ?>
                <div class="<?php echo !empty($image_cat) ? 'col-lg-9 col-xs-12' : 'col-xs-12'; ?>">
                    <div class="tab-content">
                        <?php $i = 0; foreach ($categoriestabs as $tab) : ?>
                            <div id="tab-<?php echo esc_attr($_id);?>-<?php echo esc_attr($tab['category']); ?>" class="tab-pane <?php echo ($i == 0 ? 'active' : ''); ?>">
                                <?php $loop = drone_apus_get_products( array($tab['category']), $type, 1, $number ); ?>
                                <?php wc_get_template( 'layout-products/grid.php' , array( 'loop' => $loop, 'columns' => $columns, 'number' => $number ) ); ?>
                            </div>
                        <?php $i++; endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>