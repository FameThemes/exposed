<?php 

if(have_posts()): while(have_posts()): the_post(); 
	include(ST_TEMPLATE_DIR.'loop/loop-post.php');
	
endwhile;

?>
 <div class="pagination text-left t0">
  <?php st_post_pagination(); ?>
 </div>
<?php
else: ?>

<article class="post b30" >
<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'smooththemes' ); ?></p>
<?php get_search_form(); ?>

</article>


<?php endif;
