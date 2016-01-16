<?php
/*
 Template Name: Full Screen Gallery
*/

/*
========================= WARNING: PLEASE DO NOT CHANGE THIS FILE NAME =========================
*/

get_header();
global $post;
the_post();
$st_page_options =  $st_page_builder = get_page_builder_options($post->ID);
$builder_content = get_page_builder_content($post->ID) ;
if(isset($st_page_options['thumbnails']) && isset($st_page_options['thumbnails']['images'])  && is_array($st_page_options['thumbnails']['images']) ){
	background_slider($st_page_options, true);
}


get_footer();  ?>