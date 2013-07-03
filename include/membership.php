<?php
if( !is_user_logged_in() )
{
		$url = explode( "?", $_SERVER["REQUEST_URI"] );
	    $redirect_to = $url[0];
		echo '<div class="message notification promptText" style="margin: 0;">Please <a href="' . wp_login_url( $redirect_to ) . '" rel="nofollow">Log In &raquo;</a> or <a href="' . registrationURL( $redirect_to ) . '" rel="nofollow">Create an Account &raquo;</a>.</div>';
}
?>