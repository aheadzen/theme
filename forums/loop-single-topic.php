<?php

/**
 * Topics Loop - Single
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<ul id="bbp-topic-<?php bbp_topic_id(); ?>" <?php bbp_topic_class(); ?>>

	<li class="bbp-topic-title">

		<?php if ( bbp_is_user_home() ) : ?>

			<?php if ( bbp_is_favorites() ) : ?>

				<span class="bbp-topic-action">

					<?php do_action( 'bbp_theme_before_topic_favorites_action' ); ?>

					<?php bbp_user_favorites_link( array( 'before' => '', 'favorite' => '+', 'favorited' => '&times;' ) ); ?>

					<?php do_action( 'bbp_theme_after_topic_favorites_action' ); ?>

				</span>

			<?php elseif ( bbp_is_subscriptions() ) : ?>

				<span class="bbp-topic-action">

					<?php do_action( 'bbp_theme_before_topic_subscription_action' ); ?>

					<?php bbp_user_subscribe_link( array( 'before' => '', 'subscribe' => '+', 'unsubscribe' => '&times;' ) ); ?>

					<?php do_action( 'bbp_theme_after_topic_subscription_action' ); ?>

				</span>

			<?php endif; ?>

		<?php endif; ?>

		
		<?php bbp_topic_pagination(); ?>

		<?php do_action( 'bbp_theme_before_topic_meta' ); ?>

		<p class="bbp-topic-meta">

			<div class="bbp-topic-started-by">
			
			
			<?php /*?><span class="bbp-topic-started-in"><?php printf( __( 'in: <a href="%1$s">%2$s</a>', 'bbpress' ), bbp_get_forum_permalink( bbp_get_topic_forum_id() ), bbp_get_forum_title( bbp_get_topic_forum_id() ) ); ?></span><?php */?>
			
			
			<?php echo bbp_get_topic_author_link( array( 'size' => '14' ) ) ?></div>
			
			<div class="bbp-topic-title-div">
			<a class="bbp-topic-permalink" href="<?php bbp_topic_permalink(); ?>" title="<?php bbp_topic_title(); ?>"><?php bbp_topic_title(); ?></a>
			</div>
			
			<div class="bbp-topic-reply-count">Total responses: <?php bbp_show_lead_topic() ? bbp_topic_reply_count() : bbp_topic_post_count(); ?></div>
			
		</p>

		<?php do_action( 'bbp_theme_after_topic_meta' ); ?>

		<?php bbp_topic_row_actions(); ?>

	</li>

	

	<li class="bbp-topic-freshness">

		<p class="bbp-topic-meta">

			<?php do_action( 'bbp_theme_before_topic_freshness_author' ); ?>

			latest by  <span class="bbp-topic-freshness-author"><?php bbp_author_link( array( 'post_id' => bbp_get_topic_last_active_id(), 'size' => 0 ) ); ?></span>

			<?php do_action( 'bbp_theme_after_topic_freshness_author' ); ?>

		<br />
		<?php do_action( 'bbp_theme_before_topic_freshness_link' ); ?>

		<?php bbp_topic_freshness_link(); ?>

		<?php do_action( 'bbp_theme_after_topic_freshness_link' ); ?>

		</p>
	</li>

</ul><!-- #bbp-topic-<?php bbp_topic_id(); ?> -->
