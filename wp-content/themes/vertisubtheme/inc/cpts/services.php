<?php

/**
 * Register a custom post type for services.
 *
 * @link https://codex.wordpress.org/Function_Reference/register_post_type
 *
 * @return void
 */
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

function vertisub_save_servicios_meta($post_id)
{
    if (array_key_exists('servicio_paises', $_POST)) {
        update_post_meta($post_id, '_servicio_paises', $_POST['servicio_paises']);
    }
}
add_action('save_post_servicios', 'vertisub_save_servicios_meta');


/**
 * Add pais_slug to query vars.
 *
 * @param array $vars Query vars.
 *
 * @return array Query vars with pais_slug added.
 */
function vertisub_add_query_vars($vars)
{
    $vars[] = 'pais_slug';
    return $vars;
}
add_filter('query_vars', 'vertisub_add_query_vars');

function vertisub_rewrite_rules()
{
    add_rewrite_rule(
        '^servicios-vertisub/([^/]+)/?$',
        'index.php?pagename=servicios-vertisub&pais_slug=$matches[1]',
        'top'
    );
}
add_action('init', 'vertisub_rewrite_rules');