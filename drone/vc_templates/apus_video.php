<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
?>
<div class="widget widget-video  <?php echo esc_attr($el_class); ?> <?php echo esc_attr( $style ); ?>">
    <div class="video-wrapper-inner">
	<div class="video">
		<?php $img = wp_get_attachment_image_src($image,'full'); ?>
		<?php if ( !empty($img) && isset($img[0]) ): ?>
			<a class="fancybox-video fancybox.iframe" href="<?php echo esc_url_raw($video_link); ?>">
				<i class="fa fa-play-circle" aria-hidden="true"></i>
        		<img src="<?php echo esc_url_raw($img[0]); ?>" alt="">
        	</a>
        <?php endif; ?>
	</div>
	<div class="video-content">
		<?php if ($title!=''): ?>
	        <h3 class="title-video">
	            <span><?php echo $title; ?></span>
	        </h3>
	    <?php endif; ?>
		<?php if ($description!=''): ?>
	        <p class="description"><?php echo $description; ?></p>
	    <?php endif; ?>
	</div>
	</div>
</div>