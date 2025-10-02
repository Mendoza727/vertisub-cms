
<!-- Loader mejorado con animaciones de letras que crecen -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.12.0/lottie.min.js"></script>

<div id="loader" class="loader-container">
    <div class="loader-content">
        <div class="loader-logo" id="logo"></div>
        <div class="loader-progress">
            <div class="progress-bar"></div>
            <div class="progress-percentage">0%</div>
        </div>
        <div class="loader-subtitle">
            <span class="subtitle-text">Cargando experiencia...</span>
        </div>
    </div>
</div>

<script>
    lottie.loadAnimation({
        container: document.getElementById('logo'),
        renderer: 'svg',
        loop: false,
        autoplay: true,
        path: "<?php echo get_template_directory_uri(); ?>/assets/animations/15c1e9c0-ae91-4fae-bf0d-0de2e0c56dd8.json"
    });
</script>