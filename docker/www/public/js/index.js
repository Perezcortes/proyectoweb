// Initialize and add the map
function initMap() {
    var mapOptions = {
      center: { lat: 17.80773, lng: -97.77427 },
      zoom: 15
    };
    var map = new google.maps.Map(document.getElementById("map"), mapOptions);
  }
  
  // Load the map when the page has loaded
  window.onload = initMap;