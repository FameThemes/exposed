<?php

/* remove default admin toool bar bump */

function  st_admin_bar_bump_cb()
{

}

add_theme_support('admin-bar', array('callback' => 'st_admin_bar_bump_cb'));


function st_get_tpl_file_name()
{
    $default = 'list-post';
    $file = 'list-post';
    if (is_singular()) {
        global $post;
        if ($post->post_type != 'page' && $post->post_type != 'post') {
            $file = $post->post_type;
            if (!file_exists(ST_TEMPLATE_DIR . $file . '.php')) {
                $file = 'single';
            }
        } else {
            if (is_page()) {
                $file = 'page';
            } else {
                $file = 'single';
            }
        }
    } elseif (is_author()) {
        $file = 'author';
    } elseif (is_tag()) {
        $file = 'tag';
    } elseif (is_tax()) {
        $tax = get_queried_object();
        $file = 'taxonomy-' . $tax->taxonomy;
        if (file_exists(ST_TEMPLATE_DIR . $file . '.php')) {
            return $file;
        } else {
            return 'taxonomy';
        }

    } elseif ((is_archive() || is_day() || is_date() || is_month() || is_year() || is_time()) && !is_category()) {
        $file = 'archive';
    } elseif (is_search()) {
        $file = 'search';
    } elseif (is_404()) {
        $file = '404';
    }

    if (file_exists(ST_TEMPLATE_DIR . $file . '.php')) {
        return $file;
    } else {
        return $default;
    }

}

function st_subscribe_form()
{

    if (st_get_setting('show_subcribe', 'y') != 'n' && st_get_setting("feedburner_urli") != '') {

        $file = ST_TEMPLATE_DIR . 'forms/subscribe-form.php';

        if (file_exists($file)) {

            include($file);

        }

    }


}


/**
 * hook : st_page_title_tempalte

 */

add_action('st_bottom_main_wrapper', 'st_subscribe_form', 10);

/**
 * Include current template for  layout
 */

function st_page_template()
{
    $default = 'list-post';
    // for title
    $file = $GLOBALS['st_template_file_name'];
    // for main content
    if (file_exists(ST_TEMPLATE_DIR . $file . '.php')) {
        include(ST_TEMPLATE_DIR . $file . '.php');
    } else {
        include(ST_TEMPLATE_DIR . $default . '.php');
    }
}

/**
 * hook : st_page_template
 */
add_action('st_page_template', 'st_page_template');

/**
 * display sidebar depend each page
 */

function st_sidebar($sidebar = '', $positon = 'right')
{

    $sidebar;
    $afterfix = '_r';
    if (strtolower($positon) == 'left') {
        $afterfix = '_l';
    }


    if (empty($sidebar)) {
        if (is_category()) {
            $sidebar = st_get_setting("sidebar_category" . $afterfix, 'sidebar_default' . $afterfix);
        } elseif (is_search()) {
            $sidebar = st_get_setting("sidebar_search" . $afterfix, 'sidebar_default' . $afterfix);
        }
    }

    if (empty($sidebar) || $sidebar == '') {
        $sidebar = 'sidebar_default' . $afterfix;
    }

    do_action('st_before_sidebar' . $afterfix, $sidebar);
    dynamic_sidebar($sidebar);
    do_action('st_atter_sidebar' . $afterfix, $sidebar);
}

/**
 * hook st_sidebar
 */

add_action('st_sidebar', 'st_sidebar', 10, 2);

function st_page_tile_template()
{
    $file = 'page-title';
    if (file_exists(ST_TEMPLATE_DIR . $file . '.php')) {
        include(ST_TEMPLATE_DIR . $file . '.php');
    }
}


/**
 * hook st_before_layout
 */

add_action('st_before_layout', 'st_page_tile_template', 10, 2);

/**
 * Return laoyout file by number
 */
