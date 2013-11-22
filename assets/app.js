var map;
$(function() {
  map = L.map('map').setView(new L.LatLng(-6.80308, 39.27261), 6);

  L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);

  // add locate button
  L.control.locate().addTo(map);

  // add search
  var searchLayer = function(query, cb) {
    var d = $.Deferred()

    // [{"loc":[41.57573,13.002411],"title":"black"},{"loc":[41.807149,13.162994],"title":"blue"}]
    var json = data.features.map(function(f) { return {loc: [f.geometry.coordinates[1], f.geometry.coordinates[0]], title: f.properties.name}} )
    // return d.resolve(json)

    json = json.filter(function(result) {
      return RegExp(query.toLowerCase()).test(result.title.toLowerCase())
    })
    cb(json)
  };
  map.addControl( new L.Control.Search({ callData: searchLayer }) );

  var data;
  $.getJSON('afyamap.geojson').then(function(geoJSON) {
    data = geoJSON;
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


