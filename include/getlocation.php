<?php
/*
Template Name: Birth Chart Loctation
*/

get_header();
do_action( 'yit_before_primary' ) ?>
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

	<h1 class="btmspace"><a href="<?php echo get_permalink() . '?GetLocation'; ?>" rel="bookmark" title="<?php the_title(); ?>">Birth Location and Time Zone</a></h1>

<?php

if( isset( $profileuser->birth_data ) )
{
	$reportdata = array();
	$reportdata = unserialize( $profileuser->birth_data );
}
if( $_POST['action'] == 'report' )
{
	$reportdata = array();

	$errors = validateReportData($reportdata);

}

	include(CHILD_TEMPLATEPATH."/include/errors.php");


	$placeSearch = Atlas::GetPlace( $reportdata['city'], $reportdata['country'] );
	$birthTS = getBirthTS( $reportdata );

if( ( is_wp_error( $errors ) && $_POST['action'] != 'report' ) || ( empty( $_POST ) && !empty( $reportdata ) ) || (is_wp_error( $errors ) && !$errors->get_error_code() && $_POST['action'] == 'report' ) )
{
	?>
		<ul id="formElements">
			<li><strong><?php echo $reportdata['report_name'];?></strong></li>
			<li><strong><?php echo date("F j, Y", $birthTS); ?></strong></li>
			<li><strong><?php echo date("g:i A", $birthTS); ?></strong></li>
			<li><strong><?php echo $reportdata['city'] . ', ' . Atlas::GetCountryByCode( $reportdata['country'] ); ?></strong></li>
		</ul>
<?php
}
	if( $_POST['action'] == 'report')
	{
		if( is_wp_error( $errors ) )
		{
			if( $errors->get_error_code() )
			{
				include(CHILD_TEMPLATEPATH."/include/reportform.php");
			} else include(CHILD_TEMPLATEPATH."/include/placesearch.php");
		
		}
	}

if( empty( $_POST ) && !empty( $reportdata ) )
{
	if( empty( $reportdata ) )
	{
		echo 'Kindly generate your <a href="' . get_linkTO( 'birth-chart/' ) . '">birth chart</a> first.';
	} else include(CHILD_TEMPLATEPATH."/include/placesearch.php");
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
