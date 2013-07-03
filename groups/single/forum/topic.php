<div id="comments-wrap">
<?php if ( bp_has_forum_topic_posts() ) : 
	$votes = voter_get(array('id' => bp_get_the_topic_id() ));
	$current_user_votes = voter_get_current_user_votes();
?>

	<form action="<?php bp_forum_topic_action() ?>" method="post" id="commentform" class="standard-form">

		<div id="topic-meta">
			<h1><a href="<?php bp_the_topic_permalink() ?>" rel="bookmark" title="<?php bp_the_topic_title(); ?>"><?php bp_the_topic_title() ?></a></h1>
			<br />
				<div class="admin-links"><a href="<?php bp_forum_permalink() ?>"><?php _e( '&laquo; Group Forum', 'buddypress' ) ?></a>
			<?php if ( bp_group_is_admin() || bp_group_is_mod() || bp_get_the_topic_is_mine() ) : ?>
				 | 
<?php bp_the_topic_admin_links() ?>
			<?php endif; ?>
			</div>
			<div class="admin-links">
				<a href="<?php bp_group_permalink() ?>" rel="bookmark" title="<?php bp_group_name() ?>">&laquo; Group: <?php bp_group_name() ?></a>
			</div>
		</div>
		<div>
		<div class="alignleft" style="margin-top: 25px;">
			<a class="button" href="<?php my_topic_reply_link() ?>"><?php _e( 'Reply', 'buddypress' ) ?></a>

		</div>
		<div class="alignright">
			<div style="height: 25px;">
				<small>
					<?php bp_the_topic_pagination_count() ?>
				</small>
			</div>

			<div class="alignright" id="topic-pag">
				<?php bp_the_topic_pagination() ?>
			</div>

		</div></div>
		<div class="clearboth"></div>
		<ul id="topic-post-list" class="">
			<?php while ( bp_forum_topic_posts() ) : bp_the_forum_topic_post(); ?>

		<li id="post-<?php bp_the_topic_post_id() ?>">
		<div id="commentlist">
			<div class="comment-avatar">
			<a href="<?php bp_the_topic_post_poster_link(); ?>">
				<?php bp_the_topic_post_poster_avatar( 'width=50&height=50' ); ?>
			</a>
			</div>
			<div class="comment-content">
			
				<strong><cite id="comments">
					<?php bp_the_topic_post_poster_name() ?>
				</cite></strong> :
				<a href="#post-<?php bp_the_topic_post_id() ?>" style="font-size: 10px; text-decoration: none;" id="commentnum" title="<?php _e( 'Permanent link to this post', 'buddypress' ); ?>"><?php bp_the_topic_post_time_since(); ?></a>
				
				<div class="alignleft" style="width: 450px;">
				<div class="post-content">
					<?php bp_the_topic_post_content() ?>
				</div>

				<div class="admin-links">
					<?php if ( bp_group_is_admin() || bp_group_is_mod() || bp_get_the_topic_post_is_mine() ) : ?>
						<?php bp_the_topic_post_admin_links() ?>
					<?php endif; ?>
				</div>
				</div>
				<div class="vote alignright">
					<?php voter_vote_link( bp_get_the_topic_post_id(), 'up', $current_user_votes ); ?>
						<span class="vote-count-post">
							<?php echo voter_get_post_votes(bp_get_the_topic_post_id(), $votes); ?>
						</span>
						<?php voter_vote_link( bp_get_the_topic_post_id(), 'down', $current_user_votes ); ?>
				</div>
			</div>
			
			<div class="clearboth"></div>
		</div>
		</li>

			<?php endwhile; ?>
		</ul>
		<div>
		<div class="alignleft" style="margin-top: 25px;">
			<a class="button" href="<?php my_topic_reply_link() ?>"><?php _e( 'Reply', 'buddypress' ) ?></a>

		</div>
		<div class="alignright">
			<div style="height: 25px;">
				<small>
					<?php bp_the_topic_pagination_count() ?>
				</small>
			</div>

			<div class="alignright" id="topic-pag">
				<?php bp_the_topic_pagination() ?>
			</div>

		</div></div>
		<div class="clearboth"></div>

	
	<div id="post-topic-reply">
	<p id="post-reply"></p>
	<br />
	<h6 class="postcomment">Add a reply</h6>
		<?php locate_template( array( 'include/membership.php' ), true );

		if ( ( is_user_logged_in() && 'public' == bp_get_group_status() ) || bp_group_is_member() ) : ?>

			<?php if ( bp_get_the_topic_is_last_page() ) : ?>

				<?php if ( bp_get_the_topic_is_topic_open() ) : ?>


						<?php if ( !bp_group_is_member() ) : ?>
							<p><?php _e( 'You will auto join this group when you reply to this topic.', 'buddypress' ) ?></p>
						<?php endif; ?>

						<?php do_action( 'groups_forum_new_reply_before' ) ?>

						<textarea name="reply_text" id="reply_text"></textarea>

						<div class="submit">
							<input type="submit" name="submit_reply" id="submit" value="<?php _e( 'Post Reply', 'buddypress' ) ?>" />
						</div>

						<?php do_action( 'groups_forum_new_reply_after' ) ?>

						<?php wp_nonce_field( 'bp_forums_new_reply' ) ?>
					

				<?php else : ?>

					<div id="message" class="info">
						<p><?php _e( 'This topic is closed, replies are no longer accepted.', 'buddypress' ) ?></p>
					</div>

				<?php endif; ?>

			<?php endif; ?>

		<?php endif; ?>
		</div>

	</form>
<?php else: ?>

	<div id="message" class="info">
		<p><?php _e( 'There are no posts for this topic.', 'buddypress' ) ?></p>
	</div>

<?php endif;?>
</div>