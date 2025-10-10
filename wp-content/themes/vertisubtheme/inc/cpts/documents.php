<?php

/**
 * Register a custom post type for documents by country
 *
 * @return void
 */
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
                    button: {
                        text: "Usar este archivo"
                    },
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
