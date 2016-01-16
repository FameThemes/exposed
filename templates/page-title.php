<?php 

$title ='';
$show_breadcrumbs = function_exists('bcn_display');
if(is_singular()){

	if(is_singular('post')){
		// get top title from Admin settings
		if(st_get_setting('show_blog_toptitle','y')!='n'){
			$title  =   st_get_setting('blog_toptitle','');
		}
		 
	}else{
		$title =  get_the_title();
	}

	if(is_page()){
		global  $post;
		$st_page_options =  $st_page_builder = get_page_builder_options($post->ID);
		if(empty($st_page_options) || (isset($st_page_options['show_title'])  &&  $st_page_options['show_title']==1)){
			// show title
		}else{
			$title= '';
		}

	}


}elseif(is_author()){
	global $authordata;
	the_post();
	
	$title = $authordata->display_name!='' ? $authordata->display_name : $authordata->nicename;
	
	$title = sprintf( __( 'Author Archives: %s', 'smooththemes' ), $title ) ;
	
	
}elseif(is_tax() || is_category() || is_tag()){
	$title = single_term_title('',false);
}elseif(is_search()){
	$title = sprintf( __('Seach for : %s','smooththemes') ,get_search_query() );
}elseif( (is_archive() || is_day() || is_date() || is_month() || is_year() || is_time()) && !is_category() ){
 
	if ( is_day() ) :
	$title =	sprintf( __( 'Daily Archives: %s', 'smooththemes' ), '<span>' . get_the_date() . '</span>' );
	elseif ( is_month() ) :
	$title =	 sprintf( __( 'Monthly Archives: %s', 'smooththemes' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'smooththemes' ) ) . '</span>' );
	elseif ( is_year() ) :
	$title =	 sprintf( __( 'Yearly Archives: %s', 'smooththemes'), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'smooththemes' ) ) . '</span>' );
	else :
	$title =__( 'Blog Archives', 'smooththemes' );
	endif;

}elseif(is_404()){
	$title =__('Oops, Page not found.','smooththemes');
}elseif((is_home() || is_front_page()) && !is_page()){  // default if user do not select static page
	if(st_get_setting('show_blog_toptitle','y')!='n'){
		$title  =   st_get_setting('blog_toptitle','');
	}
}


 


if($title!=''){
	
	if(!$show_breadcrumbs):
	?>
	<h1 class="page-title has-border"><?php echo $title; ?></h1>
	<?php else : ?>
	<div class="page-title-wrapper has-border">
		<h1 class="page-title left"><?php echo $title ; ?></h1>
		<div class="breadcrumbs right">
			<?php 
			     bcn_display();
			 ?>
		</div>
		<div class="clear"></div>
	</div>
	<?php
	endif;
	
}

