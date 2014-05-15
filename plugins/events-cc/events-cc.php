<?php 

/*
Plugin name: Upcommimg events golf
Plugin URI: nwebdevelopment.com
Description: Easy setup your upcomming events and display in widget area 
Author: CodeCrew
Author URI: nwebdevelopment.com
Version: 1.0




*/

/*
*
*
* Includes
*
*/
require_once "include/admin_settings.php";
require_once "include/widget-events.php";



function register_style_event(){
	wp_register_style( "events", plugins_url(). "/events-cc/include/style.css", null, true);
	wp_enqueue_style("events");
}
add_action("wp_enqueue_scripts", "register_style_event" );
 ?>