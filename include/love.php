<?php if($post->ID==3) { // This is for Main Love Zone Page ID=3 
	 include(CHILD_TEMPLATEPATH."/include/sharing.php");}
	else if($post->ID==77) { ?>
	<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="550" height="450">
        <param name="movie" value="<?php bloginfo('template_url'); ?>/include/flash/lovemeter.swf" />
        <!--[if !IE]>--><object type="application/x-shockwave-flash" data="<?php bloginfo('template_url'); ?>/include/flash/lovemeter.swf" width="550" height="450">
        <!--<![endif]-->
		<div>
          <p>This is Internet's most popular love meter. Use lovemeter to calculate the percentage love between you and your love partner. This love meter tells the chances of success in a love relationship.</p>
          <p>Please note that the love meter is for fun purpose only. You are advised not to take it too seriously. Try out your favorite celebrity on this <strong>Famous Love Meter</strong>.</p>
          <p>Please <a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a> to view the love meter.</p>
        </div>
		<!--[if !IE]>-->
        </object>
        <!--<![endif]-->
      </object>
	  <p>&nbsp;</p>
<?php } if($post->ID!=3){
		  include(CHILD_TEMPLATEPATH."/include/adtop.php");
		include(CHILD_TEMPLATEPATH."/include/sharing.php");
		include(CHILD_TEMPLATEPATH."/include/lovemenu.php");} ?>
