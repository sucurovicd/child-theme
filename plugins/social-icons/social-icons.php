<?php 
/*
Plugin name: Social icons for CCtheme
Plugin URI: nwebdevelopment.com
Description: Easy setup your social icons in widget area
Author: CodeCrew
Author URI: nwebdevelopment.com
Version: 1.0




*/

require_once "include/admin_settings_social.php";
require_once "include/widget_social.php";


function register_style_social(){
	wp_register_style( "social", plugins_url() . "/social-icons/include/style.css", null, true);
	wp_enqueue_style("social");
}
add_action("wp_enqueue_scripts", "register_style_social" );
 ?>