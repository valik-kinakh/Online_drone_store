<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

?>
<div class="widget widget-banner text-center <?php echo (($el_class!='')?' '.$el_class:''); ?>">
    <?php if ($title!=''): ?>
        <h3 class="widget-title">
            <span><?php echo esc_attr( $title ); ?></span>
        </h3>
    <?php endif; ?>
    <div class="widget-content"> 
		<?php if (!empty($description)) { ?>
			<p class="widget-description">
				<?php echo trim( $description ); ?>
			</p>
		<?php } ?>

 	<?php if(trim($link)!=''){ ?>
        <div class="clearfix">
            <a class="btn btn-link btn-xs" href="<?php echo esc_url_raw( $link ); ?>"> <?php esc_html_e('Learn More ', 'drone'); ?> </a>
        </div>
    <?php } ?>

		<?php $img = wp_get_attachment_image_src($image,'full'); ?>
		<?php if ( !empty($img) && isset($img[0]) ): ?>
				<div class="image >">
            		<img src="<?php echo esc_url_raw($img[0]); ?>" alt="">
            	</div>
        <?php endif; ?>
	</div>
</div>