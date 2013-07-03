<div id="xsnazzy">
<b class="xtop"><b class="xb1"></b><b class="xb2"></b><b class="xb3"></b><b class="xb4"></b></b>
<div class="xboxcontent">
			<div id="popular">
			<h3><a href="<?php echo bp_get_root_domain() . '/' . bp_get_groups_root_slug() . '/' . bp_current_item(); ?>/members/">Group Members &raquo;</a></h3>
<?php if ( bp_group_has_members(	array(
		'per_page'        => 5,
		'max'             => 5
	)
) ) :
?>

	<ul id="members-list" class="related-item-list">
	<?php while ( bp_group_members() ) : bp_group_the_member();
		$profileuser = get_userdata(bp_get_group_member_id());
	?>
	<li>
	<div class="item-avatar">
									<a href="<?php bp_group_member_domain() ?>"><?php bp_group_member_avatar_thumb() ?></a>
								</div>
								<div class="item alignleft">
									<div class="item-title">
										<?php bp_group_member_link() ?>
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

												echo xprofile_filter_link_profile_data( bp_get_member_profile_data( array(
			'field'   => 'City',   // Field name
			'user_id' => bp_get_group_member_id()
		) ) . ', ' . bp_get_member_profile_data( array(
			'field'   => 'Country',   // Field name
			'user_id' => bp_get_group_member_id()
		) ) );
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