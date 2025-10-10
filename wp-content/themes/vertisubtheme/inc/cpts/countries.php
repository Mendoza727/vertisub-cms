<?php
/**
 * Register post type for countries.
 *
 * @since 1.0.0
 *
 * @return void
 */
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
