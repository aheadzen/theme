<?php
/*
Template Name: Birth Chart
*/

require_once( CHILD_TEMPLATEPATH . '/include/classes/Atlas.php' );
require_once( CHILD_TEMPLATEPATH . '/include/classes/IndexPage.php' );
require_once( CHILD_TEMPLATEPATH . '/include/classes/functions.php' );
$current_user = wp_get_current_user();
$user_id = $current_user->ID;
$profileuser = get_userdata($user_id);

if( is_user_logged_in() )
{
	if( $_POST['action'] == 'confirmReport' )
	{
		$reportdata = array();
		$errors = confirmReport($reportdata);

		if ( !$errors->get_error_code() ) {
			$profileuser = get_userdata($user_id);
			$birth_data = unserialize( $profileuser->birth_data );
			my_future_report_delete_notifications( $user_id, 'future_report' );

			$userlink = bp_core_get_userlink( $user_id );
			$birth_chart_link = '<a href="' . get_linkTO('birth-chart/') . '">birth chart and analysis</a>';

			$aaaaa = bp_activity_add( array(
				'user_id' => $user_id,
				'action' => sprintf( __( '%s just received <strong>free</strong> %s report.', 'buddypress' ), $userlink, $birth_chart_link ),
				'component' => 'birth_chart',
				'type' => 'save_chart'
			) );
			my_future_report_generate_notifications( $user_id, $birth_data );
			$redirect_to = 'report/';
			if( isset( $_REQUEST['redirect_to'] ) && $_REQUEST['redirect_to'] !== 'chart' )
				$redirect_to = $_REQUEST['redirect_to'];
			wp_safe_redirect( $redirect_to );
			exit();
		}
	}
	if( isset( $_GET['GetLocation'] ) )
	{
		require_once( CHILD_TEMPLATEPATH . '/include/getlocation.php' );exit;
	} else if( isset( $_GET['ConfirmLocation'] ) )
	{
		require_once( CHILD_TEMPLATEPATH . '/include/confirmlocation.php' );
	} else
	{
			get_header();
			do_action( 'yit_before_primary' ) ?>
			<!-- START PRIMARY -->
			<div id="primary" class="<?php yit_sidebar_layout() ?>">
				<div class="container group">
					<div class="row">
						<?php do_action( 'yit_before_content' ) ?>
						<!-- START CONTENT -->
						<div id="content-page" class="span<?php echo yit_get_sidebar_layout() == 'sidebar-no' ? 12 : 9 ?> content group">
	        <!-- START CONTENT -->
	        <div id="content-page" class="span<?php echo yit_get_sidebar_layout() == 'sidebar-no' ? 12 : 9 ?> content group">
			
			<h1 class="btmspace"><a href="<?php echo get_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">Enter Birth Details</a></h1>
			
			<?php
			if( isset( $profileuser->birth_data ) )
			{
				$reportdata = unserialize( $profileuser->birth_data );
			}
				include(CHILD_TEMPLATEPATH."/include/errors.php");
			include(CHILD_TEMPLATEPATH."/include/reportform.php");
			?>
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
	<?php
	}
} else
{
	get_header();
	?>
	<div id="content1" style="background: #FFF url(<?php linkTO('/wp-content/themes/WP_Premium/images/myhoroscopes.png'); ?>) no-repeat center top;">
<div id="breadcrumbs">
<?php get_breadcrumb() ?>
</div>
	<?php
	echo 'Members only! Please <a href="' . wp_login_url( 'birth-chart/' ) . '">Log In</a> or <a href="' . get_linkTO( 'registration/' ) . '">Create an Account</a>.';
}

	if( $_POST['action'] == 'confirmReport' )
	{
		include(CHILD_TEMPLATEPATH."/include/placesearch.php");
	}
?>		
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
