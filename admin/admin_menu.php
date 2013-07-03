<?php
/////////////////////////////////////////
// ************* Theme Options Page *********** //
$admin_menu_access_level = apply_filters('wpw_admin_menu_access_level_filter',8);
define('TEMPL_ACCESS_USER',8);
add_action('admin_menu', 'wpw_admin_menu'); //Add new menu block to admin side

add_action('wpw_admin_menu', 'wpw_add_admin_menu');
function wpw_admin_menu()
{
	do_action('wpw_admin_menu');	
}
function wpw_add_admin_menu(){
	$menu_title = apply_filters('wpw_admin_menu_title_filter',__('Theme Settings',APP_TD));
	if(function_exists(add_object_page))
    {
       add_object_page("Admin Menu",  $menu_title, TEMPL_ACCESS_USER, 'wpw_theme_options', 'wpw_theme_options_options_page', wpw_theme_url().'/admin/images/favicon.ico'); // title of new sidebar
    }
    else
    {
       add_theme_page("Admin Menu",  $menu_title, TEMPL_ACCESS_USER, 'wpw_theme_options', 'wpw_theme_options_options_page', wpw_theme_url().'/admin/images/favicon.ico'); // title of new sidebar
    }
}

require_once ('admin-functions.php');  // Admin Functions
require_once ('admin-interface.php');  // Admin Interfaces
require_once ('theme-options.php');   // Options panel settings
?>