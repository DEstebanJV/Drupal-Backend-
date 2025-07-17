(function (Drupal, once) {
  Drupal.behaviors.anytownLiveClock = {
    attach: function (context, settings) {
      once('anytown-live-clock', '#anytown-clock', context).forEach(function (clockElement) {
        function updateClock() {
          const now = new Date();
          const formattedTime = now.toLocaleString();
          clockElement.textContent = 'Esta es tu hora local: ' + formattedTime;
        }
        updateClock();
        setInterval(updateClock, 1000);
      });
    }
  };
})(Drupal, once);
