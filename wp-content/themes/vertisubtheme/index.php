<?php
/*
Template Name: Sancho Landing Page
*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,100..900;1,100..900&family=Oswald:wght@200..700&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <?php get_header(); ?>

    <?php get_template_part('loader'); ?>


    <!-- Main Content -->
    <main id="main-content" class="main-content">
        <!-- Hero Section with Video -->
        <section id="hero" class="hero-section">
            <div class="hero-video-container">
                <video id="hero-video" class="hero-video" autoplay muted loop playsinline>
                    <source src="https://46733024.fs1.hubspotusercontent-na1.net/hubfs/46733024/Y2meta.app-Vertisub_%20MANIFIESTO-(720p).mp4" type="video/mp4">
                    <!-- Fallback para navegadores que no soportan video -->
                    <div class="video-fallback">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-fallback.jpg" alt="Hero Background" class="fallback-image">
                    </div>
                </video>
                <div class="hero-overlay"></div>
            </div>
        </section>

        <!-- Slogan Section -->
        <section id="slogan" class="slogan-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="slogan-content">
                            <h1 class="slogan-text">
                                <span class="slogan-line">Soluciones singulares a problemas</span>
                                <span class="slogan-line">complejos en entornos de riesgo</span>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section with Scroll Animations -->
        <section id="nosotros" class="about-section mb-5">
            <!-- Certifications Carousel -->
            <div class="certifications-carousel">
                <div class="carousel-container">
                    <div class="carousel-track" id="certificationsTrack">
                        <?php
                        $certificaciones = new WP_Query(array(
                            'post_type'      => 'certificaciones',
                            'posts_per_page' => -1, // todas las certificaciones
                            'orderby'        => 'date',
                            'order'          => 'DESC'
                        ));

                        if ($certificaciones->have_posts()) :
                            while ($certificaciones->have_posts()) : $certificaciones->the_post();
                        ?>
                                <div class="certification-item">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <img src="<?php the_post_thumbnail_url('medium'); ?>"
                                            alt="<?php the_title(); ?>"
                                            class="cert-logo">
                                    <?php else : ?>
                                        <img src="/placeholder.svg?height=80&width=120"
                                            alt="<?php the_title(); ?>"
                                            class="cert-logo">
                                    <?php endif; ?>
                                </div>
                            <?php
                            endwhile;
                            wp_reset_postdata();
                        else :
                            ?>
                            <p>No hay certificaciones registradas.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- About Content Grid -->
            <div class="container">
                <div class="row align-items-start">
                    <!-- Changed NOSOTROS to vertical text and removed card wrapper -->
                    <div class="col-lg-3">
                        <div class="about-title-section">
                            <h2 class="about-main-title vertical-text mt-5">NOSOTROS</h2>
                        </div>
                    </div>
                    <!-- Increased column size and removed card wrapper, added icons to work items -->
                    <div class="col-lg-9 mt-5">
                        <div class="work-items-container">
                            <?php
                            $args = array(
                                'post_type'      => 'nosotros',
                                'posts_per_page' => 4, // limitar a 4
                                'post_status'    => 'publish'
                            );

                            $nosotros_query = new WP_Query($args);

                            if ($nosotros_query->have_posts()) :
                                while ($nosotros_query->have_posts()) : $nosotros_query->the_post();
                                    $video_url = get_post_meta(get_the_ID(), '_about_video_url', true);
                                    $has_image = has_post_thumbnail();
                            ?>

                                    <div class="work-item" data-project="<?php echo esc_attr(get_post_field('post_name', get_the_ID())); ?>">
                                        <div class="work-header">
                                            <div class="work-icon">
                                                <!-- puedes cambiar el ícono a gusto -->
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </div>
                                            <h3 class="work-title"><?php the_title(); ?></h3>
                                            <div class="work-meta">
                                                <div class="collapse-icon">
                                                    <span class="icon-plus">+</span>
                                                    <span class="icon-minus">-</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="work-content">
                                            <p class="work-description"><?php the_content(); ?></p>

                                            <?php if ($video_url) : ?>
                                                <div class="work-video">
                                                    <iframe width="560" height="315"
                                                        src="<?php echo esc_url($video_url); ?>"
                                                        frameborder="0" allowfullscreen>
                                                    </iframe>
                                                </div>
                                            <?php elseif ($has_image) : ?>
                                                <div class="work-image">
                                                    <?php the_post_thumbnail('medium'); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                            <?php
                                endwhile;
                                wp_reset_postdata();
                            else :
                                echo '<p>No hay apartados de nosotros aún.</p>';
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Mission & Vision Section -->
        <section id="mision-vision" class="mission-vision-section mt-5">
            <div class="container">
                <!-- Mission & Vision Headers -->
                <div class="row mb-5 position-relative">
                    <!-- Adding divider line between mission and vision -->
                    <div class="mission-vision-divider"></div>

                    <div class="col-lg-6">
                        <div class="mission-content">
                            <div class="mission-vision-card">
                                <h2 class="section-title">MISIÓN</h2>
                                <p class="section-description">Desarrollamos soluciones integrales de comunicación que transforman desafíos complejos en oportunidades de crecimiento para nuestros clientes.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="vision-content">
                            <div class="mission-vision-card">
                                <h2 class="section-title">VISIÓN</h2>
                                <p class="section-description">Ser la agencia líder en innovación estratégica, reconocida por crear experiencias memorables que conectan marcas con sus audiencias.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Information Cards -->
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6">
                        <div class="info-card" data-card="contacto">
                            <div class="card-icon">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M22 12H18L15 21L9 3L6 12H2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <h3 class="card-title">CONTÁCTENOS</h3>
                            <div class="card-content">
                                <p class="card-description">Estamos aquí para escuchar tus ideas y convertirlas en realidad.</p>
                                <div class="contact-info">
                                    <p><strong>Email:</strong> info@vertisub.com</p>
                                    <p><strong>Teléfono:</strong> +57 (4) 123-4567</p>
                                    <p><strong>Dirección:</strong> Bogota, Colombia</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="info-card" data-card="politicas">
                            <div class="card-icon">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <polyline points="14,2 14,8 20,8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <h3 class="card-title">POLÍTICAS</h3>
                            <div class="card-content">
                                <p class="card-description">Conoce nuestras políticas de privacidad y términos de servicio.</p>
                                <div class="policies-info">
                                    <p><strong>Política de Privacidad:</strong> Protegemos tu información personal</p>
                                    <p><strong>Términos de Servicio:</strong> Condiciones de uso de nuestros servicios</p>
                                    <p><strong>Política de Calidad:</strong> Comprometidos con la excelencia</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="info-card" data-card="legal">
                            <div class="card-icon">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 1L3 5V11C3 16.55 6.84 21.74 12 23C17.16 21.74 21 16.55 21 11V5L12 1Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M9 12L11 14L15 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <h3 class="card-title">INFORMACIÓN LEGAL</h3>
                            <div class="card-content">
                                <p class="card-description">Información legal y datos corporativos de nuestra empresa.</p>
                                <div class="legal-info">
                                    <p><strong>NIT:</strong> 900.123.456-7</p>
                                    <p><strong>Razón Social:</strong> Vertisub S.A.S.</p>
                                    <p><strong>Registro Mercantil:</strong> 12345678</p>
                                    <p><strong>Cámara de Comercio:</strong> Bogota</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script src="<?php echo get_template_directory_uri(); ?>/script.js"></script>

    <!-- Added whatsapp button -->
    <button id="whatsapp" class="whatsapp-button" aria-label="Volver al inicio">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
            xmlns="http://www.w3.org/2000/svg" aria-label="WhatsApp">
            <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12c0 1.39.29 2.71.81 3.9L3 21l5.25-1.22A9.96 9.96 0 0 0 12 22Z"
                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M17.47 14.38c-.3-.15-1.76-.87-2.03-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.94 1.16-.17.2-.35.22-.64.07-.3-.15-1.26-.46-2.39-1.48-1.13-1.01-1.6-1.93-1.65-2.06-.17-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.03-.52-.07-.15-.67-1.62-.92-2.21-.24-.58-.49-.5-.67-.51l-.57-.01c-.2 0-.52.07-.79.37-.27.3-1.04 1.02-1.04 2.48 0 1.46 1.06 2.88 1.21 3.07.15.2 2.1 3.2 5.08 4.49.71.3 1.26.49 1.7.63.71.22 1.36.19 1.87.12.57-.09 1.76-.72 2.01-1.41.25-.69.25-1.29.17-1.41-.08-.13-.28-.2-.58-.35Z"
                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </button>

    <!-- Added back to top button -->
    <button id="backToTop" class="back-to-top" aria-label="Volver al inicio">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 19V5M5 12L12 5L19 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </button>

    <?php get_footer(); ?>
</body>

</html>