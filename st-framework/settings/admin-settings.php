<?php

global $wp_registered_sidebars, $predefined_colors;

$st_sidebars = $wp_registered_sidebars;

$general_tab = array();

$tpl_sidebars = array();

foreach($st_sidebars as $k=> $s){

    $tpl_sidebars[$s['id']] = $s['name'];

}



$general_tab_page = array(

        

        array(

            'name'=>'layout',

            'title'=>__('Default Layout','smooththemes'),

            'type' =>'layout',

            'multiple'=> false,

            'options'=>array(

              //  '4'=> ST_ADMIN_URL.'/images/layout/3.png',

                '3'=> ST_ADMIN_URL.'/images/layout/2.png',

                '2'=> ST_ADMIN_URL.'/images/layout/1.png',

                '1'=> ST_ADMIN_URL.'/images/layout/0.png',

            ),

            'default'=>'2',

            'desc'=>'',

            'desc_bottom'=>''

         )

          

);





$general_tab_logo = array(

    array(

        'name'        =>'site_logo',

        'title'       =>'Upload logo',

        'type'        =>'upload',

        'default'     =>st_img('logo.png'),

        'desc'        =>'',

        'desc_bottom' =>'Upload your custom logo.'

    )

);

$general_tab_favicon = array(

        array(

            'name'        =>'site_favicon',

            'title'       =>'Upload Favicon',

            'type'        =>'upload',

            'desc'        =>'',

            'desc_bottom' =>'Upload your custom favicon.'

        )

    );



$oe_social = array(

    array(

        'name'        =>'facebook',

        'title'       =>__('Facebook URL','smooththemes'),

        'type'        =>'text',

        'default'     =>'#',

        'desc'        =>'',

        'desc_bottom' =>'Enter your Facebook link'

     ),

    array(

        'name'        =>'twitter',

        'title'       =>'Twitter URL',

        'type'        =>'text',

        'default'     =>'#',

        'desc'        =>'',

        'desc_bottom' =>'Enter your Twitter link'

     ),

			

     array(

        'name'        =>'google_plus',

        'title'       =>'Google+ URL',

        'type'        =>'text',

        'default'     =>'#',

        'desc'        =>'',

        'desc_bottom' =>'Enter your Google+ link'

     ),

     

     array(

        'name'        =>'digg',

        'title'       =>'Digg URL',

        'type'        =>'text',

        'default'     =>'#',

        'desc'        =>'',

        'desc_bottom' =>'Enter your Digg link'

     ),

     array(

        'name'        =>'pinterest',

        'title'       =>'Pinterest URL',

        'type'        =>'text',

        'default'     =>'#',

        'desc'        =>'',

        'desc_bottom' =>'Enter your Pinterest link'

     ),
     

     array(

        'name'        =>'flickr',

        'title'       =>__('Flickr URL','smooththemes'),

        'type'        =>'text',

        'default'     =>'',

        'desc'        =>'',

        'desc_bottom' =>''

     )

     

);



$oe_single_post = array(

    

    array(

        'name'        =>'s_show_featured_img',

        'title'       =>__('Show Featured Image on single post','smooththemes'),

        'type'        =>'radio',

        'multiple'    => false,

        'options'     =>array('y'=>__('Yes'), 'n'=>__('No')),

        'default'     =>'y',

        'desc'        =>'',

        'desc_bottom' =>''

     ),



    array(

        'name'        =>'s_show_post_meta',

        'title'       =>__('Show post meta (author, date, categrories) on single post','smooththemes'),

        'type'        =>'radio',

        'multiple'    => false,

        'options'     =>array('y'=>__('Yes'), 'n'=>__('No')),

        'default'     =>'y',

        'desc'        =>'',

        'desc_bottom' =>''

     ),

     array(

        'name'        =>'s_show_post_tag',

        'title'       =>__('Show post tags on single post','smooththemes'),

        'type'        =>'radio',

        'multiple'    => false,

        'options'     =>array('y'=>__('Yes'), 'n'=>__('No')),

        'default'     =>'y',

        'desc'        =>'',

        'desc_bottom' =>''

     ),

	

	

	array(

			'name'        =>'enable_author_desc',

			'title'       =>__('Show Author descriptions','smooththemes'),

			'type'        =>'radio',

			'multiple'    => false,

			'options'     =>array('y'=>__('Yes'), 'n'=>__('No')),

			'default'     =>'y',

			'desc'        =>'',

			'desc_bottom' =>''

	),

		

     array(

        'name'        =>'s_show_comments',

        'title'       =>__('Show comments on single post','smooththemes'),

        'type'        =>'radio',

        'multiple'    => false,

        'options'     =>array('y'=>__('Yes'), 'n'=>__('No')),

        'default'     =>'y',

        'desc'        =>'',

        'desc_bottom' =>''

     )

		

		

		

);



