<?php

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$socials = array('facebook' => esc_html__('Facebook', 'drone'), 'twitter' => esc_html__('Twitter', 'drone'),
	'youtube' => esc_html__('Youtube', 'drone'), 'pinterest' => esc_html__('Pinterest', 'drone'),
	'google-plus' => esc_html__('Google Plus', 'drone'));
?>
<div class="widget widget-social <?php echo esc_attr($el_class); ?>">
    <?php if ($title!=''): ?>
        <h3 class="widget-title">
            <span><?php echo esc_attr( $title ); ?></span>
            <?php if ( isset($subtitle) && $subtitle ): ?>
                <span class="subtitle"><?php echo esc_html($subtitle); ?></span>
            <?php endif; ?>
        </h3>
    <?php endif; ?>
    <div class="widget-content">
    	<?php if ($description != ''): ?>
	        <?php echo $description; ?>
	    <?php endif; ?>
		<ul class="social list-inline">
		    <?php foreach( $socials as $key=>$social):
		            if( isset($atts[$key.'_url']) && !empty($atts[$key.'_url']) ): ?>
		                <li>
		                    <a href="<?php echo esc_url($atts[$key.'_url']);?>" class="<?php echo esc_attr($key); ?>">
		                        <i class="fa fa-<?php echo esc_attr($key); ?> "></i>
		                    </a>
		                </li>
		    <?php
		            endif;
		        endforeach;
		    ?>
		</ul>
	</div>
</div>