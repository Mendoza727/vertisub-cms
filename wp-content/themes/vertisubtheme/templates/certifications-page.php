<?php
/*
Template Name: Certificaciones
*/
?>

<head>
    <?php wp_head(); ?>
    <title>Proyectos Existosos Vertisub</title>
    <style>
        #modal {
            display: none;
            /* oculto al inicio */
        }

        #modal.active {
            display: block;
            /* se muestra al activarlo */
        }
    </style>

    <script
        async=""
        type="module"
        crossorigin=""
        src="<?php echo get_template_directory_uri(); ?>/assets/index-5_OOGiqd.js"></script>
    <link
        rel="stylesheet"
        crossorigin=""
        href="<?php echo get_template_directory_uri(); ?>/assets/index-jBEXIzIO.css" />
    <link
        rel="modulepreload"
        as="script"
        crossorigin=""
        href="<?php echo get_template_directory_uri(); ?>/assets/Home-DBjZf9jM.js" />
    <link
        rel="modulepreload"
        as="script"
        crossorigin=""
        href="<?php echo get_template_directory_uri(); ?>/assets/thumbnail-Dv4-UVAT.js" />
    <link
        rel="modulepreload"
        as="script"
        crossorigin=""
        href="<?php echo get_template_directory_uri(); ?>/assets/SmootherLayout-DPjoTzjc.js" />
    <link
        rel="stylesheet"
        crossorigin=""
        href="<?php echo get_template_directory_uri(); ?>/assets/SmootherLayout-C-d4VHeg.css" />
    <link
        rel="modulepreload"
        as="script"
        crossorigin=""
        href="<?php echo get_template_directory_uri(); ?>/assets/UpperCircle-CXml2Tqv.js" />
    <link
        rel="stylesheet"
        crossorigin=""
        href="<?php echo get_template_directory_uri(); ?>/assets/UpperCircle-CD3A_mj-.css" />
    <link
        rel="modulepreload"
        as="script"
        crossorigin=""
        href="<?php echo get_template_directory_uri(); ?>/assets/CardNews-Dl3YvFU3.js" />
    <link
        rel="stylesheet"
        crossorigin=""
        href="<?php echo get_template_directory_uri(); ?>/assets/CardNews-Bt6LV50Q.css" />
    <link
        rel="stylesheet"
        crossorigin=""
        href="<?php echo get_template_directory_uri(); ?>/assets/Home-B5GaeNAV.css" />
</head>

