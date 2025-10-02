<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?></title>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.body.classList.remove("overflow-hidden");
        });
    </script>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>


    <!-- Navigation -->
    <nav id="navbar" class="navbar-modern">
        <div class="nav-container">
            <div class="nav-logo">
                <!-- Tu logo igual que antes -->
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

            <!-- Menú principal CON WALKER DESKTOP -->
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary_menu',
                'container'      => false,
                'menu_class'     => 'nav-links',
                'walker'         => new Vertisub_Walker_Desktop(), // NUEVO WALKER
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
                        'menu_class'     => 'nav-list',
                        'walker'         => new Vertisub_Walker_Offcanvas(), // TU WALKER ACTUALIZADO
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdowns = document.querySelectorAll('.has-dropdown');

            const hamburger = document.getElementById('hamburger');
            const offcanvas = document.getElementById('offcanvas');
            const overlay = document.getElementById('overlay');
            const closeOffcanvasBtn = document.getElementById('closeOffcanvas');

            function closeOffcanvasMenu() {
                if (hamburger) hamburger.classList.remove('active');
                if (offcanvas) offcanvas.classList.remove('active');
                if (overlay) overlay.classList.remove('active');
                document.body.style.overflow = '';
                dropdowns.forEach(d => d.classList.remove('active'));
            }

            dropdowns.forEach(dropdown => {
                dropdown.addEventListener('click', function(e) {
                    const clickedAnchor = e.target.closest('a');
                    const topAnchor = dropdown.querySelector(':scope > a, :scope > .nav-link');

                    // Si fue un link interno (submenu), dejar navegar
                    if (clickedAnchor && topAnchor && clickedAnchor !== topAnchor) {
                        if (offcanvas && offcanvas.classList.contains('active')) closeOffcanvasMenu();
                        return;
                    }

                    // Solo abrir, nunca cerrar con el mismo click
                    e.preventDefault();
                    e.stopPropagation();
                    dropdowns.forEach(d => d.classList.remove('active')); // cerrar otros
                    dropdown.classList.add('active'); // abrir este
                });
            });

            // Cerrar todos al hacer click fuera
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.has-dropdown')) {
                    dropdowns.forEach(d => d.classList.remove('active'));
                }
            });

            if (closeOffcanvasBtn) closeOffcanvasBtn.addEventListener('click', closeOffcanvasMenu);
            if (overlay) overlay.addEventListener('click', closeOffcanvasMenu);
        });
    </script>