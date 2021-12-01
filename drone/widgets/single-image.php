<?php
extract( $args );
extract( $instance );
$title = apply_filters('widget_title', $instance['title']);

if ( $title ) {
    echo ($before_title)  . trim( $title ) . $after_title;
}

?>
<div class="single-image">
	<?php if ( $description ) { ?>
		<div class="description">
			<?php echo $description; ?>
		</div>
	<?php } ?>
	<?php if ( $single_image ) { ?>
		<img src="<?php echo esc_attr( $single_image ); ?>" alt="<?php echo esc_attr($alt); ?>">
	<?php } ?>
</div>
