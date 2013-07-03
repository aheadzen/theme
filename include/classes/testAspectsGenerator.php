<?php

	require_once 'orbit.php';
	require_once 'planet.php';
	require_once 'transit.php';
	require_once 'astroreport.php';
	require_once 'AspectsGenerator.php';


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
$birth_data1 = array (
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
  'day' => 25,
  'year' => 2010,
  'hour' => 8,
  'min' => 53,
  'report_name' => 'Arpit Tambi',
  'city' => 'Jaipur',
  'country' => 'IN',
  'am_pm' => 'am',
  'has_all_info' => true,
);

/*
$birth_data = array (
  'timezone' => 
	  array (
		'hours' => 5,
		'min' => 30,
		'direction' => 'E',
	  ),
  'longitude' => 
	  array (
		'degrees' => 77,
		'min' => 12,
		'direction' => 'E',
	  ),
  'latitude' => 
	  array (
		'degrees' => 28,
		'min' => 36,
		'direction' => 'N',
	  ),
  'month' => 2,
  'day' => 6,
  'year' => 1987,
  'hour' => 6,
  'min' => 15,
  'report_name' => 'Ishani Ahuja',
  'city' => 'New Delhi',
  'country' => 'IN',
  'am_pm' => 'pm',
  'has_all_info' => true,
);
*/

		$aa = new AstroReport( $birth_data );

		$houses = $aa->getHouses();
		$planets = $aa->getPlanets();

		$bb = new AstroReport( $birth_data1 );

		$planets1 = $bb->getPlanets();

var_dump( $planets, $planets1 );

	$a = new AspectsGenerator($birth_data);
	$res = $a->find_aspects("2010:1:1:12:00:am","2010:12:31:12:00:pm");
/*	$res1 = $a->find_aspects_year(2000);
	if(!array_diff($res,$res1))
	print "the two outputs are equal";
*/
	var_dump($res);
	var_dump( base_convert('ah', 32, 10) );
?>
