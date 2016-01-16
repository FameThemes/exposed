<?php
/*
 Template Name: Full width
*/

/*
 ========================= WARNING: PLEASE DO NOT CHANGE THIS FILE NAME =========================
*/

global $post;
the_post();
$st_page_options =  $st_page_builder = get_page_builder_options($post->ID);
$builder_content = get_page_builder_content($post->ID) ;
get_header(); 

?>         
<div class="main-wrapper full-width">
    <div class="gallery-width">
		<?php if($builder_content==''){ ?>
		<article <?php post_class('b30 post-content'); ?>>
		<?php   the_content(); ?>
		</article>
		<?php }else{ ?>
		
		<div <?php post_class('page-builder-content post-content'); ?>>
		<?php    echo do_shortcode($builder_content) ;   ?>
		</div>
			
		<?php } ?>
	</div> 
</div><!-- /.main-wrapper -->

<?php 

get_footer();  ?>




