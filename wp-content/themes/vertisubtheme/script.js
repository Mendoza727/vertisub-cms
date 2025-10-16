
document.addEventListener("visibilitychange", () => {
  if (document.visibilityState === "visible") {
    const chatBot = document.getElementById("chat-bot-launcher-container");
    if (chatBot) chatBot.style.zIndex = 10000; // asegurar que esté encima
  }
});

document.addEventListener("DOMContentLoaded", () => {
  const loader = document.getElementById("loader");
  const progressBar = document.querySelector(".progress-bar");
  const progressPercentage = document.querySelector(".progress-percentage");
  const letters = document.querySelectorAll(".letter");

  document.body.style.overflow = "hidden";
  document.documentElement.style.overflow = "hidden";

  // Animación de progreso con porcentaje
  let progress = 0;
  const progressInterval = setInterval(() => {
    progress += Math.random() * 15 + 5; // Incremento aleatorio para efecto más natural

    if (progress >= 100) {
      progress = 100;
      clearInterval(progressInterval);

      // Esperar un poco más antes de ocultar el loader
      setTimeout(() => {
        hideLoader();
      }, 150);
    }

    // Actualizar barra de progreso y porcentaje
    if (progressBar) {
      progressBar.style.width = progress + "%";
    }

    if (progressPercentage) {
      progressPercentage.textContent = Math.floor(progress) + "%";
    }
  }, 150); // Duración total de ~4-5 segundos

  // Función para ocultar el loader
  const hideLoader = () => {
    // Animación de salida de las letras
    letters.forEach((letter, index) => {
      setTimeout(() => {
        letter.style.animation = "letterExit 0.6s ease-in forwards";
      }, index * 100);
    });

    if (loader) {
      // Fade out del loader completo
      setTimeout(() => {

        loader.classList.add("fade-out");

        setTimeout(() => {
          loader.style.display = "none";
          document.body.classList.add("loaded");
          document.body.style.overflowY = "auto";
          document.documentElement.style.overflow = "visible";
          showMainContent();
          initNavbar();
          initVideoHero();
          initAboutSection();
          initBackToTop();
        }, 1000);
      }, 600);
    }

  };

  const showMainContent = () => {
    const mainContent = document.getElementById("main-content");
    if (mainContent) {
      setTimeout(() => {
        mainContent.classList.add("visible");
      }, 200);
    }
  };

  const initVideoHero = () => {
    const heroVideo = document.getElementById("hero-video");

    if (heroVideo) {
      // Intentar autoplay seguro
      heroVideo.play().catch((error) => {
        if (error.name !== "AbortError") {
          console.warn("Video autoplay failed:", error);
          // Mostrar fallback si autoplay no funciona
          const fallback = document.querySelector(".video-fallback");
          if (fallback) {
            fallback.style.display = "block";
            heroVideo.style.display = "none";
          }
        }
      });

      // Mostrar video suavemente cuando está listo
      heroVideo.addEventListener("loadeddata", () => {
        heroVideo.style.opacity = "1";
      });

      // Optimizar con IntersectionObserver
      const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            if (heroVideo.paused) {
              heroVideo.play().catch((err) => {
                if (err.name !== "AbortError") {
                  console.warn("Play failed:", err);
                }
              });
            }
          } else {
            if (!heroVideo.paused) {
              heroVideo.pause();
            }
          }
        });
      });

      observer.observe(heroVideo);
    }
  };

  const initAboutSection = () => {
    // Inicializar carrusel de certificaciones
    const initCertificationsCarousel = () => {
      const track = document.getElementById("certificationsTrack");
      if (!track) return;

      // Duplicar elementos para scroll infinito
      const items = track.children;
      const itemsArray = Array.from(items);

      // Clonar elementos para efecto infinito
      itemsArray.forEach((item) => {
        const clone = item.cloneNode(true);
        track.appendChild(clone);
      });

      // Pausar animación al hacer hover
      track.addEventListener("mouseenter", () => {
        track.style.animationPlayState = "paused";
      });

      track.addEventListener("mouseleave", () => {
        track.style.animationPlayState = "running";
      });
    };

    initCertificationsCarousel();

    initScrollEntranceAnimations();

    initScrollAnimations();

    initMissionVisionSection();

    // Inicializar animaciones de entrada
    initAboutAnimations();
  };

  const initMissionVisionSection = () => {
    const missionVisionSection = document.getElementById("mision-vision");
    if (!missionVisionSection) return;

    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("animate-in");
          }
        });
      },
      {
        threshold: 0.2, // Trigger when 20% of element is visible
        rootMargin: "0px 0px -50px 0px",
      }
    );

    observer.observe(missionVisionSection);
  };

  const initScrollEntranceAnimations = () => {
    const aboutSection = document.getElementById("nosotros");
    const certificationsCarousel = document.querySelector(
      ".certifications-carousel"
    );
    const aboutTitleSection = document.querySelector(".about-title-section");
    const workItemsContainer = document.querySelector(".work-items-container");

    // Create intersection observer for scroll entrance animations
    const entranceObserver = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            // Add animate-in class when element comes into view
            entry.target.classList.add("animate-in");

            // Special handling for about section components
            if (entry.target.id === "nosotros") {
              // Animate title section with delay
              setTimeout(() => {
                if (aboutTitleSection) {
                  aboutTitleSection.classList.add("animate-in");
                }
              }, 200);

              // Animate work items container with delay
              setTimeout(() => {
                if (workItemsContainer) {
                  workItemsContainer.classList.add("animate-in");
                }
              }, 400);
            }
          }
        });
      },
      {
        threshold: 0.1, // Trigger when 10% of element is visible
        rootMargin: "0px 0px -50px 0px", // Start animation slightly before element is fully visible
      }
    );

    // Observe elements for entrance animations
    if (aboutSection) {
      entranceObserver.observe(aboutSection);
    }

    if (certificationsCarousel) {
      entranceObserver.observe(certificationsCarousel);
    }
  };

  const initScrollAnimations = () => {
    const aboutSection = document.getElementById("nosotros");
    if (!aboutSection) return;

    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            aboutSection.classList.add("animate-in");
            aboutSection.classList.remove("animate-out");
          } else {
            const rect = entry.boundingClientRect;
            const windowHeight = window.innerHeight;

            // Only animate out if section is completely above or below viewport
            if (rect.bottom < 0 || rect.top > windowHeight) {
              aboutSection.classList.add("animate-out");
              aboutSection.classList.remove("animate-in");
            }
          }
        });
      },
      {
        threshold: 0.05,
        rootMargin: "0px 0px 0px 0px",
      }
    );

    observer.observe(aboutSection);

    let ticking = false;
    const handleScroll = () => {
      const scrolled = window.pageYOffset;
      const aboutRect = aboutSection.getBoundingClientRect();
      const windowHeight = window.innerHeight;

      if (aboutRect.bottom > 0 && aboutRect.top < windowHeight) {
        const scrollProgress = Math.max(
          0,
          Math.min(1, (windowHeight - aboutRect.top) / windowHeight)
        );

        if (scrollProgress > 0) {
          const translateY = scrollProgress * 15; // Reduced parallax intensity
          aboutSection.style.transform = `translateY(-${translateY}px)`;
        }
      }

      ticking = false;
    };

    window.addEventListener("scroll", () => {
      if (!ticking) {
        requestAnimationFrame(handleScroll);
        ticking = true;
      }
    });
  };

  const initAboutAnimations = () => {
    // Animaciones de entrada para elementos de la sección nosotros
    const aboutTitle = document.querySelector(".about-title");
    const aboutSubtitle = document.querySelector(".about-subtitle");
    const workItems = document.querySelectorAll(".work-item");

    // Observer para activar animaciones cuando entren en vista
    const animationObserver = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.style.animationPlayState = "running";
          }
        });
      },
      {
        threshold: 0.3,
      }
    );

    // Observar elementos para animaciones
    if (aboutTitle) animationObserver.observe(aboutTitle);
    if (aboutSubtitle) animationObserver.observe(aboutSubtitle);

    workItems.forEach((item) => {
      animationObserver.observe(item);
    });
  };

  const initBackToTop = () => {
    const backToTopButton = document.getElementById("backToTop");
    if (!backToTopButton) return;

    // Show/hide button based on scroll position
    const toggleButton = () => {
      if (window.pageYOffset > 300) {
        backToTopButton.classList.add("show");
      } else {
        backToTopButton.classList.remove("show");
      }
    };

    // Smooth scroll to top
    const scrollToTop = () => {
      window.scrollTo({
        top: 0,
        behavior: "smooth",
      });
    };

    // Event listeners
    window.addEventListener("scroll", toggleButton);
    backToTopButton.addEventListener("click", scrollToTop);

    // Initial check
    toggleButton();
  };

  const initNavbar = () => {
    const navbar = document.getElementById("navbar");
    const hamburger = document.getElementById("hamburger");
    const offcanvas = document.getElementById("offcanvas");
    const overlay = document.getElementById("overlay");
    const closeOffcanvas = document.getElementById("closeOffcanvas");
    const navLinks = document.querySelectorAll(".nav-link");
    const desktopNavLinks = document.querySelector(".nav-links");

    if (navbar) {
      navbar.style.willChange = "auto";
      navbar.style.backfaceVisibility = "hidden";
      navbar.style.position = "fixed";
      navbar.style.top = "0";
      navbar.style.left = "0";
      navbar.style.right = "0";
      navbar.style.zIndex = "1000";
    }

    // Scroll listener mejorado que no afecta la posición del nav
    let lastScrollTop = 0;
    window.addEventListener("scroll", () => {
      const scrollTop =
        window.pageYOffset || document.documentElement.scrollTop;

      if (scrollTop > 100) {
        navbar.classList.add("scrolled");
      } else {
        navbar.classList.remove("scrolled");
      }

      navbar.style.transform = "none !important";
      navbar.style.position = "fixed !important";
      navbar.style.top = "0 !important";

      lastScrollTop = scrollTop;
    });

    // Abrir offcanvas
    const openOffcanvas = () => {
      hamburger.classList.add("active");
      offcanvas.classList.add("active");
      overlay.classList.add("active");

      const bot = document.getElementById("chat-bot-launcher-button");
      const bot2 = document.getElementById("chat-bot-launcher"); // sin #

      document.body.style.overflow = "hidden";
      if (bot) bot.style.visibility = "hidden"; // ocultar bot
      if (bot2)
        bot2.style.setProperty("background-color", "transparent", "important"); // transparente

      if (desktopNavLinks) {
        desktopNavLinks.style.opacity = "0";
        desktopNavLinks.style.visibility = "hidden";
      }

      // Reiniciar animaciones de los nav items
      const navItems = document.querySelectorAll(".nav-item");
      navItems.forEach((item, index) => {
        item.style.animation = "none";
        setTimeout(() => {
          item.style.animation = `slideInRight 0.6s ease forwards`;
          item.style.animationDelay = `${0.1 + index * 0.1}s`;
        }, 50);
      });
    };

    // Cerrar offcanvas
    const closeOffcanvasMenu = () => {
      hamburger.classList.remove("active");
      offcanvas.classList.remove("active");
      overlay.classList.remove("active");
      document.body.style.overflow = "auto";

      const bot = document.getElementById("chat-bot-launcher-button");
      const bot2 = document.getElementById("chat-bot-launcher");

      if (bot) bot.style.visibility = "visible"; // volver a mostrar
      if (bot2)
        bot2.style.setProperty("background-color", "#bb0c2b", "important"); // color original

      if (desktopNavLinks) {
        desktopNavLinks.style.opacity = "1";
        desktopNavLinks.style.visibility = "visible";
      }
    };

    // Event listeners
    if (hamburger) hamburger.addEventListener("click", openOffcanvas);
    if (closeOffcanvas)
      closeOffcanvas.addEventListener("click", closeOffcanvasMenu);
    if (overlay) overlay.addEventListener("click", closeOffcanvasMenu);

    // Cerrar offcanvas al hacer click en un link
    navLinks.forEach((link) => {
      link.addEventListener("click", (e) => {
        const parentItem = link.closest(".nav-item");

        // Si el item tiene sublinks (has-dropdown), no cierres el offcanvas
        if (parentItem && parentItem.classList.contains("has-dropdown")) {
          e.preventDefault(); // Evita navegar inmediatamente
          parentItem.classList.toggle("active"); // Abre/cierra submenu
          return; // ⛔ salimos sin cerrar
        }

        // Si NO tiene sublinks => sí cerramos
        const href = link.getAttribute("href");

        if (href.startsWith("#")) {
          // solo links internos
          e.preventDefault();
          closeOffcanvasMenu();

          const targetElement = document.getElementById(href.substring(1));
          if (targetElement) {
            targetElement.scrollIntoView({
              behavior: "smooth",
              block: "start",
            });
          }
        } else {
          // Links externos o páginas completas
          closeOffcanvasMenu();
        }
      });
    });

    // Cerrar offcanvas con tecla Escape
    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape" && offcanvas.classList.contains("active")) {
        closeOffcanvasMenu();
      }
    });
  };

  // Efecto de hover en las letras durante la carga
  letters.forEach((letter) => {
    letter.addEventListener("mouseenter", () => {
      letter.style.transform = "scale(1.1) rotateY(10deg)";
      letter.style.color = "var(--accent-color)";
    });

    letter.addEventListener("mouseleave", () => {
      letter.style.transform = "scale(1) rotateY(0deg)";
      letter.style.color = "var(--primary-color)";
    });
  });

  // Efecto de pulsación en el loader
  setTimeout(() => {
    const loaderContent = document.querySelector(".loader-content");
    if (loaderContent) {
      loaderContent.style.animation = "pulse 2s ease-in-out infinite";
    }
  }, 2000);

  // Agregar estilos dinámicos
  const style = document.createElement("style");
  style.textContent = `
    @keyframes letterExit {
      0% {
        opacity: 1;
        transform: scale(1) rotateY(0deg) translateY(0);
      }
      100% {
        opacity: 0;
        transform: scale(0.8) rotateY(-90deg) translateY(-30px);
      }
    }
    
    @keyframes pulse {
      0%, 100% {
        transform: scale(1);
      }
      50% {
        transform: scale(1.02);
      }
    }
    
    @keyframes animateIn {
      0% {
        opacity: 0;
        transform: translateY(50px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    @keyframes animateOut {
      0% {
        opacity: 1;
        transform: translateY(0);
      }
      100% {
        opacity: 0;
        transform: translateY(50px);
      }
    }
  `;
  document.head.appendChild(style);
});
