document.addEventListener("DOMContentLoaded", function () {
  // toggle visibility of sections
  function toggleSection(button) {
    // toggle aria-expanded state
    const isExpanded = button.getAttribute("aria-expanded") === "true";
    button.setAttribute("aria-expanded", !isExpanded);

    // show/hide the section
    const sectionId = button.getAttribute("aria-controls");
    const sectionItems = document.getElementById(sectionId);

    // display flex for non-homepage menu-items, block for others
    if (sectionId === "menu-items") {
      if (sectionItems.classList.contains("flex")) {
        sectionItems.style.display = isExpanded ? "none" : "flex";
      }
    } else {
      sectionItems.style.display = isExpanded ? "none" : "block";
    }
    // update parent li class
    var parent = button.closest("li.first-item");
    if (parent) {
      parent.classList.toggle("list-style-circle", isExpanded);
    }
  }

  // attach event listeners to all toggle buttons
  document.querySelectorAll(".toggle").forEach(function (toggle) {
    toggle.addEventListener("click", function () {
      toggleSection(this);
    });
  });
});
