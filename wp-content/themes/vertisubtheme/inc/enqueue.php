<?php

/**
 * Enqueue scripts and styles
 * 
 * @return void
 */
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


/**
 * Enqueue assets for the admin page.
 *
 * This function enqueues the needed assets for the Nosotros page in the
 * admin dashboard. It registers a script called `vertisub-inline` that
 * handles the media upload and removal on the page.
 *
 * @param string $hook The current hook.
 */
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

// Modify the src attribute of the script tags to use the crossorigin attribute
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
