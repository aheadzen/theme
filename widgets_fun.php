<?php
//================== Widget ==================
if(!class_exists('wpw_horoscopes_related')){
	class wpw_horoscopes_related extends WP_Widget {
		function wpw_horoscopes_related() {
		//Constructor
			$widget_ops = array('classname' => 'widget horoscopes', 'description' => '' );		
			$this->WP_Widget('wpw_horoscopes_related','More Horoscopes Related Zodiac', $widget_ops);
		}
		function widget($args, $instance) {
		// prints the widget
			extract($args, EXTR_SKIP);
			$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
			//$ads = empty($instance['ads']) ? '' : apply_filters('widget_ads', $instance['ads']);
			?>
			<h2><?php echo $title;?></h2>	
			<div class="zmenu widget" id="more_horoscopes_related">
			<div class="recent-post group">
			 <h3>Daily Horoscopes</h3>
			<div class="hentry-post group">
				<div class="thumb-img"><img width="75" height="75" class="yit-image attachment-blog_thumb" src="http://ks4002901.ip-198-100-149.net/wordpress/wp-content/uploads/2013/01/Sunset-75x75.jpg"></div>
			<div class="text">
			<a href="<?php echo site_url();?>/horoscope/daily/aries/" title="Aries Daily Horoscope">
			<h3>Overview</h3>
			</a></div>
			</div>
			<div class="hentry-post group">
				<div class="thumb-img"><img width="75" height="75" class="yit-image attachment-blog_thumb" src="http://ks4002901.ip-198-100-149.net/wordpress/wp-content/uploads/2013/01/Sunset-75x75.jpg"></div>
			<div class="text">
			<a href="<?php echo site_url();?>/horoscope/daily-love/aries/" title="Aries Daily Love Horoscope">
			<h3>Love</h3>
			</a></div>
			</div>
			<div class="hentry-post group">
				<div class="thumb-img"><img width="75" height="75" class="yit-image attachment-blog_thumb" src="http://ks4002901.ip-198-100-149.net/wordpress/wp-content/uploads/2013/01/Sunset-75x75.jpg"></div>
			<div class="text">
			<a href="<?php echo site_url();?>/horoscope/daily-career/aries/" title="Aries Daily Career Horoscope">
			<h3>Career</h3>
			</a></div>
			</div>
			
			<h3>Weekly Horoscopes</h3>
			<div class="hentry-post group">
				<div class="thumb-img"><img width="75" height="75" class="yit-image attachment-blog_thumb" src="http://ks4002901.ip-198-100-149.net/wordpress/wp-content/uploads/2013/01/Sunset-75x75.jpg"></div>
			<div class="text">
			<a href="<?php echo site_url();?>/horoscope/weekly/aries/" title="Aries Weekly Horoscope">
			<h3>Overview</h3>
			</a></div>
			</div>
			<div class="hentry-post group">
				<div class="thumb-img"><img width="75" height="75" class="yit-image attachment-blog_thumb" src="http://ks4002901.ip-198-100-149.net/wordpress/wp-content/uploads/2013/01/Sunset-75x75.jpg"></div>
			<div class="text">
			<a href="<?php echo site_url();?>/horoscope/weekly-love/aries/" title="Aries Weekly Love Horoscope">
			<h3>Love</h3>
			</a></div>
			</div>
			<div class="hentry-post group">
				<div class="thumb-img"><img width="75" height="75" class="yit-image attachment-blog_thumb" src="http://ks4002901.ip-198-100-149.net/wordpress/wp-content/uploads/2013/01/Sunset-75x75.jpg"></div>
			<div class="text">
			<a href="<?php echo site_url();?>/horoscope/weekly-career/aries/" title="Aries Weekly Career Horoscope">
			<h3>Career</h3>
			</a></div>
			</div>
			
			<h3>Monthly Horoscopes</h3>
			<div class="hentry-post group">
				<div class="thumb-img"><img width="75" height="75" class="yit-image attachment-blog_thumb" src="http://ks4002901.ip-198-100-149.net/wordpress/wp-content/uploads/2013/01/Sunset-75x75.jpg"></div>
			<div class="text">
			<a href="<?php echo site_url();?>/horoscope/monthly/aries/" title="Aries Monthly Horoscope">
			<h3>Overview</h3>
			</a></div>
			</div>
			<div class="hentry-post group">
				<div class="thumb-img"><img width="75" height="75" class="yit-image attachment-blog_thumb" src="http://ks4002901.ip-198-100-149.net/wordpress/wp-content/uploads/2013/01/Sunset-75x75.jpg"></div>
			<div class="text">
			<a href="<?php echo site_url();?>/horoscope/monthly-love/aries/" title="Aries Monthly Love Horoscope">
			<h3>Love</h3>
			</a></div>
			</div>
			<div class="hentry-post group">
				<div class="thumb-img"><img width="75" height="75" class="yit-image attachment-blog_thumb" src="http://ks4002901.ip-198-100-149.net/wordpress/wp-content/uploads/2013/01/Sunset-75x75.jpg"></div>
			<div class="text">
			<a href="<?php echo site_url();?>/horoscope/monthly-career/aries/" title="Aries Monthly Career Horoscope">
			<h3>Career</h3>
			</a></div>
			</div>
			
			<h3>Yearly Horoscopes</h3>
			<div class="hentry-post group">
				<div class="thumb-img"><img width="75" height="75" class="yit-image attachment-blog_thumb" src="http://ks4002901.ip-198-100-149.net/wordpress/wp-content/uploads/2013/01/Sunset-75x75.jpg"></div>
			<div class="text">
			<a href="<?php echo site_url();?>/horoscope/yearly/aries/" title="Aries Yearly Horoscope For 2012">
			<h3>Overview</h3>
			</a></div>
			</div>
			<div class="hentry-post group">
				<div class="thumb-img"><img width="75" height="75" class="yit-image attachment-blog_thumb" src="http://ks4002901.ip-198-100-149.net/wordpress/wp-content/uploads/2013/01/Sunset-75x75.jpg"></div>
			<div class="text">
			<a href="<?php echo site_url();?>/horoscope/yearly-love/aries/" title="Aries 2012 Love Horoscope">
			<h3>Love</h3>
			</a></div>
			</div>
			<div class="hentry-post group">
				<div class="thumb-img"><img width="75" height="75" class="yit-image attachment-blog_thumb" src="http://ks4002901.ip-198-100-149.net/wordpress/wp-content/uploads/2013/01/Sunset-75x75.jpg"></div>
			<div class="text">
			<a href="<?php echo site_url();?>/horoscope/yearly-career/aries/" title="Aries 2012 Career Horoscope">
			<h3>Career</h3>
			</a></div>
			</div>
			</div></div>	
			
							
		  <?php /*?> <div class="widget zmenu">
			  <ul>
				<li>
				  <h3>Daily Horoscopes</h3>
				  <ul>
					<li><a href="<?php echo site_url();?>/horoscope/daily/aries/" title="Aries Daily Horoscope">Overview</a></li>
					<li><a href="<?php echo site_url();?>/horoscope/daily-love/aries/" title="Aries Daily Love Horoscope">Love</a></li>
					<li><a href="<?php echo site_url();?>/horoscope/daily-career/aries/" title="Aries Daily Career Horoscope">Career</a></li>
				  </ul>
				</li>
				<li>
				  <h3>Weekly Horoscopes</h3>
				  <ul>
					<li><a href="<?php echo site_url();?>/horoscope/weekly/aries/" title="Aries Weekly Horoscope">Overview</a></li>
					<li><a href="<?php echo site_url();?>/horoscope/weekly-love/aries/" title="Aries Weekly Love Horoscope">Love</a></li>
					<li><a href="<?php echo site_url();?>/horoscope/weekly-career/aries/" title="Aries Weekly Career Horoscope">Career</a></li>
				  </ul>
				</li>
				<li>
				  <h3>Monthly Horoscopes</h3>
				  <ul>
					<li><a href="<?php echo site_url();?>/horoscope/monthly/aries/" title="Aries Monthly Horoscope">Overview</a></li>
					<li><a href="<?php echo site_url();?>/horoscope/monthly-love/aries/" title="Aries Monthly Love Horoscope">Love</a></li>
					<li><a href="<?php echo site_url();?>/horoscope/monthly-career/aries/" title="Aries Monthly Career Horoscope">Career</a></li>
				  </ul>
				</li>
				<li>
				  <h2>Yearly Horoscopes</h2>
				  <ul>
					<li><a href="<?php echo site_url();?>/horoscope/yearly/aries/" title="Aries Yearly Horoscope For 2012">Overview</a></li>
					<li><a href="<?php echo site_url();?>/horoscope/yearly-love/aries/" title="Aries 2012 Love Horoscope">Love</a></li>
					<li><a href="<?php echo site_url();?>/horoscope/yearly-career/aries/" title="Aries 2012 Career Horoscope">Career</a></li>
				  </ul>
				</li>
			  </ul>
			</div>    <?php */?>    
		<?php
		}
		function update($new_instance, $old_instance) {
		//save the widget
			$instance = $old_instance;		
			$instance['title'] = strip_tags($new_instance['title']);
			//$instance['ads'] = ($new_instance['ads']);
			return $instance;
		}
		function form($instance) {
		//widgetform in backend
			$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'ads' => '') );		
			$title = strip_tags($instance['title']);
			//$ads = ($instance['ads']);
	?>
	<p><label for="<?php  echo $this->get_field_id('title'); ?>"><?php _e('Title','wpw');?>: <input class="widefat" id="<?php  echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
	<?php
	}}
	register_widget('wpw_horoscopes_related');
}