$oe_footer_copyright = array(

    array(

        'name'        =>'footer_copyright',

        'title'       =>'Footer CopyRight Infomation',

        'type'        =>'textarea',

        'default'     =>'&copy; 2012. All Rights Reserved. Created with love by <a href="http://www.smooththemes.com">SmoothThemes.Com</a>',

        'desc'        =>'',

        'desc_bottom' =>''

    ), 

);





$global_skin_tab = array(

 

    /*

    array(

            'name'=>'predefined_colors',

            'title'=>__('Pre-Defined Skins','smooththemes'),

            'type' =>'layout',

            'multiple'=> false,

            'options'=>$predefined_colors,

            'size'=>30,

            'default'=>'fff200',

            'desc'=>'',

            'desc_bottom'=>''

         ),

    */

    array(

        'name'=>'select_theme_skin',

        'title'=>__('Dark or light skin','smooththemes'),

        'type' =>'radio',

        'multiple'=> false,

        'options'=>array('dark'=>__('Default - Dark'), 'light'=>__('Light')),

        'default'=>'dark',

        'desc'=>'Default skin is dark, select skin you want to apply',

        'desc_bottom'=>''

    ),


    array(

        'name'=>'enable_custom_global_skin',

        'title'=>__('Enable Custom Skin','smooththemes'),

        'type' =>'radio',

        'multiple'=> false,

        'options'=>array('y'=>__('Yes'), 'n'=>__('No')),

        'default'=>'n',

        'desc'=>'Select global skin color below, it will overwrite predefined color.',

        'desc_bottom'=>''

    ),
		
    array(

        'name'        =>'custom_global_skin',

        'title'       =>__('Custom Global Skin'),

        'type'        =>'color',

        'default'     =>'fff200',

        'desc'        =>'NOTE: It will overwrite predefined color. Default: <b>fff200</b>',

        'desc_bottom' =>''

    ),

		

		

	array(

		'title'       =>__('Boxed backgound','smooththemes'),

		'type'        =>'heading',

	),

		

	array(

			'name'        =>'container_bg',

			'title'       =>__('Container background color'),

			'type'        =>'color',

			'default'     =>'000000',

			'desc'        =>'Default: <b>000000</b>',

			'desc_bottom' =>''

	),

		

	array(

			'name'        =>'container_bg_opacity',

			'title'       =>__('Container background opacity'),

			'type'        =>'text',

			'default'     =>'0.5',

			'desc'        =>'Default: <b>0.5</b>, Min:0, Max: 1',

			'desc_bottom' =>''

	),

		

	array(

			'title'       =>__('Border and divider color','smooththemes'),

			'type'        =>'heading',

	),

		

		

	array(

			'name'        =>'border_color',

			'title'       =>__('Border and divider color'),

			'type'        =>'color',

			'default'     =>'343434',

			'desc'        =>'Default: <b>343434</b>',

			'desc_bottom' =>''

	),

		

	array(

			'title'       =>__('Gallery item','smooththemes'),

			'type'        =>'heading',

	),

	

	

	array(

			'name'        =>'gallery_item_hover_opacity',

			'title'       =>__('Gallery item overlay opacity'),

			'type'        =>'text',

			'default'     =>'0.6',

			'desc'        =>'Default: <b>0.6</b>, Min:0, Max: 1',

			'desc_bottom' =>''

	)

		

		

       

);







