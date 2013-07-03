<?php
/*
Template Name: Zodiac Pages
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
$daily_zodiac = '';
$zodiac_arr = array('daily','weekly','monthly','yearly');
for($i=0;$i<count($zodiac_arr);$i++)
{
	$daytype = $zodiac_arr[$i];
	if(strstr($_SERVER['REQUEST_URI'],'/horoscope/'.$daytype.'/aries/')){ 
		$daily_zodiac = 'aries';break;
	}elseif(strstr($_SERVER['REQUEST_URI'],'/horoscope/'.$daytype.'/taurus/')){
		$daily_zodiac = 'taurus';break;
	}elseif(strstr($_SERVER['REQUEST_URI'],'/horoscope/'.$daytype.'/gemini/')){
		$daily_zodiac = 'gemini';break;
	}elseif(strstr($_SERVER['REQUEST_URI'],'/horoscope/'.$daytype.'/cancer/')){
		$daily_zodiac = 'cancer';break;
	}elseif(strstr($_SERVER['REQUEST_URI'],'/horoscope/'.$daytype.'/leo/')){
		$daily_zodiac = 'leo';break;
	}elseif(strstr($_SERVER['REQUEST_URI'],'/horoscope/'.$daytype.'/virgo/')){
		$daily_zodiac = 'virgo';break;
	}elseif(strstr($_SERVER['REQUEST_URI'],'/horoscope/'.$daytype.'/libra/')){
		$daily_zodiac = 'libra';break;
	}elseif(strstr($_SERVER['REQUEST_URI'],'/horoscope/'.$daytype.'/scorpio/')){
		$daily_zodiac = 'scorpio';break;
	}elseif(strstr($_SERVER['REQUEST_URI'],'/horoscope/'.$daytype.'/sagittarius/')){
		$daily_zodiac = 'sagittarius';break;
	}elseif(strstr($_SERVER['REQUEST_URI'],'/horoscope/'.$daytype.'/capricorn/')){
		$daily_zodiac = 'capricorn';break;
	}elseif(strstr($_SERVER['REQUEST_URI'],'/horoscope/'.$daytype.'/aquarius/')){
		$daily_zodiac = 'aquarius';break;
	}elseif(strstr($_SERVER['REQUEST_URI'],'/horoscope/'.$daytype.'/pisces/')){
		$daily_zodiac = 'pisces';break;
	}
}

if($daily_zodiac){
?>
<div class="forum horoscopetabs zodiac">
<div id="sub-nav" class="item-list-tabs no-ajax">
<ul>
<li id="home-groups-li"><a href="<?php echo site_url('/horoscope/'.$daytype.'/'.$daily_zodiac.'/');?>"><?php echo $daily_zodiac;?> <?php echo $daytype;?> Overview Horoscope</a></li>
<li id="home-groups-li"><a href="<?php echo site_url('/horoscope/'.$daytype.'-love/'.$daily_zodiac.'/');?>"><?php echo $daily_zodiac;?> <?php echo $daytype;?> Love Horoscope</a></li>
<li id="home-groups-li"><a href="<?php echo site_url('/horoscope/'.$daytype.'-career/'.$daily_zodiac.'/');?>"><?php echo $daily_zodiac;?> <?php echo $daytype;?> Money Horoscope</a></li>

<?php }?>


</ul>
</div>
</div>
<div style="width:100%; clear:both;"></div>



<?php
 $pgtyp = pagetype($post->ID);
 $pgcat = pagecategory($post->ID);
 $ztemplate = true;
 list($month, $numday, $year, $fullmonth, $dow) = split('[/.-]', date("m.d.Y.F.w"));
 ?>
<div id="content1" class="<?php echo $pgtyp;?>">

	<!--loop-->	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
	<!--post title-->
	<div class="slogan">
		<a href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
		<h2>
	<?php if($pgcat=="monthly" || $pgcat=="monthly-career" || $pgcat=="monthly-love")
	{
		if( $pgcat=="monthly-love" )
		{
			$addLove = ' Love ';
		} else if( $pgcat=="monthly-career" )
		{
			$addLove = ' Career ';
		}
		if($numday>22)
			echo ucfirst($pgtyp).' '.date("F Y", mktime(0, 0, 0, $month+1, 28, $year)). $addLove . ' Horoscope';
		else echo ucfirst($pgtyp).' '.$fullmonth.' '.$year. $addLove . ' Horoscope';
	} else the_title(); ?>
		</h2></a>
		<div class="border margin-top"></div>
		<div class="border"></div>
		<div class="border"></div> 
	</div>
	<div id="breadcrumbs">
<?php get_breadcrumb(); ?>
</div>	

	<?php include(CHILD_TEMPLATEPATH."/include/adtop.php");
		include(CHILD_TEMPLATEPATH."/include/adzodiac.php");
			if( $pgcat=="daily" || $pgcat=="daily-love" || $pgcat=="daily-career" )
			{
				$daily_date = strtotime( get_option( $pgcat ) );
				$horoscope = $wpdb->get_row("SELECT content FROM horoscope WHERE zodiac_sign='$pgtyp' AND type='$pgcat' AND start_date='" . date("Y-m-d", $daily_date ) . "'", ARRAY_A);
				
				$addLove = '';
				
				if( $pgcat=="daily-love" )
				{
					$addLove = 'Love ';
				} else if( $pgcat=="daily-career" )
				{
					$addLove = 'Career ';
				}

				if( $horoscope )
				{
					echo '<p><strong>' . $addLove . 'Horoscope for ' . date("F d, Y", $daily_date ) . '</strong><br /></p>';
					echo $horoscope['content'];			
				}
				else the_content('<p class="serif">Read the rest of this page &raquo;</p>');
			}
			else if( $pgcat=="weekly" || $pgcat=="weekly-career" || $pgcat=="weekly-love" )
			{
				$weekly_date = strtotime( get_option( $pgcat ) );
				$horoscope = $wpdb->get_row("SELECT content FROM horoscope WHERE zodiac_sign='$pgtyp' AND type='$pgcat' AND start_date='" . date("Y-m-d", $weekly_date ) . "'", ARRAY_A);

				if( $pgcat=="weekly-love" )
				{
					$addLove = 'Love ';
				} else if( $pgcat=="weekly-career" )
				{
					$addLove = 'Career ';
				}

				if( $horoscope )
				{
					echo '<p><strong>'.ucfirst($pgtyp).' Weekly ' . $addLove . 'horoscope for period '.date("F j, Y",$weekly_date).' to '.date("F j, Y", $weekly_date + 6*86400).'</strong></p>';
					echo $horoscope['content'];			
				}
				else the_content('<p class="serif">Read the rest of this page &raquo;</p>');
			}
			else if( $pgcat=="weekly-love" )
			{
				$weekly_date = strtotime( get_option( $pgcat ) );
				$horoscope = $wpdb->get_row("SELECT content FROM horoscope WHERE zodiac_sign='$pgtyp' AND type='$pgcat' AND start_date='" . date("Y-m-d", $weekly_date ) . "'", ARRAY_A);
				
				if( $horoscope )
				{
					echo '<p><strong>'.ucfirst($pgtyp).' weekly love horoscope for period '.date("F j, Y",$weekly_date).' to '.date("F j, Y", $weekly_date + 6*86400).'</strong></p>';
					echo $horoscope['content'];			
				}
				else the_content('<p class="serif">Read the rest of this page &raquo;</p>');
			}
			else if( $pgcat=="monthly" || $pgcat=="monthly-love" || $pgcat=="monthly-career" )
			{
				$monthly_date = strtotime( get_option( $pgcat ) );
				$horoscope = $wpdb->get_row("SELECT content FROM horoscope WHERE zodiac_sign='$pgtyp' AND type='$pgcat' AND start_date='" . date("Y-m-d", $monthly_date ) . "'", ARRAY_A);
				
				if( $horoscope )
				{
					echo $horoscope['content'];			
				}
				else the_content('<p class="serif">Read the rest of this page &raquo;</p>');
			}
			else the_content('<p class="serif">Read the rest of this page &raquo;</p>'); 
?>
	<!--end of post and end of loop-->
		<?php if($pgcat=="KY" || $pgcat=="marriage" || $pgcat=="love" || $pgcat=="personality" || $pgcat=="friendship" || $pgcat=="career")
				{
					include(CHILD_TEMPLATEPATH."/include/zodiacrelated.php");
				}

		include(CHILD_TEMPLATEPATH."/include/sharing.php");
			include(CHILD_TEMPLATEPATH."/include/zodiacmenu.php");
			include(CHILD_TEMPLATEPATH."/include/zodiacoptions.php"); 
			include(CHILD_TEMPLATEPATH."/include/zodiacnav.php"); 
		 ?>

			<?php if ( comments_open() ) comments_template(); ?>

	<?php endwhile; endif; ?>
		
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



