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
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">

    <?php wp_head(); ?>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            overflow-x: hidden;
        }

        /* Hero Section */
        .hero-section {
            height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 1;
        }

        .hero-content {
            text-align: center;
            color: white;
        }

        .hero-content h1 {
            font-size: 4rem;
            margin-bottom: 1rem;
            font-weight: 300;
        }

        .hero-content p {
            font-size: 1.2rem;
            opacity: 0.9;
        }

        /* About Section - VERDE para revelarse */
        .nosotros-section {
            height: 140vh;
            padding: 100px 0;
            position: relative;
            z-index: 5;
            /* Muy alto */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nosotros-section {
            text-align: center;
            color: white;
        }

        .nosotros-section p {
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* Círculo que cubre progresivamente - DEBE estar encima */
        .circle-shape {
            position: fixed;
            bottom: -50vh;
            /* Visible desde el inicio */
            left: 50%;
            width: 200vw;
            height: 200vw;
            background: #3498db;
            border-top: 8px solid #f39c12;
            border-radius: 50%;
            transform: translateX(-50%);
            z-index: 100;
            /* MUY ALTO para estar siempre encima */
            pointer-events: none;
        }

        /* Container para el contenido que se mantendrá fijo */
        .content-container {
            position: relative;
        }

        /* Media queries */
        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.5rem;
            }

            .slogan-content h2 {
                font-size: 2rem;
            }

            .about-content h2 {
                font-size: 2rem;
            }

            .circle-shape {
                width: 300vw;
                height: 300vw;
                bottom: -180vh;
            }
        }

        #carousel-certi {
            width: 100%;
            /* Ocupa todo el ancho disponible */
            max-width: 100vw;
            /* Nunca más ancho que la pantalla */
            margin: 0 auto;
            box-sizing: border-box;
            overflow: hidden;
            /* Oculta cualquier desbordamiento */
        }

        /* Contenedor interno del carrusel */
        #carousel-certi .carousel-track {
            display: flex;
            gap: 1rem;
            /* Ajusta el espacio entre elementos */
            flex-wrap: nowrap;
            /* No se debe romper línea */
            overflow-x: auto;
            /* Scroll horizontal si excede */
            scroll-behavior: smooth;
            /* Movimiento suave */
            padding-bottom: 1rem;
            /* Para que no toque el borde */
        }

        /* Cada elemento del carrusel */
        #carousel-certi .carousel-item {
            flex: 0 0 auto;
            /* Mantiene tamaño del item, no crece ni se encoge */
            width: 90%;
            /* Ajusta según lo que quieras mostrar */
            max-width: 300px;
            /* Limita tamaño máximo */
            box-sizing: border-box;
        }

        /* Para pantallas más pequeñas */
        @media (max-width: 768px) {
            #carousel-certi .carousel-item {
                width: 80%;
                max-width: 250px;
            }
        }

        /* Solo en móvil */
        @media (max-width: 767px) {
            .nosotros-section {
                height: 130vh;
                /* asegúrate que tape lo de abajo */
            }

            .certifications-carousel {
                margin-bottom: 10px;
            }
        }
    </style>
</head>

