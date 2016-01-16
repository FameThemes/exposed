<?php
function st_builder_meta_items($name='', $values = array() , $post = false){

    $builder_items = get_page_builder_items();

    $builder_save = isset($values['builder']) ?  $values['builder'] : array();

    if(empty($builder_save) || !is_array($builder_save)){
        $builder_save = array();
    }

    $builder_name =$name.'[builder]';

    $pd_item_width = array(
        '1_1'=>0,     '3_4'=>1,
        '2_3'=>2,   '1_2'=>3,
        '1_3'=>4,   '1_4'=>5,

    );

    ?>


    <?php
    // do not show page builder items  beacase it can not run in shop pages
    if(strtolower($post->post_type) =='page'  && !(get_option('woocommerce_shop_page_id')==$post->ID && $post->ID>0 && st_is_woocommerce())):
        ?>

        <div class="stbuilder buider-meta-item dynamic-item tpl-full-width default">
            <input type="hidden"  class="builder_pre_name" value="<?php echo $builder_name; ?>" />
            <div class="stbuilder-items">
                <h4 class="sttitle"><?php _e('Add Items','smooththemes'); ?></h4>
                <p class="stdesc" ><?php _e('Click "add" to add item to Canvas','smooththemes'); ?></p>
                <div class="notifications">
                    <span class="n success"><?php _e("Item Added",'smooththemes') ;?></span>
                    <span class="n warning"><?php _e("Item removed",'smooththemes') ;?></span>
                </div>
                <div class="clear"></div>
                <div class="stbuilder-o-items">

                    <?php foreach($builder_items as $function => $item): ?>
                        <div class="bd-item">
                            <div class="add-btn">
                                <span class="n"><?php echo esc_html($item['title']); ?></span>
                                <a href="#" class="act-add"><?php echo _e('Add','smooththemes'); ?></a>
                            </div><!-- add-btn -->

                            <div class="item-js-options">
                                <?php
                                $w = $item['default_with'];
                                if($w==''){
                                    $w='1_1';
                                }
                                ?>

                                <div class="obj-item  col_<?php echo $w; ?>" numc="<?php echo $pd_item_width[$w]; ?>">
                                    <div class="obj-item-inner">
                                        <input type="hidden"  class="group-name builder-with"  group-name="[pbwith]" value="<?php echo $w; ?>" />
                                        <?php if(!$item['block']): ?>
                                            <span class="up">+</span>
                                            <span class="down">-</span>
                                        <?php endif; ?>
                                        <span class="with-info"><?php echo str_replace('_','/',$w); ?></span>
                                        <?php if($item['editable']!==false): ?>
                                            <span class="pbedit" title="<?php _e('Click here to edit','smooththemes'); ?>">Edit</span>
                                        <?php endif; ?>
                                        <span class="pbremove" title="<?php _e('Remove','smooththemes'); ?>"></span>

                                        <div class="t"><div><?php echo esc_html($item['title']); ?></div></div>

                                        <div class="obj-js-edit">
                                            <?php
                                            if(function_exists($function)){
                                                call_user_func($function, $function);
                                            }
                                            ?>

                                            <div class="pb-btns">
                                                <input type="button" value="<?php _e('Save','smooththemes'); ?>" class="pbdone pbbtn button-primary" />
                                                <input type="button" value="<?php _e('Cancel','smooththemes'); ?>" class="pbcancel pbbtn button-secondary" />
                                            </div>
                                        </div><!-- obj-js-edit -->
                                    </div>

                                </div><!--  /.obj-item  -->
                            </div><!-- item-js-options -->
                        </div><!-- bd-item -->
                    <?php endforeach; ?>

                    <div class="clear"></div>
                </div><!-- stbuilder-o-items -->
            </div><!-- stbuilder-items -->

            <div class="stbuilder-area-wprap">
                <div class="stbuilder-edit-box" style="display: none;">

                </div><!-- stbuilder-edit-box --->

                <div class="stbuilder-area row-fluid sortable">
                    <?php
                    foreach($builder_save as $i => $item):

                        $func = $builder_items[$item['function']];
                        $w = $item['pbwith'];
                        if($w==''){
                            $w='1_1';
                        }
                        ?>

                        <div class="obj-item  col_<?php echo $w; ?>" numc="<?php echo $pd_item_width[$w]; ?>">
                            <div class="obj-item-inner">
                                <input type="hidden"  class="group-name builder-with"  group-name="[pbwith]" value="<?php echo $w; ?>" />
                                <?php if(!$func['block']): ?>
                                    <span class="up">+</span>
                                    <span class="down">-</span>
                                <?php endif; ?>
                                <span class="with-info"><?php echo str_replace('_','/',$w); ?></span>
                                <?php if(!isset($func['editable'])  || $func['editable']!==false): ?>
                                    <span class="pbedit" title="<?php _e('Click here to edit','smooththemes'); ?>">Edit</span>
                                <?php endif; ?>
                                <span class="pbremove" title="<?php _e('Remove','smooththemes'); ?>"></span>
                                <div class="t"><div><?php echo esc_html($func['title']); ?></div></div>

                                <div class="obj-js-edit">
                                    <?php
                                    if(function_exists($item['function'])){
                                        call_user_func($item['function'],$item['function'],$builder_name,$item);
                                    }
                                    ?>
                                    <div class="pb-btns">
                                        <input type="button" value="<?php _e('Save','smooththemes'); ?>" class="pbdone pbbtn button-primary" />
                                        <input type="button" value="<?php _e('Cancel','smooththemes'); ?>" class="pbcancel pbbtn button-secondary" />
                                    </div>
                                </div><!-- obj-js-edit -->
                            </div>

                        </div><!--  /.obj-item  -->
                    <?php endforeach; ?>

                </div><!-- stbuilder-area -->
            </div>

            <div class="stdive"></div>

        </div><!-- stbuilder -->



    <?php endif; ?>

<?php
}
function  st_builder_meta_layout_sidebar($name='', $values = array() , $post = false){
    global $wp_registered_sidebars;
    ?>
    <div class="layout-wrap buider-meta-item dynamic-item default">
        <div class="layout">
            <h4><?php _e('Layout','smooththemes'); ?></h4>
            <?php
            $layouts = array(
                //  '4'=>  array('title'=>'Three columns, left & right sidebar','img'=>ST_ADMIN_URL.'/page-builder/images/layout/3.png'),
                '3'=>  array('title'=>'Two columns, left sidebar','img'=>ST_ADMIN_URL.'/page-builder/images/layout/2.png'),
                '2'=>  array('title'=>'Two columns, right sidebar','img'=>ST_ADMIN_URL.'/page-builder/images/layout/1.png'),
                '1'=>  array('title'=>'One column, no sidebar','img'=>ST_ADMIN_URL.'/page-builder/images/layout/0.png')
            );

            $layout_name = $name.'[layout]';
            $current_layout =  $values['layout'];

            if(empty($current_layout)){
                $values['layout'] = $current_layout = (in_array($post->post_type, array('portfolio'))) ? '1' : st_get_setting("layout",2) ;// default right sidebar
            }

            $input ='';
            foreach($layouts as $k => $item){
                // $check=$this->radio_checked($k);
                $class="";
                $check = "";
                if($k!='' && $k== $current_layout){
                    $class=" label-checked";
                    $check ='  checked="checked" ';
                }

                $image = $item['img'];

                $input.='<div class="stpb-layout-item'.$class.'">';
                $input.='
             <label class="label" title="'.esc_attr($item['title']).'">
                 <input value="'.htmlspecialchars($k).'" class="STpanel-radio-input" type="radio" '.$check.' name="'.$layout_name.'" />
                 <img src="'.$image.'" alt =""/>
             </label>';
                $input.='</div>';
            }

            echo $input;
            ?>
            <div class="clear"></div>
        </div><!-- layout -->

        <?php
        // default sidebar
        $values['left_sidebar'] = ($values['left_sidebar']!='') ? $values['left_sidebar']  : 'sidebar_default_l' ;
        $values['right_sidebar'] = ($values['right_sidebar']!='') ? $values['right_sidebar']  : 'sidebar_default_r' ;
        ?>

        <div class="sidebar" <?php echo ($values['layout']!=1) ? '' : ' style="display:none;" '; ?>>
            <h4><?php _e('Sidebar','smooththemes'); ?></h4>
        <span  <?php echo ($values['layout']==3  || $values['layout']==4) ? ' ' : ' style="display:none;" '; ?> class="left_sidebar">
        <span class="chzn-select-lb"><?php _e('Left sidebar','smooththemes'); ?></span>
         <select name="<?php echo $name.'[left_sidebar]'; ?>" class="chzn-select">
             <?php foreach($wp_registered_sidebars as $sb):

                 $selected="";
                 if($values['left_sidebar']==$sb['id']){
                     $selected = ' selected ="selected" ';
                 }

                 ?>
                 <option value="<?php echo esc_attr($sb['id']); ?>" <?php echo $selected; ?> ><?php echo esc_html($sb['name']); ?></option>
             <?php endforeach; ?>
         </select>
           <div class="clear"></div>
         </span>


         <span <?php echo ($values['layout']==2  || $values['layout']==4) ? ' ' : ' style="display:none;" '; ?> class="right_sidebar">
         <span class="chzn-select-lb"><?php _e('Right sidebar','smooththemes'); ?></span>

         <select name="<?php echo $name.'[right_sidebar]'; ?>" class="chzn-select">
             <?php foreach($wp_registered_sidebars as $sb):

                 $selected="";
                 if($values['right_sidebar']==$sb['id']){
                     $selected = ' selected ="selected" ';
                 }

                 ?>
                 <option value="<?php echo esc_attr($sb['id']); ?>" <?php echo $selected; ?> ><?php echo esc_html($sb['name']); ?></option>
             <?php endforeach; ?>
         </select>
           <div class="clear"></div>
          </span>

            <div class="clear"></div>
        </div><!--  /. sidebar -->
    </div>


<?php
}
function st_builder_meta_page_title($name='', $values = array() , $post = false, $no_value = false){
    ?>
    <?php  if(strtolower($post->post_type)=='page'):

        if($no_value){
            $values['show_title'] = 1;
            $values['show_content'] = 1;
        }


        ?>
        <div class="meta-item-title dynamic-item buider-meta-item  default">

            <div class="stdive"></div>
            <div class="page_options">

                <div>
                    <h4><?php _e('Show page Title','smooththemes'); ?><small>(<?php _e('Enable title for this page','smooththemes'); ?>)</small></h4>
                    <input type="checkbox" class="ibutton" name="<?php echo $name.'[show_title]'; ?>" <?php  echo ($values['show_title'] ==1) ? '  checked="checked" ':''; ?> value="1" />
                </div>

            </div>

        </div>

    <?php endif; ?>
<?php

}
function st_builder_meta_post_type_thumb($name='', $values = array() , $post = false){

    ?>
    <?php
    if('page'!= strtolower($post->post_type)):
        if(empty($values['thumbnail_type'])){
            $values['thumbnail_type'] ='image';
        }



        ?>
        <div class="meta-item-title buider-meta-item">
            <div class="stdive"></div>

            <div class="thumbnail">
                <h4><?php _e('Thumbnail','smooththemes'); ?></h4>
                <p>
                    <label><input class="tt" type="radio" name="<?php echo $name.'[thumbnail_type]'; ?>" <?php  echo $values['thumbnail_type'] == 'image' ? '  checked="checked" ':''; ?> value="image" /><?php _e('Image (use featured Image)','smooththemes'); ?></label>
                </p>

                <p>
                    <label><input class="tt" type="radio" name="<?php echo $name.'[thumbnail_type]'; ?>" <?php  echo $values['thumbnail_type'] == 'slider' ? '  checked="checked" ':''; ?> value="slider" /><?php _e('Slider','smooththemes'); ?></label>
                </p>

                <?php if(!in_array($post->post_type, array('room','gallery'))): ?>
                    <p>
                        <label><input class="tt" type="radio" name="<?php echo $name.'[thumbnail_type]'; ?>" <?php  echo $values['thumbnail_type'] == 'video' ? '  checked="checked" ':''; ?> value="video" /><?php _e('Video','smooththemes'); ?></label>
                    </p>
                <?php endif; ?>

                <div class="thumbnail_images gallery-builder" <?php  echo ($values['thumbnail_type'] == 'video'  || $values['thumbnail_type'] == 'image' || $values['thumbnail_type'] == 'html' ) ? ' style="display: none" ' : ''; ?>>
                    <?php stpb_images($name.'[thumbnails]',$values['thumbnails']); ?>
                </div>



                <div class="thumbnail_video" <?php  echo ($values['thumbnail_type'] == 'video')? '' : ' style="display: none" ' ; ?>>
                    <label>
                        <strong><?php echo _e("Video URL (Youtube or Vimeo only)",'smooththemes'); ?></strong><br />
                        <input type="text" class="regular-text"  name="<?php echo $name.'[video_code]'; ?>" value="<?php echo esc_attr($values['video_code']); ?>" />
                    </label>
                </div>


            </div>
        </div>

    <?php elseif('page'== strtolower($post->post_type)): ?>


        <?php /*
        <div class="meta-gallery-num-items buider-meta-item">
         	 <?php

         	if(!isset($values['gallery_num_item']) || intval($values['gallery_num_item'])<=0){
         		$values['gallery_num_item'] =  get_option('posts_per_page',10);

         	   }

         	   if(!isset($values['gallery_black_white']) || intval($values['gallery_black_white'])<=0){
         	   	$values['gallery_black_white'] = '';

         	   }

         	?>
         	<h4><?php _e('How many items to show per page ?','smooththemes'); ?></h4>

			<p>
				<label><input class="" type="text" name="<?php echo $name.'[gallery_num_item]'; ?>" value="<?php  echo intval($values['gallery_num_item']); ?>" /></label>
			</p>

			<h4><?php _e('Black and White gallery','smooththemes'); ?></h4>
			<p>
			<input type="checkbox" class="ibutton" name="<?php echo $name.'[gallery_black_white]'; ?>" <?php  echo ($values['gallery_black_white'] ==1) ? '  checked="checked" ':''; ?> value="1" />
			</p>

         </div>

         */ ?>

        <div class="buider-meta-item dynamic-item tpl-fullscreen default">
            <div class="stdive dynamic-item default"></div>

            <h4 class="dynamic-item default"><?php _e('Background Slider / Images','smooththemes'); ?></h4>
            <h4 class="dynamic-item tpl-fullscreen"><?php _e('Upload images','smooththemes'); ?></h4>

            <div class="thumbnail_images gallery-builder">
                <?php stpb_images($name.'[thumbnails]',$values['thumbnails']); ?>
            </div>
        </div>

        <div class="buider-meta-item dynamic-item tpl-fullscreen b80">
            <div class="stdive"></div>
            <h4><?php _e('Type Of Slider','smooththemes'); ?></h4>
            <?php
            $type_slider = array(
                '5'=>  array('title'=>'Supersized Slider','id'=>'supersized_slider'),
                '4'=>  array('title'=>'Fixed Height Slider','id'=>'fixed_slider'),
                '3'=>  array('title'=>'Gallery Image Flow','id'=>'image_flow'),
                '2'=>  array('title'=>'Gallery Kenburns','id'=>'gallery_kenburns'),
                '1'=>  array('title'=>'Gallery Flip','id'=>'gallery_flip'),
            );
            ?>
            <select name="<?php echo $name.'[type_slider]'; ?>" class="chzn-select">
                <?php foreach($type_slider as $item):

                    $selected="";
                    if($values['type_slider']==$item['id']){
                        $selected = ' selected ="selected" ';
                    }

                    ?>
                    <option value="<?php echo esc_attr($item['id']); ?>" <?php echo $selected; ?> ><?php echo esc_html($item['title']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

    <?php  endif; ?>

<?php

}
function  stpb_select_layout($name, $layout_name,$left_sidebar_name,$right_sidebar_name,$values= array(), $title=''){
    global $wp_registered_sidebars;

    ?>

    <div class="layout-wrap buider-meta-item">
        <div class="layout">
            <h4><?php echo esc_html($title); ?></h4>
            <?php

            $layouts = array(
                '3'=>  array('title'=>'Two columns, left sidebar','img'=>ST_ADMIN_URL.'/page-builder/images/layout/2.png'),
                '2'=>  array('title'=>'Two columns, right sidebar','img'=>ST_ADMIN_URL.'/page-builder/images/layout/1.png'),
                '1'=>  array('title'=>'One column, no sidebar','img'=>ST_ADMIN_URL.'/page-builder/images/layout/0.png')
            );

            $input_layout_name = $name.'['.$layout_name.']';
            $current_layout =  $values[$layout_name];

            //  echo var_dump($layout_name);

            if(empty($current_layout)){
                $values[$layout_name] = 1;
            }

            foreach($layouts as $k => $item){
                // $check=$this->radio_checked($k);
                $class="";
                $check = "";
                if($k!='' && $k== $current_layout){
                    $class=" label-checked";
                    $check ='  checked="checked" ';
                }

                $image = $item['img'];

                $input.='<div class="stpb-layout-item'.$class.'">';
                $input.='
             <label class="label" title="'.esc_attr($item['title']).'">
                 <input value="'.htmlspecialchars($k).'" class="STpanel-radio-input" type="radio" '.$check.' name="'.$input_layout_name.'" />
                 <img src="'.$image.'" alt =""/>
             </label>';
                $input.='</div>';
            }

            echo $input;
            ?>
            <div class="clear"></div>
        </div><!-- layout -->

        <?php
        // default sidebar
        $values[$left_sidebar_name] = ($values[$left_sidebar_name]!='') ? $values[$left_sidebar_name]  : 'sidebar_default_l' ;
        $values[$right_sidebar_name] = ($values[$right_sidebar_name]!='') ? $values[$right_sidebar_name]  : 'shop_right_sidebar' ;
        ?>

        <div class="sidebar" <?php echo ($values[$layout_name]!=1) ? '' : ' style="display:none;" '; ?>>
            <h4><?php _e('Sidebar','smooththemes'); ?></h4>
        <span  <?php echo ($values[$layout_name]==3  || $values[$layout_name]==4) ? ' ' : ' style="display:none;" '; ?> class="left_sidebar">
        <span class="chzn-select-lb"><?php _e('Left sidebar','smooththemes'); ?></span>
         <select name="<?php echo $name.'['.$left_sidebar_name.']'; ?>" class="chzn-select">
             <?php foreach($wp_registered_sidebars as $sb):

                 $selected="";
                 if($values[$left_sidebar_name]==$sb['id']){
                     $selected = ' selected ="selected" ';
                 }

                 ?>
                 <option value="<?php echo esc_attr($sb['id']); ?>" <?php echo $selected; ?> ><?php echo esc_html($sb['name']); ?></option>
             <?php endforeach; ?>
         </select>
           <div class="clear"></div>
         </span>


         <span <?php echo ($values[$layout_name]==2  || $values[$layout_name]==4) ? ' ' : ' style="display:none;" '; ?> class="right_sidebar">
         <span class="chzn-select-lb"><?php _e('Right sidebar','smooththemes'); ?></span>

         <select name="<?php echo $name.'['.$right_sidebar_name.']'; ?>" class="chzn-select">
             <?php
             foreach($wp_registered_sidebars as $sb):

                 $selected="";
                 if($values[$right_sidebar_name]==$sb['id']){
                     $selected = ' selected ="selected" ';
                 }

                 ?>
                 <option value="<?php echo esc_attr($sb['id']); ?>" <?php echo $selected; ?> ><?php echo esc_html($sb['name']); ?></option>
             <?php endforeach; ?>
         </select>
           <div class="clear"></div>
          </span>

            <div class="clear"></div>
        </div><!--  /. sidebar -->
    </div>
<?php

}
/**
 *
 * Display settings for gallery page templates
 * @param string $name
 * @param unknown $values
 * @param string $post
 */
function st_builder_meta_gallery_page($name='', $values = array() , $post = false){

    if(strtolower($post->post_type)!='page'){
        return;
    }

    $values =  wp_parse_args($values, array(
        'gallery_num_col'=>3,
        'gallery_slider_id'=>''

    ));
    if(!isset($values['gallery_num_col']) ||  $values['gallery_num_col'] ==''){
        $values['gallery_num_col'] = 3;
    }

    ?>

    <!--
     <div class="meta-gallery-page buider-meta-item">
     <div class="stdive"></div>



      	<h4><?php _e('Number columns to show','smooththemes'); ?></h4>

         <select name="<?php echo $name.'[gallery_num_col]'; ?>" class="chzn-select">
             <?php for($i=2 ;$i<=4; $i++):

             $selected="";
             if($values['gallery_num_col']==$i){
                $selected = ' selected ="selected" ';
             }

              ?>
             <option value="<?php echo esc_attr($i); ?>" <?php echo $selected; ?> ><?php echo esc_html($i); ?></option>
             <?php endfor; ?>
          </select>

     </div>

     <div class="meta-slider-gallery-page buider-meta-item">

      	<h4><?php _e('Gallery ID','smooththemes'); ?></h4>
 		<p>
			<label><input class="" type="text" name="<?php echo $name.'[gallery_slider_id]'; ?>" value="<?php  echo intval($values['gallery_slider_id']) > 0  ? intval($values['gallery_slider_id']) : ''; ?>" /></label>
		</p>
     </div>
     -->

<?php
}
add_action('st_builder_items','st_builder_meta_items',10,3);
add_action('st_builder_meta','st_builder_meta_layout_sidebar',10,3);
add_action('st_builder_meta','st_builder_meta_page_title',12,4);
add_action('st_builder_meta','st_builder_meta_post_type_thumb',13,3);
add_action('st_builder_meta','st_builder_meta_gallery_page',14,3);