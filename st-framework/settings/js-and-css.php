<?php

function st_js_encode_object($l10n){
	foreach ( (array) $l10n as $key => $value ) {
		if ( !is_scalar($value) )
			continue;

		$l10n[$key] = html_entity_decode( (string) $value, ENT_QUOTES, 'UTF-8');

	}

	return  $l10n;

}

function  st_js_object_var($object_name,$l10n = array()){

	return  " var $object_name = " . json_encode($l10n) . '; ';

}


function st_data_type($var,$type='string'){

	switch(strtolower($type)){

		case 'bool': case 'boolean':

			$var = strtolower($var);

			if($var=='n' || $var == '' || $var ===0 || $var==false || $var=='false'){

				return false ;

			}else{

				return true;

			}

			break;

		case 'float':

			return floatval($var);

			break;

		case  'array_join':

			return join(',',$var);

			break;

		case 'int':

			return intval($var);

			break;

		default:

			return $var;

	}

	$var;

}



function st_flex_js_settings(){

	$settings =  array(
			'animation'=>'string',
			'animationLoop'=>'bool',
			'animationDuration'=>'int',
			'slideshow'=>'bool',
			'slideshowSpeed'=>'int',
			'animationSpeed'=>'int',
			'pauseOnAction'=>'bool',
			'pauseOnHover'=>'bool',
			'controlNav'=>'bool',
			'randomize'=>'bool',
			'directionNav'=>'bool'

	);

	$js_options = array();
	foreach($settings as $name => $type){
		$v = st_get_setting('flex_'.$name,'');
		if(isset($v) && !empty($v)){
			$js_options[$name] =  st_data_type($v,$type);
		}

	}
	return $js_options;

}



function st_fixed_height_js_settings(){
	$settings =  array(
			'slideshowSpeed'=>'int',
			'animationSpeed'=>'int'
	);

	$js_options = array();
	foreach($settings as $name => $type){
		$v = st_get_setting('fixed_'.$name,'');
		if(isset($v) && !empty($v)){
			$js_options[$name] =  st_data_type($v,$type);
		}
	}
	return $js_options;

}



function st_image_flow_js_settings(){

	$settings =  array(
			'horizon'=>'float',
			'size'=>'float',
			'border'=>'float'
	);

	$js_options = array();

	foreach($settings as $name => $type){
		$v = st_get_setting('gif_'.$name,'0');

		if(isset($v)){
			$js_options[$name] =  st_data_type($v,$type);

		}
	}

	return $js_options;

}





function st_kenburns_js_settings(){

	$settings =  array(
			'frames_per_second'=>'float',
			'display_time'=>'float',
			'fade_time'=>'float',
			'zoom'=>'float'
	);

	$js_options = array();

	foreach($settings as $name => $type){
		$v = st_get_setting('gkb_'.$name,'0');
		if(isset($v)){
			$js_options[$name] =  st_data_type($v,$type);
		}
	}
	return $js_options;
}



function st_flip_js_settings(){

	$settings =  array(
			'directionnav'=>'bool',
			'thumbnail'=>'bool'
	);
	$js_options = array();
	foreach($settings as $name => $type){
		$v = st_get_setting('gflip_'.$name,'0');
		if(isset($v)){
			$js_options[$name] =  st_data_type($v,$type);
		}
	}

	return $js_options;

}


#-----------------------------------------------------------------
# Enqueue Style
#-----------------------------------------------------------------

if( !function_exists('st_enqueue_styles')){

	function st_enqueue_styles(){

		if(!is_admin()){

			//Register styles

			wp_enqueue_style('font-awesome',st_css('font-awesome/css/font-awesome.min.css'));
			wp_enqueue_style('st_style', get_bloginfo( 'stylesheet_url' ),false, ST_VERSION );
			wp_enqueue_style('flexslider', st_css('flexslider.css'),false);
			wp_enqueue_style('magnific-popup',st_css('magnific-popup.css'));
			wp_enqueue_style('icons',st_css('icons.css'));
            /* Gallery Slider */
            wp_enqueue_style('gallery-flip', st_css('gallery-flip.css'),false);
            wp_enqueue_style('image-flow', st_css('image-flow.css'),false);


            /* Fix Responsive */
            wp_enqueue_style('responsive',st_css('responsive.css'));
            if(st_get_setting('select_theme_skin') == 'light'){
            	wp_enqueue_style('light-skin', st_css('light.css'),false);
            }
		}

	}

}

