<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if ( defined('WPB_VC_VERSION') && version_compare( WPB_VC_VERSION, '6.0', '>=' ) ) {
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'orderby' => $orderby,
        'order' => $order,
        'posts_per_page' => $posts_per_page
    );
    if ( $category ) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => $category,
            ),
        );
    }

    if ( get_query_var( 'paged' ) ) {
        $paged = get_query_var( 'paged' );
    } elseif ( get_query_var( 'page' ) ) {
        $paged = get_query_var( 'page' );
    } else {
        $paged = 1;
    }
    $args['paged'] = $paged;
    $loop = new WP_Query($args);
    
} else {
    if ( empty($loop) ) return;

    $this->getLoop($loop);
    $args = $this->loop_args;
    $posts_per_page = isset($args['posts_per_page']) ? $args['posts_per_page'] : 4;
    if ( get_query_var( 'paged' ) ) {
        $paged = get_query_var( 'paged' );
    } elseif ( get_query_var( 'page' ) ) {
        $paged = get_query_var( 'page' );
    } else {
        $paged = 1;
    }
    $args['paged'] = $paged;
    $loop = new WP_Query($args);
}

set_query_var( 'thumbsize', $thumbsize );
?>

<div class="widget widget-blog <?php echo esc_attr($layout_type); ?> <?php echo esc_attr($el_class); ?>">
    <?php if ($title!=''): ?>
        <h3 class="widget-title">
            <span><?php echo $title; ?></span>
            <?php if ( isset($subtitle) && $subtitle ): ?>
                <span class="subtitle"><?php echo esc_html($subtitle); ?></span>
            <?php endif; ?>
        </h3>
    <?php endif; ?>
    <div class="widget-content"> 
        <?php $columns = $grid_columns; ?>
        <?php $post_item = '_single'; ?>
        <?php if ( $layout_type == 'carousel' ): ?>

            <div class="owl-carousel posts" data-items="<?php echo esc_attr($columns); ?>" data-carousel="owl" data-pagination="<?php echo (isset($pagination) && $pagination ? 'true' : 'false'); ?>" data-nav="true">
                <?php while ( $loop->have_posts() ): $loop->the_post(); global $product; ?>
                    <div class="item">
                        <?php get_template_part( 'vc_templates/post/_single_carousel'); ?>
                    </div>
                <?php endwhile; ?>
            </div>

        <?php elseif ( $layout_type == 'grid' ): ?>

            <?php $bcol = 12/$columns; ?>
            <div class="layout-blog style-grid">
                <div class="row">
                    <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                        <div class="col-md-<?php echo esc_attr($bcol); ?>">
                            <?php get_template_part( 'vc_templates/post/_single' ); ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>

        <?php elseif ( $layout_type == 'masonry' ): ?>

            <?php
                wp_enqueue_script( 'drone-isotope-js', get_template_directory_uri().'/js/isotope.pkgd.min.js', array( 'jquery' ) );
            ?>
            <?php $bcol = 12/$columns; ?>
            <div class="isotope-items" data-isotope-duration="400">
                <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                    <div class="isotope-item col-md-<?php echo esc_attr($bcol); ?>">
                        <?php get_template_part( 'vc_templates/post/'.$post_item ); ?>
                    </div>
                <?php endwhile; ?>
            </div>

        <?php else: ?>

            <ul class="posts-list">
                <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                    <li>
                        <?php get_template_part( 'vc_templates/post/_single_list' ); ?>
                    </li>
                <?php endwhile; ?>
            </ul>
            
        <?php endif; ?>
    </div>
    <?php if ( isset($show_pagination) && $show_pagination && $layout_type != 'carousel' ): ?>
        <?php drone_apus_pagination( $posts_per_page, $loop->found_posts, $loop->max_num_pages ); ?>
    <?php endif ; ?>
</div>
<?php wp_reset_postdata(); ?>