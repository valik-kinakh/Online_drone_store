<?php

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$text_color = $text_color?'style="color:'. $text_color .';"' : "";
wp_enqueue_script( 'drone-counter-js', get_template_directory_uri().'/js/jquery.counterup.min.js', array( 'jquery' ) );
wp_enqueue_script( 'drone-waypoints-js', get_template_directory_uri().'/js/waypoints.min.js', array( 'jquery' ) );

?>
<?php $img = wp_get_attachment_image_src($image,'full'); ?>
<div class="counters <?php echo esc_attr($el_class); ?>">
	<div class="counter-wrap" >
		<?php if( isset($img[0]) ) { ?>
			<img src="<?php echo esc_url_raw($img[0]);?>" title="<?php echo esc_attr($title); ?>" class="image-icon">
		<?php } elseif( $icon ) { ?>
		 	<i class="fa <?php echo esc_attr($icon); ?>" <?php echo trim($text_color); ?>></i>
		<?php } ?>
		<span class="clearfix"></span>
	   	<span class="counter counterUp" <?php echo trim($text_color); ?>><?php echo (int)$number ?></span>
	</div> 
    <h5><?php echo trim($title); ?></h5>
</div>
