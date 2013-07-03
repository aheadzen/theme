<?php
/*
Template Name: Gifts
*/
?>
<?php get_header();
do_action( 'yit_before_primary' ) ?>
<!-- START PRIMARY -->
<div id="primary" class="<?php yit_sidebar_layout() ?>">
    <div class="container group">
	    <div class="row">
	        <?php do_action( 'yit_before_content' ) ?>
	        <!-- START CONTENT -->
	        <div id="content-page" class="span<?php echo yit_get_sidebar_layout() == 'sidebar-no' ? 12 : 9 ?> content group">

<?php
if( !empty($_GET['to']) )
{
	$to_username = $_GET['to'];
	$to_user = get_user_by( 'login', $to_username );
	$to_user_id = $to_user->ID;
	$to_user_avatar = bp_core_fetch_avatar( array( 'item_id' => $to_user_id, 'type' => 'thumb', 'html' => true, 'alt' => $to_username ) );
	$to_user_permalink =  bp_core_get_user_domain( $to_user->ID, $to_user->user_nicename, $to_user->user_login );
}
else {?>
	<div id="message" class="error">No User Selected, Cannot Send Gifts</div>
<?php } ?>
<?php /*?><link rel='stylesheet' id='bpgift-jcarousel-css'  href='http://www.example.com/wp-content/plugins/buddypress-gifts/includes/templates/css/jquery.jcarousel.css?ver=3.3.1' type='text/css' media='all' />
<link rel='stylesheet' id='bpgift-jcarousel-skin-css'  href='http://www.example.com/wp-content/plugins/buddypress-gifts/includes/templates/css/skin.css?ver=3.3.1' type='text/css' media='all' /><?php */?>
<div id="content1" class="home">
<h1>Send A Gift</h1>
<div id="bpgifts-waiting" style="display:none"><img src="<?php echo plugins_url('/buddypress-gifts/includes/templates/css/loading.gif') ?>" /></div>
<div id="bpgifts-alert"></div>				

<div class="sendgift-panel">
<h2>To: <a href="<?php echo $to_user_permalink; ?>"><?php echo $to_user_avatar . $to_user->user_nicename; ?></a></h2>

<div class="carousel">

<ul id="mycarousel" class="jcarousel-skin-tango">

   <!-- The content goes in here -->

   <?php

   $allgift = bp_gifts_allgift();

   foreach ($allgift as $giftitem) {

    echo '<li><img class="giftitem" id="'.$giftitem->id.'" name="'.$giftitem->gift_name.'" src="'.plugins_url('/buddypress-gifts/includes/images/').$giftitem->gift_image.'" alt="" /></li>';

	}

	?>

</ul>

</div>

	<br/>

	<div class="sendgift-box">

	<div class="giftbox"><img class="giftbox" id="999" name="emptybox" src="<?php echo plugins_url('/buddypress-gifts/includes/images/admin/emptybox.png') ?>" style="float:left"/>

	</div>


<form action="" method="post" id="mysendgift">
	<div id="gift-message">

		<div id="gift-textarea">
			<h3>Short Message</h3>
			<textarea name="gift-message" id="giftms" value="" style="overflow:hidden" cols="50" ></textarea>

		</div>

		<p></p>

		<div id="gift-button">

			<input type="submit" class="button" style="width: 100px; height: 50px;" id="sendgift-button" value="Send Gift"/>
			<input type="hidden" name="to_user" id="to_user" value="<?php echo $to_user_id; ?>"/>

		</div>

	</div>
</form>
	</div>

</div>

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



