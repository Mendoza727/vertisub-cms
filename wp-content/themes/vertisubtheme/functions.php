<?php

/**
 * Vertisub Theme Functions
 */

// Global variables.
define('VERTISUB_URL', get_template_directory_uri());
define('VERTISUB_DIR', get_template_directory());

// Theme setup.
require_once VERTISUB_DIR . '/inc/setup.php';

// Enqueue styles and scripts.
require_once VERTISUB_DIR . '/inc/enqueue.php';

// Custom post types.
require_once VERTISUB_DIR . '/inc/cpts/certification.php';
require_once VERTISUB_DIR . '/inc/cpts/clients.php';
require_once VERTISUB_DIR . '/inc/cpts/countries.php';
require_once VERTISUB_DIR . '/inc/cpts/courses.php';
require_once VERTISUB_DIR . '/inc/cpts/documents.php';

// Utils.
require_once VERTISUB_DIR . '/inc/utils.php';

// Security.
require_once VERTISUB_DIR . '/inc/security.php';

// Performance.
require_once VERTISUB_DIR . '/inc/performance.php';

// Menu.
require_once VERTISUB_DIR . '/inc/menu.php';

// Customize sections.
require_once VERTISUB_DIR . '/inc/customize.php';

