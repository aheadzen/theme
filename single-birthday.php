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
require_once CHARTS_INCLUDE_DIR . 'ChartMaker.php';
require_once CHARTS_INCLUDE_DIR . 'NorthernChartMaker.php';
require_once CHARTS_INCLUDE_DIR . 'PlanetInfo.php';
//require_once CHARTS_INCLUDE_DIR . 'AnalyzeChart.php';
//require_once CHARTS_INCLUDE_DIR . 'jQuery.php';


$birthdate = DateTime::createFromFormat(DateTime::ISO8601, get_post_meta($post->ID, 'bd_datetime', true));

list($month, $numday, $year, $fullmonth, $dow, $hours, $am_pm, $total_days_month) = split('[/.-]', $birthdate->format("m.d.Y.F.w.g.a.t"));

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
  'has_all_info' => true,
  'type' => 'western'
);
list($hh, $mm) = explode(':', date_sunrise($birthdate->getTimestamp(), SUNFUNCS_RET_STRING, $astro_data['latitude']['degrees'] + 0.42, -$astro_data['longitude']['degrees'], 90.50, -4));

$astro_data['hour'] = (int)$hh;
$astro_data['min'] = (int)$mm;

$aa = new AstroReport( $astro_data );
		$houses = $aa->getHouses();
		$planets = $aa->getPlanets();
		unset( $planets['Neptune'], $planets['Uranus'], $planets['Pluto'] );

		global $wpdb;

		$birthTS = $birthdate->getTimestamp();
		$prefix = 'bd_';
		$fName = $prefix . '_' . $birthTS . '_D1.png';

		if(!file_exists(CHARTS_CACHE_DIR . '/' . $fName ))
		{
			$maker = new NorthernChartMaker($houses);
			$maker->saveChart( $fName, CHARTS_CACHE_DIR);
		}


?>
<div id="content1" style="background: #FFF url(<?php linkTO('/wp-content/themes/WP_Premium/images/myhoroscopes.png'); ?>) no-repeat center top;">
<div id="breadcrumbs">
<?php get_breadcrumb() ?>
</div>
		
	<?php 
	if (have_posts()) : while (have_posts()) : the_post(); ?>
	
	<!--post title-->
	<h1 id="post-<?php the_ID(); ?>"><a href="<?php echo get_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>"><?php the_title(); ?></a></h1>
	
	<?php the_content('<p>Read the rest of this entry &raquo;</p>'); ?>
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

	<!--post paging-->
	<?php link_pages('<p><strong>Pages:</strong> ', '</p>', 'number'); ?>

	<!--Post Meta-->
	<div class="post-bottom clearfix">
	<!--<?php if (function_exists('the_tags')) { ?><strong>Tags: </strong><?php the_tags('', ', ', ''); ?><br /><?php } ?>-->
	<div class="cat"><span><?php the_category(', ') ?></span></div>
	</div>
	
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