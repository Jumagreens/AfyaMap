var map;
$(function() {
  map = L.map('map').setView(new L.LatLng(-6.80308, 39.27261), 13);

  L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);

  $.getJSON('test.geojson').then(function(geoJSON) {
    L.geoJson(geoJSON).addTo(map);
  })
});


