<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Drone
 * @since Drone 1.0
 */
/*

*Template Name: 404 Page
*/
get_header();
$sidebar_configs = drone_apus_get_page_layout_configs();

drone_apus_render_breadcrumbs();

?>
<section class="page-404">
<section id="main-container" class="<?php echo apply_filters('drone_apus_page_content_class', 'container');?> inner">
	<div class="row">
		<?php
		$class = '';
		if ( isset($sidebar_configs['left']) ) {
			$class = 'pull-right';
		}
		?>

		<div id="main-content" class="main-page <?php echo esc_attr($sidebar_configs['main']['class'].' '.$class); ?>">
			<section class="error-404 not-found text-center clearfix">
				<h1 class="page-title"><?php esc_html_e( 'Page Not Found', 'drone' ); ?></h1>
				<div class="page-content">
					<p class="sub-title"><?php esc_html_e( 'It looks like you may have a wrong turn. Don\'t worry... it happens to the best of us.', 'drone' ); ?></p>

					<?php get_search_form(); ?>
					<a class="btn btn-primary btn-outline " href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e('back to home', 'drone'); ?><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->
		</div><!-- .content-area -->

		<?php if ( isset($sidebar_configs['left']) ) : ?>
			<div class="<?php echo esc_attr($sidebar_configs['left']['class']) ;?>">
			  	<aside class="sidebar sidebar-left" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
			   		<?php dynamic_sidebar( $sidebar_configs['left']['sidebar'] ); ?>
			  	</aside>
			</div>
		<?php endif; ?>

		<?php if ( isset($sidebar_configs['right']) ) : ?>
			<div class="<?php echo esc_attr($sidebar_configs['right']['class']) ;?>">
			  	<aside class="sidebar sidebar-right" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
			   		<?php dynamic_sidebar( $sidebar_configs['right']['sidebar'] ); ?>
			  	</aside>
			</div>
		<?php endif; ?>
		
	</div>
</section>
</section>
<?php get_footer(); ?>