if(!class_exists('wpw_horoscopes_more')){
	class wpw_horoscopes_more extends WP_Widget {
		function wpw_horoscopes_more() {
		//Constructor
			$widget_ops = array('classname' => 'widget horoscopes', 'description' => '' );		
			$this->WP_Widget('wpw_horoscopes_more','More Zodiac Links', $widget_ops);
		}
		function widget($args, $instance) {
		// prints the widget
			extract($args, EXTR_SKIP);
			$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
			//$ads = empty($instance['ads']) ? '' : apply_filters('widget_ads', $instance['ads']);
			?>
			<h2><?php echo $title;?></h2>
			<div class="zmenu widget" id="more_horoscopes_related">
			<div class="recent-post group">
			<div class="hentry-post group">
				<div class="thumb-img"><img width="75" height="75" class="yit-image attachment-blog_thumb" src="http://ks4002901.ip-198-100-149.net/wordpress/wp-content/uploads/2013/01/Sunset-75x75.jpg"></div>
			<div class="text">
			<a href="<?php echo site_url();?>/aries/" title="Aries Characteristics">
			<h3>Qualities and Characteristics</h3>
			</a></div>
			</div>
			<div class="hentry-post group">
				<div class="thumb-img"><img width="75" height="75" class="yit-image attachment-blog_thumb" src="http://ks4002901.ip-198-100-149.net/wordpress/wp-content/uploads/2013/01/Sunset-75x75.jpg"></div>
			<div class="text">
			<a href="<?php echo site_url();?>/aries-personality/" title="Aries Personality">
			<h3>Personality</h3>
			</a></div>
			</div>
			<div class="hentry-post group">
				<div class="thumb-img"><img width="75" height="75" class="yit-image attachment-blog_thumb" src="http://ks4002901.ip-198-100-149.net/wordpress/wp-content/uploads/2013/01/Sunset-75x75.jpg"></div>
			<div class="text">
			<a href="<?php echo site_url();?>/aries-friendship-compatibility/" title="Aries in Friendship">
			<h3>Friendship and Partnership</h3>
			</a></div>
			</div>
			<div class="hentry-post group">
				<div class="thumb-img"><img width="75" height="75" class="yit-image attachment-blog_thumb" src="http://ks4002901.ip-198-100-149.net/wordpress/wp-content/uploads/2013/01/Sunset-75x75.jpg"></div>
			<div class="text">
			<a href="<?php echo site_url();?>/sign-compatibility/aries/" title="Aries Love Compatibility">
			<h3>Love Compatibility</h3>
			</a></div>
			</div>
			<div class="hentry-post group">
				<div class="thumb-img"><img width="75" height="75" class="yit-image attachment-blog_thumb" src="http://ks4002901.ip-198-100-149.net/wordpress/wp-content/uploads/2013/01/Sunset-75x75.jpg"></div>
			<div class="text">
			<a href="<?php echo site_url();?>/aries-in-love-and-romance/" title="Aries in Love">
			<h3>Love and Sex</h3>
			</a></div>
			</div>
			<div class="hentry-post group">
				<div class="thumb-img"><img width="75" height="75" class="yit-image attachment-blog_thumb" src="http://ks4002901.ip-198-100-149.net/wordpress/wp-content/uploads/2013/01/Sunset-75x75.jpg"></div>
			<div class="text">
			<a href="<?php echo site_url();?>/aries-in-marriage/" title="Aries in Marriage">
			<h3>Marriage</h3>
			</a></div>
			</div>
			<div class="hentry-post group">
				<div class="thumb-img"><img width="75" height="75" class="yit-image attachment-blog_thumb" src="http://ks4002901.ip-198-100-149.net/wordpress/wp-content/uploads/2013/01/Sunset-75x75.jpg"></div>
			<div class="text">
			<a href="<?php echo site_url();?>/aries-career-and-money/" title="Aries Career">
			<h3>Career and Money</h3>
			</a></div>
			</div>
			<div class="hentry-post group">
				<div class="thumb-img"><img width="75" height="75" class="yit-image attachment-blog_thumb" src="http://ks4002901.ip-198-100-149.net/wordpress/wp-content/uploads/2013/01/Sunset-75x75.jpg"></div>
			<div class="text">
			<a href="<?php echo site_url();?>/free-personalized-predictions/" title="Free Personal Horoscopes">
			<h3>Free Personalized Predictions</h3>
			</a></div>
			</div>
			</div></div>
			
								
		   <?php /*?><div  class="widget" id="zmenu">			  
			  <ul id="zodiacul">
				<li><a href="<?php echo site_url();?>/aries/" title="Aries Characteristics">Qualities and Characteristics</a></li>
				<li><a href="<?php echo site_url();?>/aries-personality/" title="Aries Personality">Personality</a></li>
				<li><a href="<?php echo site_url();?>/aries-friendship-compatibility/" title="Aries in Friendship">Friendship and Partnership</a></li>
				<li><a href="<?php echo site_url();?>/sign-compatibility/aries/" title="Aries Love Compatibility">Love Compatibility</a></li>
				<li><a href="<?php echo site_url();?>/aries-in-love-and-romance/" title="Aries in Love">Love and Sex</a></li>
				<li><a href="<?php echo site_url();?>/aries-in-marriage/" title="Aries in Marriage">Marriage</a></li>
				<li><a href="<?php echo site_url();?>/aries-career-and-money/" title="Aries Career">Career and Money</a></li>
				<li><a href="<?php echo site_url();?>/free-personalized-predictions/" title="Free Personal Horoscopes">Free Personalized Predictions</a></li>
			  </ul>
			</div><?php */?>
        
		<?php
		}
		function update($new_instance, $old_instance) {
		//save the widget
			$instance = $old_instance;		
			$instance['title'] = strip_tags($new_instance['title']);
			//$instance['ads'] = ($new_instance['ads']);
			return $instance;
		}
		function form($instance) {
		//widgetform in backend
			$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'ads' => '') );		
			$title = strip_tags($instance['title']);
			//$ads = ($instance['ads']);
	?>
	<p><label for="<?php  echo $this->get_field_id('title'); ?>"><?php _e('Title','wpw');?>: <input class="widefat" id="<?php  echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
	<?php
	}}
	register_widget('wpw_horoscopes_more');
}

