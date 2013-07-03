<?php

/**
 * Replies Loop - Single Reply
 *
 * @package bbPress
 * @subpackage Theme
 */

?>
<div <?php bbp_reply_class(); ?>>
<div class="comment-wrap comment-author-admin">

<div>

	<div class="bbp-reply-author">
		 
		<?php do_action( 'bbp_theme_before_reply_author_details' ); ?>
		
		
		<div class="avatar-wrap">
		<?php bbp_reply_author_link( array('type' => 'avatar','size' => 80) ); ?>
		<div class="avatar-frame"></div>
		</div>

	</div><!-- .bbp-reply-author -->
	
	<div class="comment-header">
      <div class="comment-author">
	  <cite class="fn"><?php echo bbp_get_reply_author_display_name(); ?>
	  </cite>
	  </div>
      <!-- / comment-author -->
      <div class="comment-meta"> 
	  <span class="bbp-reply-post-date"><?php bbp_reply_post_date(); ?></span></div>
      <!-- / comment-meta -->
    </div>
	
	<div class="bbp-reply-content">
		
		
		<?php do_action( 'bbp_theme_before_reply_content' ); ?>

		<?php bbp_reply_content(); ?>

		<?php do_action( 'bbp_theme_after_reply_content' ); ?>

	</div><!-- .bbp-reply-content -->

</div><!-- .reply -->

<div id="post-<?php bbp_reply_id(); ?>" class="bbp-reply-header">

	<div class="bbp-meta">

		<?php /*?><span class="bbp-reply-post-date"><?php bbp_reply_post_date(); ?></span><?php */?>

		<?php if ( bbp_is_single_user_replies() ) : ?>

			<span class="bbp-header">
				<?php _e( 'in reply to: ', 'bbpress' ); ?>
				<a class="bbp-topic-permalink" href="<?php bbp_topic_permalink( bbp_get_reply_topic_id() ); ?>" title="<?php bbp_topic_title( bbp_get_reply_topic_id() ); ?>"><?php bbp_topic_title( bbp_get_reply_topic_id() ); ?></a>
			</span>

		<?php endif; ?>

		<a href="<?php bbp_reply_url(); ?>" title="<?php bbp_reply_title(); ?>" class="bbp-reply-permalink">#<?php bbp_reply_id(); ?></a>

		<?php do_action( 'bbp_theme_before_reply_admin_links' ); ?>

		<?php bbp_reply_admin_links(); ?>

		<?php do_action( 'bbp_theme_after_reply_admin_links' ); ?>

	</div><!-- .bbp-meta -->

</div><!-- #post-<?php bbp_reply_id(); ?> -->

</div>
</div>
