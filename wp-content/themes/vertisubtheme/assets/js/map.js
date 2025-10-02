// Global chart variable for map control
let globalChart = null;

console.log("Contact Data:", contactData);

// Obtener colores desde CSS :root
const rootStyles = getComputedStyle(document.documentElement);
const palette = [rootStyles.getPropertyValue("--accent-color").trim()];

// Function to get country color based on status
function getCountryColor(status) {
  switch (status) {
    case "main":
      return "#bb0c2b";
    case "regional":
      return "#bc7ece";
    case "partner":
      return "#e3c5ca";
    default:
      return "#aaa8a9";
  }
}

const countryColors = {};
let paletteIndex = 0;

function getPaletteColor(code) {
  if (!countryColors[code]) {
    // Asigna el siguiente color disponible
    countryColors[code] = palette[paletteIndex % palette.length];
    paletteIndex++;
  }
  return countryColors[code];
}

// Function to initialize map
function initializeMap() {
  if (typeof am5 === "undefined") {
    console.error("amCharts no está cargado correctamente");
    document.getElementById("loadingIndicator").innerHTML =
      '<i class="fas fa-exclamation-triangle"></i> <span style="margin-left: 10px;">Error al cargar el mapa</span>';
    return;
  }

  document.getElementById("loadingIndicator").classList.add("hidden");

  var root = am5.Root.new("chartdiv");

  root.setThemes([am5themes_Animated.new(root)]);

  var chart = root.container.children.push(
    am5map.MapChart.new(root, {
      panX: "translateX",
      panY: "translateY",
      projection: am5map.geoMercator(),
      homeZoomLevel: 2.5, // 👈 más zoom
      homeGeoPoint: { longitude: -60, latitude: 0 },
    })
  );

  // Esperar a que el mapa esté listo y aplicar zoom inicial
  chart.events.on("datavalidated", function () {
    chart.goHome();
  });

  var polygonSeries = chart.series.push(
    am5map.MapPolygonSeries.new(root, {
      geoJSON: am5geodata_worldLow,
      exclude: ["AQ"],
    })
  );

  polygonSeries.mapPolygons.template.setAll({
    tooltipText: "{name}",
    toggleKey: "active",
    interactive: true,
    fill: am5.color("#aaa8a9"),
    stroke: am5.color("#ffffff"),
    strokeWidth: 1,
  });

  // Deshabilitar países que no estén en contactData
  polygonSeries.mapPolygons.template.adapters.add(
    "interactive",
    function (interactive, target) {
      const countryCode = target.dataItem?.dataContext?.id?.toLowerCase();
      return !!(countryCode && contactData[countryCode]); // solo true si existe en contactData
    }
  );

  // Quitar tooltip para países sin contacto
  polygonSeries.mapPolygons.template.adapters.add(
    "tooltipText",
    function (text, target) {
      const countryCode = target.dataItem?.dataContext?.id?.toLowerCase();
      return countryCode && contactData[countryCode] ? "{name}" : null;
    }
  );

  // Colorear: países habilitados con su color, deshabilitados gris claro
  polygonSeries.mapPolygons.template.adapters.add(
    "fill",
    function (fill, target) {
      const countryCode = target.dataItem?.dataContext?.id?.toLowerCase();
      if (countryCode && contactData[countryCode]) {
        return am5.color(getPaletteColor(countryCode));
      }
      return am5.color("#e0e0e0"); // color gris para deshabilitados
    }
  );

  polygonSeries.mapPolygons.template.adapters.add(
    "fill",
    function (fill, target) {
      const countryCode = target.dataItem?.dataContext?.id?.toLowerCase();
      if (contactData[countryCode]) {
        return am5.color(getPaletteColor(countryCode));
      }
      return fill;
    }
  );

  polygonSeries.mapPolygons.template.states.create("hover", {
    fill: am5.color("#bb1447"),
    stroke: am5.color("#ffffff"),
    strokeWidth: 2,
  });

  polygonSeries.mapPolygons.template.states.create("active", {
    fill: am5.color("#bb1447"),
  });

  var previousPolygon;
  polygonSeries.mapPolygons.template.on("active", function (active, target) {
    if (previousPolygon && previousPolygon != target) {
      previousPolygon.set("active", false);
    }
    if (target.get("active")) {
      var countryCode = target.dataItem?.dataContext?.id.toLowerCase();
      if (contactData[countryCode]) {
        showContactModal(countryCode);
        polygonSeries.zoomToDataItem(target.dataItem);
      }
    } else {
      chart.goHome();
    }
    previousPolygon = target;
  });

  // 📍 Serie de markers
  var pointSeries = chart.series.push(
    am5map.MapPointSeries.new(root, {
      valueField: "value",
      polygonIdField: "id",
    })
  );

  pointSeries.bullets.push(function () {
    return am5.Bullet.new(root, {
      sprite: am5.Circle.new(root, {
        radius: 10,
        fill: am5.color(0xbb0c2b),
        stroke: am5.color(0xffffff),
        strokeWidth: 2,
      }),
    });
  });

  // Cargar markers en países que están en contactData
  const markerData = Object.keys(contactData).map((code) => {
    return {
      id: code.toUpperCase(), // debe coincidir con ID en geoJSON (ej: "CO", "PE")
      value: 1,
    };
  });

  pointSeries.data.setAll(markerData);

  var zoomControl = chart.set("zoomControl", am5map.ZoomControl.new(root, {}));
  zoomControl.homeButton.set("visible", true);

  chart.chartContainer.get("background").events.on("click", function () {
    chart.goHome();
  });

  chart.appear(1000, 100);
}

