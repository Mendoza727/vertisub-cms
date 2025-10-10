<?php

/**
 * Sets security headers to prevent various types of attacks.
 *
 * This function sets the following headers:
 * - X-Content-Type-Options: nosniff
 * - X-Frame-Options: SAMEORIGIN
 * - X-XSS-Protection: 1; mode=block
 *
 * @since 1.0
 */
function vertisub_security_headers()
{
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('X-XSS-Protection: 1; mode=block');
}
add_action('send_headers', 'vertisub_security_headers');