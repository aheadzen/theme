<?php
$current_user = wp_get_current_user();
		$user_id = $current_user->ID;
setSign($user_id);
$profileuser = get_userdata($user_id);

$url = explode( "?", $_SERVER["REQUEST_URI"] );
$urlArray = explode("/", substr( $url[0], 1, -1 ) );
//$urlArray = explode("/", substr( $url[0], 16, -1 ) );
//var_dump( $urlArray[0] );
include(CHILD_TEMPLATEPATH."/include/form-functions.php");


get_header(); ?>
<div id="content1" style="background: #FFF url(<?php linkTO('/wp-content/themes/WP_Premium/images/myhoroscopes.png'); ?>) no-repeat center top;">
<div id="breadcrumbs">
<?php get_breadcrumb() ?>
</div>
	<h1 class="btmspace"><a href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
<?php 

include(CHILD_TEMPLATEPATH."/include/errors.php");

switch( $urlArray[0] )
{
	case "login":
		if( is_user_logged_in() )
			echo 'You are already logged in as <strong>' . $profileuser->user_login . '</strong>. Please <a href="' . esc_url( wp_logout_url('/login/') ) . '">log out</a> to log in as another user.';
		else include(CHILD_TEMPLATEPATH."/include/loginform.php");
		break;
	case "registration":
		if( is_user_logged_in() )
			echo 'You are already logged in as <strong>' . $profileuser->user_login . '</strong>. Please <a href="' . esc_url( wp_logout_url('/registration/') ) . '">log out</a> to register as another user.';
		else include(CHILD_TEMPLATEPATH."/include/registerform.php");
		break;
	case "settings":
		if( !is_user_logged_in() )
			echo 'Members only! Please <a href="' . wp_login_url( 'settings/' ) . '">Log In</a> or <a href="' . get_linkTO( 'registration/' ) . '">Create an Account</a>.';
		else include(CHILD_TEMPLATEPATH."/include/settingsform.php");
		break;
}
?>		
</div>
<?php //get_sidebar(); ?>
<?php get_footer(); ?>
