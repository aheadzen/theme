<?php

define('CHARTS_CACHE', 'charts_cache');
define('CHARTS_CACHE_DIR', ABSPATH . CHARTS_CACHE);

get_header(); 
require_once CHARTS_INCLUDE_DIR . 'functions.php';
require_once CHARTS_INCLUDE_DIR . 'Atlas.php';
require_once CHARTS_INCLUDE_DIR . 'orbit.php';
require_once CHARTS_INCLUDE_DIR . 'planet.php';
require_once CHARTS_INCLUDE_DIR . 'transit.php';
require_once CHARTS_INCLUDE_DIR . 'astroreport.php';
//require_once CHARTS_INCLUDE_DIR . 'ChartMaker.php';
//require_once CHARTS_INCLUDE_DIR . 'NorthernChartMaker.php';
//require_once CHARTS_INCLUDE_DIR . 'PlanetInfo.php';
require_once CHARTS_INCLUDE_DIR . 'AnalyzeChart.php';
require_once CHARTS_INCLUDE_DIR . 'AnalyzeKutas.php';
require_once CHARTS_INCLUDE_DIR . 'DisplayHelper.php';
//require_once CHARTS_INCLUDE_DIR . 'jQuery.php';


$bd_datetime1 = DateTime::createFromFormat(DateTime::ISO8601, get_post_meta($post->ID, 'bd_datetime1', true));
$bd_datetime2 = DateTime::createFromFormat(DateTime::ISO8601, get_post_meta($post->ID, 'bd_datetime2', true));

//list($month1, $numday1, $year1) = split('[/.-]', $bd_datetime1->format("m.d.Y"));
//list($month2, $numday2, $year2) = split('[/.-]', $bd_datetime2->format("m.d.Y"));

//This data doesn't contains Western calculations, needed to be added for Westen signs.
$astro_data = array (
  'timezone' =>
      array (
        'hours' => 4,
        'min' => 0,
        'direction' => 'W',
      ),
  'longitude' =>
      array (
        'degrees' => 74,
        'min' => 0,
        'direction' => 'W',
      ),
  'latitude' =>
      array (
        'degrees' => 40,
        'min' => 42,
        'direction' => 'N',
      ),
  'month' => $month,
  'day' => $numday,
  'year' => $year,
  'hour' => 8,
  'min' => 0,
  'report_name' => 'Astro Data',
  'city' => 'Jaipur',
  'country' => 'IN',
  'am_pm' => 'am',
  'sex' => 'male',
  'has_all_info' => true
);
$male_data = $female_data = $astro_data;
$male_data['month'] = $month1;
$male_data['day'] = $numday1;
$male_data['year'] = $year1;
$male_data['sex'] = 'male';
//$male_data['report_name'] = $bd_datetime1->format("F j, Y");

$female_data['month'] = $month2;
$female_data['day'] = $numday2;
$female_data['year'] = $year2;
$female_data['sex'] = 'female';
//$female_data['report_name'] = $bd_datetime2->format("F j, Y");

//list($hh1, $mm1) = explode(':', date_sunrise($bd_datetime1->getTimestamp(), SUNFUNCS_RET_STRING, $astro_data['latitude']['degrees'] + 0.42, -$astro_data['longitude']['degrees'], 90.50, -4));
//list($hh2, $mm2) = explode(':', date_sunrise($bd_datetime2->getTimestamp(), SUNFUNCS_RET_STRING, $astro_data['latitude']['degrees'] + 0.42, -$astro_data['longitude']['degrees'], 90.50, -4));

$male_data['hour'] = (int)$hh1;
$male_data['min'] = (int)$mm1;

$female_data['hour'] = (int)$hh2;
$female_data['min'] = (int)$mm2;

$male_report = new AstroReport($male_data);
$male_planets = $male_report->getPlanets();
$female_report = new AstroReport($female_data); 
$female_planets = $female_report->getPlanets();

$calculator = new AnalyzeKutas( $male_report, $female_report );
$calculator->prepareKutaReport();
$relationship_calculator = new AnalyzeChart( $male_report );
$relationship_calculator->prepareRelationshipReport( $female_report );

