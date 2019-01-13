<?php
/**
 * Plugin Name: Awesome WP Comment Rating
 * Plugin URI: https://github.com/mdobydullah/awesome-wp-comment-rating
 * Description: Awesome WP Comment Rating allows users to provide star rating on comment form of WordPress posts, custom posts or pages.
 * Author:  Md. Obydullah
 * Author URI: https://obydul.me
 * Version: 1.0
 * License: GPLv2 or later
 * Text Domain: awesome-wp-comment-rating
 */

/**
==========================================
  plugin's required files
==========================================
 */
require ( plugin_dir_path( __FILE__ ) . 'init.php');
require ( plugin_dir_path( __FILE__ ) . 'functions.php');
require ( plugin_dir_path( __FILE__ ) . 'shortcodes.php');
require ( plugin_dir_path( __FILE__ ) . 'settings/class.settings-api.php');
require ( plugin_dir_path( __FILE__ ) . 'settings/options.php');

// call plugin settings
new AWCR_BYMO_Plugin_Settings();

function awcr_bymo_plugin_option( $option, $section, $default = '' ) {
    $options = get_option( $section );
    if ( isset( $options[$option] ) ) {
    return $options[$option];
    }
    return $default;
}

// add plugin settings page link
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'awcr_bymo_plugin_action_links' );

function awcr_bymo_plugin_action_links( $links ) {
   $links[] = '<a href="'. esc_url( get_admin_url(null, 'options-general.php?page=awesome-wp-comment-rating') ) .'">Settings</a>';
   return $links;
}