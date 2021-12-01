<?php
/**
 *
 * The template for displaying posts in the Image post format
 * @since 1.0
 * @version 1.2.0
 *
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	$drone_format = drone_apus_post_format_link_helper( get_the_content(), get_the_title() );
	$drone_title = $drone_format['title'];
	?>
	<div class="row">
		<div class="col-md-12">
			<?php // if has post thumbnail, add link for thumbnail
			if ( has_post_thumbnail() ) {
				$drone_link = drone_apus_get_link_attributes( $drone_title );
				drone_apus_post_thumbnail( $drone_link );
			} ?>
			<div class="entry-thumb <?php echo  (!has_post_thumbnail() ? 'no-thumb' : ''); ?>">
				<?php drone_apus_post_thumbnail(); ?>
				<?php drone_apus_category( $post ); ?>
			</div>
			<?php drone_apus_center_meta( $post ); ?>
			<div class="border">
				<?php if ( ! is_single() ) : ?>
					<div class="post-excerpt entry-summary"><?php the_excerpt(); ?></div><!-- /entry-summary -->
				<?php else : ?>
					<div
						class="post-excerpt entry-content"><?php echo get_the_content( esc_html__( 'Read More', 'drone' ) ); ?></div><!-- /entry-content -->
					<div class="entry-meta-footer">
						<?php drone_apus_post_tags(); ?>
					</div>
					<?php if( drone_apus_get_config('show_blog_social_share', true) ) {
     					get_template_part( 'page-templates/parts/sharebox' );
     				} ?>
				<?php endif; ?>
			</div>
			<?php
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'drone' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'drone' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
			?>
		</div>
	</div>
	<?php do_action( 'drone_apus_post_format_content_after', $post ); ?>
</article><!-- /post-link -->