<?php  
global $post;
$link =get_permalink();
$title_attr = sprintf( esc_attr__( 'Permalink to %s', 'smooththemes' ), the_title_attribute( 'echo=0' ) );
$date_format = get_option('date_format');
if (is_sticky()) {
   $class = 'b30 ticky'; 
}
else {
    $class = 'b30'; 
}
?>

<article <?php post_class($class); ?>>
	
	    <?php
         $image_size = (isset($settings['image_size']) && $settings['image_size'] !='' ) ? $settings['image_size']  : 'st_medium';
         $thumb_html = st_post_thumbnail($post->ID,$image_size);
         if($thumb_html){
         ?>
        <div class="post-thumb">                     
            <?php
           
                echo $thumb_html;
            ?>
            
            <div class="clear"></div>
        </div>
        <?php } ?>

	
	<div class="categories">
		<?php  the_category(' '); ?>
	</div>
	<h2 class="post-title">
		<a href="<?php echo $link; ?>" title="<?php echo $title_attr; ?>"><?php the_title(); ?> </a>
	</h2>

	<div class="post-excerpt">
		<?php  the_excerpt();  ?>
	</div>
	<!-- /.post-excerpt -->


	<div class="post-meta">
		<div class="meta-left">
			<span class="date"><i class="icon-time"></i><?php the_time($date_format); ?></span>
			<span class="sp">|</span>
			<span class="number-comment">
				<a href="<?php echo $link; ?>#comments"> <i class="icon-comments-alt"></i> <?php comments_number(__('0 Comment','smooththemes'),__('1 Comment','smooththemes'),__('% Comments','smooththemes') ); ?>
				</a>
			</span>
		</div>

		<a href="<?php  echo $link;  ?>" title="<?php echo $title_attr; ?>"  class="read-more"> <?php  _e('Read more &#8594;','smoooththemes'); ?></a>

		<div class="clear"></div>
	</div>
	
	<div class="clear"></div>

</article>
<!-- /.post  -->
