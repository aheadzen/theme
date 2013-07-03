<?php 
$boxclass = 'zodiacbox1';
if( $urlarylen == 1 || ( $urlarylen == 2 && in_array( $urlarray[1], array('man', 'woman' ) ) ) )
{
	$boxclass = 'zodiacbox';
}
?>

<div class="<?php echo $boxclass; ?>">
<div id="xsnazzy">
<b class="xtop"><b class="xb1"></b><b class="xb2"></b><b class="xb3"></b><b class="xb4"></b></b>
	<div id="zodiacnav" class="dailyhoro">
<h3 id="title">Match <?php echo $currentZ_caps; ?> With Other Zodiac Signs</h3>
<div id="zodiactable">
<ul id="firstrow">
<?php for($zodiacnum = 0; $zodiacnum < 12; $zodiacnum++)
		{
			if($pgtyp < $zodiacnum)
			{
				$anchorURL = $currentZ . '-' . $zodiac[$zodiacnum];
				$anchorTitle = 'Match ' . $currentZ_caps . ' with ' . $zodiac_caps[$zodiacnum];
				if(!empty($is_gender))
				{
					$anchorURL = $currentZ . '-' . $gender . '-' . $zodiac[$zodiacnum] . '-' . $antigender;
					$anchorTitle = 'Match ' . $currentZ_caps . ' ' . $gender_caps . ' with ' . $zodiac_caps[$zodiacnum] . ' ' . $antigender_caps;
				}
			}
			else if($pgtyp > $zodiacnum)
			{
				$anchorURL = $zodiac[$zodiacnum] . '-' . $currentZ;
				$anchorTitle = 'Match ' . $zodiac_caps[$zodiacnum] . ' with ' . $currentZ_caps;
				if(!empty($is_gender))
				{
					$anchorURL = $zodiac[$zodiacnum] . '-' . $antigender . '-' . $currentZ . '-' . $gender;
					$anchorTitle = 'Match ' . $zodiac_caps[$zodiacnum] . ' ' . $antigender_caps . ' with ' . $currentZ_caps . ' ' . $gender_caps;
				}

			}
			else
			{
				$anchorURL = $currentZ . '-' . $currentZ;
				$anchorTitle = 'Match ' . $currentZ_caps . ' with ' . $currentZ_caps;
				if(!empty($is_gender))
				{
					$anchorURL = $currentZ . '-man-' . $currentZ . '-woman';
					$anchorTitle = 'Match ' . $currentZ_caps . ' Man with ' . $currentZ_caps . ' Woman';
				}
			}
		?>	
		<li class="zodiac <?php echo strtolower(ucfirst($zodiac[$zodiacnum]));?>"><a title="<?php echo $anchorTitle; ?>" href="<?php echo site_url();?>/sign-compatibility/<?php echo $anchorURL; ?>/"><div><?php echo $zodiac_caps[$zodiacnum]; ?></div></a></li>
		<?php 
			if($zodiacnum==3 || $zodiacnum==7)
				echo '';

		}?>
		</ul>
	</div>
<div class="clear"></div>
</div>	
<b class="xbottom"><b class="xb4"></b><b class="xb3"></b><b class="xb2"></b><b class="xb1"></b></b>
</div></div>