if(!class_exists('wpw_horoscopes_zodiac_sign')){
	class wpw_horoscopes_zodiac_sign extends WP_Widget {
		function wpw_horoscopes_zodiac_sign() {
		//Constructor
			$widget_ops = array('classname' => 'widget zodiac_sign', 'description' => '' );		
			$this->WP_Widget('wpw_horoscopes_zodiac_sign','Choose A Zodiac Sign', $widget_ops);
		}
		function widget($args, $instance) {
		// prints the widget
			extract($args, EXTR_SKIP);
			$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
			//$ads = empty($instance['ads']) ? '' : apply_filters('widget_ads', $instance['ads']);
			?>
			<h2><?php echo $title;?></h2>						
			<div class="zmenu widget dailyhoro_home dailyhoro" id="zmenu">
			<div class="recent-post group">
			<div class="hentry-post group">
				<div class="thumb-img"><img width="75" height="75" class="yit-image attachment-blog_thumb" src="<?php echo get_stylesheet_directory_uri();?>/images/zodiac/aries.png"></div>
			<div class="text">
			<a title="Aries Horoscope" href="<?php echo site_url();?>/horoscope/aries/">
			<h3>Aries</h3>
			</a></div>
			</div>
			<div class="hentry-post group">
				<div class="thumb-img"><img width="75" height="75" class="yit-image attachment-blog_thumb" src="<?php echo get_stylesheet_directory_uri();?>/images/zodiac/taurus.png"></div>
			<div class="text">
			<a title="Taurus Horoscope" href="<?php echo site_url();?>/horoscope/taurus/">
			<h3>Taurus</h3>
			</a></div>
			</div>
			<div class="hentry-post group">
				<div class="thumb-img"><img width="75" height="75" class="yit-image attachment-blog_thumb" src="<?php echo get_stylesheet_directory_uri();?>/images/zodiac/gemini.png"></div>
			<div class="text">
			<a title="Gemini Horoscope" href="<?php echo site_url();?>/horoscope/gemini/">
			<h3>Gemini</h3>
			</a></div>
			</div>
			<div class="hentry-post group">
				<div class="thumb-img"><img width="75" height="75" class="yit-image attachment-blog_thumb" src="<?php echo get_stylesheet_directory_uri();?>/images/zodiac/cancer.png"></div>
			<div class="text">
			<a title="Cancer Horoscope" href="<?php echo site_url();?>/horoscope/cancer/">
			<h3>Cancer</h3>
			</a></div>
			</div>
			<div class="hentry-post group">
				<div class="thumb-img"><img width="75" height="75" class="yit-image attachment-blog_thumb" src="<?php echo get_stylesheet_directory_uri();?>/images/zodiac/leo.png"></div>
			<div class="text">
			<a title="Leo Horoscope" href="<?php echo site_url();?>/horoscope/leo/">
			<h3>Leo</h3>
			</a></div>
			</div>
			<div class="hentry-post group">
				<div class="thumb-img"><img width="75" height="75" class="yit-image attachment-blog_thumb" src="<?php echo get_stylesheet_directory_uri();?>/images/zodiac/virgo.png"></div>
			<div class="text">
			<a title="Virgo Horoscope" href="<?php echo site_url();?>/horoscope/virgo/">
			<h3>Virgo</h3>
			</a></div>
			</div>
			<div class="hentry-post group">
				<div class="thumb-img"><img width="75" height="75" class="yit-image attachment-blog_thumb" src="<?php echo get_stylesheet_directory_uri();?>/images/zodiac/libra.png"></div>
			<div class="text">
			<a title="Libra Horoscope" href="<?php echo site_url();?>/horoscope/libra/">
			<h3>Libra</h3>
			</a></div>
			</div>
			<div class="hentry-post group">
				<div class="thumb-img"><img width="75" height="75" class="yit-image attachment-blog_thumb" src="<?php echo get_stylesheet_directory_uri();?>/images/zodiac/scorpio.png"></div>
			<div class="text">
			<a title="Scorpio Horoscope" href="<?php echo site_url();?>/horoscope/scorpio/">
			<h3>Scorpio</h3>
			</a></div>
			</div>
			<div class="hentry-post group">
				<div class="thumb-img"><img width="75" height="75" class="yit-image attachment-blog_thumb" src="<?php echo get_stylesheet_directory_uri();?>/images/zodiac/sagittarius.png"></div>
			<div class="text">
			<a title="Sagittarius Horoscope" href="<?php echo site_url();?>/horoscope/sagittarius/">
			<h3>Sagittarius</h3>
			</a></div>
			</div>
			<div class="hentry-post group">
				<div class="thumb-img"><img width="75" height="75" class="yit-image attachment-blog_thumb" src="<?php echo get_stylesheet_directory_uri();?>/images/zodiac/capricorn.png"></div>
			<div class="text">
			<a title="Capricorn Horoscope" href="<?php echo site_url();?>/horoscope/capricorn/">
			<h3>Capricorn</h3>
			</a></div>
			</div>
			<div class="hentry-post group">
				<div class="thumb-img"><img width="75" height="75" class="yit-image attachment-blog_thumb" src="<?php echo get_stylesheet_directory_uri();?>/images/zodiac/aquarius.png"></div>
			<div class="text">
			<a title="Aquarius Horoscope" href="<?php echo site_url();?>/horoscope/aquarius/">
			<h3>Aquarius</h3>
			</a></div>
			</div>
			<div class="hentry-post group">
				<div class="thumb-img"><img width="75" height="75" class="yit-image attachment-blog_thumb" src="<?php echo get_stylesheet_directory_uri();?>/images/zodiac/pisces.png"></div>
			<div class="text">
			<a title="Pisces Horoscope" href="<?php echo site_url();?>/horoscope/pisces/">
			<h3>Pisces</h3>
			</a></div>
			</div>
			</div></div>
			
			
		   <?php /*?><div id="zmenu" class="dailyhoro_home dailyhoro">
			  <ul id="zul">
				<li class="zodiac aries"><a title="Aries Horoscope" href="<?php echo site_url();?>/horoscope/aries/"><div>Aries</div></a></li>
				<li class="zodiac taurus"><a title="Taurus Horoscope" href="<?php echo site_url();?>/horoscope/taurus/"><div>Taurus</div></a></li>
				<li class="zodiac gemini"><a title="Gemini Horoscope" href="<?php echo site_url();?>/horoscope/gemini/"><div>Gemini</div></a></li>
				<li class="zodiac cancer"><a title="Cancer Horoscope" href="<?php echo site_url();?>/horoscope/cancer/"><div>Cancer</div></a></li>
				<li class="zodiac leo"><a title="Leo Horoscope" href="<?php echo site_url();?>/horoscope/leo/"><div>Leo</div></a></li>
				<li class="zodiac virgo"><a title="Virgo Horoscope" href="<?php echo site_url();?>/horoscope/virgo/"><div>Virgo</div></a></li>
				<li class="zodiac libra"><a title="Libra Horoscope" href="<?php echo site_url();?>/horoscope/libra/"><div>Libra</div></a></li>
				<li class="zodiac scorpio"><a title="Scorpio Horoscope" href="<?php echo site_url();?>/horoscope/scorpio/"><div>Scorpio</div></a></li>
				<li class="zodiac sagittarius"><a title="Sagittarius Horoscope" href="<?php echo site_url();?>/horoscope/sagittarius/"><div>Sagittarius</div></a></li>
				<li class="zodiac capricorn"><a title="Capricorn Horoscope" href="<?php echo site_url();?>/horoscope/capricorn/"><div>Capricorn</div></a></li>
				<li class="zodiac aquarius"><a title="Aquarius Horoscope" href="<?php echo site_url();?>/horoscope/aquarius/"><div>Aquarius</div></a></li>
				<li class="zodiac pisces"><a title="Pisces Horoscope" href="<?php echo site_url();?>/horoscope/pisces/"><div>Pisces</div></a></li>
			  </ul>
			</div><?php */?>
			<div style="clear:both; width:100%;"></div>
        
		<?php
		}
		function update($new_instance, $old_instance) {
		//save the widget
			$instance = $old_instance;		
			$instance['title'] = strip_tags($new_instance['title']);
			//$instance['ads'] = ($new_instance['ads']);
			return $instance;
		}
		function form($instance) {
		//widgetform in backend
			$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'ads' => '') );		
			$title = strip_tags($instance['title']);
			//$ads = ($instance['ads']);
	?>
	<p><label for="<?php  echo $this->get_field_id('title'); ?>"><?php _e('Title','wpw');?>: <input class="widefat" id="<?php  echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
	<?php
	}}
	register_widget('wpw_horoscopes_zodiac_sign');
}
?>