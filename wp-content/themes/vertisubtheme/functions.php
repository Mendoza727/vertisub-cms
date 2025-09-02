<?php

/**
 * Sancho Landing Theme Functions
 */

// Theme setup
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

    // Add custom image sizes
    add_image_size('hero-image', 1920, 1080, true);
    add_image_size('service-thumb', 400, 300, true);
}
add_action('after_setup_theme', 'sancho_theme_setup');

// Enqueue styles and scripts
function sancho_enqueue_assets()
{
    // Enqueue styles
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css');
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;900&display=swap');
    wp_enqueue_style('sancho-style', get_stylesheet_uri(), array('bootstrap'), '1.0.0');

    // Enqueue scripts
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', array(), '5.3.0', true);
    wp_enqueue_script('sancho-script', get_template_directory_uri() . '/script.js', array('bootstrap-js'), '1.0.0', true);

    // Localize script for AJAX
    wp_localize_script('sancho-script', 'sancho_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('sancho_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'sancho_enqueue_assets');

// Custom post type for portfolio (optional)
function sancho_create_portfolio_post_type()
{
    register_post_type(
        'portfolio',
        array(
            'labels' => array(
                'name' => 'Portfolio',
                'singular_name' => 'Portfolio Item',
                'add_new' => 'Add New Project',
                'add_new_item' => 'Add New Portfolio Item',
                'edit_item' => 'Edit Portfolio Item',
                'new_item' => 'New Portfolio Item',
                'view_item' => 'View Portfolio Item',
                'search_items' => 'Search Portfolio',
                'not_found' => 'No portfolio items found',
                'not_found_in_trash' => 'No portfolio items found in trash'
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
            'menu_icon' => 'dashicons-portfolio',
            'rewrite' => array('slug' => 'portfolio'),
        )
    );
}
add_action('init', 'sancho_create_portfolio_post_type');

// Custom fields for theme options
function sancho_customize_register($wp_customize)
{
    // Hero Section
    $wp_customize->add_section('sancho_hero', array(
        'title' => 'Hero Section',
        'priority' => 30,
    ));

    // Hero Video URL
    $wp_customize->add_setting('hero_video_url', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('hero_video_url', array(
        'label' => 'Hero Video URL',
        'section' => 'sancho_hero',
        'type' => 'url',
        'description' => 'Upload your hero video (MP4 format recommended)',
    ));

    // Hero Title
    $wp_customize->add_setting('hero_title', array(
        'default' => 'CREATIVIDAD SIN LÍMITES',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('hero_title', array(
        'label' => 'Hero Title',
        'section' => 'sancho_hero',
        'type' => 'text',
    ));

    // Slogan Section
    $wp_customize->add_section('sancho_slogan', array(
        'title' => 'Slogan Section',
        'priority' => 31,
    ));

    $wp_customize->add_setting('slogan_title', array(
        'default' => 'Transformamos ideas en experiencias extraordinarias',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('slogan_title', array(
        'label' => 'Slogan Title',
        'section' => 'sancho_slogan',
        'type' => 'text',
    ));

    $wp_customize->add_setting('slogan_subtitle', array(
        'default' => 'Somos una agencia creativa que combina estrategia, diseño y tecnología para crear marcas memorables y campañas que conectan con las personas.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('slogan_subtitle', array(
        'label' => 'Slogan Subtitle',
        'section' => 'sancho_slogan',
        'type' => 'textarea',
    ));
}
add_action('customize_register', 'sancho_customize_register');

// AJAX handler for contact form (if needed)
function sancho_handle_contact_form()
{
    // Verify nonce
    if (!wp_verify_nonce($_POST['nonce'], 'sancho_nonce')) {
        wp_die('Security check failed');
    }

    // Sanitize form data
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $message = sanitize_textarea_field($_POST['message']);

    // Send email (customize as needed)
    $to = get_option('admin_email');
    $subject = 'New Contact Form Submission';
    $body = "Name: $name\nEmail: $email\nMessage: $message";
    $headers = array('Content-Type: text/html; charset=UTF-8');

    if (wp_mail($to, $subject, $body, $headers)) {
        wp_send_json_success('Message sent successfully!');
    } else {
        wp_send_json_error('Failed to send message.');
    }
}
add_action('wp_ajax_sancho_contact', 'sancho_handle_contact_form');
add_action('wp_ajax_nopriv_sancho_contact', 'sancho_handle_contact_form');

// Add custom admin styles
function sancho_admin_styles()
{
    echo '<style>
        .sancho-admin-header {
            background: #1a1a1a;
            color: white;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .sancho-admin-header h2 {
            color: white;
            margin: 0;
        }
    </style>';
}
add_action('admin_head', 'sancho_admin_styles');

// Security enhancements
function sancho_security_headers()
{
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('X-XSS-Protection: 1; mode=block');
}
add_action('send_headers', 'sancho_security_headers');

// Optimize performance
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


// walker personalizado 
class Vertisub_Walker_Offcanvas extends Walker_Nav_Menu
{

    function start_lvl(&$output, $depth = 0, $args = null)
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"nav-list\">\n"; // usa tu clase
    }

    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        // tus clases personalizadas
        $output .= $indent . '<li class="nav-item">';
        $output .= '<a href="' . esc_attr($item->url) . '" class="nav-link">';
        $output .= esc_html($item->title);
        $output .= '</a>';
    }

    function end_el(&$output, $item, $depth = 0, $args = null)
    {
        $output .= "</li>\n";
    }
}

function vertisub_register_menus()
{
    register_nav_menus(array(
        'primary_menu' => __('Menú Principal', 'vertisub'),
    ));

    register_nav_menus(array(
        'footer_servicios' => __('Footer Servicios', 'vertisub'),
        'footer_empresa'   => __('Footer Empresa', 'vertisub'),
        'footer_legal'     => __('Footer Legal', 'vertisub'),
    ));
}
add_action('after_setup_theme', 'vertisub_register_menus');

function vertisub_add_nav_link_class($atts, $item, $args)
{
    if ($args->theme_location === 'primary_menu') {
        $atts['class'] = 'nav-link'; // tu clase personalizada
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'vertisub_add_nav_link_class', 10, 3);
