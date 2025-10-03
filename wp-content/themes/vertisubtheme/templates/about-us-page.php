<?php
/*
Template Name: Nosotros
*/
?>

<head>
    <title>About Us</title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php get_header(); ?>

    <?php get_template_part('loader'); ?>



    <main class="mt-5">
        <?php

        // 1. Obtener el primer (y único) registro del CPT "nosotros"
        $args = array(
            'post_type'      => 'nosotros',
            'posts_per_page' => 1,
        );
        $nosotros_query = new WP_Query($args);

        ?>

        <?php
        if ($nosotros_query->have_posts()) :
            while ($nosotros_query->have_posts()) : $nosotros_query->the_post();
                $data = get_post_meta(get_the_ID(), '_about_extra', true);
                if (!is_array($data)) $data = [];
        ?>

                <section class="hero-about-section">
                    <div class="container">
                        <div class="row">
                            <div class="row align-items-center">
                                <!-- Columna de texto existente -->
                                <div class="col-lg-7">
                                    <div class="hero-about-content" data-aos="fade-up">
                                        <div class="breadcrumb-custom">
                                            <a href="<?php echo esc_url(home_url('/')); ?>" class="me-2">
                                                Inicio <i class="fas fa-chevron-right ms-1"></i>
                                            </a>
                                            <span class="text-white">Nosotros</span>
                                        </div>

                                        <h1 class="display-3 fw-bold text-white">
                                            <?php echo esc_html($data['intro_title'] ?? 'Sobre Nosotros'); ?>
                                        </h1>

                                        <?php if (!empty($data['intro_desc'])): ?>
                                            <div class="intro-description text-white mt-3">
                                                <?php echo wp_kses_post(wpautop($data['intro_desc'])); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

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
                    </div>
                </section>

        <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>

        <!-- About Section -->
        <section class="about-us-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6" data-aos="fade-right">
                        <div class="about-image-wrapper">
                            <?php if (!empty($data['main_image'])): ?>
                                <img src="<?php echo esc_url($data['main_image']); ?>" alt="Sobre nosotros" class="img-fluid rounded shadow" style="width: 100%; height: 100%;">
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-left">
                        <div class="ps-lg-4">
                            <span class="section-subtitle">Bienvenido a Vertisub</span>
                            <h2 class="section-title"><?php echo esc_html($data['main_title']); ?></h2>

                            <div class="feature-box">
                                <div class="feature-icon">
                                    <i class="fas fa-hammer"></i>
                                </div>
                                <div>
                                    <?php if (!empty($data['years_desc'])): ?>
                                        <h4 class="fw-bold mb-2">Tenemos mas de <?php echo intval($data['years']); ?> años de experiencia</h4>
                                        <p class="text-muted mb-0">
                                            <?php echo wp_kses_post($data['years_desc']); ?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <p class="text-muted mb-4">
                                <?php echo wpautop($data['main_desc']); ?>
                            </p>

                            <div class="video-wrapper" style="position: relative; width: 100%; max-width: 800px; margin: auto; cursor: pointer;">
                                <!-- Video invisible para capturar el primer frame como miniatura -->
                                <video id="mainVideo" style="display:none;">
                                    <source src="<?php echo esc_url($data['main_video']); ?>" type="video/mp4">
                                </video>

                                <!-- Miniatura generada del primer frame con canvas -->
                                <canvas id="videoThumbnail" style="width: 100%; display: block; object-fit: cover;"></canvas>

                                <!-- Botón de play encima -->
                                <div id="playButton" style="
                                    position: absolute;
                                    top: 50%;
                                    left: 50%;
                                    transform: translate(-50%, -50%);
                                    font-size: 64px;
                                    color: white;
                                    background: rgba(0,0,0,0.4);
                                    border-radius: 50%;
                                    width: 100px;
                                    height: 100px;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                ">
                                    <i class="fas fa-play"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta-section">
            <!-- Stats Section -->
            <div class="container stats-section p-3" style="background-color: white;">
                <div class="cta-content" data-aos="fade-up">
                    <h2 class="cta-title">Nuestro compromiso siempre será el éxito</h2>
                    <p class="cta-subtitle">conocenos</p>

                    <!-- Mission & Vision Section -->
                    <section ction id="mision-vision" class="mission-vision-section">
                        <div class="container">
                            <!-- Mission & Vision Headers -->
                            <div class="row mb-5 mt-5 position-relative">
                                <!-- Adding divider line between mission and vision -->
                                <div class="mission-vision-divider"></div>

                                <div class="col-lg-6">
                                    <div class="mission-content">
                                        <div class="mission-vision-card">
                                            <h2 class="section-title">MISIÓN</h2>
                                            <p class="section-description"> <?php echo esc_html(get_theme_mod('mision_text')); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="vision-content">
                                        <div class="mission-vision-card">
                                            <h2 class="section-title">VISIÓN</h2>
                                            <p class="section-description"><?php echo esc_html(get_theme_mod('vision_text')); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <div class="container stats-section p-3">
                <div class="row">
                    <div class="col-lg-8 mx-auto text-center mb-5" data-aos="fade-up">
                        <span class="section-subtitle">Vertisub Internacional</span>
                        <h2 class="section-title">Tu aliado estratégico</h2>
                        <p class="lead text-muted">
                            <?php echo wp_kses_post($data['partner_desc']); ?>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <div class="stat-number" data-count="<?php echo wp_kses_post($data['projects']); ?>">0</div>
                            <div class="stat-label">Proyectos Completados</div>
                        </div>
                    </div>
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stat-number" data-count="<?php echo wp_kses_post($data['clients']); ?>">0</div>
                            <div class="stat-label">Clientes Satisfechos</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Team Section -->
        <section class="team-section">
            <div class="certifications-carousel">
                <div class="carousel-container">
                    <div class="row">
                        <div class="col-lg-8 mx-auto text-center mb-5" data-aos="fade-up">
                            <span class="section-subtitle">Nuestros Clientes</span>
                        </div>
                    </div>
                    <div class="carousel-track" id="certificationsTrack">
                        <div class="row">
                            <!-- Team Member 1 -->
                            <?php
                            // Query para obtener los clientes
                            $args = array(
                                'post_type'      => 'clientes',
                                'posts_per_page' => -1,
                                'orderby'        => 'date',
                                'order'          => 'ASC'
                            );

                            $clientes = new WP_Query($args);

                            if ($clientes->have_posts()) :
                                while ($clientes->have_posts()) : $clientes->the_post();
                                    $mensaje = get_post_meta(get_the_ID(), '_mensaje', true);
                                    $imagen  = get_the_post_thumbnail_url(get_the_ID(), 'full');
                            ?>
                                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                                        <div class="team-card">
                                            <div class="team-image">
                                                <?php if ($imagen): ?>
                                                    <img src="<?php echo esc_url($imagen); ?>" alt="<?php the_title_attribute(); ?>">
                                                <?php endif; ?>
                                                <div class="team-overlay">
                                                    <?php if ($mensaje): ?>
                                                        <blockquote>
                                                            <p><?php echo esc_html($mensaje); ?></p>
                                                        </blockquote>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="team-info">
                                                <h4 class="team-name"><?php the_title(); ?></h4>
                                                <p class="team-position"><?php the_excerpt(); // la descripción 
                                                                            ?></p>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                endwhile;
                                wp_reset_postdata();
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="testimonials-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6" data-aos="fade-right">
                        <span class="section-subtitle text-white">Nuestra Filosofia</span>
                        <h2 class="text-white mb-4" style="font-size: 3rem; line-height: 1.2;">
                            Encontramos poder en las palabras que nos soportan
                        </h2>
                    </div>
                    <div class="col-lg-6" data-aos="fade-left">
                        <div class="testimonial-card">
                            <div class="testimonial-text">
                                "El progreso de la humanidad depende del éxito de los individuos en su empeño por mejorar sus condiciones de vida.""
                            </div>
                            <div class="testimonial-author">
                                <div class="testimonial-info">
                                    <h5 class="text-center">Ludwig von Mises</h5>
                                    <span class="text-center">Escuela Austriaca de Economia</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="cta-section">
            <div class="container">
                <div class="cta-content" data-aos="fade-up">
                    <h2 class="cta-subtitle">Escribenos</h2>

                    <!-- Mission & Vision Section -->
                    <section ction id="mision-vision" class="mission-vision-section mt-5">
                        <div class="container">

                            <!-- Information Cards -->
                            <div class="row g-4 mb-5">
                                <div class="col-lg-6 col-md-6">
                                    <div class="info-card" data-card="contacto">
                                        <div class="card-icon">
                                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M22 12H18L15 21L9 3L6 12H2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                        <h3 class="card-title">CONTÁCTENOS</h3>
                                        <div class="card-content">
                                            <p class="card-description">Estamos aquí para escucharte.</p>
                                            <div class="contact-info">
                                                <p><strong>Email:</strong> <?php echo esc_html(get_theme_mod('contacto_email')); ?></p>
                                                <p><strong>Teléfono:</strong> <?php echo esc_html(get_theme_mod('contacto_telefono')); ?></p>
                                                <p><strong>Dirección:</strong> <?php echo esc_html(get_theme_mod('contacto_direccion')); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <div class="info-card" data-card="politicas">
                                        <div class="card-icon">
                                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                <polyline points="14,2 14,8 20,8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                        <h3 class="card-title">POLÍTICAS</h3>
                                        <div class="card-content">
                                            <p class="card-description">Conoce nuestras políticas de privacidad</p>
                                            <div class="policies-info">
                                                <p>
                                                    <strong>
                                                        <a href="<?php echo get_permalink(get_page_by_path('politica-datos-personales-vertisub')); ?>">
                                                            Política de Privacidad:
                                                        </a>
                                                    </strong>
                                                    Protegemos tu información personal
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
        </section>

        <!-- Video Modal -->
        <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="videoModalLabel">Nuestro Proceso de Trabajo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="ratio ratio-16x9">
                            <div class="d-flex align-items-center justify-content-center bg-light">
                                <div class="text-center">
                                    <?php if (!empty($data['main_video'])): ?>
                                        <video controls width="100%">
                                            <source src="<?php echo esc_url($data['main_video']); ?>" type="video/mp4">
                                            Tu navegador no soporta video.
                                        </video>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const videoModal = document.getElementById("videoModal");

            videoModal.addEventListener("hidden.bs.modal", function() {
                const video = videoModal.querySelector("video");
                if (video) {
                    video.pause();
                    video.currentTime = 0; // opcional: reinicia al inicio
                }
            });
        });

        const videoSrc = "<?php echo esc_url($data['main_video']); ?>";
        const canvas = document.getElementById('videoThumbnail');
        const ctx = canvas.getContext('2d');
        const playButton = document.getElementById('playButton');
        const wrapper = canvas.parentNode;

        // Crear un video oculto para capturar el primer frame
        const video = document.createElement('video');
        video.src = videoSrc;
        video.muted = true;
        video.playsInline = true;
        video.addEventListener('loadeddata', () => {
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
        });

        // Al hacer click, reemplaza la miniatura por el video real
        playButton.addEventListener('click', () => {
            wrapper.innerHTML = `
            <video controls autoplay width="100%">
                <source src="${videoSrc}" type="video/mp4">
                Tu navegador no soporta video.
            </video>
        `;
        });
    </script>

    <!-- Custom JS -->
    <script src="<?php echo get_template_directory_uri(); ?>/script.js"></script>
    <?php get_template_part('components/floating-buttons'); ?>
    <?php get_footer(); ?>
</body>