<?php 
$out = new IndexPage();
if( $_POST['action'] == 'confirmReport' )
{
	$tzArray = $reportdata['timezone'];
	$cityCoordinates['long'] = $reportdata['longitude'];
	$cityCoordinates['lat'] = $reportdata['latitude'];
//				var_dump( $reportdata );

}
else
{
	if( !empty( $placeSearch[0]['timezone'] ) )
	{
		$tzArray = Atlas::getTimeZone( $birthTS, $placeSearch[0]['timezone'] );
	}
}

$action = '';
$redirect_to = 'chart';
if( isset( $_REQUEST['redirect_to'] ) && $_REQUEST['redirect_to'] !== 'chart' )
{
	$redirect_to = esc_attr($_REQUEST['redirect_to']);
	$action .= '?redirect_to=' . $redirect_to;
}
if( strpos( $_SERVER['REQUEST_URI'], 'settings/location' ) )
{
	$action = '?saveLocation';
}


	include(CHILD_TEMPLATEPATH."/include/errors.php");
?>
<div><strong>
<form name="confirmReport" id="confirmReport" action="<?php echo $action; ?>" method="post">
	<input type="hidden" name="action" value="confirmReport" />
<small>Note - Daylight Saving Time (Summer Time) changes have been taken into account, wherever applicable. Please feel free to make changes if you find any error here.</small>
<table>
	<tr>
		<td></td>
		<td>hours</td>
		<td>minutes</td>
		<td></td>
	</tr>
	<tr>
		<td class="right">Time zone :</td>
		<td><input type="text" name="tz_hours" id="tz_hours" value="<?php echo $tzArray['hours']; ?>" /></td>
		<td><input type="text" name="tz_min" id="tz_min" value="<?php echo $tzArray['min']; ?>" /></td>
		<td><select name="e_w_tz"><option value="E">East of GMT</option><option value="W" <?php if($tzArray['direction'] == 'W' ) echo 'selected="selected"'; ?>>West of GMT</option></select></td>
	</tr>
</table>
<p></p>
<table>
	<tr>
		<td></td>
		<td>degrees</td>
		<td></td>
		<td>minutes</td>
	</tr>
	<tr>
		<td class="right">Longitude :</td>
		<td><input type="text" name="lon_degrees" id="lon_degrees" value="<?php echo $cityCoordinates['long']['degrees']; ?>" /></td>
		<td><select name="e_w"><option value="E">E</option><option value="W" <?php if($cityCoordinates['long']['direction'] == 'W' ) echo 'selected="selected"'; ?>>W</option></select></td>
		<td><input type="text" name="lon_min" id="lon_min" class="number" value="<?php echo $cityCoordinates['long']['min']; ?>" /></td>
	</tr>
	<tr>
		<td class="right">Latitude :</td>
		<td><input type="text" name="lat_degrees" id="lat_degrees" value="<?php echo $cityCoordinates['lat']['degrees']; ?>" /></td>
		<td><select name="n_s"><option value="N">N</option><option value="S" <?php if($cityCoordinates['lat']['direction'] == 'S' ) echo 'selected="selected"'; ?>>S</option></select></td>
		<td><input type="text" name="lat_min" id="lat_min" value="<?php echo $cityCoordinates['lat']['min']; ?>" /></td>
	</tr>
</table>
<p><input type="hidden" name="redirect_to" value="<?php echo $redirect_to; ?>" />	<input type="hidden" name="city_string_home" id="city_string_home" value="" />
</p>
   	<p><input type="submit" name="wp-submit" id="submit" value="Done! See Your Report &raquo" /></p>
</form></strong>
</div>