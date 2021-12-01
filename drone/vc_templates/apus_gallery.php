<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$bcol = 12/$columns;
$images = $images ? explode(',', $images) : array();
$count = 1;
if ( !empty($images) ):
?>
	<div class="widget widget-gallery no-margin <?php echo esc_attr($el_class).' '.esc_attr($style);?>">
	    <?php if ($title!=''): ?>
	    <div class="text-center clearfix heading">
	        <h3 class="widget-title">
	            <span><?php echo $title; ?></span>
	        </h3>
	    </div>
	    <?php endif; ?>
	    <div class="widget-content grid-style-2">
			<div class="row">
				<?php foreach ($images as $image): ?>
					<?php $img = wp_get_attachment_image_src($image,'full'); ?>
					<?php if ( !empty($img) && isset($img[0]) ): ?>
						<div class="col-sm-<?php echo esc_attr($bcol); ?>">
							<div class="image <?php echo ($count%$columns == 0 ) ? 'last' : ''; ?>">
							<a href="<?php echo esc_url_raw($img[0]); ?>" class="fancybox ">
	                    		<img src="<?php echo esc_url_raw($img[0]); ?>" alt="">
	                    	</a>
	                    	</div>
	                    </div>
	                <?php endif; ?>
				<?php $count++;  endforeach; ?>
			</div>
		</div>
		<?php if ( $style == 'style2' && $description != '' ): ?>
			<div class="description space-padding-tb-55 clearfix">
				<div class="container">
					<div class="space-padding-lr-100">
			        	<h3 class="pull-left title-des"><?php echo $description; ?></h3>
			        	<?php if ($button_text): ?>
				        	<a href="<?php echo esc_url($button_url); ?>" class="btn btn-befo btn-lighten pull-right"> <?php echo $button_text; ?> </a>
				        <?php endif; ?>
			        </div>
		        </div>
	        </div>
	    <?php endif; ?>
	    <?php if ( $style == 'style3' && $button_text ): ?>
	    	<div class="description space-padding-tb-55 clearfix">
				<div class="container">
					<div class="space-padding-lr-100">
	    				<div class="text-center"><a class="btn btn-befo btn-lighten" href="<?php echo esc_url($button_url); ?>"> <?php echo $button_text; ?> </a></div>
    				</div>
				</div>
			</div>
	    <?php endif; ?>
	</div>
<?php endif; ?>