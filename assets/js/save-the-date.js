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

      // play
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
  var svg = d3.select("svg");
  // get all dots (and numbers, currently)
  var circles = svg.selectAll(".cls-3").nodes();
  console.log(circles);

  // get container's offset
  var containerRect = document
    .querySelector("#svg-container")
    .getBoundingClientRect();

  // select all audio buttons
  var audioButtons = d3.selectAll(".audio-button").nodes();

  audioButtons.forEach((button, i) => {
    if (i < circles.length) {
      // only if a circle exists
      var circle = d3.select(circles[i]);
      var cx = +circle.attr("cx");
      var cy = +circle.attr("cy");

      // move button
      d3.select(button)
        .style("position", "absolute")
        .style("left", containerRect.left + cx + "px")
        .style("top", containerRect.top + cy + "px");
    }
  });

  // play audio
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
