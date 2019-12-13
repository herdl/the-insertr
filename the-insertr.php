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

function theinsertr_register_settings() {
    add_submenu_page('options-general.php', 'TheInsertr', 'TheInsertr', 'manage_options', 'theinsertr', 'theinsertr_settings');
}

function theinsertr_settings() {
    $user = wp_get_current_user();

    if (!current_user_can('administrator')) {
        echo '<p>You are not allowed to access this page.</p>';
        print_r($user->roles);
        return;
    }

    if (isset($_REQUEST['submit'])) {
        if (!isset($_REQUEST['theinsertr_nonce'])) {
            $errorMessage = 'nonce field is missing. Settings NOT saved.';
        } elseif (!wp_verify_nonce($_REQUEST['theinsertr_nonce'], 'theinsertr')) {
            $errorMessage = 'Invalid nonce specified. Settings NOT saved.';
        } else {
            update_option('theinsertr_acf_enable', wp_strip_all_tags($_REQUEST['theinsertr_acf_enable']));
            update_option('theinsertr_yoast_title_enable', wp_strip_all_tags($_REQUEST['theinsertr_yoast_title_enable']));

            $message = get_option('theinsertr_acf_enable') . '<br />';
            $message .= get_option('theinsertr_yoast_title_enable') . '<br />';

            $message .= 'Settings Saved.';
        }
    }

    include_once(__DIR__ . '/templates/settings.php');
}

/**
 * If ACF is enabled add a listener to allow short codes
 */
if (!class_exists('ACF') && get_option('theinsertr_acf_enable') === 'yes') {
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
if (get_option('theinsertr_yoast_title_enable') === 'yes') {
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

add_action('admin_menu', 'theinsertr_register_settings');
add_action('wp_footer', 'theinsertr_render_script');
add_shortcode('insertr', 'insertr_function');
