<?php
/* 
Template Name: Politicas Vertisub
*/
?>

<head>
    <?php wp_head(); ?>
    <style>
        /* On hover, show minus icon and hide plus icon */
        .work-item:hover .collapse-icon .icon-plus {
            opacity: 0;
            transform: rotate(90deg);
        }

        .work-item:hover .collapse-icon .icon-minus {
            opacity: 1;
            transform: rotate(0deg);
        }

        /* Remove the old ::before pseudo-element styles */
        .work-item:hover .collapse-icon {
            transform: scale(1.1);
            color: var(--primary-color);
        }

        /* Show work content on hover */
        .work-item:hover .work-content {
            max-height: 500px;
            opacity: 1;
            padding-top: 1.5rem;
			overflow-y: auto;
        }

        .work-content {
            max-height: 0;
            overflow: hidden;
            opacity: 0;
            transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
            font-size: 1.1rem;
            line-height: 1.6;
            color: var(--text-color);
            margin-top: 1rem;
        }

        /* Work Items Container */
        .work-items-container {
            padding: 0;
            opacity: 0;
            transform: translateX(100px) scale(0.95);
            transition: all 1s cubic-bezier(0.16, 1, 0.3, 1);
            filter: blur(10px);
        }

        .work-items-container.animate-in {
            opacity: 1;
            transform: translateX(0) scale(1);
            filter: blur(0px);
        }

        /* Work Item Styles */
        .work-item {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 1.9rem;
            margin-bottom: 1rem;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            opacity: 0;
            transform: translateY(60px) rotateX(15deg);
            animation: modernSlideIn 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            cursor: pointer;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            filter: blur(10px);
        }

        .work-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            background: rgba(255, 255, 255, 1);
        }

        /* Staggered animation delays for more dramatic effect */
        .work-item:nth-child(1) {
            animation-delay: 0.8s;
        }

        .work-item:nth-child(2) {
            animation-delay: 1.1s;
        }

        .work-item:nth-child(3) {
            animation-delay: 1.4s;
        }

        .work-item:nth-child(4) {
            animation-delay: 1.7s;
        }

        /* Work Section Styles */
        .work-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .work-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color);
            margin: 0;
        }

        .work-year {
            font-size: 1rem;
            font-weight: 500;
            color: var(--text-muted);
            background: var(--accent-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
        }

        .collapse-icon {
            font-size: 2.3rem;
            color: var(--accent-color);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            cursor: pointer;
            position: relative;
            margin-top: -50px;
        }

        .collapse-icon .icon-plus,
        .collapse-icon .icon-minus {
            display: inline-block;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            position: absolute;
            top: 0;
            left: 0;
        }

        .collapse-icon .icon-minus {
            opacity: 0;
            transform: rotate(90deg);
        }

        .collapse-icon .icon-plus {
            opacity: 1;
            transform: rotate(0deg);
        }

        /* On hover, show minus icon and hide plus icon */
        .work-item:hover .collapse-icon .icon-plus {
            opacity: 0;
            transform: rotate(90deg);
        }

        .work-item:hover .collapse-icon .icon-minus {
            opacity: 1;
            transform: rotate(0deg);
        }

        /* Remove the old ::before pseudo-element styles */
        .work-item:hover .collapse-icon {
            transform: scale(1.1);
            color: var(--primary-color);
        }

        /* Show work content on hover */
        .work-item:hover .work-content {
            max-height: 500px;
            opacity: 1;
            padding-top: 1.5rem;
        }

        .work-content {
            max-height: 0;
            overflow: hidden;
            opacity: 0;
            transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
            font-size: 1.1rem;
            line-height: 1.6;
            color: var(--text-color);
            margin-top: 1rem;
        }

        /* Work Items Container */
        .work-items-container {
            padding: 0;
            opacity: 0;
            transform: translateX(100px) scale(0.95);
            transition: all 1s cubic-bezier(0.16, 1, 0.3, 1);
            filter: blur(10px);
        }

        .work-items-container.animate-in {
            opacity: 1;
            transform: translateX(0) scale(1);
            filter: blur(0px);
        }

        /* Work Item Styles */
        .work-item {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 1.9rem;
            margin-bottom: 1rem;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            opacity: 0;
            transform: translateY(60px) rotateX(15deg);
            animation: modernSlideIn 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            cursor: pointer;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            filter: blur(10px);
        }

        .work-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            background: rgba(255, 255, 255, 1);
        }

        /* Staggered animation delays for more dramatic effect */
        .work-item:nth-child(1) {
            animation-delay: 0.8s;
        }

        .work-item:nth-child(2) {
            animation-delay: 1.1s;
        }

        .work-item:nth-child(3) {
            animation-delay: 1.4s;
        }

        .work-item:nth-child(4) {
            animation-delay: 1.7s;
        }

        /* ===========================================
   BANDERA CIRCULAR
   =========================================== */

        .bandera-pais {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid transparent;
            background: linear-gradient(white, white) padding-box,
                linear-gradient(135deg, var(--accent-color), var(--accent-secondary)) border-box;
            margin-right: 15px;
            transition: var(--transition);
            box-shadow: 0 4px 15px rgba(187, 12, 43, 0.2),
                inset 0 2px 8px rgba(255, 255, 255, 0.3);
            position: relative;
            animation: subtleFloat 3s ease-in-out infinite;
        }

        .bandera-pais::before {
            content: '';
            position: absolute;
            inset: -3px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent-color), var(--accent-secondary), var(--accent-tertiary));
            background-size: 200% 200%;
            animation: gradientRotate 3s ease infinite;
            z-index: -1;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .work-item:hover .bandera-pais {
            transform: rotate(360deg) scale(1.15);
            box-shadow: 0 8px 25px rgba(187, 12, 43, 0.4),
                inset 0 2px 8px rgba(255, 255, 255, 0.5);
        }

        .work-item:hover .bandera-pais::before {
            opacity: 1;
        }

        @keyframes subtleFloat {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-8px) rotate(5deg);
            }
        }

        @keyframes gradientRotate {

            0%,
            100% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }
        }

        /* ===========================================
   LISTA DE DOCUMENTOS
   =========================================== */

        .pais-documentos {
            list-style: none;
            padding-left: 0;
            margin-top: 15px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .pais-documentos li {
            margin-bottom: 0;
            animation: fadeSlideIn 0.6s ease forwards;
            opacity: 0;
            transform: translateX(-20px);
        }

        /* Animación escalonada para cada item */
        .work-item:hover .pais-documentos li:nth-child(1) {
            animation-delay: 0.1s;
        }

        .work-item:hover .pais-documentos li:nth-child(2) {
            animation-delay: 0.15s;
        }

        .work-item:hover .pais-documentos li:nth-child(3) {
            animation-delay: 0.2s;
        }

        .work-item:hover .pais-documentos li:nth-child(4) {
            animation-delay: 0.25s;
        }

        .work-item:hover .pais-documentos li:nth-child(5) {
            animation-delay: 0.3s;
        }

        .work-item:hover .pais-documentos li:nth-child(6) {
            animation-delay: 0.35s;
        }

        @keyframes fadeSlideIn {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .pais-documentos li a {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: var(--text-dark);
            background: linear-gradient(135deg, var(--text-light) 0%, var(--secondary-color) 100%);
            padding: 14px 20px;
            border-radius: 12px;
            transition: var(--transition);
            border: 2px solid transparent;
            background-clip: padding-box;
            position: relative;
            overflow: hidden;
            font-weight: 500;
            box-shadow: 0 2px 10px rgba(84, 73, 73, 0.1);
        }

        /* Efecto de brillo animado */
        .pais-documentos li a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg,
                    transparent,
                    rgba(227, 197, 202, 0.4),
                    transparent);
            transition: left 0.5s ease;
        }

        .pais-documentos li a:hover::before {
            left: 100%;
        }

        /* Icono de documento animado */
        .pais-documentos li a::after {
            content: '';
            font-size: 1.2em;
            transition: transform 0.3s ease;
            display: inline-block;
        }

        .pais-documentos li a:hover {
            background: linear-gradient(135deg, var(--accent-color) 0%, var(--accent-secondary) 100%);
            color: var(--text-light);
            transform: translateX(10px) scale(1.03);
            box-shadow: 0 8px 25px rgba(187, 12, 43, 0.35);
            border-color: rgba(187, 12, 43, 0.3);
        }

        .pais-documentos li a:hover::after {
            transform: scale(1.2) rotate(10deg);
            animation: bounce 0.5s ease;
        }

        .pais-documentos li a:active {
            transform: translateX(10px) scale(0.98);
        }

        @keyframes bounce {

            0%,
            100% {
                transform: scale(1.2) rotate(10deg) translateY(0);
            }

            50% {
                transform: scale(1.2) rotate(10deg) translateY(-5px);
            }
        }

        /* ===========================================
   DESCRIPCIÓN DEL DOCUMENTO
   =========================================== */

        .doc-desc {
            font-style: italic;
            font-size: 0.95em;
            color: var(--text-gray);
            margin-top: 10px;
            padding: 12px 16px;
            background: linear-gradient(135deg, rgba(187, 12, 43, 0.05) 0%, rgba(188, 126, 206, 0.05) 100%);
            border-left: 4px solid var(--accent-color);
            border-radius: 0 8px 8px 0;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .doc-desc::before {
            content: 'ℹ️';
            position: absolute;
            left: -25px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.2em;
            transition: left 0.3s ease;
        }

        .work-item:hover .doc-desc {
            background: linear-gradient(135deg, rgba(187, 12, 43, 0.1) 0%, rgba(188, 126, 206, 0.1) 100%);
            border-left-color: var(--accent-secondary);
            color: var(--text-dark);
            padding-left: 40px;
        }

        .work-item:hover .doc-desc::before {
            left: 12px;
        }

        /* ===========================================
   SUB-DOCUMENTOS (si existen)
   =========================================== */

        .sub-documentos {
            list-style: none;
            padding-left: 20px;
            margin-top: 12px;
            border-left: 2px dashed rgba(187, 12, 43, 0.3);
        }

        .sub-documentos li {
            margin-bottom: 10px;
            position: relative;
            padding-left: 30px;
            animation: fadeSlideIn 0.5s ease forwards;
            opacity: 0;
        }

        .sub-documentos li::before {
            content: '→';
            position: absolute;
            left: 8px;
            color: var(--accent-color);
            font-weight: bold;
            font-size: 1.2em;
            transition: transform 0.3s ease;
        }

        .sub-documentos li:hover::before {
            transform: translateX(5px);
            animation: arrowPulse 0.6s ease infinite;
        }

        @keyframes arrowPulse {

            0%,
            100% {
                transform: translateX(5px);
            }

            50% {
                transform: translateX(10px);
            }
        }

        .sub-documentos li a {
            font-size: 0.95em;
            padding: 10px 16px;
        }

        /* ===========================================
   DOCUMENTO ITEM CONTAINER
   =========================================== */

        .documento-item {
            background: rgba(255, 255, 255, 0.5);
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
            border: 1px solid rgba(187, 12, 43, 0.1);
        }

        .documento-item:hover {
            background: rgba(227, 197, 202, 0.2);
            border-color: rgba(187, 12, 43, 0.3);
            box-shadow: 0 4px 15px rgba(187, 12, 43, 0.15);
        }

        /* Contenido del documento */
        .doc-descripcion {
            color: var(--text-dark);
            line-height: 1.6;
            margin-bottom: 10px;
        }

        .doc-descripcion p {
            margin-bottom: 8px;
            color: var(--text-color);
        }

        /* ===========================================
   ESTILOS ADICIONALES PARA WORK ITEMS
   =========================================== */

        .work-item {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(227, 197, 202, 0.15) 100%);
            border: 1px solid rgba(187, 12, 43, 0.1);
        }

        .work-item:hover {
            background: linear-gradient(135deg, rgba(255, 255, 255, 1) 0%, rgba(227, 197, 202, 0.25) 100%);
            border-color: rgba(187, 12, 43, 0.3);
            box-shadow: 0 20px 40px rgba(187, 12, 43, 0.2);
        }

        .work-title {
            background: linear-gradient(135deg, var(--accent-color) 0%, var(--accent-secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .collapse-icon {
            color: var(--accent-color);
            background: rgba(187, 12, 43, 0.1);
        }

        .work-item:hover .collapse-icon {
            background: rgba(187, 12, 43, 0.2);
            color: var(--accent-secondary);
        }

        .work-year {
            background: linear-gradient(135deg, var(--accent-color) 0%, var(--accent-secondary) 100%);
            color: var(--text-light);
            box-shadow: 0 4px 15px rgba(187, 12, 43, 0.3);
        }

        .work-item:hover .work-year {
            box-shadow: 0 6px 20px rgba(187, 12, 43, 0.4);
        }

        /* ===========================================
   RESPONSIVE
   =========================================== */

        @media (max-width: 768px) {
            .bandera-pais {
                width: 42px;
                height: 42px;
                margin-right: 12px;
            }

            .pais-documentos li a {
                padding: 12px 16px;
                font-size: 0.95em;
            }

            .doc-desc {
                font-size: 0.9em;
                padding: 10px 14px;
            }
        }

        @media (max-width: 480px) {
            .bandera-pais {
                width: 38px;
                height: 38px;
            }

            .pais-documentos {
                gap: 10px;
            }

            .pais-documentos li a {
                padding: 10px 14px;
                font-size: 0.9em;
            }

            .documento-item {
                padding: 12px;
            }
        }
    </style>
</head>

<body <?php body_class() ?>>
    <?php get_header(); ?>

    <main class="mt-5">
        <!-- Hero Section -->
        <section class="hero-about-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="hero-about-content" data-aos="fade-up">
                            <div class="breadcrumb-custom">
                                <a href="<?php echo esc_url(url: home_url('/')); ?>" class="me-2">Inicio <i class="fas fa-chevron-right ms-1"></i></a>
                                <span class="text-white">Politicas Vertisub</span>
                            </div>
                            <?php
                            // Obtener todos los servicios de introducción publicados
                            $servicios = get_posts(array(
                                'post_type'      => 'servicios_intro',
                                'posts_per_page' => -1 // todos los servicios
                            ));

                            ?>
                            <h1 class="display-3 fw-bold text-white">Nuestros Politicas</h1>
                            <div class="intro-description text-white mt-3">
                                <?php if (!empty($servicios)) : ?>
                                    <?php foreach ($servicios as $servicio) : ?>
                                        <?php echo esc_html($servicio->post_content); ?>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <p>Próximamente agregaremos nuestros servicios.</p>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php
        $paises = get_posts([
            'post_type'      => 'paises',
            'posts_per_page' => -1
        ]);

        if ($paises): ?>
            <section id="nosotros" class="about-section mb-5">
                <div class="container">
                    <div class="row align-items-start">
                        <div class="col-lg-12 mt-5">
                            <div class="work-items-container">

                                <?php foreach ($paises as $pais): ?>
                                    <?php
                                    // Dirección
                                    $descripcion_pais = get_post_meta($pais->ID, '_direccion', true);

                                    // Usar el meta _pais_slug
                                    $slug = strtolower(get_post_meta($pais->ID, '_pais_slug', true));

                                    // Fallback si no existe
                                    if (empty($slug)) {
                                        $slug = strtolower($pais->post_name);
                                    }

                                    // URL de bandera desde FlagCDN
                                    $bandera = "https://flagcdn.com/w80/{$slug}.png";

                                    // Traer documentos asociados
                                    $docs = get_posts([
                                        'post_type'      => 'documentos_pais',
                                        'meta_query'     => [[
                                            'key'     => '_pais_relacionado',
                                            'value'   => $pais->ID,
                                            'compare' => '='
                                        ]],
                                        'posts_per_page' => -1,
                                    ]);

                                    if (empty($docs)) continue;
                                    ?>
                                    <div class="work-item" data-project="<?= esc_attr($pais->ID); ?>">
                                        <div class="work-header d-flex align-items-center">
                                            <div class="work-icon">
                                                <img src="<?= esc_url($bandera); ?>"
                                                    alt="<?= esc_attr($pais->post_title); ?>"
                                                    class="bandera-pais">
                                            </div>
                                            <h3 class="work-title">Políticas Vertisub <?= esc_html($pais->post_title); ?></h3>
                                            <div class="work-meta">
                                                <div class="collapse-icon">
                                                    <span class="icon-plus">+</span>
                                                    <span class="icon-minus">-</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="work-content">
                                            <ul class="pais-documentos">
                                                <?php foreach ($docs as $doc): ?>
                                                    <?php
                                                    // Contenido del CPT Documento
                                                    $contenido_doc = apply_filters('the_content', $doc->post_content);

                                                    // Metacampo de documentos adicionales
                                                    $documentos = get_post_meta($doc->ID, '_documentos', true);
                                                    ?>

                                                    <li class="documento-item">

                                                        <?php if (!empty(trim($contenido_doc))): ?>
                                                            <div class="doc-descripcion">
                                                                <?= $contenido_doc; ?>
                                                            </div>
                                                        <?php endif; ?>

                                                        <?php if (is_array($documentos)): ?>
                                                            <ul class="sub-documentos">
                                                                <?php foreach ($documentos as $item):
                                                                    $docNombre  = $item['nombre'] ?? 'Documento';
                                                                    $docArchivo = $item['archivo'] ?? '#';
                                                                ?>
                                                                    <li>
                                                                        <a href="<?= esc_url($docArchivo); ?>" target="_blank">
                                                                            <?= esc_html($docNombre); ?>
                                                                        </a>
                                                                    </li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        <?php endif; ?>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    </main>
    <!-- Custom JS -->

    <?php get_template_part('components/floating-buttons'); ?>
    <?php get_footer(); ?>
</body>