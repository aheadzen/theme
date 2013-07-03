<?php

/**
 * Replies Loop
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php do_action( 'bbp_template_before_replies_loop' ); ?>

<ul id="topic-<?php bbp_topic_id(); ?>-replies" class="forums bbp-replies">

	<?php /*?><li class="bbp-header">

		<div class="bbp-reply-author"><?php  _e( 'Author',  'bbpress' ); ?></div><!-- .bbp-reply-author -->

		<div class="bbp-reply-content">

			<?php if ( !bbp_show_lead_topic() ) : ?>

				<?php _e( 'Posts', 'bbpress' ); ?>

				<?php bbp_user_subscribe_link(); ?>

				<?php bbp_user_favorites_link(); ?>

			<?php else : ?>

				<?php _e( 'Replies', 'bbpress' ); ?>

			<?php endif; ?>

		</div><!-- .bbp-reply-content -->

	</li><!-- .bbp-header -->
<?php */?>
	<li class="bbp-body">
	<div class="comment">

		<?php while ( bbp_replies() ) : bbp_the_reply(); ?>

			<?php bbp_get_template_part( 'loop', 'single-reply' ); ?>

		<?php endwhile; ?>

	</li><!-- .bbp-body -->
	<div class="comment">
	
	<?php /*?><li class="bbp-footer">

		<div class="bbp-reply-author"><?php  _e( 'Author',  'bbpress' ); ?></div>

		<div class="bbp-reply-content">

			<?php if ( !bbp_show_lead_topic() ) : ?>

				<?php _e( 'Posts', 'bbpress' ); ?>

			<?php else : ?>

				<?php _e( 'Replies', 'bbpress' ); ?>

			<?php endif; ?>

		</div><!-- .bbp-reply-content -->

	</li><!-- .bbp-footer --><?php */?>

</ul><!-- #topic-<?php bbp_topic_id(); ?>-replies -->

<?php do_action( 'bbp_template_after_replies_loop' ); ?>
