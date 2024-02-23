<button id="settingsButton" class="pseudo-list-item" style="visibility:hidden;">Settings</button>
<div id="settingsContainer" class="hidden" style="visibility:hidden;">
    <div><label for="noiseIntensity">Noise Intensity: </label><span id="noiseIntensityValue">80</span></div>
    <input type="range" id="noiseIntensity" name="noiseIntensity" min="0" max="1000" step="10" value="80">

    <div><label for="subdivisionFactor">Subdivision Factor: </label><span id="subdivisionFactorValue">3</span></div>
    <input type="range" id="subdivisionFactor" name="subdivisionFactor" min="1" max="20" value="3">

    <button class="button circle-button" id="toggleSquig"></button>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var settingsButton = document.getElementById("settingsButton");
        var settingsContainer = document.getElementById("settingsContainer");

        settingsButton.addEventListener("click", function() {
            settingsContainer.classList.toggle("hidden");
            settingsButton.classList.toggle("inactive");
            if (settingsContainer.style.visibility === "visible") {
                settingsContainer.style.visibility = "hidden";
            } else
                settingsContainer.style.visibility = "visible";

        });
    });
</script>