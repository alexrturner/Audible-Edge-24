document.addEventListener("DOMContentLoaded", function () {
  const audioButtons = document.querySelectorAll(".audio-button");
  const logos = document.querySelectorAll(".logo");
  let currentLogoIndex = 0;

  const changeLogo = () => {
    // hide logos
    logos.forEach((logo) => {
      logo.style.display = "none";
    });

    // show next logo
    currentLogoIndex = (currentLogoIndex + 1) % logos.length;
    logos[currentLogoIndex].style.display = "block";
  };

  audioButtons.forEach((button) => {
    button.addEventListener("click", function () {
      // stop all audio
      document.querySelectorAll("audio").forEach((audio) => {
        audio.pause();
        audio.currentTime = 0;
      });

      // play letter sound
      const audioElement = this.querySelector("audio");
      if (audioElement) {
        audioElement.play().catch((e) => {
          console.error("Error playing audio:", e);
          alert(
            "whoops - no sounds today. Please try again later or contact us for help."
          );
        });
      }
      changeLogo();
    });
  });
});

document.addEventListener("DOMContentLoaded", function () {
  var svgElement = document.querySelector("#logo-0 svg"); // get the logo
  var cls3Elements = svgElement.querySelectorAll(".cls-3"); // currently selects circles and paths

  var audioButtons = document.querySelectorAll(".audio-button");

  audioButtons.forEach((button) => {
    // Select a random .cls-3 element
    var rCircle = Math.floor(Math.random() * cls3Elements.length);
    var circle = cls3Elements[rCircle];

    // Get bounding box of the circle
    var bbox = circle.getBBox();

    // calc center of the bounding box
    var cx = bbox.x + bbox.width / 2;
    var cy = bbox.y + bbox.height / 2;

    // adjust for the SVG position on the page and scaling
    // assumes no viewBox scaling adjustment needed
    var svgRect = svgElement.getBoundingClientRect();

    // adjust for the SVG scaling and positioning
    var scaleX = svgRect.width / svgElement.viewBox.baseVal.width;
    var scaleY = svgRect.height / svgElement.viewBox.baseVal.height;
    var adjustedX = svgRect.left + cx * scaleX - button.offsetWidth;
    var adjustedY = svgRect.top + cy * scaleY - button.offsetHeight;

    // apply positions to buttons
    // button.style.position = "absolute";
    // button.style.left = `${adjustedX}px`;
    // button.style.top = `${adjustedY}px`;

    // var containerRect = document.body.getBoundingClientRect(); // Change `document.body` to your specific container if needed
    var containerRect = document
      .getElementById("svg-container")
      .getBoundingClientRect();

    var leftPercent =
      ((svgRect.left +
        cx * (svgRect.width / svgElement.viewBox.baseVal.width) -
        button.offsetWidth / 2) /
        containerRect.width) *
      100;
    var topPercent =
      ((svgRect.top +
        cy * (svgRect.height / svgElement.viewBox.baseVal.height) -
        button.offsetHeight / 2) /
        containerRect.height) *
      100;

    // Apply positions to buttons using percentage values
    button.style.position = "absolute";
    button.style.left = `${leftPercent}%`;
    button.style.top = `${topPercent}%`;
  });

  d3.selectAll(".audio-button").on("click", function () {
    var audioID = d3.select(this).select("audio").attr("id");
    var audioElement = document.getElementById(audioID);
    if (audioElement) {
      audioElement
        .play()
        .catch((e) => console.error("Error playing audio:", e));
    }
  });
});

// intro audio
function playPauseIntro(button) {
  const introAudioId = button.getAttribute("data-audio");
  const introAudio = document.getElementById(introAudioId);
  console.log(introAudio);
  if (introAudio.paused) {
    introAudio.play();
    button.style.backgroundColor = "var(--cc-primary)";
  } else {
    introAudio.pause();
    button.style.backgroundColor = "var(--cc-bg)";
  }

  // stop other intro audio & reset button bg colour
  document.querySelectorAll(".audio-intro").forEach((el) => {
    if (el.id !== introAudioId) {
      el.pause();
      el.currentTime = 0;
      el.nextElementSibling.style.backgroundColor = "var(--cc-bg)";
    }
  });
}

// shake shake shake
document.querySelectorAll("svg path").forEach((svg) => {
  svg.addEventListener("mouseenter", () => {
    const buttons = document.querySelectorAll(".audio-button");
    const randomButton = buttons[Math.floor(Math.random() * buttons.length)];

    // Generate random values for the animation to vary its effect
    const translateMax = 5 + Math.random() * 5; // Between 5px and 10px
    const rotateMax = 5 + Math.random() * 5; // Between 5deg and 10deg
    const duration = 0.5 + Math.random() * 0.5; // Between 0.5s and 1s

    // Apply the animation with variations
    randomButton.style.animation = `shake ${duration}s`;
    randomButton.style.animationIterationCount = "1";
    randomButton.addEventListener(
      "animationend",
      () => {
        // Remove the animation style to allow it to be reapplied next time
        randomButton.style.animation = "";
      },
      { once: true }
    );

    // Modify the keyframes directly or use inline styles for variations
  });
});

// STROKE / FILL COLOUR CHANJGE
const fillColors = [
  getComputedStyle(document.documentElement).getPropertyValue("--cc-olive"),
  getComputedStyle(document.documentElement).getPropertyValue(
    "--cc-olive-light"
  ),
  getComputedStyle(document.documentElement).getPropertyValue(
    "--cc-olive-highlight"
  ),
  getComputedStyle(document.documentElement).getPropertyValue("--cc-orange"),
  getComputedStyle(document.documentElement).getPropertyValue(
    "--cc-orange-light"
  ),
  getComputedStyle(document.documentElement).getPropertyValue(
    "--cc-orange-highlight"
  ),
  getComputedStyle(document.documentElement).getPropertyValue("--cc-purple"),
  getComputedStyle(document.documentElement).getPropertyValue(
    "--cc-purple-light"
  ),
  getComputedStyle(document.documentElement).getPropertyValue(
    "--cc-purple-highlight"
  ),
  getComputedStyle(document.documentElement).getPropertyValue("--cc-blue"),
  getComputedStyle(document.documentElement).getPropertyValue(
    "--cc-blue-light"
  ),
  getComputedStyle(document.documentElement).getPropertyValue(
    "--cc-blue-highlight"
  ),
];

const strokeColors = fillColors;
