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

function insertr_function($attributes) {
    $attributes = shortcode_atts([
        'key' => '',
        'fallback' => ''
    ], $attributes, 'insertr');

    $key = $attributes['key'];
    $adword = '';

    if (isset($_GET[$key])) {
        $adword = urldecode($_GET[$key]) ;
    } else if ($attributes['fallback']) {
        $adword = $attributes['fallback'];
    }

    return htmlentities($adword);
}

add_shortcode('insertr', 'insertr_function');
