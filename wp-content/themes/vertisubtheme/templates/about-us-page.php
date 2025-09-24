<?php
/*
Template Name: Nosotros
*/
?>

<head>
    <?php wp_head(); ?>
    <title>About Us</title>
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
                                <span class="text-white">Nosotros</span>
                            </div>
                            <h1 class="display-3 fw-bold text-white">Sobre Nosotros</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section class="about-us-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6" data-aos="fade-right">
                        <div class="about-image-wrapper">
                            <div class="about-icon">
                                <i class="fas fa-hard-hat"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-left">
                        <div class="ps-lg-4">
                            <span class="section-subtitle">Bienvenido a Sancho</span>
                            <h2 class="section-title">Sancho - Empresa de Construcción</h2>

                            <div class="feature-box">
                                <div class="feature-icon">
                                    <i class="fas fa-hammer"></i>
                                </div>
                                <div>
                                    <h4 class="fw-bold mb-2">Estamos en este negocio desde 1975</h4>
                                    <p class="text-muted mb-0">Brindamos los mejores servicios industriales con décadas de experiencia y calidad garantizada.</p>
                                </div>
                            </div>

                            <p class="text-muted mb-4">
                                Lejos, muy lejos, detrás de las montañas de palabras, alejados de los países Vokalia y Consonantia, viven los textos ciegos. Separados viven en Bookmarksgrove, justo en la costa de la Semántica, un gran océano de lenguaje.
                            </p>

                            <div class="video-wrapper">
                                <div class="play-button" data-bs-toggle="modal" data-bs-target="#videoModal">
                                    <i class="fas fa-play"></i>
                                </div>
                            </div>

                            <h5 class="text-muted">Así es como trabajamos con nuestros clientes. Ver video</h5>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta-section">
            <div class="container">
                <div class="cta-content" data-aos="fade-up">
                    <h2 class="cta-title">Servicios Personalizados y de Alta Calidad</h2>
                    <p class="cta-subtitle">Podemos gestionar el edificio de tus sueños. Un pequeño río llamado Duden fluye por su lugar</p>
                    <button class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#quoteModal">
                        Solicitar Cotización
                    </button>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="stats-section">
            <div class="stats-bg"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto text-center mb-5" data-aos="fade-up">
                        <span class="section-subtitle">Vertisub - Empresa de Construcción</span>
                        <h2 class="section-title">Mejor Proveedor de Servicios Industriales</h2>
                        <p class="lead text-muted">
                            Lejos, muy lejos, detrás de las montañas de palabras, alejados de los países Vokalia y Consonantia, viven los textos ciegos.
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <div class="stat-number" data-count="48000">0</div>
                            <div class="stat-label">Proyectos Completados</div>
                        </div>
                    </div>
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stat-number" data-count="54900">0</div>
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
                            <span class="section-subtitle">Nuestro Equipo</span>
                        </div>
                    </div>
                    <div class="carousel-track" id="certificationsTrack">
                        <div class="row">
                            <!-- Team Member 1 -->
                            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                                <div class="team-card">
                                    <div class="team-image">
                                        <div class="team-overlay">
                                            <blockquote>
                                                <p>"Incluso el todopoderoso Pointing no tiene control sobre los textos ciegos, es una vida casi inortográfica"</p>
                                            </blockquote>
                                        </div>
                                    </div>
                                    <div class="team-info">
                                        <h4 class="team-name">Ryan Anderson</h4>
                                        <p class="team-position">Ingeniero Jefe</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Team Member 2 -->
                            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                                <div class="team-card">
                                    <div class="team-image">
                                        <div class="team-overlay">
                                            <blockquote>
                                                <p>"Incluso el todopoderoso Pointing no tiene control sobre los textos ciegos, es una vida casi inortográfica"</p>
                                            </blockquote>
                                        </div>
                                    </div>
                                    <div class="team-info">
                                        <h4 class="team-name">Greg Washer</h4>
                                        <p class="team-position">CEO</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Team Member 3 -->
                            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                                <div class="team-card">
                                    <div class="team-image">
                                        <div class="team-overlay">
                                            <blockquote>
                                                <p>"Incluso el todopoderoso Pointing no tiene control sobre los textos ciegos, es una vida casi inortográfica"</p>
                                            </blockquote>
                                        </div>
                                    </div>
                                    <div class="team-info">
                                        <h4 class="team-name">Tony Henderson</h4>
                                        <p class="team-position">Jefe de Operaciones</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Team Member 4 -->
                            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                                <div class="team-card">
                                    <div class="team-image">
                                        <div class="team-overlay">
                                            <blockquote>
                                                <p>"Incluso el todopoderoso Pointing no tiene control sobre los textos ciegos, es una vida casi inortográfica"</p>
                                            </blockquote>
                                        </div>
                                    </div>
                                    <div class="team-info">
                                        <h4 class="team-name">Jack Smith</h4>
                                        <p class="team-position">Arquitecto</p>
                                    </div>
                                </div>
                            </div>
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
                        <span class="section-subtitle text-white">Lee Testimonios</span>
                        <h2 class="text-white mb-4" style="font-size: 3rem; line-height: 1.2;">
                            Siempre es una alegría saber que el trabajo que hacemos tiene reseñas positivas
                        </h2>
                    </div>
                    <div class="col-lg-6" data-aos="fade-left">
                        <div class="testimonial-card">
                            <div class="testimonial-text">
                                "Lejos, muy lejos, detrás de las montañas de palabras, alejados de los países Vokalia y Consonantia, viven los textos ciegos. Separados viven en Bookmarksgrove justo en la costa de la Semántica, un gran océano de lenguaje."
                            </div>
                            <div class="testimonial-author">
                                <div class="testimonial-avatar"></div>
                                <div class="testimonial-info">
                                    <h5>Jeff Freshman</h5>
                                    <span>Cliente</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Quote Modal -->
        <div class="modal fade" id="quoteModal" tabindex="-1" aria-labelledby="quoteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="quoteModalLabel">Solicitar Cotización</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="quote-form">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" placeholder="Nombre" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" placeholder="Apellido" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <input type="tel" class="form-control" placeholder="Teléfono" required>
                            </div>
                            <div class="mb-3">
                                <select class="form-control" required>
                                    <option value="">Selecciona tu servicio</option>
                                    <option value="architecture">Arquitectura</option>
                                    <option value="renovation">Renovación</option>
                                    <option value="construction">Construcción</option>
                                    <option value="interior">Interior y Exterior</option>
                                    <option value="chemical">Investigación Química</option>
                                    <option value="petroleum">Petróleo y Gas</option>
                                    <option value="other">Otros Servicios</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" rows="4" placeholder="Mensaje" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-custom w-100">Solicitar Cotización</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

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
                                    <i class="fas fa-video fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">Video de demostración aquí</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Custom JS -->
    <script src="<?php echo get_template_directory_uri(); ?>/script.js"></script>
    <?php get_template_part('components/floating-buttons'); ?>
    <?php get_footer(); ?>
</body>