<?php

function drone_apus_woocommerce_setup() {
    global $pagenow;
    if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {
        $catalog = array(
            'width'     => '250',   // px
            'height'    => '300',   // px
            'crop'      => 1        // true
        );

        $single = array(
            'width'     => '500',   // px
            'height'    => '600',   // px
            'crop'      => 1        // true
        );

        $thumbnail = array(
            'width'     => '170',    // px
            'height'    => '170',   // px
            'crop'      => 1        // true
        );

        // Image sizes
        update_option( 'shop_catalog_image_size', $catalog );       // Product category thumbs
        update_option( 'shop_single_image_size', $single );         // Single product image
        update_option( 'shop_thumbnail_image_size', $thumbnail );   // Image gallery thumbs
    }
}

add_action( 'init', 'drone_apus_woocommerce_setup');

// add to cart modal box
if ( !function_exists('drone_apus_woocommerce_add_to_cart_modal') ) {
    function drone_apus_woocommerce_add_to_cart_modal(){
    ?>
    <div class="modal fade" id="apus-cart-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close btn btn-close" data-dismiss="modal" aria-hidden="true">
                        <i class="fa fa-times"></i>
                    </button>
                    <div class="modal-body-content"></div>
                </div>
            </div>
        </div>
    </div>
    <?php    
    }
}

// cart modal
if ( !function_exists('drone_apus_woocommerce_cart_modal') ) {
    function drone_apus_woocommerce_cart_modal() {
        wc_get_template( 'content-product-cart-modal.php' , array( 'current_product_id' => (int)$_GET['product_id'] ) );
        die;
    }
}

add_action( 'wp_ajax_drone_add_to_cart_product', 'drone_apus_woocommerce_cart_modal' );
add_action( 'wp_ajax_nopriv_drone_add_to_cart_product', 'drone_apus_woocommerce_cart_modal' );
add_action( 'wp_footer', 'drone_apus_woocommerce_add_to_cart_modal' );


if ( !function_exists('drone_apus_get_products') ) {
    function drone_apus_get_products($categories = array(), $product_type = 'featured_product', $paged = 1, $post_per_page = -1, $orderby = '', $order = '') {
        global $woocommerce, $wp_query;
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => $post_per_page,
            'post_status' => 'publish',
            'paged' => $paged,
            'orderby'   => $orderby,
            'order' => $order
        );

        if ( isset( $args['orderby'] ) ) {
            if ( 'price' == $args['orderby'] ) {
                $args = array_merge( $args, array(
                    'meta_key'  => '_price',
                    'orderby'   => 'meta_value_num'
                ) );
            }
            if ( 'featured' == $args['orderby'] ) {
                $args = array_merge( $args, array(
                    'meta_key'  => '_featured',
                    'orderby'   => 'meta_value'
                ) );
            }
            if ( 'sku' == $args['orderby'] ) {
                $args = array_merge( $args, array(
                    'meta_key'  => '_sku',
                    'orderby'   => 'meta_value'
                ) );
            }
        }

        switch ($product_type) {
            case 'best_selling':
                $args['meta_key']='total_sales';
                $args['orderby']='meta_value_num';
                $args['ignore_sticky_posts']   = 1;
                $args['meta_query'] = array();
                $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                $args['meta_query'][] = $woocommerce->query->visibility_meta_query();
                break;
            case 'featured_product':
                $product_visibility_term_ids = wc_get_product_visibility_term_ids();
                $args['tax_query'][] = array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'term_taxonomy_id',
                    'terms'    => $product_visibility_term_ids['featured'],
                );
                break;
            case 'top_rate':
                add_filter( 'posts_clauses',  array( $woocommerce->query, 'order_by_rating_post_clauses' ) );
                $args['meta_query'] = array();
                $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                $args['meta_query'][] = $woocommerce->query->visibility_meta_query();
                break;
            case 'recent_product':
                $args['meta_query'] = array();
                $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                break;
            case 'deals':
                $args['meta_query'] = array();
                $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
                $args['meta_query'][] = $woocommerce->query->visibility_meta_query();
                $args['meta_query'][] =  array(
                    array(
                        'key'           => '_sale_price_dates_to',
                        'value'         => time(),
                        'compare'       => '>',
                        'type'          => 'numeric'
                    )
                );
                break;     
            case 'on_sale':
                $product_ids_on_sale    = wc_get_product_ids_on_sale();
                $product_ids_on_sale[]  = 0;
                $args['post__in'] = $product_ids_on_sale;
                break;
        }

        if ( !empty($categories) && is_array($categories) ) {
            $args['tax_query'][] = array(
                    'taxonomy'      => 'product_cat',
                    'field'         => 'slug',
                    'terms'         => $categories,
                    'operator'      => 'IN'
                );
        }
        
        return new WP_Query($args);
    }
}