$header_bg_tab = array(

    

     array(

        'name'        =>'disable_header_custom',

        'title'       =>__('Disable custom header','smooththemes'),

        'type'        =>'radio',

        'options' => array(

                'y'=>__('Yes','smooththemes'),

                'n'=>__('No','smooththemes'),

        ),

        'default'     =>'n',

        'desc'        =>'',

        'desc_bottom' =>''

    ),





   array(

        'title'       =>__('Custom header Links','smooththemes'),

        'type'        =>'heading',

    ),



    array(

        'name'        =>'header_link_color',

        'title'       =>__('Link color','smooththemes'),

        'type'        =>'color',

        'default'     =>'202020',

        'desc'        =>'',

        'desc_bottom' =>''

    ),

    

    array(

        'name'        =>'header_link_hover_color',

        'title'       =>__('Link hover, active color','smooththemes'),

        'type'        =>'color',

        'default'     =>'80B500',

        'desc'        =>'',

        'desc_bottom' =>''

    ),





   array(

        'title'       =>__('Custom header Background','smooththemes'),

        'type'        =>'heading',

    ),

    

    array(

        'name'        =>'header_bg_color',

        'title'       =>__('Background color','smooththemes'),

        'type'        =>'color',

        'default'     =>'CCCCCC',

        'desc'        =>'NOTE: background style only apply when selected Boxed layout.',

        'desc_bottom' =>''

    ),

    

    array(

        'name'        =>'header_bg_img',

        'title'       =>__('Background image','smooththemes'),

        'type'        =>'upload',

        'default'     =>'',

        'desc'        =>'',

        'desc_bottom' =>''

    ),

    

     array(

        'name'        =>'header_bg_positon',

        'title'       =>__('Background positon'),

        'type'        =>'select',

        'options' => array(

                'tl'=>__('Top left','smooththemes'),

                'tc'=>__('Top center','smooththemes'),

                'tr'=>__('Top right','smooththemes'),

                'cc'=>__('Center','smooththemes'),

                'bl'=>__('Bottom left','smooththemes'),

                'br'=>__('Bottom right','smooththemes'),

                'bc'=>__('Bottom center','smooththemes'),

        ),

        'default'     =>'',

        'desc'        =>'',

        'desc_bottom' =>''

    ),

    

    array(

        'name'        =>'header_bg_repreat',

        'title'       =>__('Background repreat'),

        'type'        =>'select',

        'options' => array(

                'r'=>__('Repeat','smooththemes'),

                'n'=>__('No repeat','smooththemes'),

                'x'=>__('Repeat X','smooththemes'),

                'y'=>__('Repeat Y','smooththemes')

        ),

        'default'     =>'',

        'desc'        =>'',

        'desc_bottom' =>''

    )

    ,

    array(

        'name'        =>'header_bg_fixed',

        'title'       =>__('Background fixed'),

        'type'        =>'select',

        'options' => array(

                'n'=>__('No','smooththemes'),

                'y'=>__('Yes','smooththemes')

        ),

        'desc'        =>'',

        'desc_bottom' =>''

    ),



);







