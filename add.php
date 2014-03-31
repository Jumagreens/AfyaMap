<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>AfyaMap/add hospital</title>
  <meta name="description" content="A simple app that maps out health initiatives in Tanzania">

  <meta name="viewport" content="width=device-width, user-scalable=false">
  <link rel="stylesheet" href="assets/add.css">

  
  <!-- This is necessary for the iOS Install -->
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <link rel="apple-touch-icon" href="assets/icons/afyamap_icon_128.png">
  <link rel="icon" href="assets/icons/afyamap_icon_16.png" type="image/png">
  <link rel="shortcut icon" href="assets/icons/afyamap_icon_16.png" type="image/png">
  <link rel="apple-touch-startup-image" href="assets/images/loadscreen.png">
</head>
<?php

if(array_key_exists('name',$_POST)){

$name = $_POST['name'];
$category = $_POST['category'];
$address = $_POST['address'];
$contacts = $_POST['contacts'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];


$my_file = file_get_contents('afyamap.geojson');
$jsonarray = json_decode($my_file,true);
//$features[] = $json["features"];

$featurearray  = array("type" => "Feature",
                    "properties" => array("name" => $name,
                          "category" => $category,
                          "address" => $address,
                          "city" => $contacts,
                          "phone" => "#"),
                     "geometry" => array(
                           "type"=> "Point",
                           "coordinates" => array($longitude,$latitude)));

array_push($jsonarray["features"],$featurearray);

file_put_contents('afyamap.geojson', json_encode($jsonarray));

}
else{
  $feature = "Please specify the details above";
}

//Read the GeoJson File
// Open the file

?>
<body>

<!-- Menu Bar-->
  <div id="menubar">
    <script src="libraries/jquery-2.0.3.min.js"></script>
    <script type="text/javascript">
    $( document ).ready(function() {
      $("#menubar").load("menu.html");
    });
    </script> 
  </div>
<!-- Menu Bar-->

<div class="lcontainer">
<form action="add.php" method="post">
<div>Name:<input id="txtName" type="input" name="name" placeholder="Enter Health Centre's name" /></div>
<div>Category:<input id="txtCategory" type="input" name="category" placeholder="Type of the Health Centre" /></div>
<div>Address:<input id="txtAddress" type="input" name="address" placeholder="Enter Health Centre's Address" /></div>
<div>Contacts:<input id="txtContacts" type="input" name="contacts" placeholder="Enter Health Centre's Contacts" /></div>
<div>Latitude:<input id="txtLatitude" type="input" name="latitude" placeholder="Enter Health Centre's Latitude" /></div>
<div>Longitude:<input id="txtLongitude" type="input" name="longitude" placeholder="Enter Health Centre's Longitude" /></div>
<input name="addbutton" type="submit" value="Add new place" id="saveplace" />
</form>
<label></label>

</div>
<div id="googleMap" class="forminput">
    </div>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDNNALPaDP5hl7_JxRxkM8k8nJqDzSYPQY&sensor=false"></script>
<script>

  var myCenter = new google.maps.LatLng(-6.808742,39.270850);
  function initialize()
  {
    var mapProp = {
      center:myCenter,
      zoom:5,
      mapTypeId:google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById("googleMap")
      ,mapProp);

    var marker = new google.maps.Marker({
      position:myCenter, draggable:true
    });

    marker.setMap(map);

    var infowindow = new google.maps.InfoWindow({
      //content:"Mwananyamala Hospital!"
    });

    infowindow.open(map,marker);

    google.maps.event.addListener(marker,'click',function() {
      map.setZoom(14);
      map.setCenter(marker.getPosition());
    });

    google.maps.event.addListener(map,'click',function(event) {

      //document.getElementById('latitude').innerHTML = event.latLng.lat();
      //document.getElementById('longitude').innerHTML = event.latLng.lng();
     //alert('Lat: ' + event.latLng.lat() + ' and Longitude is: ' + event.latLng.lng());
   });

    google.maps.event.addListener(marker, 'dragend', function(event){

      document.getElementById('txtLatitude').value = event.latLng.lat();
      document.getElementById('txtLongitude').value = event.latLng.lng();
       //alert('Lat: ' + event.latLng.lat() + ' and Longitude is: ' + event.latLng.lng());
   });
  }

  google.maps.event.addDomListener(window, 'load', initialize);

  google.maps.event.addListener(marker,'click',function(event){
    alert("i am here, you clicked me");
  });


</script>


</body>
</html>