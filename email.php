<?php
/*
Template Name: Email Horoscopes
*/
?>
<?php get_header();?>

<div id="content1" class="home">
	<div id="breadcrumbs">
	<?php get_breadcrumb() ?>
	</div>
	<!--loop-->	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
	<!--post title-->
	<h1 class="btmspace"><a href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
<?php the_title(); ?></a></h1>
<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>

	<?php endwhile; endif; ?>
<div id="xsnazzy">
<b class="xtop"><b class="xb1"></b><b class="xb2"></b><b class="xb3"></b><b class="xb4"></b></b>
<div class="xboxcontent">
	<h3>Sign Up For Free Horoscopes by Email</h3>
	<ul id="freeEmail">
		<?php include(CHILD_TEMPLATEPATH."/include/signup.php"); ?>
	</ul>
</div>
<b class="xbottom"><b class="xb4"></b><b class="xb3"></b><b class="xb2"></b><b class="xb1"></b></b>
</div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
