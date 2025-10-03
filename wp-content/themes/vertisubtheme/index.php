<?php
/*
Template Name: Sancho Landing Page
*/

get_header();
?>
<html <?php language_attributes(); ?>>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?></title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    
    <?php wp_head(); ?>
    </script>

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

    <!-- Ahora tu script para inyectar el footer -->
    <script type="module">
        // assets/inject-footer.js
        function injectFooter() {
            const container = document.getElementById("footer-wrapper");
            if (!container) return false;

            fetch("<?php echo get_template_directory_uri(); ?>/footer-endpoint.php")
                .then((res) => res.text())
                .then((html) => {
                    container.innerHTML = html;

                    // Solo ejecutar scripts con src
                    container.querySelectorAll("script[src]").forEach((script) => {
                        const newScript = document.createElement("script");
                        newScript.src = script.src;
                        newScript.async = false; // mantener orden
                        document.body.appendChild(newScript);
                    });
                })
                .catch((err) => console.error("Error cargando footer:", err));

            return true;
        }

        // Espera hasta que el div exista
        const interval = setInterval(() => {
            if (injectFooter()) clearInterval(interval);
        }, 50);
    </script>

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

<body
    data-aos-easing="ease"
    data-aos-duration="400"
    data-aos-delay="0"
    cz-shortcut-listen="true">


    <div id="root"></div>
    <?php get_template_part('loader'); ?>
    <div
        id="modal"
        style="position: fixed; top: 0px; right: 0px; z-index: 99"></div>
    <!-- Custom JS -->
    <script src="<?php echo get_template_directory_uri(); ?>/script.js"></script>
    <?php get_template_part(slug: 'components/floating-buttons'); ?>
</body>

</html>