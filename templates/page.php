<?php 
global $post;
the_post();
$st_page_options =  $st_page_builder = get_page_builder_options($post->ID);
$builder_content = get_page_builder_content($post->ID) ;

if(isset($st_page_options['thumbnails']) && isset($st_page_options['thumbnails']['images'])  && is_array($st_page_options['thumbnails']['images']) ){
	background_slider($st_page_options, false);
}
?>
<div class="loading-icon remove-when-load-completed"></div>

<?php if($builder_content==''){ ?>
<article <?php post_class('b30 post-content'); ?>>
<?php   the_content(); ?>
</article>
<?php }else{ ?>

<div <?php post_class('page-builder-content post-content'); ?>>
<?php echo do_shortcode($builder_content); ?>
</div>
	
<?php } ?>
