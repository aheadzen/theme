<?php
/*
Template Name: Videos
*/
?>
<?php get_header();
do_action( 'yit_before_primary' ) ?>
<!-- START PRIMARY -->
<div id="primary" class="<?php yit_sidebar_layout() ?>">
    <div class="container group">
	    <div class="row">
	        <?php do_action( 'yit_before_content' ) ?>
	        <!-- START CONTENT -->
	        <div id="content-page" class="span<?php echo yit_get_sidebar_layout() == 'sidebar-no' ? 12 : 9 ?> content group">
<?php			
$pgtyp = pagetype($post->ID);
$pgcat = pagecategory($post->ID);
 ?>
<div id="content1" class="videos">
<div id="breadcrumbs">
<?php get_breadcrumb() ?>
</div>


	<!--loop-->	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
	<!--post title-->
	<h1 class="btmspace"><a href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
	<?php include(CHILD_TEMPLATEPATH."/include/adtop.php");
			the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
	<!--end of post and end of loop-->
	
		<?php include(CHILD_TEMPLATEPATH."/include/sharing.php");
			include(CHILD_TEMPLATEPATH."/include/videomenu.php");
			include(CHILD_TEMPLATEPATH."/include/zodiacoptions.php"); 
			include(CHILD_TEMPLATEPATH."/include/zodiacnav.php"); 
		 ?> 

			<?php if ( comments_open() ) comments_template(); ?>

	<?php endwhile; endif; ?>
		
</div>

</div>
	        <!-- END CONTENT -->
	        <?php do_action( 'yit_after_content' ) ?>
	        
	        <?php get_sidebar() ?>
	        
	        <?php do_action( 'yit_after_sidebar' ) ?>
	        
	        <!-- START EXTRA CONTENT -->
	        <?php do_action( 'yit_extra_content' ) ?>
	        <!-- END EXTRA CONTENT -->
		</div>
    </div>
</div>
<!-- END PRIMARY -->
<?php
do_action( 'yit_after_primary' );
get_footer() ?>



