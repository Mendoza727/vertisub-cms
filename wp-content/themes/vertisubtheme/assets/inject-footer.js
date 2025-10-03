document.addEventListener("DOMContentLoaded", () => {
  const container = document.getElementById("footer-wrapper");
  if (!container) return;

  fetch("<?php echo get_template_directory_uri(); ?>/assets/footer-endpoint.php")
    .then((res) => res.text())
    .then((html) => {
      container.innerHTML = html;
    })
    .catch((err) => console.error("Error cargando footer:", err));
});
