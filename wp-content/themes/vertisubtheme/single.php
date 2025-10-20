<?php

?>

<head>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php get_header(); ?>

    <?php $galery = vertisub_get_acf_field('galeria'); ?>


    <main class="mt-5 mb-5">
        <section class="single-noticia pt-5">
            <div class="container single-noticia-container">
                <div class="row align-items-start">

                    <!-- CARRUSEL LATERAL -->
                    <?php if ($galery && is_array($galery)) : ?>
                        <div class="col-md-5 mt-5">
                            <div id="galeriaCarousel" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <?php foreach ($galery as $index => $img) :
                                        $active = ($index === 0) ? 'active' : '';
                                        $url = is_array($img) ? $img['url'] : wp_get_attachment_url($img);
                                    ?>
                                        <div class="carousel-item <?php echo esc_attr($active); ?>">
                                            <div class="cert-image"
                                                style="background-image: url('<?php echo esc_url($url); ?>'); height: 450px;">
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#galeriaCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Anterior</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#galeriaCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Siguiente</span>
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- CONTENIDO PRINCIPAL -->
                    <div class="<?php echo $galery ? 'col-md-7' : 'col-md-12'; ?>">
                        <article id="post-<?php the_ID(); ?>" <?php post_class('cert-content'); ?>>
                            <header class="entry-header mb-4 mt-5">
                                <h1 class="cert-title"><?php the_title(); ?></h1>
                            </header>

                            <div class="entry-content">
                                <?php
                                if (has_post_thumbnail() && empty($galery)) {
                                    echo '<div class="cert-image mb-4" style="background-image:url(' . esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')) . '); height:400px;"></div>';
                                }
                                the_content();
                                ?>

                                <a href="<?php echo esc_url(home_url('/noticias')); ?>" class="btn-expand" style="width: fit-content; margin: 0;">
                                    <i class="fas fa-plus me-2"></i>Ver más noticias
                                </a>
                            </div>


                        </article>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php get_footer(); ?>
</body>