function st_get_layout($number = -1)
{

    if ($number < 1) {
        if (is_singular()) {
            global $post;
            $st_page_builder = get_page_builder_options($post->ID);
            $layout = (isset($st_page_builder['layout'])) ? intval($st_page_builder['layout']) : 0;
            if (in_array($layout, array(1, 2, 3, 4))) {
                $number = $layout;
            }

        } elseif (is_tax()) { // for default layout in admin page
            $tax = get_queried_object();
            $number = intval(st_get_setting("{$tax->taxonomy}_layout", 0));
        }


        if ($number <= 0) {
            $number = intval(st_get_setting("layout", 2));
        }
    } // end if number 


    switch (intval($number)) {
        case  4 :
            $l = 'layout-left-right-sidebar';
            break;
        case  3 :
            $l = 'layout-left-sidebar';
            break;
        case  2 :
            $l = 'layout-right-sidebar';
            break;
        case  1 :
            $l = 'layout-no-sidebar';
            break;
        default :
            $l = 'layout-right-sidebar';
    }
    return apply_filters('st_get_layout', $l, $number);
}

// this is call back for comments

function st_comments($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment; ?>
    <li <?php comment_class('comment'); ?> id="li-comment-<?php comment_ID() ?>">
    <div id="" class="comment-item">
        <?php echo get_avatar($comment->comment_author_email, $size = '60', $default = ''); ?>
        <div class="comment-content-wrapper">
            <div class="comment-meta">
                <a href="#" class="comment-author"><b class="author_name"><?php echo get_comment_author_link(); ?></b> </a>
                <span class="comment-date"><?php echo get_comment_date(); ?></span>
                <?php edit_comment_link(__('(Edit)','smooththemes'), '  ', '') ?>
                -
                <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
            </div>
            <div class="comment-content">
                <?php comment_text() ?>
                <?php if ($comment->comment_approved == '0') : ?>
                    <br/> <em><?php _e('Your comment is awaiting moderation.', 'smooththemes') ?></em>
                <?php endif; ?>
            </div>
        </div>
        <div class="clear"></div>
    </div>
<?php
}

/**
 * parse Font
 * @return array
 */

function st_parse_font($font_url)
{
    $font_url = urldecode($font_url);
    $args = parse_url($font_url);
    $return = array('is_g_font' => false, 'name' => $font_url, 'link' => '');
    $args = wp_parse_args($args, array(
        'host' => '',
        'query' => ''
    ));

    $font_data = wp_parse_args($args['query'], array('family' => '', 'subset' => ''));
    if ($args['host'] == 'fonts.googleapis.com' && $font_data['family'] != '') {
        //  echo var_dump($args) ; die();
        if (strpos($font_data['family'], ':') !== false) {
            $font_data['family'] = explode(':', $font_data['family']);
            $font_data['family'] = (isset($font_data['family'][0]) && $font_data['family'][0] != '') ? $font_data['family'][0] : '';
        } else {

        }


        if ($font_data['family'] != '') {
            $return['name'] = $font_data['family'];
            $return['is_g_font'] = true;
            $return['link'] = $font_url;
        }
    }

    return $return;
}

/**
 * make font style
 * Only use for header.php file
 */

function st_make_font_style($font, $css_selector, $show_font_size = true)
{
    if ($font['font-family'] != '') {
        $font_data = st_parse_font($font['font-family']);
        //$is_not_gfont = key_exists($font['font-family'],st_get_normal_fonts());
        ?>
        <?php if ($font_data['is_g_font'] == true) : ?>
            <link href='<?php echo $font_data['link'] ?>' rel='stylesheet' type='text/css'/>
        <?php endif; ?>
        <style type="text/css">
            <?php echo $css_selector; ?>
            {
                font-family: '<?php echo $font_data['name']; ?>';
            <?php if(isset($font['font-style']) && $font['font-style']): ?>
                font-style:<?php echo $font['font-style']; ?>;
            <?php endif; ?>
            <?php if(isset($font['font-style']) && $font['font-style']): ?>
                font-style:
            <?php echo $font['font-style']; ?>;
            <?php endif; ?>
            <?php if(isset($font['font-weight']) && $font['font-weight']): ?>
                font-weight:<?php echo $font['font-weight']; ?>;
            <?php endif; ?>
            <?php if(isset($font['font-size']) && $font['font-size']): ?>
                font-size: <?php echo intval($font['font-size']); ?>px;
            <?php endif; ?>
            <?php if(isset($font['line-height']) && $font['line-height']): ?>
                line-height: <?php echo intval($font['line-height']); ?>px;
            <?php endif; ?>
            <?php if(isset($font['color'])  && $font['color']): ?>
                color: #<?php echo $font['color']; ?>;
            <?php endif; ?>
            }
        </style>
    <?php
    }
}

