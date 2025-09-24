<!-- Advanced Footer Section -->
<footer class="footer-section">
    <div class="footer-decorative-element"></div>

    <div class="footer-container">
        <div class="footer-main">
            <!-- Logo and Company Info -->
            <div class="footer-logo-section">
                <div class="footer-logo">
                    <div class="footer-logo">
                        <?php
                        $logo = get_theme_mod('vertisub_footer_logo');
                        if ($logo) {
                            // Mostrar la imagen del logo
                            echo '<img width="120px" src="' . esc_url($logo) . '" alt="' . get_bloginfo('name') . '">';
                        } else {
                            // Si no hay logo, mostrar el texto
                            echo '<span class="footer-logo-text">' . get_bloginfo('name') . '</span>';
                        }
                        ?>
                    </div>
                </div>
                <p class="footer-company-desc mt-4">
                    ofrecemos soluciones seguras e innovadoras para trabajos en altura, industria y energías renovables, cuidando siempre la vida y el entorno.
                </p>
                <div class="footer-social-links">
                    <?php
                    $args = array(
                        'post_type'      => 'redes_sociales',
                        'posts_per_page' => -1,
                    );
                    $social_query = new WP_Query($args);

                    if ($social_query->have_posts()) :
                        while ($social_query->have_posts()) : $social_query->the_post();
                            $url = get_post_meta(get_the_ID(), '_social_url', true);
                            $icon = get_the_post_thumbnail(get_the_ID(), 'full', array('class' => 'footer-social-icon'));
                    ?>
                            <a href="<?php echo esc_url($url); ?>" target="_blank" class="footer-social-link" aria-label="<?php the_title(); ?>">
                                <?php echo $icon; ?>
                            </a>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>

            </div>

            <!-- Services Links -->
            <!-- Footer Links -->
            <div class="footer-links-section">
                <h3 class="footer-section-title">Link Interes</h3>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer_menu', // 👈 el que registramos
                    'container'      => false,
                    'menu_class'     => 'footer-links-list', // esta clase es la que ya tienes en tu CSS
                    'fallback_cb'    => false
                ));
                ?>
            </div>


            <!-- Contact and Newsletter -->
            <div class="footer-links-section">
                <h3 class="footer-section-title">Contacto</h3>
                <div class="footer-contact-item">
                    <svg class="footer-contact-icon" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                    </svg>
                    <span class="footer-contact-text">Bogotá, Colombia</span>
                </div>
                <div class="footer-contact-item">
                    <svg class="footer-contact-icon" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" />
                    </svg>
                    <span class="footer-contact-text">+57 (601) 671 66 20</span>
                </div>
                <div class="footer-contact-item">
                    <svg class="footer-contact-icon" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
                    </svg>
                    <span class="footer-contact-text">info@vertisub.com</span>
                </div>
                <div class="footer-contact-item">
                    <svg class="footer-contact-icon" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                    </svg>
                    <span class="footer-contact-text">Cl. 163a # 16A - 58, Bogotá</span>
                </div>
            </div>

            <!-- Legal Links -->
            <div class="footer-links-section">
                <h3 class="footer-section-title">Legal</h3>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer_legal',
                    'container'      => false,
                    'menu_class'     => 'footer-links-list',
                    'fallback_cb'    => false,
                    'depth'          => 1,
                    'link_before'    => '',
                    'link_after'     => '',
                    'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
                ));
                ?>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="footer-bottom-content">
                <p class="footer-copyright">
                    &copy; <?php echo date('Y'); ?> VERTISUB. Todos los derechos reservados.
                </p>
                <ul class="footer-bottom-links">
                    <li><a href="#" class="footer-bottom-link">Mapa del Sitio</a></li>
                    <li><a href="#" class="footer-bottom-link">RSS</a></li>
                    <li><a href="#" class="footer-bottom-link">Accesibilidad</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>