<body <?php body_class(); ?>>
    <?php get_header(); ?>

    <?php get_template_part('loader'); ?>

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


                        <?php $right_image = $hero_data['imagen_lateral'] ? $hero_data['imagen_lateral'] : 'https://vertisub.com/wp-content/uploads/2025/10/504ef5aa-b48d-46fe-9746-4dff595a4b0f.jpg'; ?>
                        <div class="col-lg-5 d-flex justify-content-center" data-aos="fade-up">
                            <div class="image-box" style="max-width: 600px; height: 400px; border-radius: 8px; overflow: hidden; margin-left: 33px; margin-top: 20px">
                                <img src="<?= $right_image; ?>"
                                    alt="Imagen Nosotros"
                                    class="img-fluid">
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!-- Sección Proyectos Exitosos -->
        <section class="proyectos-section">
            <div class="container">
                <?php $certifications_data = vertisub_get_acf_field('certificaciones'); ?>
                <?php if ($certifications_data) : ?>
                    <div class="section-header" data-aos="fade-up">
                        <?php if ($certifications_data['subtitulo']) : ?>
                            <span class="section-subtitle"><?= $certifications_data['subtitulo']; ?></span>
                        <?php endif; ?>

                        <?php if ($certifications_data['titulo']) : ?>
                            <h2 class="section-title"><?= $certifications_data['titulo']; ?></h2>
                        <?php endif; ?>

                        <?php if ($certifications_data['descripcion']) : ?>
                            <p class="lead text-muted mb-5"><?= $certifications_data['descripcion']; ?></p>
                        <?php endif; ?>

                    </div>
                <?php endif; ?>

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
                                            <img
                                                src="<?php the_post_thumbnail_url('medium'); ?>"
                                                alt="<?php the_title(); ?>"
                                                class="cert-logo"
                                                data-title="<?php the_title(); ?>"
                                                data-image="<?php the_post_thumbnail_url('large'); ?>"
                                                data-description="<?php echo esc_attr(wp_strip_all_tags(get_the_content())); ?>">
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

        <!-- modal -->
        <div id="modal" style="position: fixed; top: 0; right: 0; z-index: 99">
            <div
                class="modal-container fixed top-0 left-0 w-full h-screen flex md:items-center justify-center visible bg-white/60 backdrop-blur-[7px] bg-opacity-70 z-[60] pointer-events-auto flex">
                <div
                    class="modal-wrapper w-[90%] h-[90vh] h-[90dvh] lg:w-[90%] lg:max-w-[1328px] lg:max-h-[656px] lg:h-[80dvh] mt-[20px] lg:-mt-[45px]"
                    style="perspective: 1900px; transform: translate(0,0); opacity: 1;">
                    <div
                        class="modal-flip shadow-modal bg-white h-[80vh] h-[80dvh] lg:h-full relative outline-none rounded-[24px]"
                        style="transform-style: preserve-3d; transform: rotateY(180deg); opacity: 1;">
                        <!-- Modal Content -->
                        <div
                            id="modal-back"
                            class="modal-back flex flex-col lg:flex-row absolute left-0 top-0 w-full sm:h-full z-[13] h-[82vh] h-[82dvh]"
                            style="transform: rotateY(-180deg); backface-visibility: hidden;">
                            <!-- Botón cerrar -->
                            <div class="absolute top-[24px] right-[24px] z-[16]">
                                <button
                                    class="bg-black-500 text-white w-[45px] h-[45px] rounded-full grid place-content-center group hover:bg-[#4D4147] transition-all duration-200 ease-in-out z-[16]">
                                    <svg
                                        width="24"
                                        height="22"
                                        viewBox="0 0 24 22"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="fill-white">
                                        <rect
                                            width="24.9931"
                                            height="2.08275"
                                            rx="0.5"
                                            transform="matrix(0.679011 0.734128 -0.679011 0.734128 4.2218 1.14542)" />
                                        <rect
                                            width="24.9931"
                                            height="2.08275"
                                            rx="0.5"
                                            transform="matrix(0.679011 -0.734128 0.679011 0.734128 2.80762 19.4935)" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Galería de imágenes -->
                            <div class="w-full lg:w-[50%] h-[276px] lg:h-full z-[12]" style="background-color: var(--accent-color);">
                                <img
                                    src=""
                                    id="modal-image"
                                    alt=""
                                    class="w-full h-full object-cover rounded-t-[24px] lg:rounded-l-[24px] lg:rounded-r-none carousel-img" />
                            </div>

                            <!-- Texto y descripción -->
                            <div
                                class="h-[calc(82vh-286px)] h-[calc(82dvh-286px)] lg:w-[50%] lg:h-full px-[25px] pt-[16px] pb-[24px] lg:py-[42px] lg:pl-[52px] lg:pr-[10px] z-[14] pointer-events-auto">
                                <div
                                    class="modal-back-description w-[106%] h-[97%] sm:w-full pr-[10px] min-[400px]:pr-[20px] lg:pr-[30px] lg:w-auto sm:h-full overflow-y-scroll lg:overflow-auto">
                                    <h2 id="modal-title" class="font-helvetica-extrabold text-[39px] leading-[48.75px] lg:text-[61px] lg:mb-[8px] lg:leading-[76.25px]"></h2>
                                    <p
                                        id="modal-description"
                                        class="font-ibm-plex-mono font-normal text-[16px] leading-[24px] mb-[32px] md:mb-0">
                                    </p>
                                </div>
                            </div>

                            <!-- Botón móvil -->
                            <div
                                class="absolute -bottom-[48px] z-20 w-full right-0 lg:w-auto lg:right-[32px] lg:hidden"
                                id="btn-see-project"
                                style="opacity: 1;">
                                <button class="btn-primary d-none w-full lg:w-auto">
                                    <p>Reproducir Video</p>
                                </button>
                            </div>
                        </div>
                        <!-- /Modal Content -->
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const modal = document.getElementById("modal");
            const modalImage = document.getElementById("modal-image");
            const modalTitle = document.getElementById("modal-title");
            const modalDescription = document.getElementById("modal-description");

            // usar delegación en lugar de forEach
            document.body.addEventListener("click", function(e) {
                if (e.target.classList.contains("cert-logo")) {
                    modal.classList.add("active");

                    modalImage.src = e.target.dataset.image;
                    modalImage.alt = e.target.dataset.title;
                    modalTitle.textContent = e.target.dataset.title;
                    modalDescription.textContent = e.target.dataset.description || "Sin descripción disponible";
                }
            });

            // cerrar modal
            const closeBtn = modal.querySelector("button");
            closeBtn.addEventListener("click", () => modal.classList.remove("active"));
        });
    </script>

    <!-- Custom JS -->
    <script src="<?php echo get_template_directory_uri(); ?>/script.js"></script>
    <?php get_template_part('components/floating-buttons'); ?>
    <?php get_footer(); ?>
</body>