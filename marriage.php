<?php
/*
Template Name: Marriage Date
*/

define('CHARTS_CACHE', 'charts_cache');
define('CHARTS_CACHE_DIR', ABSPATH . CHARTS_CACHE);
define('CHARTS_INCLUDE_DIR', TEMPLATEPATH . '/include/classes/');

$current_user = wp_get_current_user();
$user_id = $current_user->ID;
$profileuser = get_userdata($user_id);

require_once CHARTS_INCLUDE_DIR . 'functions.php';

get_header();
do_action( 'yit_before_primary' );
?>
<!-- START PRIMARY -->
<div id="primary" class="<?php yit_sidebar_layout() ?>">
    <div class="container group">
	    <div class="row">
	        <?php do_action( 'yit_before_content' ) ?>
	        <!-- START CONTENT -->
	        <div id="content-page" class="span<?php echo yit_get_sidebar_layout() == 'sidebar-no' ? 12 : 9 ?> content group">
	<div id="content1" style="background: #FFF url(<?php linkTO('/wp-content/themes/WP_Premium/images/myhoroscopes.png'); ?>) no-repeat center top;">
<div id="breadcrumbs">
<?php get_breadcrumb() ?>
</div>

<div style="text-align: center;">
<div class="slogan">
	<a href="<?php echo get_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><h2>When Will You Marry<?php //the_title();?></h2></a>
	<h3>Timing of Marriage</h3>
	<div class="border margin-top"></div>
	<div class="border"></div>
	<div class="border"></div> 
</div>

	<?php 
if( is_user_logged_in() )
{ 
	$birth_data = unserialize( $profileuser->birth_data );

	$payment = unserialize( $profileuser->payment );

	if( $payment['MR']['status'] == 'PAID' )
	{
		if( $birth_data['has_all_info'])
	{
		require_once CHARTS_INCLUDE_DIR . 'Atlas.php';
		require_once CHARTS_INCLUDE_DIR . 'orbit.php';
		require_once CHARTS_INCLUDE_DIR . 'planet.php';
		require_once CHARTS_INCLUDE_DIR . 'transit.php';
		require_once CHARTS_INCLUDE_DIR . 'astroreport.php';
		require_once CHARTS_INCLUDE_DIR . 'AspectsGenerator.php';
		require_once CHARTS_INCLUDE_DIR . 'MarriageGuru.php';

		global $wpdb;
		$birthTS = getBirthTS( $birth_data );
		
		$html = array();
		$html[] = $birth_data['longitude']['degrees'] . '&deg;' . $birth_data['longitude']['min'] . '&prime;' . $birth_data['longitude']['direction'];
		$html[] = ' ';
		$html[] = $birth_data['latitude']['degrees'] . '&deg;' . $birth_data['latitude']['min'] . '&prime;' . $birth_data['latitude']['direction'];
		if( !isset($birth_data['sex']) )
			$birth_data['sex'] = 'female';
		

	?>
	<em>for</em>
	<h1 id="chart"><?php echo $birth_data['report_name'];?></h1>
			<ul id="formElements">
				<li><strong><?php echo ucfirst( $birth_data['sex'] ); ?></strong></li>
				<li><strong><?php echo date("F j, Y g:i A", $birthTS) . ' (UTC ' . Atlas::getTimeZoneString( $birth_data['timezone'] ) . ')'; ?></strong></li>
				<li><strong><?php echo $birth_data['city']; ?></strong></li>
				<li><strong><?php echo join('', $html); ?></strong></li>
			</ul>
	</div>
	<p style="border-bottom: dotted #CCC;"></p>
	<h2>Three best times when you'll certainly get married - </h2>
<?php
		$guru = new MarriageGuru( $birth_data, $birth_data['sex'] );
		$res = $guru->findMarriageDates();

		$html = array();
		$html[] = '<ol>';
		$html[] = '<li>' . $res[0] . '</li>';
		$html[] = '<li>' . $res[1] . '</li>';
		$html[] = '<li>' . $res[2] . '</li>';
		$html[] = '</ol>';
		$html[] = '<h2>Other important times - </h2>';
		$html[] = '<p>Following dates not necessarily indicate a marriage but worth mentioning here as they indicate engagement time, birth of children, periods of growth, success and other important events of your life.</p>';
		$html[] = '<ol>';
		$html[] = '<li>' . $res[3] . '</li>';
		$html[] = '<li>' . $res[4] . '</li>';
		$html[] = '<li>' . $res[5] . '</li>';
		$html[] = '<li>' . $res[6] . '</li>';
		$html[] = '<li>' . $res[7] . '</li>';
		$html[] = '<li>' . $res[8] . '</li>';
		$html[] = '<li>' . $res[9] . '</li>';
		$html[] = '</ol>';

		echo join('', $html);
?>
<p>For any further enquiries and refunds, please <a href="<?php linkTO( 'contact-us/' ); ?>">Contact Us</a> or email - <a href="mailto:admin@ask-oracle.com">admin@ask-oracle.com</a>. Expect a response in less than 24 hours.</p>

<?php
	} else echo '<div class="message notification promptText">We need your birth details. Kindly generate your <a href="' . birthChartURL( 'when-marry' ) . '">birth chart &raquo;</a> to see this report.</div></div>';
	}
	else
	{
		?>
<div class="message notification promptText">
<strong>Price - $25</strong>
<p>7-Day Money Back Guarantee! No Hassles, No Delays, and No Questions Asked!</p>
<?php include CHILD_TEMPLATEPATH . '/include/paypal/MR.php'; ?>
<img  src="https://www.paypal.com/en_US/i/bnr/horizontal_solution_PPeCheck.gif" border="0" alt="Solution Graphics" />
<p>For any further enquiries and refunds, please <a href="<?php linkTO( 'contact-us/' ); ?>">Contact Us</a> or email - <a href="mailto:admin@ask-oracle.com">admin@ask-oracle.com</a>. Expect a response in less than 24 hours.</p>
</div></div>		



<?php
	}

	
} else echo '<div class="message notification promptText">Members only! Please <a href="' . wp_login_url( 'when-marry' ) . '">Log In &raquo;</a> or <a href="' . registrationURL( 'when-marry' ) . '">Create an Account &raquo;</a>.</div></div>';

