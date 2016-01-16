<?php


//$room_slug = trim(st_get_setting('post_room')) !='' ? trim(st_get_setting('post_room')) : 'room'  ;


register_post_type('gallery',array(
        'label'=>_x('Gallery','smooththemes'),
        'labels'=>array(
            'singular_name'=>_x('Gallery','smooththemes'),
            'menu_name'=>_x('Gallery','smooththemes'),
            'all_items'=>_x('All Galleries','smooththemes'),
            'add_new'=>_x('Add new','smooththemes'),
            'add_new_item'=>_x('Add new','smooththemes'),
            'edit_item'=>_x('Edit Gallery','smooththemes'),
            'new_item'=>_x('New Gallery','smooththemes'),
            'view_item'=>_x('View Gallery','smooththemes'),
            'search_items'=>_x('Search Galleries','smooththemes'),
            'not_found'=>_x('Not found','smooththemes'),
            'not_found_in_trash'=>_x('Not found in trash','smooththemes')  
        ),
        'public' => true,
        'show_ui'=>true,
        'supports'=>array( 'title','editor' ,'thumbnail' ),
        'menu_position'=>20
        
 ));
 

 // flush_rewrite_rules();
