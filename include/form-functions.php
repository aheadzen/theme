<?php

switch( $urlArray[0] )
{
	case "login":
		$secure_cookie = false;
		$user = wp_signon('', $secure_cookie);

		$redirect_to = 'home/';
		if ( isset( $_REQUEST['redirect_to'] ) )
			$redirect_to = $_REQUEST['redirect_to'];

		if ( !is_wp_error($user) ) {
			wp_safe_redirect( $redirect_to );
			exit();
		}

		$errors = $user;

		// If cookies are disabled we can't log in even with a valid user+pass
/*		if ( isset($_POST['testcookie']) && empty($_COOKIE[TEST_COOKIE]) )
			$errors->add('test_cookie', __("<strong>ERROR</strong>: Cookies are blocked or not supported by your browser. You must <a href='http://www.google.com/cookies.html'>enable cookies</a> to be a member of Ask-Oracle.com"));
*/
		// Some parts of this script use the main login form to display a message
		if		( isset($_GET['loggedout']) && TRUE == $_GET['loggedout'] )
			$errors->add('loggedout', __('You are now logged out.'), 'message');
		elseif	( isset($_GET['registration']) && 'disabled' == $_GET['registration'] )
			$errors->add('registerdisabled', __('User registration is currently not allowed.'));
		elseif	( isset($_GET['checkemail']) && 'confirm' == $_GET['checkemail'] )
			$errors->add('confirm', __('Check your e-mail for the confirmation link.'), 'message');
		elseif	( isset($_GET['checkemail']) && 'newpass' == $_GET['checkemail'] )
			$errors->add('newpass', __('Check your e-mail for your new password.'), 'message');
		elseif	( isset($_GET['checkemail']) && 'registered' == $_GET['checkemail'] )
			$errors->add('registered', __('Registration complete. Please check your e-mail.'), 'message');
		elseif	( $interim_login )
			$errors->add('expired', __('Your session has expired. Please log-in again.'), 'message');
		$wp_error = $errors;

		if ( isset($_POST['log']) )
			$user_login = ( 'incorrect_password' == $errors->get_error_code() || 'empty_password' == $errors->get_error_code() ) ? esc_attr(stripslashes($_POST['log'])) : '';
		break;
	case "registration":
		$action = $_POST['action'];
		if( $action == 'register' )
		{
			$user_login = '';
			$user_email = '';
			require_once( ABSPATH . WPINC . '/registration.php');

			$user_login = $_POST['user_login'];
			$user_email = $_POST['user_email'];
			$month		= (int)( $_POST['mm'] );
			$day		= (int)( $_POST['dd'] );
			$yyyy		= (int)( $_POST['yyyy'] );

			$errors = new WP_Error();

			$user_login = sanitize_user( $user_login );
			$user_email = apply_filters( 'user_registration_email', $user_email );

			// Check the username
			if ( $user_login == '' )
				$errors->add('empty_username', __('<strong>ERROR</strong>: Please enter a username.'));
			elseif ( !validate_username( $user_login ) ) {
				$errors->add('invalid_username', __('<strong>ERROR</strong>: This username is invalid.  Please enter a valid username.'));
				$user_login = '';
			} elseif ( username_exists( $user_login ) )
				$errors->add('username_exists', __('<strong>ERROR</strong>: This username is already registered, please choose another one.'));

			// Check the e-mail address
			if ($user_email == '') {
				$errors->add('empty_email', __('<strong>ERROR</strong>: Please type your e-mail address.'));
			} elseif ( !is_email( $user_email ) ) {
				$errors->add('invalid_email', __('<strong>ERROR</strong>: The email address isn&#8217;t correct.'));
				$user_email = '';
			} elseif ( email_exists( $user_email ) )
				$errors->add('email_exists', __('<strong>ERROR</strong>: This email is already registered, please choose another one.'));

			$pass1 = $pass2 = '';
			if ( isset( $_POST['pass1'] ))
				$pass1 = $_POST['pass1'];
			if ( isset( $_POST['pass2'] ))
				$pass2 = $_POST['pass2'];
			
			if ( empty($pass1) && !empty($pass2) )
				$errors->add( 'pass', __( '<strong>ERROR</strong>: You entered your new password only once.' ), array( 'form-field' => 'pass1' ) );
			elseif ( !empty($pass1) && empty($pass2) )
				$errors->add( 'pass', __( '<strong>ERROR</strong>: You entered your new password only once.' ), array( 'form-field' => 'pass2' ) );
			if ( empty($pass1) )
				$errors->add( 'pass', __( '<strong>ERROR</strong>: Please enter your password.' ), array( 'form-field' => 'pass1' ) );
			elseif ( empty($pass2) )
				$errors->add( 'pass', __( '<strong>ERROR</strong>: Please enter your password twice.' ), array( 'form-field' => 'pass2' ) );

			if ( false !== strpos( stripslashes($pass1), "\\" ) )
				$errors->add( 'pass', __( '<strong>ERROR</strong>: Passwords may not contain the character "\\".' ), array( 'form-field' => 'pass1' ) );

			/* checking the password has been typed twice the same */
			if ( $pass1 != $pass2 )
				$errors->add( 'pass', __( '<strong>ERROR</strong>: Please enter the same password in the two password fields.' ), array( 'form-field' => 'pass1' ) );

			if ( isset( $_POST['user_name'] ) )
				$user_name = sanitize_text_field( $_POST['user_name'] );

			if ( empty( $month ) || $month < 1 || $month > 12 )
				$errors->add( 'month', __( '<strong>ERROR</strong>: Please select a valid month.' ), array( 'form-field' => 'mm' ) );

			if ( empty( $day ) || $day < 1 || $day > 31 )
				$errors->add( 'month', __( '<strong>ERROR</strong>: Please select a valid day.' ), array( 'form-field' => 'dd' ) );

			if ( empty( $yyyy ) || $yyyy < 1900 || $yyyy > 2013 )
				$errors->add( 'yyyy', __( '<strong>ERROR</strong>: Please enter a valid year.' ), array( 'form-field' => 'yyyy' ) );

			/* Spam Check 1 - Honey Pots */

			if( !empty( $_POST['url'] ) )
			{
				$errors->add('spam_trigger', __('<strong>ERROR</strong>: Please leave the spam check field blank'));
/*				$message = sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
				$message .= sprintf(__('E-mail: %s'), $user_email) . "\r\n";
				$message .= sprintf(__('Password: %s'), $pass1) . "\r\n";
				$message .= sprintf(__('URL: %s'), $_POST['url']) . "\r\n";

				@wp_mail(get_option('admin_email'), 'Bot Registration', $message);
*/			}


			if ( !$errors->get_error_code() )
			{
				do_action('register_post', $user_login, $user_email, $errors);
	
				$errors = apply_filters( 'registration_errors', $errors, $user_login, $user_email );
	
				$user_pass = $pass1;
				$user_id = wp_create_user( $user_login, $user_pass, $user_email );
				$birthday = "$day-$month-$yyyy";
				update_usermeta( $user_id, 'nickname', $user_name );
				update_usermeta( $user_id, 'birthday', $birthday );
				if ( !$user_id ) {
					$errors->add('registerfail', sprintf(__('<strong>ERROR</strong>: Couldn&#8217;t register you... please contact the <a href="mailto:%s">webmaster</a> !'), get_option('admin_email')));
				}

//				wp_new_user_notification($user_id, '*****');
			$e = new MyEmail();
			$e->newUserNotification( $user_id );
			}

			if ( !$errors->get_error_code() ) {
				wp_set_current_user($user_id, $user_login);
					wp_set_auth_cookie($user_id);
					bp_core_new_user_activity( $user_id );
					bp_core_add_notification( 1, $user_id, 'future_report', 'save_chart' );
					my_core_activated_user( $user_id );
					do_action('wp_login', $user_login);
					$redirect_to = 'home/';
					if ( isset( $_REQUEST['redirect_to'] ) )
						$redirect_to = $_REQUEST['redirect_to'];
					wp_safe_redirect( $redirect_to );
					exit();
				}
		}
		break;
	case "settings":
		require_once(ABSPATH . 'wp-admin/includes/admin.php');
		wp_reset_vars(array('action', 'redirect', 'profile', 'user_id', 'wp_http_referer'));
		if( $action == 'update' )
		{
			$month		= (int)( $_POST['mm'] );
			$day		= (int)( $_POST['dd'] );
			$yyyy		= (int)( $_POST['yyyy'] );

			check_admin_referer('update-user_' . $user_id);

			if ( IS_PROFILE_PAGE )
				do_action('personal_options_update', $user_id);
			else
				do_action('edit_user_profile_update', $user_id);

			$errors = edit_user($user_id);

		if ( !is_wp_error( $errors ) ) {
			$errors = new WP_Error();
			if ( empty( $month ) || $month < 1 || $month > 12 )
				$errors->add( 'mm', __( '<strong>ERROR</strong>: Please select a valid month.' ), array( 'form-field' => 'mm' ) );

			if ( empty( $day ) || $day < 1 || $day > 31 )
				$errors->add( 'dd', __( '<strong>ERROR</strong>: Please select a valid day.' ), array( 'form-field' => 'dd' ) );

			if ( empty( $yyyy ) || $yyyy < 1900 || $yyyy > 2013 )
				$errors->add( 'yyyy', __( '<strong>ERROR</strong>: Please enter a valid year.' ), array( 'form-field' => 'yyyy' ) );

			if ( !$errors->get_error_code() ) {
				$birthday = "$day-$month-$yyyy";
				update_usermeta( $user_id, 'birthday', $birthday );
				}
			}
		}
		break;
}

?>