<?php 

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$time = strtotime( $input_datetime );
$style = '';
$fstyle = '';

if( $image ){
	$img = wp_get_attachment_image_src( $image,'full' );
	if( isset($img[0]) ){
		$style = 'style="background-image:url(\''.$img[0].'\')"';
	}
}
if( $font_color ){
	$fstyle = 'style="color:'.$font_color.'"';
}
?>
<div class="banner-countdown-widget <?php echo esc_attr($el_class); ?>" <?php echo trim($style); ?>>
	<div class="inner text-center space-padding-tb-30" <?php echo trim($fstyle); ?>>
		<div class="heading heading-light">
			<?php if( isset($title) && $title ) : ?>
			<h3 <?php echo trim($fstyle); ?>><?php echo trim($title); ?></h3>
			<?php endif; ?>	

			<?php if( isset($descript) && $descript ) : ?>
			<h4 <?php echo trim($fstyle); ?>><?php echo trim($descript); ?></h4>
		<?php endif; ?>	
		</div>

		 <div class="countdown-wrapper">
		    <div class="apus-countdown" data-countdown="countdown"
		         data-date="<?php echo date('m',$time).'-'.date('d',$time).'-'.date('Y',$time).'-'. date('H',$time) . '-' . date('i',$time) . '-' .  date('s',$time) ; ?>">
		    </div>
		</div>
		<?php if( $link && $text_link ) : ?>	
			<a href="<?php echo esc_url_raw($link); ?>" <?php echo trim($fstyle); ?>><?php echo trim( $text_link ); ?></a>
		<?php endif; ?>
	</div>	
</div>