<body <?php body_class(); ?>>
    <?php get_header(); ?>

    <?php get_template_part('loader'); ?>

    <!-- Hero Section with Video -->
    <section id="hero" class="hero-section">
        <div class="hero-video-container">
            <video id="hero-video" class="hero-video" autoplay muted loop playsinline>
                <source src="<?php echo esc_url(get_theme_mod('hero_video_url')); ?>" type="video/mp4">

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
                            <span class="slogan-line"><?php echo esc_html(get_theme_mod('slogan_line1', 'Soluciones singulares a problemas')); ?></span>
                            <span class="slogan-line"><?php echo esc_html(get_theme_mod('slogan_line2', 'complejos en entornos de riesgo')); ?></span>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Círculo que cubre progresivamente -->
    <div class="circle-shape"></div>

    <!-- About Section - VERDE (se revelará) -->
    <section id="nosotros" class="nosotros-section section-1">
        <div class="about-content">

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

            <div id="carousel-certi">
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
            </div>
        </div>
    </section>

    <!-- Mission & Vision Section -->
    <section ction id="mision-vision" class="mission-vision-section mt-5 section-2">
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

            <!-- Information Cards -->
            <div class="row g-4 mb-5">
                <div class="col-lg-4 col-md-6">
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
                                <p><strong>NIT:</strong> <?php echo esc_html(get_theme_mod('legal_nit')); ?></p>
                                <p><strong>Razón Social:</strong> <?php echo esc_html(get_theme_mod('legal_razon')); ?></p>
                                <p><strong>Registro Mercantil:</strong> <?php echo esc_html(get_theme_mod('legal_registro')); ?></p>
                                <p><strong>Cámara de Comercio:</strong> <?php echo esc_html(get_theme_mod('legal_camara')); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Scripts -->
    <script src="https://unpkg.com/@studio-freight/lenis@latest/dist/lenis.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        // Lenis smooth scroll
        const lenis = new Lenis({
            duration: 1.2,
            easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
            direction: 'vertical',
            gestureDirection: 'vertical',
            smooth: true,
            mouseMultiplier: 1,
            smoothTouch: false,
            touchMultiplier: 2,
            infinite: false,
        });

        function raf(time) {
            lenis.raf(time);
            ScrollTrigger.update();
            requestAnimationFrame(raf);
        }
        requestAnimationFrame(raf);

        gsap.registerPlugin(ScrollTrigger);

        // Shape Pusher Animation - Cobertura VISUAL real
        function initShapePusher() {
            const shape = document.querySelector('.circle-shape');
            const sloganSection = document.querySelector('#slogan');
            const aboutSection = document.querySelector('#nosotros');

            if (!shape || !sloganSection || !aboutSection) return;

            // Crear clip-path dinámico para efecto de cobertura visual
            const maskDiv = document.createElement('div');
            maskDiv.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100vw;
                height: 100vh;
                background: var(--accent-color);
                z-index: 1;
                clip-path: circle(50vh at 50% 150vh);
                pointer-events: none;
            `;
            document.body.appendChild(maskDiv);

            // Animación del clip-path - cobertura progresiva suave
            let mm = gsap.matchMedia();

            mm.add({
                // Celulares pequeños y normales
                isMobile: "(max-width: 767px)",

                // Tablets en vertical y horizontal
                isTablet: "(min-width: 768px) and (max-width: 1023px)",

                // Laptops pequeñas (ej. MacBook Air de 13", algunas Windows chicas)
                isLaptop: "(min-width: 1024px) and (max-width: 1439px)",

                // Desktops grandes y pantallas retina (MacBook Pro 14/16, monitores externos, etc.)
                isDesktop: "(min-width: 1440px)"
            }, (context) => {
                let {
                    isMobile,
                    isTablet,
                    isLaptop,
                    isDesktop
                } = context.conditions;

                gsap.timeline({
                    scrollTrigger: {
                        trigger: aboutSection,
                        start: isMobile ?
                            "top 80%" // empieza más tarde en móviles
                            :
                            isTablet ?
                            "top bottom+=-35" // arranca antes en tablets
                            :
                            isLaptop ?
                            "top bottom+=-8" // laptops → ajustado
                            :
                            "top bottom+=-100", // desktop ancho
                        end: "top 10%",
                        scrub: 3,
                        ease: "power2.out",
                        onUpdate: (self) => {
                            const progress = self.progress;

                            // Radio y centro igual que antes
                            const radius = 50 + (progress * 120);
                            const centerY = 150 - (progress * 80);

                            maskDiv.style.clipPath = `circle(${radius}vh at 50% ${centerY}vh)`;
                            maskDiv.style.opacity = 1;
                        }
                    }
                });
            });


            // Remover el círculo original ya que usamos mask
            shape.style.display = 'none';
        }

        // Inicialización
        document.addEventListener('DOMContentLoaded', function() {
            initShapePusher();

            // Asegurar tamaño correcto del círculo
            const updateCircleSize = () => {
                const shape = document.querySelector('.circle-shape');
                if (shape) {
                    const vw = window.innerWidth;
                    const vh = window.innerHeight;
                    const size = Math.max(vw, vh) * 2.5;

                    shape.style.width = size + 'px';
                    shape.style.height = size + 'px';
                    shape.style.bottom = (-size * 0.35) + 'px'; // Visible parcialmente desde el inicio
                }
            };

            updateCircleSize();
            window.addEventListener('resize', updateCircleSize);
        });

        // configuramos pocisiones iniciales
        gsap.set('.section-2', {
            y: '100%'
        });
        // Animaciones de overlay
        gsap.to('.section-2', {
            y: '0%',
            ease: "none",
            scrollTrigger: {
                trigger: 'body',
                start: '0% top',
                end: '25% top',
                scrub: true,
            }
        });

        // Animación inicial
        gsap.fromTo('.section-1', {
            y: 50,
            opacity: 0
        }, {
            y: 0,
            opacity: 1,
            duration: 1.5,
            ease: "power2.out",
            delay: 0.5
        });

        AOS.init();

        // Contador animado
        const counters = document.querySelectorAll('.counter');
        counters.forEach(counter => {
            const updateCount = () => {
                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText;
                const increment = target / 200;

                if (count < target) {
                    counter.innerText = Math.ceil(count + increment);
                    setTimeout(updateCount, 20);
                } else {
                    counter.innerText = target;
                }
            };
            updateCount();
        });
    </script>

    <!-- Custom JS -->
    <script src="<?php echo get_template_directory_uri(); ?>/script.js"></script>

    <?php get_template_part('components/floating-buttons'); ?>

    <?php get_footer(); ?>
</body>

</html>