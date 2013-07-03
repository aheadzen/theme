<?php
if( isset( $errors ) )
{
		$err = '';
		$messages = '';
		foreach ( $errors->get_error_codes() as $code ) {
			$severity = $errors->get_error_data($code);
			foreach ( $errors->get_error_messages($code) as $error ) {
				if ( 'message' == $severity )
					$messages .= '	' . $error . "<br />\n";
				else
					$err .= '	' . $error . "<br />\n";
			}
		}
		if ( !empty($err) )
			echo '<div id="login_error" style="display: block;">' . apply_filters('login_errors', $err) . "</div>\n";
		else if ( !empty($messages) )
			echo '<p class="message">' . apply_filters('login_messages', $messages) . "</p>\n";
		else echo '<div id="login_error"></div>';
} else echo '<div id="login_error"></div>';