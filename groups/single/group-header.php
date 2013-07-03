<?php

do_action( 'bp_before_group_header' );

?>
<h1 class="btmspace" id="group-<?php bp_group_ID(); ?>"><a href="<?php bp_group_permalink() ?>" rel="bookmark" title="<?php bp_group_name() ?>"><?php bp_group_name() ?></a></h1>

<?php if( bp_is_group_home() )
{
	?>
<div id="item-header-avatar" class="alignleft">
	<a href="<?php bp_group_permalink(); ?>" title="<?php bp_group_name(); ?>">

		<?php bp_group_avatar(); ?>

	</a>
	<div class="highlight"><?php bp_group_type(); ?></div>
	<div class="activity"><?php printf( __( 'active %s', 'buddypress' ), bp_get_group_last_active() ); ?></div>

		<div id="item-actions">

	<?php if ( bp_group_is_visible() ) : ?>

		<h4><?php _e( 'Group Admins', 'buddypress' ); ?></h4>

		<?php 
		bp_group_list_admins();
		
		global $groups_template;
		if($groups_template && $groups_template->group->admins[0])
		{
			$admin = $groups_template->group->admins[0];
		?>
		<a href="<?php echo bp_core_get_user_domain( $admin->user_id, $admin->user_nicename, $admin->user_login ) ?>" class="groupadmin"><?php echo $admin->user_login;?></a>
		<?php
		}
		
		do_action( 'bp_after_group_menu_admins' );

		if ( bp_group_has_moderators() ) :
			do_action( 'bp_before_group_menu_mods' ); ?>

			<h4><?php _e( 'Group Mods' , 'buddypress' ) ?></h4>

			<?php bp_group_list_mods();

			do_action( 'bp_after_group_menu_mods' );

		endif;

	endif; ?>

	</div><!-- #item-actions -->

</div><!-- #item-header-avatar -->

<div id="item-header-content" class="alignright">

	<?php do_action( 'bp_before_group_header_meta' ); ?>
<div id="item-header-content">
			<?php do_action( 'bp_group_header_actions' ); ?>


</div><!-- #item-header-content -->
	<div id="item-meta">
		<div id="item-buttons">
			<ul>
				<li><?php bp_group_join_button(); ?></li>
				<li><?php my_group_new_topic_button(); ?></li>
			</ul>

			<div class="clearboth"></div>
		</div><!-- #item-buttons -->
		<?php bp_group_description(); ?>



		<?php do_action( 'bp_group_header_meta' ); ?>

	</div>
</div><!-- #item-header-content -->
<?php } ?>
<div class="clearboth"></div>
<?php
do_action( 'bp_after_group_header' );
?>