$bg_tab = array(



       array(

            'name'        =>'bg_type',
            
            'title'       =>__('Background Type'),
            
            'type'        =>'radio',
            
            'options' => array(
                    'default' => __('Default','smooththemes'),
                    
                    'd'       =>__('Defined background image','smooththemes'),
                    
                    'c'       =>__('Defined background color','smooththemes'),
                    
                    'custom'  =>__('Custom','smooththemes'),
                    
                    ),
            
            'default'     =>'default',
            
            'desc'        =>'',
            
            'desc_bottom' =>''

        ),



     array(

            'name'=>'defined_bg',

            'title'=>__('Defined background Image','smooththemes'),

            'type' =>'layout',

            'multiple'=> false,

            'options'=>array(

                'pattern1.png'=> ST_THEME_URL.'assets/images/patterns/pattern1.png',

                'pattern2.png'=> ST_THEME_URL.'assets/images/patterns/pattern2.png',

                'pattern3.png'=> ST_THEME_URL.'assets/images/patterns/pattern3.png',

                'pattern4.png'=> ST_THEME_URL.'assets/images/patterns/pattern4.png',

                'pattern5.png'=> ST_THEME_URL.'assets/images/patterns/pattern5.png',

                'pattern6.png'=> ST_THEME_URL.'assets/images/patterns/pattern6.png',

                'pattern7.png'=> ST_THEME_URL.'assets/images/patterns/pattern7.png',

            ),

            'size'=>30,

            'default'=>'background1.jpg',

            'desc'=>'',

            'desc_bottom'=>''

         ),

         

         

          array(

            'name'=>'defined_bg_color',

            'title'=>__('Defined background color','smooththemes'),

            'type' =>'layout',

            'multiple'=> false,

            'options'=>array(

                '37b6bd'=> ST_THEME_URL.'assets/images/colors/37b6bd.png',

                'c71c77'=> ST_THEME_URL.'assets/images/colors/c71c77.png',

                'f0f0f0'=> ST_THEME_URL.'assets/images/colors/f0f0f0.png',

                'ffb400'=> ST_THEME_URL.'assets/images/colors/ffb400.png'

            ),

            'size'=>30,

            'default'=>'background1.jpg',

            'desc'=>'',

            'desc_bottom'=>''

         ),

   



  array(

        'title'       =>__('Custom Background','smooththemes'),

        'type'        =>'heading',

    ),

    

    array(

        'name'        =>'bg_color',

        'title'       =>__('Background color','smooththemes'),

        'type'        =>'color',

        'default'     =>'CCCCCC',

        'desc'        =>'NOTE: background style only apply when selected Boxed layout. Default: <b>5A5A5A</b>',

        'desc_bottom' =>''

    ),

    

    array(

        'name'        =>'bg_img',

        'title'       =>__('Background image','smooththemes'),

        'type'        =>'upload',

        'default'     =>'',

        'desc'        =>'',

        'desc_bottom' =>''

    ),

    

     array(

        'name'        =>'bg_positon',

        'title'       =>__('Background positon'),

        'type'        =>'select',

        'options' => array(

                'tl'=>__('Top left','smooththemes'),

                'tc'=>__('Top center','smooththemes'),

                'tr'=>__('Top right','smooththemes'),

                'cc'=>__('Center','smooththemes'),

                'bl'=>__('Bottom left','smooththemes'),

                'br'=>__('Bottom right','smooththemes'),

                'bc'=>__('Bottom center','smooththemes'),

        ),

        'default'     =>'',

        'desc'        =>'',

        'desc_bottom' =>''

    ),

    

    array(

        'name'        =>'bg_repreat',

        'title'       =>__('Background repreat'),

        'type'        =>'select',

        'options' => array(

                'r'=>__('Repeat','smooththemes'),

                'n'=>__('No repeat','smooththemes'),

                'x'=>__('Repeat X','smooththemes'),

                'y'=>__('Repeat Y','smooththemes')

        ),

        'default'     =>'',

        'desc'        =>'',

        'desc_bottom' =>''

    )

    ,

    array(

        'name'        =>'bg_fixed',

        'title'       =>__('Background fixed'),

        'type'        =>'select',

        'options' => array(

                'n'=>__('No','smooththemes'),

                'y'=>__('Yes','smooththemes')

        ),

        'desc'        =>'',

        'desc_bottom' =>''

    ),



);









$tab_flexslider = array(

  array(

        'type'=>'heading',

        'title'=>__('Flex Slider settings','smooththemes'),

     ),

//animation

    array(

        'name'=>'flex_animation',

        'type'=>'radio',

        'title'=>__('Animation','smooththemes'),

        'options'=>array('fade'=>__('fade'),'slide'=>__('slide')),

        'default'=>'fade'

     ),

     array(

            'name'=>'flex_directionNav',

            'type'=>'radio',

            'title'=>__('directionNav','smooththemes'),

            'options'=>array('y'=>__('Yes'),'n'=>__('No')),

            'default'=>'y',

            'desc'=>'Next & Prev navigation'

        ),

     array(

        'name'=>'flex_animationLoop',

        'type'=>'radio',

        'title'=>__('Should the animation loop?','smooththemes'),

        'options'=>array('y'=>__('Yes'),'n'=>__('No')),

        'default'=>'y'

     ),

      array(

        'name'=>'flex_slideshow',

        'type'=>'radio',

        'title'=>__('Animate slider automatically','smooththemes'),

        'options'=>array('y'=>__('Yes'),'n'=>__('No')),

        'default'=>'y'

     ),

     array(

        'name'=>'flex_slideshowSpeed',

        'type'=>'text',

        'title'=>__('Slideshow Speed','smooththemes'),

        'default'=>'7000',

        'desc_bottom'=>__('Set the speed of the slideshow cycling, in milliseconds, default: 7000','smooththemes')

     ),

     array(

        'name'=>'flex_animationSpeed',

        'type'=>'text',

        'title'=>__('Animation Speed','smooththemes'),

        'default'=>'600',

        'desc_bottom'=>__('Set the speed of animations, in milliseconds, default: 600','smooththemes')

     ),

     array(

        'name'=>'flex_pauseOnAction',

        'type'=>'radio',

        'title'=>__('Pause On Action','smooththemes'),

        'options'=>array('true'=>__('Yes'),'false'=>__('No')),

        'default'=>'y'

     ),

     array(

        'name'=>'flex_pauseOnHover',

        'type'=>'radio',

        'title'=>__('Pause On Hover','smooththemes'),

        'options'=>array('y'=>__('Yes'),'n'=>__('No')),

        'default'=>'y'

     ),

     array(

        'name'=>'flex_controlNav',

        'type'=>'radio',

        'title'=>__('Create navigation for paging control of each clide','smooththemes'),

        'options'=>array('y'=>__('Yes'),'n'=>__('No')),

        'default'=>'y'

     ),

      array(

        'name'=>'flex_randomize',

        'type'=>'radio',

        'title'=>__('Randomize slide order','smooththemes'),

        'options'=>array('y'=>__('Yes'),'n'=>__('No')),

        'default'=>'n'

     )

);





