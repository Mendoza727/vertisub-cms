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

        <!-- Sección Proyectos Exitosos -->
        <section class="proyectos-section">
            <div class="container">
                <div class="section-header" data-aos="fade-up">
                    <span class="section-subtitle">Casos de Éxito</span>
                    <h2 class="section-title">Proyectos Exitosos</h2>
                    <p class="lead text-muted">Conoce algunos de los proyectos más destacados realizados por nuestro personal</p>
                </div>

                <div class="proyectos-stack-container">
                    <?php
                    $args = array(
                        'post_type'      => 'proyectos_exitosos',
                        'posts_per_page' => -1
                    );
                    $query = new WP_Query($args);

                    if ($query->have_posts()):
                        while ($query->have_posts()): $query->the_post();

                            $galeria = get_post_meta(get_the_ID(), '_galeria_proyecto', true) ?: [];
                    ?>

                            <div class="proyecto-stack" data-aos="fade-up">
                                <h3 class="stack-title"><?php the_title(); ?></h3>

                                <?php if (!empty($galeria)): ?>
                                    <div class="cards-stack">
                                        <?php foreach ($galeria as $index => $img_id):
                                            $img_url = wp_get_attachment_image_url($img_id, 'large');
                                            $class   = 'stack-card card-' . ($index + 1);
                                        ?>
                                            <div class="<?php echo esc_attr($class); ?>" style="background-image: url('<?php echo esc_url($img_url); ?>');">
                                                <div class="card-overlay">
                                                    <span><?php echo get_the_title($img_id); ?></span>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <button class="btn-proyecto-stack" onclick="abrirProyecto('puente-san-rafael')">
                                    Conoce Más
                                </button>
                            </div>

                    <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </div>
        </section>
    </main>

    <!-- Custom JS -->
    <script src="<?php echo get_template_directory_uri(); ?>/script.js"></script>
    <?php get_template_part('components/floating-buttons'); ?>
    <?php get_footer(); ?>
</body>