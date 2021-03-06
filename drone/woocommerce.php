<?php

get_header();
$sidebar_configs = drone_apus_get_woocommerce_layout_configs();

?>

<?php do_action( 'drone_woo_template_main_before' ); ?>

<section id="main-container" class="main-content <?php echo apply_filters('drone_apus_woocommerce_content_class', 'container');?>">
	<div class="row">
		
		<?php
		$class = '';
		if ( isset($sidebar_configs['left']) ) {
			$class = 'pull-right';
		}
		?>
		<div id="main-content" class="archive-shop col-xs-12 <?php echo esc_attr($sidebar_configs['main']['class'].' '.$class); ?>">

			<div id="primary" class="content-area">
				<div id="content" class="site-content" role="main">

					 <?php  woocommerce_content(); ?>

				</div><!-- #content -->
			</div><!-- #primary -->
		</div><!-- #main-content -->

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
<?php

get_footer();