$tab_fixed_height = array(

  array(

        'type'=>'heading',

        'title'=>__('Fixed Height Settings','smooththemes'),

     ),

     array(

        'name'=>'fixed_slideshowSpeed',

        'type'=>'text',

        'title'=>__('Slideshow Speed','smooththemes'),

        'default'=>'7000',

        'desc_bottom'=>__('Set the speed of the slideshow cycling, in milliseconds, default: 7000','smooththemes')

     ),

     array(

        'name'=>'fixed_animationSpeed',

        'type'=>'text',

        'title'=>__('Animation Speed','smooththemes'),

        'default'=>'600',

        'desc_bottom'=>__('Set the speed of animations, in milliseconds, default: 600','smooththemes')

     )

);







// Font Style Tabs



$font_body = array(



    array(

        'name'        =>'body_font',

        'title'       =>__('Body Font','smooththemes'),

        'type'        =>'style',

        'function'  =>'st_settings_fonts',

        'default'     =>'',

        'previetxt'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. 

                        Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,

                        when an unknown printer took a galley of type and scrambled it to make a type specimen book. 

                        It has survived not only five centuries, but also the leap into electronic typesetting,

                        remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset 

                        sheets containing Lorem Ipsum passages,

                        and more recently with desktop publishing software like Aldus PageMaker 

                        including versions of Lorem Ipsum.',

        'options'=>array(

                'font-family'=>'Droid Sans',

                'color'=>'000000',

                'font-weight' =>'normal',

                'font-style'=>'nomal',

                'line-height'=>'18', // unit px

                'line-height-unit'=>'px',

                'font-size'=>'12',

                'font-size-unit'=>'px',

                'letter-spacing'=>'0',

                'letter-spacing-uni'=>'px'

            ),

        'desc'        =>__('','smooththemes'),

        'desc_bottom' =>''

    ),

    

);



