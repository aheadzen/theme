<?php get_header();
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

	<h1 class="btmspace" id="group-<?php bp_group_ID(); ?>" style="float:left;"><a href="<?php bp_group_permalink() ?>" rel="bookmark" title="<?php bp_group_name() ?>"><?php bp_group_name() ?></a>
	</h1>

<div id="item-header-content" class="group_activity_button"><?php bp_group_join_button() ?></div><!-- #item-header-content -->


<?php do_action( 'bp_before_group_activity_post_form' ) ?>

<?php /*/if ( is_user_logged_in() && bp_group_is_member() ) : ?>
	<?php locate_template( array( 'activity/post-form.php'), true ) ?>
<?php endif;*/ ?>

<?php do_action( 'bp_after_group_activity_post_form' ) ?>
<?php do_action( 'bp_before_group_activity_content' ) ?>

<div class="activity single-group">
	<?php locate_template( array( 'activity/activity-loop.php' ), true ) ?>
</div><!-- .activity -->

<?php do_action( 'bp_after_group_activity_content' ) ?>

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