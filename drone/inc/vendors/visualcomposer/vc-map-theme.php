<?php

if ( !function_exists('drone_apus_load_load_theme_element')) {
	function drone_apus_load_load_theme_element() {
		$columns = array(1,2,3,4,6);
		// Heading Text Block
		vc_map( array(
			'name'        => esc_html__( 'Apus Widget Heading','drone'),
			'base'        => 'apus_title_heading',
			"class"       => "",
			"category" => esc_html__('Apus Elements', 'drone'),
			'description' => esc_html__( 'Create title for one Widget', 'drone' ),
			"params"      => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Widget title', 'drone' ),
					'param_name' => 'title',
					'value'       => esc_html__( 'Title', 'drone' ),
					'description' => esc_html__( 'Enter heading title.', 'drone' ),
					"admin_label" => true
				),
				array(
				    'type' => 'colorpicker',
				    'heading' => esc_html__( 'Title Color', 'drone' ),
				    'param_name' => 'font_color',
				    'description' => esc_html__( 'Select font color', 'drone' )
				),
				 
				array(
					"type" => "textarea",
					'heading' => esc_html__( 'Description', 'drone' ),
					"param_name" => "descript",
					"value" => '',
					'description' => esc_html__( 'Enter description for title.', 'drone' )
			    ),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Text Button', 'drone' ),
					'param_name' => 'textbutton',
					'description' => esc_html__( 'Text Button', 'drone' ),
					"admin_label" => true
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( ' Link Button', 'drone' ),
					'param_name' => 'linkbutton',
					'description' => esc_html__( 'Link Button', 'drone' ),
					"admin_label" => true
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Button Style", 'drone'),
					"param_name" => "buttons",
					'value' 	=> array(
						esc_html__('Default Outline', 'drone') => 'btn-default btn-outline', 
						esc_html__('Primary Outline', 'drone') => 'btn-primary btn-outline', 
						esc_html__('Lighten', 'drone') => 'btn-lighten'
					),
					'std' => ''
				),


				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Text Button 2', 'drone' ),
					'param_name' => 'textbutton2',
					'description' => esc_html__( 'Text Button 2', 'drone' ),
					"admin_label" => true
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( ' Link Button 2', 'drone' ),
					'param_name' => 'linkbutton2',
					'description' => esc_html__( 'Link Button 2', 'drone' ),
					"admin_label" => true
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Button Style", 'drone'),
					"param_name" => "buttons2",
					'value' 	=> array(
						esc_html__('Default Outline', 'drone') => 'btn-default btn-outline', 
						esc_html__('Primary Outline', 'drone') => 'btn-primary btn-outline', 
						esc_html__('Lighten', 'drone') => 'btn-lighten'
					),
					'std' => ''
				),


				array(
					"type" => "dropdown",
					"heading" => esc_html__("Style", 'drone'),
					"param_name" => "style",
					'value' 	=> array(
						esc_html__('Style Default', 'drone') => '', 
						esc_html__('Style1', 'drone') => 'style1', 
						esc_html__('Style2', 'drone') => 'style2', 
						esc_html__('Style3', 'drone') => 'style3' ,
						esc_html__('Style4', 'drone') => 'style4',
						esc_html__('Style5', 'drone') => 'style5'
					),
					'std' => ''
				),

				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'drone' ),
					'param_name' => 'el_class',
					'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'drone' )
				)

			),
		));
		
		// Banner CountDown
		vc_map( array(
			'name'        => esc_html__( 'Apus Banner CountDown','drone'),
			'base'        => 'apus_banner_countdown',
			"class"       => "",
			"category" => esc_html__('Apus Elements', 'drone'),
			'description' => esc_html__( 'Show CountDown with banner', 'drone' ),
			"params"      => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Widget title', 'drone' ),
					'param_name' => 'title',
					'value'       => esc_html__( 'Title', 'drone' ),
					'description' => esc_html__( 'Enter heading title.', 'drone' ),
					"admin_label" => true
				),
				array(
					"type" => "attach_image",
					"description" => esc_html__("If you upload an image, icon will not show.", 'drone'),
					"param_name" => "image",
					"value" => '',
					'heading'	=> esc_html__('Image', 'drone' )
				),
				array(
				    'type' => 'textfield',
				    'heading' => esc_html__( 'Date Expired', 'drone' ),
				    'param_name' => 'input_datetime',
				    'description' => esc_html__( 'Select font color', 'drone' ),
				),
				array(
				    'type' => 'colorpicker',
				    'heading' => esc_html__( 'Title Color', 'drone' ),
				    'param_name' => 'font_color',
				    'description' => esc_html__( 'Select font color', 'drone' )
				),
				array(
					"type" => "textarea",
					'heading' => esc_html__( 'Description', 'drone' ),
					"param_name" => "descript",
					"value" => '',
					'description' => esc_html__( 'Enter description for title.', 'drone' )
			    ),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'drone' ),
					'param_name' => 'el_class',
					'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'drone' )
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Text Link', 'drone' ),
					'param_name' => 'text_link',
					'value'		 => 'Find Out More',
					'description' => esc_html__( 'Enter your link text', 'drone' )
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Link', 'drone' ),
					'param_name' => 'link',
					'value'		 => 'http://',
					'description' => esc_html__( 'Enter your link to redirect', 'drone' )
				)
			),
		));
		$fields = array();
		for ($i=1; $i <= 5; $i++) { 
			$fields[] = array(
				"type" => "textfield",
				"heading" => esc_html__("Title", 'drone').' '.$i,
				"param_name" => "title".$i,
				"value" => '',    "admin_label" => true,
			);
			$fields[] = array(
				"type" => "attach_image",
				"heading" => esc_html__("Photo", 'drone').' '.$i,
				"param_name" => "photo".$i,
				"value" => '',
				'description' => ''
			);
			$fields[] = array(
				"type" => "textarea",
				"heading" => esc_html__("information", 'drone').' '.$i,
				"param_name" => "information".$i,
				"value" => 'Your Description Here',
				'description'	=> esc_html__('Allow  put html tags', 'drone' )
			);
	    	$fields[] = array(
				"type" => "textfield",
				"heading" => esc_html__("Link Read More", 'drone').' '.$i,
				"param_name" => "link".$i,
				"value" => '',
			);
		}
		$fields[] = array(
			"type" => "textfield",
			"heading" => esc_html__("Extra class name", 'drone'),
			"param_name" => "el_class",
			"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'drone')
		);
		// Featured Box
		vc_map( array(
		    "name" => esc_html__("Apus Featured Banner",'drone'),
		    "base" => "apus_featurebanner",
		    "description"=> esc_html__('Decreale Service Info', 'drone'),
		    "class" => "",
		    "category" => esc_html__('Apus Elements', 'drone'),
		    "params" => $fields
		));
		
		// Apus Counter
		vc_map( array(
		    "name" => esc_html__("Apus Counter",'drone'),
		    "base" => "apus_counter",
		    "class" => "",
		    "description"=> esc_html__('Counting number with your term', 'drone'),
		    "category" => esc_html__('Apus Elements', 'drone'),
		    "params" => array(
		    	array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'drone'),
					"param_name" => "title",
					"value" => '',
					"admin_label"	=> true
				),
				array(
					"type" => "textarea",
					"heading" => esc_html__("Description", 'drone'),
					"param_name" => "description",
					"value" => '',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Number", 'drone'),
					"param_name" => "number",
					"value" => ''
				),
			 	array(
					"type" => "textfield",
					"heading" => esc_html__("FontAwsome Icon", 'drone'),
					"param_name" => "icon",
					"value" => '',
					'description' => esc_html__( 'This support display icon from FontAwsome, Please click', 'drone' )
									. '<a href="' . ( is_ssl()  ? 'https' : 'http') . '://fortawesome.github.io/Font-Awesome/" target="_blank">'
									. esc_html__( 'here to see the list', 'drone' ) . '</a>'
				),
				array(
					"type" => "attach_image",
					"description" => esc_html__("If you upload an image, icon will not show.", 'drone'),
					"param_name" => "image",
					"value" => '',
					'heading'	=> esc_html__('Image', 'drone' )
				),
				array(
					"type" => "colorpicker",
					"heading" => esc_html__("Text Color", 'drone'),
					"param_name" => "text_color",
					'value' 	=> '',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name", 'drone'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'drone')
				)
		   	)
		));

		// Apus Counter
		vc_map( array(
		    "name" => esc_html__("Apus Brands",'drone'),
		    "base" => "apus_brands",
		    "class" => "",
		    "description"=> esc_html__('Display brands on front end', 'drone'),
		    "category" => esc_html__('Apus Elements', 'drone'),
		    "params" => array(
		    	array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'drone'),
					"param_name" => "title",
					"value" => '',
					"admin_label"	=> true
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Number", 'drone'),
					"param_name" => "number",
					"value" => ''
				),
			 	array(
					"type" => "dropdown",
					"heading" => esc_html__("Layout Type", 'drone'),
					"param_name" => "layout_type",
					'value' 	=> array(
						esc_html__('Carousel', 'drone') => 'carousel', 
						esc_html__('Grid', 'drone') => 'grid'
					),
					'std' => ''
				),
				array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Columns','drone'),
	                "param_name" => 'columns',
	                "value" => $columns
	            ),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name", 'drone'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'drone')
				)
		   	)
		));
		
		vc_map( array(
		    "name" => esc_html__("Apus Socials link",'drone'),
		    "base" => "apus_socials_link",
		    "description"=> esc_html__('Show socials link', 'drone'),
		    "category" => esc_html__('Apus Elements', 'drone'),
		    "params" => array(
		    	array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'drone'),
					"param_name" => "title",
					"value" => '',
					"admin_label"	=> true
				),
				array(
					"type" => "textarea",
					"heading" => esc_html__("Description", 'drone'),
					"param_name" => "description",
					"value" => '',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Facebook Page URL", 'drone'),
					"param_name" => "facebook_url",
					"value" => '',
					"admin_label"	=> true
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Twitter Page URL", 'drone'),
					"param_name" => "twitter_url",
					"value" => '',
					"admin_label"	=> true
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Youtube Page URL", 'drone'),
					"param_name" => "youtube_url",
					"value" => '',
					"admin_label"	=> true
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Pinterest Page URL", 'drone'),
					"param_name" => "pinterest_url",
					"value" => '',
					"admin_label"	=> true
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Google Plus Page URL", 'drone'),
					"param_name" => "google-plus_url",
					"value" => '',
					"admin_label"	=> true
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name", 'drone'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'drone')
				)
		   	)
		));
		// newsletter
		vc_map( array(
		    "name" => esc_html__("Apus Newsletter",'drone'),
		    "base" => "apus_newsletter",
		    "class" => "",
		    "description"=> esc_html__('Show newsletter form', 'drone'),
		    "category" => esc_html__('Apus Elements', 'drone'),
		    "params" => array(
		    	array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'drone'),
					"param_name" => "title",
					"value" => '',
					"admin_label"	=> true
				),
				array(
					"type" => "textarea",
					"heading" => esc_html__("Description", 'drone'),
					"param_name" => "description",
					"value" => '',
				),
				
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name", 'drone'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'drone')
				)
		   	)
		));
		// google map
		vc_map( array(
		    "name" => esc_html__("Apus Google Map",'drone'),
		    "base" => "apus_googlemap",
		    "description" => esc_html__('Diplay Google Map', 'drone'),
		    "category" => esc_html__('Apus Elements', 'drone'),
		    "params" => array(
		    	array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'drone'),
					"param_name" => "title",
					"admin_label" => true,
					"value" => '',
				),
	            array(
	                'type' => 'googlemap',
	                'heading' => esc_html__( 'Location', 'drone' ),
	                'param_name' => 'location',
	                'value' => ''
	            ),
	            array(
	                'type' => 'hidden',
	                'heading' => esc_html__( 'Latitude Longitude', 'drone' ),
	                'param_name' => 'lat_lng',
	                'value' => '21.0173222,105.78405279999993'
	            ),
	            array(
					"type" => "textfield",
					"heading" => esc_html__("Map height", 'drone'),
					"param_name" => "height",
					"value" => '',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Map Zoom", 'drone'),
					"param_name" => "zoom",
					"value" => '13',
				),
	            array(
	                'type' => 'dropdown',
	                'heading' => esc_html__( 'Map Type', 'drone' ),
	                'param_name' => 'type',
	                'value' => array(
	                    esc_html__( 'roadmap', 'drone' ) 		=> 'ROADMAP',
	                    esc_html__( 'hybrid', 'drone' ) 	=> 'HYBRID',
	                    esc_html__( 'satellite', 'drone' ) 	=> 'SATELLITE',
	                    esc_html__( 'terrain', 'drone' ) 	=> 'TERRAIN',
	                )
	            ),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name", 'drone'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'drone')
				)
		   	)
		));
		// Testimonial
		vc_map( array(
            "name" => esc_html__("Apus Testimonials",'drone'),
            "base" => "apus_testimonials",
            'description'=> esc_html__('Display Testimonials In FrontEnd', 'drone'),
            "class" => "",
            "category" => esc_html__('Apus Elements', 'drone'),
            "params" => array(
              	array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'drone'),
					"param_name" => "title",
					"admin_label" => true,
					"value" => '',
				),
              	array(
	              	"type" => "textfield",
	              	"heading" => esc_html__("Number", 'drone'),
	              	"param_name" => "number",
	              	"value" => '4',
	            ),
	            array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Columns','drone'),
	                "param_name" => 'columns',
	                "value" => $columns
	            ),
	            array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Style','drone'),
	                "param_name" => 'style',
	                'value' 	=> array(
						esc_html__('Default ', 'drone') => '', 
						esc_html__('Styel Lighten ', 'drone') => 'lighten', 
					),
					'std' => ''
	            ),
	            array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name", 'drone'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'drone')
				)
            )
        ));
        // Our Team
		vc_map( array(
            "name" => esc_html__("Apus Our Team",'drone'),
            "base" => "apus_ourteam",
            'description'=> esc_html__('Display Our Team In FrontEnd', 'drone'),
            "class" => "",
            "category" => esc_html__('Apus Elements', 'drone'),
            "params" => array(
              	array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'drone'),
					"param_name" => "title",
					"admin_label" => true,
					"value" => '',
				),
				array(
					"type" => "attach_image",
					"description" => esc_html__("If you upload an image, icon will not show.", 'drone'),
					"param_name" => "image_icon",
					"value" => '',
					'heading'	=> esc_html__('Title Icon', 'drone' )
				),
              	array(
					'type' => 'param_group',
					'heading' => esc_html__('Members Settings', 'drone' ),
					'param_name' => 'members',
					'description' => '',
					'value' => '',
					'params' => array(
						array(
			                "type" => "textfield",
			                "class" => "",
			                "heading" => esc_html__('Name','drone'),
			                "param_name" => "name",
			            ),
			            array(
			                "type" => "textfield",
			                "class" => "",
			                "heading" => esc_html__('Job','drone'),
			                "param_name" => "job",
			            ),
						array(
							"type" => "attach_image",
							"heading" => esc_html__("Image", 'drone'),
							"param_name" => "image"
						),

			            array(
			                "type" => "textfield",
			                "class" => "",
			                "heading" => esc_html__('Facebook','drone'),
			                "param_name" => "facebook",
			            ),

			            array(
			                "type" => "textfield",
			                "class" => "",
			                "heading" => esc_html__('Twitter Link','drone'),
			                "param_name" => "twitter",
			            ),

			            array(
			                "type" => "textfield",
			                "class" => "",
			                "heading" => esc_html__('Google plus Link','drone'),
			                "param_name" => "google",
			            ),

			            array(
			                "type" => "textfield",
			                "class" => "",
			                "heading" => esc_html__('Linkin Link','drone'),
			                "param_name" => "linkin",
			            ),

					),
				),
				array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Columns','drone'),
	                "param_name" => 'columns',
	                "value" => $columns
	            ),
	            array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name", 'drone'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'drone')
				)
            )
        ));
        // Gallery Images
		vc_map( array(
            "name" => esc_html__("Apus Gallery",'drone'),
            "base" => "apus_gallery",
            'description'=> esc_html__('Display Gallery In FrontEnd', 'drone'),
            "class" => "",
            "category" => esc_html__('Apus Elements', 'drone'),
            "params" => array(
              	array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'drone'),
					"param_name" => "title",
					"admin_label" => true,
					"value" => '',
				),
              	array(
					"type" => "attach_images",
					"heading" => esc_html__("Images", 'drone'),
					"param_name" => "images"
				),
				array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Columns','drone'),
	                "param_name" => 'columns',
	                "value" => $columns
	            ),
	           	array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Style','drone'),
	                "param_name" => 'style',
	                'value' 	=> array(
						esc_html__('Default', 'drone') => '', 
						esc_html__('Styel 1', 'drone') => 'style1',
						esc_html__('Styel 2', 'drone') => 'style2',
						esc_html__('Styel 3', 'drone') => 'style3'
					),
					'std' => ''
	            ),
	            array(
					"type" => "textarea",
					'heading' => esc_html__( 'Description', 'drone' ),
					"param_name" => "description",
					"value" => '',
					'description' => esc_html__( 'This field is used for Style 2.', 'drone' )
			    ),
			    array(
					"type" => "textfield",
					"heading" => esc_html__("Button Text", 'drone'),
					"param_name" => "button_text"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Button Url", 'drone'),
					"param_name" => "button_url"
				),
	            array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name", 'drone'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'drone')
				)
            )
        ));
        // Gallery Images
		vc_map( array(
            "name" => esc_html__("Apus Video",'drone'),
            "base" => "apus_video",
            'description'=> esc_html__('Display Video In FrontEnd', 'drone'),
            "class" => "",
            "category" => esc_html__('Apus Elements', 'drone'),
            "params" => array(
              	array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'drone'),
					"param_name" => "title",
					"admin_label" => true,
					"value" => '',
				),
				array(
					"type" => "textarea",
					'heading' => esc_html__( 'Description', 'drone' ),
					"param_name" => "description",
					"value" => '',
					'description' => esc_html__( 'Enter description for title.', 'drone' )
			    ),
              	array(
					"type" => "attach_image",
					"heading" => esc_html__("Video Cover Image", 'drone'),
					"param_name" => "image"
				),
				array(
	                "type" => "textfield",
	                "heading" => esc_html__('Youtube Video Link','drone'),
	                "param_name" => 'video_link'
	            ),
	           	array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Style','drone'),
	                "param_name" => 'style',
	                'value' 	=> array(
						esc_html__('Default ', 'drone') => '', 
						esc_html__('Styel 1 ', 'drone') => 'style1'
					),
					'std' => ''
	            ),
	            array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name", 'drone'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'drone')
				)
            )
        ));
        // Features Box
		vc_map( array(
            "name" => esc_html__("Apus Features",'drone'),
            "base" => "apus_features",
            'description'=> esc_html__('Display Features In FrontEnd', 'drone'),
            "class" => "",
            "category" => esc_html__('Apus Elements', 'drone'),
            "params" => array(
            	array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'drone'),
					"param_name" => "title",
					"admin_label" => true,
					"value" => '',
				),
				array(
					'type' => 'param_group',
					'heading' => esc_html__('Members Settings', 'drone' ),
					'param_name' => 'items',
					'description' => '',
					'value' => '',
					'params' => array(
						array(
			                "type" => "textfield",
			                "class" => "",
			                "heading" => esc_html__('Title','drone'),
			                "param_name" => "title",
			            ),
			            array(
			                "type" => "textarea",
			                "class" => "",
			                "heading" => esc_html__('Description','drone'),
			                "param_name" => "description",
			            ),
						array(
							"type" => "textfield",
							"heading" => esc_html__("FontAwsome Icon", 'drone'),
							"param_name" => "icon",
							"value" => '',
							'description' => esc_html__( 'This support display icon from FontAwsome, Please click', 'drone' )
											. '<a href="' . ( is_ssl()  ? 'https' : 'http') . '://fortawesome.github.io/Font-Awesome/" target="_blank">'
											. esc_html__( 'here to see the list', 'drone' ) . '</a>'
						),
						array(
							"type" => "attach_image",
							"description" => esc_html__("If you upload an image, icon will not show.", 'drone'),
							"param_name" => "image",
							"value" => '',
							'heading'	=> esc_html__('Image', 'drone' )
						),
						array(
			                "type" => "textfield",
			                "class" => "",
			                "heading" => esc_html__('Button Link','drone'),
			                "param_name" => "link",
			            ),
					),
				),
	           	array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Style','drone'),
	                "param_name" => 'style',
	                'value' 	=> array(
						esc_html__('Default ', 'drone') => 'default', 
						esc_html__('Styel 1 ', 'drone') => 'style1', 
						esc_html__('Styel 2 ', 'drone') => 'style2',
						esc_html__('Styel 3 ', 'drone') => 'style3'
					),
					'std' => ''
	            ),
	            array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name", 'drone'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'drone')
				)
            )
        ));

		// Banner
		vc_map( array(
		    "name" => esc_html__("Apus Banner",'drone'),
		    "base" => "apus_banner",
		    "class" => "",
		    "description"=> esc_html__('Show Text Images', 'drone'),
		    "category" => esc_html__('Apus Elements', 'drone'),
		    "params" => array(
		    	array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'drone'),
					"param_name" => "title",
					"value" => '',
					"admin_label"	=> true
				),
				array(
					"type" => "textarea",
					"heading" => esc_html__("Description", 'drone'),
					"param_name" => "description",
					"value" => '',
				),
				array(
					"type" => "attach_image",
					"heading" => esc_html__("Images", 'drone'),
					"param_name" => "image"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Link", 'drone'),
					"param_name" => "link",
					"value" => '',
					"admin_label"	=> true
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name", 'drone'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'drone')
				)
		   	)
		));
		
		$custom_menus = array();
		if ( is_admin() ) {
			$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
			if ( is_array( $menus ) && ! empty( $menus ) ) {
				foreach ( $menus as $single_menu ) {
					if ( is_object( $single_menu ) && isset( $single_menu->name, $single_menu->slug ) ) {
						$custom_menus[ $single_menu->name ] = $single_menu->slug;
					}
				}
			}
		}
		// Menu
		vc_map( array(
		    "name" => esc_html__("Apus Custom Menu",'drone'),
		    "base" => "apus_custom_menu",
		    "class" => "",
		    "description"=> esc_html__('Show Custom Menu', 'drone'),
		    "category" => esc_html__('Apus Elements', 'drone'),
		    "params" => array(
		    	array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'drone'),
					"param_name" => "title",
					"value" => '',
					"admin_label"	=> true
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Menu', 'drone' ),
					'param_name' => 'nav_menu',
					'value' => $custom_menus,
					'description' => empty( $custom_menus ) ? esc_html__( 'Custom menus not found. Please visit <b>Appearance > Menus</b> page to create new menu.', 'drone' ) : esc_html__( 'Select menu to display.', 'drone' ),
					'admin_label' => true,
					'save_always' => true,
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name", 'drone'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'drone')
				)
		   	)
		));
	}
}
add_action( 'vc_after_set_mode', 'drone_apus_load_load_theme_element', 99 );

