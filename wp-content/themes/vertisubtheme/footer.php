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
                        $logo = vertisub_get_acf_field('logo_footer', true);
                        if ($logo) :
                        ?>
                            <img width="120px" src="<?= esc_url($logo); ?>" alt="<?= get_bloginfo('name'); ?>'">
                        <?php endif;
                        ?>
                    </div>
                </div>
                <p class="footer-company-desc mt-4">
                    <?= vertisub_get_acf_field('descripcion', true); ?>
                </p>

                <?php if (vertisub_get_acf_field('redes_sociales', true)) : ?>
                    <div class="footer-social-links">
                        <?php
                        $social_media = vertisub_get_acf_field('redes_sociales', true);

                        foreach ($social_media as $social) :
                            $url = $social['url'] ?? '';
                            $icon_id = $social['icono'] ?? '';
                            $icon = $icon_id ? wp_get_attachment_image($icon_id, 'thumbnail', false, array('class' => 'footer-social-icon')) : '';
                        ?>
                            <a href="<?php echo esc_url($url); ?>" target="_blank" class="footer-social-link" aria-label="<?php the_title(); ?>">
                                <?= $icon; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>

                <?php endif; ?>
            </div>

            <!-- Services Links -->
            <!-- Footer Links -->
            <div class="footer-links-section">
                <?php if (vertisub_get_acf_field('links_de_interes', true)) : ?>
                    <h3 class="footer-section-title"><?= vertisub_get_acf_field('links_de_interes', true)['titulo']; ?></h3>
                <?php endif; ?>
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
                <?php $contact_info = vertisub_get_acf_field('contacto', true); ?>
                <?php if ($contact_info['titulo']) : ?>
                    <h3 class="footer-section-title"><?= $contact_info['titulo']; ?></h3>
                <?php endif; ?>

                <?php if ($contact_info['ubicacion']) : ?>
                    <div class="footer-contact-item">
                        <svg class="footer-contact-icon" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                        </svg>
                        <span class="footer-contact-text"><?= $contact_info['ubicacion']; ?></span>
                    </div>
                <?php endif; ?>

                <?php if ($contact_info['telefono']) : ?>
                    <div class="footer-contact-item">
                        <svg class="footer-contact-icon" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" />
                        </svg>
                        <span class="footer-contact-text"><?= $contact_info['telefono']; ?></span>
                    </div>
                <?php endif; ?>

                <?php if ($contact_info['email']) : ?>
                    <div class="footer-contact-item">
                        <svg class="footer-contact-icon" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
                        </svg>
                        <span class="footer-contact-text"><?= $contact_info['email']; ?></span>
                    </div>
                <?php endif; ?>

                <?php if ($contact_info['paises']) : ?>
                    <div class="footer-contact-item">
                        <svg class="footer-contact-icon" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                        </svg>
                        <span class="footer-contact-text"><?= $contact_info['paises']; ?></span>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Legal Links -->
            <div class="footer-links-section">
                <?php if (vertisub_get_acf_field('legal', true)) : ?>
                    <h3 class="footer-section-title"><?= vertisub_get_acf_field('legal', true)['titulo']; ?></h3>
                <?php endif; ?>
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

        <?php if (vertisub_get_acf_field('derechos_de_autor', true)) : ?>
            <div class="footer-bottom">
                <div class="footer-bottom-content">
                    <p class="footer-copyright">
                        <?= vertisub_get_acf_field('derechos_de_autor', true); ?>
                    </p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</footer>

<?php wp_footer(); ?>