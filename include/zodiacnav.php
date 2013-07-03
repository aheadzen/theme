<?php $zodiac = array("aries", "taurus", "gemini", "cancer", "leo", "virgo", "libra", "scorpio", "sagittarius", "capricorn", "aquarius", "pisces");
	$zflag = false; ?>
<div <?php if(isset($pgtyp)){echo 'class="zodiacbox1"';} else echo 'class="zodiacbox"'; ?> >
<div id="xsnazzy">
<b class="xtop"><b class="xb1"></b><b class="xb2"></b><b class="xb3"></b><b class="xb4"></b></b>
	<div id="zodiacnav" class="dailyhoro">
<h3 id="title">Choose A Zodiac Sign</h3>
<div id="zodiactable">
  <ul id="firstrow">
<?php 
if($post->ID==SIGN_COMPATIBILITY) {
	$zodiactitle = " Love Compatibility";
	$zodiacurl = "sign-compatibility/";
	$zflag = true;
} else if($pgcat == "KY") {
	$zodiactitle = " Qualities and Characteristics";
	$zodiacurl = "";
} else if($pgcat == "singles") {
	$zodiactitle = " Daily Single's Love Horoscope";
	$zodiacurl = "-daily-singles-love-horoscope";
} else if($pgcat == "couples") {
	$zodiactitle = " Daily Couple's Love Horoscope";
	$zodiacurl = "-daily-couples-love-horoscope";
} else if($pgcat == "teen") { 
	$zodiactitle = " Daily Teen Horoscope";
	$zodiacurl = "-daily-teen-horoscope";
} else if($pgcat == "personality") { 
 	$zodiactitle = " Personality";
	$zodiacurl = "-personality";
} else if($pgcat == "career") {
  	$zodiactitle = " Career and Money";
	$zodiacurl = "-career-and-money";
} else if($pgcat == "friendship") { 
  	$zodiactitle = " in Friendship and Relationship";
	$zodiacurl = "-friendship-compatibility";
} else if($pgcat == "love") { 
  	$zodiactitle = " in Love and Romance";
	$zodiacurl = "-in-love-and-romance";
} else if($pgcat == "marriage") { 
   	$zodiactitle = " in Marriage";
	$zodiacurl = "-in-marriage";
} else if($pgcat == "profile") { 
   	$zodiactitle = " Profile Video";
	$zodiacurl = "-profile";
} else if($pgcat == "index") { 
   	$zodiactitle = "Horoscopes";
	$zodiacurl = "horoscope/";
	$zflag = true;
} else {
   	$zodiactitle =  " ".ucfirst($pgcat)." Horoscope";
	$zodiacurl = "horoscope/".$pgcat."/";
	$zflag = true;
} 

for($zodiacnum = 0; $zodiacnum < 12; $zodiacnum++)
		{
			if($zflag)
			{
				echo '<li class="zodiac '. strtolower(ucfirst($zodiac[$zodiacnum])) .'"><a title="'.ucfirst($zodiac[$zodiacnum]).$zodiactitle.'" href="'.site_url($zodiacurl.$zodiac[$zodiacnum]).'/"><div>'.ucfirst($zodiac[$zodiacnum]).'</div></a></li>';
			} else {
       		 echo '<li class="zodiac '. strtolower(ucfirst($zodiac[$zodiacnum])) .'"><a title="'.ucfirst($zodiac[$zodiacnum]).$zodiactitle.'" href="'.site_url($zodiac[$zodiacnum]).$zodiacurl.'/"><div>'.ucfirst($zodiac[$zodiacnum]).'</div></a></li>';
			}
		}?>
		</ul>
</div>
<div class="clear"></div>
</div>	
<b class="xbottom"><b class="xb4"></b><b class="xb3"></b><b class="xb2"></b><b class="xb1"></b></b>
</div></div>