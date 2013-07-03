<?php
remove_action( 'wp_footer', 'wp_admin_bar_render', 100);
add_action( 'bp_before_header', 'wp_admin_bar_render', 1 );
add_action( 'admin_bar_init', 'my_admin_bar_init' );
//add_theme_support( 'admin-bar', array( 'callback' => '__return_false') );
add_filter( 'show_admin_bar', '__return_true' , 1000 );

function my_admin_bar_init()
{
	wp_dequeue_script( 'admin-bar' );
	wp_dequeue_style( 'admin-bar' );
}
function remove_admin_bar_links() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('wp-logo');
	$wp_admin_bar->remove_menu('my-account');
	$wp_admin_bar->remove_menu('search');
	$wp_admin_bar->remove_menu('bp-notifications');
	$wp_admin_bar->remove_menu('site-name');
	$wp_admin_bar->remove_menu('user-info');
	$wp_admin_bar->remove_menu('edit-profile');
	$wp_admin_bar->remove_menu('logout');
	$wp_admin_bar->remove_menu('updates');
	$wp_admin_bar->remove_menu('comments');
	$wp_admin_bar->remove_menu('new-content');
	$wp_admin_bar->remove_menu('group-admin');
	$wp_admin_bar->remove_menu('user-admin');
	$wp_admin_bar->remove_menu('log-in');
	$wp_admin_bar->remove_menu('delete-cache');
	$wp_admin_bar->remove_menu('vp-notice');

$wp_admin_bar->add_menu( array(
		'id'    => 'wp-logo-id',
		'title' => 'Home',
		'href'  => get_linkTO('/'),
		'meta'  => array(
			'title' => __('About WordPress'),
		),
	) );

	if( is_user_logged_in() )
	{
		if ( $notifications = bp_core_get_notifications_for_user( bp_loggedin_user_id(), 'object' ) ) {
			$menu_title = sprintf( __( 'Notifications <span id="ab-pending-notifications" class="pending-count">%s</span>', 'buddypress' ), count( $notifications ) );
		} else {
			$menu_title = __( 'Notifications', 'buddypress' );
		}


		$wp_admin_bar->add_menu( array(
			'id'    => 'bp-notifications',
			'title'  => $menu_title,
			'href'   => bp_loggedin_user_domain()
			) );
		if ( !empty( $notifications ) ) {
			foreach ( (array)$notifications as $notification ) {
				$wp_admin_bar->add_menu( array(
					'parent' => 'bp-notifications',
					'id'     => 'notification-' . $notification->id,
					'title'  => $notification->content,
					'href'   => $notification->href
				) );
			}
		} else {
			$wp_admin_bar->add_menu( array(
				'parent' => 'bp-notifications',
				'id'     => 'no-notifications',
				'title'  => __( 'No new notifications', 'buddypress' ),
				'href'   => bp_loggedin_user_domain()
			) );
		}

	}

if (time() % 2 )
{
	$newQuestionText = 'Ask Questions';
	$newQuestionUrl = 'http://ask-oracle.oranum.com/';
}
else 
{
	$newQuestionText = 'Psychic Chat';
	$newQuestionUrl = 'http://ask-oracle.oranum.com/';
}

$wp_admin_bar->add_menu( array(
		'id'    => 'new-question',
		'title' => $newQuestionText,
		'href'  => $newQuestionUrl,
		'meta'  => array(
			'title' => __('Post Questions. Get Answers. Discuss.'),
		),
	) );

/*$form  = '<form action="' . get_linkTO('search/') . '" method="get" id="cse-search-box">';
	$form .= '<div id="searchform">';
	$form .= '<input type="text" name="q"  id="s" value="' . $_REQUEST['q'] . '" />';
	$form .= '<input type="submit" name="sa" id="sa" value="" />';
	$form .= ' </div></form>';

	$wp_admin_bar->add_menu( array(
		'id'     => 'my-search',
		'title'  => $form,
	) );*/

	if( !is_user_logged_in() )
	{
		$wp_admin_bar->add_menu( array(
		'id'        => 'bp-login',
		'parent'    => 'top-secondary',
		'title'    => 'Log In',
		'href'     => get_linkTO('my-account/')
		//'href'  => wp_login_url()
		
		) );

		$wp_admin_bar->add_menu( array(
			'id'        => 'bp-register',
			'parent'    => 'top-secondary',
			'title'     => 'Free Sign Up',
			'href'     => get_linkTO('registration/')
		) );

	} else
	{
		$wp_admin_bar->add_menu( array(
			'id'        => 'logout',
			'parent'    => 'top-secondary',
			'title'     => 'Log out',
			'href'     => wp_logout_url('/')
		) );
	}

	$user_id      = get_current_user_id();
	$current_user = wp_get_current_user();
	$profile_url  = get_edit_profile_url( $user_id );

	if ( ! $user_id )
		return;
	$avatar = bp_get_loggedin_user_avatar(array('width'  => 20,'height' => 20));
	$class  = empty( $avatar ) ? '' : 'with-avatar';

	$wp_admin_bar->add_menu( array(
		'id'        => 'my-account-id',
		'parent'    => 'top-secondary',
		'title'     => $avatar . mybar_shorten( bp_get_loggedin_user_fullname() ) . ' &#9660;',
		'href'      => bp_get_loggedin_user_link(),
		'meta'      => array(
			'class'     => $class,
			'title'     => __('My Account'),
		),
	) );

	$wp_admin_bar->add_group( array(
		'parent' => 'my-account-id',
		'id'     => 'user-actions',
	) );

	$user_info  = '<div class="bbuser_info_admintop">';
	$user_info  .= '<div class="alignleft"><div><a title="Upload Avatar" href="' . bp_get_loggedin_user_link( ) . BP_XPROFILE_SLUG . '/change-avatar/">' . get_avatar( $user_id );
	$user_info  .= '</a></div><span class="username"><a title="Upload Avatar" href="' . bp_get_loggedin_user_link( ) . BP_XPROFILE_SLUG . '/change-avatar/">Change Photo</a></span>';
	$user_info  .= '</div>';
	$user_info .= '<div class="alignright"><span class="display-name">' . mybar_shorten( bp_get_loggedin_user_fullname() ) . '</span>';
	
	if ( $current_user->display_name !== $current_user->user_nicename )
		$user_info .= '<span class="username">' . mybar_shorten( $current_user->user_nicename ) . '</span>';
		$user_info .= '<span class="username">' . mybar_shorten( $current_user->user_email ). '</span>';
		$user_info .= '<span class="username"><a href="' . $profile_url . '">Edit Profile</a></span>';
		$user_info .= '<span class="username"><a href="' . bp_get_loggedin_user_link() . 'settings/">Account Settings</a></span>';
		$user_info .= '<span class="username"><a href="' . wp_logout_url('/') . '">Log out</a></span>';
		$user_info .= '</div><div class="clearboth"></div>';

	$user_info .= '</div>';
	
	$wp_admin_bar->add_menu( array(
		'parent' => 'user-actions',
		'id'     => 'user-info',
		'title'  => $user_info
	) );
		$wp_admin_bar->add_menu( array(
			'parent'    => 'my-account-id',
			'id'        => 'my-account-buddypress',
			'title'     => __( 'My Account' ),
			'group'     => true,
			'meta'      => array(
			'class' => 'ab-sub-secondary'
			)
		) );

}
add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );
?>