class WPBakeryShortCode_apus_title_heading extends WPBakeryShortCode {}
class WPBakeryShortCode_apus_banner_countdown extends WPBakeryShortCode {}
class WPBakeryShortCode_apus_featurebanner extends WPBakeryShortCode {}
class WPBakeryShortCode_apus_brands extends WPBakeryShortCode {}
class WPBakeryShortCode_apus_socials_link extends WPBakeryShortCode {}
class WPBakeryShortCode_apus_newsletter extends WPBakeryShortCode {}
class WPBakeryShortCode_apus_banner extends WPBakeryShortCode {}
class WPBakeryShortCode_apus_googlemap extends WPBakeryShortCode {}
class WPBakeryShortCode_apus_testimonials extends WPBakeryShortCode {}

class WPBakeryShortCode_apus_counter extends WPBakeryShortCode {
	public function __construct( $settings ) {
		parent::__construct( $settings );
		$this->load_scripts();
	}

	public function load_scripts() {
		wp_register_script('drone-counterup-js', get_template_directory_uri().'/js/jquery.counterup.min.js', array('jquery'), false, true);
	}
}

class WPBakeryShortCode_apus_ourteam extends WPBakeryShortCode {}
class WPBakeryShortCode_apus_gallery extends WPBakeryShortCode {}
class WPBakeryShortCode_apus_video extends WPBakeryShortCode {}
class WPBakeryShortCode_apus_features extends WPBakeryShortCode {}
class WPBakeryShortCode_apus_custom_menu extends WPBakeryShortCode {}