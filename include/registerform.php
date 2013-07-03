<?php require_once( CHILD_TEMPLATEPATH . '/include/classes/IndexPage.php' );
	$out = new IndexPage();
		if( isset( $_REQUEST['redirect_to'] ) )
	{
		$redirect_to = esc_attr($_REQUEST['redirect_to']);
	} else $redirect_to = 'home/';

?>
<p><small>Already registered? You can <?php wp_loginout(); ?> here.</small></p>
<div id="commentform"><strong>
<form name="registerform" id="registerform" action="" method="post">
	<input type="hidden" name="action" value="register" />
	<p>
		<label>Your Name<br />
		<input type="text" name="user_name" id="user_name" value="<?php echo $user_name; ?>" /></label>
	</p>
	<p>
		<label>Login ID<br />

		<input type="text" name="user_login" id="user_login" value="<?php echo $user_login; ?>" /></label>
	</p>
	<p>
		<label>Password<br />

		<input autocomplete="off" name="pass1" id="pass1" type="password" /></label>
	</p>
	<p>
		<label>Confirm Password<br />

		<input autocomplete="off" name="pass2" id="pass2" type="password" /></label>
	</p>
	<p>
		<label>E-mail<br />
		<input type="text" name="user_email" id="user_email" value="<?php echo $user_email; ?>" /></label>
	</p>
	<p>
		<label>Birthday<br /></label>
		<table>
			<tr>
				<td><?php $out->show_months($month); ?></td>
				<td><?php $out->show_days($day); ?></td>
				<td><input type="text" name="yyyy" id="yyyy" style="width: 50px; font-size:14px; line-height:19px;" maxlength="4" value="<?php echo $yyyy; ?>" /></td>
			</tr>
			<tr>
				<td>Month</td>
				<td>Day</td>
				<td>Year - 4 digits (E.g. - 1958)</td>
			</tr>
		</table>
	</p>
	<p style="display: none;">
		<label>Leave this field blank<br />
		<input type="text" name="url" id="url" tabindex="50" /></label>
		<input type="hidden" name="redirect_to" value="<?php echo $redirect_to; ?>" />
	</p>
	<p></p>
   	<p><input type="submit" name="wp-submit" id="submit" value="Create My Account" /></p>
</form></strong>
</div>