$moonQuery1001 = "SELECT content FROM horo_content WHERE content_type = 4 AND object_id = 1002 AND house_id = %d AND phase_type = %d";
$sunQuery1001 = "SELECT content FROM horo_content WHERE content_type = 4 AND object_id = 1001 AND house_id = %d AND phase_type = %d";
$venusQuery1001 = "SELECT content FROM horo_content WHERE content_type = 4 AND object_id = 1004 AND house_id = %d AND phase_type = %d";

$male_moon1001 = $wpdb->get_var( $wpdb->prepare( $moonQuery1001,	$male_planets['Moon']['sign_number'], (int)$male_planets['Moon']['degree'] ) );
$female_moon1001 = $wpdb->get_var( $wpdb->prepare( $moonQuery1001,	$female_planets['Moon']['sign_number'], (int)$female_planets['Moon']['degree'] ) );

$male_sun1001 = $wpdb->get_var( $wpdb->prepare( $sunQuery1001,	$male_planets['Sun']['sign_number'], (int)$male_planets['Sun']['degree'] ) );
$female_sun1001 = $wpdb->get_var( $wpdb->prepare( $sunQuery1001,	$female_planets['Sun']['sign_number'], (int)$female_planets['Sun']['degree'] ) );

$male_venus1001 = $wpdb->get_var( $wpdb->prepare( $venusQuery1001,	$male_planets['Venus']['sign_number'], (int)$male_planets['Venus']['degree'] ) );
$female_venus1001 = $wpdb->get_var( $wpdb->prepare( $venusQuery1001,	$female_planets['Venus']['sign_number'], (int)$female_planets['Venus']['degree'] ) );
?>
<div id="content1" style="background: #FFF url(<?php linkTO('/wp-content/themes/WP_Premium/images/myhoroscopes.png'); ?>) no-repeat center top;">
<div id="breadcrumbs">
<?php get_breadcrumb() ?>
</div>
		
	<?php 
	if (have_posts()) : while (have_posts()) : the_post(); ?>
	
	<!--post title-->
	<h1 id="post-<?php the_ID(); ?>"><a href="<?php echo get_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>"><?php the_title(); ?></a></h1>
	
	<?php the_content('<p>Read the rest of this entry &raquo;</p>');
//echo h2($male_data['report_name'], ' and ', $female_data['report_name']);
echo h2("Analyzing Capacity to Love");

echo h3( $male_data['report_name'] );

echo h3( "Ascendant Analysis" );
echo "<p>$male_moon1001</p>";
echo "<p>$male_sun1001</p>";
echo "<p>$male_venus1001</p>";

echo "Ascendant: ", $relationship_calculator->male_ascendant_name, br();
echo "Ascendant Lord: ", $relationship_calculator->male_ascendant_lord, br(), br();

echo h4("Planets Influencing Ascendant");

echo ul( $relationship_calculator->male_influences['ASC'] );


echo h5("Planets Influencing Ascendant Lord- ", $relationship_calculator->male_ascendant_lord);

echo ul( $relationship_calculator->male_influences['ASCL'] );

echo h5( "Natures Influencing Ascendant" );
echo ul( $relationship_calculator->male_natures_influencing['ASC'] );

echo h5( "Natures Influencing Ascendant Lord" );
echo ul( $relationship_calculator->male_natures_influencing['ASCL'] );

echo h5( "Ascendant Lord Position" );
echo $relationship_calculator->male_ascendant_lord, " is in the ",
     $relationship_calculator->male_houses['ASCL'],
     " house from the Ascendant. ",
     $relationship_calculator->male_positionals['ASCL'], br(), br();


foreach ( array( 'Moon', 'Sun', 'Venus' ) as $planet )
	echo h4( $planet, " Analysis" ),
	     h5( $planet, " Position" ),
	     $planet, " is in the ",
     	     $relationship_calculator->male_houses[$planet],
     	     " house from the Ascendant. ",
  	     $relationship_calculator->male_positionals[$planet],
	     h5("Planets Influencing ", $planet),
	     ul( $relationship_calculator->male_influences[$planet] ),
	     ul( $relationship_calculator->male_natures_influencing[$planet] );


echo h4( "Marriage and Partnership Analysis" );

echo h5( "7th House: ", $relationship_calculator->male_seventh_house );
echo h5( "7th Lord: ", $relationship_calculator->male_seventh_house_lord );

echo h5( "Planets Influencing 7th House" );
echo ul( $relationship_calculator->male_influences[7] );
echo ul( $relationship_calculator->male_natures_influencing[7] );

