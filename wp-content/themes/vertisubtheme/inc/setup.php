<?php

/**
 * Sets up theme defaults and registers support for various WordPress
 * features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs during a child theme's initialization.
 *
 * @since 1.0.0
 */
function sancho_theme_setup()
{
    // Add theme support for various features
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    // Add theme support for custom logo
    add_theme_support('custom-logo', array(
        'header-text' => array('site-title'),
    ));

    // Add custom image sizes
    add_image_size('hero-image', 1920, 1080, true);
    add_image_size('service-thumb', 400, 300, true);
}
add_action('after_setup_theme', 'sancho_theme_setup');
