<?php
	$related_member_url = get_linkTo( BP_MEMBERS_SLUG ) . '/';
	if( bp_displayed_user_id() != 0 )
		$related_member_url .= '?s=' . bp_get_member_profile_data(array( 'field' => 'Country', 'user_id' => bp_displayed_user_id()));
?>
<div id="xsnazzy">
<b class="xtop"><b class="xb1"></b><b class="xb2"></b><b class="xb3"></b><b class="xb4"></b></b>
<div class="xboxcontent">
			<div id="popular">
			<h3><a href="<?php echo $related_member_url; ?>">Related Members &raquo;</a></h3>
<?php 
if ( bp_has_members( my_member_suggestions( 1 ) ) ) :
?>

	<ul id="members-list" class="item-list">
	<?php while ( bp_members() ) : bp_the_member();
		$profileuser = get_userdata(bp_get_member_user_id());
	?>
	
					
					
	<li class="vcard">
	
	<div class="item-avatar">
	<a href="<?php bp_member_permalink() ?>"><?php bp_member_avatar() ?></a>
</div>
<div class="item">
	<div class="item-title fn">
		<a href="<?php bp_member_permalink() ?>"><?php bp_member_name() ?></a>
	</div>
	<div class="item-meta">
	<div>
		<div>
				<?php
				echo my_member_age( $profileuser->birthday );
				$sex = bp_get_member_profile_data( 'field=I am' );
				if( !empty( $sex ) )
					echo '/' . xprofile_filter_link_profile_data( $sex ); ?>
			</div>
			<div>
			<?php

				echo xprofile_filter_link_profile_data( bp_get_member_profile_data( 'field=City' ) . ', ' . bp_get_member_profile_data( 'field=Country' ) );
			?>
		</div>
	</div>
	</div>

	<?php do_action( 'bp_following_list_item' ) ?>

</div>

<div class="action alignright">
<?php //bp_member_add_friend_button() ?>

<?php do_action( 'bp_directory_members_actions' ); ?>
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