echo h5( "Planets Influencing 7th Lord- ", $relationship_calculator->male_seventh_house_lord );
echo ul( $relationship_calculator->male_influences['7L'] );
echo ul( $relationship_calculator->male_natures_influencing['7L'] );

echo h5( "7th Lord Position" );
echo $relationship_calculator->male_seventh_house_lord,
     " is in the ",
     $relationship_calculator->male_houses['7L'],
     " house from the 7th. ",
     $relationship_calculator->male_positionals['7L'], br(), br();





echo h4( $female_data['report_name'] );

echo h4( "Ascendant Analysis" );
echo "<p>$female_moon1001</p>";
echo "<p>$female_sun1001</p>";
echo "<p>$female_venus1001</p>";
echo "Ascendant: ", $relationship_calculator->female_ascendant_name, br();
echo "Ascendant Lord: ", $relationship_calculator->female_ascendant_lord, br(), br();

echo h5("Planets Influencing Ascendant");

echo ul( $relationship_calculator->female_influences['ASC'] );


echo h5("Planets Influencing Ascendant Lord- ", $relationship_calculator->female_ascendant_lord);

echo ul( $relationship_calculator->female_influences['ASCL'] );

echo h5( "Natures Influencing Ascendant" );
echo ul( $relationship_calculator->female_natures_influencing['ASC'] );

echo h5( "Natures Influencing Ascendant Lord" );
echo ul( $relationship_calculator->female_natures_influencing['ASCL'] );

echo h5( "Ascendant Lord Position" );
echo $relationship_calculator->female_ascendant_lord, " is in the ",
     $relationship_calculator->female_houses['ASCL'],
     " house from the Ascendant. ",
     $relationship_calculator->female_positionals['ASCL'], br(), br();


foreach ( array( 'Moon', 'Sun', 'Venus' ) as $planet )
	echo h4( $planet, " Analysis" ),
	     h5( $planet, " Position" ),
	     $planet, " is in the ",
     	     $relationship_calculator->female_houses[$planet],
     	     " house from the Ascendant. ",
  	     $relationship_calculator->female_positionals[$planet],
	     h5("Planets Influencing ", $planet),
	     ul( $relationship_calculator->female_influences[$planet] ),
	     ul( $relationship_calculator->female_natures_influencing[$planet] );


echo h4( "Marriage and Partnership Analysis" );

echo h5( "7th House: ", $relationship_calculator->female_seventh_house );
echo h5( "7th Lord: ", $relationship_calculator->female_seventh_house_lord );

echo h5( "Planets Influencing 7th House" );
echo ul( $relationship_calculator->female_influences[7] );
echo ul( $relationship_calculator->female_natures_influencing[7] );

echo h5( "Planets Influencing 7th Lord- ", $relationship_calculator->female_seventh_house_lord );
echo ul( $relationship_calculator->female_influences['7L'] );
echo ul( $relationship_calculator->female_natures_influencing['7L'] );

echo h5( "7th Lord Position" );
echo $relationship_calculator->female_seventh_house_lord,
     " is in the ",
     $relationship_calculator->female_houses['7L'],
     " house from the 7th. ",
     $relationship_calculator->female_positionals['7L'];




echo h3( "Interplay of Relationship" ),
     h4( "Relative House Position of each other's Ascendant, Sun, Moon and Venus." ),
     begin_ul();
foreach ( $relationship_calculator->relative_positionals as $planet => $positional )
{
     $positional_text = '';
     if ( $positional )
     	$positional_text = ", " . $positional;
     echo li( $planet, "- house ", $relationship_calculator->relative_houses[$planet], $positional_text );
}
echo end_ul();

echo h4( "Deeper Synastry Analysis of each other's Ascendant, Sun, Moon and Venus." ),
     h5( "Influences to ", $female_data['report_name'], "'s Planets in ", $male_data['report_name'], "'s chart." );

foreach ( array( 'Ascendant', 'Sun', 'Moon', 'Venus' ) as $planet )
{
	echo h5( $planet ),
	     ul( $relationship_calculator->female_male_influences[$planet] );
}

echo h5( "Influences to ", $male_data['report_name'], "'s Planets in ", $female_data['report_name'], "'s chart." );


foreach ( array( 'Ascendant', 'Sun', 'Moon', 'Venus' ) as $planet )
{
	echo h5( $planet ),
	     ul( $relationship_calculator->male_female_influences[$planet] );
}

