document.addEventListener("DOMContentLoaded", function () {
  // function to toggle styles
  const toggleStyles = document.getElementById("toggleStyles");

  toggleStyles.addEventListener("click", function () {
    for (let i = 0; i < document.styleSheets.length; i++) {
      document.styleSheets[i].disabled = !document.styleSheets[i].disabled;
    }
  });

  // function to toggle visibility of sections
  function toggleSection(button) {
    // toggle aria-expanded attribute of button
    const isExpanded = button.getAttribute("aria-expanded") === "true";
    button.setAttribute("aria-expanded", !isExpanded);

    // show/hide the related section content
    // toggle display on mobile, and visibility on desktop to avoid layout issues
    const sectionId = button.getAttribute("aria-controls");
    const sectionItems = document.getElementById(sectionId);

    const isMobile = window.innerWidth <= 768;

    if (isMobile) {
      sectionItems.style.display = isExpanded ? "none" : "block";
    } else {
      if (isExpanded) {
        sectionItems.style.opacity = "0";
        sectionItems.style.visibility = "hidden";
        sectionItems.style.pointerEvents = "none";
      } else {
        sectionItems.style.opacity = "1";
        sectionItems.style.visibility = "visible";
        sectionItems.style.pointerEvents = "all";
      }
    }

    // update button list-style
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
function initializeSections() {
  const isMobile = window.innerWidth <= 768; // Define mobile viewport width threshold
  const sections = document.querySelectorAll("[aria-controls]");

  sections.forEach((button) => {
    const sectionId = button.getAttribute("aria-controls");
    const sectionItems = document.getElementById(sectionId);

    if (isMobile) {
      // Collapse section items and set aria-expanded to false on mobile
      sectionItems.style.display = "none";
      button.setAttribute("aria-expanded", "false");

      // Ensure the parent li has the correct list style
      const parent = button.closest("li.first-item");
      if (parent) {
        parent.classList.add("list-style-circle");
      }
    } else {
      // On desktop, make sure the appropriate style is applied based on the expanded state
      const isExpanded = button.getAttribute("aria-expanded") === "true";
      const parent = button.closest("li.first-item");
      if (parent) {
        parent.classList.toggle("list-style-circle", !isExpanded);
      }
    }
  });
}

document.addEventListener("DOMContentLoaded", function () {
  initializeSections();
});
