<?php
$rand = 3;
$aff = array();
$defaultCTA = 'Get eBook Now';
for($i = 0; $i < 3; $i++)
{
	$aff[$i] = array();
}

$aff[0]['title'] = 'Get Your Ex Lover Back in Your Arms - Fast and Easy';
$aff[0]['url'] = 'http://e3edc5n3i7d7wv9lbcygom3oaj.hop.clickbank.net/';
$aff[0]['desc'] = 'If you have broken up and want to get your guy or gal back, check out this';
$aff[0]['cta'] = $defaultCTA;

$aff[1]['title'] = 'Get Your Ex Boyfriend Back - Fast and Easy';
$aff[1]['url'] = 'http://5bb7dvm3g846zl40833mwlsgfp.hop.clickbank.net/';
$aff[1]['desc'] = 'Discover how to make him fall madly in love with you again...';
$aff[1]['cta'] = $defaultCTA;

$aff[2]['title'] = 'How to Make Him Fall in Love With You - Fast and Easy';
$aff[2]['url'] = 'http://01769vv5f-c40x1kt4r5qeovft.hop.clickbank.net/';
$aff[2]['desc'] = 'Find out how to get what you want from your man and create a great relationship.';
$aff[2]['cta'] = $defaultCTA;

$aff[3]['title'] = 'Find Out When Will You Marry - Fast and Easy';
$aff[3]['url'] = get_linkTO( 'when-marry/' );
$aff[3]['desc'] = 'Get to know when will you marry and start preparing for it right away.';
$aff[3]['cta'] = 'Try Now &raquo;';
?>

<div class="clearboth"></div>
<div id="sharing" style="height: 83px;"><div id="reportIcon"></div>
<h3><a title="100% Risk Free" href="<?php echo $aff[$rand]['url']; ?>"><?php echo $aff[$rand]['title']; ?></a></h3>
<ul>
<li><?php echo $aff[$rand]['desc']; ?></li>
<li class="report"><a title="100% Risk Free" href="<?php echo $aff[$rand]['url']; ?>"><?php echo $aff[$rand]['cta']; ?></a></li>
</div>
<div class="clearboth"></div>