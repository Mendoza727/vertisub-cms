<?php
/*
Template Name: Home
*/
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/index-jBEXIzIO.css" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/SmootherLayout-C-d4VHeg.css" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/UpperCircle-CD3A_mj-.css" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/CardNews-Bt6LV50Q.css" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/Home-B5GaeNAV.css" />

    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.2/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.2/dist/ScrollTrigger.min.js"></script>

    <style>
        /* Ocultar y mostrar el modal (#modal) */
        #modal {
            display: none;
            /* Ocultar por defecto */
        }

        /* Usamos la clase 'active' añadida por JS para mostrarlo */
        #modal.active {
            display: flex;
            /* Mostrar cuando está activo */
        }

        /* Flechas de navegación del modal */
        .modal-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.4);
            color: white;
            font-size: 1.5rem;
            border: none;
            padding: 8px 14px 12px 14px;
            border-radius: 50%;
            cursor: pointer;
            z-index: 30;
            transition: background-color 0.2s ease;
            line-height: 1;
        }

        .modal-arrow:hover {
            background-color: rgba(0, 0, 0, 0.7);
        }

        .modal-arrow.left {
            left: 15px;
        }

        .modal-arrow.right {
            right: 15px;
        }

        /* Estilos para el flip del modal - Asegurar que inicia mirando al frente (0deg) */
        .modal-flip {
            transition: transform 0.6s;
            transform-style: preserve-3d;
            transform: rotateY(0deg);
        }

        /* Asegurar que el contenido trasero inicie mirando al frente */
        #modal-back {
            transform: rotateY(0deg) !important;
            backface-visibility: hidden;
        }
    </style>

    <?php wp_head(); ?>
</head>

