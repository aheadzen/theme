<?php
/*
Template Name: Future Report
*/

define('CHARTS_CACHE', 'charts_cache');
define('CHARTS_CACHE_DIR', ABSPATH . CHARTS_CACHE);
define('CHARTS_INCLUDE_DIR', TEMPLATEPATH . '/include/classes/');

$current_user = wp_get_current_user();
$user_id = $current_user->ID;
$profileuser = get_userdata($user_id);

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
require_once CHARTS_INCLUDE_DIR . 'functions.php';
?>

<div id="content1" style="background: #FFF url(<?php linkTO('/wp-content/themes/WP_Premium/images/myhoroscopes.png'); ?>) no-repeat center top;">
<div id="breadcrumbs">
<?php get_breadcrumb() ?>
</div>

<div style="text-align: center;">
<div class="slogan">
	<a href="<?php echo get_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><h2>Future Predictions	<?php //the_title();?></h2></a>
	<h3>General Trends and Analysis</h3>
	<div class="border margin-top"></div>
	<div class="border"></div>
	<div class="border"></div> 
</div>



	<?php 
if( is_user_logged_in() )
{ 
	$birth_data = unserialize( $profileuser->birth_data );
	$payment = unserialize( $profileuser->payment );

	if( $birth_data['has_all_info'])
	{
		require_once CHARTS_INCLUDE_DIR . 'Atlas.php';
		require_once CHARTS_INCLUDE_DIR . 'orbit.php';
		require_once CHARTS_INCLUDE_DIR . 'planet.php';
		require_once CHARTS_INCLUDE_DIR . 'transit.php';
		require_once CHARTS_INCLUDE_DIR . 'astroreport.php';
		require_once CHARTS_INCLUDE_DIR . 'AspectsGenerator.php';
		require_once CHARTS_INCLUDE_DIR . 'VimshottariDasha.php';

		global $wpdb;
		$aa = new AstroReport( $birth_data );
		$houses = $aa->getHouses();
//		$planets = $aa->getPlanets();

		$houses = $aa->getHouses();

		$houseStartDegree = $houses['ASC']['fulldegree'] - 15;
		$houseStartDegree = modDegree( $houseStartDegree );
		$birthTS = getBirthTS( $birth_data );
		
		if( isset( $_GET['daily'] ) )
		{
			echo '</div><p style="border-top: dotted #CCC;"></p>';

			if( $payment['FR']['status'] == 'PAID' )
			{
				if( isset( $_GET['mm'] ) || isset( $_GET['yyyy'] ) )
				{
					$planets = $aa->getPlanets();
					$dasha = new VimshottariDasha($planets['Moon']['fulldegree'], $birthTS );
					$mm = (int)$_GET['mm'];
					$yyyy = (int)$_GET['yyyy'];

					$period = mktime(11, 0, 0, $mm, 1, $yyyy);
					list($fullmonth, $daysInMonth) = split('[/.-]', date('F-t', $period));

					echo "<h3>Daily Predictions for $fullmonth $yyyy</h3><br />";

					for($k = 1; $k <= $daysInMonth; $k++)
					{

						$thisDay['month'] = $mm;
						$thisDay['year'] = $yyyy;
						$thisDay['day'] = $k;
						$thisDayReport = new AstroReport( $thisDay );
						$dp = $thisDayReport->getPlanets();

						$moonDegree = $dp['Moon']['fulldegree'] - $houseStartDegree;
						$moonDegree = modDegree( $moonDegree );
						$moonHouse = (int)($moonDegree/30);
						$moonHouseDegree = (int)($moonDegree - $moonHouse*30);
						$moonHouse += 1;

						$dailyTS = $period + 86400*($k - 1);
						$sookshmDashaLord = $dasha->getDashaLord( $dailyTS, 4 );
						$planetId = getPlanetIdByName($sookshmDashaLord);

						echo "<h4>$fullmonth $k, $yyyy</h4>";

						if( $moonHouseDegree >=10 && $moonHouseDegree <=19 )
						{
							if( in_array( $moonHouse, array(1,4,5,7,9,10) ) )
								$phase_type = 3;
							else if( in_array( $moonHouse, array(6,8,12) ) )
								$phase_type = 1;
							else $phase_type = 2;

							$moonQuery = "SELECT content FROM horo_content WHERE content_type = 1 AND object_id = $planetId AND house_id = $moonHouse AND phase_type = $phase_type";
						}
						else $moonQuery = "SELECT content FROM house_transits WHERE planet_id = 2 AND house_id = $moonHouse AND degree = $moonHouseDegree";

						$moonContent = $wpdb->get_row($moonQuery, ARRAY_N);
						echo "<p>$moonContent[0]</p>";
					}				
				}
				else echo 'Invalid Period</div>';
			}
			else
			{
				?>
<h3>Daily Horoscopes and Predictions</h3>
<p>Pay one fee. Access all the future predictions and major astrological events you need.</p>
<ul>
	<li>Discover relationships, love, money and experiences life has to offer in future.</li>
	<li>Get helpful hints and suggestions to make best choices and feel good about it.</li>
	<li>Useful tool for spiritual aspirants. Helps in understanding workings of the universe and transcending karmic bondages.</li>
</ul>
<div class="message notification promptText">
<strong>Price - $25</strong>
<p>7-Day Money Back Guarantee! No Hassles, No Delays, and No Questions Asked!</p>
<?php require_once CHILD_TEMPLATEPATH . '/include/paypal/FR.php'; ?>
<img  src="https://www.paypal.com/en_US/i/bnr/horizontal_solution_PPeCheck.gif" border="0" alt="Solution Graphics" />
<p>For any further enquiries and refunds, please <a href="<?php linkTO( 'contact-us/' ); ?>">Contact Us</a> or email - <a href="mailto:admin@ask-oracle.com">admin@ask-oracle.com</a>. Expect a response in less than 24 hours.</p>
</div>
		<?php
			}
		}
		else
		{
			$a = new AspectsGenerator($birth_data);

			$html = array();
			$html[] = $birth_data['longitude']['degrees'] . '&deg;' . $birth_data['longitude']['min'] . '&prime;' . $birth_data['longitude']['direction'];
			$html[] = ' ';
			$html[] = $birth_data['latitude']['degrees'] . '&deg;' . $birth_data['latitude']['min'] . '&prime;' . $birth_data['latitude']['direction'];

			$isSample = 0;
			$type = $_GET['period'];
			$url = get_permalink();
			$url .= '?period=';
			switch( $type )
			{
				case "past":
					$startCount = -6;
					$endCount = -1;
					list($startMonth, $startDay, $startYear) = split('[/.-]', date("m.d.Y", strtotime("-7 months")) );
					list($endMonth, $endDay, $endYear) = split('[/.-]', date("m.d.Y", strtotime("-1 month")) );
					$startPeriod = "$startYear:$startMonth:$startDay:12:00:am";
					$endPeriod = "$endYear:$endMonth:$endDay:12:00:am";
					$pastClass = 'class="current"';
					$isSample = 1;
					break;
				case "next12m":
					$startCount = 1;
					$endCount = 12;
					list($startMonth, $startDay, $startYear) = split('[/.-]', date("m.d.Y", strtotime("+1 month")) );
					list($endMonth, $endDay, $endYear) = split('[/.-]', date("m.d.Y", strtotime("+13 months")) );
					$startPeriod = "$startYear:$startMonth:$startDay:12:00:am";
					$endPeriod = "$endYear:$endMonth:$endDay:12:00:am";
					$next12mClass = 'class="current"';
					break;
				case "next5y":
					$startCount = 1;
					$endCount = 60;
					list($startMonth, $startDay, $startYear) = split('[/.-]', date("m.d.Y", strtotime("+1 month")) );
					list($endMonth, $endDay, $endYear) = split('[/.-]', date("m.d.Y", strtotime("+5 years")) );
					$startPeriod = "$startYear:$startMonth:$startDay:12:00:am";
					$endPeriod = "$endYear:$endMonth:$endDay:12:00:am";
					$next5yClass = 'class="current"';
					break;
				default:
					$startCount = 0;
					$endCount = 0;
					list($startMonth, $startDay, $startYear) = split('[/.-]', date("m.d.Y", strtotime("-1 day")) );
					list($endMonth, $endDay, $endYear) = split('[/.-]', date("m.d.Y", strtotime("+1 month")) );
					$startPeriod = "$startYear:$startMonth:$startDay:12:00:am";
					$endPeriod = "$endYear:$endMonth:$endDay:12:00:am";
					$defaultClass = 'class="current"';
					$isSample = 1;
					break;
			}

			$res = $a->find_aspects($startPeriod, $endPeriod);

			$planetNumber = array();
			$planetNumber['ASC'] = 0;
			$planetNumber['Sun'] = 1;
			$planetNumber['Moon'] = 2;
			$planetNumber['Mercury'] = 3;
			$planetNumber['Venus'] = 4;
			$planetNumber['Mars'] = 5;
			$planetNumber['Jupiter'] = 6;
			$planetNumber['Saturn'] = 7;
			$planetNumber['Rahu'] = 20;
			$planetNumber['Ketu'] = 21;

			$aspect_text = array(	0=>"conjunction",
									180 => "opposition",
									60 => "sextile",
									90 => "square",
									270 => "square",
									120 => "trine",
									240 => "trine",
									210 => "aspects"
								);
	?>
	<em>for</em>
	<h1 id="chart"><?php echo $birth_data['report_name'];?></h1>
			<ul id="formElements">
				<li><strong><?php echo date("F j, Y g:i A", $birthTS) . ' (UTC ' . Atlas::getTimeZoneString( $birth_data['timezone'] ) . ')'; ?></strong></li>
				<li><strong><?php echo $birth_data['city']; ?></strong></li>
				<li><strong><?php echo join('', $html); ?></strong></li>
			</ul>
	</div>
	<p style="border-bottom: dotted #CCC;"></p>

	<ul id="futureNav">
		<li><a <?php echo $pastClass; ?> href="<?php echo $url . 'past#futureNav'; ?>">Last 6 months</a></ol>
		<li><a <?php echo $defaultClass; ?> href="<?php echo $url . '#futureNav'; ?>">Current</a></ol>
		<li><a <?php echo $next12mClass; ?> href="<?php echo $url . 'next12m#futureNav'; ?>">Next 12 months</a></ol>
		<li><a <?php echo $next5yClass; ?> href="<?php echo $url . 'next5y#futureNav'; ?>">Next 5 years</a></ol>
	</ul>
	<p class="clearboth"></p>
	<?php

		if( $isSample == 1 || $payment['FR']['status'] == 'PAID' )
		{
			$future = array();
			list($currentMonth, $currentYear) = split('[/.-]', date("m-Y") );

			$currentMonth = (int)$currentMonth;
			$currentYear = (int)$currentYear;
			$thisMonth = $birth_data;

			foreach( $res as $transitDate => $aspect )
			{
				list($yyyy, $mm, $dd) = split('[:]', $transitDate);

				$yyyy = (int)$yyyy;
				$mm = (int)$mm;
				$dd = (int)$dd;


				$strTransitDate = date("F, Y", mktime(0, 0, 0, $mm, $dd, $yyyy));

				if( !isset( $future[$strTransitDate] ) )
				{
					$future[$strTransitDate] = array();
					$future[$strTransitDate]['month'] = $mm;
					$future[$strTransitDate]['year'] = $yyyy;
				}
				if( !isset( $future[$strTransitDate]['transits'] ) )
					$future[$strTransitDate]['transits'] = array();

				$future[$strTransitDate]['transits'][$transitDate] = $aspect;
			}

			for( $start = $startCount; $start <= $endCount; $start++)
			{
				list($thisTransitDate, $thisTransitMonth, $thisTransitYear) = split('[/.-]', date("F, Y-m-Y", mktime(0, 0, 0, $currentMonth + $start, 1, $currentYear)) );

				$thisTransitMonth = (int)$thisTransitMonth;
				$thisTransitYear = (int)$thisTransitYear;

				$thisMonth['month'] = $thisTransitMonth;
				$thisMonth['year'] = $thisTransitYear;
				$thisMonth['day'] = 10;
				$thisMonthReport = new AstroReport( $thisMonth );
				$thisMonthPlanet = $thisMonthReport->getPlanets();

				$sunDegree = $thisMonthPlanet['Sun']['fulldegree'] - $houseStartDegree;
				$sunDegree = modDegree( $sunDegree );
				$sunHouse = (int)($sunDegree/30);
				$sunHouse += 1;

				$venusDegree = $thisMonthPlanet['Venus']['fulldegree'] - $houseStartDegree;
				$venusDegree = modDegree( $venusDegree );
				$venusHouse = (int)($venusDegree/30);
				$venusContentType = round( $venusDegree/30 - $venusHouse ) * 15;
				$venusHouse += 1;


				$marsDegree = $thisMonthPlanet['Mars']['fulldegree'] - $houseStartDegree;
				$marsDegree = modDegree( $marsDegree );
				$marsHouse = (int)($marsDegree/30);
				$marsContentType = round( $marsDegree/30 - $marsHouse ) * 15;
				$marsHouse += 1;

				echo "<h1>$thisTransitDate</h1>";
				echo "<h2>Overview:</h2>";
				$sunQuery = "SELECT content FROM house_transits WHERE planet_id = 1 AND house_id = $sunHouse";
				$venusQuery = "SELECT content FROM house_transits WHERE planet_id = 4 AND house_id = $venusHouse AND degree = $venusContentType";
				$marsQuery = "SELECT content FROM house_transits WHERE planet_id = 5 AND house_id = $marsHouse AND degree = $marsContentType";

				$sunContent = $wpdb->get_row($sunQuery, ARRAY_N);
				$venusContent = $wpdb->get_row($venusQuery, ARRAY_N);
				$marsContent = $wpdb->get_row($marsQuery, ARRAY_N);
				echo "<p>" . $sunContent[0] . "</p>";
				echo "<p>" . $venusContent[0] . "</p>";
				echo "<p>" . $marsContent[0] . "</p>";

				echo "<h2>Daily:</h2>";
				$param = get_linkTO('birth-chart/future/');
				$href = $param . '?daily&mm=' . $thisTransitMonth . '&yyyy=' . $thisTransitYear;

				echo '<h4><a href="' . $href . '" target="_blank">Click here to open</a></h4>';

				echo "<h2>Important Trends:</h2>";
				if( isset( $future[$thisTransitDate] ) )
				{
					foreach( $future[$thisTransitDate]['transits'] as $transitDate => $aspect )
					{
						list($yyyy, $mm, $dd) = split('[:]', $transitDate);

						$yyyy = (int)$yyyy;
						$mm = (int)$mm;
						$dd = (int)$dd;


						$strTransitDate = date("F j, Y", mktime(0, 0, 0, $mm, $dd, $yyyy));

						foreach( $aspect as $a)
						{
							$skip = array('Neptune', 'Pluto', 'Uranus');
							if( in_array( $a[0], $skip ) || in_array( $a[1], $skip ) )
								continue;

							if( $a[2] == 0 && $a[0] == 'Ketu' && ($a[1] == 'Ketu' || $a[1] == 'Rahu'))
								continue;
							
							if( $a[2] == 180 && ($a[1] == 'Ketu' || $a[1] == 'Rahu'))
								continue;
							
							$thisAspect = $aspect_text[ $a[2] ];
							echo "<h3>$a[0] $thisAspect $a[1]: $strTransitDate</h3>";
							$planet_id = $planetNumber[ $a[0] ];
							$planet_aspected = $planetNumber[ $a[1] ];
							$aspect_type = $a[2];

							if( $aspect_type == 240 )
								$aspect_type = 120;


							$qry = "SELECT content FROM future_report WHERE planet_id = $planet_id AND planet_aspected = $planet_aspected AND aspect_type=$aspect_type";

							$content = $wpdb->get_row($qry, ARRAY_N);

							echo "<p>" . $content[0] . "</p>";
						}
					}
				} else echo "<p>Nothing special this month.</p>";

				echo '<p style="border-top: dotted #CCC;"></p>';
			}
		}
		else
		{
			?>
<p></p>
<p>Pay one fee. Access all the future predictions and major astrological events you need.</p>
<ul>
	<li>Discover relationships, love, money and experiences life has to offer in future.</li>
	<li>Get helpful hints and suggestions to make best choices and feel good about it.</li>
	<li>Useful tool for spiritual aspirants. Helps in understanding workings of the universe and transcending karmic bondages.</li>
</ul>
<div class="message notification promptText">
<strong>Price - $25</strong>
<p>7-Day Money Back Guarantee! No Hassles, No Delays, and No Questions Asked!</p>
<?php require_once CHILD_TEMPLATEPATH . '/include/paypal/FR.php'; ?>
<img  src="https://www.paypal.com/en_US/i/bnr/horizontal_solution_PPeCheck.gif" border="0" alt="Solution Graphics" />
<p>For any further enquiries and refunds, please <a href="<?php linkTO( 'contact-us/' ); ?>">Contact Us</a> or email - <a href="mailto:admin@ask-oracle.com">admin@ask-oracle.com</a>. Expect a response in less than 24 hours.</p>
</div>
<?php	}

	}	// $_GET['daily'] ends
		
		my_future_report_delete_notifications( $user_id, 'future_report' );


	} else echo '<div class="message notification promptText">We need your birth details. Kindly generate your <a href="' . birthChartURL( 'birth-chart/future/' ) . '">birth chart &raquo;</a> to see this report.</div></div>';
} else echo '<div class="message notification promptText">Members only! Please <a href="' . wp_login_url( 'birth-chart/future/' ) . '">Log In &raquo;</a> or <a href="' . registrationURL( 'birth-chart/future/' ) . '">Create an Account &raquo;</a>.</div></div>';

	?>
		
</div>

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