<?php

add_action('init', 'of_options');
if (!function_exists('of_options')) {

    function of_options() {
        // VARIABLES
        $themename = get_option('current_theme');
        // Populate OptionsFramework option in array for use in theme
        global $of_options;
        $of_options = wpw_get_option('of_options');
        // Background Defaults
        $background_defaults = array('color' => '', 'image' => '', 'repeat' => 'repeat', 'position' => 'top center', 'attachment' => 'scroll');
        //Stylesheet Reader
        global $alt_stylesheets;
		
        // Pull all the categories into an array
        $options_categories = array();
        $options_categories_obj = get_categories();
        foreach ($options_categories_obj as $category) {
            $options_categories[$category->cat_ID] = $category->cat_name;
        }

        // Pull all the pages into an array
        $options_pages = array();
        $options_pages_obj = get_pages('sort_column=post_parent,menu_order');
        $options_pages[''] = 'Select a page:';
        foreach ($options_pages_obj as $page) {
            $options_pages[$page->ID] = $page->post_title;
        }

        // If using image radio buttons, define a directory path
        $imagepath = wpw_theme_url() . '/images/';

        $options = array();
		
		/******************** 
		HOME PAGE SLIDE1
		********************/
        $options[] = array("name" => __("Home Slide 1",APP_TD),
			"icon" => WPW_ADMIN_URL.'images/icons/general_settings.png',
            "type" => "heading");
		
		$options[] = array("name" => __("Slide 1 Settings",APP_TD),
            "class" => "",
			"type" => "header");
			
		 $options[] = array("name" => __("Title",APP_TD),
            "desc" => __("Title will appear in sidebar",APP_TD),
            "id" => "wpw_slide_t1",
			"class" => "",
            "type" => "text");
		$options[] = array("name" => __("Title Icon",APP_TD),
            "desc" => __("Title Icon will appear in sidebar",APP_TD),
            "id" => "wpw_slide_i1",
			"class" => "",
            "type" => "upload");
		$options[] = array("name" => __("Content",APP_TD),
            "desc" => __("Content will appear as main content",APP_TD),
            "id" => "wpw_slide_c1",
			"class" => "",
            "type" => "textarea");
			
		/******************** 
		HOME PAGE SLIDE2
		********************/
        $options[] = array("name" => __("Home Slide 2",APP_TD),
			"icon" => WPW_ADMIN_URL.'images/icons/general_settings.png',
            "type" => "heading");
		
		$options[] = array("name" => __("Slide 2 Settings",APP_TD),
            "class" => "",
			"type" => "header");
			
		 $options[] = array("name" => __("Title",APP_TD),
            "desc" => __("Title will appear in sidebar",APP_TD),
            "id" => "wpw_slide_t2",
			"class" => "",
            "type" => "text");
		$options[] = array("name" => __("Title Icon",APP_TD),
            "desc" => __("Title Icon will appear in sidebar",APP_TD),
            "id" => "wpw_slide_i2",
			"class" => "",
            "type" => "upload");
		$options[] = array("name" => __("Content",APP_TD),
            "desc" => __("Content will appear as main content",APP_TD),
            "id" => "wpw_slide_c2",
			"class" => "",
            "type" => "textarea");
			
		/******************** 
		HOME PAGE SLIDE3
		********************/
        $options[] = array("name" => __("Home Slide 3",APP_TD),
			"icon" => WPW_ADMIN_URL.'images/icons/general_settings.png',
            "type" => "heading");
		
		$options[] = array("name" => __("Slide 3 Settings",APP_TD),
            "class" => "",
			"type" => "header");
			
		 $options[] = array("name" => __("Title",APP_TD),
            "desc" => __("Title will appear in sidebar",APP_TD),
            "id" => "wpw_slide_t3",
			"class" => "",
            "type" => "text");
		$options[] = array("name" => __("Title Icon",APP_TD),
            "desc" => __("Title Icon will appear in sidebar",APP_TD),
            "id" => "wpw_slide_i3",
			"class" => "",
            "type" => "upload");
		$options[] = array("name" => __("Content",APP_TD),
            "desc" => __("Content will appear as main content",APP_TD),
            "id" => "wpw_slide_c3",
			"class" => "",
            "type" => "textarea");
			
		/******************** 
		HOME PAGE SLIDE4
		********************/
        $options[] = array("name" => __("Home Slide 4",APP_TD),
			"icon" => WPW_ADMIN_URL.'images/icons/general_settings.png',
            "type" => "heading");
		
		$options[] = array("name" => __("Slide 4 Settings",APP_TD),
            "class" => "",
			"type" => "header");
			
		 $options[] = array("name" => __("Title",APP_TD),
            "desc" => __("Title will appear in sidebar",APP_TD),
            "id" => "wpw_slide_t4",
			"class" => "",
            "type" => "text");
		$options[] = array("name" => __("Title Icon",APP_TD),
            "desc" => __("Title Icon will appear in sidebar",APP_TD),
            "id" => "wpw_slide_i4",
			"class" => "",
            "type" => "upload");
		$options[] = array("name" => __("Content",APP_TD),
            "desc" => __("Content will appear as main content",APP_TD),
            "id" => "wpw_slide_c4",
			"class" => "",
            "type" => "textarea");
		
		/******************** 
		HOME PAGE SLIDE5
		********************/
        $options[] = array("name" => __("Home Slide 5",APP_TD),
			"icon" => WPW_ADMIN_URL.'images/icons/general_settings.png',
            "type" => "heading");
		
		$options[] = array("name" => __("Slide 5 Settings",APP_TD),
            "class" => "",
			"type" => "header");
			
		 $options[] = array("name" => __("Title",APP_TD),
            "desc" => __("Title will appear in sidebar",APP_TD),
            "id" => "wpw_slide_t5",
			"class" => "",
            "type" => "text");
		$options[] = array("name" => __("Title Icon",APP_TD),
            "desc" => __("Title Icon will appear in sidebar",APP_TD),
            "id" => "wpw_slide_i5",
			"class" => "",
            "type" => "upload");
		$options[] = array("name" => __("Content",APP_TD),
            "desc" => __("Content will appear as main content",APP_TD),
            "id" => "wpw_slide_c5",
			"class" => "",
            "type" => "textarea");
		
		/******************** 
		HOME PAGE SLIDE6
		********************/
        $options[] = array("name" => __("Home Slide 6",APP_TD),
			"icon" => WPW_ADMIN_URL.'images/icons/general_settings.png',
            "type" => "heading");
		
		$options[] = array("name" => __("Slide 6 Settings",APP_TD),
            "class" => "",
			"type" => "header");
			
		 $options[] = array("name" => __("Title",APP_TD),
            "desc" => __("Title will appear in sidebar",APP_TD),
            "id" => "wpw_slide_t6",
			"class" => "",
            "type" => "text");
		$options[] = array("name" => __("Title Icon",APP_TD),
            "desc" => __("Title Icon will appear in sidebar",APP_TD),
            "id" => "wpw_slide_i6",
			"class" => "",
            "type" => "upload");
		$options[] = array("name" => __("Content",APP_TD),
            "desc" => __("Content will appear as main content",APP_TD),
            "id" => "wpw_slide_c6",
			"class" => "",
            "type" => "textarea");
			
		/******************** 
		HOME PAGE SLIDE7
		********************/
        $options[] = array("name" => __("Home Slide 7",APP_TD),
			"icon" => WPW_ADMIN_URL.'images/icons/general_settings.png',
            "type" => "heading");
		
		$options[] = array("name" => __("Slide 7 Settings",APP_TD),
            "class" => "",
			"type" => "header");
			
		 $options[] = array("name" => __("Title",APP_TD),
            "desc" => __("Title will appear in sidebar",APP_TD),
            "id" => "wpw_slide_t7",
			"class" => "",
            "type" => "text");
		$options[] = array("name" => __("Title Icon",APP_TD),
            "desc" => __("Title Icon will appear in sidebar",APP_TD),
            "id" => "wpw_slide_i7",
			"class" => "",
            "type" => "upload");
		$options[] = array("name" => __("Content",APP_TD),
            "desc" => __("Content will appear as main content",APP_TD),
            "id" => "wpw_slide_c7",
			"class" => "",
            "type" => "textarea");
		
		/******************** 
		HOME PAGE SLIDE8
		********************/
        /*$options[] = array("name" => __("Home Slide 8",APP_TD),
			"icon" => WPW_ADMIN_URL.'images/icons/general_settings.png',
            "type" => "heading");
		
		$options[] = array("name" => __("Slide 8 Settings",APP_TD),
            "class" => "",
			"type" => "header");
			
		 $options[] = array("name" => __("Title",APP_TD),
            "desc" => __("Title will appear in sidebar",APP_TD),
            "id" => "wpw_slide_t8",
			"class" => "",
            "type" => "text");
		$options[] = array("name" => __("Title Icon",APP_TD),
            "desc" => __("Title Icon will appear in sidebar",APP_TD),
            "id" => "wpw_slide_i8",
			"class" => "",
            "type" => "upload");
		$options[] = array("name" => __("Content",APP_TD),
            "desc" => __("Content will appear as main content",APP_TD),
            "id" => "wpw_slide_c8",
			"class" => "",
            "type" => "textarea");*/
		
		/******************** 
		HOME PAGE SLIDE9
		********************/
        /*$options[] = array("name" => __("Home Slide 9",APP_TD),
			"icon" => WPW_ADMIN_URL.'images/icons/general_settings.png',
            "type" => "heading");
		
		$options[] = array("name" => __("Slide 9 Settings",APP_TD),
            "class" => "",
			"type" => "header");
			
		 $options[] = array("name" => __("Title",APP_TD),
            "desc" => __("Title will appear in sidebar",APP_TD),
            "id" => "wpw_slide_t9",
			"class" => "",
            "type" => "text");
		$options[] = array("name" => __("Title Icon",APP_TD),
            "desc" => __("Title Icon will appear in sidebar",APP_TD),
            "id" => "wpw_slide_i9",
			"class" => "",
            "type" => "upload");
		$options[] = array("name" => __("Content",APP_TD),
            "desc" => __("Content will appear as main content",APP_TD),
            "id" => "wpw_slide_c9",
			"class" => "",
            "type" => "textarea");*/
		
		/******************** 
		HOME PAGE SLIDE10
		********************/
        /*$options[] = array("name" => __("Home Slide 10",APP_TD),
			"icon" => WPW_ADMIN_URL.'images/icons/general_settings.png',
            "type" => "heading");
		
		$options[] = array("name" => __("Slide 10 Settings",APP_TD),
            "class" => "",
			"type" => "header");
			
		 $options[] = array("name" => __("Title",APP_TD),
            "desc" => __("Title will appear in sidebar",APP_TD),
            "id" => "wpw_slide_t10",
			"class" => "",
            "type" => "text");
		$options[] = array("name" => __("Title Icon",APP_TD),
            "desc" => __("Title Icon will appear in sidebar",APP_TD),
            "id" => "wpw_slide_i10",
			"class" => "",
            "type" => "upload");
		$options[] = array("name" => __("Content",APP_TD),
            "desc" => __("Content will appear as main content",APP_TD),
            "id" => "wpw_slide_c10",
			"class" => "",
            "type" => "textarea");*/
		
		
		/******************** 
		HOME PAGE BANNER
		********************/
		 $options[] = array("name" => __("Home Banner",APP_TD),
			"icon" => WPW_ADMIN_URL.'images/icons/general_settings.png',
            "type" => "heading");
		
		 $options[] = array("name" => __("Banner 1",APP_TD),
            "desc" => __("",APP_TD),
            "id" => "wpw_banner1",
			"class" => "",
            "type" => "upload");
		 $options[] = array("name" => __("Banner 1 URL",APP_TD),
            "desc" => __("",APP_TD),
            "id" => "wpw_banner1_url",
			"class" => "",
            "type" => "text");
			
		$options[] = array("name" => __("Banner 2",APP_TD),
            "desc" => __("",APP_TD),
            "id" => "wpw_banner2",
			"class" => "",
            "type" => "upload");
		 $options[] = array("name" => __("Banner 2 URL",APP_TD),
            "desc" => __("",APP_TD),
            "id" => "wpw_banner2_url",
			"class" => "",
            "type" => "text");
			
		$options[] = array("name" => __("Banner 3",APP_TD),
            "desc" => __("",APP_TD),
            "id" => "wpw_banner3",
			"class" => "",
            "type" => "upload");
		 $options[] = array("name" => __("Banner 3 URL",APP_TD),
            "desc" => __("",APP_TD),
            "id" => "wpw_banner3_url",
			"class" => "",
            "type" => "text");
			
        wpw_update_option('of_template', $options);
    }
}
?>