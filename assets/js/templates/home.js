var settingsButton = document.getElementById("settingsButton");
var inputContainer = document.getElementById("input");

settingsButton.addEventListener("click", function () {
  inputContainer.classList.toggle("hidden");
});
