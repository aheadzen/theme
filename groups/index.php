<?php get_header();
do_action( 'yit_before_primary' ) ?>
<!-- START PRIMARY -->
<div id="primary" class="<?php yit_sidebar_layout() ?>">
    <div class="container group">
	    <div class="row">
	        <?php do_action( 'yit_before_content' ) ?>
	        <!-- START CONTENT -->
	        <div id="content-page" class="span<?php echo yit_get_sidebar_layout() == 'sidebar-no' ? 12 : 9 ?> content group">
			
<div id="content1" class="groups">
	<div id="breadcrumbs">
	<?php get_breadcrumb() ?>
	</div>

	<h1 class="btmspace"><a href="<?php linkTo( BP_GROUPS_SLUG ); ?>/" rel="bookmark">Groups Directory</a>
	
	<?php if ( is_user_logged_in() && current_user_can('manage_options') ) : ?><a class="button groupdir_button" href="<?php echo bp_get_root_domain() . '/' . BP_GROUPS_SLUG . '/create/' ?>"><?php _e( 'Create a Group', 'buddypress' ) ?></a><?php endif; ?>
	</h1>
	<div style="width:100%; clear:both;"></div>

			<div id="group-dir-search" class="dir-search alignright">
				<form action="" method="get" id="search-groups-form">
					<?php 	$search_value = '';
							if ( !empty( $_REQUEST['s'] ) )
							 	$search_value = $_REQUEST['s'];
					?>
					<input type="text" name="s" id="groups_search" value="<?php echo esc_attr($search_value); ?>"/>
					<input type="submit" id="groups_search_submit" name="groups_search_submit" value="<?php _e( 'Search Groups', 'buddypress' ) ?>" />
				</form>
			</div><!-- #group-dir-search -->
			<div class="clearboth"></div>

		<form action="" method="post" id="groups-directory-form" class="dir-form">

			<div id="groups-dir-list" class="dir-list">
				<?php locate_template( array( 'groups/groups-loop.php' ), true ) ?>
			</div><!-- #groups-dir-list -->

			<?php do_action( 'bp_directory_groups_content' ) ?>

			<?php wp_nonce_field( 'directory_groups', '_wpnonce-groups-filter' ) ?>

		</form><!-- #groups-directory-form -->

		<?php do_action( 'bp_after_directory_groups_content' ) ?>

</div>

</div>
	        <!-- END CONTENT -->
	        <?php do_action( 'yit_after_content' ) ?>
	        
	        <?php get_sidebar() ?>
	        
	        <?php do_action( 'yit_after_sidebar' ) ?>
	        
	        <!-- START EXTRA CONTENT -->
	        <?php do_action( 'yit_extra_content' ) ?>
	        <!-- END EXTRA CONTENT -->
		</div>
    </div>
</div>
<!-- END PRIMARY -->
<?php
do_action( 'yit_after_primary' );
get_footer() ?>