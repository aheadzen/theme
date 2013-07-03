<?php 
get_header();
do_action( 'yit_before_primary' ) ?>
<!-- START PRIMARY -->
<div id="primary" class="<?php yit_sidebar_layout() ?>">
    <div class="container group">
	    <div class="row">
	        <?php do_action( 'yit_before_content' ) ?>
	        <!-- START CONTENT -->
	        <div id="content-page" class="span<?php echo yit_get_sidebar_layout() == 'sidebar-no' ? 12 : 9 ?> content group">
		

<div id="content1" class="<?php my_content_class(); ?>">

			<?php if ( bp_has_groups() ) : while ( bp_groups() ) : bp_the_group(); ?>
	<div id="breadcrumbs">
	<?php $bText = bp_get_group_name(); get_breadcrumb( $bText ); ?>
	</div>
<?php 
do_action( 'template_notices' );
if( !bp_is_group_forum_topic() )
{
	locate_template( array( 'groups/single/group-header.php' ), true );
?>


			<div id="item-nav">
				<div class="item-list-tabs no-ajax" id="object-nav" role="navigation">
					<ul class="group_home">

						<?php bp_get_options_nav(); ?>

						<?php do_action( 'bp_group_options_nav' ); ?>

					</ul>
				</div>
			</div><!-- #item-nav -->
<?php } ?>
			<div id="item-body">

				<?php if ( bp_is_group_admin_page() && bp_group_is_visible() ) : ?>
					<?php locate_template( array( 'groups/single/admin.php' ), true ) ?>

				<?php elseif ( bp_is_group_members() && bp_group_is_visible() ) : ?>
					<?php locate_template( array( 'groups/single/members.php' ), true ) ?>

				<?php elseif ( bp_is_group_invites() && bp_group_is_visible() ) : ?>
					<?php locate_template( array( 'groups/single/send-invites.php' ), true ) ?>

				<?php elseif ( bp_is_group_forum() && bp_group_is_visible() ) : ?>
					<?php locate_template( array( 'groups/single/forum.php' ), true ) ?>

				<?php elseif ( bp_is_group_membership_request() ) : ?>
					<?php locate_template( array( 'groups/single/request-membership.php' ), true ) ?>

				<?php elseif ( isActivityPage() && bp_group_is_visible() ) : ?>
					<?php locate_template( array( 'groups/single/activity.php' ), true ) ?>

				<?php elseif ( !bp_group_is_visible() ) : ?>
					<?php /* The group is not visible, show the status message */ ?>

					<div id="message" class="info">
						<p><?php bp_group_status_message() ?></p>
					</div>

				<?php else : ?>
					<?php
						/* If nothing sticks, just load a group front template if one exists. */
						locate_template( array( 'groups/single/front.php' ), true );
					?>
				<?php endif; ?>

			</div>

			<?php endwhile; endif; ?>


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