<?php

/**
 * Register a post type for certifications.
 *
 * @since 1.0.0
 */
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