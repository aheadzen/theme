<h2><a href="<?php my_permalink(BP_ACTIVITY_SLUG); ?>">Updates &raquo;</a></h2>
	<?php locate_template( array( 'groups/single/activity-widget.php' ), true ) ?>

<p class="dottedBottomBorder"></p>
<?php if(function_exists('bp_forum_permalink')){ ?><h2><a href="<?php bp_forum_permalink();?>">Discussions &raquo;</a></h2><?php }?>

<?php if ( bp_is_group_forum_topic_edit() ) : ?>
	<?php locate_template( array( 'groups/single/forum/edit.php' ), true ) ?>

<?php elseif ( bp_is_group_forum_topic() ) : ?>
	<?php locate_template( array( 'groups/single/forum/topic.php' ), true ) ?>

<?php else : ?>

	<div class="forums single-forum">
		<?php locate_template( array( 'forums/forums-loop.php' ), true ) ?>
	</div><!-- .forums -->

	<?php do_action( 'bp_after_group_forum_content' ) ?>
<?php endif; ?>