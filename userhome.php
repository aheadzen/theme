<?php
/*
Template Name: UserHome
*/

define('CHARTS_INCLUDE_DIR', TEMPLATEPATH . '/include/classes/');

require_once CHARTS_INCLUDE_DIR . 'orbit.php';
require_once CHARTS_INCLUDE_DIR . 'planet.php';
require_once CHARTS_INCLUDE_DIR . 'astroreport.php';
require_once CHARTS_INCLUDE_DIR . 'today.php';
require_once CHARTS_INCLUDE_DIR . 'Atlas.php';
//require_once CHARTS_INCLUDE_DIR . 'AnalyzeChart.php';

$current_user = wp_get_current_user();
$user_id = $current_user->ID;

setSign($user_id);
$profileuser = get_userdata($user_id);
if( empty( $profileuser->current_location ) )
	$c_loc = Atlas::SetDefaultCity();
else $c_loc = $profileuser->current_location;

$c_loc = unserialize( $c_loc );
$todaysDay = new Today($c_loc);

get_header();
do_action( 'yit_before_primary' ) ?>
<!-- START PRIMARY -->
<div id="primary" class="<?php yit_sidebar_layout() ?>">
    <div class="container group">
	    <div class="row">
	        <?php do_action( 'yit_before_content' ) ?>
	        <!-- START CONTENT -->
	        <div id="content-page" class="span<?php echo yit_get_sidebar_layout() == 'sidebar-no' ? 12 : 9 ?> content group">

<div id="content1" class="myhome">
<div id="breadcrumbs">
<?php //get_breadcrumb() ?>
</div>
<?php if( is_user_logged_in() )
{
	do_action( 'template_notices' );
	
	echo '<div>Last Status : ';
	bp_activity_latest_update( $user_id );
	echo '</div>';
	locate_template( array( 'activity/post-form.php'), true ); 
		locate_template( array( 'groups/single/activity-widget.php' ), true );
} else include(CHILD_TEMPLATEPATH. '/include/membership.php' ); ?>
<p class="dottedBottomBorder"></p>
<h1 class="btmspace"><a href="<?php echo get_permalink() ?>" rel="bookmark" title="My Dashboard">
Today: <?php echo date("l, F j, Y");?></a></h1>
<p>Location: <?php echo $c_loc['city_string_home']; ?> <small><a href="<?php echo bp_get_loggedin_user_link() . 'settings/location/'; ?>">Change Location &raquo;</a></small></p>
<ul>
	<li>Sunrise: <?php $todaysDay->showSunrise(); ?> | Sunset : <?php $todaysDay->showSunset(); ?></li>
	<li>Planetary Information at Sunrise:
		<ul>
			<li>Moon : <?php $todaysDay->showPlanetLocation( 'Moon' ); ?></li>
			<li>Sun : <?php $todaysDay->showPlanetLocation( 'Sun' ); ?></li>
			<li>Moon phase is : <?php $todaysDay->showMoonPhase(); ?></li>
		</ul>
	</li>
	<li>Other details:
		<ul>
			<li>Tithi : <?php $todaysDay->showTithi(); ?></li>
			<li>Moon Nakshatra : <?php $todaysDay->showNakshatra(); ?></li>
			<li>Daily Yoga : <?php $todaysDay->showYoga(); ?></li>
			<li>Rahu Kaal : <?php $todaysDay->showRahuKaal(); ?></li>
			<li>Spiritual Practices : <?php $todaysDay->showGulikaKaal(); ?>, before sunrise and during sunset. Avoid for any other important activity.</li>
		</ul>
	</li>
</ul>


	<?php 