// Enhanced function to show contact modal
function showContactModal(countryCode) {
  const contact = contactData[countryCode];
  if (!contact) return;

  // Update modal header
  document.getElementById("modalTitle").textContent = contact.name;
  document.getElementById("countryFlag").src = contact.flag;
  document.getElementById("countryFlag").alt = `Bandera de ${contact.name}`;

  // Update contact grid
  const contactGrid = document.getElementById("contactGrid");
  contactGrid.innerHTML = "";

  for (const [key, contactInfo] of Object.entries(contact.contacts)) {
    const contactItem = document.createElement("div");
    contactItem.className = "contact-item";

    if (contactInfo.multiple) {
      // Handle multiple contacts (phones or whatsapp)
      let content = "";
      if (key === "phones") {
        content = `
                            <div class="contact-list">
                                ${contactInfo.values
                                  .map(
                                    (phone) => `
                                    <div class="contact-list-item">
                                        <strong>${phone.label}:</strong>
                                        <a href="${phone.link}">${phone.number}</a>
                                    </div>
                                `
                                  )
                                  .join("")}
                            </div>
                        `;
      } else if (key === "whatsapp") {
        content = `
                            <div class="whatsapp-list">
                                ${contactInfo.values
                                  .map(
                                    (wa) => `
                                    <a href="${wa.link}" target="_blank" class="whatsapp-btn">
                                        <i class="fab fa-whatsapp"></i>
                                        ${wa.number}
                                    </a>
                                `
                                  )
                                  .join("")}
                            </div>
                        `;
      }

      contactItem.innerHTML = `
                        <div class="contact-icon">
                            <i class="fas fa-${contactInfo.icon}"></i>
                        </div>
                        <div class="contact-details">
                            <div class="contact-label">${contactInfo.label}</div>
                            <div class="contact-value">${content}</div>
                        </div>
                    `;
    } else {
      // Handle single contacts (address, email)
      contactItem.innerHTML = `
                        <div class="contact-icon">
                            <i class="fas fa-${contactInfo.icon}"></i>
                        </div>
                        <div class="contact-details">
                            <div class="contact-label">${contactInfo.label}</div>
                            <div class="contact-value">${contactInfo.value}</div>
                        </div>
                    `;
    }

    contactGrid.appendChild(contactItem);
  }

  // Show modal
  document.getElementById("contactModal").classList.add("show");
  document.body.style.overflow = "hidden";
}

// Enhanced function to close modal and center map
function closeModal() {
  document.getElementById("contactModal").classList.remove("show");
  document.body.style.overflow = "auto";

  // Center the map when modal is closed
  if (globalChart) {
    setTimeout(function () {
      globalChart.goHome();
    }, 300);
  }
}

// Event listeners
document.getElementById("contactModal").addEventListener("click", function (e) {
  if (e.target === this) {
    closeModal();
  }
});

document.addEventListener("keydown", function (e) {
  if (e.key === "Escape") {
    closeModal();
  }
});

// Initialize map when loaded
document.addEventListener("DOMContentLoaded", function () {
  setTimeout(function () {
    if (typeof am5 !== "undefined") {
      am5.ready(function () {
        initializeMap();
      });
    } else {
      console.error("amCharts no se cargó correctamente");
      document.getElementById("loadingIndicator").innerHTML =
        '<i class="fas fa-exclamation-triangle"></i> <span style="margin-left: 10px;">Error al cargar las librerías del mapa</span>';
    }
  }, 100);
});
