<?php

/*************  ✨ Windsurf Command ⭐  *************/
/**
 * Registers a post type for courses.
 *
 * @since 1.0.0
 *
 * @return void
 */

/*******  ddbb5b30-eed5-475b-b350-99387845f133  *******/
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
