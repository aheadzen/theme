<?php
@include_once('admin_menu.php');
function wpw_theme_url()
{
	return get_stylesheet_directory_uri();
}

add_action('admin_head','wpw_admin_head_fun'); // hide notification from settings
function wpw_admin_head_fun()
{
	if($_REQUEST['page']=='wpw_theme_options'){
?>
<style type="text/css">
.wrap div.updated, .wrap div.error, .media-upload-form div.error{ display:none;}
</style>
<?php
	}
}

function wpw_get_option($name) {
    $options = get_option('wpw_options');
    if (isset($options[$name]))
        return $options[$name];
}

//
function wpw_update_option($name, $value) {
    $options = get_option('wpw_options');
    $options[$name] = $value;
    return update_option('wpw_options', $options);
}

//
function wpw_delete_option($name) {
    $options = get_option('wpw_options');
    unset($options[$name]);
    return update_option('wpw_options', $options);
}

?>