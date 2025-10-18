<?php

/**
 * Register customizer options for Vertisub theme.
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 *
 * @since 1.0.0
 */

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
