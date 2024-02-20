// Function to add custom scroll handling
function addCustomScrollHandling() {
  let touchStartY = 0;

  window.addEventListener(
    "touchstart",
    function (e) {
      touchStartY = e.touches[0].clientY;
    },
    { passive: false }
  );

  window.addEventListener(
    "touchmove",
    function (e) {
      e.preventDefault();
      var touchEndY = e.touches[0].clientY;
      var deltaY = touchStartY - touchEndY;
      var col3 = document.getElementById("col3");
      col3.scrollTop += deltaY;
      touchStartY = touchEndY;
    },
    { passive: false }
  );

  window.addEventListener(
    "wheel",
    function (e) {
      e.preventDefault();
      var col3 = document.getElementById("col3");
      col3.scrollTop += e.deltaY;
    },
    { passive: false }
  );
}

// Check if the screen width is 768px or more
if (window.innerWidth >= 768) {
  addCustomScrollHandling();
}

// Optionally, handle window resizing
window.addEventListener("resize", function () {
  // You may want to add or remove the custom scroll handling based on new width
  if (window.innerWidth >= 768) {
    // Add or re-confirm custom scroll handling
    addCustomScrollHandling();
  } else {
    // Consider removing custom scroll handling or ensuring it's not added
    // Note: Removing event listeners requires keeping references to them, not covered here
  }
});