// hooks
if ( !function_exists('drone_apus_woocommerce_enqueue_styles') ) {
    function drone_apus_woocommerce_enqueue_styles() {
        $skin = drone_apus_get_config('active_skin');
        if ( $skin == '' ) {
            $path =  get_template_directory_uri() .'/css/woocommerce.css';
        } else {
            $path =  get_template_directory_uri() .'/css/skins/'.$skin.'/woocommerce.css';
        }
        wp_enqueue_style( 'drone-woocommerce', $path , 'drone-woocommerce-front' , DRONE_THEME_VERSION, 'all' );
        wp_enqueue_script( 'drone-cloudzoom', get_template_directory_uri() . '/js/cloudzoom.js', array( 'jquery' ), '20150330', true );

        if ( !drone_apus_is_wc_quantity_increment_activated() ) {
            wp_enqueue_style( 'drone-quantity-increment', get_template_directory_uri() . '/css/wc-quantity-increment.css');
            wp_enqueue_script( 'drone-number-polyfill', get_template_directory_uri() . '/js/number-polyfill.min.js', array( 'jquery' ), '20150330', true );
            wp_enqueue_script( 'drone-quantity-increment', get_template_directory_uri() . '/js/wc-quantity-increment.js', array( 'jquery' ), '20150330', true );
        }
    }
}
add_action( 'wp_enqueue_scripts', 'drone_apus_woocommerce_enqueue_styles', 50 );

// cart
if ( !function_exists('drone_apus_woocommerce_header_add_to_cart_fragment') ) {
    function drone_apus_woocommerce_header_add_to_cart_fragment( $fragments ){
        global $woocommerce;
        $fragments['#cart .mini-cart-items'] =  sprintf(_n(' <span class="mini-cart-items"> %d  </span> ', ' <span class="mini-cart-items"> %d <em>item</em> </span> ', $woocommerce->cart->cart_contents_count, 'drone'), $woocommerce->cart->cart_contents_count);
        $fragments['#cart .mini-cart-total'] = trim( $woocommerce->cart->get_cart_total() );
        return $fragments;
    }
}
add_filter('woocommerce_add_to_cart_fragments', 'drone_apus_woocommerce_header_add_to_cart_fragment' );

