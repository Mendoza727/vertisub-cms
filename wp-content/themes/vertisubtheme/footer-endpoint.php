<?php
/* Template Name: Footer Endpoint */

define('WP_USE_THEMES', true);
require_once __DIR__ . '/../../../wp-load.php';

// Esto ejecuta el ciclo completo de WP, incluyendo hooks
wp();

// Forzar el buffer
ob_start();

// Llamamos al footer completo
get_footer();

$html = ob_get_clean();

// Devolver como HTML
header('Content-Type: text/html; charset=utf-8');
echo $html;
exit;
