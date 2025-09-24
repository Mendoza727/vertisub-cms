// Initialize AOS
AOS.init({
  duration: 1000,
  easing: "ease-out-cubic",
  once: true,
  offset: 50,
});

// Loader
window.addEventListener("load", function () {
  setTimeout(() => {
    document.getElementById("loader").style.opacity = "0";
    setTimeout(() => {
      document.getElementById("loader").style.display = "none";
    }, 500);
  }, 1000);
});

// Services expansion functionality
function initServicesExpansion() {
  const serviceCards = document.querySelectorAll(".service-card");

  serviceCards.forEach((card) => {
    const expandBtn = card.querySelector(".expand-btn");
    const closeBtn = card.querySelector(".service-close");

    // Expand service card
    expandBtn.addEventListener("click", (e) => {
      e.stopPropagation();

      // Close any other expanded cards first
      serviceCards.forEach((otherCard) => {
        if (otherCard !== card) {
          otherCard.classList.remove("expanded", "expanding");
          const otherExpandBtn = otherCard.querySelector(".expand-btn");
          otherExpandBtn.innerHTML =
            '<i class="fas fa-info-circle"></i> Ver Más Info';
          otherExpandBtn.classList.remove("btn-service-outline");
        }
      });

      // Expand current card
      card.classList.add("expanding");
      setTimeout(() => {
        card.classList.add("expanded");
        card.classList.remove("expanding");

        // Scroll to the expanded card
        card.scrollIntoView({
          behavior: "smooth",
          block: "center",
        });
      }, 100);

      // Update button text and icon
      expandBtn.innerHTML = '<i class="fas fa-eye"></i> Ver Detalles';
      expandBtn.classList.add("btn-service-outline");
    });

    // Close service card
    closeBtn.addEventListener("click", (e) => {
      e.stopPropagation();
      card.classList.remove("expanded");

      // Reset button
      expandBtn.innerHTML = '<i class="fas fa-info-circle"></i> Ver Más Info';
      expandBtn.classList.remove("btn-service-outline");
    });

    // Close on outside click
    document.addEventListener("click", (e) => {
      if (card.classList.contains("expanded") && !card.contains(e.target)) {
        card.classList.remove("expanded");
        expandBtn.innerHTML = '<i class="fas fa-info-circle"></i> Ver Más Info';
        expandBtn.classList.remove("btn-service-outline");
      }
    });
  });
}

// Service cards animation on scroll
function initServiceCardsAnimation() {
  const serviceCards = document.querySelectorAll(".service-card");

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry, index) => {
        if (entry.isIntersecting) {
          setTimeout(() => {
            entry.target.style.opacity = "1";
            entry.target.style.transform = "translateY(0)";
          }, index * 100);
          observer.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.1 }
  );

  serviceCards.forEach((card, index) => {
    card.style.opacity = "0";
    card.style.transform = "translateY(30px)";
    card.style.transition = "opacity 0.6s ease, transform 0.6s ease";
    observer.observe(card);
  });
}

// Service counter animation
function animateServiceCounters() {
  const serviceStats = document.querySelectorAll(".service-stat-number");

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const counter = entry.target;
          const text = counter.textContent;
          const hasPlus = text.includes("+");
          const hasPercent = text.includes("%");
          const hasSlash = text.includes("/");

          if (hasSlash) {
            // For "24/7" type counters
            counter.style.opacity = "1";
            return;
          }

          const target = parseInt(text.replace(/[+%]/g, ""));
          if (isNaN(target)) return;

          const duration = 2000;
          const step = target / (duration / 16);
          let current = 0;

          const updateCounter = () => {
            if (current < target) {
              current += step;
              let displayValue = Math.floor(current);
              if (hasPlus) displayValue += "+";
              if (hasPercent) displayValue += "%";
              counter.textContent = displayValue;
              requestAnimationFrame(updateCounter);
            } else {
              counter.textContent = text;
            }
          };

          updateCounter();
          observer.unobserve(counter);
        }
      });
    },
    { threshold: 0.5 }
  );

  serviceStats.forEach((counter) => {
    counter.style.opacity = "0.3";
    observer.observe(counter);
  });
}