/** ************* ST Theme ads ********************/
/**
 *  auto add ads to hooks
 */

function st_auto_ads()
{
    $ads = st_get_setting("ads");
    if (is_array($ads)) {
        foreach ($ads as $ad) {
            if ($ad['hook'] != '' && $ad['content'] != '') {
                $ad['content'] = stripslashes($ad['content']);
                $ad['content'] = str_replace("'", "\'", $ad['content']);
                $new_func = create_function('$c=""', ' echo  \'' . $ad['content'] . '\' ; ');
                add_action($ad['hook'], $new_func);
            }
        }
    }

}

st_auto_ads(); // auto run

function st_background_sytle($bg_color = '', $bg_img = '', $bg_positon = '', $bg_repreat = '', $bg_fixed = 'n')
{
    //return false;
    $bd_style = '';
    if ($bg_color != '' || $bg_positon != '' || $bg_img != '') {
        if ($bg_color != '') {
            $bd_style .= ' #' . $bg_color;
        }

        if ($bg_img != '') {
            $bd_style .= ' url(' . $bg_img . ') ';
            switch (strtolower($bg_positon)) {
                case 'tl':
                    $bd_style .= ' top left ';
                    break;
                case 'tr':
                    $bd_style .= ' top right ';
                    break;
                case 'tc':
                    $bd_style .= ' top center ';
                    break;
                case 'cc':
                    $bd_style .= ' center center';
                    break;
                case 'bl':
                    $bd_style .= ' bottom left ';
                    break;
                case 'br':
                    $bd_style .= ' bottom right ';
                    break;
                case 'bc':
                    $bd_style .= ' bottom center ';
                    break;

            }



            switch (strtolower($bg_repreat)) {
                case 'x':
                    $bd_style .= ' repeat-x ';
                    break;
                case 'y':
                    $bd_style .= ' repeat-y ';
                    break;
                case 'n':
                    $bd_style .= ' no-repeat ';
                    break;

            }
            if ($bg_fixed == 'y') {
                $bd_style .= ' fixed ';
            }
        }
    }

    return $bd_style;
}


/**
 * Set back ground for header
 * hook wp_head
 */

function st_theme_header_bg()
{

    if (st_get_setting('disable_header_custom', 'n') == 'y') {
        return;
    }

    $bd_style = '';
    $bg_color = $bg_img = $bg_positon = $bg_repreat = $bg_fixed = '';
    $bg_color = st_get_setting("header_bg_color", '');
    $bg_img = st_get_setting("header_bg_img", '');
    $bg_positon = st_get_setting("header_bg_positon", '');
    $bg_repreat = st_get_setting("header_bg_repreat", '');
    $bg_fixed = st_get_setting('header_bg_fixed', 'n');

    $bd_style = st_background_sytle($bg_color, $bg_img, $bg_positon, $bg_repreat, $bg_fixed);
    $link_color = st_get_setting("header_link_color", '626262');
    $link_hover_color = st_get_setting("header_link_hover_color", 'FFFFFF');
    if ($bd_style != '' || $link_hover_color != '' || $link_color != '') {
        echo '<style type="text/css">';
        if ($bd_style != '') {
            echo '#header, .header-main{background: ' . $bd_style . '; }';
        }
        if ($link_color != '') {
            echo '.primary-nav ul li a, .primary-nav.slideMenu ul li ul li a{color: #' . $link_color . '; }';
        }
        if ($link_hover_color != '') {
            echo '.primary-nav ul li a:hover, .primary-nav > ul > li:hover > a, .primary-nav ul li.current-menu-item a,
                  		.primary-nav.slideMenu ul li ul li a:hover, .primary-nav.slideMenu > ul > li > ul > li:hover > a, #primary-nav-id ul li.current-menu-item a, #primary-nav-id ul li.current-menu-parent > a, #primary-nav-id ul li.current-menu-ancestor > a {color: #' . $link_hover_color . '; }';
        }
        echo '</style>';
    }
}

