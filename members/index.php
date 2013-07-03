<?php
get_header();
do_action( 'yit_before_primary' ) ?>
<!-- START PRIMARY -->
<div id="primary" class="<?php yit_sidebar_layout() ?>">
    <div class="container group">
	    <div class="row">
	        <?php do_action( 'yit_before_content' ) ?>
	        <!-- START CONTENT -->
	        <div id="content-page" class="span<?php echo yit_get_sidebar_layout() == 'sidebar-no' ? 12 : 9 ?> content group">
		<div class="slogan">
			<h2><?php the_title();?></h2>
			<div class="border margin-top"></div>
			<div class="border"></div>
			<div class="border"></div> 
		</div>
		

<div id="content1" class="members">
	<div id="breadcrumbs">
	<?php get_breadcrumb( 'Members' ); ?>
	</div>

	<h1 class="btmspace"><a href="<?php linkTo( BP_MEMBERS_SLUG ); ?>/" rel="bookmark">Members Directory</a></h1>

			<div id="members-dir-search" class="dir-search alignright">
				<form action="" method="get" id="search-members-form" class="dir-form">
					<?php 	$search_value = '';
							if ( !empty( $_REQUEST['s'] ) )
							 	$search_value = $_REQUEST['s'];
					?>
					<input type="text" name="s" id="members_search" value="<?php echo esc_attr($search_value); ?>"/>
					<input type="submit" id="members_search_submit" name="members_search_submit" value="<?php _e( 'Search Members', 'buddypress' ) ?>" />
				</form>
			</div><!-- #members-dir-search -->
			<div class="clearboth"></div>

			<div id="members-dir-list" class="dir-list">
				<?php locate_template( array( 'members/members-loop.php' ), true ) ?>
			</div><!-- #members-dir-list -->


	</div><!-- #content -->

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