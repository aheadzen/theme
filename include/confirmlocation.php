<?php get_header(); ?>

<div id="content1" style="background: #FFF url(<?php linkTO('/wp-content/themes/WP_Premium/images/myhoroscopes.png'); ?>) no-repeat center top;">
<div id="breadcrumbs">
<?php get_breadcrumb() ?>
</div>

<h1 class="btmspace"><a href="<?php echo get_permalink() . '?ConfirmLocation'; ?>" rel="bookmark" title="<?php the_title(); ?>">Confirm Birth Location and Time Zone</a></h1>

<?php 
	include(CHILD_TEMPLATEPATH."/include/errors.php");

if( empty($_POST) )
{
	 echo 'Kindly generate your <a href="' . get_linkTO( 'birth-chart/' ) . '">birth chart</a> first.';
} else
{
	$reportdata = array();
	$reportdata = unserialize( $profileuser->birth_data );
	$birthTS = getBirthTS( $reportdata );
	?>
		<ul id="formElements">
			<li><strong><?php echo $reportdata['report_name'];?></strong></li>
			<li><strong><?php echo date("F j, Y", $birthTS); ?></strong></li>
			<li><strong><?php echo date("g:i A", $birthTS); ?></strong></li>
			<li><strong><?php echo $reportdata['city'] . ', ' . Atlas::GetCountryByCode( $reportdata['country'] ); ?></strong></li>
		</ul>
<?php 
}

if( $_POST['action'] == 'report' )
{
	$place_id = (int)$_POST['place'];
	$place_search = Atlas::GetPlaceById( $place_id );
	if( !empty( $place_search ) )
	{
		$placeSearch = array();
		$placeSearch[] = $place_search;
	}

	if( empty( $placeSearch ) )
	{
		echo '<p>Please enter coordinates and timezone for <strong>' . $reportdata['city'] . '</strong></p>';
	}
	else if( count( $placeSearch ) == 1 )
	{
		echo '<p>Please verify coordinates and timezone for <strong>' . $reportdata['city'] . '</strong></p>';
		$cityCoordinates = Atlas::getCoordinates( $placeSearch[0] );
	}
	include(CHILD_TEMPLATEPATH."/include/confirmreportform.php");
}
