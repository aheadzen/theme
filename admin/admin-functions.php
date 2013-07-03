<?php
/*-----------------------------------------------------------------------------------*/
/* Head Hook
/*-----------------------------------------------------------------------------------*/
function of_head() { do_action( 'of_head' ); }
/*-----------------------------------------------------------------------------------*/
/* Get the style path currently selected */
/*-----------------------------------------------------------------------------------*/
function of_style_path() {
    $style = $_REQUEST['style'];
    if ($style != '') {
        $style_path = $style;
    } else {
        $stylesheet = wpw_get_option('of_alt_stylesheet');
        $style_path = str_replace(".css","",$stylesheet);
    }
    if ($style_path == "default")
      echo 'images';
    else
      echo 'styles/'.$style_path;
}
/*-----------------------------------------------------------------------------------*/
/* Add default options after activation */
/*-----------------------------------------------------------------------------------*/
if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {
	//Call action that sets
	add_action('admin_head','of_option_setup');
}
function of_option_setup(){
	//Update EMPTY options
	$of_array = array();
	add_option('of_options',$of_array);
	$template = wpw_get_option('of_template');
	$saved_options = wpw_get_option('of_options');
	$std = '';
	foreach($template as $option) {
		if($option['type'] != 'heading'){
			$id = $option['id'];
			if (isset($option['std'])) {
			$std = $option['std'];
			}
			$db_option = wpw_get_option($id);
			if(empty($db_option)){
				if(is_array($option['type'])) {
					foreach($option['type'] as $child){
						$c_id = $child['id'];
						$c_std = $child['std'];
						wpw_update_option($c_id,$c_std);
						$of_array[$c_id] = $c_std; 
					}
				} else {
					wpw_update_option($id,$std);
					$of_array[$id] = $std;
				}
			}
			else { //So just store the old values over again.
				$of_array[$id] = $db_option;
			}
		}
	}
	wpw_update_option('of_options',$of_array);
}

$alt_stylesheet_path = TEMPLATEPATH . '/skins/';
global $alt_stylesheets;
if ( is_dir($alt_stylesheet_path) ) {
	if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) { 
		while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
			if(stristr($alt_stylesheet_file, ".css") !== false) {
				$alt_stylesheets[$alt_stylesheet_file] = $alt_stylesheet_file;
			}
		}	
	}
}


?>