add_action('wp_print_styles','st_enqueue_styles');
#-----------------------------------------------------------------
# Enqueue Scripts
#-----------------------------------------------------------------

if(!function_exists('st_enqueue_scripts')){

	function st_enqueue_scripts(){

		if(!is_admin()){

			wp_enqueue_script('modernizr',st_js('modernizr.js'));
			wp_enqueue_script('jquery',st_js('jquery.js'));
            wp_enqueue_script('st-loading', st_js('loading.js'), array('jquery'),'1.1');

            wp_enqueue_script('jquery.touchwipe.min', st_js('jquery.touchwipe.min.js'), array('jquery'),ST_VERSION,true);
            wp_enqueue_script('jquery.mousewheel.min', st_js('jquery.mousewheel.min.js'), array('jquery'),ST_VERSION,true);
			wp_enqueue_script('jquery.easing', st_js('jquery.easing.min.js'), array('jquery'),'1.3' , true );
			wp_enqueue_script('ddsmoothmenu',st_js('ddsmoothmenu.js'), array('jquery'),'1.6', true);
            wp_enqueue_script( 'imagesLoaded', st_js('imagesLoaded.js'), array('jquery'),ST_VERSION, true);
            wp_enqueue_script( 'jquery.isotope', st_js('jquery.isotope.min.js'), array('jquery'),ST_VERSION, true);
            wp_enqueue_script('jquery.magnific-popup', st_js('jquery.magnific-popup.min.js'), array('jquery'),ST_VERSION, true);
            wp_enqueue_script('jquery.flexslider', st_js('jquery.flexslider.js'), array('jquery'),ST_VERSION, true);
            wp_enqueue_script('jquery.fitvids', st_js('jquery.fitvids.js'), array('jquery'),ST_VERSION, true);
            wp_enqueue_script( 'black-and-white', st_js('jquery.black-and-white.js'), array('jquery'),ST_VERSION, true);

            wp_enqueue_script('sly', st_js('sly.js'), array('jquery'),ST_VERSION, true);

            wp_enqueue_script('supersized', st_js('supersized.3.2.6.min.js'), array('jquery'),'3.2.6', true);
            wp_enqueue_script('supersized.shutter', st_js('supersized.shutter.min.js'), array('jquery'),ST_VERSION, true);

            // This slider called only in page template tpl-fullscreen.php
            if(is_page_template('tpl-fullscreen.php')){

                /* Gallery Image Flow */
                wp_enqueue_script('image-flow', st_js('image-flow.js'), array('jquery'),ST_VERSION,true);

                /* Gallery Ken Burns Effect */
                wp_enqueue_script('kenburns', st_js('kenburns.js'), array('jquery'),ST_VERSION,true);

                /* Gallery Flip */
                wp_enqueue_script('jquery.flip.min', st_js('jquery.flip.min.js'), array('jquery'),ST_VERSION,true);
                wp_enqueue_script('st.jquery.flip', st_js('st.jquery.flip.js'), array('jquery'),ST_VERSION,true);

            }




			wp_enqueue_script('st_custom', st_js('exposed.js'), array('jquery'),ST_VERSION, true);
			if ( is_singular() && get_option( 'thread_comments' ) ){
				wp_enqueue_script( 'comment-reply' );
			}

			wp_localize_script('st_custom', 'FS', st_flex_js_settings());
			wp_localize_script('st_custom','ST',array('disable_header_floating'=>st_get_setting("disable_header_floating",'n')));
			wp_localize_script('st_custom','ajaxurl',admin_url('admin-ajax.php'));
		}
	}

}

add_action('wp_print_scripts','st_enqueue_scripts');

function st_user_custom_style(){
?>
<!--[if IE 8]><link href="<?php st_css('ie8.css',true); ?>" rel="stylesheet" type="text/css" /><![endif]-->
<link href="<?php echo ST_THEME_URL .'custom.css'; ?>" rel="stylesheet" type="text/css" />
<?php
}

add_action('wp_head','st_user_custom_style',50);