// Video modal functionality
function openVideoModal(videoId) {
  // Create modal HTML
  const modalHTML = `
                <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="videoModalLabel">Video Demostrativo</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-0">
                                <div class="ratio ratio-16x9">
                                    <div class="d-flex align-items-center justify-content-center bg-dark text-white">
                                        <div class="text-center">
                                            <i class="fas fa-video fa-4x mb-3 text-muted"></i>
                                            <h4>Video: ${videoId}</h4>
                                            <p class="text-muted">Aquí se reproduciría el video correspondiente</p>
                                            <small class="text-muted">ID del video: ${videoId}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

  // Remove existing modal if any
  const existingModal = document.getElementById("videoModal");
  if (existingModal) {
    existingModal.remove();
  }

  // Add modal to body
  document.body.insertAdjacentHTML("beforeend", modalHTML);

  // Show modal
  const modal = new bootstrap.Modal(document.getElementById("videoModal"));
  modal.show();

  // Remove modal from DOM when hidden
  document
    .getElementById("videoModal")
    .addEventListener("hidden.bs.modal", function () {
      this.remove();
    });
}

// Smooth scrolling for anchor links
function initSmoothScrolling() {
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute("href"));
      if (target) {
        target.scrollIntoView({
          behavior: "smooth",
          block: "start",
        });
      }
    });
  });
}

// Mouse cursor effect
function initCursorEffect() {
  const cursor = document.createElement("div");
  cursor.style.cssText = `
                position: fixed;
                width: 20px;
                height: 20px;
                background: var(--accent-color);
                border-radius: 50%;
                pointer-events: none;
                z-index: 9999;
                transition: transform 0.1s ease;
                opacity: 0;
            `;
  document.body.appendChild(cursor);

  document.addEventListener("mousemove", (e) => {
    cursor.style.left = e.clientX - 10 + "px";
    cursor.style.top = e.clientY - 10 + "px";
    cursor.style.opacity = "0.5";
  });

  document.addEventListener("mouseleave", () => {
    cursor.style.opacity = "0";
  });

  // Scale cursor on hover
  document
    .querySelectorAll("button, a, .service-card, .service-media-video")
    .forEach((el) => {
      el.addEventListener("mouseenter", () => {
        cursor.style.transform = "scale(2)";
      });
      el.addEventListener("mouseleave", () => {
        cursor.style.transform = "scale(1)";
      });
    });
}

// Add scroll indicator
function addScrollIndicator() {
  const indicator = document.createElement("div");
  indicator.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 0%;
                height: 4px;
                background: linear-gradient(90deg, var(--accent-color), var(--accent-tertiary));
                z-index: 9998;
                transition: width 0.1s ease;
            `;
  document.body.appendChild(indicator);

  window.addEventListener("scroll", () => {
    const scrollPercent =
      (window.scrollY /
        (document.documentElement.scrollHeight - window.innerHeight)) *
      100;
    indicator.style.width = scrollPercent + "%";
  });
}

// Image lazy loading
function initLazyLoading() {
  const images = document.querySelectorAll(
    '.service-media-image[style*="background-image"]'
  );

  const imageObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        const img = entry.target;
        img.style.opacity = "1";
        imageObserver.unobserve(img);
      }
    });
  });

  images.forEach((img) => {
    img.style.opacity = "0.3";
    img.style.transition = "opacity 0.6s ease";
    imageObserver.observe(img);
  });
}

// Initialize everything when DOM is loaded
document.addEventListener("DOMContentLoaded", function () {
  initServicesExpansion();
  initServiceCardsAnimation();
  animateServiceCounters();
  initSmoothScrolling();
  initCursorEffect();
  addScrollIndicator();
  initLazyLoading();
});

// Add some interactive hover effects
document.addEventListener("DOMContentLoaded", function () {
  // Add hover effect to service features
  const serviceFeatures = document.querySelectorAll(".service-feature");
  serviceFeatures.forEach((feature) => {
    feature.addEventListener("mouseenter", function () {
      this.style.background = "rgba(187,12,43,0.1)";
    });

    feature.addEventListener("mouseleave", function () {
      this.style.background = "rgba(227,197,202,0.1)";
    });
  });

  // Add interactive effect to service stats
  const serviceStats = document.querySelectorAll(".service-stat");
  serviceStats.forEach((stat) => {
    stat.addEventListener("mouseenter", function () {
      this.style.background = "rgba(255,255,255,0.9)";
    });

    stat.addEventListener("mouseleave", function () {
      this.style.background = "var(--text-light)";
    });
  });
});
