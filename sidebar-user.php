<?php if( !isGoalPage( $post->ID ) )
{?>

<!--Sign-up Form  Start -->
<div id="xsnazzy">
<b class="xtop"><b class="xb1"></b><b class="xb2"></b><b class="xb3"></b><b class="xb4"></b></b>
<div class="xboxcontent">
			<div id="popular">
				<h3>Free Horoscopes by Email</h3>
					<ul id="signup">
						<?php include(CHILD_TEMPLATEPATH."/include/signup.php"); ?>
					</ul>
					<div id="popular-bottom"></div>
			</div>
		</div>
<b class="xbottom"><b class="xb4"></b><b class="xb3"></b><b class="xb2"></b><b class="xb1"></b></b>
</div><!--Sign-up Form Ends -->
<div id="pxsnazzy">
	<b class="pxtop"><b class="pxb1"></b><b class="pxb2"></b><b class="pxb3"></b><b class="pxb4"></b></b>
	<div class="pxboxcontent">
		<div id="sharing"><div id="reportIcon"></div>
			<h3><a title="Personal Horoscope Report" href="<?php linkTO('your-future-forecast-report/'); ?>">Your Future Forecast Report</a></h3>
			<div>Get <a title="100% Risk Free" href="<?php linkTO( 'birth-chart/future/' ); ?>">your detailed Personalized Horoscope</a> and learn more about the things that life has to offer.</div>
			<a title="Safe and Risk Free" href="<?php linkTO( 'birth-chart/future/' ); ?>">Try Now &raquo;</a>
		</div>
	</div>
	<b class="pxbottom"><b class="pxb4"></b><b class="pxb3"></b><b class="pxb2"></b><b class="pxb1"></b></b>
</div>

<div id="sidebarwrap" class="clearfix">
	<?php include(CHILD_TEMPLATEPATH."/include/adright.php");
if( bp_is_blog_page() )
	include(CHILD_TEMPLATEPATH."/include/groups.php");

include(CHILD_TEMPLATEPATH."/include/related_members.php");
	  include(CHILD_TEMPLATEPATH."/include/related_groups.php");
include(CHILD_TEMPLATEPATH."/include/adlijit300x250.php"); ?>

<div id="xsnazzy"><!--Daily Horoscopes Start -->
<b class="xtop"><b class="xb1"></b><b class="xb2"></b><b class="xb3"></b><b class="xb4"></b></b>
	<?php include(CHILD_TEMPLATEPATH."/include/daily.php"); ?>
	
<b class="xbottom"><b class="xb4"></b><b class="xb3"></b><b class="xb2"></b><b class="xb1"></b></b>
</div>
<?php } ?>
