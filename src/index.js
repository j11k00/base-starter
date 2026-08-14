/**
 * Site-owned frontend entry (the starter a new site copies). base-kit ships
 * no JS beyond its Panel block assets — Alpine and all behavior live here.
 * A consuming site must depend on `alpinejs` + `@alpinejs/intersect`.
 */
import "./index.css";
import Alpine from "alpinejs";
import intersect from "@alpinejs/intersect";

Alpine.plugin(intersect);

Alpine.data("themeToggle", () => ({
  isDark: document.documentElement.getAttribute("data-theme") === "dark",
  toggle() {
    this.isDark = !this.isDark;
    const theme = this.isDark ? "dark" : "light";
    document.documentElement.setAttribute("data-theme", theme);
    localStorage.setItem("theme", theme);
  },
}));

// Alpine devtools / x-data in templates expect the global
window.Alpine = Alpine;

// Site-specific JS and Alpine components go here, before Alpine.start().

Alpine.start();
