<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Drone
 * @since Drone 1.0
 */

$footer = apply_filters( 'drone_apus_get_footer_layout', 'default' );

?>

	</div><!-- .site-content -->

	<footer id="apus-footer" class="apus-footer" role="contentinfo">
		<?php if ( !empty($footer) ): ?>
			<?php drone_apus_display_footer_builder($footer); ?>
		<?php else: ?>
			<?php if ( is_active_sidebar( 'footer1' ) || is_active_sidebar( 'footer2' ) || is_active_sidebar( 'footer3' ) || is_active_sidebar( 'footer4' ) ) : ?>
				<div class="footer-default">
					<div class="container">
						<div class="row">
							<?php if ( is_active_sidebar( 'footer1' ) ) : ?>
								<div class="col-md-4">
									<?php dynamic_sidebar( 'footer1' ); ?>
								</div>
							<?php endif; ?>

							<?php if ( is_active_sidebar( 'footer2' ) ) : ?>
								<div class="col-md-4">
									<?php dynamic_sidebar( 'footer2' ); ?>
								</div>
							<?php endif; ?>
							<?php if ( is_active_sidebar( 'footer3' ) ) : ?>
								<div class="col-md-4">
									<?php dynamic_sidebar( 'footer3' ); ?>
								</div>
							<?php endif; ?>
							<?php if ( is_active_sidebar( 'footer4' ) ) : ?>
								<div class="col-md-4">
									<?php dynamic_sidebar( 'footer4' ); ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endif; ?>

			<!--==============================powered=====================================-->
			
			<div class="apus-copyright">
				<div class="container">
					<div class="copyright-content">
						<div class="text-copyright pull-left">
						<?php
							if ( drone_apus_get_config('copyright_text') ) {
								echo drone_apus_get_config('copyright_text');
							} else {
								$allowed_html_array = array('strong' => array(),'a' => array('href'));
								echo wp_kses( __('Copyright &copy; 2016 - Drone. All Rights Reserved. <br/> Powered by <a href="//apusthemes.com">ApusThemes</a>', 'drone'), $allowed_html_array);
							}
						?>

						</div>
						<?php if ( has_nav_menu( 'footer-menu' ) ): ?>
		                <div class="pull-right">
		                    <nav class="apus-topmenu" role="navigation">
		                            <?php
		                                $args = array(
		                                    'theme_location'  => 'footer-menu',
		                                    'menu_class'      => 'menu',
		                                    'fallback_cb'     => '',
		                                    'menu_id'         => 'footer-menu'
		                                );
		                                wp_nav_menu($args);
		                            ?>
		                    </nav>                                                                     
		                </div>
		                <?php endif; ?>


						
					</div>
				</div>
			</div>
		
		<?php endif; ?>
		
	</footer><!-- .site-footer -->

	<?php
	if ( drone_apus_get_config('back_to_top') ) { ?>
		<a href="#" id="back-to-top">
			<i class="fa fa-angle-up"></i>
		</a>
	<?php
	}
	?>

</div><!-- .site -->

<?php if ( drone_apus_get_config('footer_js') != "" ) : ?>
	<script type="text/javascript">
		<?php echo drone_apus_get_config('footer_js'); ?>
	</script>
<?php endif; ?>

<?php wp_footer(); ?>

</body>
</html>
