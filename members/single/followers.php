<?php get_header();
do_action( 'yit_before_primary' ) ?>
<!-- START PRIMARY -->
<div id="primary" class="<?php yit_sidebar_layout() ?>">
    <div class="container group">
	    <div class="row">
	        <?php do_action( 'yit_before_content' ) ?>
	        <!-- START CONTENT -->
	        <div id="content-page" class="span<?php echo yit_get_sidebar_layout() == 'sidebar-no' ? 12 : 9 ?> content group">

<div id="content1" class="members"><div id="breadcrumbs">
<?php get_breadcrumb() ?>
</div>
		<div class="padder">

			<?php do_action( 'bp_before_member_home_content' ) ?>

			<div id="item-header">
				<?php locate_template( array( 'members/single/member-header.php' ), true ) ?>
			</div><!-- #item-header -->

			<div id="item-nav">
				<div class="item-list-tabs no-ajax" id="object-nav">
					<ul>
						<?php bp_get_displayed_user_nav() ?>

						<?php do_action( 'bp_members_directory_member_types' ) ?>
					</ul>
				</div>
			</div><!-- #item-nav -->

			<div id="item-body">
				<?php do_action( 'bp_before_followers_loop' ) ?>

				<?php if ( bp_has_members( 'include=' . bp_get_follower_ids() ) ) : ?>

					<div class="pagination">

						<div class="pag-count">
							<?php bp_members_pagination_count() ?>
						</div>

						<div class="pagination-links">
							<?php bp_members_pagination_links() ?>
						</div>

					</div>
					<div class="clearboth"></div>

					<?php do_action( 'bp_before_followers_list' ) ?>

					<ul id="followers-list" class="item-list">
					<?php while ( bp_members() ) : bp_the_member(); ?>

						<li>
							<div class="item-avatar">
								<a href="<?php bp_member_permalink() ?>"><?php bp_member_avatar() ?></a>
							</div>

							<div class="item">
								<div class="item-title">
									<a href="<?php bp_member_permalink() ?>"><?php bp_member_name() ?></a>
									<?php if ( bp_get_member_latest_update() ) : ?>
										<span class="update"> - <?php bp_member_latest_update( 'length=10' ) ?></span>
									<?php endif; ?>
								</div>
								<div class="item-meta"><span class="activity"><?php bp_member_last_active() ?></span></div>

								<?php do_action( 'bp_followers_list_item' ) ?>

							</div>

							<div class="action">
								<?php //bp_member_add_friend_button() ?>

								<?php do_action( 'bp_followers_list_item_actions' ) ?>
							</div>
							<div class="clearboth"></div>
						</li>

					<?php endwhile; ?>
					</ul>

					<?php do_action( 'bp_after_followers_list' ) ?>

				<?php else: ?>

					<div id="message" class="info">
						<p><?php _e( "Sorry, this member has no followers.", 'buddypress' ) ?></p>
					</div>

				<?php endif; ?>

				<?php do_action( 'bp_after_followers_loop' ) ?>
			</div><!-- #item-body -->

			<?php do_action( 'bp_after_member_home_content' ) ?>

		</div><!-- .padder -->
	</div><!-- #content -->

</div>
	        <!-- END CONTENT -->
	        <?php do_action( 'yit_after_content' ) ?>
	        
	        <?php get_sidebar() ?>
	        
	        <?php do_action( 'yit_after_sidebar' ) ?>
	        
	        <!-- START EXTRA CONTENT -->
	        <?php do_action( 'yit_extra_content' ) ?>
	        <!-- END EXTRA CONTENT -->
		</div>
    </div>
</div>
<!-- END PRIMARY -->
<?php
do_action( 'yit_after_primary' );
get_footer() ?>