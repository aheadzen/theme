<?php do_action( 'bp_before_group_activity_post_form' ) ?>

<?php /*/if ( is_user_logged_in() && bp_group_is_member() ) : ?>
	<?php locate_template( array( 'activity/post-form.php'), true ) ?>
<?php endif;*/ ?>

<?php do_action( 'bp_after_group_activity_post_form' ) ?>
<?php do_action( 'bp_before_group_activity_content' ) ?>

<div class="activity single-group">
	<?php locate_template( array( 'activity/activity-loop.php' ), true ) ?>
</div><!-- .activity -->

<h3 class="alignright"><a href="<?php my_permalink(BP_ACTIVITY_SLUG); ?>">more &raquo;</a></h3>
<?php do_action( 'bp_after_group_activity_content' ) ?>
<div class="clearboth"></div>