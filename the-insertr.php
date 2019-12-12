<?php

/**
 * Plugin Name: The Insertr
 * Plugin URI: https://github.com/herdl/the-insertr
 * Description: Wordpress dynamic keyword insertion plugin.
 * Author: Herdl
 * Version: 1.0.0
 * Author URI: https://herdl.com
 */

if (!defined('WPINC')) {
    die('No direct access allowed');
}

/**
 * If ACF is enabled add a listener to allow short codes
 */
if (!class_exists('ACF')) {
    add_filter('acf/format_value', 'my_acf_format_value');

    function my_acf_format_value($value, $post_id, $field) {
        if (!is_array($value)) {
            $value = do_shortcode($value);
        }

        return $value;
    }
}

/**
 * If Yoast SEO is enabled make sure we can use short codes
 */
if (is_plugin_active('wordpress-seo/wp-seo.php') || is_plugin_active('wordpress-seo-premium/wp-seo-premium.php')) {
    add_filter('wpseo_title', 'my_wpseo_title');

    function my_wpseo_title($title) {
        return do_shortcode($title);
    }
}

function insertr_function(array $attributes): string {
    $attributes = shortcode_atts([
        'key' => '',
        'fallback' => ''
    ], $attributes, 'insertr');

    $key = $attributes['key'];
    $adword = '';

    if (isset($_GET[$key])) {
        $adword = urldecode(wp_strip_all_tags($_GET[$key]));
    } else if ($attributes['fallback']) {
        $adword = $attributes['fallback'];
    }

    return esc_html($adword);
}

add_shortcode('insertr', 'insertr_function');
