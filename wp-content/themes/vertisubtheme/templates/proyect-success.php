<?php
/*
Template Name: Proyectos
*/
?>

<head>
    <?php wp_head(); ?>
    <title>Proyectos Existosos Vertisub</title>
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
                                <span class="text-white">Proyectos</span>
                            </div>
                            <h1 class="display-3 fw-bold text-white">Historias de Éxito</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Custom JS -->
    <script src="<?php echo get_template_directory_uri(); ?>/script.js"></script>
    <?php get_template_part('components/floating-buttons'); ?>
    <?php get_footer(); ?>
</body>