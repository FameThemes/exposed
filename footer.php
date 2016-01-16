        </div><!-- /.site-content-innner -->
        </div><!-- /.site-content-wrapper  -->
        
        <footer id="footer" class="footer">
        
            <div class="footer-inner">
                <div class="footer-left">
                    <div class="supersized-action">
                        <a id="prevslide" class="load-item"></a>
                        <a id="play-button" class="load-item"><img id="pauseplay" alt="pause" src="<?php st_img('pause.png',true); ?>"/></a>
                        <a id="nextslide" class="load-item"></a>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="footer-right">
                    <p><?php echo stripslashes(st_get_setting("footer_copyright")); ?></p>
                </div>
                <div class="clear"></div>
            </div>
        </footer>
    
    </div><!-- /.site-wrapper -->
    <?php wp_footer();?>
    
 
</body>
</html>