/**
 * Set back ground for body
 * hook  wp_head
 */

function st_theme_body_bg()
{
// For background settings
    $bg_type = st_get_setting("bg_type", 'd');
    if ($bg_type == 'd') {
        $bg = st_get_setting("defined_bg", 'background1.jpg');
        // large image with fixed
        if (in_array($bg, array('background1.jpg'))) {
            $bg = ST_THEME_URL . 'assets/images/patterns/' . $bg;
            $style = 'background: url("' . $bg . '") no-repeat fixed center center / cover  transparent;';
        } else {
            $bg = ST_THEME_URL . 'assets/images/patterns/' . $bg;
            $style = 'background: url("' . $bg . '") repeat  center center ';
        }
        echo '<style type="text/css">body {' . $style . ' }</style>';
        return;
    } elseif ($bg_type == 'c') {
        $bg = st_get_setting("defined_bg_color");
        if ($bg != '') {
            echo '<style type="text/css">body {background: #' . $bg . '; }</style>';
        }
        return;
    }

    // if is custom background
    $bd_style = '';
    $bg_color = $bg_img = $bg_positon = $bg_repreat = $bg_fixed = '';
    $bg_color = st_get_setting("bg_color", '');

    $bg_img = st_get_setting("bg_img", '');
    $bg_positon = st_get_setting("bg_positon", '');
    $bg_repreat = st_get_setting("bg_repreat", '');
    $bg_fixed = st_get_setting('bg_fixed', 'n');
    $bd_style = st_background_sytle($bg_color, $bg_img, $bg_positon, $bg_repreat, $bg_fixed);
    if ($bd_style != '') {
        echo '<style type="text/css">body {background: ' . $bd_style . '; }</style>';
    }
}

