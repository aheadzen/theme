<?php
	if( isset( $_REQUEST['redirect_to'] ) )
	{
		$redirect_to = esc_attr($_REQUEST['redirect_to']);
	} else $redirect_to = 'home/';
?>
<p><small>Don't have an Account? You can <a title="Create an Account" rel="bookmark" href="<?php linkTO('registration/'); ?>">Create an Account</a> here.</small></p>
<p>Sign in to personalize your experience, save time and access to much more features.</p>
<strong>
<form name="loginform" id="loginform" action="" method="post">
<div id="commentform">
	<p>
		<label>Login ID<br />
		<input type="text" name="log" id="user_login" value="<?php echo esc_attr($user_login); ?>" /></label>
	</p>
	<p>
		<label>Password<br />
		<input type="password" name="pwd" id="user_pass" /></label>

	</p>

</div>
	<p class="forgetmenot"><label><input name="rememberme" type="checkbox" id="rememberme" value="forever" /> Remember Me</label></p>
	<p id="commentform">
		<input type="submit" name="wp-submit" id="submit" value="Log In" tabindex="100" />
		<input type="hidden" name="redirect_to" value="<?php echo $redirect_to; ?>" />
		<input type="hidden" name="testcookie" value="1" />
	</p>
</form></strong>
