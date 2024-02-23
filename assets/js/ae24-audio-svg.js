document.addEventListener("DOMContentLoaded", function () {
  // Assuming an SVG container with id="lineCanvas" exists in your HTML
  const svg = d3.select("#lineCanvas");

  // Helper functions (addNoiseToLine, addRandomness) from your template can be reused here

  // Function to draw lines between buttons
  function drawLinesFromButton(clickedButton) {
    const clickedButtonPosition = clickedButton.getBoundingClientRect();
    const otherButtons = document.querySelectorAll(
      ".audio-button:not(#" + clickedButton.id + ")"
    );

    otherButtons.forEach((otherButton) => {
      const otherButtonPosition = otherButton.getBoundingClientRect();

      // Calculate start and end points for the line
      let points = [
        {
          x: clickedButtonPosition.left + clickedButtonPosition.width / 2,
          y: clickedButtonPosition.top + clickedButtonPosition.height / 2,
        },
        {
          x: otherButtonPosition.left + otherButtonPosition.width / 2,
          y: otherButtonPosition.top + otherButtonPosition.height / 2,
        },
      ];

      // Optionally add noise and subdivision to the line
      let pointsWithNoise = addNoiseToLine(
        points,
        noiseIntensity,
        subdivisionFactor
      );
      const pathData = lineGenerator(pointsWithNoise);

      // Draw the line
      svg
        .append("path")
        .attr("d", pathData)
        .style("stroke", "black") // Customize stroke color as needed
        .style("stroke-width", 2) // Customize stroke width as needed
        .style("fill", "none");
    });
  }

  // Attach click event listener to all audio buttons
  document.querySelectorAll(".audio-button").forEach((button) => {
    button.addEventListener("click", function () {
      // Clear existing paths before drawing new ones
      svg.selectAll("path").remove();
      drawLinesFromButton(this);
    });
  });
});
