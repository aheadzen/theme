<?php get_header();
$city = Atlas::GetCityById( get_post_meta($post->ID, 'place_id', true) );
$dt_Today = new DateTime("now", new DateTimeZone($city['timezone']));
list($month, $numday, $year, $fullmonth, $dow, $hours, $am_pm, $total_days_month) = split('[/.-]', $dt_Today->format("m.d.Y.F.w.g.a.t"));
$astro_data = array (
  'timezone' =>
      array (
        'hours' => 7,
        'min' => 0,
        'direction' => 'W',
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
  'month' => $month,
  'day' => $numday,
  'year' => $year,
  'hour' => 8,
  'min' => 0,
  'report_name' => 'Astro Data',
  'city' => 'Jaipur',
  'country' => 'IN',
  'am_pm' => $am_pm,
  'sex' => 'male',
  'has_all_info' => true,
  'type' => 'western'
);

//$aa = new AstroReport( $astro_data );


?>
<div id="content">
		
	<?php 
	if (have_posts()) : while (have_posts()) : the_post(); ?>
	
	<!--post title-->
	<h1 id="post-<?php the_ID(); ?>"><a href="<?php echo get_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>"><?php the_title(); ?></a></h1>
	<div class="post-meta-top">
	<div class="auth"><span>Posted by <strong><?php the_author_posts_link(); ?></strong></span></div>
	<div class="date"><span><?php the_time('F j, Y'); ?></span></div>
	</div>
	<table>
		<tr>
			<td>Date</td>
			<td>Sunrise</td>
			<td>Sunset</td>
		</tr>
	<?php

	for( $i = 1; $i <= $total_days_month; $i++ )
	{
		$dt_Today->setDate($year, $month, $i);

		$html = array();
		$html[] = '<tr>';
			$html[] = '<td>';
				$html[] = $dt_Today->format("l, F j, Y");
			$html[] = '</td>';
			$html[] = '<td>';
				$html[] = date_sunrise($dt_Today->getTimestamp(), SUNFUNCS_RET_STRING, $city['latitude'], $city['longitude'], 90.50, $dt_Today->getOffset()/3600);
			$html[] = '</td>';
			$html[] = '<td>';
				$html[] = date_sunset($dt_Today->getTimestamp(), SUNFUNCS_RET_STRING, $city['latitude'], $city['longitude'], 90.50, $dt_Today->getOffset()/3600);
			$html[] = '</td>';
		$html[] = '</tr>';
		echo implode('', $html);
	}

	?>
	</table>
	<div class="clearboth"></div>		
	<!--content with more link-->
	Also known as:
	<?php the_content('<p>Read the rest of this entry &raquo;</p>'); ?>
	
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