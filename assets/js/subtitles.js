document.addEventListener("DOMContentLoaded", () => {
  const subtitles = {
    1: "Kaya! This is the website of exploratory music festival Audible Edge, which will happen in Boorloo and Walyalup between April 26th and 28th this year.",
    10: "This festival focusses on experimental, marginal and not-normal music.",
    17: "[JM] We like how being playful, silly and freaky opens us up to new and even challenging experiences.",
    22: "And we like trying to make experimental music accessible to all kinds of folks.",
    27: "We hope this website and design by Alex Turner and Oli Rawlings, reflects this attitude.",
    32: "[AM] If you have access needs or questions, we can do our best to support these via the Accessibility page.",
    40: "You can also turn off the CSS with the Plain Text View button.By pressing the button, it will show the plain - text version of the site.",
    48: "The full program is announced on March 13, with a launch party at Astral Weeks, a listening bar in Northbridge.",
    56: "There'll be vinyl DJ sets by Sookie, and a live performance by improvising quartet Group Therapy. It's free, so we'd love to see you there.",
    64: "In the meantime, check out the program for our Night School, a series of workshops, discussions and talks happening between March 24 and April 21.",
    75: "On this launch page you can click on each little 'a' and 'e' button to hear someone from the Audible Edge team saying 'a' or 'e'.",
    83: "It is very silly and we hope you have lots of fun creating your own tiny AE sonic collage piece.",
  };

  const audioPlayer = document.getElementById("audio-intro-0");
  const subtitlesDiv = document.getElementById("subtitles");

  audioPlayer.addEventListener("timeupdate", () => {
    const currentTime = Math.floor(audioPlayer.currentTime);
    if (subtitles[currentTime]) {
      subtitlesDiv.textContent = subtitles[currentTime];
    }
  });

  audioPlayer.addEventListener("ended", () => {
    subtitlesDiv.textContent = ""; // Clear subtitles when audio ends
  });
});
