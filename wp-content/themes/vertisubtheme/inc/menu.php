<?php

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


/**
 * Agrega una clase a los enlaces del menú
 * 
 * @param array $atts   Los atributos del enlace
 * @param object $item     El objeto del enlace
 * @param object $args    Información adicional del menú
 * @return array Los atributos modificados
 */
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

/**
 * Adds the class "footer-link-item" to the nav menu item if it is part of the footer menu, footerEmpresa menu, or footer legal menu.
 *
 * @param array $classes An array of the CSS classes that are applied to the menu item.
 * @param object $item The current menu item.
 * @param object $args An object of wp_nav_menu object arguments.
 *
 * @return array The filtered array of CSS classes.
 */
function vertisub_add_footer_li_class($classes, $item, $args)
{
    if ($args->theme_location === 'footer_menu' || $args->theme_location === 'footer_empresa' || $args->theme_location === 'footer_legal') {
        $classes[] = 'footer-link-item';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'vertisub_add_footer_li_class', 10, 3);