if( !is_user_logged_in() || $payment['MR']['status'] != 'PAID' )
{
	?>

<p>
	<strong>Find out when will you marry from your birth details. This report tells possible Marriage dates (months and years). No more worries about your marriage future. </strong>
</p>
<p>
This report is prepared by interpreting transits of Jupiter, Saturn and other planets by house and aspect to natal planets in your horoscope chart. <strong>We need your date of birth, time of birth and place of birth to prepare this forecast report.</strong> Only accurate birth data can help in preparation of a precise report.
</p>
<p><strong>Note</strong> &ndash; If you don't know your time of birth, please refer to your birth certificate or consult your parents/elders.</p>
<p><strong>Features and Highlights &ndash;</strong></p>
<ul>
	<li>Discover important dates for relationships, love, and important experiences life has to offer in future. Easy to understand and revealing!</li>
	<li><strong>Examines next 10</strong> Years starting from the date of order placement.</li>
	<li><strong>Delivered via email</strong> within 24 hours of order placement.</li>
	<li>Priced at just <strong>US $25</strong>.</li>
	<li>Satisfaction guaranteed.</li>
	<li>If unsatisfied, you may ask for a refund within 7 days of placing your order.</li>
</ul>
<?php
}
if( is_user_logged_in() )
{ 
	if( $payment['MR']['status'] != 'PAID' )
	{
		?>
<div class="message notification promptText">
<strong>Price - $25</strong>
<p>7-Day Money Back Guarantee! No Hassles, No Delays, and No Questions Asked!</p>
<?php include CHILD_TEMPLATEPATH . '/include/paypal/MR.php'; ?>
<img  src="https://www.paypal.com/en_US/i/bnr/horizontal_solution_PPeCheck.gif" border="0" alt="Solution Graphics" />
<p>For any further enquiries and refunds, please <a href="<?php linkTO( 'contact-us/' ); ?>">Contact Us</a> or email - <a href="mailto:admin@ask-oracle.com">admin@ask-oracle.com</a>. Expect a response in less than 24 hours.</p>
</div>
<?php
	}
}
else
{
	echo '<div class="message notification promptText">Members only! Please <a href="' . wp_login_url( 'when-marry' ) . '">Log In &raquo;</a> or <a href="' . registrationURL( 'when-marry' ) . '">Create an Account &raquo;</a>.</div>';
}
?>

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
