<?php
/*
Template Name: Horoscope Index
*/
?>
<?php 
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
 //$urlarray = explode('/', substr($_SERVER['REQUEST_URI'], 11));
 if( empty( $urlarray[0] ) )
 {
	$currentZ = '';
	$currentZ_url = '';
	$currentZ_url1 = '';
 	$currentZ_caps = '';
	echo '<div id="content1" class="home">';
	$ztemplate = false;
	$horo_word = 'horoscopes';
}
 else
 {
	$currentZ = $urlarray[0];
	$currentZ_url = $currentZ . '/';
	$currentZ_url1 = $currentZ . '-';
	$currentZ_caps = ucfirst($currentZ) . ' ';
	$pgtyp = $currentZ;
	echo '<div id="content1" class="' . $pgtyp .'">';
	$ztemplate = true;
	$horo_word = 'horoscope';
 }
 $pgcat = 'index';
 list($month, $numday, $year, $fullmonth, $dow) = split('[/.-]', date("m.d.Y.F.w"));
 ?>
<div id="breadcrumbs">
<?php get_breadcrumb() ?>
</div>
<div class="forum horoscopetabs">
<div id="sub-nav" class="item-list-tabs no-ajax">
<ul>
<li id="home-groups-li"><a href="<?php echo site_url('/horoscope/daily/');?>">Daily Horoscope</a></li>
<li id="home-groups-li"><a href="<?php echo site_url('/horoscope/weekly/');?>">Weekly Horoscope</a></li>
<li id="home-groups-li"><a href="<?php echo site_url('/horoscope/monthly/');?>">Monthly Horoscope</a></li>
<li id="home-groups-li"><a href="<?php echo site_url('/horoscope/yearly/');?>">Yearly Horoscope</a></li>
</ul>
</div>
</div>
<div style="width:100%; clear:both;"></div>

	<h1 class="btmspace"><a href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
	<?php the_title(); ?></a></h1>
	<?php include(CHILD_TEMPLATEPATH."/include/adtop.php");
		include(CHILD_TEMPLATEPATH."/include/adzodiac.php"); ?>
	<h2>Ask-Oracle.com's <?php echo $currentZ_caps; ?>Horoscopes</h2>
<ul>
<li><a title="Click to see <?php echo $currentZ_caps; ?>daily horoscope" href="<?php echo site_url();?>/horoscope/daily/<?php echo $currentZ_url; ?>">Free Daily Horoscope</a>
<ul>
<li>Start your day with our daily horoscopes, they're reliable and inspiring. Updated 2 times a day.</li>
</ul>
</li>

<li><a title="Click to see <?php echo $currentZ_caps; ?>weekly horoscope" href="<?php echo site_url();?>/horoscope/weekly/<?php echo $currentZ_url; ?>">Free Weekly Horoscope</a>
<ul>
<li>Weekly Horoscopes are updated every Sunday and they give you a nice overview of the week ahead.</li>
</ul>
</li>
<li><a title="Click to see <?php echo $currentZ_caps; ?>monthly horoscope" href="<?php echo site_url();?>/horoscope/monthly/<?php echo $currentZ_url; ?>">Free Monthly Horoscope</a>
<ul>
<li>Monthly horoscopes are very detailed and don't miss a single thing. Updated in the last week of previous month.</li>
</ul>
</li>
<li><a title="Click to see <?php echo $currentZ_caps; ?>yearly horoscopes" href="<?php echo site_url();?>/horoscope/yearly/<?php echo $currentZ_url; ?>">Free 2012 <?php echo $currentZ_caps; ?> Horoscope</a>

<ul>
<li>Covers an overall theme of the year. It can be difficult to describe each and every event that we experience throughout the year but with support of monthly, weekly and daily horoscopes they do a fair job of forecasting one's life trends.</li>
</ul>
</li>
</ul>
<h2><?php echo $currentZ_caps; ?> Love Horoscopes at Ask-Oracle.com</h2>

<ul>
<li><a title="Daily Love Horoscopes" href="<?php echo site_url();?>/horoscope/daily-love/<?php echo $currentZ_url; ?>">Daily Love Horoscope</a>
<ul>
<li>Daily astrology insights for people who are seeking love or wish to improve 
their current relationship.</li>
</ul>
</li>
<li><a title="Weekly Love Horoscopes" href="<?php echo site_url();?>/horoscope/weekly-love/<?php echo $currentZ_url; ?>">Weekly Love Horoscope</a>

<ul>
<li>Weekly love horoscopes will guide you throughout the week to effectively tackle your love relationships.</li>
</ul>
</li>
<li><a title="Monthly Love Horoscopes" href="<?php echo site_url();?>/horoscope/monthly-love/<?php echo $currentZ_url; ?>">Monthly Love Horoscope</a>
<ul>
<li>Monthly love predictions to connect you with immediate priorities in love relationships this month.</li>
</ul>
</li>
<li><a title="2012 Love Horoscopes" href="<?php echo site_url();?>/horoscope/yearly-love/<?php echo $currentZ_url; ?>">Yearly 2012 Love Horoscope</a>
<ul>
<li>Will this year ring the wedding bells for you? Will he/she accept you this time? All answers to these questions and others in our Yearly love horoscopes section.</li>

</ul>
</li>
</ul>

	<?php include(CHILD_TEMPLATEPATH."/include/sharing.php");
	if($ztemplate === true)
	{
		include(CHILD_TEMPLATEPATH."/include/zodiacoptions.php"); 
		include(CHILD_TEMPLATEPATH."/include/zodiacnav.php"); 	
	}
		 ?>

			<?php if ( comments_open() ) comments_template(); ?>
	
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



