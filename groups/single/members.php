<?php if ( bp_group_has_members( 'exclude_admins_mods=0' ) ) : ?>

	<?php do_action( 'bp_before_group_members_content' ); ?>

	<div class="item-list-tabs" id="subnav" role="navigation">
		<ul>

			<?php do_action( 'bp_members_directory_member_sub_types' ); ?>

		</ul>
	</div>

	<div id="pag-top" class="pagination no-ajax">

		<div class="pag-count" id="member-count-top">

			<?php bp_members_pagination_count(); ?>

		</div>

		<div class="pagination-links" id="member-pag-top">

			<?php bp_members_pagination_links(); ?>

		</div>

	</div>
	<div class="clearboth"></div>

	<?php do_action( 'bp_before_group_members_list' ); ?>

	<ul id="members-list" class="item-list" role="main">

		<?php while ( bp_group_members() ) : bp_group_the_member(); ?>

			<li>
			<div class="item-avatar">
				<a href="<?php bp_group_member_domain(); ?>">

					<?php bp_group_member_avatar_thumb(); ?>

				</a>
			</div>
			<div class="item alignleft">
				<div class="item-title">
					<h3><?php bp_group_member_link(); ?></h3>
					<span class="activity"><?php bp_group_member_joined_since(); ?></span>
				</div>
				<?php do_action( 'bp_group_members_list_item' ); ?>
		
				</div>
				<div class="action">

						<?php /*bp_add_friend_button( bp_get_group_member_id(), bp_get_group_member_is_friend() ); */?>

						<?php do_action( 'bp_group_members_list_item_action' ); ?>

						<?php //do_action( 'bp_following_list_item_actions' ) ?>
					</div>
					<div class="clearboth"></div>

								
			</li>

		<?php endwhile; ?>

	</ul>

	<?php do_action( 'bp_after_group_members_list' ); ?>

	<div id="pag-bottom" class="pagination">

		<div class="pag-count" id="member-count-bottom">

			<?php bp_members_pagination_count(); ?>

		</div>

		<div class="pagination-links" id="member-pag-bottom">

			<?php bp_members_pagination_links(); ?>

		</div>

	</div>

	<?php do_action( 'bp_after_group_members_content' ); ?>

<?php else: ?>

	<div id="message" class="info">
		<p><?php _e( 'This group has no members.', 'buddypress' ); ?></p>
	</div>

<?php endif; ?>
