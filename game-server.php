<?php
/*
Plugin Name: MT Game Server Status
Description: Check the set servers statuses
Plugin URI: https://mitchbrooks.co.uk
Author: mitchbrooks
Version: 1.0.2
*/

// Include Api Libary
require dirname( __FILE__ ) . '/GameQ/Autoloader.php';

// Include Custom Post
require dirname( __FILE__ ) . '/custom-posts/servers.php';

// Include Cmb2
require dirname( __FILE__ ) . '/cmb2/init.php';

// Include Functions
require dirname( __FILE__ ) . '/functions.php';

// Include Shortcodes
require dirname( __FILE__ ) . '/shortcodes/get_servers.php';
require dirname( __FILE__ ) . '/shortcodes/get_servers_table.php';

// Include Hooks
require dirname( __FILE__ ) . '/templates/hooks.php';

// Enqueue Styles
function game_server_status_styles() {
  wp_enqueue_style( 'mt_game_server_status_main_css', plugins_url('assets/main.min.css',__FILE__ ) );
}
add_action( 'wp_enqueue_scripts', 'game_server_status_styles', 50 );
