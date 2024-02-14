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

// document.addEventListener("DOMContentLoaded", function () {
//   var svgElement = document.querySelector("#logo-0 svg"); // Directly accessing the SVG element
//   var svg = d3.select(svgElement); //
//   // get all dots (and numbers, currently)
//   var circles = svg.selectAll(".cls-3").nodes();
//   console.log(circles);

//   // var circles_real = svg.selectAll("circle.cls-3").nodes();
//   // console.log(circles_real);

//   var viewBox = svgElement.viewBox.baseVal;
//   console.log(viewBox);

//   var svgRect = svgElement.getBoundingClientRect();

//   // select all audio buttons
//   var audioButtons = d3.selectAll(".audio-button").nodes();

//   // Calculate the scaling factors
//   var scaleX = svgRect.width / viewBox.width;
//   var scaleY = svgRect.height / viewBox.height;

//   var audioButtons = document.querySelectorAll(".audio-button");

//   audioButtons.forEach((button) => {
//     // Select a random circle node
//     var randomIndex = Math.floor(Math.random() * circles.length);
//     var randomCircle = circles[randomIndex];
//     var circleD3 = d3.select(randomCircle);
//     var cx = +circleD3.attr("cx") * scaleX; // Adjust for viewBox scaling
//     var cy = +circleD3.attr("cy") * scaleY; // Adjust for viewBox scaling

//     // Adjust for the SVG's position on the page
//     var adjustedX = svgRect.left + cx; // Include page scroll
//     var adjustedY = svgRect.top + cy; // Include page scroll

//     // Position the button
//     button.style.position = "absolute";
//     button.style.left = `${adjustedX}px`;
//     button.style.top = `${adjustedY}px`;
//   });

//   // play audio
//   d3.selectAll(".audio-button").on("click", function () {
//     var audioID = d3.select(this).select("audio").attr("id");
//     var audioElement = document.getElementById(audioID);
//     if (audioElement) {
//       audioElement
//         .play()
//         .catch((e) => console.error("Error playing audio:", e));
//     }
//   });
// });

document.addEventListener("DOMContentLoaded", function () {
  var svgElement = document.querySelector("#logo-0 svg"); // Adjust selector as needed
  var cls3Elements = svgElement.querySelectorAll(".cls-3"); // Selects both circles and paths

  var audioButtons = document.querySelectorAll(".audio-button");

  audioButtons.forEach((button) => {
    // Select a random .cls-3 element
    var randomIndex = Math.floor(Math.random() * cls3Elements.length);
    var element = cls3Elements[randomIndex];

    // Get bounding box of the element
    var bbox = element.getBBox();

    // Calculate center of the bounding box
    var cx = bbox.x + bbox.width / 2;
    var cy = bbox.y + bbox.height / 2;

    // Adjust for the SVG's position on the page and scaling
    // Assuming no viewBox scaling adjustment needed for simplicity, adjust if necessary
    var svgRect = svgElement.getBoundingClientRect();

    // Adjust for the SVG's scaling and positioning
    var scaleX = svgRect.width / svgElement.viewBox.baseVal.width;
    var scaleY = svgRect.height / svgElement.viewBox.baseVal.height;
    var adjustedX = svgRect.left + cx * scaleX - button.offsetWidth;
    var adjustedY = svgRect.top + cy * scaleY - button.offsetHeight;

    // Apply calculated positions
    button.style.position = "absolute";
    button.style.left = `${adjustedX}px`;
    button.style.top = `${adjustedY}px`;
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