<body class="scroll-smooth">

    <?php get_header() ?>
    <?php $banners = vertisub_get_acf_field('banners'); ?>
    <?php if ($banners) : ?>
        <div class="relative w-full 60vh md:h-[100vh] !mb-[-250px] overflow-hidden" id="bannerCarousel">
            <!-- Slides -->
            <?php foreach ($banners as $index => $banner) : ?>
                <div class="absolute inset-0 <?= $index === 0 ? 'opacity-100' : 'opacity-0'; ?> transition-opacity duration-[5000ms] ease-[cubic-bezier(0.4,0,0.2,1)] slide">
                    <img src="<?= esc_url($banner['imagen']); ?>"
                        alt="<?= esc_attr($banner['titulo']); ?>"
                        class="w-full h-full object-cover">

                    <!-- Contenido alineado a la izquierda con márgenes -->
                    <div class="absolute inset-0 bg-black/40 flex flex-col justify-center text-white">
                        <div class="container mx-auto px-4 md:px-8 lg:px-16 text-left">
                            <?php if (!empty($banner['subtitulo'])) : ?>
                                <p class="text-base mb-2"><?= esc_html($banner['subtitulo']); ?></p>
                            <?php endif; ?>

                            <?php if (!empty($banner['titulo'])) : ?>
                                <h2 class="!text-4xl md:!text-5xl font-bold mb-2"><?= esc_html($banner['titulo']); ?></h2>
                            <?php endif; ?>

                            <?php if (!empty($banner['descripcion'])) : ?>
                                <p class="text-lg md:text-xl max-w-2xl"><?= esc_html($banner['descripcion']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Indicadores -->
            <?php if (count($banners) > 1) : ?>
                <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex gap-3 z-10">
                    <?php foreach ($banners as $i => $_) : ?>
                        <button
                            class="w-3 h-3 rounded-full border border-white transition-all duration-300 indicator <?= $i === 0 ? 'bg-white' : 'bg-transparent'; ?>">
                        </button>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php $soluciones_data = vertisub_get_acf_field('soluciones'); ?>
    <?php if ($soluciones_data) : ?>
        <div class="parallax-container">
            <section id="short-description-section">
                <div class="BlackUpperCircle">
                    <svg viewBox="0 0 1440 229" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M1439.88 228.815V229H-4.21633e-05C13.2759 217.716 27.1156 208.165 41.498 198.24C46.1577 195.025 50.8745 191.77 55.6475 188.404C221.297 71.3714 454.578 -0.171592 722.342 0.000251499C990.226 -0.171592 1222.06 71.4072 1386.5 187.58C1405.18 200.766 1422.99 214.524 1439.88 228.815Z"
                            fill="#bb0c2b" />
                    </svg>
                </div>

                <section id="short-description-container" class="short-description-container">
                    <div id="short-description__info" class="short-description__info">
                        <div class="description">
                            <h2><?= $soluciones_data['titulo']; ?></h2>
                        </div>
                    </div>

                    <?php $soluciones_url = $soluciones_data['imagen_lateral'] ? $soluciones_data['imagen_lateral'] : "https://vertisub.corazonnomada.com/wp-content/uploads/2025/09/CERM_col-37-scaled.jpg"; ?>
                    <div id="short-description__image" class="short-description__image">
                        <img src="<?= $soluciones_url; ?>" alt="Descripción" class="rounded-full w-full h-full">
                    </div>
                </section>
            </section>
        <?php endif; ?>

        <?php
        $mostrar_proyectos = vertisub_get_acf_field('mostrar_proyectos');
        $proyectos_data = vertisub_get_acf_field('proyectos');
        ?>
        <?php if ($proyectos_data && $mostrar_proyectos) : ?>
            <section id="work-section">
                <div class="bg-white w-full pt-[92px] lg:pt-[120px] pb-[96px] lg:pb-[120px]">
                    <div class="container mx-auto px-[23px] xl:px-0 flex justify-end">
                        <div id="work-container" class="w-full lg:w-[70%]">

                            <?php if ($proyectos_data['titulo']) : ?>
                                <h2 id="work-title" class="font-helvetica text-[31px] leading-[38.75px] lg:text-[48px] lg:leading-[60px] mb-[56px] lg:mb-[64px] min-w-max lg:min-w-fit">
                                    <?= $proyectos_data['titulo']; ?>
                                </h2>
                            <?php endif; ?>

                            <?php $proyects_data = $proyectos_data['proyectos_datos']; ?>
                            <?php if ($proyects_data) : ?>
                                <div class="relative w-full" id="work-items-container">

                                    <?php foreach ($proyects_data as $proyect) : ?>
                                        <article class="work-item relative flex cursor-pointer group justify-end open-modal-btn"
                                            data-title="<?= $proyect['titulo']; ?>"
                                            data-country="<?php echo $proyect['pais']; ?>"
                                            data-image="<?= $proyect['imagen']; ?>"
                                            data-description="<?= $proyect['descripcion']; ?>">
                                            <div class="work-item__info w-full h-auto flex flex-col lg:flex-row lg:justify-between lg:py-[32px] border-b border-black mb-[16px] lg:mb-0">
                                                <h3 class="text-black-500 uppercase font-helvetica-bold text-[39px] leading-[48.75px] lg:text-[50px] lg:leading-[60px] lg:mr-[16px] group-hover:text-black-300 transition-all duration-300 ease-in-out">
                                                    <?= $proyect['titulo']; ?>
                                                </h3>
                                                <div class="mb-[9px] flex justify-between lg:mb-0 items-center">
                                                    <span class="font-ibm-plex-mono font-normal text-black-500 text-[14px] leading-[24px] lg:text-[16px] lg:w-[150px] xl:w-[205px] lg:leading-[24px] lg:text-end group-hover:text-black-300 transition-all duration-300 ease-in-out text-balance">
                                                        <?= $proyect['pais']; ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </article>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <?php $news_data = vertisub_get_acf_field('novedades'); ?>
        <?php if ($news_data) : ?>
            <section id="news-section" class="bg-gray">
                <div class="container mx-auto w-full px-[23px] pt-[92px] 2xl:px-0 lg:pt-[120px] pb-[96px] lg:pb-[120px]">

                    <?php if ($news_data['titulo']) : ?>
                        <h2 class="text-black-500 font-helvetica-extrabold text-[26px] min-[400px]:text-[31px] leading-[38.75px] mb-[56px] sm:mb-[32px] lg:text-[48px] lg:leading-[60px] uppercase">
                            <?= $news_data['titulo']; ?>
                        </h2>
                    <?php endif; ?>

                    <?php $all_news = $news_data['novedades_data']; ?>

                    <?php if ($all_news) : ?>

                        <div class="feed-news" style="display: flex; flex-direction: row; place-content: stretch center; box-sizing: border-box; width: 100%; gap: 21px;">

                            <?php foreach ($all_news as $news) : ?>
                                <div style="display: flex; flex-direction: column; place-content: stretch flex-start; flex: 1 1 0%; width: 0px; gap: 21px;">
                                    <a href="<?= $news['url']; ?>" target="_blank" rel="noopener noreferrer">
                                        <article class="card-news card-news-589 lg:order-none">
                                            <div class="card-news__image">
                                                <div class="w-full h-full bg-transparent">
                                                    <img src="<?= $news['imagen']; ?>" loading="lazy" alt="" class="w-full h-full object-cover object-top transition-all duration-[600ms] ease-in-out hover:bg-black-500/90">
                                                </div>
                                            </div>
                                            <div class="card-news__content">
                                                <div class="flex w-full justify-between items-start">
                                                    <h4 class="line-clamp-2"><?= $news['titulo']; ?></h4>
                                                    <img src="data:image/svg+xml,%3csvg%20width='19'%20height='19'%20viewBox='0%200%2019%2019'%20fill='none'%20xmlns='http://www.w3.org/2000/svg'%3e%3cpath%20d='M1.75%2017.25L18%201M18%201V16.6M18%201H2.4'%20stroke='white'%20stroke-width='2'%20stroke-linecap='round'%20stroke-linejoin='round'%20/%3e%3c/svg%3e" alt="Arrow icon to redirect to a new page" class="mt-[8px] w-[16px] h-[16px]">
                                                </div>
                                                <?php if ($news['fecha']) : ?>
                                                    <h5><?= $news['fecha']; ?></h5>
                                                <?php endif; ?>

                                            </div>
                                        </article>
                                    </a>
                                </div>
                            <?php endforeach; ?>

                        </div>

                    <?php endif; ?>

                </div>
            </section>
        <?php endif; ?>

        <div id="modal" class="fixed top-0 left-0 w-full h-screen z-[60]">
            <div class="modal-container w-full h-full flex md:items-center justify-center bg-white/60 backdrop-blur-[7px] bg-opacity-70 flex">
                <div class="modal-wrapper w-[90%] h-[90vh] lg:w-[90%] lg:max-w-[1328px] lg:max-h-[656px] lg:h-[80dvh] mt-[20px] lg:-mt-[45px]">

                    <div class="modal-flip shadow-modal bg-white h-[80vh] lg:h-full relative outline-none rounded-[24px]">

                        <div id="modal-back" class="modal-back flex flex-col lg:flex-row absolute left-0 top-0 w-full sm:h-full z-[13] h-[82vh] rounded-[24px]">

                            <div class="absolute top-[24px] right-[24px] z-[16]">
                                <button id="closeModal" class="bg-black-500 text-white w-[30px] h-[30px] rounded-full grid place-content-center group hover:bg-[#4D4147] transition-all duration-200 ease-in-out z-[16]">
                                    <svg width="18" height="18" viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="fill-white">
                                        <rect width="24.9931" height="2.08275" rx="0.5" transform="matrix(0.679011 0.734128 -0.679011 0.734128 4.2218 1.14542)" />
                                        <rect width="24.9931" height="2.08275" rx="0.5" transform="matrix(0.679011 -0.734128 0.679011 0.734128 2.80762 19.4935)" />
                                    </svg>
                                </button>
                            </div>

                            <div class="w-full lg:w-[50%] h-[276px] lg:h-full z-[12] relative">
                                <img src="" id="modal-image" alt="Imagen de Proyecto" class="w-full h-full object-cover rounded-t-[24px] lg:rounded-l-[24px] lg:rounded-tr-none" />
                            </div>

                            <button id="prev-cert" class="modal-arrow left">❮</button>
                            <button id="next-cert" class="modal-arrow right">❯</button>

                            <div class="h-[calc(82vh-286px)] lg:w-[50%] lg:h-full px-[25px] pt-[16px] pb-[24px] lg:py-[42px] lg:pl-[52px] lg:pr-[10px] z-[14] pointer-events-auto">
                                <div class="modal-back-description w-[106%] h-[97%] pr-[10px] lg:pr-[30px] overflow-y-scroll">
                                    <h2 id="modal-title" class="font-helvetica-extrabold text-[39px] leading-[48.75px] lg:text-[61px] lg:mb-[8px] lg:leading-[76.25px]"></h2>
                                    <p id="modal-country" class="font-ibm-plex-mono font-normal text-[16px] leading-[24px] mb-[16px] md:mb-[16px] text-red-600"></p>
                                    <p id="modal-description" class="font-ibm-plex-mono font-normal text-[16px] leading-[24px] mb-[32px] md:mb-0"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Inicializar GSAP ScrollTrigger
            gsap.registerPlugin(ScrollTrigger);

            // --- GSAP ANIMACIONES DE SCROLL ---
            gsap.to("#video-section", {
                scrollTrigger: {
                    trigger: "#video-section",
                    pin: true,
                    pinSpacing: false
                }
            });

            const timeline = gsap.timeline({
                scrollTrigger: {
                    trigger: "#short-description-container",
                    start: "20% top",
                    end: "bottom 20%",
                    scrub: true
                }
            });

            timeline.to("#short-description__info", {
                xPercent: -100
            }, "a");
            timeline.to("#short-description__image", {
                xPercent: 100
            }, "a");
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const modal = document.getElementById("modal");
                const modalImage = document.getElementById("modal-image");
                const modalTitle = document.getElementById("modal-title");
                const modalCountry = document.getElementById("modal-country"); // Nuevo elemento
                const modalDescription = document.getElementById("modal-description");
                const closeBtn = document.getElementById("closeModal");

                // Selector actualizado para los elementos de proyecto
                const projectItems = Array.from(document.querySelectorAll(".work-item.open-modal-btn"));
                const prevBtn = document.getElementById("prev-cert"); // Se mantiene el ID del HTML anterior
                const nextBtn = document.getElementById("next-cert"); // Se mantiene el ID del HTML anterior

                let currentIndex = -1;

                function loadModalData(index) {
                    const project = projectItems[index];
                    if (!project) return;

                    modalImage.src = project.dataset.image;
                    modalTitle.textContent = project.dataset.title;
                    modalCountry.textContent = project.dataset.country;
                    modalDescription.textContent = project.dataset.description || "Sin descripción disponible";
                    currentIndex = index;
                }

                function openModal(index) {
                    loadModalData(index);
                    modal.classList.add("active");
                    document.body.style.overflow = 'hidden';
                }

                function closeModal() {
                    modal.classList.remove("active");
                    document.body.style.overflow = '';
                }

                // Abrir modal al hacer clic en un proyecto
                projectItems.forEach((item, index) => {
                    item.addEventListener("click", (e) => {
                        // Asegurar que el clic sea en el item o en un hijo del item
                        if (e.currentTarget.classList.contains("open-modal-btn")) {
                            openModal(index);
                        }
                    });
                });

                // Cerrar modal
                closeBtn.addEventListener("click", closeModal);
                modal.addEventListener("click", function(e) {
                    if (e.target.classList.contains('modal-container')) {
                        closeModal();
                    }
                });

                // Navegar entre proyectos
                function showNextProject() {
                    if (projectItems.length === 0) return;
                    let nextIndex = (currentIndex + 1) % projectItems.length;
                    loadModalData(nextIndex);
                }

                function showPrevProject() {
                    if (projectItems.length === 0) return;
                    let prevIndex = (currentIndex - 1 + projectItems.length) % projectItems.length;
                    loadModalData(prevIndex);
                }

                prevBtn.addEventListener("click", showPrevProject);
                nextBtn.addEventListener("click", showNextProject);

                // Navegación por teclado
                document.addEventListener("keydown", function(e) {
                    if (!modal.classList.contains("active")) return;
                    if (e.key === "ArrowRight") showNextProject();
                    if (e.key === "ArrowLeft") showPrevProject();
                    if (e.key === "Escape") closeModal();
                });
            });
        </script>

        <!-- JS del carrusel -->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const slides = document.querySelectorAll("#bannerCarousel .slide");
                const indicators = document.querySelectorAll("#bannerCarousel .indicator");
                let current = 0;
                let interval;

                function showSlide(index) {
                    slides.forEach((slide, i) => {
                        slide.classList.toggle("opacity-100", i === index);
                        slide.classList.toggle("opacity-0", i !== index);
                    });
                    indicators.forEach((dot, i) => {
                        dot.classList.toggle("bg-white", i === index);
                        dot.classList.toggle("bg-transparent", i !== index);
                    });
                    current = index;
                }

                function nextSlide() {
                    const next = (current + 1) % slides.length;
                    showSlide(next);
                }

                // Iniciar carrusel automático
                function startCarousel() {
                    interval = setInterval(nextSlide, 6000);
                }

                // Reiniciar cuando se hace clic manualmente
                indicators.forEach((dot, index) => {
                    dot.addEventListener("click", () => {
                        clearInterval(interval);
                        showSlide(index);
                        startCarousel();
                    });
                });

                // Mostrar el primer slide correctamente
                showSlide(0);
                startCarousel();
            });
        </script>

        <?php get_footer(); ?>
</body>

</html>