$font_heading = array(



    array(

        'name'        =>'headings_font',

        'title'       =>__('Heading Font','smooththemes'),

        'type'        =>'style',

        'function'  =>'st_settings_fonts',

        'default'     =>'',

        'previetxt'=>'<div style="font-size: 18px; line-height: 30px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry. 

                        Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,

                        when an unknown printer took a galley of type and scrambled it to make a type specimen book. 

                        It has survived not only five centuries, but also the leap into electronic typesetting,

                        remaining essentially unchanged.</div>',

        'options'=>array(

                'font-family'=>'Droid Sans'

            ),

         'support'=>array('font_family'),

        'desc'        =>'',

        'desc_bottom' =>''

    ),



    array(

        'name'        =>'heading_1',

        'title'       =>__('H1','smooththemes'),

        'type'        =>'style',

        'function'  =>'st_settings_fonts',

        'default'     =>'',

        'previetxt'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',

        'support'=>array('font_size'),

        'options'=>array(

                'font-size'=>'34'

            ),

        'desc_bottom' =>''

    ),

    

    array(

        'name'        =>'heading_2',

        'title'       =>__('H2','smooththemes'),

        'type'        =>'style',

        'function'  =>'st_settings_fonts',

        'default'     =>'',

        'previetxt'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',

        

         'support'=>array('font_size'),

        'options'=>array(

                'font-size'=>'34'

            ),

        'desc_bottom' =>''

    ),

    

    array(

        'name'        =>'heading_3',

        'title'       =>__('H3','smooththemes'),

        'type'        =>'style',

        'function'  =>'st_settings_fonts',

        'default'     =>'',

        'previetxt'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',

        

         'support'=>array('font_size'),

         'options'=>array(

                'font-size'=>'34'

            ),

        'desc_bottom' =>''

    ),

    

    array(

        'name'        =>'heading_4',

        'title'       =>__('H4','smooththemes'),

        'type'        =>'style',

        'function'  =>'st_settings_fonts',

        'default'     =>'',

        'previetxt'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',

         'support'=>array('font_size'),

         'options'=>array(

                'font-size'=>'34'

            ),

        'desc_bottom' =>''

    ),

    

    array(

        'name'        =>'heading_5',

        'title'       =>__('H5','smooththemes'),

        'type'        =>'style',

        'function'  =>'st_settings_fonts',

        'default'     =>'',

        'previetxt'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',

        

         'support'=>array('font_size'),

         'options'=>array(

                'font-size'=>'34'

            ),

        'desc_bottom' =>''

    ),

    

    array(

        'name'        =>'heading_6',

        'title'       =>__('H6','smooththemes'),

        'type'        =>'style',

        'function'  =>'st_settings_fonts',

        'default'     =>'',

        'previetxt'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',

         'support'=>array('font_size'),

         'options'=>array(

                'font-size'=>'34'

            ),

        'desc_bottom' =>''

    ),



);







$sidebar_tab = array(

    array(

        'name'        =>'sidebars',

        'title'       =>'Sidebars',

        'type'        =>'ui',

        'default'     =>'',

        'support'    =>array('title','id'),

        'desc'        =>'',

        'desc_bottom' =>'Create custom sidebar.'

     )

);





global $st_hooks;



$ads_tab = array(

    array(

        'name'        =>'ads',

        'title'       =>'Site Ads Management',

        'type'        =>'ui',

        'default'     =>'',

        'support'    =>array('title','content','hook'),

        'hooks'=>$st_hooks,

        'desc'        =>'',

        'desc_bottom' =>''

     )

);







$tracking_code= array(

    array(

        'name'=>'headder_tracking_code',

        'type'=>'textarea',

        'title'=>__('Header tracking code','smooththemes'),

        'default'=>''

     ),

     array(

        'name'=>'footer_tracking_code',

        'type'=>'textarea',

        'title'=>__('Footer tracking code','smooththemes'),

        'default'=>''

     ),

);







$blog_tab =  array(

		

		array(

				'name'=>'blog_toptitle',

				'type'=>'text',

				'title'=>__('Blog title','smooththemes'),

				'default'=>''

		)

		

);







$tab_sceen_slider = array(

		array(

				'type'=>'heading',

				'title'=>__('Full Screen Slider settings','smooththemes'),

		),

		array(

				'name'=>'fsc_autoplay',

				'type'=>'radio',

				'title'=>__('Should the animation loop?','smooththemes'),

				'options'=>array('y'=>__('Yes'),'n'=>__('No')),

				'default'=>'y'

		),

		array(

				'name'=>'fsc_slideshow',

				'type'=>'radio',

				'title'=>__('Slideshow on/off','smooththemes'),

				'options'=>array('y'=>__('On'),'n'=>__('Off')),

				'default'=>'y'

		),

		array(

				'name'=>'fsc_interval',

				'type'=>'text',

				'title'=>__('Slideshow Speed','smooththemes'),

				'default'=>'6000',

				'desc_bottom'=>__('Length between transitions, default: 6000','smooththemes')

		),

		 

		array(

				'name'=>'fsc_transition_speed',

				'type'=>'text',

				'title'=>__('Speed of transition','smooththemes'),

				'default'=>'800',

				'desc_bottom'=>__('Speed of transition, default: 800','smooththemes')

		)

		 

		 



);





