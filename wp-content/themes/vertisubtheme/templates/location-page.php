<?php
/*
Template Name: Ubicacion
*/
?>

<head>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php get_header(); ?>


    <main class="mt-5">
        <!-- About Section -->
        <section class="map-section">
            <div class="map-container">
                <div class="section-header">
                    <h2 class="section-title"><?= vertisub_get_acf_field("titulo"); ?></h2>
                    <p class="section-subtitle"><?= vertisub_get_acf_field("descripcion"); ?></p>
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

    <?php get_template_part('components/floating-buttons'); ?>
    <?php get_footer(); ?>
</body>