// breadcrumb for woocommerce page
if ( !function_exists('drone_apus_woocommerce_breadcrumb_defaults') ) {
    function drone_apus_woocommerce_breadcrumb_defaults( $args ) {
        $breadcrumb_img = drone_apus_get_config('woo_breadcrumb_image');
        $breadcrumb_color = drone_apus_get_config('woo_breadcrumb_color');
        $style = array();
        if( $breadcrumb_color  ){
            $style[] = 'background-color:'.$breadcrumb_color;
        }
        if ( isset($breadcrumb_img['url']) && !empty($breadcrumb_img['url']) ) {
            $style[] = 'background-image:url(\''.esc_url($breadcrumb_img['url']).'\')';
        }
        $estyle = !empty($style)? ' style="'.implode(";", $style).'"':"";

        if ( is_single() ) {
            $title = esc_html__('Product Detail', 'drone');
        } else {
            $title = esc_html__('Products List', 'drone');
        }
        $args['wrap_before'] = '<section id="apus-breadscrumb" class="apus-breadscrumb"'.$estyle.'><div class="container"><div class="p-relative breadscrumb-inner"><ol class="apus-woocommerce-breadcrumb breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>';
        $args['wrap_after'] = '</ol><h2 class="bread-title">'.Магазин.'</h2></div></div></section>';

        return $args;
    }
}
add_filter( 'woocommerce_breadcrumb_defaults', 'drone_apus_woocommerce_breadcrumb_defaults' );
add_action( 'drone_woo_template_main_before', 'woocommerce_breadcrumb', 30, 0 );

// display woocommerce modes
if ( !function_exists('drone_apus_woocommerce_display_modes') ) {
    function drone_apus_woocommerce_display_modes(){
        global $wp;
        $current_url = add_query_arg( $wp->query_string, '', home_url( $wp->request ) );
        $woo_mode = drone_apus_woocommerce_get_display_mode();
        echo '<form action="'.  $current_url  .'" class="display-mode" method="get">';
            echo '<button title="'.esc_html__('Grid','drone').'" class="change-view '.($woo_mode == 'grid' ? 'active' : '').'" value="grid" name="display" type="submit"><i class="fa fa-th"></i></button>';
            echo '<button title="'.esc_html__( 'List', 'drone' ).'" class="change-view '.($woo_mode == 'list' ? 'active' : '').'" value="list" name="display" type="submit"><i class="fa fa-th-list"></i></button>';  
        echo '</form>'; 
    }
}
add_action( 'woocommerce_before_shop_loop', 'drone_apus_woocommerce_display_modes' , 2 );

if ( !function_exists('drone_apus_woocommerce_get_display_mode') ) {
    function drone_apus_woocommerce_get_display_mode() {
        $woo_mode = drone_apus_get_config('product_display_mode', 'grid');
        if ( isset($_COOKIE['drone_woo_mode']) && ($_COOKIE['drone_woo_mode'] == 'list' || $_COOKIE['drone_woo_mode'] == 'grid') ) {
            $woo_mode = $_COOKIE['drone_woo_mode'];
        }
        return $woo_mode;
    }
}


if(!function_exists('drone_apus_filter_before')){
    function drone_apus_filter_before(){
        echo '<div class="apus-filter">';
    }
}
if(!function_exists('drone_apus_filter_after')){
    function drone_apus_filter_after(){
        echo '</div>';
    }
}
add_action( 'woocommerce_before_shop_loop', 'drone_apus_filter_before' , 1 );
add_action( 'woocommerce_before_shop_loop', 'drone_apus_filter_after' , 40 );

// set display mode to cookie
if ( !function_exists('drone_apus_before_woocommerce_init') ) {
    function drone_apus_before_woocommerce_init() {
        if( isset($_GET['display']) && ($_GET['display']=='list' || $_GET['display']=='grid') ){  
            setcookie( 'drone_woo_mode', trim($_GET['display']) , time()+3600*24*100,'/' );
            $_COOKIE['drone_woo_mode'] = trim($_GET['display']);
        }
    }
}
add_action( 'init', 'drone_apus_before_woocommerce_init' );

// Number of products per page
if ( !function_exists('drone_apus_woocommerce_shop_per_page') ) {
    function drone_apus_woocommerce_shop_per_page($number) {
        $value = drone_apus_get_config('number_products_per_page');
        if ( is_numeric( $value ) && $value ) {
            $number = absint( $value );
        }
        return $number;
    }
}
add_filter( 'loop_shop_per_page', 'drone_apus_woocommerce_shop_per_page' );

