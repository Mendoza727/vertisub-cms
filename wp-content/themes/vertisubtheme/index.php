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
                        <div class="certification-item">
                            <img src="/placeholder.svg?height=80&width=120" alt="Certificación 1" class="cert-logo">
                        </div>
                        <div class="certification-item">
                            <img src="/placeholder.svg?height=80&width=120" alt="Certificación 2" class="cert-logo">
                        </div>
                        <div class="certification-item">
                            <img src="/placeholder.svg?height=80&width=120" alt="Certificación 3" class="cert-logo">
                        </div>
                        <div class="certification-item">
                            <img src="/placeholder.svg?height=80&width=120" alt="Certificación 4" class="cert-logo">
                        </div>
                        <div class="certification-item">
                            <img src="/placeholder.svg?height=80&width=120" alt="Certificación 5" class="cert-logo">
                        </div>
                        <div class="certification-item">
                            <img src="/placeholder.svg?height=80&width=120" alt="Certificación 6" class="cert-logo">
                        </div>
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
                            <div class="work-item" data-project="expovinos">
                                <div class="work-header">
                                    <div class="work-icon">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M2 17L12 22L22 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M2 12L12 17L22 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <h3 class="work-title">Lorem</h3>
                                    <div class="work-meta">
                                        <div class="collapse-icon">
                                            <span class="icon-plus">+</span>
                                            <span class="icon-minus">-</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="work-content">
                                    <p class="work-description">Desarrollo de estrategia integral para la exposición de vinos más importante del país, incluyendo branding, experiencia digital y activaciones presenciales.</p>
                                    <img src="/placeholder.svg?height=200&width=300" alt="Expovinos Project" class="work-image">
                                </div>
                            </div>

                            <div class="work-item" data-project="futbol">
                                <div class="work-header">
                                    <div class="work-icon">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" />
                                            <path d="M12 6V12L16 14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <h3 class="work-title">Lorem</h3>
                                    <div class="work-meta">
                                        <div class="collapse-icon">
                                            <span class="icon-plus">+</span>
                                            <span class="icon-minus">-</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="work-content">
                                    <p class="work-description">Campaña de comunicación para promover el fútbol amateur y semiprofesional, conectando comunidades a través del deporte.</p>
                                    <img src="/placeholder.svg?height=200&width=300" alt="Fútbol Project" class="work-image">
                                </div>
                            </div>

                            <div class="work-item" data-project="innovar">
                                <div class="work-header">
                                    <div class="work-icon">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9 12L11 14L15 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" />
                                        </svg>
                                    </div>
                                    <h3 class="work-title">Lorem</h3>
                                    <div class="work-meta">
                                        <div class="collapse-icon">
                                            <span class="icon-plus">+</span>
                                            <span class="icon-minus">-</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="work-content">
                                    <p class="work-description">Plataforma de innovación empresarial que conecta startups con grandes corporaciones para desarrollar soluciones disruptivas.</p>
                                    <img src="/placeholder.svg?height=200&width=300" alt="Innovar Project" class="work-image">
                                </div>
                            </div>

                            <div class="work-item" data-project="lorenzoneta">
                                <div class="work-header">
                                    <div class="work-icon">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M20.24 12.24C21.3658 11.1142 21.9983 9.58722 21.9983 7.99504C21.9983 6.40285 21.3658 4.87588 20.24 3.75004C19.1142 2.62419 17.5872 1.9917 15.995 1.9917C14.4028 1.9917 12.8758 2.62419 11.75 3.75004L5 10.5V19H13.5L20.24 12.24Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M16 8L2 22" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M17.5 15H9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <h3 class="work-title">LOREm</h3>
                                    <div class="work-meta">
                                        <div class="collapse-icon">
                                            <span class="icon-plus">+</span>
                                            <span class="icon-minus">-</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="work-content">
                                    <p class="work-description">Identidad visual y estrategia digital para marca de moda sostenible, enfocada en la producción local y materiales eco-friendly.</p>
                                    <img src="/placeholder.svg?height=200&width=300" alt="Lorenzoneta Project" class="work-image">
                                </div>
                            </div>
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