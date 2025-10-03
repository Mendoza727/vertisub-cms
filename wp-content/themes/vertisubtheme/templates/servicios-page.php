<?php
/*
Template Name: Servicios
*/
?>

<head>
    <?php wp_head(); ?>
    <title>Servicios</title>
    <style>
        .service-actions .whatsapp-btn {
            display: none;
        }
    </style>
</head>

<body <?php body_class(); ?>>
    <?php get_header(); ?>

    <?php get_template_part('loader'); ?>

    <main class="mt-5">
        <!-- Hero Section -->
        <section class="hero-about-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="hero-about-content" data-aos="fade-up">
                            <div class="breadcrumb-custom">
                                <a href="<?php echo esc_url(home_url('/')); ?>" class="me-2">Inicio <i class="fas fa-chevron-right ms-1"></i></a>
                                <span class="text-white">Servicios</span>
                            </div>
                            <?php
                            // Obtener todos los servicios de introducción publicados
                            $servicios = get_posts(array(
                                'post_type'      => 'servicios_intro',
                                'posts_per_page' => -1 // todos los servicios
                            ));

                            ?>
                            <h1 class="display-3 fw-bold text-white">Nuestros Servicios</h1>
                            <div class="intro-description text-white mt-3">
                                <?php if (!empty($servicios)) : ?>
                                    <?php foreach ($servicios as $servicio) : ?>
                                        <?php echo esc_html($servicio->post_content); ?>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <p>Próximamente agregaremos nuestros servicios.</p>
                                <?php endif; ?>
                            </div>

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

        <!-- About Section -->
        <section class="sancho-services-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto text-center mb-5" data-aos="fade-up">
                        <p class="lead text-muted">
                            Ofrecemos una amplia gama de servicios de construcción e ingeniería con la más alta calidad y profesionalismo. Cada proyecto es único y merece atención especializada.
                        </p>
                    </div>
                </div>

                <div class="services-grid" data-aos="fade-up" data-aos-delay="200">
                    <!-- Service 1 - Construcción -->

                    <?php
                    global $wpdb;

                    // 1️⃣ Obtener slug del país desde la URL
                    $current_url = home_url(add_query_arg(NULL, NULL));
                    $url_path = parse_url($current_url, PHP_URL_PATH);
                    $segments = explode('/', trim($url_path, '/'));
                    $pais_slug = strtolower(end($segments)); // último segmento

                    $whatsapp_query = new WP_Query(array(
                        'post_type'      => 'whatsapp_button',
                        'posts_per_page' => 1,
                        'orderby'        => 'date',
                        'order'          => 'DESC'
                    ));

                    $whatsapp_number = '';
                    if ($whatsapp_query->have_posts()) :
                        while ($whatsapp_query->have_posts()) : $whatsapp_query->the_post();
                            $whatsapp_number = get_post_meta(get_the_ID(), 'whatsapp_number', true);
                        endwhile;
                        wp_reset_postdata();
                    endif;

                    // 2️⃣ Obtener el ID del país según el slug
                    $pais_id = $wpdb->get_var($wpdb->prepare(
                        "SELECT post_id 
                        FROM $wpdb->postmeta 
                        WHERE meta_key = '_pais_slug' 
                          AND LOWER(meta_value) = %s 
                        LIMIT 1",
                        $pais_slug
                    ));

                    if ($pais_id) {
                        // Obtener el nombre del país
                        $pais_nombre = get_the_title($pais_id);

                        // 3️⃣ Query de servicios filtrando por país
                        $args = array(
                            'post_type'      => 'servicios',
                            'posts_per_page' => -1,
                            'orderby'        => 'date',
                            'order'          => 'DESC',
                            'meta_query'     => array(
                                array(
                                    'key'     => '_servicio_paises',  // ACF o campo serializado que guarda IDs de países
                                    'value'   => '"' . $pais_id . '"',
                                    'compare' => 'LIKE'
                                )
                            )
                        );

                        $servicios = new WP_Query($args);

                        if ($servicios->have_posts()) :
                            while ($servicios->have_posts()) : $servicios->the_post();
                                $servicio_id = get_the_ID();

                                // Descripción
                                $descripcion_corta = wp_trim_words(get_the_content(), 25, '...');
                                $descripcion_full  = apply_filters('the_content', get_the_content());
                                $service_name = get_the_title($servicio_id);

                                // Multimedia
                                $imagenes   = get_post_meta($servicio_id, '_imagenes_reseña', true);
                                $videos     = get_post_meta($servicio_id, '_videos_reseña', true);
                                $video_urls = get_post_meta($servicio_id, '_video_urls_reseña', true);

                                if (!is_array($imagenes)) $imagenes = [];
                                if (!is_array($videos)) $videos = [];
                                if (!is_array($video_urls)) $video_urls = [];
                    ?>
                                <!-- Service Card -->
                                <div class="service-card" data-service="<?php echo esc_attr($servicio_id); ?>">
                                    <div class="service-image">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php
                                            // Get the post thumbnail URL
                                            $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                                            ?>
                                            <img src="<?php echo esc_url($thumb_url); ?>" style="width: 110%; height: 190%; margin-top: -140px;" alt="<?php the_title_attribute(); ?>">
                                        <?php endif; ?>

                                    </div>

                                    <div class="service-content">
                                        <h3 class="service-title"><?php echo esc_html($service_name) ?></h3>
                                        <p class="service-description"><?php echo esc_html($descripcion_corta); ?></p>

                                        <div class="service-details">
                                            <div class="service-expanded-text">
                                                <?php echo $descripcion_full; ?>
                                            </div>

                                            <?php if (!empty($imagenes) || !empty($videos) || !empty($video_urls)) : ?>
                                                <div class="service-media-grid">
                                                    <?php foreach ($imagenes as $img): ?>
                                                        <div class="service-media-item">
                                                            <img src="<?php echo esc_url($img); ?>" alt="">
                                                        </div>
                                                    <?php endforeach; ?>

                                                    <?php foreach ($videos as $vid): ?>
                                                        <div class="service-media-item">
                                                            <video controls width="100%">
                                                                <source src="<?php echo esc_url($vid); ?>" type="video/mp4">
                                                                Your browser does not support the video tag.
                                                            </video>
                                                        </div>
                                                    <?php endforeach; ?>

                                                    <?php foreach ($video_urls as $url): ?>
                                                        <div class="service-media-item">
                                                            <iframe width="100%" height="315" src="<?php echo esc_url($url); ?>" frameborder="0" allowfullscreen></iframe>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="service-actions">
                                            <button class="btn btn-service expand-btn">
                                                <i class="fas fa-info-circle"></i> Ver Más Info
                                            </button>
                                        </div>

                                        <?php if (!empty($whatsapp_number)) : ?>
                                            <?php
                                            $message = urlencode("Deseo conocer más información acerca del servicio $service_name");
                                            $whatsapp_url = "https://wa.me/" . preg_replace('/\D/', '', $whatsapp_number) . "?text=$message";
                                            ?>
                                            <div class="service-actions">
                                                <a href="<?php echo esc_url($whatsapp_url); ?>" target="_blank" class="btn btn-service whatsapp-btn">
                                                    <i class="fab fa-whatsapp"></i> Contáctanos para conocer más
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <button class="service-close">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                    <?php
                            endwhile;
                            wp_reset_postdata();
                        else :
                            echo '<p>No hay servicios disponibles para este país.</p>';
                        endif;
                    } else {
                        echo '<p>No se encontró el país con slug: ' . esc_html($pais_slug) . '</p>';
                    }
                    ?>

                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section class="sancho-contact-section d-none">
            <div class="container">
                <!-- Contact Info -->
                <div class="row mb-5">
                    <div class="col-lg-8 mx-auto text-center" data-aos="fade-up">
                        <span class="section-subtitle">Contáctanos</span>
                        <h2 class="section-title">Información de Contacto</h2>
                        <p class="lead text-muted mb-5">
                            Estamos listos para hacer realidad tu proyecto. Contáctanos para recibir asesoramiento personalizado y una cotización detallada.
                        </p>
                    </div>
                </div>

                <?php
                global $wpdb;

                // 1️⃣ Obtener slug del país desde la URL
                $current_url = home_url(add_query_arg(NULL, NULL));
                $url_path = parse_url($current_url, PHP_URL_PATH);
                $segments = explode('/', trim($url_path, '/'));
                $pais_slug = strtolower(end($segments)); // último segmento

                // 2️⃣ Obtener el ID del país según el slug
                $pais_id = $wpdb->get_var($wpdb->prepare(
                    "SELECT post_id 
     FROM $wpdb->postmeta 
     WHERE meta_key = '_pais_slug' 
       AND LOWER(meta_value) = %s 
     LIMIT 1",
                    $pais_slug
                ));

                if ($pais_id) {
                    // Obtener los datos del país
                    $telefonos = get_post_meta($pais_id, '_telefonos', true);
                    $telefonos = is_array($telefonos) ? $telefonos : [];

                    $correos = get_post_meta($pais_id, '_correos', true);
                    $correos = is_array($correos) ? $correos : [];

                    $direccion = get_post_meta($pais_id, '_direccion', true);
                    $contacto = get_post_meta($pais_id, '_contacto', true);
                ?>
                    <div class="row g-4 mb-5">
                        <!-- Contact Info Cards -->
                        <?php if (!empty($telefonos)) : ?>
                            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                                <div class="contact-info-card">
                                    <div class="contact-icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div class="contact-info">
                                        <h4>Teléfono</h4>
                                        <p class="text-muted mb-2">Llamanos directamente</p>
                                        <?php foreach ($telefonos as $tel) : ?>
                                            <a href="tel:<?= esc_attr($tel) ?>" class="contact-link"><?= esc_html($tel) ?></a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($correos)) : ?>
                            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                                <div class="contact-info-card">
                                    <div class="contact-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="contact-info">
                                        <h4>Email</h4>
                                        <p class="text-muted mb-2">Escríbenos un mensaje</p>
                                        <?php foreach ($correos as $mail) : ?>
                                            <a href="mailto:<?= esc_attr($mail) ?>" class="contact-link"><?= esc_html($mail) ?></a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($direccion)) : ?>
                            <div class="col-lg-4 col-md-12" data-aos="fade-up" data-aos-delay="300">
                                <div class="contact-info-card">
                                    <div class="contact-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="contact-info">
                                        <h4>Ubicación</h4>
                                        <p class="text-muted mb-2">Visítanos en nuestra oficina</p>
                                        <p class="contact-address">
                                            <?= nl2br(esc_html($direccion)) ?><br>
                                            <?php if (!empty($contacto)) : ?>
                                                <span class="text-muted"><?= esc_html($contacto) ?></span>
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php
                } else {
                    echo "<p>Información del país no encontrada.</p>";
                }
                ?>

                <!-- Contact Form -->
                <div class="row justify-content-center">
                    <div class="col-lg-8" data-aos="fade-up" data-aos-delay="400">
                        <div class="contact-form-wrapper">
                            <div class="contact-form-header">
                                <h3>¿Tienes un proyecto en mente?</h3>
                                <p class="text-muted">Completa el formulario y nos pondremos en contacto contigo en menos de 24 horas.</p>
                            </div>

                            <form class="contact-form" id="contactForm">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="contactName" name="name" placeholder="Tu nombre completo" required>
                                            <label for="contactName">Nombre Completo *</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="tel" class="form-control" id="contactPhone" name="phone" placeholder="Tu número de teléfono" required>
                                            <label for="contactPhone">Número de Teléfono *</label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" id="contactEmail" name="email" placeholder="Tu correo electrónico" required>
                                            <label for="contactEmail">Correo Electrónico *</label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea class="form-control" id="contactMessage" name="message" placeholder="Cuéntanos sobre tu proyecto" style="height: 120px" required></textarea>
                                            <label for="contactMessage">Mensaje *</label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" id="contactPrivacy" name="privacy" required>
                                            <label class="form-check-label" for="contactPrivacy">
                                                Acepto el tratamiento de mis datos personales de acuerdo con la<a href="<?php echo home_url('/politica-datos-personales-vertisub/'); ?>"> Política de Datos</a> *
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-contact">
                                            <i class="fas fa-paper-plane me-2"></i>
                                            Enviar Mensaje
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <div class="form-success-message" id="successMessage">
                                <div class="success-icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <h4>¡Mensaje Enviado!</h4>
                                <p>Gracias por contactarnos. Nos pondremos en contacto contigo muy pronto.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            easing: 'ease-out-cubic',
            once: true,
            offset: 50
        });

        // Loader
        window.addEventListener('load', function() {
            setTimeout(() => {
                document.getElementById('loader').style.opacity = '0';
                setTimeout(() => {
                    document.getElementById('loader').style.display = 'none';
                }, 500);
            }, 1000);
        });

        // Services expansion functionality
        function initServicesExpansion() {
            const serviceCards = document.querySelectorAll('.service-card');

            serviceCards.forEach(card => {
                const expandBtn = card.querySelector('.expand-btn');
                const closeBtn = card.querySelector('.service-close');
                const whatsappBtn = card.querySelector('.whatsapp-btn');

                // Expand service card
                expandBtn.addEventListener('click', (e) => {
                    e.stopPropagation();

                    // Close any other expanded cards first
                    serviceCards.forEach(otherCard => {
                        if (otherCard !== card) {
                            otherCard.classList.remove('expanded', 'expanding');
                            const otherExpandBtn = otherCard.querySelector('.expand-btn');
                            const otherWhatsappBtn = otherCard.querySelector('.whatsapp-btn');
                            if (otherExpandBtn) otherExpandBtn.style.display = "inline-block";
                            if (otherWhatsappBtn) otherWhatsappBtn.style.display = "none";
                        }
                    });

                    // Expand current card
                    card.classList.add('expanding');
                    setTimeout(() => {
                        card.classList.add('expanded');
                        card.classList.remove('expanding');

                        // Scroll to the expanded card
                        card.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    }, 100);

                    // Toggle buttons
                    expandBtn.style.display = "none";
                    if (whatsappBtn) whatsappBtn.style.display = "inline-block";
                });

                // Close service card
                closeBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    card.classList.remove('expanded');

                    // Reset buttons
                    expandBtn.style.display = "inline-block";
                    if (whatsappBtn) whatsappBtn.style.display = "none";
                });

                // Close on outside click
                document.addEventListener('click', (e) => {
                    if (card.classList.contains('expanded') && !card.contains(e.target)) {
                        card.classList.remove('expanded');
                        expandBtn.style.display = "inline-block";
                        if (whatsappBtn) whatsappBtn.style.display = "none";
                    }
                });
            });
        }

        // Service cards animation on scroll
        function initServiceCardsAnimation() {
            const serviceCards = document.querySelectorAll('.service-card');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateY(0)';
                        }, index * 100);
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1
            });

            serviceCards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });
        }

        // Service counter animation
        function animateServiceCounters() {
            const serviceStats = document.querySelectorAll('.service-stat-number');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const counter = entry.target;
                        const text = counter.textContent;
                        const hasPlus = text.includes('+');
                        const hasPercent = text.includes('%');
                        const hasSlash = text.includes('/');

                        if (hasSlash) {
                            // For "24/7" type counters
                            counter.style.opacity = '1';
                            return;
                        }

                        const target = parseInt(text.replace(/[+%]/g, ''));
                        if (isNaN(target)) return;

                        const duration = 2000;
                        const step = target / (duration / 16);
                        let current = 0;

                        const updateCounter = () => {
                            if (current < target) {
                                current += step;
                                let displayValue = Math.floor(current);
                                if (hasPlus) displayValue += '+';
                                if (hasPercent) displayValue += '%';
                                counter.textContent = displayValue;
                                requestAnimationFrame(updateCounter);
                            } else {
                                counter.textContent = text;
                            }
                        };

                        updateCounter();
                        observer.unobserve(counter);
                    }
                });
            }, {
                threshold: 0.5
            });

            serviceStats.forEach(counter => {
                counter.style.opacity = '0.3';
                observer.observe(counter);
            });
        }

        // Video modal functionality
        function openVideoModal(videoId) {
            // Create modal HTML
            const modalHTML = `
                <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="videoModalLabel">Video Demostrativo</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-0">
                                <div class="ratio ratio-16x9">
                                    <div class="d-flex align-items-center justify-content-center bg-dark text-white">
                                        <div class="text-center">
                                            <i class="fas fa-video fa-4x mb-3 text-muted"></i>
                                            <h4>Video: ${videoId}</h4>
                                            <p class="text-muted">Aquí se reproduciría el video correspondiente</p>
                                            <small class="text-muted">ID del video: ${videoId}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            // Remove existing modal if any
            const existingModal = document.getElementById('videoModal');
            if (existingModal) {
                existingModal.remove();
            }

            // Add modal to body
            document.body.insertAdjacentHTML('beforeend', modalHTML);

            // Show modal
            const modal = new bootstrap.Modal(document.getElementById('videoModal'));
            modal.show();

            // Remove modal from DOM when hidden
            document.getElementById('videoModal').addEventListener('hidden.bs.modal', function() {
                this.remove();
            });
        }

        // Smooth scrolling for anchor links
        function initSmoothScrolling() {
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        }

        // Mouse cursor effect
        function initCursorEffect() {
            const cursor = document.createElement('div');
            cursor.style.cssText = `
                position: fixed;
                width: 20px;
                height: 20px;
                background: var(--accent-color);
                border-radius: 50%;
                pointer-events: none;
                z-index: 9999;
                transition: transform 0.1s ease;
                opacity: 0;
            `;
            document.body.appendChild(cursor);

            document.addEventListener('mousemove', (e) => {
                cursor.style.left = e.clientX - 10 + 'px';
                cursor.style.top = e.clientY - 10 + 'px';
                cursor.style.opacity = '0.5';
            });

            document.addEventListener('mouseleave', () => {
                cursor.style.opacity = '0';
            });

            // Scale cursor on hover
            document.querySelectorAll('button, a, .service-card, .service-media-video').forEach(el => {
                el.addEventListener('mouseenter', () => {
                    cursor.style.transform = 'scale(2)';
                });
                el.addEventListener('mouseleave', () => {
                    cursor.style.transform = 'scale(1)';
                });
            });
        }

        // Add scroll indicator
        function addScrollIndicator() {
            const indicator = document.createElement('div');
            indicator.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 0%;
                height: 4px;
                background: linear-gradient(90deg, var(--accent-color), var(--accent-tertiary));
                z-index: 9998;
                transition: width 0.1s ease;
            `;
            document.body.appendChild(indicator);

            window.addEventListener('scroll', () => {
                const scrollPercent = (window.scrollY / (document.documentElement.scrollHeight - window.innerHeight)) * 100;
                indicator.style.width = scrollPercent + '%';
            });
        }

        // Image lazy loading
        function initLazyLoading() {
            const images = document.querySelectorAll('.service-media-image[style*="background-image"]');

            const imageObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.style.opacity = '1';
                        imageObserver.unobserve(img);
                    }
                });
            });

            images.forEach(img => {
                img.style.opacity = '0.3';
                img.style.transition = 'opacity 0.6s ease';
                imageObserver.observe(img);
            });
        }

        // Initialize everything when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            initServicesExpansion();
            initServiceCardsAnimation();
            animateServiceCounters();
            initSmoothScrolling();
            initCursorEffect();
            addScrollIndicator();
            initLazyLoading();
        });

        // Add some interactive hover effects
        document.addEventListener('DOMContentLoaded', function() {
            // Add hover effect to service features
            const serviceFeatures = document.querySelectorAll('.service-feature');
            serviceFeatures.forEach(feature => {
                feature.addEventListener('mouseenter', function() {
                    this.style.background = 'rgba(187,12,43,0.1)';
                });

                feature.addEventListener('mouseleave', function() {
                    this.style.background = 'rgba(227,197,202,0.1)';
                });
            });

            // Add interactive effect to service stats
            const serviceStats = document.querySelectorAll('.service-stat');
            serviceStats.forEach(stat => {
                stat.addEventListener('mouseenter', function() {
                    this.style.background = 'rgba(255,255,255,0.9)';
                });

                stat.addEventListener('mouseleave', function() {
                    this.style.background = 'var(--text-light)';
                });
            });
        });
    </script>
    <?php get_template_part('components/floating-buttons'); ?>
    <?php get_footer(); ?>
</body>