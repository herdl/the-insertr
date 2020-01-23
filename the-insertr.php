<?php

/**
 * Plugin Name: The Insertr
 * Plugin URI: https://github.com/herdl/the-insertr
 * Description: Wordpress dynamic keyword insertion plugin.
 * Author: Herdl
 * Version: 1.4.0
 * Author URI: https://herdl.com
 */

if (!defined('WPINC')) {
    die('No direct access allowed');
}

function insertr_function(array $attributes): string {
    $attributes = shortcode_atts([
        'key' => '',
        'fallback' => '',
        'case' => '',
    ], $attributes, 'insertr');

    $key = $attributes['key'];
    $adword = '';
    $case = 'lower';

    if (isset($_GET[$key])) {
        $adword = urldecode(wp_strip_all_tags($_GET[$key]));
    } else if ($attributes['fallback']) {
        $adword = $attributes['fallback'];
    }

    if ($attributes['case']) {
        $case = $attributes['case'];
    }

    if ($case === 'lower') {
        $adword = strtolower($adword);
    } else if ($case === 'upper') {
        $adword = strtoupper($adword);
    } else if ($case === 'title') {
        $adword = ucwords($adword);
    }

    return esc_html($adword);
}

add_shortcode('insertr', 'insertr_function');
