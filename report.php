<?php
/*
Template Name: Reports
*/

define('CHARTS_CACHE', 'charts_cache');
define('CHARTS_CACHE_DIR', ABSPATH . CHARTS_CACHE);
define('CHARTS_INCLUDE_DIR', TEMPLATEPATH . '/include/classes/');

$current_user = wp_get_current_user();
$user_id = $current_user->ID;
$profileuser = get_userdata($user_id);

require_once CHARTS_INCLUDE_DIR . 'functions.php';


get_header();
do_action( 'yit_before_primary' ) ?>
<!-- START PRIMARY -->
<div id="primary" class="<?php yit_sidebar_layout() ?>">
    <div class="container group">
	    <div class="row">
	        <?php do_action( 'yit_before_content' ) ?>
	        <!-- START CONTENT -->
	        <div id="content-page" class="span<?php echo yit_get_sidebar_layout() == 'sidebar-no' ? 12 : 9 ?> content group">
	        	<?php 
if( is_user_logged_in() )
{ 
	$birth_data = unserialize( $profileuser->birth_data );

	if( $birth_data['has_all_info'])
	{
		require_once CHARTS_INCLUDE_DIR . 'Atlas.php';
		require_once CHARTS_INCLUDE_DIR . 'orbit.php';
		require_once CHARTS_INCLUDE_DIR . 'planet.php';
		require_once CHARTS_INCLUDE_DIR . 'transit.php';
		require_once CHARTS_INCLUDE_DIR . 'astroreport.php';
		require_once CHARTS_INCLUDE_DIR . 'ChartMaker.php';
		require_once CHARTS_INCLUDE_DIR . 'NorthernChartMaker.php';
		require_once CHARTS_INCLUDE_DIR . 'PlanetInfo.php';

		$aa = new AstroReport( $birth_data );

		$houses = $aa->getHouses();
		$planets = $aa->getPlanets();

		global $wpdb;

		$birthTS = getBirthTS( $birth_data );
		$prefix = base_convert( $user_id, 10, 36);
		$fName = $prefix . '_' . $birthTS . '_D1.png';

		if(!file_exists(CHARTS_CACHE_DIR . '/' . $fName ))
		{
			$maker = new NorthernChartMaker($houses);
			$maker->saveChart( $fName, CHARTS_CACHE_DIR);
		}

		$html = array();
		$html[] = $birth_data['longitude']['degrees'] . '&deg;' . $birth_data['longitude']['min'] . '&prime;' . $birth_data['longitude']['direction'];
		$html[] = ' ';
		$html[] = $birth_data['latitude']['degrees'] . '&deg;' . $birth_data['latitude']['min'] . '&prime;' . $birth_data['latitude']['direction'];

		?>
		<div style="text-align: center;">
		<p></p>
		<h2>Ask-Oracle.com's Birth Chart Analysis</h2>
<h2>for</h2>
<h1 id="chart"><?php echo $birth_data['report_name'];?></h1>
		<ul id="formElements">
			<li><strong><?php echo date("F j, Y g:i A", $birthTS) . ' (UTC ' . Atlas::getTimeZoneString( $birth_data['timezone'] ) . ')'; ?></strong></li>
			<li><strong><?php echo $birth_data['city']; ?></strong></li>
			<li><strong><?php echo join('', $html); ?></strong></li>
		</ul>
		</div>
<div style="text-align: center; border-bottom: dotted #CCC;">
	<img src="<?php echo get_linkTO( CHARTS_CACHE . '/' . $fName ); ?>" />
	<p></p>
</div>
<p></p>
<h3>Chart Details</h3>
<p>Jyotish - Equal House, North Indian Style</p>
<table>
	<tr>
		<td>
			<ul id="formElements">
				<li>Ascendant</li>
				<?php
					foreach( $planets as $planet => $data )
					{
						echo '<li>' . $planet . '</li>';
					}
			?>
			</ul>
		</td>
		<td width="30">
		</td>
		<td>
			<ul id="formElements">
				<li>...</li>
				<?php
					foreach( $planets as $data )
					{
						echo '<li>...</li>';
					}
			?>
			</ul>
		</td>
		<td width="30">
		</td>
		<td>
			<ul id="formElements">
				<li><?php printLongitude( $houses['ASC'] ); ?></li>
				<?php
					foreach( $planets as $planet => $data )
					{
						echo '<li>';
						printLongitude( $data );
						echo '</li>';
					}
			?>
			</ul>
		</td>
	</tr>
</table>

<?php
		foreach( $planets as $planet => $data )
		{
			if( $planet == 'Ketu' )
				continue;

			$html = array();
			$planetId = getPlanetIdByName($planet);
			$h1 = $data['house'];
			$h2 = $data['sign_number'];

			$getContentHouses = $wpdb->get_row("SELECT content FROM birth_report WHERE content_type = 1 AND object_id = $h1 AND planet_id = $planetId", ARRAY_N);
			$getContentZodiacSigns = $wpdb->get_row("SELECT content FROM birth_report WHERE content_type = 2 AND object_id = $h2 AND planet_id = $planetId", ARRAY_N);

			if( $planet == 'Rahu' )
			{
				$html[] = '<h1 id="' . $planet . '">Rahu/Ketu</h1>';
				$html[] = '<p>' . PlanetInfo::getPlanetInfo( 'Rahu' ) . '</p>';
				$html[] = '<p>' . PlanetInfo::getPlanetInfo( 'Ketu' ) . '</p>';
				$html[] = '<h3>Rahu is in ' . ordinal( $h1 ) . ' House - Ketu is in ' . ordinal( $planets['Ketu']['house'] ) . ' House</h3>';
				$html[] = "<p>$getContentHouses[0]</p>";
				$html[] = '<h3>Rahu is in ' . $data['sign'] . ' - Ketu is in ' . $planets['Ketu']['sign'] . '</h3>';
				$html[] = "<p>$getContentZodiacSigns[0]</p>";
			}
			else
			{
				$html[] = '<h1 id="' . $planet . '">' . $planet . '</h1>';
				$html[] = '<p>' . PlanetInfo::getPlanetInfo( $planet ) . '</p>';
				$html[] = '<h3>' . $planet . ' is in ' . ordinal( $h1 ) . ' House.</h3>';
				$html[] = "<p>$getContentHouses[0]</p>";
				$html[] = '<h3>' . $planet . ' is in ' . $data['sign'] . '</h3>';
				$html[] = "<p>$getContentZodiacSigns[0]</p>";
			}
			$html[] = '<p style="border-bottom: dotted #CCC; margin-bottom: 10px; text-align: right; font-size: small;"><a href="#contents">Back to Contents</a></p>';
			$html = join('', $html);
			echo $html;
		}
/*		$message = urldecode( http_build_query($birth_data, '', '<br />') );

		$headers = "Content-type: text/html\r\n";

		$img_url = '<br /><a href="' . get_linkTO( CHARTS_CACHE . '/' . $fName ) . '">birth chart</a>';

		wp_mail(get_option('admin_email'), 'Birth Report Generated', $message . $img_url, $headers);*/

	} else echo 'Kindly generate your <a href="' . get_linkTO( 'birth-chart/' ) . '">birth chart</a> first.';
} else echo 'Members only! Please <a href="' . wp_login_url( 'home/' ) . '">Log In</a> or <a href="' . get_linkTO( 'registration/' ) . '">Create an Account</a>.';

	?>
	        </div>
	        <!-- END CONTENT -->
	        <?php do_action( 'yit_after_content' ) ?>
	        
	        <?php get_sidebar() ?>
	        
	        <?php do_action( 'yit_after_sidebar' ) ?>
	        
	        <!-- START EXTRA CONTENT -->
	        <?php do_action( 'yit_extra_content' ) ?>
	        <!-- END EXTRA CONTENT -->
		</div>
    </div>
</div>
<!-- END PRIMARY -->
<?php
do_action( 'yit_after_primary' );
get_footer() ?>