// Number of products per row
if ( !function_exists('drone_apus_woocommerce_shop_columns') ) {
    function drone_apus_woocommerce_shop_columns($number) {
        $value = drone_apus_get_config('product_columns');
        if ( in_array( $value, array(2, 3, 4, 6) ) ) {
            $number = $value;
        }
        return $number;
    }
}
add_filter( 'loop_shop_columns', 'drone_apus_woocommerce_shop_columns' );

// share box
if ( !function_exists('drone_apus_woocommerce_share_box') ) {
    function drone_apus_woocommerce_share_box() {
        if ( drone_apus_get_config('show_product_social_share') ) {
            get_template_part( 'page-templates/parts/sharebox' );
        }
    }
}
add_filter( 'woocommerce_single_product_summary', 'drone_apus_woocommerce_share_box', 100 );

// quick view modal box
if ( !function_exists('drone_apus_woocommerce_quickview_modal') ) {
    function drone_apus_woocommerce_quickview_modal(){
    ?>
    <div class="modal fade" id="apus-quickview-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close btn btn-close" data-dismiss="modal" aria-hidden="true">
                        <i class="fa fa-times"></i>
                    </button>
                    <div class="modal-body-content"></div>
                </div>
            </div>
        </div>
    </div>
    <?php    
    }
}

// quickview
if ( !function_exists('drone_apus_woocommerce_quickview') ) {
    function drone_apus_woocommerce_quickview() {
        $args = array(
            'post_type'=>'product',
            'product' => $_GET['productslug']
        );
        $query = new WP_Query($args);
        if ( $query->have_posts() ) {
            while ($query->have_posts()): $query->the_post(); global $product;
                wc_get_template_part( 'content', 'product-quickview' );
            endwhile;
        }
        wp_reset_postdata();
        die;
    }
}


    add_action( 'wp_ajax_drone_quickview_product', 'drone_apus_woocommerce_quickview' );
    add_action( 'wp_ajax_nopriv_drone_quickview_product', 'drone_apus_woocommerce_quickview' );
    add_action( 'wp_footer', 'drone_apus_woocommerce_quickview_modal' );


// swap effect
if ( !function_exists('drone_apus_swap_images') ) {
    function drone_apus_swap_images() {
        global $post, $product, $woocommerce;
        $placeholder_width = get_option('shop_catalog_image_size');
        $placeholder_width = $placeholder_width['width'];
        $placeholder_height = get_option('shop_catalog_image_size');
        $placeholder_height = $placeholder_height['height'];

        $output='';
        $class = 'image-no-effect';
        if (has_post_thumbnail()) {
            $attachment_ids = $product->get_gallery_image_ids();
            if ($attachment_ids && isset($attachment_ids[0])) {
                $class = 'image-hover';
                $output .= wp_get_attachment_image($attachment_ids[0],'shop_single_image',false,array('class'=>"attachment-shop_catalog image-effect"));
            }
            $output .= get_the_post_thumbnail( $post->ID,'shop_single_image',array('class'=>$class) );
        } else {
            $output .= '<img src="'.wc_placeholder_img_src().'" alt="'.esc_html__('Placeholder' , 'drone').'" class="'.$class.'" width="'.$placeholder_width.'" height="'.$placeholder_height.'" />';
        }
        echo trim($output);
    }
}

if ( drone_apus_get_global_config('show_swap_image') ) {
    remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
    add_action('woocommerce_before_shop_loop_item_title', 'drone_apus_swap_images', 10);
}  

// layout class for woo page
if ( !function_exists('drone_apus_woocommerce_content_class') ) {
    function drone_apus_woocommerce_content_class( $class ) {
        $page = 'archive';
        if ( is_singular( 'product' ) ) {
            $page = 'single';
        }
        if( drone_apus_get_config('product_'.$page.'_fullwidth') ) {
            return 'container-fluid';
        }
        return $class;
    }
}
add_filter( 'drone_apus_woocommerce_content_class', 'drone_apus_woocommerce_content_class' );

