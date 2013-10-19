var map;
$(function() {
  map = L.map('map').setView(new L.LatLng(-6.80308, 39.27261), 13);

  L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);

  // add locate button
  L.control.locate().addTo(map);

  // add search
  // var searchLayer = function() {};
  // map.addControl( new L.Control.Search({ layer: searchLayer }) );

  $.getJSON('afyamap.geojson').then(function(geoJSON) {
    var options = {
      onEachFeature: onEachFeature
    }
    L.geoJson(geoJSON, options).addTo(map);
  })

  function onEachFeature (feature, layer) {
    // does this feature have a property named popupContent?
    var html = '<table>';
    for (property in feature.properties) {
      html += "<tr><th>"+property+"</th><td>"+feature.properties[property]+"</td></tr>"
    }
    html += '</table>'
    layer.bindPopup(html);
  }
});


