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
            'menu_icon'   => 'dashicons-awards', // icono de certificación
            'supports'    => array('title', 'thumbnail'), // solo título e imagen
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


// 1. Registrar CPT "Nosotros" (igual que antes)
function vertisub_create_about_post_type()
{
    register_post_type(
        'nosotros',
        array(
            'labels' => array(
                'name'               => 'Nosotros',
                'singular_name'      => 'Nosotros',
                'add_new'            => 'Añadir nuevo',
                'add_new_item'       => 'Añadir apartado',
                'edit_item'          => 'Editar apartado',
                'new_item'           => 'Nuevo apartado',
                'view_item'          => 'Ver apartado',
                'search_items'       => 'Buscar en Nosotros',
                'not_found'          => 'No se encontraron apartados',
                'not_found_in_trash' => 'No hay apartados en la papelera',
            ),
            'public'      => true,
            'has_archive' => false,
            'menu_icon'   => 'dashicons-groups',
            'supports'    => array('title', 'editor', 'thumbnail'),
            'rewrite'     => array('slug' => 'nosotros'),
        )
    );
}
add_action('init', 'vertisub_create_about_post_type');


// 2. Metabox para videos repetibles
function vertisub_add_about_media_metabox()
{
    add_meta_box(
        'about_media_box',
        'Videos (puedes agregar varios)',
        'vertisub_render_about_media_box',
        'nosotros',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'vertisub_add_about_media_metabox');


// Render del metabox
function vertisub_render_about_media_box($post)
{
    // Recuperar los videos guardados (array)
    $videos = get_post_meta($post->ID, '_about_video_urls', true);
    if (!is_array($videos)) $videos = array();

    // Añadir nonce para seguridad
    wp_nonce_field('vertisub_save_about_media', 'vertisub_about_media_nonce');
    ?>

    <div id="about-videos-container">
        <?php foreach ($videos as $index => $url) : ?>
            <p>
                <label>Video <?php echo $index + 1; ?> URL:</label><br>
                <input type="url" name="about_video_urls[]" value="<?php echo esc_attr($url); ?>" style="width:100%;">
                <button class="button remove-video">Eliminar</button>
            </p>
        <?php endforeach; ?>
    </div>

    <p>
        <button id="add-video" class="button">Agregar Video</button>
    </p>

    <p><em>Si no quieres usar video, deja los campos vacíos. También puedes usar la Imagen Destacada.</em></p>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('about-videos-container');
            document.getElementById('add-video').addEventListener('click', function(e){
                e.preventDefault();
                const index = container.children.length;
                const p = document.createElement('p');
                p.innerHTML = '<label>Video ' + (index+1) + ' URL:</label><br>' +
                              '<input type="url" name="about_video_urls[]" style="width:100%;"> ' +
                              '<button class="button remove-video">Eliminar</button>';
                container.appendChild(p);
            });

            container.addEventListener('click', function(e){
                if(e.target.classList.contains('remove-video')){
                    e.preventDefault();
                    e.target.parentElement.remove();
                }
            });
        });
    </script>

<?php
}

// Guardar los videos
function vertisub_save_about_media($post_id)
{
    if (!isset($_POST['vertisub_about_media_nonce']) || !wp_verify_nonce($_POST['vertisub_about_media_nonce'], 'vertisub_save_about_media')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if (isset($_POST['about_video_urls']) && is_array($_POST['about_video_urls'])) {
        // Limpiar URLs vacías
        $urls = array_filter(array_map('esc_url_raw', $_POST['about_video_urls']));
        update_post_meta($post_id, '_about_video_urls', $urls);
    } else {
        delete_post_meta($post_id, '_about_video_urls');
    }
}
add_action('save_post', 'vertisub_save_about_media');


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
