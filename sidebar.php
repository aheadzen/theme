<div class="span3 sidebar group" id="sidebar-default-sidebar">
<!--Ask Your Question Start -->
<div id="xsnazzy">
<b class="xtop"><b class="xb1"></b><b class="xb2"></b><b class="xb3"></b><b class="xb4"></b></b>
<div class="xboxcontent">
			<div id="popular">
				<div class="askquestion">
					<a class="button" title="Post Questions. Get Answers." href="<?php linkTO('groups/answers/forum/#post-new'); ?>">Ask Your Question Now &raquo;</a>
				</div>
			</div>
		</div>
<b class="xbottom"><b class="xb4"></b><b class="xb3"></b><b class="xb2"></b><b class="xb1"></b></b>
</div><!--Ask Your Question Ends -->


<?php
	if( is_user_logged_in() )
      include(CHILD_TEMPLATEPATH."/include/quick_links.php");
	else include(CHILD_TEMPLATEPATH."/include/ad-n.php");

include(CHILD_TEMPLATEPATH."/include/adcriteo300x250.php");

if( bp_is_user() )
	get_sidebar( 'member' );
else if( bp_is_group() )
	get_sidebar( 'group' );
else
{
	if( is_user_logged_in() )
	{
		get_sidebar( 'user' );
	} else get_sidebar( 'regular' );
}
if( !isGoalPage( $post->ID ) )
{
	include(CHILD_TEMPLATEPATH."/include/horomenu.php");
?>
<div class="zmenu widget" id="quick_links">
<div class="recent-post group">
<div class="hentry-post group">
	<div class="thumb-img"><img width="75" height="75" class="yit-image attachment-blog_thumb" src="http://ks4002901.ip-198-100-149.net/wordpress/wp-content/uploads/2013/01/Sunset-75x75.jpg"></div>
<div class="text">
<a href="http://www.ask-oracle.com/when-marry/" title="Marriage Report">
<h3>When Will You Marry</h3>
</a></div>
</div>
<div class="hentry-post group">
	<div class="thumb-img"><img width="75" height="75" class="yit-image attachment-blog_thumb" src="http://ks4002901.ip-198-100-149.net/wordpress/wp-content/uploads/2013/01/Sunset-75x75.jpg"></div>
<div class="text">
<a href="http://www.ask-oracle.com/love-zone/the-famous-love-meter/" title="lovemeter">
<h3>The Famous Love Meter</h3>
</a></div>
</div>
<div class="hentry-post group">
	<div class="thumb-img"><img width="75" height="75" class="yit-image attachment-blog_thumb" src="http://ks4002901.ip-198-100-149.net/wordpress/wp-content/uploads/2013/01/Sunset-75x75.jpg"></div>
<div class="text">
<a href="http://www.ask-oracle.com/free-personalized-predictions/" title="Free Personalized Readings">
<h3>Free Personalized Predictions</h3>
</a></div>
</div>
<div class="hentry-post group">
	<div class="thumb-img"><img width="75" height="75" class="yit-image attachment-blog_thumb" src="http://ks4002901.ip-198-100-149.net/wordpress/wp-content/uploads/2013/01/Sunset-75x75.jpg"></div>
<div class="text">
<a href="http://www.ask-oracle.com/sign-compatibility/" title="Sign Compatibility Readings">
<h3>Love Compatibility</h3>
</a></div>
</div>
<div class="hentry-post group">
	<div class="thumb-img"><img width="75" height="75" class="yit-image attachment-blog_thumb" src="http://ks4002901.ip-198-100-149.net/wordpress/wp-content/uploads/2013/01/Sunset-75x75.jpg"></div>
<div class="text">
<a href="http://www.ask-oracle.com/games/" title="Fun and Games">
<h3>Fun and Games</h3>
</a></div>
</div>
<div class="hentry-post group">
	<div class="thumb-img"><img width="75" height="75" class="yit-image attachment-blog_thumb" src="http://ks4002901.ip-198-100-149.net/wordpress/wp-content/uploads/2013/01/Sunset-75x75.jpg"></div>
<div class="text">
<a href="http://www.ask-oracle.com/chat/" title="Fun and Chat">
<h3>Chat Rooms</h3>
</a></div>
</div>
</div></div>

 	<?php include(CHILD_TEMPLATEPATH."/l_sidebar.php");?>
	<?php //include(CHILD_TEMPLATEPATH."/r_sidebar.php");?>

<?php } ?>
<div style="clear:both; width:100%;"></div>
</div>
