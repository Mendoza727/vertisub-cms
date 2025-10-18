<?php


/**
 * Remove unnecessary WordPress features and disable emojis to optimize performance.
 *
 * @return void
 */

function sancho_optimize_performance()
{
    // Remove unnecessary WordPress features
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');

    // Disable emojis
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
}
add_action('init', 'sancho_optimize_performance');