function st_theme_style()
{
    $font_body = st_get_setting("body_font", array('font-family' => 'Roboto'));
    $heading_font = st_get_setting("headings_font", array('font-family' => 'Roboto'));
    st_make_font_style($font_body, 'body');
    st_make_font_style($heading_font, 'h1,h2,h3,h4,h5,h6, .subscribe_section label, .widget_calendar  caption');
    // Predefined Colors (pc) - Custom Color (cc)
    $pc = st_get_setting("predefined_colors");
    $e_cc = st_get_setting("enable_custom_global_skin");
    $cc = st_get_setting("custom_global_skin");
    $skin = '';
    if ($e_cc == 'y') {
        $skin = ($cc != '') ? $cc : $pc;
    } elseif ($pc != '') {
        $skin = $pc;
    }
    $skin = str_replace('#', '', esc_attr($skin));
    $skin = ($skin != '') ? $skin : 'fff200';
    $skin = '#' . $skin;
    ?>

<style type="text/css">
     /* CSS Skin */
    .bg,#header .socials li a:hover,.social-icons li a:hover,.header-right-inner .social-icons li a.search-form-icon:hover,.header-right-inner .social-icons li a.search-form-icon.active,.controls button:hover,.btn,input.btn,a.btn,.button,input.button,a.button,.post .categories a:hover,.pagination ul li a,#submit_comemnt,.flex-control-nav li a.flex-active,.acc-title.acc-title-active,.toggle-title.toggle_current,.tab-title li.current,.widget_tag_cloud a,.p-pagination a,.flex-direction-nav li a:hover,input[type=submit],.mfp-arrow:hover:before,.mfp-arrow:hover:after,#sttotop:hover,.wpcf7-form .wpcf7-submit{background-color:<?php echo $skin;?>;-o-transition:.5s;-ms-transition:.5s;-moz-transition:.5s;-webkit-transition:.5s}
    .flex-direction-nav li a{color:#000;-o-transition:.5s;-ms-transition:.5s;-moz-transition:.5s;-webkit-transition:.5s}
    .color,.content a:hover,.sidebar a:hover,.breadcrumbs a:hover,.txt_when_hover:hover,.ticky .post-title a{color:<?php echo $skin;?>;-o-transition:.5s;-ms-transition:.5s;-moz-transition:.5s;-webkit-transition:.5s}
    .bodder-color,#footer{border-color:<?php echo $skin;?>}
    /* Header background */
    #header{background:<?php echo $skin;?>}

    /*Header link and text color */
    <?php
    $container_bg = st_get_setting('container_bg','000000');
    $container_bg_opacity = floatval(st_get_setting('container_bg_opacity','0.5'));
    $container_bg_opacity  = ($container_bg_opacity >1) ?  1 : ( $container_bg_opacity<0 ? 0 : $container_bg_opacity ) ;
    $rgba=  hex2rgba($container_bg, $container_bg_opacity);
    $argb = hex2argb($container_bg, $container_bg_opacity);
    $argb = '#'.$argb;
    $g_opacity = floatval(st_get_setting('gallery_item_hover_opacity','0.6'));
    $g_opacity  = ($g_opacity >1) ?  1 : ( $g_opacity<0 ? 0 : $g_opacity ) ;
    $gi_argb = hex2argb('000000', $g_opacity);
    $gi_argb ='#'.$gi_argb;
    ?>
    .container-bg{background:rgba(<?php echo $rgba;?>);-ms-filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=<?php echo $argb;?>, endColorstr=<?php echo $argb;?>);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=<?php echo $argb;?>, endColorstr=<?php echo $argb;?>);zoom:1}.isotope .overlay{background:rgba(0,0,0,0);-ms-filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#00000000, endColorstr=#00000000);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#00000000, endColorstr=#00000000);zoom:1}.isotope .item-inner:hover .overlay{background:rgba(0,0,0,<?php echo $g_opacity;?>);-ms-filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=<?php echo $gi_argb;?>, endColorstr=<?php echo $gi_argb;?>);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=<?php echo $gi_argb;?>, endColorstr=<?php echo $gi_argb;?>);zoom:1}
    <?php
    $bcolor=  st_get_setting('border_color','343434');
    $bcolor = '#'.$bcolor;
    ?>
    .post .post-meta,.sidebar .widgettitle,.page-title.has-border,.page-title-wrapper.has-border{border-color:<?php echo $bcolor;?>}
    .divider{background-color:<?php echo $bcolor;?>}
    <?php
      for($i=1; $i<=6; $i++){
           $h = st_get_setting("heading_".$i,array());
           if(intval($h['font-size'])>0){
              echo "h{$i}{ font-size: ".intval($h['font-size'])."px;} \n";
           }
      }
     ?>
</style>
<?php
}

// add to wp_head
add_action('wp_head', 'st_theme_style', 90);
add_action('wp_head', 'st_theme_body_bg', 91);
add_action('wp_head', 'st_theme_header_bg', 92);


function st_header_tracking_code()
{
    $code = st_get_setting('headder_tracking_code', '');
    $code = stripslashes($code);
    if (is_string($code)) {
        echo $code;
    }
}

function st_footer_tracking_code()
{
    $code = st_get_setting('footer_tracking_code', '');
    $code = stripslashes($code);
    if (is_string($code)) {
        echo $code;
    }
}

add_action('wp_head', 'st_header_tracking_code', 123);
add_action('wp_footer', 'st_footer_tracking_code', 123);

/* Back to top buttn*/

function st_back_totop()
{

    echo '<div id="sttotop" class="bg_color"><i class="icon-angle-up"></i></div>';

}

add_action('wp_footer', 'st_back_totop');

