<?php
/*
Template Name: Ubicacion
*/
?>

<head>
    <?php wp_head(); ?>
    <title>Mapa - Oficinas Vertisub</title>
</head>

<body <?php body_class(); ?>>
    <?php get_header(); ?>

    <?php get_template_part('loader'); ?>

    <main class="mt-5">
        <!-- Hero Section -->
        <section class="hero-about-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="hero-about-content" data-aos="fade-up">
                            <div class="breadcrumb-custom">
                                <a href="<?php echo esc_url(home_url('/')); ?>" class="me-2">Inicio <i class="fas fa-chevron-right ms-1"></i></a>
                                <span class="text-white">Ubicacion</span>
                            </div>
                            <?php
                            // Obtener la primera ubicación publicada
                            $ubicaciones = get_posts(array(
                                'post_type'      => 'ubicaciones',
                                'posts_per_page' => 1
                            ));

                            if (!empty($ubicaciones)) {
                                $ubicacion = $ubicaciones[0];
                            ?>
                                <h1 class="display-3 fw-bold text-white">
                                    <?php echo esc_html($ubicacion->post_title); ?>
                                </h1>
                                <div class="intro-description text-white mt-3">
                                    <?php echo esc_html($ubicacion->post_content); ?>
                                </div>
                            <?php
                            } else {
                                // Texto por defecto si no hay ubicaciones
                            ?>
                                <h1 class="display-3 fw-bold text-white">¿Dónde nos ubicamos?</h1>
                                <div class="intro-description text-white mt-3"></div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section class="map-section">
            <div class="map-container">
                <div class="section-header">
                    <h2 class="section-title">Nuestras Oficinas Globales</h2>
                    <p class="section-subtitle">Haz clic en cualquier país destacado para obtener información de contacto de nuestras oficinas</p>
                </div>

                <!-- map wrapper -->
                <div class="map-wrapper">
                    <div class="loading-indicator" id="loadingIndicator">
                        <i class="fas fa-spinner fa-spin"></i>
                        <span style="margin-left: 10px;">Cargando mapa...</span>
                    </div>
                    <div id="chartdiv"></div>
                </div>
            </div>
            </div>
        </section>

        <!-- Redesigned Modal -->
        <div class="modal-overlay" id="contactModal">
            <div class="modal-container">
                <div class="modal-header-maps">
                    <button class="close-btn" onclick="closeModal()">
                        <i class="fas fa-times"></i>
                    </button>
                    <img class="country-flag" id="countryFlag" src="" alt="">
                    <h2 class="country-name" id="modalTitle">País</h2>
                </div>
                <div class="modal-body" id="contactGrid">
                    <!-- La información se cargará dinámicamente -->
                </div>
            </div>
        </div>
    </main>

    <!-- Custom JS -->
    <script src="<?php echo get_template_directory_uri(); ?>/script.js"></script>

    <?php get_template_part('components/floating-buttons'); ?>
    <?php get_footer(); ?>
</body>