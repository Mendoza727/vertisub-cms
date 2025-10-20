<?php
/*
Template Name: Nosotros
*/
?>

<head>
    <?php wp_head(); ?>
    <style>
        .contact-info p {
            color: black !important;
        }
    </style>
</head>

<body <?php body_class(); ?>>
    <?php get_header(); ?>

    <main class="mt-5">
        <?php if (vertisub_get_acf_field('mostrar_hero')) : ?>
            <?php $hero_data = vertisub_get_acf_field('hero'); ?>
            <section class="hero-about-section">
                <div class="container">
                    <div class="row">
                        <div class="row align-items-center">
                            <div class="col-lg-7">
                                <div class="hero-about-content" data-aos="fade-up">
                                    <?php if ($hero_data['breadcrumb']) : ?>
                                        <div class="breadcrumb-custom">
                                            <a href="<?php echo esc_url(home_url('/')); ?>" class="me-2">
                                                Inicio <i class="fas fa-chevron-right ms-1"></i>
                                            </a>
                                            <span class="text-white"><?= $hero_data['breadcrumb']; ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($hero_data['titulo']) : ?>
                                        <h1 class="display-3 fw-bold text-white">
                                            <?= $hero_data['titulo']; ?>
                                        </h1>
                                    <?php endif; ?>

                                    <?php if ($hero_data['descripcion']): ?>
                                        <div class="intro-description text-white mt-3">
                                            <?= $hero_data['descripcion']; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <?php $hero_image = $hero_data['imagen'] ? $hero_data['imagen'] : 'https://vertisub.com/wp-content/uploads/2025/10/23a002b8-8c78-4fa8-95e7-e0ae22f114cb.jpg'; ?>
                            <div class="col-lg-5 d-flex justify-content-center" data-aos="fade-up">
                                <div class="image-box" style="max-width: 600px; height: 290px; border-radius: 8px; overflow: hidden; margin-left: 33px; margin-top: 80px;">
                                    <img src="<?= $hero_image; ?>"
                                        alt="Imagen Nosotros"
                                        class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>


        <?php $solutions_data = vertisub_get_acf_field('soluciones'); ?>
        <section class="about-us-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6" data-aos="fade-right">
                        <div class="about-image-wrapper">
                            <?php if ($solutions_data['imagen']): ?>
                                <img src="<?= $solutions_data['imagen']; ?>" alt="Sobre nosotros" class="img-fluid rounded shadow" style="width: 100%; height: 100%;">
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-left">
                        <div class="ps-lg-4">
                            <?php if ($solutions_data['subtitulo']): ?>
                                <span class="section-subtitle"><?= $solutions_data['subtitulo']; ?></span>
                            <?php endif; ?>

                            <?php if ($solutions_data['titulo']): ?>
                                <h2 class="section-title"><?= $solutions_data['titulo']; ?></h2>
                            <?php endif; ?>

                            <?php $caption_data = $solutions_data['caption']; ?>
                            <?php if ($caption_data): ?>
                                <div class="feature-box">
                                    <div class="feature-icon">
                                        <i class="fas fa-hammer"></i>
                                    </div>
                                    <div>
                                        <?php if ($caption_data['titulo']): ?>
                                            <h4 class="fw-bold mb-2">
                                                <?= $caption_data['titulo']; ?>
                                            </h4>
                                        <?php endif; ?>

                                        <?php if ($caption_data['descripcion']): ?>
                                            <p class="text-muted mb-0">
                                                <?= $caption_data['descripcion']; ?>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if ($solutions_data['descripcion']): ?>
                                <p class="text-muted mb-4">
                                    <?= $solutions_data['descripcion']; ?>
                                </p>
                            <?php endif; ?>

                            <?php if ($solutions_data['video_url']): ?>
                                <div class="video-wrapper" style="position: relative; width: 100%; max-width: 800px; margin: auto; cursor: pointer;">
                                    <!-- Video invisible para capturar el primer frame como miniatura -->
                                    <video id="mainVideo" style="display:none;">
                                        <source src="<?= $solutions_data['video_url']; ?>" type="video/mp4">
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
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php $mision_data = vertisub_get_acf_field('mision'); ?>
        <section class="cta-section">
            <!-- Stats Section -->
            <div class="container stats-section p-3" style="background-color: white;">
                <div class="cta-content" data-aos="fade-up">
                    <?php if ($mision_data['titulo']): ?>
                        <h2 class="cta-title"><?= $mision_data['titulo']; ?></h2>
                    <?php endif; ?>

                    <?php if ($mision_data['subtitulo']): ?>
                        <p class="cta-subtitle"><?= $mision_data['subtitulo']; ?></p>
                    <?php endif; ?>

                    <!-- Mission & Vision Section -->
                    <section ction id="mision-vision" class="mission-vision-section">
                        <div class="container">
                            <!-- Mission & Vision Headers -->
                            <div class="row mb-5 mt-5 position-relative">
                                <!-- Adding divider line between mission and vision -->
                                <div class="mission-vision-divider"></div>

                                <?php if ($mision_data['mision']): ?>
                                    <div class="col-lg-6">
                                        <div class="mission-content">
                                            <div class="mission-vision-card">
                                                <h2 class="section-title">MISIÓN</h2>
                                                <p class="section-description"><?= $mision_data['mision']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if ($mision_data['vision']): ?>
                                    <div class="col-lg-6">
                                        <div class="vision-content">
                                            <div class="mission-vision-card">
                                                <h2 class="section-title">VISIÓN</h2>
                                                <p class="section-description"><?= $mision_data['vision']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <?php $international_data = vertisub_get_acf_field('internacional'); ?>
            <div class="container stats-section p-3">
                <div class="row">
                    <div class="col-lg-8 mx-auto text-center mb-5" data-aos="fade-up">
                        <?php if ($international_data['subtitulo']): ?>
                            <span class="section-subtitle"><?= $international_data['subtitulo']; ?></span>
                        <?php endif; ?>

                        <?php if ($international_data['titulo']): ?>
                            <h2 class="section-title"><?= $international_data['titulo']; ?></h2>
                        <?php endif; ?>

                        <?php if ($international_data['descripcion']): ?>
                            <p class="lead text-muted"><?= $international_data['descripcion']; ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <?php $statistics = $international_data['datos']; ?>

                <?php if ($statistics): ?>
                    <div class="row">
                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-user-tie"></i>
                                </div>
                                <?php if ($statistics['numero_proyectos']): ?>
                                    <div class="stat-number" data-count="<?= $statistics['numero_proyectos']; ?>">0</div>
                                <?php endif; ?>

                                <?php if ($statistics['descripcion_proyectos']): ?>
                                    <div class="stat-label"><?= $statistics['descripcion_proyectos']; ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                            <div class="stat-card">
                                <div class="stat-icon">
                                    <i class="fas fa-users"></i>
                                </div>

                                <?php if ($statistics['numero_clientes']): ?>
                                    <div class="stat-number" data-count="<?= $statistics['numero_clientes']; ?>">0</div>
                                <?php endif; ?>

                                <?php if ($statistics['descripcion_clientes']): ?>
                                    <div class="stat-label"><?= $statistics['descripcion_clientes']; ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <?php $clients_data = vertisub_get_acf_field('nuestros_clientes'); ?>
        <section class="team-section">
            <div class="certifications-carousel">
                <div class="carousel-container">
                    <div class="row">
                        <?php if ($clients_data['titulo']): ?>
                            <div class="col-lg-8 mx-auto text-center mb-5" data-aos="fade-up">
                                <span class="section-subtitle"><?= $clients_data['titulo']; ?></span>
                            </div>
                        <?php endif; ?>
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

        <?php $testimonials_data = vertisub_get_acf_field('filosofia'); ?>
        <section class="testimonials-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6" data-aos="fade-right">
                        <?php if ($testimonials_data['subtitulo']): ?>
                            <span class="section-subtitle text-white"><?= $testimonials_data['subtitulo']; ?></span>
                        <?php endif; ?>
                        <?php if ($testimonials_data['titulo']): ?>
                            <h2 class="text-white mb-4" style="font-size: 3rem; line-height: 1.2;">
                                <?= $testimonials_data['titulo']; ?>
                            </h2>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-6" data-aos="fade-left">
                        <div class="testimonial-card">
                            <?php if ($testimonials_data['frase']): ?>
                                <div class="testimonial-text">
                                    <?= $testimonials_data['frase']; ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($testimonials_data['autor']): ?>
                                <div class="testimonial-author">
                                    <div class="testimonial-info">
                                        <h5 class="text-center"><?= $testimonials_data['autor']; ?></h5>

                                        <?php if ($testimonials_data['cargo']): ?>
                                            <span class="text-center"><?= $testimonials_data['cargo']; ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php $contact_data = vertisub_get_acf_field('escribenos'); ?>
        <section class="cta-section">
            <div class="container">
                <div class="cta-content" data-aos="fade-up">
                    <?php if ($contact_data['subtitulo']): ?>
                        <h2 class="cta-subtitle"><?= $contact_data['subtitulo']; ?></h2>
                    <?php endif; ?>

                    <!-- Mission & Vision Section -->
                    <section ction id="mision-vision" class="mission-vision-section mt-5">
                        <div class="container">

                            <?php $contact = $contact_data['contacto']; ?>
                            <div class="row g-4 mb-5">
                                <div class="col-lg-6 col-md-6">
                                    <div class="info-card" data-card="contacto">
                                        <div class="card-icon">
                                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M22 12H18L15 21L9 3L6 12H2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>

                                        <?php if ($contact['titulo']): ?>
                                            <h3 class="card-title"><?= $contact['titulo']; ?></h3>
                                        <?php endif; ?>
                                        <div class="card-content">
                                            <?php if ($contact['descripcion']): ?>
                                                <p class="card-description"><?= $contact['descripcion']; ?></p>
                                            <?php endif; ?>

                                            <div>
                                                <?php if ($contact['email']): ?>
                                                    <p><strong>Email:</strong> <?= $contact['email']; ?></p>
                                                <?php endif; ?>
                                                <?php if ($contact['telefono']): ?>
                                                    <p><strong>Teléfono:</strong> <?= $contact['telefono']; ?></p>
                                                <?php endif; ?>
                                                <?php if ($contact['direccion']): ?>
                                                    <p><strong>Dirección:</strong> <?= $contact['direccion']; ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php $politicas = $contact_data['politicas']; ?>
                                <div class="col-lg-6 col-md-6">
                                    <div class="info-card" data-card="politicas">
                                        <div class="card-icon">
                                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                <polyline points="14,2 14,8 20,8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                        <?php if ($politicas['titulo']): ?>
                                            <h3 class="card-title"><?= $politicas['titulo']; ?></h3>
                                        <?php endif; ?>
                                        <div class="card-content">
                                            <?php if ($politicas['descripcion']): ?>
                                                <p class="card-description"><?= $politicas['descripcion']; ?></p>
                                            <?php endif; ?>

                                            <?php if ($politicas['url']): ?>
                                                <div class="policies-info">
                                                    <p>
                                                        <strong>
                                                            <a href="<?= $politicas['url']; ?>">
                                                                Política de Privacidad:
                                                            </a>
                                                        </strong>
                                                        <?= $politicas['politicas']; ?>
                                                    </p>
                                                </div>
                                            <?php endif; ?>
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
                                    <?php if ($solutions_data['video_url']): ?>
                                        <video controls width="100%">
                                            <source src="<?= $solutions_data['video_url']; ?>" type="video/mp4">
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

        const videoSrc = "<?= $solutions_data['video_url']; ?>";
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
    <?php get_template_part('components/floating-buttons'); ?>
    <?php get_footer(); ?>
</body>