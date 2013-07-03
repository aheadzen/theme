<?php /* This template is used by activity-loop.php and AJAX functions to show each activity */ ?>

<?php do_action( 'bp_before_activity_entry' ) ?>

<li class="<?php //bp_activity_css_class() ?>" id="activity-<?php bp_activity_id() ?>">
	
	<div class="activity-content comment-wrap" id="commentlist">
		<div class="activity-avatar alignleft">
			<a href="<?php bp_activity_user_link(); ?>">
			<div class="avatar-wrap">
				<?php bp_activity_avatar(); ?>
			<div class="avatar-frame"></div>
			</div>
				
			</a>
		</div>
		<div class="activity-content1">
			<div class="activity-header">

				<span>
					<?php my_insert_activity_header(); ?>
				</span>
				
			</div>
			<?php if( strstr($_SERVER['REQUEST_URI'],'/mentions/'))
			{
				
			}else{?>
			<?php if ( bp_activity_can_comment() ){?>
				<div class="alignright actvcommentslink"><a href="javascript:showhidecomments('activity_comments_<?php bp_activity_id() ?>');" class="button fav bp-secondary-action">Add Comments</a></div>
				<?php }?>
			<?php }?>
			
			<?php if ( bp_get_activity_content_body() ) : ?>
				<div class="activity-inner">
					<?php bp_activity_content_body(); ?>
					
					<small>
					<?php my_insert_activity_meta(); ?>

					<?php if ( bp_activity_user_can_delete() )
						{
							echo ' &middot; ';
							bp_activity_delete_link();
						}
					?>
					<?php if ( bp_activity_can_comment() ) : ?>

					 &middot; <a rel="nofollow" href="<?php bp_activity_comment_link(); ?>" onclick="showhidecomments('activity_comments_<?php bp_activity_id() ?>');" class="button acomment-reply bp-primary-action" id="acomment-comment-<?php bp_activity_id(); ?>"><?php printf( __( 'Comment <span>[%s]</span>', 'buddypress' ), bp_activity_get_comment_count() ); ?></a>

				<?php endif; ?>

				<?php do_action( 'bp_activity_entry_meta' ); ?>
				<div class="alignright">
				<?php if ( bp_activity_can_favorite() ) : ?>

					<?php if ( !bp_get_activity_is_favorite() ) : ?>

						<a rel="nofollow" href="<?php bp_activity_favorite_link(); ?>" class="button fav bp-secondary-action" title="<?php esc_attr_e( 'Mark as Favorite', 'buddypress' ); ?>"><?php _e( 'Favorite', 'buddypress' ) ?></a>

					<?php else : ?>

						<a rel="nofollow" href="<?php bp_activity_unfavorite_link(); ?>" class="button unfav bp-secondary-action" title="<?php esc_attr_e( 'Remove Favorite', 'buddypress' ); ?>"><?php _e( 'Remove Favorite', 'buddypress' ) ?></a>

					<?php endif; ?>

				<?php endif; ?>
				</div>
					</small>
				</div>
			<?php endif; ?>

			<?php do_action( 'bp_activity_entry_content' ) ?>
		</div>
		<div class="clearboth"></div>
	</div>


	<?php if ( 'activity_comment' == bp_get_activity_type() ) : ?>
		<div class="activity-inreplyto">
			<strong><?php _e( 'In reply to', 'buddypress' ) ?></strong> - <?php bp_activity_parent_content() ?> &middot;
			<a href="<?php bp_activity_thread_permalink() ?>" class="view" title="<?php _e( 'View Thread / Permalink', 'buddypress' ) ?>"><?php _e( 'View', 'buddypress' ) ?></a>
		</div>
	<?php endif; ?>

	<?php do_action( 'bp_before_activity_entry_comments' ) ?>

	<?php if ( bp_activity_can_comment() ) : ?>
		<div class="children">
		<div class="activity-comments comment-author-admin">
			<?php bp_activity_comments() ?>

			<?php if ( is_user_logged_in() ) : ?>
				<div id="activity_comments_<?php bp_activity_id() ?>" style="display:none;">
				<form action="<?php bp_activity_comment_form_action(); ?>" method="post" id="ac-form-<?php bp_activity_id(); ?>" class="ac-form"<?php bp_activity_comment_form_nojs_display(); ?>>
					<div class="ac-reply-avatar alignleft"><?php bp_loggedin_user_avatar( 'width=' . BP_AVATAR_THUMB_WIDTH . '&height=' . BP_AVATAR_THUMB_HEIGHT ); ?></div>
					<div class="ac-reply-content alignright">
						<div class="ac-textarea">
							<textarea id="ac-input-<?php bp_activity_id(); ?>" class="ac-input" name="ac_input_<?php bp_activity_id(); ?>"></textarea>
						</div>
						<input type="submit" class="ac-form-submit" name="ac_form_submit" value="<?php _e( 'Post', 'buddypress' ); ?>" /><div class="loader ui-autocomplete-loading" id="loader-<?php bp_activity_id(); ?>"></div>
						<input type="hidden" name="comment_form_id" value="<?php bp_activity_id(); ?>" />
					</div>

					<?php do_action( 'bp_activity_entry_comments' ); ?>

					<?php wp_nonce_field( 'new_activity_comment', '_wpnonce_new_activity_comment' ); ?>
					<div class="clearboth"></div>
				</form>
				</div>

			<?php endif; ?>

		</div>
		</div>
	<?php endif; ?>

	<?php do_action( 'bp_after_activity_entry_comments' ) ?>
</li>
<?php do_action( 'bp_after_activity_entry' ) ?>
