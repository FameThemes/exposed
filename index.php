<?php 
/**
* Author : SmoothThemes
*/

do_action('st_theme_start');
get_header(); 
/**
* WARNING : be careful when you change this file.
* load layout file.
*/
$GLOBALS['st_template_file_name'] = st_get_tpl_file_name();

get_template_part('templates/layout/'.st_get_layout());

get_footer();
do_action('st_theme_end');

 