function background_slider($dt, $show_caption = false)
{

    global $post;

    $data = $dt['thumbnails'];

    $images = $data['images'];

    $metas = $data['meta'];

    $sliders = array();

    if (count($images)) {


        /* Get Data */
        $i=0;
        foreach ($images as $k => $thumb_id) {
            $meta = $metas[$k];
            $thumb_image_url = wp_get_attachment_image_src($thumb_id, 'st_large');
            $thumb_image_url = $thumb_image_url[0];
            $full_image_url = wp_get_attachment_image_src($thumb_id, 'full');
            $full_image_url = $full_image_url[0];
            $thumbnail_image_url = wp_get_attachment_image_src($thumb_id, 'thumbnail');
            $thumbnail_image_url = $thumbnail_image_url[0];
            $images['src_large'][$i] = $thumb_image_url;
            $images['src_thumbnail'][$i] = $thumbnail_image_url;
            $images['title'][$i] = isset($meta['title']) ?  stripslashes($meta['title']) : '';
            $images['caption'][$i] = ($meta['caption'] != '') ? '<p>' . stripslashes($meta['caption']) . '</p>' : '';
            $images['url'][$i] = $meta['url'];
            $images['src_full'][$i] = $full_image_url;
            $i++;
        }

        if (isset($dt['type_slider'])) {

            switch ($dt['type_slider']) {


            case 'fixed_slider':



                /* Start Gallery Fixed Slider */

                ?>

                <script type="text/javascript">

                    /* <![CDATA[ */

                    var gFixedHeight = true;

                    var gFixedHeightSetting = <?php echo json_encode(st_fixed_height_js_settings()); ?>;

                    /* ]]> */

                </script>

                <!-- Begin Gallery Flex Slider -->

                <div class="fw-flexslider-wrap t35">

                    <div class="fw-slider-wrap">

                        <div class="fw-flexslider fws" id="slider" sync="#carousel">

                            <ul class="slides">

                                <?php foreach ($images['src_full'] as $k => $v) { ?>

                                    <li>

                                        <div class="slider-item">

                                            <div class="item-cell">

                                                <a class="lightbox" href="<?php echo $v; ?>"><img alt="" src="<?php echo $images['src_large'][$k]; ?>"/></a>

                                            </div>

                                        </div>

                                    </li>

                                <?php } ?>

                            </ul>

                        </div>

                    </div>

                    <div class="fw-carousel-wrap">

                        <div id="carousel" class="fw-carousel" asNavFor="#slider">

                            <ul class="slides">

                                <?php foreach ($images['src_thumbnail'] as $k => $v) { ?>

                                    <li>

                                        <div class="slider-item">

                                            <img alt="" src="<?php echo $v; ?>"/>

                                        </div>

                                    </li>

                                <?php } ?>

                            </ul>

                        </div>

                    </div>

                    <div class="clear"></div>

                </div>

                <!-- End Gallery Flex Slider -->

            <?php

            /* End Gallery Fixed Slider */


            break;

            case 'image_flow':
            /* Start Gallery Image Flow */

            ?>

                <script type="text/javascript">
                    /* <![CDATA[ */
                    var gImageFlow = true;
                    var gImageFlowURL = '<?php echo ST_THEME_URL.'image-flow-xml.php?id='.@$post->ID; ?>';
                    var gImageFlowSetting = <?php echo json_encode(st_image_flow_js_settings()); ?>;
                    /* ]]> */
                </script>
                <!-- Begin Gallery Image Flow -->
                <div class="fw-imageflow-wrap t35">

                    <div id="imageFlow" class="imageflow">

                        <div class="text">

                            <div class="title">
                                <div class="loading-icon"></div>
                            </div>

                            <div class="legend"></div>

                        </div>

                        <div class="scrollbar">

                            <img class="track" src="<?php st_img('dark_slider_bg.png', true); ?>" alt=""/>

                            <img class="arrow-left" src="<?php st_img('sl.gif', true); ?>" alt=""/>

                            <img class="arrow-right" src="<?php st_img('sr.gif', true); ?>" alt=""/>

                            <img class="bar" src="<?php st_img('white_slider_handle.png', true); ?>" alt=""/>

                        </div>

                    </div>

                </div>

                <!-- End Gallery Image Flow -->

            <?php

            /* End Gallery Image Flow */


            break;


            case 'gallery_kenburns':



            /* Start Gallery Kenburns */

            ?>

                <script type="text/javascript">

                    /* <![CDATA[ */

                    var gKenBurnsEffect = true;

                    var gDataKenBurnsEffect = [<?php echo '\''.implode('\',\'',$images['src_full']).'\''; ?>];

                    var gKenBurnsSetting = <?php echo json_encode(st_kenburns_js_settings()); ?>;

                    /* ]]> */

                </script>



                <div id="kenburns_overlay"></div>

                <canvas id="kenburns">

                    <p><?php _e('Your browser doesn\'t support canvas!', 'smooththemes') ?></p>

                </canvas>

            <?php

            /* End Gallery Kenburns */


            break;


            case 'gallery_flip':



            /* Start Gallery Flip */

            ?>

                <script type="text/javascript">

                    /* <![CDATA[ */

                    var gGalleryFlip = true;

                    var gGalleryFlipSetting = <?php echo json_encode(st_flip_js_settings()); ?>;

                    /* ]]> */

                </script>

                <!-- Begin Gallery Flip -->

                <div class="fw-gallery-flip-wrap">

                    <div id="tf_loading" class="tf_loading"></div>

                    <div id="tf_bg" class="tf_bg">

                        <?php foreach ($images['src_full'] as $k => $v) { ?>

                            <img src="<?php echo $v; ?>" alt="" longdesc="<?php echo $images['src_thumbnail'][$k]; ?>"/>

                        <?php } ?>

                    </div>

                    <div id="tf_thumbs" class="tf_thumbs">

                        <span id="tf_zoom" class="tf_zoom"></span>

                        <img src="<?php echo $images['src_thumbnail'][0]; ?>" alt=""/>

                    </div>


                    <div id="tf_next" class="tf_next"></div>

                    <div id="tf_prev" class="tf_prev"></div>

                </div>

                <!-- End Gallery Flip -->

            <?php

            /* Start Gallery Flip */


            break;


            default :



            /* Start Supersize Slider */

            foreach ($images['src_full'] as $k => $v) {

                $item = array();

                $item['image'] = $v;

                $item['title'] = '';

                if ($show_caption) {

                    if ($images['title'][$k] != '' || $images['caption'][$k] != '') {

                        if ($images['url'][$k] != '' && $images['title'][$k] != '') {

                            $item['title'] = '<a href="' . $images['url'][$k] . '">' . esc_html($images['title'][$k]) . '</a>';

                        } else if ($images['title'][$k] != '') {

                            $item['title'] = esc_html($images['title'][$k]);

                        }


                        if ($images['caption'] != '') {

                            $images['caption'][$k] = balanceTags($images['caption'][$k]);


                            $item['title'] .= $images['caption'][$k];

                        }

                    }

                }

                $sliders[] = $item;
//var_dump($sliders);
            }
            $slider_settings = array();
            $slider_settings['slideshow'] = st_get_setting("fsc_slideshow") == 'n' ? 0 : 1;
            $slider_settings['autoplay'] = st_get_setting("fsc_autoplay") == 'n' ? 0 : 1;
            $slider_settings['slide_interval'] = intval(st_get_setting("fsc_interval")) > 0 ? intval(st_get_setting("fsc_interval")) : 6000;
            $slider_settings['transition_speed'] = intval(st_get_setting("fsc_transition_speed")) > 0 ? intval(st_get_setting("fsc_transition_speed")) : 800;
            $slider_settings['path'] = st_img('');
            ?>
                <script type="text/javascript">
                    /* <![CDATA[ */
                    var gFullSliderSettings = <?php echo json_encode($slider_settings) ?>;

                    var gFullSliderData = <?php echo json_encode($sliders); ?>;
                    /* ]]> */
                </script>

            <?php

            if ($show_caption) {

                echo ' <div id="slidecaption" ></div> ';

            }
                /* End Supersize Slider */

            }

        }

    }

}
