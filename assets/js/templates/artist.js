document.addEventListener("DOMContentLoaded", function () {
  // get all play buttons
  var playButtons = document.querySelectorAll(".play-audio-button");

  playButtons.forEach(function (button, index) {
    // get the audio sample for this button
    var audioSample = document.getElementById("audioSample" + index);

    button.addEventListener("click", function () {
      // check if audio is already playing & reset
      if (!audioSample.paused) {
        audioSample.pause();
        audioSample.currentTime = 0;
        this.classList.remove("clicked");
      } else {
        // pause other playing audio
        document
          .querySelectorAll(".audio-sample")
          .forEach(function (otherAudio) {
            otherAudio.pause();
            otherAudio.currentTime = 0;
          });
        // reset button style
        document
          .querySelectorAll(".play-audio-button")
          .forEach(function (otherButton) {
            otherButton.classList.remove("clicked");
          });

        // play sound
        audioSample.play();
        this.classList.add("clicked");
      }
    });

    // reset when audio finished
    audioSample.onended = function () {
      button.classList.remove("clicked");
    };
  });
});
