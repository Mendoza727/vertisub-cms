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

    <main class="mt-5">


        <!-- Columna de imagen en un cuadro -->
        <div class="col-lg-5 d-flex justify-content-center" data-aos="fade-up">
            <div class="image-box" style="max-width: 600px; height: 400px; border-radius: 8px; overflow: hidden; margin-left: 33px;">
                <img src="http://localhost/vertisub/wp-content/uploads/2025/09/14a8aacb-725a-480b-b5ab-cdbbe099d0df.jpeg"
                    alt="Imagen Nosotros"
                    class="img-fluid">
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