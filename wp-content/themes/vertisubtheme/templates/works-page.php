<?php
/*
Template Name: trabaja con nosotros
*/
?>

<head>
    <?php wp_head(); ?>
    <title>Trabaja Con Nosotros - Vertisub</title>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/works-styles.css">
</head>

<body <?php body_class(); ?>>
    <?php get_header(); ?>

    <main class="mt-5">
        <!-- Hero Section -->
        <section class="hero-about-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="hero-about-content" data-aos="fade-up">
                            <div class="breadcrumb-custom">
                                <a href="<?php echo esc_url(home_url('/')); ?>" class="me-2">Inicio <i class="fas fa-chevron-right ms-1"></i></a>
                                <span class="text-white">Vacantes</span>
                            </div>
                            <?php
                            // Obtener todos los servicios de introducción publicados
                            $servicios = get_posts(array(
                                'post_type'      => 'servicios_intro',
                                'posts_per_page' => -1 // todos los servicios
                            ));

                            ?>
                            <h1 class="display-3 fw-bold text-white">Nuestras Vacantes</h1>
                            <div class="intro-description text-white mt-3">
                                <p>Buscamos talento comprometido para construir proyectos de calidad. Únete a nuestro equipo y crece con nosotros..</p>
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

        <!-- Job Positions Section -->
        <section class="positions-section">
            <div class="container">
                <h2 class="section-title" data-aos="fade-up">Vacantes Disponibles</h2>
                <p class="section-subtitle" data-aos="fade-up">Encuentra la posición perfecta para tu perfil y experiencia.</p>

                <!-- Search and Filter Section -->
                <div class="search-filter-container" data-aos="fade-up">
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="search-box">
                                <i class="fas fa-search"></i>
                                <input type="text" id="searchInput" class="form-control" placeholder="Buscar por título o descripción...">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select id="locationFilter" class="form-select">
                                <option value="">Todas las ubicaciones</option>
                                <option value="Ciudad de México">Ciudad de México</option>
                                <option value="Guadalajara">Guadalajara</option>
                                <option value="Monterrey">Monterrey</option>
                                <option value="Remoto">Remoto</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select id="experienceFilter" class="form-select">
                                <option value="">Toda la experiencia</option>
                                <option value="0-2">0-2 años</option>
                                <option value="2-4">2-4 años</option>
                                <option value="4-6">4-6 años</option>
                                <option value="5+">5+ años</option>
                            </select>
                        </div>
                    </div>
                    <div class="filter-results">
                        <span id="resultsCount">4 vacantes encontradas</span>
                        <button id="clearFilters" class="btn-clear-filters" style="display: none;">
                            <i class="fas fa-times-circle me-1"></i> Limpiar filtros
                        </button>
                    </div>
                </div>

                <div class="row" id="jobsContainer">
                    <?php
                    $trabajos = new WP_Query(array(
                        'post_type' => 'trabajos',
                        'posts_per_page' => -1,
                        'orderby' => 'date',
                        'order' => 'DESC'
                    ));

                    if ($trabajos->have_posts()):
                        while ($trabajos->have_posts()): $trabajos->the_post();
                            $vacante = get_post_meta(get_the_ID(), '_vacante', true);
                            if (!is_array($vacante)) continue;
                    ?>
                            <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
                                <div class="job-card"
                                    data-title="<?php echo esc_attr(get_the_title()); ?>"
                                    data-description="<?php echo esc_attr(wp_strip_all_tags(get_the_content())); ?>"
                                    data-location="<?php echo esc_attr($vacante['lugar'] ?? ''); ?>"
                                    data-experience="<?php echo esc_attr($vacante['experiencia'] ?? ''); ?>">
                                    <div class="job-header">
                                        <div>
                                            <h3 class="job-title"><?php the_title(); ?></h3>
                                            <div class="job-details">
                                                <?php if (!empty($vacante['lugar'])): ?>
                                                    <span class="job-detail-item">
                                                        <i class="fas fa-map-marker-alt"></i>
                                                        <?= esc_html($vacante['lugar']); ?>
                                                    </span>
                                                <?php endif; ?>

                                                <?php if (!empty($vacante['tipo_contrato'])): ?>
                                                    <span class="job-detail-item">
                                                        <i class="fas fa-clock"></i>
                                                        <?= esc_html($vacante['tipo_contrato']); ?>
                                                    </span>
                                                <?php endif; ?>

                                                <?php if (!empty($vacante['experiencia'])): ?>
                                                    <span class="job-detail-item">
                                                        
                                                        <i class="fas fa-briefcase"></i>
                                                        <?= esc_html($vacante['experiencia']); ?>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php if (!empty($vacante['tipo_contrato'])): ?>
                                            <span class="job-type"><?= esc_html($vacante['tipo_contrato']); ?></span>
                                        <?php endif; ?>
                                    </div>

                                    <p class="job-description"><?= wp_trim_words(get_the_content(), 30, '...'); ?></p>

                                    <div class="job-actions">
                                        <button class="btn-apply" onclick="applyToJob('<?= get_the_ID(); ?>')">
                                            Aplicar Ahora <i class="fas fa-arrow-right ms-2"></i>
                                        </button>
                                        <button class="btn-more-info" onclick="openJobModal('<?= get_the_ID(); ?>')">
                                            Ver Más Información <i class="fas fa-info-circle ms-2"></i>
                                        </button>
                                    </div>

                                    <!-- Data para el modal -->
                                    <script>
                                        window.jobsData = window.jobsData || {};
                                        window.jobsData['<?= get_the_ID(); ?>'] = {
                                            title: <?= json_encode(get_the_title()); ?>,
                                            location: <?= json_encode($vacante['lugar'] ?? ''); ?>,
                                            type: <?= json_encode($vacante['tipo_contrato'] ?? ''); ?>,
                                            experience: <?= json_encode($vacante['experiencia'] ?? ''); ?>,
                                            description: <?= json_encode(apply_filters('the_content', get_the_content())); ?>,
                                            responsibilities: <?= json_encode($vacante['responsabilidades'] ?? []); ?>,
                                            requirements: <?= json_encode($vacante['requisitos'] ?? []); ?>,
                                            benefits: <?= json_encode($vacante['beneficios'] ?? []); ?>,
                                            email: <?= json_encode($vacante['email'] ?? ''); ?>
                                        };
                                    </script>
                                </div>
                            </div>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    else:
                        echo '<p>No hay vacantes disponibles en este momento.</p>';
                    endif;
                    ?>
                </div>
            </div>
        </section>

        <!-- Job Modal -->
        <div id="jobModal" class="job-modal">
            <div class="modal-container">
                <div class="modal-header">
                    <button class="modal-close" onclick="closeJobModal()">
                        <i class="fas fa-times"></i>
                    </button>
                    <h2 id="modalJobTitle" class="job-title">Título del Puesto</h2>
                    <div id="modalJobDetails" class="job-details"></div>
                </div>

                <div class="modal-body" id="modalContent">
                    <!-- Content will be dynamically inserted -->
                </div>

                <div class="modal-footer">
                    <button class="btn-more-info" onclick="closeJobModal()">
                        Cerrar
                    </button>
                    <button class="btn-apply" onclick="closeJobModal(); applyToJobFromModal()">
                        Aplicar a esta Posición <i class="fas fa-arrow-right ms-2"></i>
                    </button>
                </div>
            </div>
        </div>
    </main>
    <!-- Custom JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });

        // Scroll to form
        function scrollToForm() {
            document.getElementById('formulario').scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }

        // Create mailto link for job application
        function applyToJob(jobId) {
            const job = jobsData[jobId];
            if (!job) {
                console.error('Job not found:', jobId);
                return;
            }

            // ✅ CAMBIO: usar email del CPT si existe, si no, fallback al general
            const recipientEmail = (job.email && job.email.trim() !== '') ? job.email : 'rrhh@sanchoconstruction.com';
            const subject = `Aplicación: ${job.title} - ${job.location}`;

            const body = `Estimado equipo de Recursos Humanos,

Me dirijo a ustedes para expresar mi interés en la vacante de ${job.title} ubicada en ${job.location}.

INFORMACIÓN DE LA VACANTE:
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
Posición: ${job.title}
Ubicación: ${job.location}
Tipo: ${job.type}
Experiencia requerida: ${job.experience}

DESCRIPCIÓN DEL PUESTO:
${job.description}

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

Por favor, completa la siguiente información:

TUS DATOS:
Nombre completo: [Tu nombre]
Teléfono: [Tu teléfono]
Ciudad de residencia: [Tu ciudad]
Correo electrónico: [Tu email]

EXPERIENCIA PROFESIONAL:
Años de experiencia en el área: [Indicar años]
Empresa actual/última: [Nombre de empresa]
Puesto actual/último: [Nombre del puesto]

EDUCACIÓN:
Título profesional: [Tu título]
Universidad: [Nombre de universidad]
Certificaciones relevantes: [Si aplica]

MOTIVACIÓN:
¿Por qué te interesa esta posición?
[Escribe aquí tu respuesta]

¿Qué habilidades o experiencia específica tienes que te hace ideal para este rol?
[Escribe aquí tu respuesta]

DISPONIBILIDAD:
Fecha de incorporación: [Indicar fecha]
Expectativa salarial: [Opcional]

NOTA: Por favor adjunta tu CV actualizado en formato PDF a este correo.

Quedo atento a sus comentarios.

Saludos cordiales,
[Tu nombre]`;

            // Create mailto link
            const mailtoLink = `mailto:${recipientEmail}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;

            // Open email client
            window.location.href = mailtoLink;
        }

        // Parallax effect for hero
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const hero = document.querySelector('.hero-empleos');
            if (hero && scrolled < hero.offsetHeight) {
                hero.style.backgroundPositionY = scrolled * 0.5 + 'px';
            }
        });

        console.log('Página de Empleos - Sancho Construction cargada exitosamente');

        // Open Job Modal
        function openJobModal(jobId) {
            const job = jobsData[jobId];
            if (!job) return;

            currentModalJob = jobId; // Store for application from modal

            document.getElementById('modalJobTitle').textContent = job.title;

            document.getElementById('modalJobDetails').innerHTML = `
                <span class="job-detail-item">
                    <i class="fas fa-map-marker-alt"></i>
                    ${job.location}
                </span>
                <span class="job-detail-item">
                    <i class="fas fa-clock"></i>
                    ${job.type}
                </span>
                <span class="job-detail-item">
                    <i class="fas fa-briefcase"></i>
                    ${job.experience}
                </span>
            `;

            const modalContent = document.getElementById('modalContent');
            modalContent.innerHTML = `
                <div class="modal-section">
                    <h3><i class="fas fa-file-alt"></i> Descripción del Puesto</h3>
                    <p>${job.description}</p>
                </div>

                <div class="modal-section">
                    <h3><i class="fas fa-tasks"></i> Responsabilidades</h3>
                    <ul>
                        ${job.responsibilities.map(item => `<li>${item}</li>`).join('')}
                    </ul>
                </div>

                <div class="modal-section">
                    <h3><i class="fas fa-check-circle"></i> Requisitos</h3>
                    <ul>
                        ${job.requirements.map(item => `<li>${item}</li>`).join('')}
                    </ul>
                </div>

                <div class="modal-section">
                    <h3><i class="fas fa-gift"></i> Lo Que Ofrecemos</h3>
                    <ul>
                        ${job.benefits.map(item => `<li>${item}</li>`).join('')}
                    </ul>
                </div>
            `;

            document.getElementById('jobModal').classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        // Close Job Modal
        function closeJobModal() {
            document.getElementById('jobModal').classList.remove('show');
            document.body.style.overflow = 'auto';
        }

        // Store current job for modal application
        let currentModalJob = null;

        // Apply from modal
        function applyToJobFromModal() {
            if (currentModalJob) {
                applyToJob(currentModalJob);
            }
        }

        // Close modal when clicking outside
        document.getElementById('jobModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeJobModal();
            }
        });

        // Close modal with ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeJobModal();
            }
        });


        // Filter Jobs Function
        function filterJobs() {
            const searchTerm = (document.getElementById('searchInput').value || '').trim().toLowerCase();
            const locationFilter = (document.getElementById('locationFilter').value || '').trim();
            const experienceFilter = (document.getElementById('experienceFilter').value || '').trim();

            // Show skeleton loaders (tu función original)
            showSkeletonLoaders();

            // Simulate search delay for better UX (conservamos tu 600ms)
            setTimeout(() => {
                const rowCards = document.querySelectorAll('#jobsContainer > .col-lg-12');
                let visibleCount = 0;

                rowCards.forEach(row => {
                    // cada row contiene .job-card
                    const card = row.querySelector('.job-card');
                    if (!card) return;

                    const title = (card.getAttribute('data-title') || '').toLowerCase();
                    const description = (card.getAttribute('data-description') || '').toLowerCase();
                    const location = (card.getAttribute('data-location') || '').trim();
                    const experienceAttr = (card.getAttribute('data-experience') || '').trim();
                    const experience = parseInt(experienceAttr) || 0;

                    let showCard = true;

                    // Search filter (titulo o descripción)
                    if (searchTerm) {
                        if (!title.includes(searchTerm) && !description.includes(searchTerm)) {
                            showCard = false;
                        }
                    }

                    // Location filter (match exact)
                    if (locationFilter) {
                        if (location !== locationFilter) showCard = false;
                    }

                    // Experience filter (rangos y '5+')
                    if (experienceFilter) {
                        if (experienceFilter.includes('+')) {
                            const min = parseInt(experienceFilter) || 0;
                            if (experience < min) showCard = false;
                        } else {
                            const parts = experienceFilter.split('-').map(n => parseInt(n));
                            if (parts.length === 2) {
                                const [min, max] = parts;
                                if (experience < min || experience > max) showCard = false;
                            }
                        }
                    }

                    // Mostrar u ocultar la fila completa (manteniendo tu skeleton logic)
                    row.style.display = showCard ? 'block' : 'none';
                    if (showCard) visibleCount++;
                });

                // Remove skeleton loaders
                hideSkeletonLoaders();

                // Show/hide no results message (seguimos tu estructura)
                let noResultsDiv = document.getElementById('noResults');
                if (visibleCount === 0) {
                    if (!noResultsDiv) {
                        noResultsDiv = document.createElement('div');
                        noResultsDiv.id = 'noResults';
                        noResultsDiv.className = 'no-results col-12';
                        noResultsDiv.innerHTML = `
                            <i class="fas fa-search"></i>
                            <h3>No se encontraron vacantes</h3>
                            <p>Intenta ajustar tus filtros de búsqueda</p>
                        `;
                        document.getElementById('jobsContainer').appendChild(noResultsDiv);
                    }
                } else {
                    if (noResultsDiv) noResultsDiv.remove();
                }

                // Actualizar contador de resultados
                updateResultsCount();

                // Mostrar/Ocultar botón limpiar
                showClearButton();
            }, 600); // conservamos tu retraso
        }

        // Show Skeleton Loaders (tu función intacta)
        function showSkeletonLoaders() {
            const container = document.getElementById('jobsContainer');

            // Hide all job cards
            const jobCards = container.querySelectorAll('.col-lg-12');
            jobCards.forEach(card => card.style.display = 'none');

            // Remove any existing skeletons
            const existingSkeletons = container.querySelectorAll('.skeleton-wrapper');
            existingSkeletons.forEach(skeleton => skeleton.remove());

            // Add 3 skeleton loaders
            for (let i = 0; i < 3; i++) {
                const skeletonHTML = `
                    <div class="col-lg-12 skeleton-wrapper">
                        <div class="skeleton-card">
                            <div class="skeleton-header">
                                <div style="flex: 1;">
                                    <div class="skeleton-title skeleton-loader"></div>
                                    <div class="skeleton-details">
                                        <div class="skeleton-detail skeleton-loader"></div>
                                        <div class="skeleton-detail skeleton-loader"></div>
                                        <div class="skeleton-detail skeleton-loader"></div>
                                    </div>
                                </div>
                                <div class="skeleton-badge skeleton-loader"></div>
                            </div>
                            <div class="skeleton-description skeleton-loader"></div>
                            <div class="skeleton-buttons">
                                <div class="skeleton-button skeleton-loader"></div>
                                <div class="skeleton-button skeleton-loader"></div>
                            </div>
                        </div>
                    </div>
                `;
                container.insertAdjacentHTML('beforeend', skeletonHTML);
            }
        }

        // Hide Skeleton Loaders (tu función intacta)
        function hideSkeletonLoaders() {
            const container = document.getElementById('jobsContainer');

            // Remove skeleton loaders
            const skeletons = container.querySelectorAll('.skeleton-wrapper');
            skeletons.forEach(skeleton => skeleton.remove());

            // Show job cards
            const jobCards = container.querySelectorAll('.col-lg-12');
            jobCards.forEach(card => {
                // si ya estaba oculto por filtro, no forzamos mostrarlo; respetamos style.display
                // solo aseguramos que si no tiene style.display, mostrarlo
                if (card.style.display === '') {
                    card.style.display = 'block';
                }
            });
        }

        // Update Results Count (ahora cuenta filas visibles, no clases hidden)
        function updateResultsCount() {
            const rows = document.querySelectorAll('#jobsContainer > .col-lg-12');
            let visible = 0;
            rows.forEach(r => {
                if (r.style.display !== 'none') visible++;
            });
            document.getElementById('resultsCount').textContent =
                `${visible} vacante${visible !== 1 ? 's' : ''} encontrada${visible !== 1 ? 's' : ''}`;
        }

        // Show Clear Button (tu función intacta)
        function showClearButton() {
            const searchTerm = document.getElementById('searchInput').value;
            const locationFilter = document.getElementById('locationFilter').value;
            const experienceFilter = document.getElementById('experienceFilter').value;

            const clearBtn = document.getElementById('clearFilters');
            if (searchTerm || locationFilter || experienceFilter) {
                clearBtn.style.display = 'inline-block';
            } else {
                clearBtn.style.display = 'none';
            }
        }

        // Clear Filters (tu función intacta)
        function clearFilters() {
            document.getElementById('searchInput').value = '';
            document.getElementById('locationFilter').value = '';
            document.getElementById('experienceFilter').value = '';
            filterJobs();
        }

        // Event Listeners (tu lógica intacta)
        document.getElementById('searchInput').addEventListener('input', debounce(filterJobs, 300));
        document.getElementById('locationFilter').addEventListener('change', filterJobs);
        document.getElementById('experienceFilter').addEventListener('change', filterJobs);
        document.getElementById('clearFilters').addEventListener('click', clearFilters);

        // Debounce function to avoid too many filter calls while typing (tu función intacta)
        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        // Inicializa el contador al cargar (para mostrar número inicial correcto)
        document.addEventListener('DOMContentLoaded', function() {
            // Small timeout to allow AOS/layout to settle
            setTimeout(() => {
                // Dejamos la UI igual pero actualizamos el contador
                // Si quieres que al cargar muestre sólo después de filtrar, comenta la siguiente línea
                updateResultsCount();
            }, 200);
        });
    </script>
    <?php get_template_part('components/floating-buttons'); ?>
    <?php get_footer(); ?>
</body>
