<?php /* Querystring is set via AJAX in _inc/ajax.php - bp_dtheme_object_filter() */ ?>

<?php do_action( 'bp_before_groups_loop' ) ?>

<?php if ( bp_has_groups() ) : ?>

	<div class="pagination">

		<div class="pag-count" id="group-dir-count">
			<?php bp_groups_pagination_count() ?>
		</div>

		<div class="pagination-links alignright" id="group-dir-pag">
			<?php bp_groups_pagination_links() ?>
		</div>

	</div>
	<div class="clearboth"></div>
	<div id="discussions">
	<ul id="groups-list" class="item-list">
	<?php while ( bp_groups() ) : bp_the_group(); ?>
	<li>
		<div class="question-summary">
			<div class="title">
				<h3><a href="<?php bp_group_permalink() ?>" title="<?php bp_group_name() ?>"><?php bp_group_name() ?></a></h3>
				<div class="item-desc"><?php bp_group_description_excerpt() ?></div>
				<ul class="qmeta">
					<li class="alignleft">Total topics: <?php bp_group_forum_topic_count() ?></li>
					<li class="alignright"><?php bp_group_member_count(); ?></li>
				</ul>
			</div>
			<div class="clearboth" />
		</div>
	</li>

	<?php endwhile; ?>
	</ul>
	</div>
	<?php do_action( 'bp_after_groups_loop' ) ?>

<?php else: ?>

	<div id="message" class="info">
		<p><?php _e( 'There were no groups found.', 'buddypress' ) ?></p>
	</div>

<?php endif; ?>