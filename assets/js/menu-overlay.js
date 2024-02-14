document.addEventListener("DOMContentLoaded", function () {
  // non-home pages - toggle overlay on menu click
  const toggleButton = document.querySelector(".menu-toggle");
  const overlay = document.querySelector(".overlay");

  toggleButton.addEventListener("click", function () {
    const isOpen = overlay.style.visibility === "visible";
    overlay.style.opacity = isOpen ? "0" : "1";
    overlay.style.visibility = isOpen ? "hidden" : "visible";
  });
});