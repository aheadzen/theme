<?php if ( function_exists('bp_has_forum_topics') && bp_has_forum_topics() ) : ?>

	<div class="pagination">

		<div id="post-count" class="pag-count">
			<?php
			my_forum_view_all_or_pagination();			?>

		</div>

	</div>

<?php else: ?>

	<div id="message" class="info">
		<p><?php _e( 'Sorry, there were no forum topics found.', 'buddypress' ) ?></p>
	</div>

<?php endif;?>
<div class="clearboth"></div>

<?php while ( function_exists('bp_forum_topics') &&  bp_forum_topics() ) : bp_the_forum_topic(); ?>
	<div class="question-summary">
		<div class="comment-avatar">
			<a href="<?php bp_the_topic_object_permalink(); ?>"><?php bp_the_topic_object_avatar( array( 'alt' => bp_get_the_topic_object_name() ) ); ?>
			</a>
		</div>
		<div class="comment-content">
			<div class="title">
				<h3><a href="<?php bp_the_topic_permalink() ?>" title="<?php bp_the_topic_title() ?>"><?php bp_the_topic_title() ?></a></h3>
				<div class="alignleft">
					<div>Total responses: <?php bp_the_topic_total_posts() ?></div>
					<?php if( !bp_is_group() ) { ?>
					<div>Group: <a href="<?php my_the_topic_group_permalink() ?>" title="<?php bp_the_topic_object_name() ?>"><?php bp_the_topic_object_name() ?></a></div>
					<?php } ?>
				</div>
				<div class="alignright">
					<div>latest by <?php bp_the_topic_last_poster_name() ?></div>
					<div><small><?php bp_the_topic_time_since_last_post() ?></small></div>
				</div>
			</div>
		</div>
		<div class="clearboth"></div>
	</div>
<?php endwhile; ?>
<?php my_forum_view_all_or_pagination(); ?>
<div class="clearboth"></div>
