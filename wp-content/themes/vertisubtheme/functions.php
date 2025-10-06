<?php

/**
 * vertisub Landing Theme Functions
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
    // === ESTILOS ===
    // Bootstrap CSS
    wp_enqueue_style(
        'bootstrap-css',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css',
        array(),
        '5.3.0'
    );

    // AOS CSS (solo una vez, unpkg)
    wp_enqueue_style(
        'aos',
        'https://unpkg.com/aos@2.3.4/dist/aos.css',
        array(),
        '2.3.4'
    );

    // Google Fonts
    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;600;700;900&display=swap',
        array(),
        null
    );

    // Font Awesome
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
        array(),
        '6.4.0'
    );

    // Estilo principal del tema
    wp_enqueue_style(
        'sancho-style',
        get_stylesheet_uri(),
        array('bootstrap-css'),
        wp_get_theme()->get('Version')
    );

    // === SCRIPTS ===
    // jQuery + dependencias
    wp_enqueue_script(
        'jquery',
        'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js',
        array(),
        '3.3.1',
        true
    );

    wp_enqueue_script(
        'jquery-migrate',
        'https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/3.0.1/jquery-migrate.min.js',
        array('jquery'),
        '3.0.1',
        true
    );

    // Plugins
    wp_enqueue_script('jquery-easing', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js', array('jquery'), '1.3', true);
    wp_enqueue_script('jquery-waypoints', 'https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js', array('jquery'), '4.0.1', true);
    wp_enqueue_script('jquery-stellar', 'https://cdnjs.cloudflare.com/ajax/libs/stellar.js/0.6.2/jquery.stellar.min.js', array('jquery'), '0.6.2', true);
    wp_enqueue_script('owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', array('jquery'), '2.3.4', true);
    wp_enqueue_script('magnific-popup', 'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js', array('jquery'), '1.1.0', true);
    wp_enqueue_script('jquery-animate-number', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-animateNumber/0.0.14/jquery.animateNumber.min.js', array('jquery'), '0.0.14', true);
    wp_enqueue_script('bootstrap-datepicker', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js', array('jquery'), '1.9.0', true);
    wp_enqueue_script('jquery-timepicker', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.14.1/jquery.timepicker.min.js', array('jquery'), '1.14.1', true);

    // Bootstrap 5 (bundle incluye Popper)
    wp_enqueue_script(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js',
        array('jquery'),
        '5.3.0',
        true
    );

    // Scrollax
    wp_enqueue_script('scrollax', 'https://cdn.jsdelivr.net/npm/scrollax@1.0.0/scrollax.min.js', array('jquery'), '1.0.0', true);

    // AOS JS (solo una vez, unpkg)
    wp_enqueue_script('aos', 'https://unpkg.com/aos@2.3.4/dist/aos.js', array(), '2.3.4', true);

    // Script principal del tema
    wp_enqueue_script(
        'sancho-script',
        get_template_directory_uri() . '/script.js',
        array('jquery', 'bootstrap'),
        wp_get_theme()->get('Version'),
        true
    );

    // Detecta si estoy en la plantilla "about-us-page.php"
    wp_enqueue_script(
        'aos-about',
        get_template_directory_uri() . '/assets/js/aos-about.js',
        array('aos'),
        null,
        true
    );

    // Localize script para AJAX
    wp_localize_script('sancho-script', 'sancho_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('sancho_nonce'),
    ));

    // === amCharts 5 ===
    wp_enqueue_script('amcharts-core', 'https://cdn.amcharts.com/lib/5/index.js', array(), null, true);
    wp_enqueue_script('amcharts-map', 'https://cdn.amcharts.com/lib/5/map.js', array('amcharts-core'), null, true);
    wp_enqueue_script('amcharts-world', 'https://cdn.amcharts.com/lib/5/geodata/worldLow.js', array('amcharts-core', 'amcharts-map'), null, true);
    wp_enqueue_script('amcharts-animated', 'https://cdn.amcharts.com/lib/5/themes/Animated.js', array('amcharts-core'), null, true);

    if (is_page('ubicacion')) {
        wp_enqueue_script('maps-js', get_template_directory_uri() . '/assets/js/map.js', array('amcharts-core', 'amcharts-map', 'amcharts-world', 'amcharts-animated'), '1.0', true);

        // === Pasar datos de países a JS ===
        $args = array(
            'post_type'      => 'paises',
            'posts_per_page' => -1,
        );
        $query = new WP_Query($args);

        $data = array();

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();

                $slug      = strtolower(get_post_meta(get_the_ID(), '_pais_slug', true));
                $contacto  = get_post_meta(get_the_ID(), '_contacto', true);
                $direccion = get_post_meta(get_the_ID(), '_direccion', true);
                $correos   = get_post_meta(get_the_ID(), '_correos', true);
                $telefonos = get_post_meta(get_the_ID(), '_telefonos', true);
                $whatsapps = get_post_meta(get_the_ID(), '_whatsapps', true);

                $flag_url = "https://flagcdn.com/w80/{$slug}.png";

                $data[$slug] = array(
                    'name'   => get_the_title(),
                    'flag'   => $flag_url,
                    'type'   => 'Oficina Regional',
                    'status' => 'regional',
                    'contacts' => array(
                        'address' => array(
                            'label' => 'Dirección',
                            'value' => wpautop($direccion),
                            'icon'  => 'map-marker-alt',
                        ),
                        'phones' => array(
                            'label'    => 'Teléfonos',
                            'icon'     => 'phone',
                            'multiple' => true,
                            'values'   => array_map(function ($tel) {
                                return array(
                                    'label'  => 'Número',
                                    'number' => $tel,
                                    'link'   => 'tel:' . preg_replace('/\D/', '', $tel),
                                );
                            }, $telefonos ?: []),
                        ),
                        'whatsapp' => array(
                            'label'    => 'WhatsApp',
                            'icon'     => 'comment',
                            'multiple' => true,
                            'values'   => array_map(function ($wa) {
                                return array(
                                    'label'  => 'Número',
                                    'number' => $wa,
                                    'link'   => 'https://wa.me/' . preg_replace('/\D/', '', $wa),
                                );
                            }, $whatsapps ?: []),
                        ),
                        'email' => array(
                            'label' => 'Correo Electrónico',
                            'icon'  => 'envelope',
                            'value' => implode(', ', array_map(function ($mail) {
                                return '<a href="mailto:' . $mail . '">' . $mail . '</a>';
                            }, $correos ?: [])),
                        ),
                    ),
                );
            }
            wp_reset_postdata();
        }

        wp_localize_script('maps-js', 'contactData', $data);
    }
}

add_action('wp_enqueue_scripts', 'sancho_enqueue_assets');

// 🔑 Agregar type="module" SOLO a este bundle
// Asegura que el bundle se cargo como <script type="module" ...>
add_filter('script_loader_tag', function ($tag, $handle, $src) {
    $modules = [
        'vertisub-main',
        'vertisub-cardnews-di3ywfu3-js',
        'vertisub-home-dbjzf9m-js',
        'vertisub-smootherlayout-dpjotzjc-js',
        'vertisub-uppercircle-cxml2tqv-js'
    ];
    if (in_array($handle, $modules, true)) {
        return '<script type="module" src="' . esc_url($src) . '" crossorigin></script>';
    }
    return $tag;
}, 10, 3);


// Certification Post
function vertisub_create_certification_post_type()
{
    register_post_type(
        'certificaciones',
        array(
            'labels' => array(
                'name'               => 'Certificaciones',
                'singular_name'      => 'Certificación',
                'add_new'            => 'Añadir Nueva',
                'add_new_item'       => 'Añadir Nueva Certificación',
                'edit_item'          => 'Editar Certificación',
                'new_item'           => 'Nueva Certificación',
                'view_item'          => 'Ver Certificación',
                'search_items'       => 'Buscar Certificaciones',
                'not_found'          => 'No se encontraron certificaciones',
                'not_found_in_trash' => 'No hay certificaciones en la papelera',
            ),
            'public'      => true,
            'has_archive' => true,
            'menu_icon'   => 'dashicons-awards',
            'supports'    => array('title', 'editor', 'thumbnail'), // ahora incluye descripción
            'rewrite'     => array('slug' => 'certificaciones'),
        )
    );
}
add_action('init', 'vertisub_create_certification_post_type');

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

    // Slogan Section
    $wp_customize->add_section('sancho_slogan', array(
        'title' => 'Slogan Section',
        'priority' => 31,
    ));

    $wp_customize->add_setting('slogan_line1', array(
        'default' => 'Soluciones singulares a problemas',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('slogan_line1', array(
        'label' => 'Slogan Line 1',
        'section' => 'sancho_slogan',
        'type' => 'text',
    ));

    $wp_customize->add_setting('slogan_line2', array(
        'default' => 'complejos en entornos de riesgo',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('slogan_line2', array(
        'label' => 'Slogan Line 2',
        'section' => 'sancho_slogan',
        'type' => 'text',
    ));

    // Sección Misión y Visión
    $wp_customize->add_section('sancho_mision_vision', array(
        'title'    => 'Misión y Visión',
        'priority' => 40,
    ));

    // Misión
    $wp_customize->add_setting('mision_text', array(
        'default'           => 'Desarrollamos soluciones integrales de comunicación que transforman desafíos complejos en oportunidades de crecimiento para nuestros clientes.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('mision_text', array(
        'label'   => 'Texto de Misión',
        'section' => 'sancho_mision_vision',
        'type'    => 'textarea',
    ));

    // Visión
    $wp_customize->add_setting('vision_text', array(
        'default'           => 'Ser la agencia líder en innovación estratégica, reconocida por crear experiencias memorables que conectan marcas con sus audiencias.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('vision_text', array(
        'label'   => 'Texto de Visión',
        'section' => 'sancho_mision_vision',
        'type'    => 'textarea',
    ));

    // Sección Contacto
    $wp_customize->add_section('sancho_contacto', array(
        'title'    => 'Contacto',
        'priority' => 41,
    ));

    $wp_customize->add_setting('contacto_email', array(
        'default'           => 'info@vertisub.com',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('contacto_email', array(
        'label'   => 'Email de Contacto',
        'section' => 'sancho_contacto',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('contacto_telefono', array(
        'default'           => '+57 (4) 123-4567',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('contacto_telefono', array(
        'label'   => 'Teléfono',
        'section' => 'sancho_contacto',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('contacto_direccion', array(
        'default'           => 'Bogota, Colombia',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('contacto_direccion', array(
        'label'   => 'Dirección',
        'section' => 'sancho_contacto',
        'type'    => 'text',
    ));

    // Sección Legal
    $wp_customize->add_section('sancho_legal', array(
        'title'    => 'Información Legal',
        'priority' => 42,
    ));

    $wp_customize->add_setting('legal_nit', array(
        'default'           => '900.123.456-7',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('legal_nit', array(
        'label'   => 'NIT',
        'section' => 'sancho_legal',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('legal_razon', array(
        'default'           => 'Vertisub S.A.S.',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('legal_razon', array(
        'label'   => 'Razón Social',
        'section' => 'sancho_legal',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('legal_registro', array(
        'default'           => '12345678',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('legal_registro', array(
        'label'   => 'Registro Mercantil',
        'section' => 'sancho_legal',
        'type'    => 'text',
    ));

    $wp_customize->add_setting('legal_camara', array(
        'default'           => 'Bogota',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('legal_camara', array(
        'label'   => 'Cámara de Comercio',
        'section' => 'sancho_legal',
        'type'    => 'text',
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
class Vertisub_Walker_Desktop extends Walker_Nav_Menu
{

    // Detectar si el item tiene hijos
    private function has_children($item_id, $items)
    {
        foreach ($items as $item) {
            if ($item->menu_item_parent == $item_id) {
                return true;
            }
        }
        return false;
    }

    function start_lvl(&$output, $depth = 0, $args = null)
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"dropdown-menu\">\n"; // 🔹 antes tenías <div>
    }

    function end_lvl(&$output, $depth = 0, $args = null)
    {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n"; // 🔹 cerrar con </ul>
    }

    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        global $wp_query;
        $all_items = wp_get_nav_menu_items($args->menu ?? '');
        $has_children = $this->has_children($item->ID, $all_items);

        if ($depth == 0) {
            $li_class = $has_children ? 'nav-item has-dropdown' : 'nav-item';
            $output .= $indent . '<li class="' . $li_class . '">';

            $href = $has_children ? '#' : esc_attr($item->url);
            $output .= '<a href="' . $href . '" class="nav-link">';

            $icon = get_post_meta($item->ID, '_menu_item_icon', true);
            if (!empty($icon)) {
                $output .= '<i class="' . esc_attr($icon) . '"></i>';
            }

            $output .= esc_html($item->title);

            if ($has_children) {
                $output .= '<i class="fas fa-chevron-down dropdown-arrow"></i>';
            }

            $output .= '</a>';
        } else {
            // 🔹 ahora los subitems van dentro de <li>
            $output .= $indent . '<li class="dropdown-item">';

            $output .= '<a href="' . esc_attr($item->url) . '">';

            $icon = get_post_meta($item->ID, '_menu_item_icon', true);
            if (!empty($icon)) {
                $output .= '<i class="' . esc_attr($icon) . '"></i>';
            } else {
                $output .= '<i class="fas fa-angle-right"></i>';
            }

            $output .= esc_html($item->title);
            $output .= '</a>';
        }
    }

    function end_el(&$output, $item, $depth = 0, $args = null)
    {
        $output .= "</li>\n"; // 🔹 ahora cerramos <li> en todos los casos
    }
}

// ========== WALKER PARA OFFCANVAS (MOBILE) ==========
class Vertisub_Walker_Offcanvas extends Walker_Nav_Menu
{

    function start_lvl(&$output, $depth = 0, $args = null)
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<div class=\"mobile-dropdown\">\n";
    }

    function end_lvl(&$output, $depth = 0, $args = null)
    {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</div>\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        // Verificar si tiene hijos
        $has_children = in_array('menu-item-has-children', $classes);

        if ($depth == 0) {
            // Item principal
            $li_class = $has_children ? 'nav-item has-dropdown' : 'nav-item';
            $output .= $indent . '<li class="' . $li_class . '">';

            $output .= '<a href="' . esc_attr($item->url) . '" class="nav-link">';
            $output .= '<div class="link-content">';

            // Agregar icono
            $icon = get_post_meta($item->ID, '_menu_item_icon', true);
            if (!empty($icon)) {
                $output .= '<i class="' . esc_attr($icon) . '"></i>';
            }

            $output .= '<span>' . esc_html($item->title) . '</span>';
            $output .= '</div>';

            // Agregar flecha si tiene hijos
            if ($has_children) {
                $output .= '<i class="fas fa-chevron-down dropdown-arrow"></i>';
            }

            $output .= '</a>';
        } else {
            // Submenu item
            $output .= $indent . '<a href="' . esc_attr($item->url) . '" class="dropdown-item">';

            // Icono para submenu
            $icon = get_post_meta($item->ID, '_menu_item_icon', true);
            if (!empty($icon)) {
                $output .= '<i class="' . esc_attr($icon) . '"></i>';
            } else {
                $output .= '<i class="fas fa-angle-right"></i>';
            }

            $output .= '<span>' . esc_html($item->title) . '</span>';
            $output .= '</a>';
        }
    }

    function end_el(&$output, $item, $depth = 0, $args = null)
    {
        if ($depth == 0) {
            $output .= "</li>\n";
        }
    }
}

function vertisub_register_menus()
{
    register_nav_menus(array(
        'primary_menu' => __('Menú Principal', 'vertisub'),
    ));

    register_nav_menus(array(
        'footer_menu' => __('Footer', 'vertisub'),
        'footer_empresa'   => __('Footer Empresa', 'vertisub'),
        'footer_legal'     => __('Footer Legal', 'vertisub'),
    ));
}
add_action('after_setup_theme', 'vertisub_register_menus');

function vertisub_add_nav_link_class($atts, $item, $args)
{
    if ($args->theme_location === 'primary_menu') {
        $atts['class'] = 'nav-link'; // clase para el header
    }

    if ($args->theme_location === 'footer_menu' || $args->theme_location === 'footer_empresa' || $args->theme_location === 'footer_legal') {
        $atts['class'] = 'footer-link'; // clase para el footer
    }

    return $atts;
}
add_filter('nav_menu_link_attributes', 'vertisub_add_nav_link_class', 10, 3);

// Para <li> del FOOTER
function vertisub_add_footer_li_class($classes, $item, $args)
{
    if ($args->theme_location === 'footer_menu' || $args->theme_location === 'footer_empresa' || $args->theme_location === 'footer_legal') {
        $classes[] = 'footer-link-item';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'vertisub_add_footer_li_class', 10, 3);



// 1. Registrar Custom Post Type: Redes Sociales
function vertisub_create_social_post_type()
{
    register_post_type(
        'redes_sociales',
        array(
            'labels' => array(
                'name'               => 'Redes Sociales',
                'singular_name'      => 'Red Social',
                'add_new'            => 'Añadir Nueva',
                'add_new_item'       => 'Añadir Nueva Red Social',
                'edit_item'          => 'Editar Red Social',
                'new_item'           => 'Nueva Red Social',
                'view_item'          => 'Ver Red Social',
                'search_items'       => 'Buscar Redes Sociales',
                'not_found'          => 'No se encontraron redes sociales',
                'not_found_in_trash' => 'No hay redes sociales en la papelera',
            ),
            'public'      => true,
            'has_archive' => false,
            'menu_icon'   => 'dashicons-share', // icono de redes
            'supports'    => array('title', 'thumbnail'), // nombre + ícono
            'rewrite'     => array('slug' => 'redes-sociales'),
        )
    );
}
add_action('init', 'vertisub_create_social_post_type');


// 2. Añadir Metabox para URL de la Red Social
function vertisub_add_social_url_metabox()
{
    add_meta_box(
        'social_url_box',
        'Enlace de la Red Social',
        'vertisub_render_social_url_box',
        'redes_sociales',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'vertisub_add_social_url_metabox');

// Render del Metabox
function vertisub_render_social_url_box($post)
{
    $value = get_post_meta($post->ID, '_social_url', true);
?>
    <label for="social_url">URL de la red social:</label>
    <input type="url" id="social_url" name="social_url"
        value="<?php echo esc_attr($value); ?>"
        placeholder="https://turedsocial.com" style="width:100%;">
<?php
}

// Guardar el campo URL
function vertisub_save_social_url($post_id)
{
    if (array_key_exists('social_url', $_POST)) {
        update_post_meta(
            $post_id,
            '_social_url',
            esc_url_raw($_POST['social_url'])
        );
    }
}
add_action('save_post', 'vertisub_save_social_url');


// 1) Registrar CPT "Nosotros"
function vertisub_create_about_post_type()
{
    register_post_type('nosotros', array(
        'labels' => array(
            'name'          => 'Nosotros',
            'singular_name' => 'Nosotros',
            'menu_name'     => 'Nosotros',
        ),
        'public'              => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-groups',
        'supports'            => false,
        'show_in_rest'        => false,
        'capability_type'     => 'post',
    ));
}
add_action('init', 'vertisub_create_about_post_type');


// 2) Añadir metabox
function vertisub_add_about_extra_metabox()
{
    add_meta_box(
        'about_extra_box',
        'Información de Nosotros',
        'vertisub_render_about_extra_metabox',
        'nosotros',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'vertisub_add_about_extra_metabox');


// 3) Render del metabox (HTML + wp_editor)
function vertisub_render_about_extra_metabox($post)
{
    $data = get_post_meta($post->ID, '_about_extra', true);
    if (!is_array($data)) $data = [];

    wp_nonce_field('vertisub_save_about_extra', 'vertisub_about_extra_nonce');
?>

    <h3>Sección Introductoria</h3>
    <p><label>Título:</label><br>
        <input type="text" name="about_extra[intro_title]" value="<?php echo esc_attr($data['intro_title'] ?? ''); ?>" style="width:100%;">
    </p>

    <p><label>Descripción:</label><br>
        <?php
        wp_editor(
            $data['intro_desc'] ?? '',
            'about_extra_intro_desc',
            array(
                'textarea_name' => 'about_extra[intro_desc]',
                'textarea_rows' => 6,
                'media_buttons' => true,
                'teeny'         => false,
            )
        );
        ?>
    </p>

    <hr>

    <h3>Sección principal</h3>
    <p><label>Título:</label><br>
        <input type="text" name="about_extra[main_title]" value="<?php echo esc_attr($data['main_title'] ?? ''); ?>" style="width:100%;">
    </p>

    <p><label>Descripción:</label><br>
        <?php
        wp_editor(
            $data['main_desc'] ?? '',
            'about_extra_main_desc',
            array(
                'textarea_name' => 'about_extra[main_desc]',
                'textarea_rows' => 6,
                'media_buttons' => true,
                'teeny'         => false,
            )
        );
        ?>
    </p>

    <p><label>Imagen (URL o seleccionar):</label><br>
        <input type="text" id="main_image" name="about_extra[main_image]" value="<?php echo esc_attr($data['main_image'] ?? ''); ?>" style="width:72%;">
        <button type="button" class="button upload-media-button" data-target="#main_image">Seleccionar</button>
        <button type="button" class="button remove-media-button" data-target="#main_image">Eliminar</button>
    </p>

    <p><label>Video (URL o seleccionar):</label><br>
        <input type="text" id="main_video" name="about_extra[main_video]" value="<?php echo esc_attr($data['main_video'] ?? ''); ?>" style="width:72%;">
        <button type="button" class="button upload-media-button" data-target="#main_video">Seleccionar</button>
        <button type="button" class="button remove-media-button" data-target="#main_video">Eliminar</button>
    </p>

    <p><label>Años de experiencia:</label><br>
        <input type="number" name="about_extra[years]" value="<?php echo esc_attr($data['years'] ?? ''); ?>" style="width:100px;">
    </p>

    <p><label>Descripción de los años de experiencia:</label><br>
        <?php
        wp_editor(
            $data['years_desc'] ?? '',
            'about_extra_years_desc',
            array(
                'textarea_name' => 'about_extra[years_desc]',
                'textarea_rows' => 4,
                'media_buttons' => true,
                'teeny'         => false,
            )
        );
        ?>
    </p>

    <hr>

    <h3>Filosofía</h3>
    <p><label>Título:</label><br>
        <input type="text" name="about_extra[philosophy_title]" value="<?php echo esc_attr($data['philosophy_title'] ?? ''); ?>" style="width:100%;">
    </p>

    <p><label>Descripción:</label><br>
        <?php
        wp_editor(
            $data['philosophy_desc'] ?? '',
            'about_extra_philosophy_desc',
            array(
                'textarea_name' => 'about_extra[philosophy_desc]',
                'textarea_rows' => 6,
                'media_buttons' => true,
                'teeny'         => false,
            )
        );
        ?>
    </p>

    <hr>

    <h3>Aliado Estratégico</h3>
    <p><label>Descripción:</label><br>
        <?php
        wp_editor(
            $data['partner_desc'] ?? '',
            'about_extra_partner_desc',
            array(
                'textarea_name' => 'about_extra[partner_desc]',
                'textarea_rows' => 6,
                'media_buttons' => true,
                'teeny'         => false,
            )
        );
        ?>
    </p>

    <p><label>Proyectos completados:</label><br>
        <input type="number" name="about_extra[projects]" value="<?php echo esc_attr($data['projects'] ?? ''); ?>" style="width:100px;">
    </p>

    <p><label>Clientes satisfechos:</label><br>
        <input type="number" name="about_extra[clients]" value="<?php echo esc_attr($data['clients'] ?? ''); ?>" style="width:100px;">
    </p>
<?php
}


// 4) Encolar scripts del uploader
function vertisub_admin_assets($hook)
{
    if (!is_admin()) return;
    $screen = get_current_screen();
    if (!$screen || $screen->post_type !== 'nosotros') return;

    wp_enqueue_media();
    wp_register_script('vertisub-inline', false, array('jquery'), null, true);
    wp_enqueue_script('vertisub-inline');

    $inline_js = <<<'JS'
jQuery(document).ready(function ($) {
    var mediaUploader;

    $(document).on('click', '.upload-media-button', function (e) {
        e.preventDefault();
        var button = $(this);
        var target = $(button.data('target'));

        mediaUploader = wp.media({
            title: 'Seleccionar archivo',
            button: { text: 'Usar este archivo' },
            multiple: false
        }).on('select', function () {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            if (target.length) target.val(attachment.url);
        }).open();
    });

    $(document).on('click', '.remove-media-button', function (e) {
        e.preventDefault();
        var target = $($(this).data('target'));
        if (target.length) target.val('');
    });
});
JS;
    wp_add_inline_script('vertisub-inline', $inline_js);
}
add_action('admin_enqueue_scripts', 'vertisub_admin_assets');


// 5) Guardar datos
function vertisub_save_about_extra($post_id)
{
    if (!isset($_POST['vertisub_about_extra_nonce']) || !wp_verify_nonce($_POST['vertisub_about_extra_nonce'], 'vertisub_save_about_extra')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['about_extra']) && is_array($_POST['about_extra'])) {
        $clean = [];
        foreach ($_POST['about_extra'] as $key => $value) {
            if (in_array($key, array('main_image', 'main_video'))) {
                $clean[$key] = esc_url_raw($value);
            } elseif (in_array($key, array('years', 'projects', 'clients'))) {
                $clean[$key] = $value === '' ? '' : intval($value);
            } else {
                $clean[$key] = wp_kses_post($value); // permite HTML seguro
            }
        }
        update_post_meta($post_id, '_about_extra', $clean);
    }
}
add_action('save_post', 'vertisub_save_about_extra');

// Registrar logo dinámico para Header
function vertisub_custom_logos()
{
    add_theme_support('custom-logo', array(
        'header-text' => array('site-title'),
    ));
}
add_action('after_setup_theme', 'vertisub_custom_logos');

// Agregar opción en el personalizador para el logo del Footer
function vertisub_customize_register($wp_customize)
{
    $wp_customize->add_section('vertisub_footer_logo_section', array(
        'title'       => __('Logo Footer', 'vertisub'),
        'priority'    => 30,
        'description' => 'Logo que se muestra en el footer',
    ));

    $wp_customize->add_setting('vertisub_footer_logo', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'vertisub_footer_logo', array(
        'label'    => __('Subir Logo Footer', 'vertisub'),
        'section'  => 'vertisub_footer_logo_section',
        'settings' => 'vertisub_footer_logo',
    )));
}
add_action('customize_register', 'vertisub_customize_register');

// Función para mostrar el logo del footer
function vertisub_footer_logo()
{
    $logo = get_theme_mod('vertisub_footer_logo');
    if ($logo) {
        echo '<img src="' . esc_url($logo) . '" alt="' . get_bloginfo('name') . '">';
    } else {
        echo get_bloginfo('name');
    }
}

// 1. Crear CPT Equipo
function vertisub_create_team_post_type()
{
    register_post_type(
        'clientes', // cambiar slug a 'clientes'
        array(
            'labels' => array(
                'name'               => 'Clientes',
                'singular_name'      => 'Cliente',
                'add_new'            => 'Añadir nuevo',
                'add_new_item'       => 'Añadir cliente',
                'edit_item'          => 'Editar cliente',
                'new_item'           => 'Nuevo cliente',
                'view_item'          => 'Ver cliente',
                'search_items'       => 'Buscar cliente',
                'not_found'          => 'No se encontraron clientes',
                'not_found_in_trash' => 'No hay clientes en la papelera',
            ),
            'public'      => true,
            'has_archive' => false,
            'menu_icon'   => 'dashicons-businessperson',
            'supports'    => array('title', 'editor', 'thumbnail'), // ahora 'editor' para descripción
            'rewrite'     => array('slug' => 'clientes'),
        )
    );
}
add_action('init', 'vertisub_create_team_post_type');


// 2. Agregar Meta Box para Mensaje
function vertisub_team_meta_boxes()
{
    add_meta_box(
        'clientes_detalles',
        'Detalles del Cliente',
        'vertisub_team_meta_callback',
        'clientes',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'vertisub_team_meta_boxes');

function vertisub_team_meta_callback($post)
{
    // Obtener valor guardado
    $mensaje = get_post_meta($post->ID, '_mensaje', true);
?>
    <p>
        <label for="mensaje"><strong>Mensaje:</strong></label><br>
        <textarea name="mensaje" id="mensaje" rows="4" style="width:100%;"><?php echo esc_textarea($mensaje); ?></textarea>
    </p>
<?php
}


// 3. Guardar los campos
function vertisub_save_team_meta($post_id)
{
    if (array_key_exists('mensaje', $_POST)) {
        update_post_meta($post_id, '_mensaje', sanitize_textarea_field($_POST['mensaje']));
    }
}
add_action('save_post', 'vertisub_save_team_meta');

// 1. Crear CPT Reseñas
function vertisub_create_reviews_post_type()
{
    register_post_type(
        'reseñas',
        array(
            'labels' => array(
                'name'               => 'Reseñas',
                'singular_name'      => 'Reseña',
                'add_new'            => 'Añadir nueva',
                'add_new_item'       => 'Añadir reseña',
                'edit_item'          => 'Editar reseña',
                'new_item'           => 'Nueva reseña',
                'view_item'          => 'Ver reseña',
                'search_items'       => 'Buscar reseñas',
                'not_found'          => 'No se encontraron reseñas',
                'not_found_in_trash' => 'No hay reseñas en la papelera',
            ),
            'public'      => true,
            'has_archive' => false,
            'menu_icon'   => 'dashicons-testimonial',
            'supports'    => array('thumbnail'), // solo foto
            'rewrite'     => array('slug' => 'reseñas'),
        )
    );
}
add_action('init', 'vertisub_create_reviews_post_type');


// 2. Agregar Meta Box para Nombre y Reseña
function vertisub_reviews_meta_boxes()
{
    add_meta_box(
        'reseñas_detalles',
        'Detalles de la Reseña',
        'vertisub_reviews_meta_callback',
        'reseñas',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'vertisub_reviews_meta_boxes');

function vertisub_reviews_meta_callback($post)
{
    $nombre  = get_post_meta($post->ID, '_nombre_reseña', true);
    $reseña  = get_post_meta($post->ID, '_texto_reseña', true);
?>
    <p>
        <label for="nombre_reseña"><strong>Nombre:</strong></label><br>
        <input type="text" name="nombre_reseña" id="nombre_reseña" value="<?php echo esc_attr($nombre); ?>" style="width:100%;">
    </p>
    <p>
        <label for="texto_reseña"><strong>Reseña:</strong></label><br>
        <textarea name="texto_reseña" id="texto_reseña" rows="4" style="width:100%;"><?php echo esc_textarea($reseña); ?></textarea>
    </p>
<?php
}


// 3. Guardar los campos
function vertisub_save_reviews_meta($post_id)
{
    if (array_key_exists('nombre_reseña', array: $_POST)) {
        update_post_meta($post_id, '_nombre_reseña', sanitize_text_field($_POST['nombre_reseña']));
    }
    if (array_key_exists('texto_reseña', $_POST)) {
        update_post_meta($post_id, '_texto_reseña', sanitize_textarea_field($_POST['texto_reseña']));
    }
}
add_action('save_post', 'vertisub_save_reviews_meta');

// ========== CPT Países ==========
function vertisub_create_paises_post_type()
{
    register_post_type(
        'paises',
        array(
            'labels' => array(
                'name'               => 'Países',
                'singular_name'      => 'País',
                'add_new'            => 'Añadir país',
                'add_new_item'       => 'Añadir país',
                'edit_item'          => 'Editar país',
                'new_item'           => 'Nuevo país',
                'view_item'          => 'Ver país',
                'search_items'       => 'Buscar países',
                'not_found'          => 'No se encontraron países',
                'not_found_in_trash' => 'No hay países en la papelera',
            ),
            'public'      => true,
            'has_archive' => false,
            'menu_icon'   => 'dashicons-location-alt',
            'supports'    => array('title', 'editor'),
            'rewrite'     => array('slug' => 'paises'),
        )
    );
}
add_action('init', 'vertisub_create_paises_post_type');

// ========== Metabox ==========
function vertisub_add_paises_metaboxes()
{
    add_meta_box(
        'paises_info',
        'Información del País',
        'vertisub_render_paises_metabox',
        'paises',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'vertisub_add_paises_metaboxes');

function vertisub_render_paises_metabox($post)
{
    $contacto  = get_post_meta($post->ID, '_contacto', true);
    $direccion = get_post_meta($post->ID, '_direccion', true);

    $correos   = get_post_meta($post->ID, '_correos', true);
    $correos   = is_array($correos) ? $correos : [];

    $telefonos = get_post_meta($post->ID, '_telefonos', true);
    $telefonos = is_array($telefonos) ? $telefonos : [];

    $whatsapps = get_post_meta($post->ID, '_whatsapps', true);
    $whatsapps = is_array($whatsapps) ? $whatsapps : [];

    wp_nonce_field('paises_save_meta', 'paises_meta_nonce');

    // Recuperar valor actual del slug/código
    $slug = get_post_meta($post->ID, '_pais_slug', true);

    wp_nonce_field('guardar_pais_slug', 'pais_slug_nonce');
?>
    <p>
        <label for="pais_slug"><strong>Código/Slug del País (ej: ESP, COL, MEX):</strong></label><br>
        <input type="text" name="pais_slug" id="pais_slug" value="<?php echo esc_attr($slug); ?>" style="width: 150px; text-transform: uppercase;">
    </p>
    <?php
    ?>
    <p><label><strong>Contacto:</strong></label><br>
        <input type="text" name="contacto" value="<?= esc_attr($contacto) ?>" class="widefat">
    </p>

    <p><label><strong>Dirección:</strong></label><br>
        <textarea name="direccion" class="widefat"><?= esc_textarea($direccion) ?></textarea>
    </p>

    <!-- Correos -->
    <p><strong>Correos:</strong></p>
    <div id="correos-wrapper">
        <?php if (!empty($correos)) : ?>
            <?php foreach ($correos as $mail) : ?>
                <div class="field-row">
                    <input type="email" name="correos[]" value="<?= esc_attr($mail) ?>" class="widefat">
                    <button type="button" class="button remove-field">❌</button>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <button type="button" class="button" onclick="addField('correos-wrapper','correos[]','email')">+ Agregar correo</button>

    <!-- Teléfonos -->
    <p><strong>Teléfonos:</strong></p>
    <div id="telefonos-wrapper">
        <?php if (!empty($telefonos)) : ?>
            <?php foreach ($telefonos as $tel) : ?>
                <div class="field-row">
                    <input type="text" name="telefonos[]" value="<?= esc_attr($tel) ?>" class="widefat">
                    <button type="button" class="button remove-field">❌</button>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <button type="button" class="button" onclick="addField('telefonos-wrapper','telefonos[]','text')">+ Agregar teléfono</button>

    <!-- Whatsapps -->
    <p><strong>Whatsapps:</strong></p>
    <div id="whatsapps-wrapper">
        <?php if (!empty($whatsapps)) : ?>
            <?php foreach ($whatsapps as $wa) : ?>
                <div class="field-row">
                    <input type="text" name="whatsapps[]" value="<?= esc_attr($wa) ?>" class="widefat">
                    <button type="button" class="button remove-field">❌</button>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <button type="button" class="button" onclick="addField('whatsapps-wrapper','whatsapps[]','text')">+ Agregar WhatsApp</button>

    <style>
        .field-row {
            display: flex;
            gap: 8px;
            margin-bottom: 5px;
        }

        .field-row input {
            flex: 1;
        }
    </style>

    <script>
        function addField(wrapperId, fieldName, type = "text") {
            const wrapper = document.getElementById(wrapperId);
            const div = document.createElement("div");
            div.className = "field-row";

            const input = document.createElement("input");
            input.type = type;
            input.name = fieldName;
            input.className = "widefat";

            const btn = document.createElement("button");
            btn.type = "button";
            btn.className = "button remove-field";
            btn.innerText = "❌";
            btn.onclick = function() {
                div.remove();
            };

            div.appendChild(input);
            div.appendChild(btn);
            wrapper.appendChild(div);
        }

        // Activar eliminar en campos ya cargados
        document.querySelectorAll(".remove-field").forEach(btn => {
            btn.addEventListener("click", function() {
                this.parentElement.remove();
            });
        });
    </script>
<?php
}

// ========== Guardar ==========
function vertisub_save_paises_meta($post_id)
{
    // Verificar nonce
    if (!isset($_POST['pais_slug_nonce']) || !wp_verify_nonce($_POST['pais_slug_nonce'], 'guardar_pais_slug')) {
        return;
    }

    // Evitar autoguardados
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Guardar si existe
    if (isset($_POST['pais_slug'])) {
        $slug = sanitize_text_field($_POST['pais_slug']);
        update_post_meta($post_id, '_pais_slug', strtoupper($slug));
    }

    if (!isset($_POST['paises_meta_nonce']) || !wp_verify_nonce($_POST['paises_meta_nonce'], 'paises_save_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    update_post_meta($post_id, '_contacto', sanitize_text_field($_POST['contacto'] ?? ''));
    update_post_meta($post_id, '_direccion', sanitize_textarea_field($_POST['direccion'] ?? ''));

    // Correos
    $correos = array_filter(array_map('sanitize_email', $_POST['correos'] ?? []));
    update_post_meta($post_id, '_correos', $correos);

    // Teléfonos
    $telefonos = array_filter(array_map('sanitize_text_field', $_POST['telefonos'] ?? []));
    update_post_meta($post_id, '_telefonos', $telefonos);

    // Whatsapps
    $whatsapps = array_filter(array_map('sanitize_text_field', $_POST['whatsapps'] ?? []));
    update_post_meta($post_id, '_whatsapps', $whatsapps);
}
add_action('save_post', 'vertisub_save_paises_meta');


// ========== CPT Servicios ==========
function vertisub_create_servicios_post_type()
{
    register_post_type(
        'servicios',
        array(
            'labels' => array(
                'name'               => 'Servicios',
                'singular_name'      => 'Servicio',
                'add_new'            => 'Añadir servicio',
                'add_new_item'       => 'Añadir servicio',
                'edit_item'          => 'Editar servicio',
                'new_item'           => 'Nuevo servicio',
                'view_item'          => 'Ver servicio',
                'search_items'       => 'Buscar servicios',
                'not_found'          => 'No se encontraron servicios',
                'not_found_in_trash' => 'No hay servicios en la papelera',
            ),
            'public'      => true,
            'has_archive' => false,
            'menu_icon'   => 'dashicons-hammer',
            'supports'    => array('title', 'thumbnail', 'editor'),
            // título, imagen destacada, descripción
            'rewrite'     => array('slug' => 'servicios'),
        )
    );
}
add_action('init', 'vertisub_create_servicios_post_type');


// ========== Relación Servicios <-> Países ==========
function vertisub_register_servicios_meta_boxes()
{
    add_meta_box(
        'servicios_multimedia',
        'Multimedia',
        'vertisub_servicios_multimedia_callback',
        'servicios',
        'normal',
        'default'
    );

    add_meta_box(
        'servicios_paises',
        'Países',
        'vertisub_servicios_paises_callback',
        'servicios',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'vertisub_register_servicios_meta_boxes');


// ========== Callback para Multimedia ==========
// ========== Callback para Multimedia ==========
function vertisub_servicios_multimedia_callback($post)
{
    $imagenes    = get_post_meta($post->ID, '_imagenes_reseña', true);
    $videos      = get_post_meta($post->ID, '_videos_reseña', true);
    $video_urls  = get_post_meta($post->ID, '_video_urls_reseña', true);

    if (!is_array($imagenes)) $imagenes = [];
    if (!is_array($videos)) $videos = [];
    if (!is_array($video_urls)) $video_urls = [];
?>

    <h4>📷 Imágenes</h4>
    <div id="imagenes-wrapper">
        <?php foreach ($imagenes as $i => $img): ?>
            <p>
                <input type="text" name="imagenes_reseña[]" value="<?php echo esc_attr($img); ?>" style="width:80%;">
                <button class="button upload_image_button">Subir</button>
                <button class="button remove-field">Eliminar</button>
            </p>
        <?php endforeach; ?>
    </div>
    <button class="button add-image">+ Agregar Imagen</button>

    <hr>
    <h4>🎥 Videos (archivos)</h4>
    <div id="videos-wrapper">
        <?php foreach ($videos as $v): ?>
            <p>
                <input type="text" name="videos_reseña[]" value="<?php echo esc_attr($v); ?>" style="width:80%;">
                <button class="button upload_video_button">Subir</button>
                <button class="button remove-field">Eliminar</button>
            </p>
        <?php endforeach; ?>
    </div>
    <button class="button add-video">+ Agregar Video</button>

    <hr>
    <h4>🌐 Links de Video (YouTube/Vimeo)</h4>
    <div id="urls-wrapper">
        <?php foreach ($video_urls as $url): ?>
            <p>
                <input type="url" name="video_urls_reseña[]" value="<?php echo esc_attr($url); ?>" style="width:80%;">
                <button class="button remove-field">Eliminar</button>
            </p>
        <?php endforeach; ?>
    </div>
    <button class="button add-url">+ Agregar Link</button>

    <script>
        jQuery(document).ready(function($) {
            // ========== Duplicar campos ==========
            $('.add-image').click(function(e) {
                e.preventDefault();
                $('#imagenes-wrapper').append(
                    '<p><input type="text" name="imagenes_reseña[]" style="width:80%;"> <button class="button upload_image_button">Subir</button> <button class="button remove-field">Eliminar</button></p>'
                );
            });

            $('.add-video').click(function(e) {
                e.preventDefault();
                $('#videos-wrapper').append(
                    '<p><input type="text" name="videos_reseña[]" style="width:80%;"> <button class="button upload_video_button">Subir</button> <button class="button remove-field">Eliminar</button></p>'
                );
            });

            $('.add-url').click(function(e) {
                e.preventDefault();
                $('#urls-wrapper').append(
                    '<p><input type="url" name="video_urls_reseña[]" style="width:80%;"> <button class="button remove-field">Eliminar</button></p>'
                );
            });

            // Eliminar campo
            $(document).on('click', '.remove-field', function(e) {
                e.preventDefault();
                $(this).parent('p').remove();
            });

            // Subida de Imagen
            $(document).on('click', '.upload_image_button', function(e) {
                e.preventDefault();
                var button = $(this);
                var uploader = wp.media({
                    title: 'Selecciona una imagen',
                    button: {
                        text: 'Usar esta imagen'
                    },
                    library: {
                        type: 'image'
                    },
                    multiple: false
                }).on('select', function() {
                    var attachment = uploader.state().get('selection').first().toJSON();
                    button.prev('input').val(attachment.url);
                }).open();
            });

            // Subida de Video
            $(document).on('click', '.upload_video_button', function(e) {
                e.preventDefault();
                var button = $(this);
                var uploader = wp.media({
                    title: 'Selecciona un video',
                    button: {
                        text: 'Usar este video'
                    },
                    library: {
                        type: 'video'
                    },
                    multiple: false
                }).on('select', function() {
                    var attachment = uploader.state().get('selection').first().toJSON();
                    button.prev('input').val(attachment.url);
                }).open();
            });
        });
    </script>
<?php
}

// Registrar metabox
function vertisub_add_multimedia_metabox()
{
    add_meta_box(
        'reseñas_multimedia',
        'Multimedia',
        'vertisub_servicios_multimedia_callback',
        'reseñas',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'vertisub_add_multimedia_metabox');

// Guardar los datos
function vertisub_save_multimedia_meta($post_id)
{
    // Evitar autoguardado
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    // Imágenes
    $imagenes = isset($_POST['imagenes_reseña']) ? array_filter(array_map('esc_url_raw', $_POST['imagenes_reseña'])) : [];
    update_post_meta($post_id, '_imagenes_reseña', $imagenes);

    // Videos
    $videos = isset($_POST['videos_reseña']) ? array_filter(array_map('esc_url_raw', $_POST['videos_reseña'])) : [];
    update_post_meta($post_id, '_videos_reseña', $videos);

    // URLs de videos
    $urls = isset($_POST['video_urls_reseña']) ? array_filter(array_map('esc_url_raw', $_POST['video_urls_reseña'])) : [];
    update_post_meta($post_id, '_video_urls_reseña', $urls);
}
add_action('save_post', 'vertisub_save_multimedia_meta');

// ========== Callback para selector de Países ==========
function vertisub_servicios_paises_callback($post)
{
    $paises = get_posts(array(
        'post_type'      => 'paises',
        'posts_per_page' => -1,
        'orderby'        => 'title',
        'order'          => 'ASC'
    ));

    $selected = get_post_meta($post->ID, '_servicio_paises', true);
    if (!is_array($selected)) $selected = array();

    echo '<select name="servicio_paises[]" multiple style="width:100%;height:150px;">';
    foreach ($paises as $pais) {
        $is_selected = in_array($pais->ID, $selected) ? 'selected' : '';
        echo '<option value="' . $pais->ID . '" ' . $is_selected . '>' . esc_html($pais->post_title) . '</option>';
    }
    echo '</select>';
}


// ========== Guardar selector múltiple ==========
function vertisub_save_servicios_meta($post_id)
{
    if (array_key_exists('servicio_paises', $_POST)) {
        update_post_meta($post_id, '_servicio_paises', $_POST['servicio_paises']);
    }
}
add_action('save_post_servicios', 'vertisub_save_servicios_meta');

// Add pais_slug to query vars
// 1. Permitir query var "pais_slug"
function vertisub_add_query_vars($vars)
{
    $vars[] = 'pais_slug';
    return $vars;
}
add_filter('query_vars', 'vertisub_add_query_vars');

// 2. Crear regla de reescritura para /servicios-vertisub/{pais}/
function vertisub_rewrite_rules()
{
    add_rewrite_rule(
        '^servicios-vertisub/([^/]+)/?$',
        'index.php?pagename=servicios-vertisub&pais_slug=$matches[1]',
        'top'
    );
}
add_action('init', 'vertisub_rewrite_rules');

// 1. Registrar Custom Post Type: Instructores
function vertisub_create_instructor_post_type()
{
    register_post_type(
        'instructores',
        array(
            'labels' => array(
                'name'               => 'Instructores',
                'singular_name'      => 'Instructor',
                'add_new'            => 'Añadir Nuevo',
                'add_new_item'       => 'Añadir Nuevo Instructor',
                'edit_item'          => 'Editar Instructor',
                'new_item'           => 'Nuevo Instructor',
                'view_item'          => 'Ver Instructor',
                'search_items'       => 'Buscar Instructores',
                'not_found'          => 'No se encontraron instructores',
                'not_found_in_trash' => 'No hay instructores en la papelera',
            ),
            'public'      => true,
            'has_archive' => false,
            'menu_icon'   => 'dashicons-welcome-learn-more', // icono de instructor
            'supports'    => array('title', 'thumbnail'), // Nombre + Imagen
            'rewrite'     => array('slug' => 'instructores'),
        )
    );
}
add_action('init', 'vertisub_create_instructor_post_type');


// 2. Agregar Metaboxes (Años de experiencia, Cargo, Video)
function vertisub_instructor_metaboxes()
{
    add_meta_box(
        'instructor_info',
        'Información del Instructor',
        'vertisub_instructor_metabox_callback',
        'instructores',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'vertisub_instructor_metaboxes');

function vertisub_instructor_metabox_callback($post)
{
    wp_nonce_field(basename(__FILE__), 'instructor_nonce');

    $experiencia = get_post_meta($post->ID, '_instructor_experiencia', true);
    $cargo       = get_post_meta($post->ID, '_instructor_cargo', true);
    $video       = get_post_meta($post->ID, '_instructor_video', true);
?>
    <p>
        <label for="instructor_experiencia"><strong>Años de Experiencia:</strong></label><br>
        <input type="number" id="instructor_experiencia" name="instructor_experiencia"
            value="<?php echo esc_attr($experiencia); ?>" style="width:100px;">
    </p>
    <p>
        <label for="instructor_cargo"><strong>Cargo:</strong></label><br>
        <input type="text" id="instructor_cargo" name="instructor_cargo"
            value="<?php echo esc_attr($cargo); ?>" style="width:100%;">
    </p>
    <p>
        <label for="instructor_video"><strong>URL de Video de Presentación:</strong></label><br>
        <input type="url" id="instructor_video" name="instructor_video"
            value="<?php echo esc_attr($video); ?>" style="width:100%;">
    </p>
<?php
}


// 3. Guardar datos de los Metaboxes
function vertisub_save_instructor_metabox($post_id)
{
    if (!isset($_POST['instructor_nonce']) || !wp_verify_nonce($_POST['instructor_nonce'], basename(__FILE__))) {
        return $post_id;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;

    if ('instructores' === $_POST['post_type']) {
        if (isset($_POST['instructor_experiencia'])) {
            update_post_meta($post_id, '_instructor_experiencia', sanitize_text_field($_POST['instructor_experiencia']));
        }
        if (isset($_POST['instructor_cargo'])) {
            update_post_meta($post_id, '_instructor_cargo', sanitize_text_field($_POST['instructor_cargo']));
        }
        if (isset($_POST['instructor_video'])) {
            update_post_meta($post_id, '_instructor_video', esc_url_raw($_POST['instructor_video']));
        }
    }
}
add_action('save_post', 'vertisub_save_instructor_metabox');

// 1. Registrar Custom Post Type: Cursos
function vertisub_create_cursos_post_type()
{
    register_post_type(
        'cursos',
        array(
            'labels' => array(
                'name'               => 'Cursos',
                'singular_name'      => 'Curso',
                'add_new'            => 'Añadir Nuevo',
                'add_new_item'       => 'Añadir Nuevo Curso',
                'edit_item'          => 'Editar Curso',
                'new_item'           => 'Nuevo Curso',
                'view_item'          => 'Ver Curso',
                'search_items'       => 'Buscar Cursos',
                'not_found'          => 'No se encontraron cursos',
                'not_found_in_trash' => 'No hay cursos en la papelera',
            ),
            'public'      => true,
            'has_archive' => false,
            'menu_icon'   => 'dashicons-awards',
            'supports'    => array('title', 'editor', 'thumbnail'),
            'rewrite'     => array('slug' => 'cursos'),
        )
    );
}
add_action('init', 'vertisub_create_cursos_post_type');


// 2. Metabox
function vertisub_cursos_metaboxes()
{
    add_meta_box(
        'curso_info',
        'Detalles del Curso',
        'vertisub_cursos_callback',
        'cursos',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'vertisub_cursos_metaboxes');


// 3. Callback con campos
function vertisub_cursos_callback($post)
{
    wp_nonce_field(basename(__FILE__), 'cursos_nonce');

    // Recuperar valores
    $imagenes      = get_post_meta($post->ID, '_curso_imagenes', true) ?: [];
    $modalidades   = get_post_meta($post->ID, '_curso_modalidades', true) ?: [];
    $intro_video   = get_post_meta($post->ID, '_curso_intro_video', true);
    $testimonios   = get_post_meta($post->ID, '_curso_testimonios', true) ?: [];
    $temario       = get_post_meta($post->ID, '_curso_temario', true) ?: [];
    $url_inscribir = get_post_meta($post->ID, '_curso_url_inscribir', true);
    $url_info      = get_post_meta($post->ID, '_curso_url_info', true);
    $url_plataforma = get_post_meta($post->ID, '_curso_url_plataforma', true);
    $url_oficial   = get_post_meta($post->ID, '_curso_url_oficial', true);
    $paises        = get_post_meta($post->ID, '_curso_paises', true) ?: [];
    $paises_urls   = get_post_meta($post->ID, '_curso_paises_urls', true) ?: [];
    $instructores  = get_post_meta($post->ID, '_curso_instructores', true) ?: [];
    $convenios     = get_post_meta($post->ID, '_curso_convenios', true) ?: []; // NUEVO

    // Obtener CPT relacionados
    $paises_list       = get_posts(['post_type' => 'paises', 'numberposts' => -1]);
    $instructores_list = get_posts(['post_type' => 'instructores', 'numberposts' => -1]);

?>
    <h3>Imágenes del Curso</h3>
    <div id="imagenes-wrapper">
        <?php if (!empty($imagenes)) :
            foreach ($imagenes as $img_id) :
                $img_url = wp_get_attachment_url($img_id); ?>
                <div style="margin-bottom:10px;">
                    <img src="<?php echo esc_url($img_url); ?>" style="max-width:150px; display:block; margin-bottom:5px;">
                    <input type="hidden" name="curso_imagenes[]" value="<?php echo esc_attr($img_id); ?>">
                    <button class="remove-field button">Eliminar</button>
                </div>
        <?php endforeach;
        endif; ?>
    </div>
    <button type="button" class="button add-image">+ Añadir Imagen</button>

    <hr>
    <h3>Modalidades</h3>
    <div id="modalidades-wrapper">
        <?php if (!empty($modalidades)) :
            foreach ($modalidades as $m) : ?>
                <p><input type="text" name="curso_modalidades[]" value="<?php echo esc_attr($m); ?>" style="width:80%;">
                    <button class="remove-field button">Eliminar</button>
                </p>
        <?php endforeach;
        endif; ?>
    </div>
    <button type="button" class="add-field button">+ Añadir Modalidad</button>

    <hr>
    <h3>Video de Introducción</h3>
    <input type="url" name="curso_intro_video" value="<?php echo esc_attr($intro_video); ?>" style="width:100%;">

    <hr>
    <h3>Videos de Testimonios</h3>
    <div id="testimonios-wrapper">
        <?php if (!empty($testimonios)) :
            foreach ($testimonios as $t) : ?>
                <p><input type="url" name="curso_testimonios[]" value="<?php echo esc_attr($t); ?>" style="width:80%;">
                    <button class="remove-field button">Eliminar</button>
                </p>
        <?php endforeach;
        endif; ?>
    </div>
    <button type="button" class="add-field button" data-target="testimonios-wrapper" data-name="curso_testimonios[]">+ Añadir Testimonio</button>

    <hr>
    <h3>Temario</h3>
    <div id="temario-wrapper">
        <?php if (!empty($temario)) :
            foreach ($temario as $t) : ?>
                <p><input type="text" name="curso_temario[]" value="<?php echo esc_attr($t); ?>" style="width:80%;">
                    <button class="remove-field button">Eliminar</button>
                </p>
        <?php endforeach;
        endif; ?>
    </div>
    <button type="button" class="add-field button" data-target="temario-wrapper" data-name="curso_temario[]">+ Añadir Tema</button>

    <hr>
    <h3>Relación con Instructores</h3>
    <?php foreach ($instructores_list as $inst) : ?>
        <label>
            <input type="checkbox" name="curso_instructores[]" value="<?php echo $inst->ID; ?>"
                <?php checked(in_array($inst->ID, $instructores)); ?>>
            <?php echo esc_html($inst->post_title); ?>
        </label><br>
    <?php endforeach; ?>

    <hr>
    <h3>Convenios con Países</h3>
    <?php foreach ($paises_list as $pais) :
        $url_contacto = isset($paises_urls[$pais->ID]) ? $paises_urls[$pais->ID] : ''; ?>
        <p>
            <label>
                <input type="checkbox" name="curso_paises[]" value="<?php echo $pais->ID; ?>"
                    <?php checked(in_array($pais->ID, $paises)); ?>>
                <?php echo esc_html($pais->post_title); ?>
            </label><br>
            URL de contacto:<br>
            <input type="url" name="curso_paises_urls[<?php echo $pais->ID; ?>]" value="<?php echo esc_attr($url_contacto); ?>" style="width:80%;">
        </p>
    <?php endforeach; ?>

    <hr>
    <h3>Convenios Personalizados</h3>
    <div id="convenios-wrapper">
        <?php if (!empty($convenios)) :
            foreach ($convenios as $c) : ?>
                <p>
                    <input type="text" name="curso_convenios[titulo][]" value="<?php echo esc_attr($c['titulo']); ?>" placeholder="Nombre del convenio" style="width:35%;">
                    <input type="url" name="curso_convenios[url][]" value="<?php echo esc_attr($c['url']); ?>" placeholder="URL del convenio" style="width:40%;">
                    <button class="remove-field button">Eliminar</button>
                </p>
        <?php endforeach;
        endif; ?>
    </div>
    <button type="button" class="add-field button" data-target="convenios-wrapper" data-name="curso_convenios">+ Añadir Convenio</button>

    <hr>
    <h3>Enlaces</h3>
    <p><label><strong>URL Inscripción:</strong></label><br>
        <input type="url" name="curso_url_inscribir" value="<?php echo esc_attr($url_inscribir); ?>" style="width:100%;">
    </p>

    <p><label><strong>URL Más Información:</strong></label><br>
        <input type="url" name="curso_url_info" value="<?php echo esc_attr($url_info); ?>" style="width:100%;">
    </p>

    <p><label><strong>URL Plataforma de Aprendizaje:</strong></label><br>
        <input type="url" name="curso_url_plataforma" value="<?php echo esc_attr($url_plataforma); ?>" style="width:100%;">
    </p>

    <p><label><strong>URL Página Oficial:</strong></label><br>
        <input type="url" name="curso_url_oficial" value="<?php echo esc_attr($url_oficial); ?>" style="width:100%;">
    </p>

    <script>
        jQuery(document).ready(function($) {
            // Añadir campos dinámicos
            $(document).on('click', '.add-field', function(e) {
                e.preventDefault();
                const target = $(this).data('target') || $(this).prev().attr('id');
                const name = $(this).data('name') || "curso_modalidades[]";

                if (name === "curso_convenios") {
                    $("#" + target).append(
                        '<p><input type="text" name="curso_convenios[titulo][]" placeholder="Nombre del convenio" style="width:35%;"> ' +
                        '<input type="url" name="curso_convenios[url][]" placeholder="URL del convenio" style="width:40%;"> ' +
                        '<button class="remove-field button">Eliminar</button></p>'
                    );
                } else {
                    $("#" + target).append('<p><input type="text" name="' + name + '" style="width:80%;"> <button class="remove-field button">Eliminar</button></p>');
                }
            });
            $(document).on('click', '.remove-field', function(e) {
                e.preventDefault();
                $(this).parent().remove();
            });

            // Añadir imágenes
            var frame;
            $('.add-image').on('click', function(e) {
                e.preventDefault();
                if (frame) frame.close();
                frame = wp.media({
                    title: 'Seleccionar Imagen',
                    button: {
                        text: 'Usar Imagen'
                    },
                    multiple: false
                });
                frame.on('select', function() {
                    var attachment = frame.state().get('selection').first().toJSON();
                    var html = '<div style="margin-bottom:10px;">' +
                        '<img src="' + attachment.url + '" style="max-width:150px; display:block; margin-bottom:5px;">' +
                        '<input type="hidden" name="curso_imagenes[]" value="' + attachment.id + '">' +
                        '<button class="remove-field button">Eliminar</button></div>';
                    $('#imagenes-wrapper').append(html);
                });
                frame.open();
            });
        });
    </script>
<?php
}


// 4. Guardar datos
function vertisub_save_cursos_metabox($post_id)
{
    if (!isset($_POST['cursos_nonce']) || !wp_verify_nonce($_POST['cursos_nonce'], basename(__FILE__))) return $post_id;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
    if ('cursos' !== $_POST['post_type']) return $post_id;

    update_post_meta($post_id, '_curso_imagenes', array_map('intval', (array) $_POST['curso_imagenes']));
    update_post_meta($post_id, '_curso_modalidades', array_filter((array) $_POST['curso_modalidades']));
    update_post_meta($post_id, '_curso_intro_video', sanitize_text_field($_POST['curso_intro_video']));
    update_post_meta($post_id, '_curso_testimonios', array_filter((array) $_POST['curso_testimonios']));
    update_post_meta($post_id, '_curso_temario', array_filter((array) $_POST['curso_temario']));
    update_post_meta($post_id, '_curso_url_inscribir', esc_url_raw($_POST['curso_url_inscribir']));
    update_post_meta($post_id, '_curso_url_info', esc_url_raw($_POST['curso_url_info']));
    update_post_meta($post_id, '_curso_url_plataforma', esc_url_raw($_POST['curso_url_plataforma']));
    update_post_meta($post_id, '_curso_url_oficial', esc_url_raw($_POST['curso_url_oficial']));
    update_post_meta($post_id, '_curso_instructores', array_map('intval', (array) $_POST['curso_instructores']));
    update_post_meta($post_id, '_curso_paises', array_map('intval', (array) $_POST['curso_paises']));
    update_post_meta($post_id, '_curso_paises_urls', $_POST['curso_paises_urls']);

    // Guardar convenios personalizados
    if (isset($_POST['curso_convenios'])) {
        $convenios = [];
        $titulos = $_POST['curso_convenios']['titulo'];
        $urls    = $_POST['curso_convenios']['url'];
        foreach ($titulos as $i => $titulo) {
            if (!empty($titulo) || !empty($urls[$i])) {
                $convenios[] = [
                    'titulo' => sanitize_text_field($titulo),
                    'url'    => esc_url_raw($urls[$i])
                ];
            }
        }
        update_post_meta($post_id, '_curso_convenios', $convenios);
    }
}
add_action('save_post', 'vertisub_save_cursos_metabox');


// 1. Crear CPT Proyectos Exitosos
function vertisub_create_proyectos_post_type()
{
    register_post_type(
        'proyectos_exitosos',
        array(
            'labels' => array(
                'name'               => 'Proyectos Exitosos',
                'singular_name'      => 'Proyecto Exitoso',
                'add_new'            => 'Añadir nuevo',
                'add_new_item'       => 'Añadir Proyecto',
                'edit_item'          => 'Editar Proyecto',
                'new_item'           => 'Nuevo Proyecto',
                'view_item'          => 'Ver Proyecto',
                'search_items'       => 'Buscar Proyectos',
                'not_found'          => 'No se encontraron proyectos',
                'not_found_in_trash' => 'No hay proyectos en la papelera',
            ),
            'public'      => true,
            'has_archive' => true,
            'menu_icon'   => 'dashicons-awards',
            'supports'    => array('title', 'editor', 'thumbnail'),
            'rewrite'     => array('slug' => 'proyectos-exitosos'),
        )
    );
}
add_action('init', 'vertisub_create_proyectos_post_type');


// 2. Metaboxes personalizados
function vertisub_proyectos_meta_boxes()
{
    add_meta_box(
        'proyectos_detalles',
        'Detalles del Proyecto',
        'vertisub_proyectos_meta_callback',
        'proyectos_exitosos',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'vertisub_proyectos_meta_boxes');

function vertisub_proyectos_meta_callback($post)
{
    $descripcion = get_post_meta($post->ID, '_descripcion_proyecto', true);
    $anio        = get_post_meta($post->ID, '_anio_proyecto', true);
    $ubicacion   = get_post_meta($post->ID, '_ubicacion_proyecto', true);

    $galeria     = get_post_meta($post->ID, '_galeria_proyecto', true) ?: [];
    $detalles    = get_post_meta($post->ID, '_detalles_proyecto', true) ?: [];
    $timeline    = get_post_meta($post->ID, '_timeline_proyecto', true) ?: [];
    $impacto     = get_post_meta($post->ID, '_impacto_proyecto', true) ?: [];
?>
    <style>
        .custom-repeater-item {
            background: #f9f9f9;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
        }

        .custom-repeater-item button {
            margin-top: 5px;
        }

        .galeria-item {
            display: inline-block;
            margin: 5px;
            position: relative;
        }

        .galeria-item img {
            max-width: 120px;
            height: auto;
            display: block;
            border: 1px solid #ddd;
        }

        .galeria-item button {
            position: absolute;
            top: 2px;
            right: 2px;
            background: red;
            color: #fff;
            border: none;
            cursor: pointer;
        }
    </style>

    <p>
        <label><strong>Descripción:</strong></label><br>
        <textarea name="descripcion_proyecto" rows="3" style="width:100%;"><?php echo esc_textarea($descripcion); ?></textarea>
    </p>
    <p>
        <label><strong>Año:</strong></label><br>
        <input type="text" name="anio_proyecto" value="<?php echo esc_attr($anio); ?>" style="width:100%;">
    </p>
    <p>
        <label><strong>Ubicación:</strong></label><br>
        <input type="text" name="ubicacion_proyecto" value="<?php echo esc_attr($ubicacion); ?>" style="width:100%;">
    </p>

    <hr>
    <h4>Galería de Imágenes</h4>
    <div id="galeria-wrapper">
        <?php if (!empty($galeria)): ?>
            <?php foreach ($galeria as $id):
                $img_url = wp_get_attachment_image_url($id, 'thumbnail'); ?>
                <div class="galeria-item">
                    <img src="<?php echo esc_url($img_url); ?>">
                    <input type="hidden" name="galeria_proyecto[]" value="<?php echo esc_attr($id); ?>">
                    <button type="button" class="remove-galeria">x</button>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <button type="button" class="button add-galeria">Añadir Imágenes</button>

    <hr>
    <h4>Detalles del Proyecto</h4>
    <div id="detalles-wrapper">
        <?php foreach ($detalles as $item): ?>
            <div class="custom-repeater-item">
                <textarea name="detalles_proyecto[]" rows="2" style="width:100%;"><?php echo esc_textarea($item); ?></textarea>
                <button type="button" class="remove-item button">Eliminar</button>
            </div>
        <?php endforeach; ?>
    </div>
    <button type="button" class="button add-detalle">Añadir Detalle</button>

    <hr>
    <h4>Línea de Tiempo</h4>
    <div id="timeline-wrapper">
        <?php foreach ($timeline as $item): ?>
            <div class="custom-repeater-item">
                <input type="text" name="timeline_titulo[]" placeholder="Título" value="<?php echo esc_attr($item['titulo']); ?>" style="width:100%;"><br>
                <textarea name="timeline_descripcion[]" placeholder="Descripción" rows="2" style="width:100%;"><?php echo esc_textarea($item['descripcion']); ?></textarea><br>
                <input type="text" name="timeline_anio[]" placeholder="Año" value="<?php echo esc_attr($item['anio']); ?>" style="width:100%;"><br>
                <button type="button" class="remove-item button">Eliminar</button>
            </div>
        <?php endforeach; ?>
    </div>
    <button type="button" class="button add-timeline">Añadir Línea</button>

    <hr>
    <h4>Impacto del Proyecto</h4>
    <div id="impacto-wrapper">
        <?php foreach ($impacto as $item): ?>
            <div class="custom-repeater-item">
                <textarea name="impacto_proyecto[]" rows="2" style="width:100%;"><?php echo esc_textarea($item); ?></textarea>
                <button type="button" class="remove-item button">Eliminar</button>
            </div>
        <?php endforeach; ?>
    </div>
    <button type="button" class="button add-impacto">Añadir Impacto</button>

    <script>
        jQuery(document).ready(function($) {
            // --- Galería con Media Uploader ---
            var frame;
            $('.add-galeria').on('click', function(e) {
                e.preventDefault();
                if (frame) {
                    frame.open();
                    return;
                }
                frame = wp.media({
                    title: 'Seleccionar imágenes',
                    button: {
                        text: 'Usar estas imágenes'
                    },
                    multiple: true
                });
                frame.on('select', function() {
                    var attachments = frame.state().get('selection').toArray();
                    attachments.forEach(function(attachment) {
                        attachment = attachment.toJSON();
                        var img = '<div class="galeria-item">' +
                            '<img src="' + attachment.sizes.thumbnail.url + '">' +
                            '<input type="hidden" name="galeria_proyecto[]" value="' + attachment.id + '">' +
                            '<button type="button" class="remove-galeria">x</button>' +
                            '</div>';
                        $('#galeria-wrapper').append(img);
                    });
                });
                frame.open();
            });
            $(document).on('click', '.remove-galeria', function() {
                $(this).parent('.galeria-item').remove();
            });

            // --- Repeater para detalles, timeline e impacto ---
            function addRepeater(btnClass, wrapperId, html) {
                $(btnClass).on('click', function() {
                    var wrapper = $(wrapperId);
                    var div = $('<div class="custom-repeater-item">' + html + '</div>');
                    wrapper.append(div);
                });
            }
            $(document).on('click', '.remove-item', function() {
                $(this).parent().remove();
            });

            addRepeater('.add-detalle', '#detalles-wrapper', '<textarea name="detalles_proyecto[]" rows="2" style="width:100%;" placeholder="Detalle"></textarea><button type="button" class="remove-item button">Eliminar</button>');
            addRepeater('.add-timeline', '#timeline-wrapper', '<input type="text" name="timeline_titulo[]" placeholder="Título" style="width:100%;"><textarea name="timeline_descripcion[]" placeholder="Descripción" rows="2" style="width:100%;"></textarea><input type="text" name="timeline_anio[]" placeholder="Año" style="width:100%;"><button type="button" class="remove-item button">Eliminar</button>');
            addRepeater('.add-impacto', '#impacto-wrapper', '<textarea name="impacto_proyecto[]" rows="2" style="width:100%;" placeholder="Impacto"></textarea><button type="button" class="remove-item button">Eliminar</button>');
        });
    </script>
<?php
}

// 3. Guardar metadatos
function vertisub_save_proyectos_meta($post_id)
{
    if (array_key_exists('descripcion_proyecto', $_POST)) {
        update_post_meta($post_id, '_descripcion_proyecto', sanitize_textarea_field($_POST['descripcion_proyecto']));
    }
    if (array_key_exists('anio_proyecto', $_POST)) {
        update_post_meta($post_id, '_anio_proyecto', sanitize_text_field($_POST['anio_proyecto']));
    }
    if (array_key_exists('ubicacion_proyecto', $_POST)) {
        update_post_meta($post_id, '_ubicacion_proyecto', sanitize_text_field($_POST['ubicacion_proyecto']));
    }
    if (isset($_POST['galeria_proyecto'])) {
        $ids = array_map('intval', $_POST['galeria_proyecto']);
        update_post_meta($post_id, '_galeria_proyecto', $ids);
    } else {
        delete_post_meta($post_id, '_galeria_proyecto');
    }
    if (isset($_POST['detalles_proyecto'])) {
        update_post_meta($post_id, '_detalles_proyecto', array_map('sanitize_textarea_field', $_POST['detalles_proyecto']));
    }
    if (isset($_POST['timeline_titulo'])) {
        $timeline = [];
        foreach ($_POST['timeline_titulo'] as $i => $titulo) {
            if (!empty($titulo) || !empty($_POST['timeline_descripcion'][$i]) || !empty($_POST['timeline_anio'][$i])) {
                $timeline[] = [
                    'titulo'      => sanitize_text_field($titulo),
                    'descripcion' => sanitize_textarea_field($_POST['timeline_descripcion'][$i]),
                    'anio'        => sanitize_text_field($_POST['timeline_anio'][$i])
                ];
            }
        }
        update_post_meta($post_id, '_timeline_proyecto', $timeline);
    }
    if (isset($_POST['impacto_proyecto'])) {
        update_post_meta($post_id, '_impacto_proyecto', array_map('sanitize_textarea_field', $_POST['impacto_proyecto']));
    }
}
add_action('save_post', 'vertisub_save_proyectos_meta');

// ===================== CPT Ubicaciones =====================
function vertisub_create_ubicaciones_cpt()
{
    register_post_type(
        'ubicaciones',
        array(
            'labels' => array(
                'name'               => 'Ubicaciones',
                'singular_name'      => 'Ubicación',
                'add_new'            => 'Añadir nueva',
                'add_new_item'       => 'Añadir ubicación',
                'edit_item'          => 'Editar ubicación',
                'new_item'           => 'Nueva ubicación',
                'view_item'          => 'Ver ubicación',
                'search_items'       => 'Buscar ubicaciones',
                'not_found'          => 'No se encontraron ubicaciones',
                'not_found_in_trash' => 'No hay ubicaciones en la papelera',
            ),
            'public'      => true,
            'has_archive' => false,
            'menu_icon'   => 'dashicons-location-alt',
            'supports'    => array('title', 'editor'), // Título y descripción
            'rewrite'     => array('slug' => 'ubicaciones'),
        )
    );
}
add_action('init', 'vertisub_create_ubicaciones_cpt');

// ===================== CPT Servicios de Introducción =====================
function vertisub_create_servicios_intro_cpt()
{
    $labels = array(
        'name'               => 'Servicios de Introducción',
        'singular_name'      => 'Servicio de Introducción',
        'add_new'            => 'Añadir nuevo servicio',
        'add_new_item'       => 'Añadir servicio',
        'edit_item'          => 'Editar servicio',
        'new_item'           => 'Nuevo servicio',
        'view_item'          => 'Ver servicio',
        'search_items'       => 'Buscar servicios',
        'not_found'          => 'No se encontraron servicios',
        'not_found_in_trash' => 'No hay servicios en la papelera',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'show_ui'            => true,
        'show_in_menu'       => true,           // Asegura que aparezca en el menú
        'menu_position'      => 5,              // Posición en el menú
        'menu_icon'          => 'dashicons-clipboard',
        'capability_type'    => 'post',
        'supports'           => array('title', 'editor'), // Título y descripción
        'has_archive'        => false,
        'rewrite'            => array('slug' => 'servicios-intro'), // nuevo slug
        'exclude_from_search' => false,
    );

    register_post_type('servicios_intro', $args); // nombre interno actualizado
}
add_action('init', 'vertisub_create_servicios_intro_cpt', 0);

// Registrar CPT "WhatsApp Button"
function register_whatsapp_cpt()
{
    $labels = array(
        'name'               => 'WhatsApp Buttons',
        'singular_name'      => 'WhatsApp Button',
        'add_new'            => 'Agregar Nuevo',
        'add_new_item'       => 'Agregar Nuevo WhatsApp Button',
        'edit_item'          => 'Editar WhatsApp Button',
        'new_item'           => 'Nuevo WhatsApp Button',
        'view_item'          => 'Ver WhatsApp Button',
        'search_items'       => 'Buscar WhatsApp Buttons',
        'not_found'          => 'No se encontraron WhatsApp Buttons',
        'not_found_in_trash' => 'No se encontraron WhatsApp Buttons en la papelera',
        'menu_name'          => 'WhatsApp Buttons',
    );

    $args = array(
        'labels'        => $labels,
        'public'        => false,
        'show_ui'       => true,
        'show_in_menu'  => true,
        'capability_type' => 'post',
        'supports'      => array('title'),
        'menu_icon'     => 'dashicons-whatsapp',
    );

    register_post_type('whatsapp_button', $args);
}
add_action('init', 'register_whatsapp_cpt');

// Registrar meta fields
function whatsapp_register_meta()
{
    register_post_meta('whatsapp_button', 'whatsapp_number', array(
        'show_in_rest' => true,
        'single'       => true,
        'type'         => 'string',
    ));
    register_post_meta('whatsapp_button', 'whatsapp_message', array(
        'show_in_rest' => true,
        'single'       => true,
        'type'         => 'string',
    ));
}
add_action('init', 'whatsapp_register_meta');

// Meta box para ingresar número y mensaje
function whatsapp_add_meta_boxes()
{
    add_meta_box(
        'whatsapp_meta_box',
        'WhatsApp Data',
        'whatsapp_meta_box_callback',
        'whatsapp_button',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'whatsapp_add_meta_boxes');

function whatsapp_meta_box_callback($post)
{
    wp_nonce_field('whatsapp_save_meta', 'whatsapp_meta_nonce');
    $number = get_post_meta($post->ID, 'whatsapp_number', true);
    $message = get_post_meta($post->ID, 'whatsapp_message', true);
?>
    <p>
        <label for="whatsapp_number">Número WhatsApp:</label><br>
        <input type="text" name="whatsapp_number" id="whatsapp_number" value="<?php echo esc_attr($number); ?>" style="width:100%;">
    </p>
    <p>
        <label for="whatsapp_message">Mensaje (opcional):</label><br>
        <input type="text" name="whatsapp_message" id="whatsapp_message" value="<?php echo esc_attr($message); ?>" style="width:100%;">
    </p>
<?php
}

// Guardar meta fields
add_action('save_post', 'whatsapp_save_meta');
function whatsapp_save_meta($post_id)
{
    if (!isset($_POST['whatsapp_meta_nonce']) || !wp_verify_nonce($_POST['whatsapp_meta_nonce'], 'whatsapp_save_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if (isset($_POST['whatsapp_number'])) {
        update_post_meta($post_id, 'whatsapp_number', sanitize_text_field($_POST['whatsapp_number']));
    }
    if (isset($_POST['whatsapp_message'])) {
        update_post_meta($post_id, 'whatsapp_message', sanitize_text_field($_POST['whatsapp_message']));
    }
}


// ========== CPT Documentos País ==========
function vertisub_create_documentos_post_type()
{
    register_post_type('documentos_pais', array(
        'labels' => array(
            'name'               => 'Documentos por País',
            'singular_name'      => 'Documento por País',
            'add_new'            => 'Añadir documento',
            'add_new_item'       => 'Añadir documento',
            'edit_item'          => 'Editar documento',
            'new_item'           => 'Nuevo documento',
            'view_item'          => 'Ver documento',
            'search_items'       => 'Buscar documentos',
            'not_found'          => 'No se encontraron documentos',
            'not_found_in_trash' => 'No hay documentos en la papelera',
        ),
        'public'      => true,
        'has_archive' => false,
        'menu_icon'   => 'dashicons-media-document',
        'supports'    => array('title', 'editor'), // ✅ title = nombre, editor = descripción
        'rewrite'     => array('slug' => 'documentos-pais'),
    ));
}
add_action('init', 'vertisub_create_documentos_post_type');


// ========== Metabox ==========
function vertisub_add_documentos_metaboxes()
{
    add_meta_box(
        'documentos_info',
        'Información del Documento',
        'vertisub_render_documentos_metabox',
        'documentos_pais',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'vertisub_add_documentos_metaboxes');

function vertisub_render_documentos_metabox($post)
{
    wp_nonce_field('documentos_save_meta', 'documentos_meta_nonce');

    // País relacionado
    $selected_pais = get_post_meta($post->ID, '_pais_relacionado', true);

    // Documentos
    $documentos = get_post_meta($post->ID, '_documentos', true);
    $documentos = is_array($documentos) ? $documentos : [];

    // Obtener lista de países
    $paises = get_posts(array(
        'post_type'      => 'paises',
        'posts_per_page' => -1,
        'orderby'        => 'title',
        'order'          => 'ASC',
    ));
?>
    <p>
        <label><strong>Seleccionar País:</strong></label><br>
        <select name="pais_relacionado" style="width: 300px;">
            <option value="">-- Selecciona un país --</option>
            <?php foreach ($paises as $pais): ?>
                <option value="<?= esc_attr($pais->ID) ?>" <?= selected($selected_pais, $pais->ID) ?>>
                    <?= esc_html($pais->post_title) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </p>

    <hr>

    <p><strong>Documentos adjuntos:</strong></p>
    <div id="documentos-wrapper">
        <?php if (!empty($documentos)) : ?>
            <?php foreach ($documentos as $doc) : ?>
                <div class="field-row">
                    <input type="text" name="documentos[nombres][]" placeholder="Nombre del documento" value="<?= esc_attr($doc['nombre']) ?>" class="widefat" style="max-width:250px;">

                    <input type="hidden" name="documentos[archivos][]" value="<?= esc_attr($doc['archivo']) ?>" class="doc-input">
                    <button type="button" class="button select-doc">📂 Seleccionar archivo</button>
                    <span class="doc-url"><?= esc_html($doc['archivo'] ? basename($doc['archivo']) : '') ?></span>

                    <button type="button" class="button remove-field">❌</button>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <button type="button" class="button" onclick="addDocumento()">+ Agregar documento</button>

    <style>
        .field-row {
            display: flex;
            gap: 8px;
            margin-bottom: 5px;
            align-items: center;
        }
        .doc-url {
            font-size: 12px;
            color: #555;
        }
    </style>

    <script>
        function addDocumento() {
            const wrapper = document.getElementById("documentos-wrapper");
            const div = document.createElement("div");
            div.className = "field-row";

            div.innerHTML = `
                <input type="text" name="documentos[nombres][]" placeholder="Nombre del documento" class="widefat" style="max-width:250px;">
                <input type="hidden" name="documentos[archivos][]" class="doc-input">
                <button type="button" class="button select-doc">📂 Seleccionar archivo</button>
                <span class="doc-url"></span>
                <button type="button" class="button remove-field">❌</button>
            `;

            wrapper.appendChild(div);

            initMediaSelector(div.querySelector(".select-doc"));
            div.querySelector(".remove-field").onclick = function() {
                div.remove();
            };
        }

        function initMediaSelector(button) {
            button.addEventListener("click", function(e) {
                e.preventDefault();
                const input = button.parentElement.querySelector(".doc-input");
                const urlSpan = button.parentElement.querySelector(".doc-url");

                const frame = wp.media({
                    title: "Seleccionar archivo",
                    button: { text: "Usar este archivo" },
                    multiple: false
                });

                frame.on("select", function() {
                    const attachment = frame.state().get("selection").first().toJSON();
                    input.value = attachment.url;
                    urlSpan.textContent = attachment.filename;
                });

                frame.open();
            });
        }

        // Inicializar selectores para los ya existentes
        document.querySelectorAll(".select-doc").forEach(initMediaSelector);

        // Activar eliminar en campos ya cargados
        document.querySelectorAll(".remove-field").forEach(btn => {
            btn.addEventListener("click", function() {
                this.parentElement.remove();
            });
        });
    </script>
<?php
}

// ========== Guardar ==========
function vertisub_save_documentos_meta($post_id)
{
    if (!isset($_POST['documentos_meta_nonce']) || !wp_verify_nonce($_POST['documentos_meta_nonce'], 'documentos_save_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    // Guardar país
    update_post_meta($post_id, '_pais_relacionado', intval($_POST['pais_relacionado'] ?? 0));

    // Guardar documentos adjuntos
    $nombres = $_POST['documentos']['nombres'] ?? [];
    $archivos = $_POST['documentos']['archivos'] ?? [];
    $documentos = [];

    for ($i = 0; $i < count($nombres); $i++) {
        if (!empty($nombres[$i]) || !empty($archivos[$i])) {
            $documentos[] = [
                'nombre'  => sanitize_text_field($nombres[$i]),
                'archivo' => esc_url_raw($archivos[$i])
            ];
        }
    }

    update_post_meta($post_id, '_documentos', $documentos);
}
add_action('save_post', 'vertisub_save_documentos_meta');


// ========== CPT Novedades ==========
function vertisub_create_novedades_post_type() {

    $labels = array(
        'name'                  => 'Novedades',
        'singular_name'         => 'Novedad',
        'menu_name'             => 'Novedades',
        'name_admin_bar'        => 'Novedad',
        'add_new'               => 'Añadir nueva',
        'add_new_item'          => 'Añadir nueva novedad',
        'edit_item'             => 'Editar novedad',
        'new_item'              => 'Nueva novedad',
        'view_item'             => 'Ver novedad',
        'view_items'            => 'Ver novedades',
        'search_items'          => 'Buscar novedades',
        'not_found'             => 'No se encontraron novedades',
        'not_found_in_trash'    => 'No se encontraron novedades en la papelera',
        'all_items'             => 'Todas las novedades',
    );

    $args = array(
        'labels'                => $labels,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-megaphone',
        'supports'              => array('title', 'editor', 'thumbnail'),
        'has_archive'           => true,
        'rewrite'               => array('slug' => 'novedades'),
        'show_in_rest'          => true, // Para compatibilidad con Gutenberg y API REST
    );

    register_post_type('novedades', $args);
}
add_action('init', 'vertisub_create_novedades_post_type');

// ========== CPT Trabajos ==========
function vertisub_create_trabajos_post_type() {
    register_post_type('trabajos', array(
        'labels' => array(
            'name' => 'Trabajos',
            'singular_name' => 'Trabajo',
            'add_new' => 'Añadir trabajo',
            'add_new_item' => 'Añadir nuevo trabajo',
            'edit_item' => 'Editar trabajo',
            'new_item' => 'Nuevo trabajo',
            'view_item' => 'Ver trabajo',
            'search_items' => 'Buscar trabajos',
            'not_found' => 'No se encontraron trabajos',
        ),
        'public' => true,
        'menu_icon' => 'dashicons-portfolio',
        'supports' => array('title', 'editor', 'thumbnail'),
        'rewrite' => array('slug' => 'trabajos'),
        'has_archive' => false,
    ));
}
add_action('init', 'vertisub_create_trabajos_post_type');


// ========== Metabox Vacante Única ==========
function vertisub_add_trabajos_metaboxes() {
    add_meta_box(
        'trabajos_vacante',
        'Información del Trabajo',
        'vertisub_render_trabajos_metabox',
        'trabajos',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'vertisub_add_trabajos_metaboxes');

function vertisub_render_trabajos_metabox($post) {
    wp_nonce_field('vertisub_save_trabajos_meta', 'vertisub_trabajos_meta_nonce');

    $vacante = get_post_meta($post->ID, '_vacante', true);
    $vacante = is_array($vacante) ? $vacante : [];

    // Obtener países
    $paises = get_posts(array(
        'post_type' => 'paises',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC'
    ));
    ?>

    <div class="vacante-box" style="border:1px solid #ccc;padding:15px;background:#fafafa;border-radius:8px;">

        <p><strong>Lugar (País):</strong><br>
            <select name="vacante[lugar]" class="widefat">
                <option value="">— Selecciona un país —</option>
                <?php foreach ($paises as $pais):
                    $slug = get_post_meta($pais->ID, '_pais_slug', true);
                    $selected = ($vacante['lugar'] ?? '') === $slug ? 'selected' : '';
                ?>
                    <option value="<?= esc_attr($slug) ?>" <?= $selected ?>>
                        <?= esc_html($pais->post_title) ?> (<?= esc_html($slug) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </p>

        <p><strong>Tipo de contrato:</strong><br>
            <input type="text" name="vacante[tipo_contrato]" value="<?= esc_attr($vacante['tipo_contrato'] ?? '') ?>" class="widefat">
        </p>

        <p><strong>Experiencia:</strong><br>
            <input type="text" name="vacante[experiencia]" value="<?= esc_attr($vacante['experiencia'] ?? '') ?>" class="widefat">
        </p>

        <p><strong>Responsabilidades:</strong></p>
        <div class="field-group" data-name="responsabilidades">
            <?php foreach (($vacante['responsabilidades'] ?? []) as $resp): ?>
                <div class="field-row">
                    <input type="text" name="vacante[responsabilidades][]" value="<?= esc_attr($resp) ?>" class="widefat">
                    <button type="button" class="button remove-field">❌</button>
                </div>
            <?php endforeach; ?>
        </div>
        <button type="button" class="button add-field" data-target="responsabilidades">+ Añadir responsabilidad</button>

        <p><strong>Requisitos:</strong></p>
        <div class="field-group" data-name="requisitos">
            <?php foreach (($vacante['requisitos'] ?? []) as $req): ?>
                <div class="field-row">
                    <input type="text" name="vacante[requisitos][]" value="<?= esc_attr($req) ?>" class="widefat">
                    <button type="button" class="button remove-field">❌</button>
                </div>
            <?php endforeach; ?>
        </div>
        <button type="button" class="button add-field" data-target="requisitos">+ Añadir requisito</button>

        <p><strong>Beneficios:</strong></p>
        <div class="field-group" data-name="beneficios">
            <?php foreach (($vacante['beneficios'] ?? []) as $ben): ?>
                <div class="field-row">
                    <input type="text" name="vacante[beneficios][]" value="<?= esc_attr($ben) ?>" class="widefat">
                    <button type="button" class="button remove-field">❌</button>
                </div>
            <?php endforeach; ?>
        </div>
        <button type="button" class="button add-field" data-target="beneficios">+ Añadir beneficio</button>

        <p><strong>Email para enviar hoja de vida:</strong><br>
            <input type="email" name="vacante[email]" value="<?= esc_attr($vacante['email'] ?? '') ?>" class="widefat">
        </p>
    </div>

    <style>
        .field-row { display:flex; gap:8px; margin-bottom:5px; }
        .field-row input { flex:1; }
    </style>

    <script>
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-field')) e.target.closest('.field-row').remove();
            if (e.target.classList.contains('add-field')) {
                const group = e.target.previousElementSibling;
                const name = group.dataset.name;
                group.insertAdjacentHTML('beforeend',
                    `<div class="field-row"><input type="text" name="vacante[${name}][]" class="widefat"><button type="button" class="button remove-field">❌</button></div>`
                );
            }
        });
    </script>

    <?php
}


// ========== Guardar ==========
function vertisub_save_trabajos_meta($post_id) {
    if (!isset($_POST['vertisub_trabajos_meta_nonce']) || !wp_verify_nonce($_POST['vertisub_trabajos_meta_nonce'], 'vertisub_save_trabajos_meta')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    $vacante = $_POST['vacante'] ?? [];

    $clean_vacante = array(
        'lugar' => sanitize_text_field($vacante['lugar'] ?? ''),
        'tipo_contrato' => sanitize_text_field($vacante['tipo_contrato'] ?? ''),
        'experiencia' => sanitize_text_field($vacante['experiencia'] ?? ''),
        'responsabilidades' => array_filter(array_map('sanitize_text_field', $vacante['responsabilidades'] ?? [])),
        'requisitos' => array_filter(array_map('sanitize_text_field', $vacante['requisitos'] ?? [])),
        'beneficios' => array_filter(array_map('sanitize_text_field', $vacante['beneficios'] ?? [])),
        'email' => sanitize_email($vacante['email'] ?? '')
    );

    update_post_meta($post_id, '_vacante', $clean_vacante);
}
add_action('save_post', 'vertisub_save_trabajos_meta');
