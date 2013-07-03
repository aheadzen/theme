<?php
if(is_int($pgtyp))
{
	$zodiac = array("aries", "taurus", "gemini", "cancer", "leo", "virgo", "libra", "scorpio", "sagittarius", "capricorn", "aquarius", "pisces");
	$currentZ = $zodiac[$pgtyp];
	$currentZ_caps = ucfirst($zodiac[$pgtyp]);
} else
{
	$currentZ = $pgtyp;
	$currentZ_caps = ucfirst($pgtyp);
}
?>
<div id="zmenu" style="background: #FFFFFF; border: 0;">
<ul id="loveul">
<li><h2>There are a few more interesting things for you at Ask-Oracle.com</h2>
	<ul>
	    <li><a title="<?php echo $currentZ_caps; ?> in Love" href="<?php echo site_url();?>/<?php echo $currentZ; ?>-in-love-and-romance/">Love and Sex</a></li>
	    <li><a title="<?php echo $currentZ_caps; ?> Personality" href="<?php echo site_url();?>/<?php echo $currentZ; ?>-personality/">Your Personality</a></li>
	    <li><a title="<?php echo $currentZ_caps; ?> in Friendship" href="<?php echo site_url();?>/<?php echo $currentZ; ?>-friendship-compatibility/">Friendships and Partnerships</a></li>
	    <li><a title="<?php echo $currentZ_caps; ?> Love Compatibility" href="<?php echo site_url();?>/sign-compatibility/<?php echo $currentZ; ?>/">Love Compatibility</a></li>
		<li><a title="<?php echo $currentZ_caps; ?> Characteristics" href="<?php echo site_url();?>/<?php echo $currentZ; ?>/">Qualities and Characteristics</a></li>
	    <li><a title="<?php echo $currentZ_caps; ?> Career" href="<?php echo site_url();?>/<?php echo $currentZ; ?>-career-and-money/">Career and Money</a></li>
	    <li><a title="<?php echo $currentZ_caps; ?> in Marriage" href="<?php echo site_url();?>/<?php echo $currentZ; ?>-in-marriage/">Marriage and You</a></li>
	    <li><a title="Free Personal Horoscopes" href="<?php echo site_url();?>/free-personalized-predictions/">Free Personalized Predictions</a></li>
		<li><a title="lovemeter" href="<?php echo site_url();?>/love-zone/the-famous-love-meter/">The Famous Love Meter</a></li>
	</ul>
</li>
</ul>
</div>