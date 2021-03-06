<?php
/**
 * Simplified Budget Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Simplified Budget
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_SIMPLIFIED_BUDGET_VERSION', '1.0.0' );

/**
 * Enqueue styles
 */
function child_enqueue_styles() {
	wp_enqueue_style( 'simplified-budget-theme-css', '/Leap_files/theme-mobile-app.min.css', array('astra-theme-css'), CHILD_THEME_SIMPLIFIED_BUDGET_VERSION, 'all' );
	wp_enqueue_style( 'simplified-budget-theme-css-style', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_SIMPLIFIED_BUDGET_VERSION, 'all' );
}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );
