<div id="xsnazzy">
<b class="xtop"><b class="xb1"></b><b class="xb2"></b><b class="xb3"></b><b class="xb4"></b></b>
<div class="xboxcontent">
			<div id="popular">
			<h3><a href="<?php if(function_exists('bp_forum_permalink')){bp_forum_permalink();} ?>">Group Discussions &raquo;</a></h3>
<?php 
if (function_exists('bp_has_forum_topics') && bp_has_forum_topics(	array(
		'per_page'        => 15,
		'max'             => 15 // Pass search_terms to filter users by their profile data
	)
) ) :

?>

	<ul id="groups-list" class="item-list">
	<?php while ( bp_forum_topics() ) : bp_the_forum_topic(); ?>
	<li>
		<a href="<?php bp_the_topic_permalink() ?>" title="<?php bp_the_topic_title() ?>"><?php bp_the_topic_title() ?></a>
	</li>

	<?php endwhile; ?>
	</ul>
	<?php do_action( 'bp_after_directory_members_list' ) ?>

	<?php bp_member_hidden_fields() ?>

<?php else: ?>

	<div id="message" class="info">
		<p><?php _e( "Sorry, no members were found.", 'buddypress' ) ?></p>
	</div>

<?php endif; ?>
	</div>
		</div>
<b class="xbottom"><b class="xb4"></b><b class="xb3"></b><b class="xb2"></b><b class="xb1"></b></b>
</div>