echo h4( "Marriage Compatibility Based on Indian Astrology" );

?>
<TABLE>
<TR>
	<TD>Factor</TD>
	<TD>Person Born on <?php echo get_post_meta($post->ID, 'bd_datetime1', true); ?></TD>
	<TD>Person Born on <?php echo get_post_meta($post->ID, 'bd_datetime2', true); ?></TD>
	<TD>Score</TD>
</TR>
<TR>
	<TD>Nakshatra</TD>
	<TD><?php echo $calculator->male_nakshatra; ?></TD>
	<TD><?php echo $calculator->female_nakshatra; ?></TD>
	<TD></TD>
</TR>
<TR>
	<TD>Nadi</TD>
	<TD><?php echo $calculator->male_dosha; ?></TD>
	<TD><?php echo $calculator->female_dosha; ?></TD>
	<TD><?php echo $calculator->nadiKutaScore;?>/8</TD>
</TR>
<TR>
	<TD>Rashi (Bhakuta)</TD>
	<TD><?php echo $calculator->male_moon_sign_lord; ?></TD>
	<TD><?php echo $calculator->female_moon_sign_lord; ?></TD>
	<TD><?php echo $calculator->rashiKutaScore;?>/7</TD>
</TR>
<TR>
	<TD>Gana</TD>
	<TD><?php echo $calculator->male_gana; ?></TD>
	<TD><?php echo $calculator->female_gana; ?></TD>
	<TD><?php echo $calculator->ganaKutaScore;?>/6</TD>
</TR>
<TR>
	<TD>Graha Maitri</TD>
	<TD><?php echo $calculator->m2f_moon_sign_lord_relationship; ?></TD>
	<TD><?php echo $calculator->f2m_moon_sign_lord_relationship; ?></TD>
	<TD><?php echo $calculator->grahaMaitriScore;?>/5</TD>
</TR>
<TR>
	<TD>Yoni</TD>
	<TD><?php echo $calculator->male_yoni_sex . " " . $calculator->male_yoni; ?></TD>
	<TD><?php echo $calculator->female_yoni_sex . " " . $calculator->female_yoni; ?></TD>
	<TD><?php echo $calculator->yoniKutaScore;?>/4</TD>
</TR>
<TR>
	<TD>Dina</TD>
	<TD><?php echo "Remainder: " . $calculator->dinaRemainder; ?></TD>
	<TD><?php echo "Remainder: " . $calculator->dinaRemainder; ?></TD>
	<TD><?php echo $calculator->dinaKutaScore;?>/3</TD>
</TR>
<TR>
	<TD>Vasya</TD>
	<TD><?php echo $calculator->male_rashi; ?></TD>
	<TD><?php echo $calculator->female_rashi; ?></TD>
	<TD><?php echo $calculator->vasyaKutaScore;?>/2</TD>
</TR>
<TR>
	<TD>Varna</TD>
	<TD><?php echo $calculator->male_varna; ?></TD>
	<TD><?php echo $calculator->female_varna; ?></TD>
	<TD><?php echo $calculator->varnaKutaScore;?>/1</TD>
</TR>
<TR>
	<TD colspan="3">Total Score</TD>
	<TD><?php echo $calculator->totalKutaScore;?></TD>
</TR>
<TR>
	<TD>Manglik (Kuja Dosha)</TD>
	<TD><?php echo $calculator->male_kuja_dosha; ?></TD>
	<TD><?php echo $calculator->female_kuja_dosha; ?></TD>
	<TD><?php echo $calculator->kujaDosha;?></TD>
</TR>
</TABLE>

	<p><strong>If you enjoyed this post, please consider to <a href="#comments">leave a comment</a> or <a href="<?php if($db_feedburner_address) { echo $db_feedburner_address; } else { bloginfo('rss2_url'); } ?>">subscribe to the feed</a> and get future articles delivered to your feed reader.
    </strong></p>	
	<!--include comments template-->
	<?php 		include(CHILD_TEMPLATEPATH."/include/sharing.php");
			comments_template(); ?>
	
	<!--do not delete-->
	<?php endwhile; else: ?>
	
	Sorry, no posts matched your criteria.

	<!--do not delete-->
	<?php endif; ?>
	
	
<!--single.php end-->
</div>

<!--include sidebar-->
<?php get_sidebar();?>
<!--include footer-->
<?php get_footer(); ?>