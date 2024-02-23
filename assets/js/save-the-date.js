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
  // select the SVG, dots and audio buttons
  // var svgElement = document.querySelector("#logo-0 svg");
  // var cls3Elements = svgElement.querySelectorAll(".cls-3");
  var svgElement = document.querySelector("#dots svg");
  // var cls3Elements = svgElement.querySelectorAll(".st0");
  var cls3Elements = svgElement.querySelectorAll("#dots path");
  var audioButtons = document.querySelectorAll(".audio-button");

  function isOverlapping(elem1, elem2) {
    const rect1 = elem1.getBoundingClientRect();
    const rect2 = elem2.getBoundingClientRect();

    return !(
      rect1.right < rect2.left ||
      rect1.left > rect2.right ||
      rect1.bottom < rect2.top ||
      rect1.top > rect2.bottom
    );
  }

  audioButtons.forEach((button) => {
    const screenWidth = window.innerWidth;
    let attempts = 0;
    const maxAttempts = 50;

    function setPosition(circle) {
      var bbox = circle.getBBox();
      var cx = bbox.x + bbox.width / 2;
      var cy = bbox.y + bbox.height / 2;
      var svgRect = svgElement.getBoundingClientRect();

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

      button.style.position = "absolute";
      button.style.left = `${leftPercent}%`;
      button.style.top = `${topPercent}%`;
    }

    if (screenWidth < 769) {
      // smaller screens: place the button on path
      var rCircle = Math.floor(Math.random() * cls3Elements.length);
      var circle = cls3Elements[rCircle];
      setPosition(circle);
    } else {
      // larger screens: find a non-overlapping position
      let placed = false;
      let lastCircle = null;
      while (!placed && attempts < maxAttempts) {
        var rCircle = Math.floor(Math.random() * cls3Elements.length);
        var circle = cls3Elements[rCircle];
        setPosition(circle);
        lastCircle = circle;

        let overlap = Array.from(audioButtons).some((otherButton) => {
          return otherButton !== button && isOverlapping(button, otherButton);
        });

        // if (!overlap) {
        //   const audioButtonTexts =
        //     document.querySelectorAll(".audio-button-text");
        //   overlap = Array.from(audioButtonTexts).some((span) => {
        //     return isOverlapping(button, span);
        //   });
        // }

        if (!overlap) {
          placed = true; // found a non-overlapping position
        } else {
          attempts++;
        }
      }
      // failsafe: place the button at the last attempted position
      if (attempts === maxAttempts) {
        setPosition(lastCircle);
        console.log("overlapping audio!");
      }
    }
  });

  d3.selectAll(".audio-button").on("click", function () {
    var audioID = d3.select(this).select("audio").attr("id");
    var audioElement = document.getElementById(audioID);
    if (audioElement) {
      audioElement.play().catch((e) => console.log("Error playing audio!", e));
    }
  });
});

// intro audio
function playPauseIntro(button) {
  const introAudioId = button.getAttribute("data-audio");
  const introAudio = document.getElementById(introAudioId);
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
document.addEventListener("DOMContentLoaded", function () {
  // trigger the shake animation on a random audio button
  const shakeRandomButton = () => {
    const buttons = document.querySelectorAll(".audio-button");
    if (buttons.length === 0) return; // exit if no audio button

    const randomButton = buttons[Math.floor(Math.random() * buttons.length)];

    // gen random animation values
    const translateMax = 5 + Math.random() * 5; // 1px – 6px
    const rotateMax = 5 + Math.random() * 5; // 1deg – 6deg
    const duration = 0.5 + Math.random() * 0.5; // 0.5s – 1s

    const randomNumber = Math.random();
    let animationIterationCount = 1; // default to play once
    if (randomNumber < 0.33) {
      animationIterationCount = 1;
    } else if (randomNumber >= 0.33 && randomNumber < 0.66) {
      animationIterationCount = 2; // 33% probability to play twice
    } else if (randomNumber >= 0.85) {
      animationIterationCount = 3; // 33% probability to play three times
    }

    randomButton.style.animation = `shake ${duration}s`;
    randomButton.style.animationIterationCount =
      animationIterationCount.toString();
    randomButton.addEventListener(
      "animationend",
      () => {
        // rm animation style to allow it to be reapplied
        randomButton.style.animation = "";
      },
      { once: true }
    );
  };

  // init delay before starting shaking
  let delay = Math.random() * (10000 - 5000) + 1000; // 1s - 15s

  const startShakeLoop = () => {
    setTimeout(function loop() {
      shakeRandomButton();

      // calc next delay
      delay = Math.random() * (10000 - 5000) + 1000; // 1s - 15s
      setTimeout(loop, delay);
    }, delay);
  };

  startShakeLoop();
});
