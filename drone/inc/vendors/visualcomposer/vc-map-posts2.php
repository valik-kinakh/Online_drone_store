<?php

if ( function_exists('vc_map') && class_exists('WPBakeryShortCode') ) {

    function drone_get_post_categories() {
        $return = array( esc_html__(' --- Choose a Category --- ', 'drone') => '' );

        $args = array(
            'type' => 'post',
            'child_of' => 0,
            'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => false,
            'hierarchical' => 1,
            'taxonomy' => 'category'
        );

        $categories = get_categories( $args );
        drone_get_post_category_childs( $categories, 0, 0, $return );

        return $return;
    }

    function drone_get_post_category_childs( $categories, $id_parent, $level, &$dropdown ) {
        foreach ( $categories as $key => $category ) {
            if ( $category->category_parent == $id_parent ) {
                $dropdown = array_merge( $dropdown, array( str_repeat( "- ", $level ) . $category->name => $category->slug ) );
                unset($categories[$key]);
                drone_get_post_category_childs( $categories, $category->term_id, $level + 1, $dropdown );
            }
        }
	}

	function drone_load_post2_element() {
		$layouts = array(
			esc_html__('Grid', 'drone') => 'grid',
			esc_html__('List', 'drone') => 'list',
			esc_html__('Carousel', 'drone') => 'carousel',
		);
		$columns = array(1,2,3,4,6);
		$categories = array();
		if ( is_admin() ) {
			$categories = drone_get_post_categories();
		}
		vc_map( array(
			'name' => esc_html__( 'Apus Grid Posts', 'drone' ),
			'base' => 'apus_gridposts',
			'icon' => 'icon-wpb-news-12',
			"category" => esc_html__('Apus Post', 'drone'),
			'description' => esc_html__( 'Create Post having blog styles', 'drone' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Title', 'drone' ),
					'param_name' => 'title',
					'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'drone' ),
					"admin_label" => true
				),
				array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Category','drone'),
	                "param_name" => 'category',
	                "value" => $categories
	            ),
	            array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Order By','drone'),
	                "param_name" => 'orderby',
	                "value" => array(
	                	esc_html__('Date', 'drone') => 'date',
	                	esc_html__('ID', 'drone') => 'ID',
	                	esc_html__('Author', 'drone') => 'author',
	                	esc_html__('Title', 'drone') => 'title',
	                	esc_html__('Modified', 'drone') => 'modified',
	                	esc_html__('Parent', 'drone') => 'parent',
	                	esc_html__('Comment count', 'drone') => 'comment_count',
	                	esc_html__('Menu order', 'drone') => 'menu_order',
	                	esc_html__('Random', 'drone') => 'rand',
	                )
	            ),
	            array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Sort order','drone'),
	                "param_name" => 'order',
	                "value" => array(
	                	esc_html__('Descending', 'drone') => 'DESC',
	                	esc_html__('Ascending', 'drone') => 'ASC',
	                )
	            ),
	            array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Limit', 'drone' ),
					'param_name' => 'posts_per_page',
					'description' => esc_html__( 'Enter limit posts.', 'drone' ),
					'std' => 4,
					"admin_label" => true
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show Pagination?', 'drone' ),
					'param_name' => 'show_pagination',
					'description' => esc_html__( 'Enables to show paginations to next new page.', 'drone' ),
					'value' => array( esc_html__( 'Yes, to show pagination', 'drone' ) => 'yes' )
				),
				array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Grid Columns','drone'),
	                "param_name" => 'grid_columns',
	                "value" => $columns
	            ),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Layout Type", 'drone'),
					"param_name" => "layout_type",
					"value" => $layouts
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Thumbnail size', 'drone' ),
					'param_name' => 'thumbsize',
					'description' => esc_html__( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height) . ', 'drone' )
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'drone' ),
					'param_name' => 'el_class',
					'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'drone' )
				)
			)
		) );
	}

	add_action( 'vc_after_set_mode', 'drone_load_post2_element', 99 );

	class WPBakeryShortCode_apus_gridposts extends WPBakeryShortCode {}
}