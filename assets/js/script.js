document.addEventListener("DOMContentLoaded", function () {
  // function to toggle styles
  const togglePlainText = document.getElementById("togglePlainTextView");
  const settingsButton = document.getElementById("settingsButton");

  togglePlainText.addEventListener("click", function () {
    const isDisabled = localStorage.getItem("stylesDisabled") === "true";
    // Toggle the disabled state based on the opposite of the current state
    for (let i = 0; i < document.styleSheets.length; i++) {
      document.styleSheets[i].disabled = !isDisabled;
    }
    // Save the new state in localStorage
    localStorage.setItem("stylesDisabled", !isDisabled);
    settingsButton.style.display = !isDisabled
      ? "block !important"
      : "none !important";
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
function initSections() {
  const isMobile = window.innerWidth <= 768;
  const sections = document.querySelectorAll("[aria-controls]");

  sections.forEach((button) => {
    const sectionId = button.getAttribute("aria-controls");
    const sectionItems = document.getElementById(sectionId);

    // if (isMobile) {
    //   // collapse section items & set aria-expanded to false on mobile
    //   sectionItems.style.display = "none";
    //   button.setAttribute("aria-expanded", "false");

    //   // style collapsed sections
    //   const parent = button.closest("li.first-item");
    //   if (parent) {
    //     parent.classList.add("list-style-circle");
    //   }
    // } else {
    //   // style collapsed sections for desktop
    //   const isExpanded = button.getAttribute("aria-expanded") === "true";
    //   const parent = button.closest("li.first-item");
    //   if (parent) {
    //     parent.classList.toggle("list-style-circle", !isExpanded);
    //   }
    // }

    // style collapsed sections for desktop
    const isExpanded = button.getAttribute("aria-expanded") === "true";
    const parent = button.closest("li.first-item");
    if (parent) {
      parent.classList.toggle("list-style-circle", !isExpanded);
    }
  });
}

document.addEventListener("DOMContentLoaded", function () {
  initSections();
});
