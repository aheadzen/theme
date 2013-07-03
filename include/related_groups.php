<div id="xsnazzy">
<b class="xtop"><b class="xb1"></b><b class="xb2"></b><b class="xb3"></b><b class="xb4"></b></b>
<div class="xboxcontent">
			<div id="popular">
			<h3><a href="<?php echo get_linkTo( BP_GROUPS_SLUG );?>/">Related Groups &raquo;</a></h3>
<?php if ( bp_has_groups(	array(
		'type'			  => 'active',
		'user_id'        => 0,
		'per_page'        => 5,
		'max'             => 5 // Pass search_terms to filter users by their profile data
	)
) ) :
?>
				
	<ul id="groups-list" class="item-list">
	<?php $counter=0;?>
	<?php while ( bp_groups() ) : bp_the_group(); ?>
	<li class="vcard">
			<div class="item-avatar">
				<a href="<?php bp_group_permalink(); ?>"><?php bp_group_avatar( 'type=thumb&width=50&height=50' ); ?></a>
			</div>
		<div class="item">
			<div class="item-title fn">
				<a href="<?php bp_group_permalink() ?>" title="<?php bp_group_name() ?>"><?php bp_group_name() ?></a>
			</div>
			<div class="item-meta">
			<div><?php bp_group_member_count(); ?></div>
			<div><?php bp_group_forum_topic_count() ?> topics</div>
			</div>
		</div>
		<div style="width:100%; clear:both;"></div>
		<?php $counter++;?>
		<div id="group_act<?php echo $counter;?>" class="groups_actions">
			<?php bp_group_join_button(); do_action( 'bp_directory_groups_actions' ); ?>
		</div>
		<div class="clearboth"></div>
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
<?php
if(strstr($_SERVER['REQUEST_URI'],'/groups/'))
{
}else{
?>
<script type="text/javascript">
jQuery(document).ready( function() {
	var j = jQuery;
	
	j('.group-subscription-options-link').live("click", function() {
		stheid = j(this).attr('id').split('-');
		group_id = stheid[1];
		j( '#gsubopt-'+group_id ).slideToggle('fast');
	});

	j('.group-subscription-close').live("click", function() {
		stheid = j(this).attr('id').split('-');
		group_id = stheid[1];
		j( '#gsubopt-'+group_id ).slideToggle('fast');
	});

});
</script>
<?php }?>