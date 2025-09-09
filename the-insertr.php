<?php
/**
 * Plugin Name: The Insertr
 * Plugin URI: https://github.com/herdl/the-insertr
 * Description: Wordpress dynamic keyword insertion plugin.
 * Author: Herdl
 * Version: 1.5.0
 * Author URI: https://herdl.com
 */

/**
 * Define ABSPATH 
**/
if (!defined('ABSPATH')) {
  define('ABSPATH', dirname(__FILE__) . '/');
}

require_once(ABSPATH . 'wp-includes/shortcodes.php');
require_once(ABSPATH . 'wp-includes/formatting.php');
require_once(ABSPATH . 'wp-includes/pluggable.php');

if (!defined('WPINC')) {
    die('No direct access allowed');
}

/**
 * Ensure compatibility with PHP 8.2
**/
if (version_compare(PHP_VERSION, '8.2.0', '<')) {
  die('This plugin requires PHP 8.2.0 or higher.');
}

/**
 * Validate and sanitize user inputs
**/
function insertr_function(array $attributes): string {
  try {
    $attributes = shortcode_atts([
      'key' => '',
      'fallback' => '',
      'case' => '',
    ], $attributes, 'insertr');

    $key = sanitize_key($attributes['key']);
    $adword = get_adword($key, $attributes['fallback']);
    $case = sanitize_text_field($attributes['case'] ?? 'lower');

    $adword = apply_case($adword, $case);

    return esc_html($adword);
  } catch (Exception $e) {
    if (defined('WP_DEBUG') && WP_DEBUG) {
      error_log('Insertr Plugin Error: ' . $e->getMessage());
    }
    return esc_html($attributes['fallback']);
  }
}

function get_adword(string $key, string $fallback): string {
  if (isset($_GET[$key])) {
    return sanitize_text_field(urldecode(wp_strip_all_tags($_GET[$key])));
  }
  return sanitize_text_field($fallback);
}

function apply_case(string $adword, string $case): string {
  switch ($case) {
    case 'upper':
      return strtoupper($adword);
    case 'title':
      return ucwords($adword);
    default:
      return strtolower($adword);
  }
}

/**
 * Use nonces for form submissions and AJAX requests
**/
function insertr_nonce_field() {
  wp_nonce_field('insertr_nonce_action', 'insertr_nonce');
}
add_action('admin_init', 'insertr_nonce_field');

add_shortcode('insertr', 'insertr_function');

/**
 * Ensure compatibility with ACF
**/
if (!has_filter('acf/load_value/type=shortcode', 'do_shortcode')) {
    add_filter('acf/load_value/type=shortcode', 'do_shortcode');
}

/**
 * Ensure shortcodes can be used in SEO plugins
**/
if (!has_filter('wpseo_title', 'do_shortcode')) {
    add_filter('wpseo_title', 'do_shortcode');
}

if (!has_filter('wpseo_metadesc', 'do_shortcode')) {
    add_filter('wpseo_metadesc', 'do_shortcode');
}

if (!has_filter('rank_math/frontend/title', 'do_shortcode')) {
    add_filter('rank_math/frontend/title', 'do_shortcode');
}

if (!has_filter('rank_math/frontend/description', 'do_shortcode')) {
    add_filter('rank_math/frontend/description', 'do_shortcode');
}

if (!has_filter('aioseo_title', 'do_shortcode')) {
    add_filter('aioseo_title', 'do_shortcode');
}

if (!has_filter('aioseo_description', 'do_shortcode')) {
    add_filter('aioseo_description', 'do_shortcode');
}

if (!has_filter('seopress_titles_title', 'do_shortcode')) {
    add_filter('seopress_titles_title', 'do_shortcode');
}

if (!has_filter('seopress_titles_desc', 'do_shortcode')) {
    add_filter('seopress_titles_desc', 'do_shortcode');
}
