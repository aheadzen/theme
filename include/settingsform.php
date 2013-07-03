<?php require_once( CHILD_TEMPLATEPATH . '/include/classes/IndexPage.php' );
	$out = new IndexPage();
	if( empty( $yyyy ) )
	{
		list($day, $month, $yyyy) = split('[/.-]', $profileuser->birthday);	
	}
?>

<h3><?php _e('Edit Zodiac Sign') ?></h3>
<p></p>
<?php include(CHILD_TEMPLATEPATH."/include/setsignform.php"); ?>

<hr />
<h3><?php _e('Edit Personal Information') ?></h3>

<form id="your-profile" action="" method="post">
<?php wp_nonce_field('update-user_' . $user_id) ?>
<?php if ( $wp_http_referer ) : ?>
	<input type="hidden" name="wp_http_referer" value="<?php echo esc_url($wp_http_referer); ?>" />
<?php endif; ?>
<p>
<input type="hidden" name="from" value="profile" />
<input type="hidden" name="checkuser_id" value="<?php echo $user_ID ?>" />
</p>

<p id="commentform">
	<label for="nickname"><strong><?php _e('Your Name'); ?></strong><br /><input type="text" name="nickname" id="nickname" value="<?php echo esc_attr($profileuser->nickname) ?>" class="regular-text" />
	</label>
</p>
<p id="commentform">
	<label><strong>Birthday</strong><br /></label>
		<table>
			<tr>
				<td><?php $out->show_months($month); ?></td>
				<td><?php $out->show_days($day); ?></td>
				<td><input type="text" name="yyyy" id="yyyy" style="width: 50px; font-size:14px; line-height:19px;" maxlength="4" value="<?php echo $yyyy; ?>" /></td>
			</tr>
		</table>
</p>
<p id="commentform">
	<label for="email"><strong><?php _e('E-mail'); ?></strong><br /><input type="text" name="email" id="email" value="<?php echo esc_attr($profileuser->user_email) ?>" class="regular-text" />
	</label>
</p>
<p class="submit">
	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="user_id" id="user_id" value="<?php echo esc_attr($user_id); ?>" />
	<input type="submit" class="button-primary" value="Update" name="submit" />
</p>
</form>
<hr />
<h3><?php _e('Change Password') ?></h3>

<form id="your-profile" action="" method="post">
<?php wp_nonce_field('update-user_' . $user_id) ?>
<?php if ( $wp_http_referer ) : ?>
	<input type="hidden" name="wp_http_referer" value="<?php echo esc_url($wp_http_referer); ?>" />
<?php endif; ?>
<p>
<input type="hidden" name="from" value="profile" />
<input type="hidden" name="checkuser_id" value="<?php echo $user_ID ?>" />
</p>
<div id="commentform"><strong>
<p>
<label for="pass1"><?php _e('New Password'); ?><br />
<input type="password" name="pass1" id="pass1" autocomplete="off" /></label>
</p>
<p>
<label for="pass2"><?php _e('Type your new password again.'); ?><br />

		<input type="password" name="pass2" id="pass2" autocomplete="off" /></label>
</p></strong>
</div>
<!-- <p><small><?php _e('Hint: The password should be at least seven characters long. To make it stronger, use upper and lower case letters, numbers and symbols like ! " ? $ % ^ &amp; ).'); ?></small></p> -->

<p class="submit">
<input type="hidden" name="email" id="email" value="<?php echo esc_attr($profileuser->user_email) ?>" />
	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="user_id" id="user_id" value="<?php echo esc_attr($user_id); ?>" />
	<input type="submit" class="button-primary" value="Update Password" name="submit" />
</p>
</form>