$tab_gimage_flow = array(

		array(

				'type'=>'heading',

				'title'=>__('Gallery Image Flow settings','smooththemes'),

		),

		array(

				'name'=>'gif_horizon',

				'type'=>'text',

				'title'=>__('Active image size','smooththemes'),

				'default'=>'0.6',

				'desc_bottom'=>__('Min: 0, max: 1, default: 0.6','smooththemes')

		),

        array(

				'name'=>'gif_size',

				'type'=>'text',

				'title'=>__('Item size','smooththemes'),

				'default'=>'0.2',

				'desc_bottom'=>__('Min: 0, max: 1, default: 0.2','smooththemes')

		),

        array(

				'name'=>'gif_border',

				'type'=>'text',

				'title'=>__('Item margin','smooththemes'),

				'default'=>'0',

				'desc_bottom'=>__('Min: 0, default: 0','smooththemes')

		)	



);





$tab_gkenburns = array(

		array(

				'type'=>'heading',

				'title'=>__('Gallery Kenburns','smooththemes'),

		),

		array(

				'name'=>'gkb_frames_per_second',

				'type'=>'text',

				'title'=>__('frames per second','smooththemes'),

				'default'=>'30',

				'desc_bottom'=>__('Start 0, default: 30','smooththemes')

		),

        array(

				'name'=>'gkb_display_time',

				'type'=>'text',

				'title'=>__('display time','smooththemes'),

				'default'=>'5000',

				'desc_bottom'=>__('Start 0, default: 5000','smooththemes')

		),

        array(

				'name'=>'gkb_fade_time',

				'type'=>'text',

				'title'=>__('fade time','smooththemes'),

				'default'=>'1000',

				'desc_bottom'=>__('Start 0, default: 1000','smooththemes')

		),

        array(

				'name'=>'gkb_zoom',

				'type'=>'text',

				'title'=>__('zoom','smooththemes'),

				'default'=>'1.2',

				'desc_bottom'=>__('Start 0, default: 1.2','smooththemes')

		)



);





$tab_gflip = array(

		array(

				'type'=>'heading',

				'title'=>__('Gallery Flip','smooththemes'),

		),

        array(

            'name'=>'gflip_directionnav',

            'type'=>'radio',

            'title'=>__('directionNav','smooththemes'),

            'options'=>array('y'=>__('Yes'),'n'=>__('No')),

            'default'=>'y',

            'desc'=>'Next & Prev navigation'

        ),

        array(
            'name'=>'gflip_thumbnail',
            'type'=>'radio',
            'title'=>__('Show Thumbnail','smooththemes'),
            'options'=>array('y'=>__('Yes'),'n'=>__('No')),
            'default'=>'y',
            'desc'=>''
        ),
);

$envato = array(
    array(
        'name' => 'tf_username',
        'type' => 'text',
        'title' => __('Envato Username', 'smooththemes'),
        'default' => ''
    ),
    array(
        'name' => 'tf_api',
        'type' => 'text',
        'title' => __('Envato API Key', 'smooththemes'),
        'default' => ''
    ),
);



// ========================== Setup Load Panel ========================== \\



$tabs_settings =  new Smooththemes_tabs_settings();



// General Setting

$tabs_settings->add_tab('general',__('General Setings','smooththemes'),$general_tab,'icon-cog');

    $tabs_settings->add_tab('general_page',__('Page Settings','smooththemes'),$general_tab_page,'icon-caret-right','general');

    $tabs_settings->add_tab('general_logo',__('Logo','smooththemes'),$general_tab_logo,'icon-caret-right','general');

    $tabs_settings->add_tab('general_favicon',__('Favicon','smooththemes'),$general_tab_favicon,'icon-caret-right','general');

    $tabs_settings->add_tab('general_sidebar',__('Custom Sidebars','smooththemes'),$sidebar_tab,'icon-caret-right','general');

// Font Style Setting

$tabs_settings->add_tab('fonts',__('Font Style','smooththemes'),'','icon-font');

    $tabs_settings->add_tab('fonts_body',__('Body Font','smooththemes'),$font_body,'icon-caret-right','fonts');

    $tabs_settings->add_tab('fonts_heading',__('Heading Font','smooththemes'),$font_heading,'icon-caret-right','fonts');



