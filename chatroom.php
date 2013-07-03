<?php
/*
Template Name: ChatRoom
*/
?>
<?php get_header(); ?>
<div id="content2">
<?php if( is_user_logged_in() )
{
	?>
<iframe src="<?php echo site_url();?>/cometchat/modules/chatrooms/index.php?id=1" frameborder="1" width="900" height="600"></iframe>
<link rel='stylesheet' id='group-chat-style-css'  href='<?php echo site_url();?>/cometchat/cometchatcss.php?ver=3.3.1' type='text/css' media='all' />
<script type="text/javascript" src="<?php echo site_url();?>/cometchat/cometchatjs.php?ver=3.3.1"></script>

<?php
} else include(CHILD_TEMPLATEPATH. '/include/membership.php' ); ?>

</div>
<?php get_footer(); ?>



