<?php 

/*
Plugin name: Tips for golf
Plugin URI: nwebdevelopment.com
Description: Easy setup your tips about golf and display in widget area 
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
require_once "include/admin_settings_tips.php";
require_once "include/widget-tips.php";

 ?>

 <?php 
 function register_style(){
 	wp_register_style( "tips", plugins_url() . "/tips-cc/include/style.css", null, true );
 	wp_enqueue_style("tips");
 }
 add_action("wp_enqueue_scripts", "register_style" );