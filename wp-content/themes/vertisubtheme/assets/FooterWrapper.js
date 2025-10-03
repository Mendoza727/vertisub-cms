import { useEffect, useState } from "react";
import React from "react";

export function FooterWrapper() {
  const [html, setHtml] = useState("");

  useEffect(() => {
    fetch("../footer-endpoint/")
      .then(res => res.text())
      .then(data => setHtml(data))
      .catch(err => console.error("Error cargando footer:", err));
  }, []);

  // React.createElement evita JSX
  return React.createElement("div", { dangerouslySetInnerHTML: { __html: html } });
}
