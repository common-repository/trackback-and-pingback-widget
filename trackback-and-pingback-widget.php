<?php
/*
	Plugin Name: Trackback and Pingback Widget
	Plugin URI: http://en.michaeluno.jp/trackback-and-pingback-widget
	Description: Displays trackbacks and pingbacks which belong to the displayed page in a widget.
	Version: 1.0.2.1
	Author: miunosoft, Michael Uno
	Author URI: http://michaeluno.jp
	Text Domain: trackback-and-pingback-widget
	Domain Path: /lang
	Requirements: This plugin requires WordPress >= 3.0 and PHP >= 5.1.2

*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/* 1. Define the common info. */
include_once( dirname( __FILE__ ) . '/front-end/class/TrackbackAndPingbackWidget_Commons.php' );
TrackbackAndPingbackWidget_Commons::setUp( __FILE__ );

/*
 * 2. Front-end
 */
/* 2-1. Localize the plugin */
load_plugin_textdomain( 
	TrackbackAndPingbackWidget_Commons::TEXTDOMAIN, 
	false, 
	dirname( plugin_basename( __FILE__ ) ) . '/language/'
);
			
/* 2-2. Register the widget */
include_once( dirname( __FILE__ ) . '/front-end/class/TrackbackAndPingbackWidget.php' );
add_action( 'widgets_init', 'TrackbackAndPingbackWidget::registerWidget' );


/*
 * 3. Back-end
 */
if ( is_admin() ) {
	
	/* 3-1. Include the admin class. */
	include_once( dirname( __FILE__ ) . '/back-end/class/TrackbackAndPingbackWidget_Admin.php' );
	new TrackbackAndPingbackWidget_Admin( __FILE__ );
	
	
}