<?php if( $post->ID != 2834 && is_page_template() )
{ if($ztemplate) {
	if( $pgtyp )
	{
		?>
<div><a rel="nofollow" title="Free Subscribe To RSS Feed" href="http://feeds2.feedburner.com/<?php echo ucfirst( $pgtyp ); ?>Horoscopes" ><img alt="Free Subscribe To RSS Feed" src="<?php echo site_url();?>/wp-content/themes/WP_Premium/images/rss.png" /></a><a title="Free Horoscopes by Email" href="<?php echo site_url();?>/free-horoscopes-by-email/" ><img alt="Free Horoscopes by Email" src="<?php echo site_url();?>/wp-content/themes/WP_Premium/images/email.png" /></a></div>
<?php
	}
	else
	{ ?>

<p class="reportTxt">Get your exclusive <a href="<?php linkTO( 'birth-chart/future/' ); ?>" title="100% Risk Free">Personalized Horoscope</a> for the year ahead. Discover your best days for relationships, love, money and opportunities that life has to offer in future. Easy to understand and revealing! <a href="<?php linkTO( 'birth-chart/future/' ); ?>" title="100% Risk Free">Try now &raquo;</a></p>

<?php } } ?>
<div class="clearboth"></div>

<div id="sharing"><div id="reportIcon"></div>
<h3><a title="100% Risk Free" href="<?php echo site_url();?>/your-future-forecast-report/">Your Future Forecast Report - Accurate and Helpful</a></h3>
<ul>
<li>Find out what's stored in your future and things that life has to offer.</li>
<li class="report"><a title="100% Risk Free" href="<?php linkTO( 'birth-chart/future/' ); ?>">Try Now &raquo;</a></li>
</div>
<?php } ?>
<div class="clearboth"></div>