if( is_user_logged_in() )
{
	/*
	if( !isset( $profileuser->birth_data ) )
	{
		echo '<div class="message notification">Get your <a href="' . get_linkTO('birth-chart/') . '">free birth chart</a> analysis. Revealing and useful. Takes less than a minute! <a href="' . get_linkTO('birth-chart/') . '">GO &raquo;</a></div>';
	}
	else
	{
	$birth_data = unserialize( $profileuser->birth_data );
	}

	if( !empty( $birth_data ) && $birth_data['has_all_info'] )
	{

		list($mm, $numday, $yyyy, $fullmonth, $dow, $hours, $am_pm) = split('[/.-]', date("m.d.Y.F.w.g.a"));

		if( $am_pm == 'pm' && $hours > 7 )
		{
			$numday = $numday+1;
			$am_pm = 'am';
		}

		$today_data = $birth_data;
		$today_data['month'] = $mm;
		$today_data['day'] = $numday;
		$today_data['year'] = $yyyy;
		$today_data['hour'] = $hours;
		$today_data['am_pm'] = $am_pm;

		$aa = new AstroReport( $birth_data );

		$abc = new AnalyzeChart( $aa );

		$todayTransits = new AstroReport( $today_data );

		$houses = $aa->getHouses();
		$todayPlanet = $todayTransits->getPlanets();

		$refDiff = $todayPlanet['Moon']['fulldegree'] - $houses['ASC']['fulldegree'];

		if( $refDiff < 0 )
		{
			$refDiff += 360;
		}
		$refHouse = (int)($refDiff/30) + 1;
		
		$refDegreeRange = (int)(($refDiff - ($refHouse - 1)*30)/10);
		$refDegreeRange *= 10;
		global $wpdb;

		$horoscope = $wpdb->get_var("SELECT content FROM house_transits WHERE planet_id = 2 AND degree = $refDegreeRange AND house_id = $refHouse");
		echo '<p><strong>Horoscope for ' . date("F d, Y", mktime(0, 0, 0, $mm, $numday, $yyyy)) . '</strong></p>';
		echo '<p>' . $horoscope . '</p>';
		echo '<p><small>Horoscope based on saved birth details for ' . $birth_data['report_name'] . ' <a href="#">change</a></small></p>';

	} else
	{
		$birth_data = array (
						  'timezone' =>
							 array (
							 'hours' => 5,
							 'min' => 30,
							   'direction' => 'E',
						 ),
						'longitude' =>
							array (
							  'degrees' => 75,
							   'min' => 49,
							   'direction' => 'E',
						  ),
						'latitude' =>
			  array (
				'degrees' => 26,
				'min' => 55,
				'direction' => 'N',
			  ),
		  'month' => 7,
		  'day' => 7,
		  'year' => 1986,
		  'hour' => 8,
		  'min' => 53,
		  'report_name' => 'Arpit Tambi',
		  'city' => 'Jaipur',
		  'country' => 'IN',
		  'am_pm' => 'am',
		  'has_all_info' => true,
		);
	}



	if( isset( $profileuser->zodiacsign ) )
	{
		$pgtyp = getZodiacSignByNumber( $profileuser->zodiacsign );
		$pgcat = 'daily';
						$daily_date = strtotime( get_option( $pgcat ) );
				$horoscope = $wpdb->get_var("SELECT content FROM horoscope WHERE zodiac_sign='$pgtyp' AND type='$pgcat' AND start_date='" . date("Y-m-d", $daily_date ) . "'", ARRAY_A);
				
				$addLove = '';
				
				if( $pgcat=="daily-love" )
				{
					$addLove = 'Love ';
				}

				if( $horoscope )
				{
					echo '<p><strong>' . $addLove . 'Horoscope for ' . date("F d, Y", $daily_date ) . '</strong><br /></p>';
					echo $horoscope['content'];
				} else echo "Horoscopes could not be loaded.";
		include(CHILD_TEMPLATEPATH."/include/zodiacmenu.php");
		include(CHILD_TEMPLATEPATH."/include/usermenu.php"); 

	} else
	{		echo '<div style="margin:2em;">';
			include(CHILD_TEMPLATEPATH."/include/setsignform.php");
			echo '</div>';
	}
*/
} else include(CHILD_TEMPLATEPATH. '/include/membership.php' );

		include(CHILD_TEMPLATEPATH."/include/sharing.php");
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
