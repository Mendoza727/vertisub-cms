<?php


/**
 * Handles contact form submission via AJAX.
 *
 * Verifies nonce, sanitizes form data, and sends email to admin.
 *
 * @since 1.0.0
 */
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


/**
 * Saves extra information for "About Us" page.
 *
 * Verifies nonce, sanitizes form data, and updates post meta.
 *
 * @since 1.0.0
 *
 * @param int $post_id The ID of the post to update.
 */

function vertisub_save_about_extra($post_id)
{
    if (!isset($_POST['vertisub_about_extra_nonce']) || !wp_verify_nonce($_POST['vertisub_about_extra_nonce'], 'vertisub_save_about_extra')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['about_extra']) && is_array($_POST['about_extra'])) {
        $clean = [];
        foreach ($_POST['about_extra'] as $key => $value) {
            if (in_array($key, array('main_image', 'main_video'))) {
                $clean[$key] = esc_url_raw($value);
            } elseif (in_array($key, array('years', 'projects', 'clients'))) {
                $clean[$key] = $value === '' ? '' : intval($value);
            } else {
                $clean[$key] = wp_kses_post($value); // permite HTML seguro
            }
        }
        update_post_meta($post_id, '_about_extra', $clean);
    }
}
add_action('save_post', 'vertisub_save_about_extra');