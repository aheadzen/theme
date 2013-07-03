<?php
/*
Template Name: Compatibility Type 1
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
$postid = $post->ID;
 $pgtyp = get_post_meta($postid, 'pgtyp', true);
 settype($pgtyp, 'int');
 $pgcat = get_post_meta($postid, 'pgcat', true);
 $gender = get_post_meta($postid, 'gender', true);
 $is_gender = $gender;
 if( empty( $gender ) )
	$gender = 'man';
 $antigender = antigender($gender);
 $zodiac = array("aries", "taurus", "gemini", "cancer", "leo", "virgo", "libra", "scorpio", "sagittarius", "capricorn", "aquarius", "pisces");
$zodiac_caps = array("Aries", "Taurus", "Gemini", "Cancer", "Leo", "Virgo", "Libra", "Scorpio", "Sagittarius", "Capricorn", "Aquarius", "Pisces");
$currentZ = $zodiac[$pgtyp];
$currentZ_caps = ucfirst($zodiac[$pgtyp]);
$gender_caps = ucfirst($gender);
$antigender_caps = ucfirst($antigender);
$thepermalink_arr = explode('/',get_permalink());
$thepermalink = $thepermalink_arr[count($thepermalink_arr)-2];

$urlarray = explode('-', $thepermalink);
//$urlarray = explode('-', substr($_SERVER['REQUEST_URI'], 30, -1));
$urlarylen = count($urlarray);
$headclass = 'match';
if( $urlarylen == 1 || ( $urlarylen == 2 && in_array( $urlarray[1], array('man', 'woman' ) ) ) )
{
	$type = 'index';
	$headclass = $urlarray[0];
	if( $urlarylen == 2 )
	{
		$gender = $urlarray[1];
		$is_gender = $gender;
		$antigender = antigender($gender);
		$pgtyp = array_search( $urlarray[0], $zodiac );
		$currentZ = $zodiac[$pgtyp];
		$currentZ_caps = ucfirst($zodiac[$pgtyp]);
		$gender_caps = ucfirst($gender);
		$antigender_caps = ucfirst($antigender);
	}
}
 ?>
<div id="content1" class="<?php echo $headclass; ?>">
<div id="breadcrumbs">
<?php get_breadcrumb() ?>
</div>


	<!--loop-->	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
	<!--post title-->
	<h1 class="btmspace"><a href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
<?php the_title(); ?></a></h1>

	<?php 
	include(CHILD_TEMPLATEPATH."/include/adtop.php");
	include(CHILD_TEMPLATEPATH."/include/adzodiac.php");
					
			if($urlarylen == 2 && !in_array( $urlarray[1], array('man', 'woman' ) ))
			{
				the_content('<p class="serif">Read the rest of this page &raquo;</p>'); 
				$Z2 = str_replace('/', '', $urlarray[1]);
				$Z2_caps = ucfirst($Z2);

				$anchorURL1 = $currentZ . '-' . $gender . '-' . $Z2 . '-' . $antigender;
				$anchorURL2 = $currentZ . '-' . $antigender . '-' . $Z2 . '-' . $gender;

				$anchorTitle1 = 'Match ' . $currentZ_caps . ' ' . $gender_caps . ' with ' . $Z2_caps . ' ' . $antigender_caps;
				$anchorTitle2 = 'Match ' . $currentZ_caps . ' ' . $antigender_caps . ' with ' . $Z2_caps . ' ' . $gender_caps;

				$anchorText1 = $currentZ_caps . ' ' . $gender_caps . ' with ' . $Z2_caps . ' ' . $antigender_caps . ' Love Compatibility';
				$anchorText2 = $currentZ_caps . ' ' . $antigender_caps . ' with ' . $Z2_caps . ' ' . $gender_caps . ' Love Compatibility';
				?>
				<strong>Also See:</strong>
				<ul>
					<li><a title="<?php echo $anchorTitle1; ?>" href="<?php echo site_url();?>/sign-compatibility/<?php echo $anchorURL1; ?>/"><?php echo $anchorText1; ?></a></li>
					<?php if( $Z2 != $currentZ)
					{ ?>
					<li><a title="<?php echo $anchorTitle2; ?>" href="<?php echo site_url();?>/sign-compatibility/<?php echo $anchorURL2; ?>/"><?php echo $anchorText2; ?></a></li>
					<li><a title="See <?php echo $currentZ_caps; ?> Love Compatibility with Other Zodiac Signs" href="<?php echo site_url();?>/sign-compatibility/<?php echo $currentZ; ?>/"><?php echo $currentZ_caps; ?> Love Compatibility with Other Zodiac Signs</a></li>
					<li><a title="See <?php echo $Z2_caps; ?> Love Compatibility with Other Zodiac Signs" href="<?php echo site_url();?>/sign-compatibility/<?php echo $Z2; ?>/"><?php echo $Z2_caps; ?> Love Compatibility with Other Zodiac Signs</a></li>
					<?php } ?>
				</ul>
		<?php
			}
			else if ($urlarylen == 4)
			{
				the_content('<p class="serif">Read the rest of this page &raquo;</p>'); 
				$Z2 = $urlarray[2];
				$Z2_caps = ucfirst($Z2);

				$anchorURL1 = $currentZ . '-' . $urlarray[2];
				$anchorURL2 = $currentZ . '-' . $antigender . '-' . $urlarray[2] . '-' . $gender;

				$anchorTitle1 = 'Match ' . $currentZ_caps . ' with ' . $Z2_caps;
				$anchorTitle2 = 'Match ' . $currentZ_caps . ' ' . $antigender_caps . ' with ' . $Z2_caps . ' ' . $gender_caps;

				$anchorText1 = $currentZ_caps . ' with ' . $Z2_caps . ' Love Compatibility';
				$anchorText2 = $currentZ_caps . ' ' . $antigender_caps . ' with ' . $Z2_caps . ' ' . $gender_caps . ' Love Compatibility';
								?>
				<strong>Also See:</strong>
				<ul>
					<li><a title="<?php echo $anchorTitle1; ?>" href="<?php echo site_url();?>/sign-compatibility/<?php echo $anchorURL1; ?>/"><?php echo $anchorText1; ?></a></li>
					<?php if( $urlarray[2] != $currentZ)
					{ ?>
					<li><a title="<?php echo $anchorTitle2; ?>" href="<?php echo site_url();?>/sign-compatibility/<?php echo $anchorURL2; ?>/"><?php echo $anchorText2; ?></a></li>
					<li><a title="See <?php echo $currentZ_caps; ?> Love Compatibility with Other Zodiac Signs" href="<?php echo site_url();?>/sign-compatibility/<?php echo $currentZ; ?>/"><?php echo $currentZ_caps; ?> Love Compatibility with Other Zodiac Signs</a></li>
					<li><a title="See <?php echo $Z2_caps; ?> Love Compatibility with Other Zodiac Signs" href="<?php echo site_url();?>/sign-compatibility/<?php echo $Z2; ?>/"><?php echo $Z2_caps; ?> Love Compatibility with Other Zodiac Signs</a></li>
					<?php } ?>
				</ul>
	<?php }

		if( $type == 'index' )
		{
			echo '<p>Please select a zodiac sign below to find out the love compatibility with <strong>' . ucfirst($urlarray[0]) . ' ' . ucfirst($urlarray[1]) . '</strong>.</p>';
			include(CHILD_TEMPLATEPATH."/include/compatnav.php"); 
			include(CHILD_TEMPLATEPATH."/include/compataff.php");			
		}
		else {
			include(CHILD_TEMPLATEPATH."/include/compataff.php");
			include(CHILD_TEMPLATEPATH."/include/zodiacoptions.php"); 
			include(CHILD_TEMPLATEPATH."/include/compatnav.php");
		}
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
