<?php
	$profileuser = get_userdata(bp_displayed_user_id());
	 do_action( 'bp_before_member_header' );
	 list($dd, $mm, $yyyy) = split('[/.-]', $profileuser->birthday);
?>

<h1 class="btmspace"><a href="<?php bp_user_link() ?>" rel="bookmark"><?php echo $profileuser->nickname ?></a></h1>
<?php if( is_user_logged_in() && bp_is_my_profile() )
{
} else { ?>
<div id="item-header-avatar" class="alignleft">
	<a href="<?php bp_user_link() ?>">
		<?php bp_displayed_user_avatar( 'type=full' ) ?>
	</a>
</div><!-- #item-header-avatar -->

<div id="item-header-content" class="alignright">

	<?php do_action( 'bp_before_member_header_meta' ) ?>

	<div id="item-meta">
			<div id="item-buttons">
				<ul>
					<li>
								<?php do_action( 'bp_member_header_actions' ); ?>
						<?php do_action( 'bp_profile_header_meta' ); ?>
					</li>
			<?php if ( function_exists( 'bp_add_friend_button' ) ) : ?>
				<?php bp_add_friend_button() ?>
			<?php endif; ?>

			<?php if ( is_user_logged_in() && !bp_is_my_profile() && function_exists( 'bp_send_public_message_link' ) ) : ?>
				<li class="generic-button" id="post-mention">
					<a href="<?php bp_send_public_message_link() ?>" title="<?php _e( 'Mention this user in a new public message, this will send the user a notification to get their attention.', 'buddypress' ) ?>"><?php _e( 'Mention this User', 'buddypress' ) ?></a>
				</li>
			<?php endif; ?>

			<?php if ( is_user_logged_in() && !bp_is_my_profile() && function_exists( 'bp_send_private_message_link' ) ) : ?>
				<li class="generic-button" id="send-private-message">
					<a href="<?php bp_send_private_message_link() ?>" title="<?php _e( 'Send a private message to this user.', 'buddypress' ) ?>"><?php _e( 'Send Message', 'buddypress' ) ?></a>
				</li>
			<?php endif; ?>
			</ul>
		</div><!-- #item-buttons -->
		<div class="clearboth"></div>
		<table class="profile-fields">
		<?php if ( function_exists( 'bp_activity_latest_update' ) ) : ?>
			<tr id="latest-update">
				<td class="label" align="right">Last Status</td>
				<td>:</td>
				<td class="data"><?php bp_activity_latest_update( bp_displayed_user_id() ) ?></td>
			</tr>
		<?php endif;
			if( !empty( $profileuser->birthday ) )
							{ ?>
								<tr>
									<td class="label" align="right">Age</td>
									<td>:</td>
									<td class="data"><?php echo my_member_age( $profileuser->birthday ); ?></td>
								</tr>
						<?php } ?>
<tr>
					<td class="label" align="right">Last Active</td>
					<td>:</td>
					<td class="data"><?php bp_last_activity( bp_displayed_user_id() ) ?></td>
				</tr>
				<tr>
					<td class="label" align="right">Member since</td>
					<td>:</td>
					<td class="data"><?php echo bp_core_get_last_activity( $profileuser->user_registered, '%s') ?></td>
				</tr>
		</table>

		<?php
		 /***
		  * If you'd like to show specific profile fields here use:
		  * bp_profile_field_data( 'field=About Me' ); -- Pass the name of the field
		  */
		?>

	</div><!-- #item-meta -->

</div><!-- #item-header-content -->
<?php } ?>
<div class="clearboth"></div>
<?php do_action( 'bp_after_member_header' ) ?>

<?php do_action( 'template_notices' ) ?>