// get layout configs
if ( !function_exists('drone_apus_get_woocommerce_layout_configs') ) {
    function drone_apus_get_woocommerce_layout_configs() {
        $page = 'archive';
        if ( is_singular( 'product' ) ) {
            $page = 'single';
        }
        $left = drone_apus_get_config('product_'.$page.'_left_sidebar');
        $right = drone_apus_get_config('product_'.$page.'_right_sidebar');

        switch ( drone_apus_get_config('product_'.$page.'_layout') ) {
            case 'left-main':
                $configs['left'] = array( 'sidebar' => $left, 'class' => 'col-md-3 col-sm-12 col-xs-12'  );
                $configs['main'] = array( 'class' => 'col-md-9 col-sm-12 col-xs-12' );
                break;
            case 'main-right':
                $configs['right'] = array( 'sidebar' => $right,  'class' => 'col-md-3 col-sm-12 col-xs-12' ); 
                $configs['main'] = array( 'class' => 'col-md-9 col-sm-12 col-xs-12' );
                break;
            case 'main':
                $configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-xs-12' );
                break;
            case 'left-main-right':
                $configs['left'] = array( 'sidebar' => $left,  'class' => 'col-md-3 col-sm-12 col-xs-12'  );
                $configs['right'] = array( 'sidebar' => $right, 'class' => 'col-md-3 col-sm-12 col-xs-12' ); 
                $configs['main'] = array( 'class' => 'col-md-6 col-sm-12 col-xs-12' );
                break;
            default:
                $configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-xs-12' );
                break;
        }

        return $configs; 
    }
}

// Show/Hide related, upsells products
if ( !function_exists('drone_apus_woocommerce_related_upsells_products') ) {
    function drone_apus_woocommerce_related_upsells_products($located, $template_name) {
        $content_none = get_template_directory() . '/woocommerce/content-none.php';
        $show_product_releated = drone_apus_get_config('show_product_releated');
        if ( 'single-product/related.php' == $template_name ) {
            if ( !$show_product_releated  ) {
                $located = $content_none;
            }
        } elseif ( 'single-product/up-sells.php' == $template_name ) {
            $show_product_upsells = drone_apus_get_config('show_product_upsells');
            if ( !$show_product_upsells ) {
                $located = $content_none;
            }
        }

        return apply_filters( 'drone_apus_woocommerce_related_upsells_products', $located, $template_name );
    }
}
add_filter( 'wc_get_template', 'drone_apus_woocommerce_related_upsells_products', 10, 2 );

if ( !function_exists( 'drone_apus_product_review_tab' ) ) {
    function drone_apus_product_review_tab($tabs) {
        if ( !drone_apus_get_config('show_product_review_tab') && isset($tabs['reviews']) ) {
            unset( $tabs['reviews'] ); 
        }
        return $tabs;
    }
}
add_filter( 'woocommerce_product_tabs', 'drone_apus_product_review_tab', 100 );

if ( !function_exists( 'drone_apus_minicart') ) {
    function drone_apus_minicart() {
        $template = apply_filters( 'drone_apus_minicart_version', '' );
        get_template_part( 'woocommerce/cart/mini-cart-button', $template ); 
    }
}
// Wishlist
add_filter( 'yith_wcwl_button_label', 'drone_apus_woocomerce_icon_wishlist'  );
add_filter( 'yith-wcwl-browse-wishlist-label', 'drone_apus_woocomerce_icon_wishlist_add' );
function drone_apus_woocomerce_icon_wishlist( $value='' ){
    return '<i class="fa fa-heart-o"></i>'.'<span class="sub-title">'.esc_html__('Add to Wishlist','drone').'</span>';
}

function drone_apus_woocomerce_icon_wishlist_add(){
    return '<i class="fa fa-check"></i>'.'<span class="sub-title">'.esc_html__('Wishlisted','drone').'</span>';
}
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );