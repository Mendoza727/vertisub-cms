<?php
/*
Template Name: Noticias
*/
?>

<head>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php get_header(); ?>


    <main class="mt-5">
        <?php if (vertisub_get_acf_field('mostrar_hero')) : ?>
            <?php $hero_data = vertisub_get_acf_field('hero'); ?>
            <section class="hero-about-section">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="hero-about-content" data-aos="fade-up">
                                <?php if ($hero_data['breadcrumb']) : ?>
                                    <div class="breadcrumb-custom">
                                        <a href="<?php echo esc_url(home_url('/')); ?>" class="me-2">Inicio <i class="fas fa-chevron-right ms-1"></i></a>
                                        <span class="text-white"><?= $hero_data['breadcrumb']; ?></span>
                                    </div>
                                <?php endif; ?>

                                <?php if ($hero_data['titulo']) : ?>
                                    <h1 class="display-3 fw-bold text-white"><?= $hero_data['titulo']; ?></h1>
                                <?php endif; ?>

                                <?php if ($hero_data['descripcion']) : ?>
                                    <div class="intro-description text-white mt-3">
                                        <p style="font-size: 20px;"><?= $hero_data['descripcion']; ?></p>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>


                        <?php $right_image = $hero_data['imagen_lateral']; ?>
                        <?php if ($right_image) : ?>
                            <div class="col-lg-5 d-flex justify-content-center" data-aos="fade-up">
                                <div class="image-box" style="max-width: 600px; height: 400px; border-radius: 8px; overflow: hidden; margin-left: 33px; margin-top: 20px">
                                    <img src="<?= $right_image; ?>"
                                        alt="Imagen Nosotros"
                                        class="img-fluid">
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </section>
        <?php endif; ?>


        <!-- About Section -->
        <section class="sancho-services-section">
            <div class="container">

                <section class="certifications-section">
                    <div class="container">

                        <div class="certifications-grid" id="certificationsGrid">
                            <?php
                            $args = array(
                                'post_type'      => 'post',
                                'posts_per_page' => 6,
                                'post_status'    => 'publish'
                            );
                            $noticias = new WP_Query($args);

                            if ($noticias->have_posts()):
                                while ($noticias->have_posts()): $noticias->the_post();
                                    $post_id = get_the_ID();
                            ?>

                                    <div class="certification-card" data-aos="fade-up" data-aos-delay="100">
                                        <div class="cert-image"
                                            style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url($post_id, 'large')); ?>')">
                                        </div>

                                        <div class="cert-content">
                                            <h3 class="cert-title"><?php the_title(); ?></h3>
                                            <p class="cert-description">
                                                <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                                            </p>

                                            <a href="<?php the_permalink(); ?>" class="btn-expand">
                                                <i class="fas fa-plus me-2"></i>Conoce Más
                                            </a>
                                        </div>
                                    </div>

                            <?php
                                endwhile;
                                wp_reset_postdata();
                            else:
                                echo '<p>No hay noticias disponibles.</p>';
                            endif;
                            ?>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </main>



    <!-- Custom JS -->

    <?php get_template_part('components/floating-buttons'); ?>
    <?php get_footer(); ?>
</body>