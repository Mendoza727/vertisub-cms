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

    <!-- Navigation -->
    <nav id="navbar" class="navbar-modern">
        <div class="nav-container">
            <div class="nav-logo">
                <!-- Logo dinámico -->
                <a href="<?php echo esc_url(home_url('/')); ?>" class="logo-text">
                    <?php
                    if (function_exists('the_custom_logo') && has_custom_logo()) {
                        $custom_logo_id = get_theme_mod('custom_logo');
                        $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
                        echo '<img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '" style="width:130px; height:auto;">';
                    } else {
                        bloginfo('name');
                    }
                    ?>
                </a>
            </div>

            <!-- Menú principal -->
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary_menu',
                'container'      => false,
                'menu_class'     => 'nav-links', // misma clase que tu HTML original
                'fallback_cb'    => false
            ));
            ?>

            <div class="nav-hamburger" id="hamburger">
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
            </div>
        </div>
    </nav>

    <!-- Offcanvas Menu -->
    <div id="offcanvas" class="offcanvas-menu">
        <div class="offcanvas-content">
            <div class="offcanvas-header">
                <span class="offcanvas-logo">VERTISUB</span>
                <button class="offcanvas-close" id="closeOffcanvas">
                    <span class="close-line"></span>
                    <span class="close-line"></span>
                </button>
            </div>

            <div class="offcanvas-body">
                <nav class="offcanvas-nav">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary_menu',
                        'container'      => false,
                        'menu_class'     => 'nav-list', // igual que tu HTML estático
                        'walker'         => new Vertisub_Walker_Offcanvas(),
                        'fallback_cb'    => false
                    ));
                    ?>
                </nav>

                <div class="offcanvas-footer">
                    <div class="social-links">
                        <?php
                        $redes = new WP_Query(array(
                            'post_type'      => 'redes_sociales',
                            'posts_per_page' => -1,
                            'orderby'        => 'date',
                            'order'          => 'ASC'
                        ));

                        if ($redes->have_posts()) :
                            while ($redes->have_posts()) : $redes->the_post();
                                $url = get_post_meta(get_the_ID(), '_social_url', true);
                        ?>
                                <a href="<?php echo esc_url($url); ?>"
                                    class="social-link"
                                    target="_blank"
                                    rel="noopener">
                                    <?php the_title(); ?>
                                </a>
                        <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Overlay -->
    <div id="overlay" class="offcanvas-overlay"></div>