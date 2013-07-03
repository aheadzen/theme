<?php
/*
Template Name: Reports
*/

define('CHARTS_CACHE', 'charts_cache');
define('CHARTS_CACHE_DIR', ABSPATH . CHARTS_CACHE);
define('CHARTS_INCLUDE_DIR', CHILD_TEMPLATEPATH . '/include/classes/');

$current_user = wp_get_current_user();
$user_id = $current_user->ID;
$profileuser = get_userdata($user_id);

get_header(); 
require_once CHARTS_INCLUDE_DIR . 'functions.php';

?>

<div id="content1" style="background: #FFF url(<?php linkTO('/wp-content/themes/WP_Premium/images/myhoroscopes.png'); ?>) no-repeat center top;">
<div id="breadcrumbs">
<?php get_breadcrumb() ?>
</div>

<div style="text-align: center;">
<h1 class="btmspace"><a href="<?php echo get_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">Birth Chart Report</a></h1>
<h2>Personal Profile and Analysis</h2>
<h2></h2>
<h2 style="border-bottom: dotted #CCC;">It's all about YOU</h2>
</div>
<p></p>
<h4>Disclaimer</h4>
<small>The publisher and the author make no representations or warranties with respect to the accuracy or completeness of the contents of this work and specifically disclaim all warranties, including without limitation warranties of fitness for a particular purpose. No warranty may be created or extended by sales or promotional materials. The advice and strategies contained herein may not be suitable for every situation. This work is sold with the understanding that the publisher is not engaged in rendering legal, accounting, or other professional services. If professional assistance is required, the services of a competent professional person should be sought. Neither the publisher nor the author shall be liable for damages arising herefrom.</small>
<p style="border-bottom: dotted #CCC;"></p>
<h1 class="btmspace" id="contents">Contents</h1>
<ul style="list-style: decimal;">
	<ol>1. <a href="#intro">Introduction</a></ol>
	<ol>2. <a href="#chart">Chart Information</a></ol>
	<ol>3. <a href="#ASC">Your Ascendant</a></ol>
	<ol>4. <a href="#Sun">SUN in Your Chart</a></ol>
	<ol>5. <a href="#Moon">MOON in Your Chart</a></ol>
	<ol>6. <a href="#Mercury">MERCURY in Your Chart</a></ol>
	<ol>7. <a href="#Mars">MARS in Your Chart</a></ol>
	<ol>8. <a href="#Jupiter">JUPITER in Your Chart</a></ol>
	<ol>9. <a href="#Saturn">SATURN in Your Chart</a></ol>
	<ol>10. <a href="#Uranus">URANUS in Your Chart</a></ol>
	<ol>11. <a href="#Neptune">NEPTUNE in Your Chart</a></ol>
	<ol>12. <a href="#Pluto">PLUTO in Your Chart</a></ol>
	<ol>13. <a href="#Rahu">RAHU/KETU (Moon's Nodes) in Your Chart</a></ol>
</ul>
<p style="border-bottom: dotted #CCC;"></p>
<h1 class="btmspace" id="intro">Introduction</h1>
<p>The following pages describe the major astrological factors that you will be experiencing throughout your life. These pages can give you insight into the challenges that you will encounter and the underlying lessons that they offer you. For the most part, these factors will require you to go through various phases in life and pursue your own pot of gold.</p>
<p>This report encourages you to embrace all life experiences wholeheartedly and quickly adept to changing times and situations as they come until you become strong enough to challenge them and make a difference. One of the most important steps you can take towards achieving your greatest potential in life is to learn to monitor your attitude and its impact on your work performance, relationships and everyone around you.</p>
<p>Read your birth chart analysis report over once now to get a general overview.  Then, as the issues described in this report begin to appear in your life, you can refer back to this report for suggestions on how to best handle the changes that you are experiencing.  Even the worst astrological combination can be a valuable experience if you are prepared enough to positively grasp the lesson that it offers.
</p>
<p style="border-bottom: dotted #CCC;">Now on to your birth chart analysis report.</p>
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
<?php get_sidebar(); ?>
<?php get_footer(); ?>
