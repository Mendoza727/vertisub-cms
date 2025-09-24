// Initialize AOS
AOS.init({
  duration: 1000,
  easing: "ease-out-cubic",
  once: true,
  offset: 50,
});

// Counter Animation
function animateCounters() {
  const counters = document.querySelectorAll(".stat-number[data-count]");

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const counter = entry.target;
          const target = parseInt(counter.getAttribute("data-count"));
          const duration = 2000;
          const step = target / (duration / 16);
          let current = 0;

          const updateCounter = () => {
            if (current < target) {
              current += step;
              counter.textContent = Math.floor(current).toLocaleString();
              requestAnimationFrame(updateCounter);
            } else {
              counter.textContent = target.toLocaleString();
            }
          };

          updateCounter();
          observer.unobserve(counter);
        }
      });
    },
    { threshold: 0.5 }
  );

  counters.forEach((counter) => observer.observe(counter));
}

// Custom scroll animations
function initScrollAnimations() {
  const elements = document.querySelectorAll(".fade-up, .scale-up");

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("animate");
          observer.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.1 }
  );

  elements.forEach((el) => observer.observe(el));
}

// Parallax effect for hero section
function initParallax() {
  window.addEventListener("scroll", () => {
    const scrolled = window.pageYOffset;
    const rate = scrolled * -0.5;
    const hero = document.querySelector(".hero-section");
    if (hero) {
      hero.style.transform = `translateY(${rate}px)`;
    }
  });
}

// Smooth scrolling for anchor links
function initSmoothScrolling() {
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      const href = this.getAttribute("href");

      // ❌ skip if just "#"
      if (href === "#") return;

      e.preventDefault();
      const target = document.querySelector(href);
      if (target) {
        target.scrollIntoView({
          behavior: "smooth",
          block: "start",
        });
      }
    });
  });
}

// Form submission handler
function initFormHandlers() {
  const quoteForm = document.querySelector(".quote-form");
  if (quoteForm) {
    quoteForm.addEventListener("submit", function (e) {
      e.preventDefault();

      // Show success message
      const submitBtn = this.querySelector('button[type="submit"]');
      const originalText = submitBtn.textContent;

      submitBtn.textContent = "Enviando...";
      submitBtn.disabled = true;

      setTimeout(() => {
        submitBtn.textContent = "¡Enviado!";
        submitBtn.classList.add("btn-success");

        setTimeout(() => {
          // Reset form
          this.reset();
          submitBtn.textContent = originalText;
          submitBtn.disabled = false;
          submitBtn.classList.remove("btn-success");

          // Close modal
          const modal = bootstrap.Modal.getInstance(
            document.getElementById("quoteModal")
          );
          modal.hide();
        }, 2000);
      }, 1500);
    });
  }
}

// Add floating elements animation
function createFloatingElements() {
  const hero = document.querySelector(".sancho-hero-banner");
  if (hero) {
    for (let i = 0; i < 5; i++) {
      const element = document.createElement("div");
      element.style.cssText = `
                        position: absolute;
                        width: ${Math.random() * 10 + 5}px;
                        height: ${Math.random() * 10 + 5}px;
                        background: rgba(227,197,202,0.3);
                        border-radius: 50%;
                        left: ${Math.random() * 100}%;
                        top: ${Math.random() * 100}%;
                        animation: float ${
                          Math.random() * 3 + 4
                        }s ease-in-out infinite;
                        animation-delay: ${Math.random() * 2}s;
                    `;
      hero.appendChild(element);
    }
  }
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
    .querySelectorAll("button, a, .team-card, .stat-card")
    .forEach((el) => {
      el.addEventListener("mouseenter", () => {
        cursor.style.transform = "scale(2)";
      });
      el.addEventListener("mouseleave", () => {
        cursor.style.transform = "scale(1)";
      });
    });
}

// Initialize everything when DOM is loaded
document.addEventListener("DOMContentLoaded", function () {
  animateCounters();
  initScrollAnimations();
  initParallax();
  initSmoothScrolling();
  initFormHandlers();
  createFloatingElements();
  initCursorEffect();
});

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

// Initialize scroll indicator
addScrollIndicator();
