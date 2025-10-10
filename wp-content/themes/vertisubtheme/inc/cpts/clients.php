<?php


/**
 * Register Custom Post Type: Clientes
 *
 * @link https://codex.wordpress.org/Function_Reference/register_post_type
 *
 * @package Vertisub
 * @subpackage Functions
 */

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
