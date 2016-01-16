<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <!-- Basic Page Needs
        ================================================== -->
	    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	    <?php if(''!=st_get_setting('site_favicon','')): ?>
	    <link rel="shortcut icon" href="<?php echo esc_attr(st_get_setting('site_favicon')); ?>" />
	    <?php endif; ?>
        <!-- Mobile Specific -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=1" />
        <!-- Browser Specical Files -->
        <!--[if lt IE 9]>
        <script src="<?php echo get_template_directory_uri(); ?>/assets/js/html5shiv.js"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/assets/js/respond.min.js"></script>
        <![endif]-->
       
        <?php wp_head(); ?>
    </head>
<body <?php body_class(); ?>>

<div id="mobile-menu-wrapper">
    <div id="mobile-menu-inner">
        <div id="primary-nav-mobile-a" class="primary-nav-close">
            <i class=""></i> 
        </div>
        <nav id="primary-nav-mobile"></nav>
    </div>
</div>

    <div class="site-wrapper">
    <div class="site-content-wrapper">
    <div class="site-content-inner">
    
        <header id="header">
           
              <div id="site-logo" class="bg">
                 <h1>
                    <a href="<?php echo site_url(); ?>">
                       <?php if(st_get_setting("site_logo")!=''): ?>
                        <img src="<?php echo esc_attr(st_get_setting("site_logo")); ?>" alt="<?php  bloginfo('name'); ?>"/>
                        <?php else: ?>
                        <span class="no-logo"><?php bloginfo('name'); ?></span>
                       <?php  endif; ?>
                    </a>
                 </h1>
              </div>
              
              <div class="header-main">
              
                  <div class="header-right right">
                        <div class="header-right-inner">
                            <ul class="social-icons">
                            	<?php if(st_get_setting("twitter")!=''){ ?>
                                <li class="social-twitter"><a href="<?php echo st_get_setting("twitter") ; ?>"></a></li>
                                <?php } ?>
                                <?php if(st_get_setting("facebook")!=''){ ?>
                                <li class="social-facebook"><a href="<?php echo esc_url(st_get_setting("facebook")); ?>"></a></li>
                                <?php } ?>
                                <?php if(st_get_setting("flickr")!=''){ ?>
                                <li class="social-flickr"><a href="<?php echo esc_url(st_get_setting("flickr")); ?>"></a></li>
                                <?php } ?>
                                <?php if(st_get_setting("digg")!=''){ ?>
                                <li class="social-digg"><a href="<?php echo esc_url(st_get_setting("digg")); ?>"></a></li>
                                <?php } ?>
                                <?php if(st_get_setting("google_plus")!=''){ ?>
                                <li class="social-google-plus social-gplus"><a href="<?php echo esc_url(st_get_setting("google_plus")); ?>"></a></li>
                                <?php } ?>
                                <?php if(st_get_setting("pinterest")!=''){ ?>
                                <li class="social-pinterest"><a href="<?php echo esc_url(st_get_setting("pinterest")); ?>"></a></li>
                                <?php } ?>
                                <li class="search-form-li" ><a href="#" class="search-form-icon"><i class="icon-search"></i></a></li>
                            </ul>
                        
                            <form action="<?php echo home_url( '/' ); ?>" class="searchform top-search"  method="get" role="search">
                                <input type="text" class="s inputbox" placeholder="<?php _e('type and hit enter...','smooththemes'); ?>" name="s" value="" />
                            </form>
                    
                    </div><!-- /.header-right-inner -->
                  </div><!-- /.header-right -->
                  
                  <div class="main-nav left">


    				<nav id="primary-nav-id" class="primary-nav slideMenu">
    					<ul>
    						<?php 
                                 $defaults = array(
                                        	'theme_location'  => 'Primary_Navigation',
                                        	'container'       => false,
                                            'container_class' => false,
                                            'items_wrap'=>'%3$s',
                                        	'echo'            => true
                                        );
                               wp_nav_menu( $defaults );
                            ?>      
    					</ul>
    				</nav>
    			</div>		
    		 <div class="clear"></div>	
             </div><!-- header-main -->
             <div class="clear"></div>
        </header><!-- /#header -->

