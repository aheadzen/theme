<?php if ( bp_is_group_forum_topic_edit() ) : ?>
	<?php locate_template( array( 'groups/single/forum/edit.php' ), true ) ?>

<?php elseif ( bp_is_group_forum_topic() ) : ?>
	<?php locate_template( array( 'groups/single/forum/topic.php' ), true ) ?>

<?php else : ?>

	<div class="forums single-forum">
		<?php locate_template( array( 'forums/forums-loop.php' ), true ) ?>
	</div><!-- .forums -->

	<?php do_action( 'bp_after_group_forum_content' ) ?>
<div id="post-new">
	<h6 class="postcomment">Start a New Topic</h6>
		<?php locate_template( array( 'include/membership.php' ), true );
		
		if ( ( is_user_logged_in() && 'public' == bp_get_group_status() ) || bp_group_is_member() ) : ?>

				<?php if ( !bp_group_is_member() ) : ?>
					<p><?php _e( 'You will auto join this group when you start a new topic.', 'buddypress' ) ?></p>
				<?php endif; ?>

		<form action="" method="post" id="commentform" class="standard-form">
	<ul id="formElements">

				<li><label><strong><?php _e( 'Title:', 'buddypress' ) ?></strong><br />
				<input type="text" name="topic_title" id="topic_title" value="" /></label>
</li>
	<li><label><strong><?php _e( 'Content:', 'buddypress' ) ?></strong><br />
				<textarea name="topic_text" id="topic_text"></textarea></label>
</li>
	<li><label><strong><?php _e( 'Tags (comma separated):', 'buddypress' ) ?></strong><br />
				<input type="text" name="topic_tags" id="topic_tags" value="" /></label>
</li>
<li>
	<input type="submit" name="submit_topic" id="submit" value="<?php _e( 'Post Topic', 'buddypress' ) ?>" />
</li>
	<input type="hidden" name="topic_group_id" value="<?php echo bp_get_group_id(); ?>" />


				<?php wp_nonce_field( 'bp_forums_new_topic' ) ?>
		</form>

	<?php endif; ?>
</div>

<?php endif; ?>