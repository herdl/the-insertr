<?php
/**
 * Plugin Name: The Insertr
 * Plugin URI: https://github.com/herdl/the-insertr
 * Description: Wordpress dynamic keyword insertion plugin.
 * Author: Herdl
 * Version: 1.6.0
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
 * Allowed HTML tags and attributes for inserted content
**/
function insertr_allowed_html(): array {
  return [
    'br'     => [],
    'strong' => [],
    'em'     => [],
    'b'      => [],
    'i'      => [],
    'span'   => [],
    'a'      => [ 'href' => true, 'target' => true, 'rel' => true ],
    'p'      => [],
  ];
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

    return wp_kses($adword, insertr_allowed_html());
  } catch (Exception $e) {
    if (defined('WP_DEBUG') && WP_DEBUG) {
      error_log('Insertr Plugin Error: ' . $e->getMessage());
    }
    return wp_kses($attributes['fallback'], insertr_allowed_html());
  }
}

function get_adword(string $key, string $fallback): string {
  if (isset($_GET[$key]) && is_string($_GET[$key])) {
    return wp_kses(urldecode($_GET[$key]), insertr_allowed_html());
  }
  return wp_kses($fallback, insertr_allowed_html());
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

add_shortcode('insertr', 'insertr_function');

/**
 * Gutenberg block render callback (reuses shortcode logic).
 */
function insertr_block_render_callback(array $block_attributes, string $content): string {
  $attributes = [
    'key'      => $block_attributes['key'] ?? '',
    'fallback' => $block_attributes['fallback'] ?? '',
    'case'     => $block_attributes['case'] ?? 'lower',
  ];
  $output = insertr_function($attributes);
  if (function_exists('get_block_wrapper_attributes')) {
    return sprintf('<div %1$s>%2$s</div>', get_block_wrapper_attributes(), $output);
  }
  return $output;
}

/**
 * Frontend-safe plugin active check (is_plugin_active is admin-only).
 */
function insertr_is_plugin_active(string $plugin): bool {
  if (function_exists('is_plugin_active')) {
    return is_plugin_active($plugin);
  }
  $active = (array) get_option('active_plugins', []);
  return in_array($plugin, $active, true);
}

/**
 * Ensure compatibility with ACF (Free and Pro)
 */
if (insertr_is_plugin_active('advanced-custom-fields/acf.php') || insertr_is_plugin_active('advanced-custom-fields-pro/acf.php')) {
  if (!has_filter('acf/load_value/type=shortcode', 'do_shortcode')) {
    add_filter('acf/load_value/type=shortcode', 'do_shortcode');
  }
}

/**
 * Ensure shortcodes can be used in SEO plugins (Free and Pro)
 */

// Yoast SEO
if (insertr_is_plugin_active('wordpress-seo/wp-seo.php') || insertr_is_plugin_active('wordpress-seo-premium/wp-seo-premium.php')) {
  if (!has_filter('wpseo_title', 'do_shortcode')) {
    add_filter('wpseo_title', 'do_shortcode');
  }
  if (!has_filter('wpseo_metadesc', 'do_shortcode')) {
    add_filter('wpseo_metadesc', 'do_shortcode');
  }
}

// Rank Math
if (insertr_is_plugin_active('seo-by-rank-math/rank-math.php') || insertr_is_plugin_active('seo-by-rank-math-pro/rank-math-pro.php')) {
  if (!has_filter('rank_math/frontend/title', 'do_shortcode')) {
    add_filter('rank_math/frontend/title', 'do_shortcode');
  }
  if (!has_filter('rank_math/frontend/description', 'do_shortcode')) {
    add_filter('rank_math/frontend/description', 'do_shortcode');
  }
}

// AIOSEO
if (insertr_is_plugin_active('all-in-one-seo-pack/all_in_one_seo_pack.php') || insertr_is_plugin_active('all-in-one-seo-pack-pro/all_in_one_seo_pack_pro.php')) {
  if (!has_filter('aioseo_title', 'do_shortcode')) {
    add_filter('aioseo_title', 'do_shortcode');
  }
  if (!has_filter('aioseo_description', 'do_shortcode')) {
    add_filter('aioseo_description', 'do_shortcode');
  }
}

// SEOPress
if (insertr_is_plugin_active('wp-seopress/seopress.php') || insertr_is_plugin_active('wp-seopress-pro/seopress-pro.php')) {
  if (!has_filter('seopress_titles_title', 'do_shortcode')) {
    add_filter('seopress_titles_title', 'do_shortcode');
  }
  if (!has_filter('seopress_titles_desc', 'do_shortcode')) {
    add_filter('seopress_titles_desc', 'do_shortcode');
  }
}

/**
 * Register Gutenberg block (WP 5.0+); shortcode remains primary for classic editor.
 */
function insertr_register_block() {
  if (!function_exists('register_block_type')) {
    return;
  }

  $block_asset = [
    'key'      => ['type' => 'string', 'default' => 'keyword'],
    'fallback' => ['type' => 'string', 'default' => ''],
    'case'     => ['type' => 'string', 'default' => 'lower'],
  ];

  $script_deps = ['wp-blocks', 'wp-element', 'wp-block-editor', 'wp-components'];
  $build_dir   = plugin_dir_path(__FILE__) . 'build';
  $script_path = $build_dir . '/insertr-block.js';

  $block_args = ['render_callback' => 'insertr_block_render_callback'];
  if (file_exists($script_path)) {
    wp_register_script(
      'herdl-insertr-block-editor',
      plugins_url('build/insertr-block.js', __FILE__),
      $script_deps,
      (string) filemtime($script_path)
    );
    $block_args['editor_script'] = 'herdl-insertr-block-editor';
  }

  if (function_exists('register_block_type_from_metadata') && file_exists($build_dir . '/block.json')) {
    register_block_type_from_metadata($build_dir, $block_args);
  } else {
    register_block_type('herdl/insertr', array_merge([
      'title'       => __('Insertr', 'the-insertr'),
      'category'    => 'text',
      'attributes'  => $block_asset,
    ], $block_args));
  }
}
add_action('init', 'insertr_register_block');