// Color Setting

$tabs_settings->add_tab('elements_color',__('Elements Color','smooththemes'),'','icon-magic');
    $tabs_settings->add_tab('body_predefined_colors',__('Global Skin','smooththemes'),$global_skin_tab,'icon-caret-right','elements_color');
    $tabs_settings->add_tab('body_bg',__('Body Background','smooththemes'),$bg_tab,'icon-caret-right','elements_color');
    $tabs_settings->add_tab('head_bg',__('Header','smooththemes'),$header_bg_tab,'icon-caret-right','elements_color');

// Overall Elements

$tabs_settings->add_tab('overall_elements',__('Overall Elements','smooththemes'),'','icon-cogs');
    $tabs_settings->add_tab('blog_post',__('Blog posts','smooththemes'),$blog_tab,'icon-caret-right','overall_elements'); 

    $tabs_settings->add_tab('single_setting',__('Single Post Elements','smooththemes'),$oe_single_post,'icon-caret-right','overall_elements');

    $tabs_settings->add_tab('social',__('Social','smooththemes'),$oe_social,'icon-caret-right','overall_elements');

    $tabs_settings->add_tab('footer_copyright',__('Footer Copyright','smooththemes'),$oe_footer_copyright,'icon-caret-right','overall_elements');

    



// Slider Setting

$tabs_settings->add_tab('slider',__('Sliders','smooththemes'),array(),'icon-exchange');

    $tabs_settings->add_tab('flexslider',__('FlexSlider','smooththemes'),$tab_flexslider,'icon-caret-right','slider');

    $tabs_settings->add_tab('fixed_height',__('Fixed Height','smooththemes'),$tab_fixed_height,'icon-caret-right','slider');

    $tabs_settings->add_tab('sceen_slider',__('Full Screen','smooththemes'),$tab_sceen_slider,'icon-caret-right','slider');

    $tabs_settings->add_tab('gallery_image_flow',__('Gallery Image Flow','smooththemes'),$tab_gimage_flow,'icon-caret-right','slider');

    $tabs_settings->add_tab('gallery_kenburns',__('Gallery Kenburns','smooththemes'),$tab_gkenburns,'icon-caret-right','slider');

    $tabs_settings->add_tab('gallery_flip',__('Gallery Flip','smooththemes'),$tab_gflip,'icon-caret-right','slider');

   



// Ads Management

//$tabs_settings->add_tab('ads',__('Ads Management','smooththemes'),array(),'icon-cogs');

  //  $tabs_settings->add_tab('ads_manage',__('Ads Management','smooththemes'),$ads_tab,'icon-caret-right','ads');

$tabs_settings->add_tab('st_envato', __('Auto update', 'smooththemes'), $envato, 'icon-cogs');

// for header and footer code

$tabs_settings->add_tab('tracking_code',__('Tracking code','smooththemes'),$tracking_code,'icon-cogs');

function st_build_google_font_options_url($font){

     if(empty($font['family']) || $font['family']=='' ){

                continue;

     }


     $variants = '';

     if(isset($font['variants']) && count($font['variants'])){

          $variants =  join(',',$font['variants']);

     }

     $subsets= '';

     if(isset($font['subsets'])&& count($font['subsets'])){

        $subsets = join(',',$font['subsets']);

     }


    $url = 'http://fonts.googleapis.com/css?family='.urlencode($font['family']); 

    if($variants!=''){

        $url.=':'.urlencode($variants);

    }

    if($subsets!=''){

          $url  .= '&subset='.urlencode($subsets);

    }



    return $url;

}







// Load Google Webfonts

function st_google_font_to_options(){

     if(!function_exists('st_get_google_fonts_array')){

        if(is_file(dirname(__FILE__).'/google-fonts.php')){

             include(dirname(__FILE__).'/google-fonts.php');

        } 

    }

    

     if(!function_exists('st_get_google_fonts_array')){ 

       

            return array();

      }

      $google_fonts = st_get_google_fonts_array();

      

     // echo count($google_fonts);

      $font_options = array();

      foreach($google_fonts as $k=> $font){

            if(empty($font['family']) || $font['family']=='' ){

                continue;

            }

            

            $font_options[$font['family']] = st_build_google_font_options_url($font);

      }

      return $font_options;

    

}











