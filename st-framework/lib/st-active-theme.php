<?php

if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {
      // your code here
      st_theme_activate();
}



function st_theme_activate() {
   // update_option(ST_SETTINGS_OPTION,$options);
    st_update_default_settings(true);
    ob_start();
  //  header('Location: '.admin_url('admin.php?page='.ST_PAGE_SLUG));

}
/**

 * Update to default settings

 */ 

function  st_update_default_settings($check  = false){
    $option_name = '_'.ST_NAME.'_is_import_default';
    if($check === true){

        if(get_option($option_name)=='y'){
              return false;
        }
    }

    // default setting options
    $default ='a:74:{s:6:"layout";s:1:"2";s:9:"site_logo";s:85:"http://demo.smooththemes.com/exposed/wp-content/themes/Exposed/assets/images/logo.png";s:12:"site_favicon";s:0:"";s:9:"body_font";a:8:{s:9:"font-size";s:2:"14";s:14:"font-size-unit";s:2:"px";s:11:"line-height";s:2:"24";s:16:"line-height-unit";s:2:"px";s:5:"color";s:0:"";s:11:"font-family";s:145:"http://fonts.googleapis.com/css?family=Lato:100%2C100italic%2C300%2C300italic%2Cregular%2Citalic%2C700%2C700italic%2C900%2C900italic&subset=latin";s:10:"font-style";s:6:"normal";s:11:"font-weight";s:6:"normal";}s:13:"headings_font";a:1:{s:11:"font-family";s:145:"http://fonts.googleapis.com/css?family=Lato:100%2C100italic%2C300%2C300italic%2Cregular%2Citalic%2C700%2C700italic%2C900%2C900italic&subset=latin";}s:9:"heading_1";a:2:{s:9:"font-size";s:2:"32";s:14:"font-size-unit";s:2:"px";}s:9:"heading_2";a:2:{s:9:"font-size";s:2:"30";s:14:"font-size-unit";s:2:"px";}s:9:"heading_3";a:2:{s:9:"font-size";s:2:"18";s:14:"font-size-unit";s:2:"px";}s:9:"heading_4";a:2:{s:9:"font-size";s:2:"18";s:14:"font-size-unit";s:2:"px";}s:9:"heading_5";a:2:{s:9:"font-size";s:2:"16";s:14:"font-size-unit";s:2:"px";}s:9:"heading_6";a:2:{s:9:"font-size";s:2:"14";s:14:"font-size-unit";s:2:"px";}s:17:"select_theme_skin";s:4:"dark";s:25:"enable_custom_global_skin";s:1:"n";s:18:"custom_global_skin";s:6:"fff200";s:12:"container_bg";s:0:"";s:20:"container_bg_opacity";s:0:"";s:12:"border_color";s:6:"343434";s:26:"gallery_item_hover_opacity";s:3:"0.6";s:7:"bg_type";s:7:"default";s:10:"defined_bg";s:12:"pattern3.png";s:16:"defined_bg_color";s:6:"c71c77";s:8:"bg_color";s:0:"";s:6:"bg_img";s:0:"";s:10:"bg_positon";s:2:"cc";s:10:"bg_repreat";s:1:"y";s:8:"bg_fixed";s:1:"y";s:21:"disable_header_custom";s:1:"y";s:17:"header_link_color";s:6:"ffffff";s:23:"header_link_hover_color";s:6:"ffffff";s:15:"header_bg_color";s:6:"000000";s:13:"header_bg_img";s:0:"";s:17:"header_bg_positon";s:0:"";s:17:"header_bg_repreat";s:0:"";s:15:"header_bg_fixed";s:0:"";s:13:"blog_toptitle";s:8:"The Blog";s:19:"s_show_featured_img";s:1:"y";s:16:"s_show_post_meta";s:1:"y";s:15:"s_show_post_tag";s:1:"y";s:18:"enable_author_desc";s:1:"y";s:15:"s_show_comments";s:1:"y";s:8:"facebook";s:2:"#f";s:7:"twitter";s:2:"#t";s:11:"google_plus";s:0:"";s:4:"digg";s:0:"";s:9:"pinterest";s:0:"";s:6:"flickr";s:7:"#flickr";s:16:"footer_copyright";s:115:"&copy; 2012. All Rights Reserved. Created with love by <a href=\"http://www.smooththemes.com\">SmoothThemes.Com</a>";s:14:"flex_animation";s:4:"fade";s:17:"flex_directionNav";s:1:"y";s:18:"flex_animationLoop";s:1:"y";s:14:"flex_slideshow";s:1:"y";s:19:"flex_slideshowSpeed";s:4:"7000";s:19:"flex_animationSpeed";s:3:"600";s:18:"flex_pauseOnAction";s:4:"true";s:17:"flex_pauseOnHover";s:1:"y";s:15:"flex_controlNav";s:1:"y";s:14:"flex_randomize";s:1:"n";s:20:"fixed_slideshowSpeed";s:4:"7000";s:20:"fixed_animationSpeed";s:3:"600";s:12:"fsc_autoplay";s:1:"y";s:13:"fsc_slideshow";s:1:"y";s:12:"fsc_interval";s:4:"6000";s:20:"fsc_transition_speed";s:3:"800";s:11:"gif_horizon";s:3:"0.6";s:8:"gif_size";s:3:"0.2";s:10:"gif_border";s:1:"0";s:21:"gkb_frames_per_second";s:2:"60";s:16:"gkb_display_time";s:4:"5000";s:13:"gkb_fade_time";s:4:"1000";s:8:"gkb_zoom";s:3:"1.2";s:18:"gflip_directionnav";s:1:"y";s:15:"gflip_thumbnail";s:1:"y";s:21:"headder_tracking_code";s:0:"";s:20:"footer_tracking_code";s:0:"";}';

    $translate  = 'YTo1OTp7czo2OToiVGhpcyBwb3N0IGlzIHBhc3N3b3JkIHByb3RlY3RlZC4gRW50ZXIgdGhlIHBhc3N3b3JkIHRvIHZpZXcgY29tbWVudHMuIjtzOjA6IiI7czoxMjoiTm8gUmVzcG9uc2VzIjtzOjA6IiI7czoxMjoiT25lIFJlc3BvbnNlIjtzOjA6IiI7czoxMToiJSBSZXNwb25zZXMiO3M6MDoiIjtzOjE0OiJPbGRlciBDb21tZW50cyI7czowOiIiO3M6MTQ6Ik5ld2VyIENvbW1lbnRzIjtzOjA6IiI7czoyOiJ0byI7czowOiIiO3M6MjA6IkNvbW1lbnRzIGFyZSBjbG9zZWQuIjtzOjA6IiI7czoxOToiTGVhdmUgYSBSZXBseSB0byAlcyI7czowOiIiO3M6MTE6IllvdSBtdXN0IGJlIjtzOjA6IiI7czoxODoidG8gcG9zdCBhIGNvbW1lbnQuIjtzOjA6IiI7czoyOToiUmVxdWlyZWQgZmllbGRzIGFyZSBtYXJrZWQgJXMiO3M6MDoiIjtzOjEzOiJMZWF2ZSBhIFJlcGx5IjtzOjA6IiI7czoxMjoiQ2FuY2VsIFJlcGx5IjtzOjA6IiI7czoxMjoiUG9zdCBDb21tZW50IjtzOjA6IiI7czo3OiJDb21tZW50IjtzOjA6IiI7czo1NzoiWW91IG11c3QgYmUgPGEgaHJlZj0iJXMiPmxvZ2dlZCBpbjwvYT4gdG8gcG9zdCBhIGNvbW1lbnQuIjtzOjA6IiI7czo0MToiWW91ciBlbWFpbCBhZGRyZXNzIHdpbGwgbm90IGJlIHB1Ymxpc2hlZC4iO3M6MDoiIjtzOjQ6Ik5hbWUiO3M6MDoiIjtzOjU6IkVtYWlsIjtzOjA6IiI7czo3OiJXZWJzaXRlIjtzOjA6IiI7czoyMToidHlwZSBhbmQgaGl0IGVudGVyLi4uIjtzOjA6IiI7czo2OiJTZWFyY2giO3M6MDoiIjtzOjc6IlBhZ2UgJXMiO3M6MDoiIjtzOjE1OiJQZXJtYWxpbmsgdG8gJXMiO3M6MDoiIjtzOjM6IkFsbCI7czowOiIiO3M6OToiTG9hZGluZy4uIjtzOjA6IiI7czo5OiJMb2FkIG1vcmUiO3M6MDoiIjtzOjg6IkRhdGU6ICVzIjtzOjA6IiI7czo4OiJUYWdzOiAlcyI7czowOiIiO3M6MzoiLi4uIjtzOjA6IiI7aTo0MDQ7czowOiIiO3M6MTU6IkdvIHRvIEhvbWUgcGFnZSI7czowOiIiO3M6MTk6Im9yIHNlYXJjaCB0aGlzIHNpdGUiO3M6MDoiIjtzOjE5OiJBdXRob3IgQXJjaGl2ZXM6ICVzIjtzOjA6IiI7czoxMToiU2VhY2ggZm9yIDoiO3M6MDoiIjtzOjE4OiJEYWlseSBBcmNoaXZlczogJXMiO3M6MDoiIjtzOjIwOiJNb250aGx5IEFyY2hpdmVzOiAlcyI7czowOiIiO3M6MzoiRiBZIjtzOjA6IiI7czoxOToiWWVhcmx5IEFyY2hpdmVzOiAlcyI7czowOiIiO3M6MToiWSI7czowOiIiO3M6MTM6IkJsb2cgQXJjaGl2ZXMiO3M6MDoiIjtzOjIxOiJPb3BzLCBQYWdlIG5vdCBmb3VuZC4iO3M6MDoiIjtzOjY6IlBhZ2VzOiI7czowOiIiO3M6OToiTmV4dCBwYWdlIjtzOjA6IiI7czoxMzoiUHJldmlvdXMgcGFnZSI7czowOiIiO3M6NToiVGFnczoiO3M6MDoiIjtzOjk6IjAgQ29tbWVudCI7czowOiIiO3M6OToiMSBDb21tZW50IjtzOjA6IiI7czoxMDoiJSBDb21tZW50cyI7czowOiIiO3M6NToiU2hhcmUiO3M6MDoiIjtzOjE4OiJBdXRob3IgRGVzY3JpcHRpb24iO3M6MDoiIjtzOjk6IllvdXIgTmFtZSI7czowOiIiO3M6ODoicmVxdWlyZWQiO3M6MDoiIjtzOjE5OiJZb3VyIEUtTWFpbCBBZGRyZXNzIjtzOjA6IiI7czo3OiJTdWJqZWN0IjtzOjA6IiI7czo4OiJNZXNzYWdlOiI7czowOiIiO3M6MTA6IlN1Ym1pdCBOb3ciO3M6MDoiIjtzOjEzOiJSZWFkIG1vcmUg4oaSIjtzOjA6IiI7fQ==';

    $default = str_replace("'","\\'", $default);
    $default = maybe_unserialize($default);
    $default['site_logo'] = st_img('logo.png');
    update_option(ST_SETTINGS_OPTION,$default);
    if(st_is_wpml()){
        $langs = icl_get_languages('skip_missing=0&orderby=KEY&order=asc');
        foreach($langs as $l){
           update_option(ST_SETTINGS_OPTION.'_'.$l['language_code'],$default);
        }
    }
    // update translate options
    $translate = str_replace("'","\\'", base64_decode($translate));
    $translate=  maybe_unserialize($translate);
    update_option(ST_TRANSLATE_OPTION, $translate);
    update_option($option_name,'y');
}



/* Flush rewrite rules for custom post types. */

add_action( 'after_switch_theme', 'flush_rewrite_rules' );







