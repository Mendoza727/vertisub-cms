<?php
/*
Template Name: Formaciones
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
        <section class="sancho-services-section mt-5">
            <div class="container pt-5">
                <?php $courses_data =  vertisub_get_acf_field('formaciones') ?>
                <?php if ($courses_data) : ?>
                    <div class="row">
                        <div class="col-lg-8 mx-auto text-center" data-aos="fade-up">
                            <?php if ($courses_data['subtitulo']) : ?>
                                <span class="section-subtitle"><?= $courses_data['subtitulo']; ?></span>
                            <?php endif; ?>

                            <?php if ($courses_data['titulo']) : ?>
                                <h2 class="section-title"><?= $courses_data['titulo']; ?></h2>
                            <?php endif; ?>

                            <?php if ($courses_data['descripcion']) : ?>
                                <p class="lead text-muted"><?= $courses_data['descripcion']; ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <section class="certifications-section">
                    <div class="container">
                        <!-- Header -->
                        <div class="section-header" data-aos="fade-up">

                        </div>

                        <!-- Certifications Grid -->
                        <div class="certifications-grid" id="certificationsGrid">

                            <!-- certification dinamic -->
                            <?php
                            $args = array(
                                'post_type'      => 'cursos', // tu CPT
                                'posts_per_page' => -1,
                                'post_status'    => 'publish'
                            );
                            $cursos = new WP_Query($args);
                            if ($cursos->have_posts()):
                                while ($cursos->have_posts()): $cursos->the_post();
                                    // ID del curso actual
                                    $curso_id = get_the_ID();

                                    // Campos personalizados
                                    $imagenes       = get_post_meta($curso_id, '_curso_imagenes', true) ?: [];
                                    $modalidades    = get_post_meta($curso_id, '_curso_modalidades', true) ?: [];
                                    $temario        = get_post_meta($curso_id, '_curso_temario', true) ?: [];
                                    $url_inscribir  = get_post_meta($curso_id, '_curso_url_inscribir', true);
                                    $url_info       = get_post_meta($curso_id, '_curso_url_info', true);
                                    $url_plataforma = get_post_meta($curso_id, '_curso_url_plataforma', true);
                                    $url_oficial    = get_post_meta($curso_id, '_curso_url_oficial', true);
                                    $instructores   = get_post_meta($curso_id, '_curso_instructores', true) ?: [];
                                    $paises         = get_post_meta($curso_id, '_curso_paises', true) ?: [];
                                    $paises_urls    = get_post_meta($curso_id, '_curso_paises_urls', true) ?: [];
                                    $convenios_personalizados = get_post_meta($curso_id, '_curso_convenios_personalizados', true);
                            ?>

                                    <div class="certification-card" data-aos="fade-up" data-aos-delay="100">
                                        <button class="close-btn" onclick="closeCertification(this)">
                                            <i class="fas fa-times"></i>
                                        </button>

                                        <div class="cert-image"
                                            style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url($curso_id, 'large')); ?>')">
                                        </div>

                                        <div class="cert-content">
                                            <h3 class="cert-title"><?php the_title(); ?></h3>

                                            <button class="btn-expand" onclick="expandCertification(this)">
                                                <i class="fas fa-plus me-2"></i>Conoce Más
                                            </button>
                                        </div>

                                        <div class="expanded-content">
                                            <p class="cert-description">
                                                <?php the_content(); ?>
                                            </p>

                                            <!-- modalidades -->
                                            <?php
                                            if (!empty($modalidades)) : ?>
                                                <div class="content-section">
                                                    <h3><i class="fas fa-graduation-cap me-2"></i>Modalidades del curso</h3>
                                                    <div class="modalidades-list">
                                                        <?php foreach ($modalidades as $mod) :
                                                            // Opcional: definir icono según modalidad
                                                            $icon = 'fas fa-laptop'; // default
                                                            $mod_lower = strtolower($mod);
                                                            if (strpos($mod_lower, 'presencial') !== false) {
                                                                $icon = 'fas fa-users';
                                                            } elseif (strpos($mod_lower, 'híbrido') !== false || strpos($mod_lower, 'hibrido') !== false) {
                                                                $icon = 'fas fa-sync-alt';
                                                            }
                                                        ?>
                                                            <div class="modalidad-item">
                                                                <div class="modalidad-icon">
                                                                    <i class="<?php echo esc_attr($icon); ?>"></i>
                                                                </div>
                                                                <h4><?php echo esc_html($mod); ?></h4>
                                                                <!-- Si quieres, puedes agregar descripción aquí si la guardas en otro post_meta -->
                                                                <!-- <p>Descripción opcional</p> -->
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            <?php endif; ?>

                                            <!-- intro video -->
                                            <?php
                                            if (!empty($intro_video)) : ?>
                                                <div class="content-section">
                                                    <h3><i class="fas fa-play-circle me-2"></i>Video de Introducción</h3>
                                                    <div class="video-container">
                                                        <div class="video-placeholder" onclick="openVideoModal('<?php echo esc_url($intro_video); ?>')">
                                                            <div class="play-button">
                                                                <i class="fas fa-play"></i>
                                                            </div>
                                                        </div>
                                                        <p class="text-light mt-2">Conoce todo sobre este programa de certificación</p>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <!-- Testimonios -->
                                            <div class="content-section" style="display: none;">
                                                <h3><i class="fas fa-quote-left me-2"></i>Videos de Testimonios</h3>
                                                <?php if (!empty($testimonios)) : ?>
                                                    <div id="testimoniosCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                                        <div class="carousel-inner">
                                                            <?php foreach ($testimonios as $index => $video_url) :
                                                                $active = $index === 0 ? 'active' : '';
                                                            ?>
                                                                <div class="carousel-item <?php echo $active; ?>">
                                                                    <div class="testimonio-video-only">
                                                                        <div class="video-container-inline" style="position:relative;width:100%;padding-bottom:56.25%;height:0;">
                                                                            <?php

                                                                            // Detectar YouTube y generar iframe
                                                                            if (preg_match('/(?:youtu\.be\/|youtube\.com\/watch\?v=)([^\?&]+)/', $video_url, $matches)) {
                                                                                $embed_url = 'https://www.youtube.com/embed/' . $matches[1] . '?rel=0';
                                                                                echo '<iframe src="' . esc_url($embed_url) . '" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                                                                            } else {
                                                                                // Video directo											
                                                                                echo '<video class="testimonio-video" controls preload="metadata" style="position:absolute;top:0;left:0;width:100%;height:100%;">';
                                                                                echo '<source src="' . esc_url($video_url) . '" type="video/mp4">';
                                                                                echo 'Tu navegador no soporta el elemento video.';
                                                                                echo '</video>';
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                        <button class="carousel-control-prev" type="button" data-bs-target="#testimoniosCarousel" data-bs-slide="prev" aria-label="Previous">
                                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                            <span class="visually-hidden">Anterior</span>
                                                        </button>
                                                        <button class="carousel-control-next" type="button" data-bs-target="#testimoniosCarousel" data-bs-slide="next" aria-label="Next">
                                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                            <span class="visually-hidden">Siguiente</span>
                                                        </button>
                                                    </div>
                                                <?php else : ?>
                                                    <p>No hay testimonios disponibles.</p>
                                                <?php endif; ?>
                                            </div>

                                            <!-- Temario -->
                                            <div class="content-section">
                                                <h3><i class="fas fa-list-ul me-2"></i>Nivel de capacitación</h3>
                                                <?php if (!empty($temario)) :
                                                    $total = count($temario);
                                                    $half  = ceil($total / 2);
                                                    $first_column  = array_slice($temario, 0, $half);
                                                    $second_column = array_slice($temario, $half);
                                                ?>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <ul class="list-unstyled">
                                                                <?php foreach ($first_column as $item) : ?>
                                                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i><?php echo esc_html($item); ?></li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <ul class="list-unstyled">
                                                                <?php foreach ($second_column as $item) : ?>
                                                                    <li class="mb-2"><i class="fas fa-check text-success me-2"></i><?php echo esc_html($item); ?></li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                <?php else : ?>
                                                    <p>No hay temario disponible para este curso.</p>
                                                <?php endif; ?>
                                            </div>

                                            <!-- Imágenes del Curso -->
                                            <div class="content-section" style="display: none;">
                                                <h3><i class="fas fa-images me-2"></i>Imágenes del Curso</h3>
                                                <?php if (!empty($imagenes)) : ?>
                                                    <div id="imagenesCarousel" class="carousel slide" data-bs-ride="carousel">
                                                        <div class="carousel-inner">
                                                            <?php foreach ($imagenes as $index => $img_id) :
                                                                $img_url = wp_get_attachment_url($img_id);
                                                                $active_class = ($index === 0) ? 'active' : '';
                                                            ?>
                                                                <div class="carousel-item <?php echo $active_class; ?>">
                                                                    <div class="curso-imagen-card">
                                                                        <img src="<?php echo esc_url($img_url); ?>"
                                                                            alt="<?php the_title(); ?>" class="curso-imagen">
                                                                        <div class="imagen-overlay">
                                                                            <h5><?php the_title(); ?></h5>
                                                                            <p><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                        <button class="carousel-control-prev" type="button" data-bs-target="#imagenesCarousel" data-bs-slide="prev">
                                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                            <span class="visually-hidden">Anterior</span>
                                                        </button>
                                                        <button class="carousel-control-next" type="button" data-bs-target="#imagenesCarousel" data-bs-slide="next">
                                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                            <span class="visually-hidden">Siguiente</span>
                                                        </button>
                                                    </div>
                                                <?php else : ?>
                                                    <p>No hay imágenes disponibles para este curso.</p>
                                                <?php endif; ?>
                                            </div>


                                            <!-- Action Section -->
                                            <div class="action-section">
                                                <h3>¿Listo para ser un experto en seguridad?</h3>
                                                <div class="action-buttons">
                                                    <a href="<?php echo esc_url($url_inscribir); ?>" class="btn-action btn-primary-action" target="_blank">
                                                        <i class="fas fa-user-plus me-2"></i>Inscríbete al Curso
                                                    </a>
                                                    <a href="<?php echo esc_url($url_info); ?>" class="btn-action btn-secondary-action" target="_blank">
                                                        <i class="fas fa-info-circle me-2"></i>Necesito más información del curso
                                                    </a>
                                                </div>
                                            </div>

                                            <!-- footer links -->
                                            <div class="footer-links">
                                                <h4 class="mb-3">Accede a nuestras plataformas</h4>
                                                <div class="links-grid">
                                                    <div class="link-card">
                                                        <i class="fas fa-graduation-cap link-icon"></i>
                                                        <h5>Plataforma de Aprendizaje</h5>
                                                        <p>Accede a todos tus cursos y certificaciones</p>
                                                        <a href="<?php echo esc_url($url_plataforma); ?>" class="btn-action btn-secondary-action mt-2" target="_blank">
                                                            Ir a la Plataforma
                                                        </a>
                                                    </div>
                                                    <div class="link-card">
                                                        <i class="fas fa-globe link-icon"></i>
                                                        <h5>Página Oficial</h5>
                                                        <p>Conoce todos nuestros programas educativos</p>
                                                        <a href="<?php echo esc_url($url_oficial); ?>" class="btn-action btn-secondary-action mt-2" target="_blank">
                                                            Visitar Sitio
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            <?php endwhile;
                                wp_reset_postdata();
                            endif; ?>
                        </div>
                    </div>
                </section>

                <!-- Video Modal -->
                <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="videoModalLabel">Video</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: white; opacity: 1;">
                                    <i class="fas fa-times" style="color: #000;"></i>
                                </button>
                            </div>
                            <div class="modal-body p-0">
                                <div id="videoContainer" style="width:100%; height:400px; display:flex; align-items:center; justify-content:center;">
                                    <!-- El video se insertará aquí dinámicamente -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
    <!-- Custom JS -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true
        });

        // Expand certification
        function expandCertification(button) {
            const card = button.closest('.certification-card');
            const allCards = document.querySelectorAll('.certification-card');

            // Check if card is already expanded
            if (card.classList.contains('expanded')) {
                // If expanded, close it
                card.classList.remove('expanded');
                button.innerHTML = '<i class="fas fa-plus me-2"></i>Conoce Más';
                return;
            }

            // Close all other cards
            allCards.forEach(otherCard => {
                if (otherCard !== card) {
                    otherCard.classList.remove('expanded');
                    const otherExpandBtn = otherCard.querySelector('.btn-expand');
                    if (otherExpandBtn) {
                        otherExpandBtn.innerHTML = '<i class="fas fa-plus me-2"></i>Conoce Más';
                    }
                }
            });

            // Expand current card
            card.classList.add('expanded');

            // Update button text
            button.innerHTML = '<i class="fas fa-minus me-2"></i>Ver Menos';

            // Scroll to top of card
            setTimeout(() => {
                card.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }, 300);
        }

        // Close certification
        function closeCertification(button) {
            const card = button.closest('.certification-card');
            card.classList.remove('expanded');

            // Reset expand button text
            const expandBtn = card.querySelector('.btn-expand');
            if (expandBtn) {
                expandBtn.innerHTML = '<i class="fas fa-plus me-2"></i>Conoce Más';
            }
        }

        // Open video modal (prevent event bubbling)
        // Open video modal (works for YouTube links and direct video files)
        function openVideoModal(videoUrl) {
            event.stopPropagation(); // Prevent triggering parent click events
            const modal = new bootstrap.Modal(document.getElementById('videoModal'));
            const container = document.getElementById('videoContainer');
            container.innerHTML = ''; // Limpiar contenido previo

            let embedUrl = '';

            // Detectar YouTube: puede ser youtu.be o youtube.com/watch
            const youtubeRegex = /(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/watch\?v=|youtu\.be\/)([^\?&]+)/;
            const youtubeMatch = videoUrl.match(youtubeRegex);

            if (youtubeMatch && youtubeMatch[1]) {
                embedUrl = 'https://www.youtube.com/embed/' + youtubeMatch[1] + '?autoplay=1&rel=0';
                const iframe = document.createElement('iframe');
                iframe.src = embedUrl;
                iframe.width = '100%';
                iframe.height = '100%';
                iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture';
                iframe.allowFullscreen = true;
                iframe.frameBorder = 0;
                container.appendChild(iframe);
            } else {
                // Video directo (mp4, webm, etc.)
                const video = document.createElement('video');
                video.src = videoUrl;
                video.controls = true;
                video.autoplay = true;
                video.style.width = '100%';
                video.style.height = '100%';
                container.appendChild(video);
            }

            modal.show();
        }

        // Limpiar video al cerrar el modal
        document.getElementById('videoModal').addEventListener('hidden.bs.modal', function() {
            document.getElementById('videoContainer').innerHTML = '';
        });

        // Update country info
        function updateCountryInfo(paisId) {
            const select = document.querySelector('.country-select select');
            const selectedOption = select.options[select.selectedIndex];
            const url = selectedOption.getAttribute('data-url');

            const countryInfo = document.getElementById('countryInfo2');
            const countryLink = document.getElementById('countryLink');

            if (paisId && url && url !== '#') {
                countryLink.href = url;
                countryInfo.style.display = 'block';
            } else {
                countryInfo.style.display = 'none';
                countryLink.href = '#';
            }
        }

        // Handle contact form
        function handleContactForm(event) {
            event.preventDefault();
            event.stopPropagation(); // Prevent event bubbling
            const email = event.target.querySelector('input[type="email"]').value;
            alert('Gracias por tu interés! Nos contactaremos contigo pronto a: ' + email);
            event.target.reset();
        }

        // Close expanded cards when clicking outside (but not on modal)
        document.addEventListener('click', function(e) {
            // Don't close if clicking on modal or modal content
            if (e.target.closest('.modal') || e.target.closest('[data-bs-dismiss="modal"]')) {
                return;
            }

            // Don't close if clicking inside a certification card or on expand button
            if (!e.target.closest('.certification-card') && !e.target.closest('.btn-expand')) {
                document.querySelectorAll('.certification-card.expanded').forEach(card => {
                    card.classList.remove('expanded');
                    const expandBtn = card.querySelector('.btn-expand');
                    if (expandBtn) {
                        expandBtn.innerHTML = '<i class="fas fa-plus me-2"></i>Conoce Más';
                    }
                });
            }
        });

        // Handle action buttons with event stopping
        document.addEventListener('click', function(e) {
            // Only trigger if it's actually a button with the specific text
            if (e.target.tagName === 'BUTTON' && e.target.classList.contains('btn-action')) {
                const buttonText = e.target.textContent.trim();

                if (buttonText.includes('Inscríbete al Curso')) {
                    e.stopPropagation();
                    alert('Redirigiendo al formulario de inscripción...');
                } else if (buttonText.includes('Necesito más información')) {
                    e.stopPropagation();
                    alert('Te enviaremos información detallada a tu email.');
                } else if (buttonText.includes('Hablar con un Experto')) {
                    e.stopPropagation();
                    alert('Conectando con un asesor académico...');
                } else if (buttonText.includes('Ver Sedes')) {
                    e.stopPropagation();
                    alert('Mostrando sedes disponibles en el país seleccionado...');
                }
            }
        });

        // Handle video elements with proper event stopping
        document.addEventListener('click', function(e) {
            // Handle instructor photos - only if clicking directly on the photo
            if (e.target.closest('.instructor-photo') && !e.target.closest('.btn-action')) {
                e.stopPropagation();
                const photo = e.target.closest('.instructor-photo');
                const instructorName = photo.parentElement.querySelector('h5').textContent;
                openVideoModal('presentacion-' + instructorName.toLowerCase().replace(' ', '-'));
                return;
            }

            // Handle testimonio cards - only if clicking directly on the card
            if (e.target.closest('.testimonio-card') && !e.target.closest('.btn-action')) {
                e.stopPropagation();
                const testimonioCard = e.target.closest('.testimonio-card');
                const studentName = testimonioCard.querySelector('h5').textContent;
                openVideoModal('testimonio-' + studentName.toLowerCase().replace(' ', '-'));
                return;
            }

            // Handle video placeholders - only if clicking directly on the placeholder
            if (e.target.closest('.video-placeholder') && !e.target.closest('.btn-action')) {
                e.stopPropagation();
                openVideoModal('introduccion-curso');
                return;
            }
        });

        // Prevent modal close from affecting expanded cards
        document.getElementById('videoModal').addEventListener('hide.bs.modal', function(event) {
            event.stopPropagation(); // Prevent this event from bubbling up
        });

        // Add keyboard support for closing expanded cards with ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                // Only close expanded cards if no modal is open
                if (!document.querySelector('.modal.show')) {
                    document.querySelectorAll('.certification-card.expanded').forEach(card => {
                        card.classList.remove('expanded');
                        const expandBtn = card.querySelector('.btn-expand');
                        if (expandBtn) {
                            expandBtn.innerHTML = '<i class="fas fa-plus me-2"></i>Conoce Más';
                        }
                    });
                }
            }
        });

        // Handle testimonial videos carousel - Simplified
        document.addEventListener('DOMContentLoaded', function() {
            // Simple carousel functionality
            const testimoniosCarousel = document.getElementById('testimoniosCarousel');

            if (testimoniosCarousel) {
                // Pause videos when sliding
                testimoniosCarousel.addEventListener('slide.bs.carousel', function() {
                    const videos = this.querySelectorAll('video');
                    videos.forEach(video => {
                        if (!video.paused) {
                            video.pause();
                        }
                    });
                });

                // Debug: Log when carousel events happen
                testimoniosCarousel.addEventListener('slid.bs.carousel', function() {
                    console.log('Carousel slid to new item');
                });
            }

            // Initialize images carousel
            const imagenesCarousel = document.getElementById('imagenesCarousel');
            if (imagenesCarousel) {
                console.log('Images carousel found and initialized');
            }

            console.log('Carousels initialized');
        });
    </script>
    <?php get_template_part('components/floating-buttons'); ?>
    <?php get_footer(); ?>
</body>