<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$_id = drone_apus_random_key();
?>
<div class="widget-googlemap <?php echo esc_attr($el_class); ?>">
    <?php if ($title!=''): ?>
        <h3 class="widget-title">
            <span><?php echo $title; ?></span>
            <?php if ( isset($subtitle) && $subtitle ): ?>
                <span class="subtitle"><?php echo esc_html($subtitle); ?></span>
            <?php endif; ?>
        </h3>
    <?php endif; ?>
	<div class="widget-content">
		<div id="apus_gmap_canvas_<?php echo esc_attr( $_id ); ?>" class="map_canvas" style="width:100%; height:<?php echo esc_attr( $height ); ?>px;"></div>
		
	</div>
</div>

<?php if ( isset($lat_lng) && $lat_lng ): ?>
	<script type="text/javascript">
		jQuery(document).ready(function($){
		  	$('#apus_gmap_canvas_<?php echo esc_js( $_id ); ?>').gmap3({
		        map:{
		          	options:{
		              	"draggable": true
						,"mapTypeControl": true
						,"mapTypeId": google.maps.MapTypeId.ROADMAP
						,"scrollwheel": false
						,"panControl": true
						,"rotateControl": false
						,"scaleControl": true
						,"streetViewControl": true
						,"zoomControl": true
						,"center":[<?php echo esc_js( $lat_lng ); ?>]
		              	,"zoom": <?php echo esc_js($zoom); ?>
		              	,'styles': [
						    {
							    featureType: "all",
							    elementType: "all",
							    "stylers": [ { "visibility": "on" }, { "invert_lightness": true }, { "lightness": 61 }, { "gamma": 0.36 }, { "saturation": -100 } ]
						  	}
					  	]
		          	}
		        },
		        marker:{
                  latLng: [<?php echo esc_js( $lat_lng ); ?>]
                }
		  	});
		});
	</script>
<?php endif; ?>