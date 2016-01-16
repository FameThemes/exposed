<?php 
global $post, $paged;
the_post(); 
$date_format = get_option('date_format');

$post_link = get_permalink($post->ID);

$show_post_meta = st_get_setting("s_show_post_meta",'y')=='y' ? true : false;
?>

<article <?php post_class('b30'); ?>>

    <?php 
     if(st_get_setting('s_show_featured_img','y')!='n'){
     $thumb_html = st_post_thumbnail($post->ID,'st_medium',false, true);
        if($paged<2 && $thumb_html!=''): 
        ?>
        <div class="post-thumb">
            <?php  echo $thumb_html;?>
        </div>
      <?php endif; 
      }
    ?>
    
    <?php if($show_post_meta){ ?>
    <div class="categories">
         <?php the_category(' '); ?>        
    </div>
    <?php } ?>
    
    
    <h2 class="post-title"><?php the_title(); ?></h2>

    <div class="post-content"><?php  the_content(''); ?></div><!-- /.post-content -->
    
     <?php $args = array(
                      'before'           => '<p class="p-pagination">' . __('Pages:','smooththemes'),
                      'after'            => '</p>',
                      'link_before'      => '<span>',
                      'link_after'       => '</span>',
                      'next_or_number'   => 'number',
                      'nextpagelink'     => __('Next page','smooththemes'),
                      'previouspagelink' => __('Previous page','smooththemes'),
                      'pagelink'         => '%',
                      'echo'             => 1
                    ); 
           ?>
    <?php wp_link_pages( $args ); ?> 
    
    <?php if(st_get_setting("s_show_post_tag",'y')=='y'){ ?>
    <p class="page-tags">
            <?php the_tags('<b>'.__('Tags:','smooththemes').'</b> ',', ',''); ?>
    </p>
    <?php } ?>
    

	<?php if($show_post_meta){ ?>
    <div class="post-meta">
         <div class="meta-left">
            <span class="date"><i class="icon-time"></i><?php the_time($date_format); ?></span>
			<span class="sp">|</span>
			<span class="author">
	         <i class="icon-user"></i> <?php echo the_author_posts_link(); ?>
	        </span>
	        <span class="sp">|</span>
			<span class="number-comment">
				<a href="#"> <i class="icon-comments-alt"></i> <?php comments_number(__('0 Comment','smooththemes'),__('1 Comment','smooththemes'),__('% Comments','smooththemes') ); ?></a>
			</span>
         </div>
         
		<?php if(st_get_setting("enable_share_entry",'y') != 'n'): ?>
         <div class="share">
            <span href="#" class="share-icon  txt_when_hover">
                <i class="icon-plus-sign-alt"></i>
                <span class="txt"><?php  _e('Share','smooththemes'); ?></span>

                <span class="tooltip">
                    <span class="tooltip-inner">

                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                        <script type="text/javascript">
                        (function() {
                          var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                          po.src = 'https://apis.google.com/js/plusone.js';
                          var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                        })();
                        </script>

                        <a data-lang="en" data-via="" data-text="Share title" data-url="<?php echo $post_link;  ?>" class="twitter-share-button" href="https://twitter.com/share">tweet</a>
                        <iframe src="//www.facebook.com/plugins/like.php?href=<?php echo urlencode($post_link); ?>&amp;send=false&amp;layout=button_count&amp;width=107&amp;show_faces=false&amp;font=arial&amp;colorscheme=light&amp;action=like&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:107px; height:21px;" allowTransparency="true"></iframe>
                        <a data-pin-config="none" data-pin-do="buttonBookmark" href="//pinterest.com/pin/create/button/"><img src="//assets.pinterest.com/images/PinExt.png" /></a>
                        <script src="//assets.pinterest.com/js/pinit.js"></script>
                    </span>

                </span>
            </span>
            
          </div><!--  end share --> 
          <?php endif; ?>

        <div class="clear"></div>
    </div>
    <?php } ?>
    
    

</article><!-- /.post  -->



<?php if(st_get_setting("enable_author_desc",'y') == 'y'): ?>
<div class="author-details b30">
        <h3><?php _e('Author Description','smooththemes'); ?></h3>
        <div class="author-inner">
            <?php echo get_avatar( $post->post_author, 90 ); ?>
            <div class="author-desc">
                  <p class="author-text"><?php the_author_meta('description'); ?> </p>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
</div><!-- /.author-details -->
<?php endif; ?>
<?php  

if(st_get_setting("s_show_comments",'y')=='y'){
	comments_template('',true);
}




