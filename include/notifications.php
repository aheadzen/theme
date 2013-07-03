<?php
add_action( 'bp_setup_globals', 'my_future_report_setup_globals' );
define('CHARTS_INCLUDE_DIR', TEMPLATEPATH . '/include/classes/');
require_once CHARTS_INCLUDE_DIR . 'functions.php';
require_once CHARTS_INCLUDE_DIR . 'Atlas.php';
require_once CHARTS_INCLUDE_DIR . 'orbit.php';
require_once CHARTS_INCLUDE_DIR . 'planet.php';
require_once CHARTS_INCLUDE_DIR . 'transit.php';
require_once CHARTS_INCLUDE_DIR . 'astroreport.php';
require_once CHARTS_INCLUDE_DIR . 'AspectsGenerator.php';
require_once CHARTS_INCLUDE_DIR . 'VimshottariDasha.php';

function my_future_report_setup_globals()
{
	global $bp;

	$bp->future_report->notification_callback        = 'my_future_report_format_notifications';
}

function my_future_report_format_notifications( $action, $item_id, $secondary_item_id, $total_items, $format = 'string' ) {
	global $bp, $wpdb;
	
//if action == 'save_chart' set url and text, also generate notifications when chart is saved.
	$title = '';

	if( $action == 'save_chart' )
	{
		$title = "<div><span style='color: #000;'>Get Your Free Birth Chart</span></div>";
		$title .= '<span>&raquo; Astrological analysis is revealing and useful. Takes less than a minute!</span>';

		return array(
			'text' => $title,
			'link' => get_linkTO('birth-chart/')
		);

	}

	$title = '';
	$notification_action = str_replace( 'transit_aspect_', '', $action);
	list($planet_id, $planet_aspected, $aspect_type, $event_timestamp) = explode('.', $notification_action);

	$planet_in_transit = array_search( $planet_id, AstroData::$PLANET_BY_ID);
	$planet_in_chart = array_search( $planet_aspected, AstroData::$PLANET_BY_ID);
	$aspect_text = AstroData::$ASPECT_NAME[$aspect_type];
	$strTransitDate = date( "F Y", $event_timestamp );

	$qry = "SELECT SUBSTRING(content, 1, 70) as short_content FROM future_report WHERE planet_id = $planet_id AND planet_aspected = $planet_aspected AND aspect_type=$aspect_type";

	$content = $wpdb->get_row($qry, ARRAY_N);

	$title = "<div>Upcoming Trend: <span style='color: #000;'>$planet_in_transit $aspect_text $planet_in_chart - $strTransitDate</span></div>";
	$title .= '<span>&raquo; ' . $content[0] . '...</span>';

	return array(
			'text' => $title,
			'link' => get_linkTo( 'birth-chart/future/?period=next12m#futureNav' )
		);
	}

function my_future_report_delete_notifications( $user_id, $component_name ) {
	global $bp, $wpdb;

	if ( strpos( $_SERVER['REQUEST_URI'], 'report' ) )
		return false;

	return $wpdb->query( $wpdb->prepare( "DELETE FROM {$bp->core->table_name_notifications} WHERE user_id = %d AND component_name = %s", $user_id, $component_name ) );
}

function my_future_report_generate_notifications( $user_id, $birth_data )
{
	if( empty($birth_data) || !$birth_data['has_all_info'] )

		return false;

	$aa = new AstroReport( $birth_data );
	$a = new AspectsGenerator($birth_data);

	$startCount = 0;
	$endCount = 6;
	list($startMonth, $startDay, $startYear) = split('[/.-]', date("m.d.Y", strtotime("-1 day")) );
	list($endMonth, $endDay, $endYear) = split('[/.-]', date("m.d.Y", strtotime("+6 months")) );
	$startPeriod = "$startYear:$startMonth:$startDay:12:00:am";
	$endPeriod = "$endYear:$endMonth:$endDay:12:00:am";

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
//					echo "$a[0] $thisAspect $a[1]: $strTransitDate \r\n";
					$planet_id = $planetNumber[ $a[0] ];
					$planet_aspected = $planetNumber[ $a[1] ];
					$aspect_type = $a[2];

					if( $aspect_type == 240 )
						$aspect_type = 120;

					$notification_action = "$planet_id.$planet_aspected.$aspect_type." . mktime(0, 0, 0, $mm, $dd, $yyyy);
					bp_core_add_notification( 1, $user_id, 'future_report', 'transit_aspect_' . $notification_action );

				}
			}
		}
	}
}

?>