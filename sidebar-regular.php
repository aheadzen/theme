<!--Sign-up Form  Start -->

<?php if( !isGoalPage( $post->ID ) )
{
	?>
<div id="pxsnazzy">
	<b class="pxtop"><b class="pxb1"></b><b class="pxb2"></b><b class="pxb3"></b><b class="pxb4"></b></b>
	<div class="pxboxcontent">
		<div id="sharing"><div id="reportIcon"></div>
			<h3><a title="Personal Horoscope Report" href="http://www.ask-oracle.com/your-future-forecast-report/">Your Future Forecast Report</a></h3>
			<div>Get <a title="100% Risk Free" href="<?php linkTO( 'birth-chart/future/' ); ?>">your detailed Personalized Horoscope</a> and learn more about the things that life has to offer.</div>
			<a title="Safe and Risk Free" href="<?php linkTO( 'birth-chart/future/' ); ?>">Try Now &raquo;</a>
		</div>
	</div>
	<b class="pxbottom"><b class="pxb4"></b><b class="pxb3"></b><b class="pxb2"></b><b class="pxb1"></b></b>
</div>
<?php include(CHILD_TEMPLATEPATH."/include/adright300x600.php"); ?>
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


<div id="sidebarwrap" class="clearfix">
	<?php include(CHILD_TEMPLATEPATH."/include/adright.php"); ?>

  <?php 
include(CHILD_TEMPLATEPATH."/include/groups.php");	  
  include(CHILD_TEMPLATEPATH."/include/related_members.php");
	  include(CHILD_TEMPLATEPATH."/include/related_groups.php");?>

<?php include(CHILD_TEMPLATEPATH."/include/adlijit300x250.php"); ?>

<?php 
global $ztemplate, $pgtyp;
if($ztemplate)
{ ?>
<!--Answers  Start -->
<div id="pxsnazzy">
	<b class="pxtop"><b class="pxb1"></b><b class="pxb2"></b><b class="pxb3"></b><b class="pxb4"></b></b>
		<div class="pxboxcontent">
			<div id="popular">
				<h3>Answers to Common Questions</h3>
					<ul>
						<?php get_questions($post->ID, $pgtyp);  ?>
						<li><a href="http://developer.yahoo.com/" rel="nofollow">
<img src="http://l.yimg.com/us.yimg.com/i/us/nt/bdg/websrv_120_1.gif" border="0">
</a> Powered by Yahoo! Answers
</li>
					</ul>
					<div id="popular-bottom"></div>
			</div>
		</div>
	<b class="pxbottom"><b class="pxb4"></b><b class="pxb3"></b><b class="pxb2"></b><b class="pxb1"></b></b>
</div><!--Answers Ends -->
<?php }
	if( !$ztemplate && $post->ID!=140 && $post->ID!=139 && $post->ID!=11 && $post->ID!=126 && $post->ID!=247 && $post->ID!=248 && $post->ID!=246 && $post->ID!=241 && $post->ID!=245 && $post->ID!=280 && $post->ID!=249 && $post->ID!=242 && $post->ID!=244 && $post->ID!=243 && $post->ID!=370 && $post->ID!=369 && $post->ID!=371 && $post->ID!=372 && $post->ID!=442 )
	{
?>

<div id="xsnazzy"><!--Daily Horoscopes Start -->
<b class="xtop"><b class="xb1"></b><b class="xb2"></b><b class="xb3"></b><b class="xb4"></b></b>
	<?php include(CHILD_TEMPLATEPATH."/include/daily.php"); ?>
	
<b class="xbottom"><b class="xb4"></b><b class="xb3"></b><b class="xb2"></b><b class="xb1"></b></b>
</div><!--Search box end -->
<?php } }?>
