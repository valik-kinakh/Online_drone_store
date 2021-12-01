<?php
if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
	if ( !function_exists('drone_apus_vc_get_term_object')) {
		function drone_apus_vc_get_term_object($term) {
			$vc_taxonomies_types = vc_taxonomies_types();

			return array(
				'label' => $term->name,
				'value' => $term->slug,
				'group_id' => $term->taxonomy,
				'group' => isset( $vc_taxonomies_types[ $term->taxonomy ], $vc_taxonomies_types[ $term->taxonomy ]->labels, $vc_taxonomies_types[ $term->taxonomy ]->labels->name ) ? $vc_taxonomies_types[ $term->taxonomy ]->labels->name : esc_html__( 'Taxonomies', 'drone' ),
			);
		}
	}

	if ( !function_exists('drone_apus_category_field_search')) {
		function drone_apus_category_field_search( $search_string ) {
			$data = array();
			$vc_taxonomies_types = array('product_cat');
			$vc_taxonomies = get_terms( $vc_taxonomies_types, array(
				'hide_empty' => false,
				'search' => $search_string
			) );
			if ( is_array( $vc_taxonomies ) && ! empty( $vc_taxonomies ) ) {
				foreach ( $vc_taxonomies as $t ) {
					if ( is_object( $t ) ) {
						$data[] = drone_apus_vc_get_term_object( $t );
					}
				}
			}
			return $data;
		}
	}

	if ( !function_exists('drone_apus_category_render')) {
		function drone_apus_category_render($query) {  
			$category = get_term_by('slug', $query['value'], 'product_cat');
			if ( ! empty( $query ) && !empty($category)) {
				$data = array();
				$data['value'] = $category->slug;
				$data['label'] = $category->name;
				return ! empty( $data ) ? $data : false;
			}
			return false;
		}
	}

	$bases = array( 'apus_productstabs', 'apus_products', 'apus_product_countdown' );
	foreach( $bases as $base ){   
		add_filter( 'vc_autocomplete_'.$base .'_categories_callback', 'drone_apus_category_field_search', 10, 1 );
	 	add_filter( 'vc_autocomplete_'.$base .'_categories_render', 'drone_apus_category_render', 10, 1 );
	}

	if ( !function_exists('drone_apus_woocommerce_get_categories') ) {
	    function drone_apus_woocommerce_get_categories() {
	        $return = array( esc_html__(' --- Choose a Category --- ', 'drone') );

	        $args = array(
	            'type' => 'post',
	            'child_of' => 0,
	            'orderby' => 'name',
	            'order' => 'ASC',
	            'hide_empty' => false,
	            'hierarchical' => 1,
	            'taxonomy' => 'product_cat'
	        );

	        $categories = get_categories( $args );
	        drone_apus_get_category_childs( $categories, 0, 0, $return );

	        return $return;
	    }
	}

	if ( !function_exists('drone_apus_get_category_childs') ) {
	    function drone_apus_get_category_childs( $categories, $id_parent, $level, &$dropdown ) {
	        foreach ( $categories as $key => $category ) {
	            if ( $category->category_parent == $id_parent ) {
	                $dropdown = array_merge( $dropdown, array( str_repeat( "- ", $level ) . $category->name => $category->slug ) );
	                unset($categories[$key]);
	                drone_apus_get_category_childs( $categories, $category->term_id, $level + 1, $dropdown );
	            }
	        }
	    }
	}

	if ( !function_exists('drone_apus_load_woocommerce_element')) {
		function drone_apus_load_woocommerce_element() {
			$categories = drone_apus_woocommerce_get_categories();
			$orderbys = array(
				esc_html__( 'Date', 'drone' ) => 'date',
				esc_html__( 'Price', 'drone' ) => 'price',
				esc_html__( 'Random', 'drone' ) => 'rand',
				esc_html__( 'Sales', 'drone' ) => 'sales',
				esc_html__( 'ID', 'drone' ) => 'ID'
			);

			$orderways = array(
				esc_html__( 'Descending', 'drone' ) => 'DESC',
				esc_html__( 'Ascending', 'drone' ) => 'ASC',
			);
			$layouts = array(
				'Grid'=>'grid',
				'List'=>'list',
				'Carousel'=>'carousel'
			);
			$types = array(
				'Best Selling' => 'best_selling',
				'Featured Products' => 'featured_product',
				'Top Rate' => 'top_rate',
				'Recent Products' => 'recent_product',
				'On Sale' => 'on_sale'
			);

			$producttabs = array(
	            array( 'recent_product', esc_html__('Latest Products', 'drone') ),
	            array( 'featured_product', esc_html__('Featured Products', 'drone') ),
	            array( 'best_selling', esc_html__('BestSeller Products', 'drone') ),
	            array( 'top_rate', esc_html__('TopRated Products', 'drone') ),
	            array( 'on_sale', esc_html__('On Sale Products', 'drone') )
	        );
			$columns = array(1,2,3,4,6);
			vc_map( array(
		        "name" => esc_html__("Apus Product CountDown",'drone'),
		        "base" => "apus_product_countdown",
		        "class" => "",
		    	"category" => esc_html__('Apus Woocommerce','drone'),
		    	'description'	=> esc_html__( 'Display Product Sales with Count Down', 'drone' ),
		        "params" => array(
		            array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Title','drone'),
		                "param_name" => "title",
		            ),
		            array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Sub Title','drone'),
		                "param_name" => "subtitle",
		            ),
		            array(
					    'type' => 'autocomplete',
					    'heading' => esc_html__( 'Categories', 'drone' ),
					    'value' => '',
					    'param_name' => 'categories',
					    "admin_label" => true,
					    'description' => esc_html__( 'Choose a categories if you want to show products of that them', 'drone' ),
					    'settings' => array(
					     	'multiple' => true,
					     	'unique_values' => true
					    ),
				   	),
		            array(
		                "type" => "textfield",
		                "heading" => esc_html__("Number items to show", 'drone'),
		                "param_name" => "number",
		                'std' => '1',
		                "description" => esc_html__("", 'drone')
		            ),
		            array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Columns','drone'),
		                "param_name" => 'columns',
		                "value" => $columns
		            ),
		            array(
		                "type" => "dropdown",
		                "heading" => esc_html__("Layout",'drone'),
		                "param_name" => "layout_type",
		                "value" => array(esc_html__('Carousel', 'drone') => 'carousel', esc_html__('Grid', 'drone') =>'grid' ),
		                "admin_label" => true,
		                "description" => esc_html__("Select Columns.",'drone')
		            ),
		            array(
		                "type" => "textfield",
		                "heading" => esc_html__("Extra class name", 'drone'),
		                "param_name" => "el_class",
		                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'drone')
		            ),
		        )
		    ));
			
			// Product Category
			vc_map( array(
			    "name" => esc_html__("Apus Product Category",'drone'),
			    "base" => "apus_productcategory",
			    "class" => "",
				"category" => esc_html__('Apus Woocommerce','drone'),
			    'description'=> esc_html__( 'Show Products In Carousel, Grid, List, Special','drone' ), 
			    "params" => array(
			    	array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__('Title', 'drone'),
						"param_name" => "title",
						"value" =>''
					),
					 array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Sub Title','drone'),
		                "param_name" => "subtitle",
		            ),
				   	array(
						"type" => "dropdown",
						"heading" => esc_html__("Category",'drone'),
						"param_name" => "category",
						"value" => $categories
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Layout Type",'drone'),
						"param_name" => "layout_type",
						"value" => $layouts
					),
					array(
						"type"        => "attach_image",
						"description" => esc_html__("Upload an image for categories", 'drone'),
						"param_name"  => "image_cat",
						"value"       => '',
						'heading'     => esc_html__('Image', 'drone' )
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Number of products to show",'drone'),
						"param_name" => "number",
						"value" => '4'
					),
					array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Columns','drone'),
		                "param_name" => 'columns',
		                "value" => $columns
		            ),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Icon",'drone'),
						"param_name" => "icon"
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name",'drone'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.",'drone')
					)
			   	)
			));
			
			// Category Info
			vc_map( array(
				"name"     => esc_html__("Apus Product Categories Info",'drone'),
				"base"     => "apus_category_info",
				'description' => esc_html__( 'Show images and links of sub categories in block','drone' ),
				"class"    => "",
				"category" => esc_html__('Apus Woocommerce','drone'),
				"params"   => array(
					array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__('Title', 'drone'),
						"param_name" => "title",
						"value" =>''
					),
					array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Sub Title','drone'),
		                "param_name" => "subtitle",
		            ),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Category",'drone'),
						"param_name" => "category",
						"value" => $categories
					),
					array(
						"type"        => "attach_image",
						"description" => esc_html__("Upload an image for categories (190px x 190px)", 'drone'),
						"param_name"  => "image_cat",
						"value"       => '',
						'heading'     => esc_html__('Image', 'drone' )
					),
					array(
						"type"       => "textfield",
						"heading"    => esc_html__("Number of categories to show",'drone'),
						"param_name" => "number",
						"value"      => '5',

					),
					array(
						"type"        => "textfield",
						"heading"     => esc_html__("Extra class name",'drone'),
						"param_name"  => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.",'drone')
					)
			   	)
			));
			
			/**
			 * apus_products
			 */
			vc_map( array(
			    "name" => esc_html__("Apus Products",'drone'),
			    "base" => "apus_products",
			    'description'=> esc_html__( 'Show products as bestseller, featured in block', 'drone' ),
			    "class" => "",
			   	"category" => esc_html__('Apus Woocommerce','drone'),
			    "params" => array(
			    	array(
						"type" => "textfield",
						"heading" => esc_html__("Title",'drone'),
						"param_name" => "title",
						"admin_label" => true,
						"value" => ''
					),
					array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Sub Title','drone'),
		                "param_name" => "subtitle",
		            ),
					array(
					    'type' => 'autocomplete',
					    'heading' => esc_html__( 'Categories', 'drone' ),
					    'value' => '',
					    'param_name' => 'categories',
					    "admin_label" => true,
					    'description' => esc_html__( 'Choose categories if you want show products of them', 'drone' ),
					    'settings' => array(
					     	'multiple' => true,
					     	'unique_values' => true
					    ),
				   	),
			    	array(
						"type" => "dropdown",
						"heading" => esc_html__("Type",'drone'),
						"param_name" => "type",
						"value" => $types,
						"admin_label" => true,
						"description" => esc_html__("Select Columns.",'drone')
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Layout Type",'drone'),
						"param_name" => "layout_type",
						"value" => $layouts
					),
					array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Columns','drone'),
		                "param_name" => 'columns',
		                "value" => $columns
		            ),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Number of products to show",'drone'),
						"param_name" => "number",
						"value" => '4'
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name",'drone'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.",'drone')
					)
			   	)
			));
			/**
			 * apus_all_products
			 */
			vc_map( array(
			    "name" => esc_html__("Apus Products Tabs",'drone'),
			    "base" => "apus_productstabs",
			    'description'	=> esc_html__( 'Display BestSeller, TopRated ... Products In tabs', 'drone' ),
			    "class" => "",
			   	"category" => esc_html__('Apus Woocommerce','drone'),
			    "params" => array(
			    	array(
						"type" => "textfield",
						"heading" => esc_html__("Title",'drone'),
						"param_name" => "title",
						"value" => ''
					),
					array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Sub Title','drone'),
		                "param_name" => "subtitle",
		            ),
		            array(
					    'type' => 'autocomplete',
					    'heading' => esc_html__( 'Categories', 'drone' ),
					    'value' => '',
					    'param_name' => 'categories',
					    "admin_label" => true,
					    'description' => esc_html__( 'Choose categories if you want show products of them', 'drone' ),
					    'settings' => array(
					     	'multiple' => true,
					     	'unique_values' => true
					    ),
				   	),
					array(
			            "type" => "sorted_list",
			            "heading" => esc_html__("Show Tab", 'drone'),
			            "param_name" => "producttabs",
			            "description" => esc_html__("Control teasers look. Enable blocks and place them in desired order.", 'drone'),
			            "value" => "recent_product",
			            "options" => $producttabs
			        ),
			        array(
						"type" => "dropdown",
						"heading" => esc_html__("Layout Type",'drone'),
						"param_name" => "layout_type",
						"value" => $layouts
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Number of products to show",'drone'),
						"param_name" => "number",
						"value" => '4'
					),
					array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Columns','drone'),
		                "param_name" => 'columns',
		                "value" => $columns
		            ),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name",'drone'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.",'drone')
					)
			   	)
			));
			// Categories tabs
			vc_map( array(
				'name' => esc_html__( 'Products Categories Tabs ', 'drone' ),
				'base' => 'apus_categoriestabs',
				'icon' => 'icon-wpb-woocommerce',
				'category' => esc_html__( 'Apus Woocommerce', 'drone' ),
				'description' => esc_html__( 'Display  categories in Tabs', 'drone' ),
				'params' => array(
					array(
						"type" => "textfield",
						"heading" => esc_html__( 'Title','drone' ),
						"param_name" => "title",
						"value" => ''
					),
					array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__( 'Sub Title','drone' ),
		                "param_name" => "subtitle",
		            ),
					
					array(
						'type' => 'param_group',
						'heading' => esc_html__( 'Tabs', 'drone' ),
						'param_name' => 'categoriestabs',
						'description' => '',
						'value' => '',
						'params' => array(
							array(
								"type" => "dropdown",
								"heading" => esc_html__( 'Category', 'drone' ),
								"param_name" => "category",
								"value" => $categories
							),
							array(
								'type' => 'attach_image',
								'heading' => esc_html__( 'Icon', 'drone' ),
								'param_name' => 'icon',
								'description' => esc_html__( 'You can choose a icon image or you can use icon font', 'drone' ),
							),
							array(
								'type' => 'textfield',
								'heading' => esc_html__( 'Icon Font', 'drone' ),
								'param_name' => 'icon_font',
								'description' => esc_html__( 'You can use font awesome icon. Eg: fa fa-home', 'drone' ),
							),
							
						)
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Type",'drone'),
						"param_name" => "type",
						"value" => $types,
						"admin_label" => true,
						"description" => esc_html__("Select Columns.",'drone')
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Number Products', 'drone' ),
						'value' => 12,
						'param_name' => 'number',
						'description' => esc_html__( 'Number products per page to show', 'drone' ),
					),
					array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Columns','drone'),
		                "param_name" => 'columns',
		                "value" => $columns
		            ),
		            array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name",'drone'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.",'drone')
					)
				)
			) );
		}
	}
	add_action( 'vc_after_set_mode', 'drone_apus_load_woocommerce_element', 99 );

	class WPBakeryShortCode_Apus_productstabs extends WPBakeryShortCode {

		public function getListQuery( $atts ) { 
			$this->atts  = $atts; 
			$list_query = array();
			$types = isset($this->atts['producttabs']) ? explode(',', $this->atts['producttabs']) : array();
			foreach ($types as $type) {
				$list_query[$type] = $this->getTabTitle($type);
			}
			return $list_query;
		}

		public function getTabTitle($type){ 
			switch ($type) {
				case 'recent_product':
					return array('title' => esc_html__('Latest Products', 'drone'), 'title_tab'=>esc_html__('Latest', 'drone'));
				case 'featured_product':
					return array('title' => esc_html__('Featured Products', 'drone'), 'title_tab'=>esc_html__('Featured', 'drone'));
				case 'top_rate':
					return array('title' => esc_html__('Top Rated Products', 'drone'), 'title_tab'=>esc_html__('Top Rated', 'drone'));
				case 'best_selling':
					return array('title' => esc_html__('BestSeller Products', 'drone'), 'title_tab'=>esc_html__('BestSeller', 'drone'));
				case 'on_sale':
					return array('title' => esc_html__('Special Products', 'drone'), 'title_tab'=>esc_html__('Special', 'drone'));
			}
		}
	}

	class WPBakeryShortCode_Apus_product_countdown extends WPBakeryShortCode {}
	class WPBakeryShortCode_Apus_productcategory extends WPBakeryShortCode {}
	class WPBakeryShortCode_Apus_category_info extends WPBakeryShortCode {}
	class WPBakeryShortCode_Apus_products extends WPBakeryShortCode {}
	class WPBakeryShortCode_Apus_categoriestabs extends WPBakeryShortCode {}
}