<?php
$h3 = array();
$li = array();
$forum_params = array(
	'page' => 1
	);
if( is_page_template( 'compatibility.php' ) )
{
	global $urlarylen, $pgcat, $currentZ, $Z2, $currentZ_caps, $Z2_caps, $postid, $bp, $groups_template;

	if( $pgcat == 'single' )
		$group_id = get_group_by_zodiac_sign( $currentZ );
	else $group_id = get_post_meta($postid, 'group_id', true);

	$bp->groups->current_group = groups_get_group( array( 'group_id' => $group_id ) );

	if (function_exists('bp_has_forum_topics') &&  bp_has_forum_topics( $forum_params ) )
	{
		while ( bp_forum_topics() )
		{
			bp_the_forum_topic();
			$li[] = '<li><a href="' . bp_get_the_topic_permalink() . '" title="' . bp_get_the_topic_title() . '">' . bp_get_the_topic_title() . '</a></li>';
		}
	} else $li[] = 'No active discussions in this group.';

	if( $pgcat == 'single' )
			$h3['text'] = "Discuss $currentZ_caps in Love and Relationships &raquo;";
	else $h3['text'] = "Discuss $currentZ_caps and $Z2_caps Relationship &raquo;";

	$h3['url'] = bp_get_group_permalink( $bp->groups->current_group );
}
else if( is_page_template( 'zodiac.php' ) || is_page_template( 'horoscope.php' ) )
{
	global $pgcat, $pgtyp, $currentZ, $bp;

	if( empty( $currentZ ) )
		$currentZ = $pgtyp;

	$currentZ_caps = ucfirst( $currentZ );

	$group_id = get_group_by_zodiac_sign( $currentZ );

	if( empty( $group_id ) )
		$group_id = 1;

	$bp->groups->current_group = groups_get_group( array( 'group_id' => $group_id ) );

	if ( function_exists('bp_has_forum_topics') &&  bp_has_forum_topics( $forum_params ) )
	{
		while ( bp_forum_topics() )
		{
			bp_the_forum_topic();
			$li[] = '<li><a href="' . bp_get_the_topic_permalink() . '" title="' . bp_get_the_topic_title() . '">' . bp_get_the_topic_title() . '</a></li>';
		}
	} else $li[] = 'No active discussions in this group.';

	$h3['text'] = "Active Discussions - $currentZ_caps &raquo;";

	$h3['url'] = bp_get_group_permalink( $bp->groups->current_group );
}
else
{
	$filter_groups = array(
		'type' => 'popular',
		'page' => 1,
		'per_page' => 5,
		'max' => 5,
		'populate_extras' => false // Get extra meta - is_member, is_banned
	);	
	if ( bp_has_groups($filter_groups) )
	{
		while ( bp_groups() )
		{
			bp_the_group();

			$li[] =	'<li><a href="' . bp_get_group_permalink() . '">' . bp_get_group_name() . '</a></li>';
		}

	}
	$h3['text'] = 'Discussion Groups &raquo;';
	$h3['url'] = get_linkTO( BP_GROUPS_SLUG . '/' );
}
?>

<!--Group Start -->
<div id="xsnazzy">
	<b class="xtop"><b class="xb1"></b><b class="xb2"></b><b class="xb3"></b><b class="xb4"></b></b>
	<div class="xboxcontent">
		<div id="popular">
			<h3><a href="<?php echo $h3['url']; ?>"><?php echo $h3['text']; ?></a></h3>
			<div class="widget-action">
			<?php my_group_new_topic_button( $bp->groups->current_group ); ?>
			</div>
			<ul>
<?php echo join('', $li ); ?>
						</ul>
			<div id="popular-bottom"></div>
		</div>
	</div>
<b class="xbottom"><b class="xb4"></b><b class="xb3"></b><b class="xb2"></b><b class="xb1"></b></b>
</div><!--Sign-up Form Ends -->
