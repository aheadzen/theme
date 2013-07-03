<?php 
$out = new IndexPage();
$report_name = $profileuser->nickname;
if( isset( $profileuser->birthday ) )
{
	list($dd, $mm, $yyyy) = split('[/.-]', $profileuser->birthday);	
}
if( !empty( $reportdata['report_name'] ) )
	$report_name = $reportdata['report_name'];

if( !empty( $reportdata['month'] ) )
	$mm = $reportdata['month'];
if( !empty( $reportdata['day'] ) )
	$dd = $reportdata['day'];
if( !empty( $reportdata['year'] ) )
	$yyyy = $reportdata['year'];

$action = '?GetLocation';
$redirect_to = 'chart';
if( isset( $_REQUEST['redirect_to'] ) && $_REQUEST['redirect_to'] !== 'chart' )
{
	$redirect_to = esc_attr($_REQUEST['redirect_to']);
	$action .= '&redirect_to=' . $redirect_to;
}

$isMaleChecked = '';
$isFemaleChecked = '';

if( $reportdata['sex'] == 'male' )
	$isMaleChecked = 'checked';
if( $reportdata['sex'] == 'female' )
	$isFemaleChecked = 'checked';
?>
<div id="commentform">
<strong>
<form name="reportform" id="reportform" action="<?php echo $action; ?>" method="post">
	<input type="hidden" name="action" value="report" />
	<p>
		<label>Report Name<br />
		<input type="text" class="required" name="report_name" id="report_name" value="<?php echo $report_name; ?>" /></label>
	</p>
	<p>
		<label>Sex<br /></label>
		<label><input type="radio" name="sex" id="sex" style="width: 30px;" value="male" <?php echo $isMaleChecked; ?>/>Male</label>
		<label><input type="radio" name="sex" id="sex" style="width: 30px;" value="female" <?php echo $isFemaleChecked; ?>/>Female</label>
		
	</p>
	<p id="formElements">
		<label>Birthday<br /></label>
		<table>
			<tr>
				<td><?php $out->show_months( $mm ); ?></td>
				<td><?php $out->show_days( $dd ); ?></td>
				<td><input type="text" class="name" name="yyyy" id="yyyy" style="width: 50px; font-size:14px; line-height:19px;" maxlength="4" value="<?php echo $yyyy; ?>" /></td>
			</tr>
			<tr>
				<td>Month</td>
				<td>Day</td>
				<td>Year - 4 digits (E.g. - 1958)</td>
			</tr>
		</table>
	</p>
	<p id="formElements">
		<label>Place of Birth<br /></label>
		<table>
			<tr>
				<td width="70%"><input style="width: 90%;" class="required" type="text" name="city" value="<?php echo $reportdata['city']; ?>" /></td>
				<td><?php $out->show_country($reportdata['country']); ?></td>
			</tr>
			<tr>
				<td>City (E.g. : London)</td>
				<td>Country</td>
			</tr>
		</table>
	</p>
	<p id="formElements">
		<label>Birth Time<br /></label>
		<table>
			<tr>
				<td><?php $out->show_hour($reportdata['hour']); ?></td>
				<td><?php $out->show_minutes($reportdata['min']); ?></td>
				<td><?php $out->show_am_pm($reportdata['am_pm']); ?></td>
			</tr>
			<tr>
				<td>Hour</td>
				<td>Minutes</td>
				<td>AM/PM</td>
			</tr>
		</table>
	</p>
	<p><input type="hidden" name="redirect_to" value="<?php echo $redirect_to; ?>" /></p>
   	<p><input type="submit" name="wp-submit" id="submit" value="Verify Birth Details &raquo" /></p>
</form></strong>
</div>