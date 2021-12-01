<?php

/**
 * Custom parameters for visual composer
 */
if ( !function_exists('drone_apus_custom_vc_params')) {
	function drone_apus_custom_vc_params(){

		vc_add_param( 'vc_row', array(
		    "type" => "checkbox",
		    "heading" => esc_html__("Parallax", 'drone'),
		    "param_name" => "parallax",
		    "value" => array(
		        'Yes, please' => true
		    )
		));

		vc_add_param( 'vc_row', array(
		    "type" => "dropdown",
		    "heading" => esc_html__("Is Boxed", 'drone'),
		    "param_name" => "isfullwidth",
		    "value" => array(
				esc_html__('Yes, Boxed', 'drone') => '1',
				esc_html__('No, Wide', 'drone') => '0'
			)
		));

		// add param for image elements

		vc_add_param( 'vc_single_image', array(
		     "type" => "textarea",
		     "heading" => esc_html__("Image Description", 'drone'),
		     "param_name" => "description",
		     "value" => "",
		     'priority'	
		));
	}
}
add_action( 'after_setup_theme', 'drone_apus_custom_vc_params', 99 );
 
/** 
* Replace pagebuilder columns and rows class by bootstrap classes
*/
if ( !function_exists('drone_apus_change_bootstrap_class')) {
	function drone_apus_change_bootstrap_class( $class_string, $tag ) {
		if ( $tag == 'vc_column' || $tag == 'vc_column_inner' ) {
			$class_string = preg_replace('/vc_span(\d{1,2})/', 'col-md-$1', $class_string);
			$class_string = preg_replace('/vc_hidden-(\w)/', 'hidden-$1', $class_string);
			$class_string = preg_replace('/vc_col-(\w)/', 'col-$1', $class_string);
			$class_string = str_replace('wpb_column', '', $class_string);
			$class_string = str_replace('column_container', 'fluid', $class_string);
		}
		return $class_string;
	}
}

add_filter( 'vc_shortcodes_css_class', 'drone_apus_change_bootstrap_class', 10, 2 );

if ( function_exists('apus_framework_add_param') ) {
	apus_framework_add_param();
}

function drone_apus_admin_map_init_scripts(){
	$key = drone_apus_get_config('google_map_api_key');
	wp_enqueue_script('googlemap_admin_js', '//maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places&amp;key='.$key );
	wp_enqueue_script('googlemap_geocomplete_js', get_template_directory_uri().'/js/admin/jquery.geocomplete.min.js');
}
add_action( 'admin_enqueue_scripts', 'drone_apus_admin_map_init_scripts' );

function drone_apus_map_init_scripts() {
	$key = drone_apus_get_config('google_map_api_key');
	wp_enqueue_script('base_gmap_api_js', '//maps.google.com/maps/api/js?sensor=true&amp;key='.$key);
	wp_enqueue_script('base_gmap_function_js', get_template_directory_uri().'/js/gmap3.js');
}
add_action('wp_enqueue_scripts', 'drone_apus_map_init_scripts');

function drone_apus_translate_column_width_to_span( $width ) {
	preg_match( '/(\d+)\/(\d+)/', $width, $matches );

	if ( ! empty( $matches ) ) {
		$part_x = (int) $matches[1];
		$part_y = (int) $matches[2];
		if ( $part_x > 0 && $part_y > 0 ) {
			$value = ceil( $part_x / $part_y * 12 );
			if ( $value > 0 && $value <= 12 ) {
				$width = 'vc_col-md-' . $value;
			}
		}
	}

	return $width;
}