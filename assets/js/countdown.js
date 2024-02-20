document.addEventListener("DOMContentLoaded", function () {
  // countdown till program launch (home page)
  const countdown = document.getElementById("countdown");
  const targetDate = new Date("March 13, 2024 00:00:00").getTime();

  const updateCountdown = function () {
    const now = new Date().getTime();
    // convert timezone offset to milliseconds, then adjust for UTC+8
    const timezoneOffset = new Date().getTimezoneOffset() * 60000;
    const UTC8time = now + timezoneOffset + 8 * 3600000;
    const distance = targetDate - UTC8time;

    // calculate days remaining & display
    const days = Math.floor(distance / (1000 * 60 * 60 * 24));

    if (days === 1) {
      countdown.innerHTML = days + " day";
    } else {
      countdown.innerHTML = days + " days";
    }

    // if the countdown is over, display message
    if (distance < 0) {
      clearInterval(interval);
      countdown.innerHTML = "Program has launched!";
    }
  };

  // run once on load, then update countdown every day
  updateCountdown();
  const interval = setInterval(updateCountdown, 86400000); // 24hrs
});
