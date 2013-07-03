<?php if ( bp_has_members( my_member_suggestions() ) ) :
?>

	<div class="pagination">

		<div class="pag-count" id="member-dir-count">
			<?php bp_members_pagination_count() ?>
		</div>

		<div class="pagination-links  alignright" id="member-dir-pag">
			<?php bp_members_pagination_links() ?>
		</div>

	</div>
	<div class="clearboth"></div>

	<ul id="members-list" class="item-list">
	<?php while ( bp_members() ) : bp_the_member();
		$profileuser = get_userdata(bp_get_member_user_id());
	?>
	<li>
	<div class="item-avatar">
									<a href="<?php bp_member_permalink() ?>"><?php bp_member_avatar() ?></a>
								</div>
								<div class="item alignleft">
									<div class="item-title">
										<h3>
											<a href="<?php bp_member_permalink() ?>"><?php bp_member_name() ?></a>
										</h3>
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
										<?php
										if ( bp_get_member_latest_update() ) : ?>
											<span class="update"> - <?php bp_member_latest_update( 'length=10' ) ?></span>
										<?php endif; ?>
									</div>
									<div class="item-meta"><span class="activity"><?php bp_member_last_active(); ?></span></div>

									<?php do_action( 'bp_following_list_item' ) ?>

								</div>

							<div class="action">
								<div class="generic-button alignright">
								<?php //bp_member_add_friend_button();
								if(function_exists('my_send_gift_button')){
									my_send_gift_button();
								}
								?>
</div>
							<?php //do_action( 'bp_directory_members_actions' ); //vaj ?>
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

<?php do_action( 'bp_after_members_loop' ) ?>
	<div class="pagination">

		<div class="pag-count" id="member-dir-count">
			<?php bp_members_pagination_count() ?>
		</div>

		<div class="pagination-links  alignright" id="member-dir-pag">
			<?php bp_members_pagination_links() ?>
		</div>

	</div>
	<div class="clearboth"></div>