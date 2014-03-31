var map;
$(function() {
  map = L.map('map').setView(new L.LatLng(-6.1731, 35.741), 6);

  L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);

  var marker = L.marker([-6.1731, 35.741],{draggable:true});

  marker.addTo(map);

  marker.on('dragend',function(event){
     var ll = marker.getLatLng();
  	$("#latitude").val(ll.lat); 
  	$("#longitude").val(ll.lng); 
  });

}); //Main Function