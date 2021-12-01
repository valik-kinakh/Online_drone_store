<?php

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

global $woocommerce;

$_id = drone_apus_random_key();
$_count = 1;

$list_query = $this->getListQuery( $atts );
if ( count($list_query) > 0 ) {
?>
	<div class="widget widget-products widget-product-tabs products <?php echo esc_attr($el_class); ?>">
		<div class="tabs-container tab-heading text-center clearfix tab-v8">
			<?php if($title!=''):?>
				<h3 class="widget-title">
            		<span><span><?php echo esc_attr( $title ); ?></span></span><?php if( isset($subtitle) && $subtitle ){ ?><span class="subtitle"><?php echo esc_html($subtitle); ?></span> <?php } ?>
				</h3>
			<?php endif; ?>
			<ul class="tabs-list nav nav-tabs">
				<?php $__count=0; ?>
				<?php foreach ($list_query as $key => $li) { ?>
						<li <?php echo ($__count==0)?' class="active"':''; ?>><a href="#<?php echo esc_attr($key.'-'.$_id); ?>" data-toggle="tab" data-title="<?php echo esc_attr($li['title']);?>"><?php echo trim( $li['title_tab'] );?></a></li>
					<?php $__count++; ?>
				<?php } ?>
			</ul>
		</div>
		<div class="widget-content tab-content woocommerce">
			<?php $__count=0; ?>
			<?php foreach ($list_query as $key => $li) { ?>
				<div class="tab-pane<?php echo ($__count == 0 ? ' active' : ''); ?>" id="<?php echo esc_attr($key).'-'.esc_attr($_id); ?>">
					<div class="grid-wrapper">
						<?php
							$loop = drone_apus_get_products( array(), $key, 1, $number );

							if ( $loop->have_posts()) {
								wc_get_template( 'layout-products/'.$layout_type.'.php' , array( 'loop' => $loop, 'columns' => $columns, 'number' => $number ) );
							}
						?>
					</div>

				</div>
				<?php $__count++; ?>
			<?php } ?>
		</div>
	</div>
<?php wp_reset_postdata(); ?>
	<script>
	jQuery(document).ready(function($) {
		jQuery('.widget-products a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
			jQuery('.widget-products .widget-title visual-title').text(jQuery(this).data('title'));
		});
	});
	</script>
<?php } ?>

