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

                        <div class="twelve column content-wrapper b0">
                        	<div class="content">
                        		<?php
                                 /**
                                 * @hooked st_page_template(); - file lib/template-functions.php
                                 */ 
                                  do_action('st_page_template');
                             	?>
                            </div><!-- /.content -->
                        </div><!-- /.content-wrapper -->
						
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
                        