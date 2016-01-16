<?php  
global $post;
$link =get_permalink();
$title_attr = sprintf( esc_attr__( 'Permalink to %s', 'smooththemes' ), the_title_attribute( 'echo=0' ) );
$date_format = get_option('date_format');
?>

<article class="post b30">
	
	<h2 class="post-title">
		<a href="<?php echo $link; ?>" title="<?php echo $title_attr; ?>" ><?php the_title(); ?> </a>
	</h2>

	<div class="post-excerpt">
		<?php  the_excerpt();  ?>
	</div>
	<!-- /.post-excerpt -->

	<div class="clear"></div>

</article>
<!-- /.post  -->
