<?php
if(is_singular()):
        global $post;
        $st_page_builder = get_page_builder_options($post->ID);;
    else :
        $st_page_builder = array();  
    endif;
    
    if(!isset($st_page_builder['right_sidebar']))
        $st_page_builder['right_sidebar'] ='';
?>

<div class="main-outer-wrapper" >
    <div class="main-wrapper container container-bg">
        <div class="main-content">
                <div class="cloumn twelve b0">
                    
                    <div class="row">
                    
                    	<?php
	                    /**
	                     * @hooked:  st_page_tile_template(); - file lib/template-functions.php 
	                     */
	                    do_action('st_before_layout'); 
	                    
	                    ?>

                        <div class="eight column content-wrapper b0">
                        	<div class="content">
                        		<?php
                                 /**
                                 * @hooked st_page_template(); - file lib/template-functions.php 
                                 */ 
                                  do_action('st_page_template');
                             	?>
                            </div><!-- /.content -->
                        </div><!-- /.content-wrapper -->

                        <div class="four column sidebar-wrapper right-sidebar-wrapper b0">
                            <div class="sidebar righ-sidebar">
                            <?php 
                            	/**
                            	 * hooked:  st_sidebar(); - file lib/template-functions.php 
                            	 * 
                            	 * */
								do_action('st_sidebar',$st_page_builder['right_sidebar'],'right');
                           	 ?>
                            </div><!-- ./sidebar -->
                        </div><!-- ./sidebar-wrapper  -->
                        
                        <?php
		                    /**
		                     * @hooked:  none
		                     */
		                    do_action('st_after_layout'); 
		                    
		                  ?>

                        <div class="clear"></div>
                    </div><!-- /.row -->

                </div><!-- /.cloumn twelve -->

        </div><!-- /.main-content -->

    </div><!-- /.main-wrapper -->

    	
</div>
<!-- /.main-outer-wrapper -->
                        