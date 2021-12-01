<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Drone
 * @since Drone 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php
	$favicon = drone_apus_get_config('media-favicon');
	if ( (isset($favicon['url'])) && (trim($favicon['url']) != "" ) ) {
        
        if (is_ssl()) {
            $favicon_image_img = str_replace("http://", "https://", $favicon['url']);		
        } else {
            $favicon_image_img = $favicon['url'];
        }
	?>
    
    <link rel="shortcut icon" href="<?php echo esc_url($favicon_image_img); ?>" />
    <?php } ?>

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php if ( drone_apus_get_config('preload') ) { ?>
	<div class="apus-page-loading">
	  	<div id="loader"></div>
	  	<div class="loader-section section-left"></div>
	  	<div class="loader-section section-right"></div>
	</div>
<?php } ?>
<div id="wrapper-container" class="wrapper-container">

	<?php get_template_part( 'page-templates/parts/offcanvas-menu' ); ?>

	<?php get_template_part( 'page-templates/parts/header-mobile' ); ?>

	<?php $header = apply_filters( 'drone_apus_get_header_layout', drone_apus_get_config('header_type') );
		if ( empty($header) ) {
			$header = 'v1';
		}
	?>
	<?php get_template_part( 'headers/'.$header ); ?>

	<div id="apus-main-content">
