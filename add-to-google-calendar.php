<?php
/*
 * Plugin Name: Add to Google Calendar
 * Description: Adds dynamic URL generation for adding events to Google Calendar in Elementor.
 * Version: 1.0
 * Author: Dmytro Parkhomenko 
 *
 * Requires Plugins: elementor
 * Elementor tested up to: 3.21.0
 * Elementor Pro tested up to: 3.21.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Register Add to Google Calendar Dynamic Tag.
 *
 * Include dynamic tag file and register tag class.
 *
 * @since 1.0.0
 * @param \Elementor\Core\DynamicTags\Manager $dynamic_tags_manager Elementor dynamic tags manager.
 * @return void
 */
function register_add_to_google_calendar_tag( $dynamic_tags_manager ) {

	require_once( __DIR__ . '/tags/add-to-google-calendar-tag.php' );

	$dynamic_tags_manager->register( new \Elementor_Dynamic_Tag_Add_To_Google_Calendar() );

}
add_action( 'elementor/dynamic_tags/register', 'register_add_to_google_calendar_tag' );
