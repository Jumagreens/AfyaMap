<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>AfyaMap/ Add Place</title>
  <meta name="description" content="A simple app that maps out health initiatives in Tanzania">

  <meta name="viewport" content="width=device-width, user-scalable=false" initial-scale="1">

  
  <link rel="stylesheet" href="libraries/leaflet-0.6.4/leaflet.css">
  <link rel="stylesheet" href="libraries/leaflet-locate/L.Control.Locate.css">
  <link rel="stylesheet" href="libraries/leaflet-search/leaflet-search.css">
  <link rel="stylesheet" href="assets/app.css">    
  <!--//added the css file of the sidebar for layout-->
  <link rel="stylesheet" href="libraries/leaflet-sidebar/leaflet-sidebar.css">

  <!-- This is necessary for the iOS Install -->
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <link rel="apple-touch-icon" href="assets/icons/afyamap_icon_128.png">
  <link rel="icon" href="assets/icons/afyamap_icon_16.png" type="image/png">
  <link rel="shortcut icon" href="assets/icons/afyamap_icon_16.png" type="image/png">
  <link rel="apple-touch-startup-image" href="assets/images/loadscreen.png">
<link rel='stylesheet' href='http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.css' />
</head>

<?php


if(array_key_exists('name',$_POST)){

$name = $_POST['name'];
$category = $_POST['category'];
$address = $_POST['address'];
$city = $_POST['city'];
$phonenumber = $_POST['phonenumber'];
$webaddress = $_POST['webaddress'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];


$my_file = file_get_contents('afyamap.geojson');
$jsonarray = json_decode($my_file,true);
//$features[] = $json["features"];

$featurearray  = array("type" => "Feature",
                    "properties" => array("name" => $name,
                          "category" => $category,
                          "address" => $address,
                          "city" => $city,
                          "phone" => $phonenumber,
                          "web" => $webaddress),
                     "geometry" => array(
                           "type"=> "Point",
                           "coordinates" => array($longitude,$latitude)));

array_push($jsonarray["features"],$featurearray);

file_put_contents('afyamap.geojson', json_encode($jsonarray));

}
else{
  $feature = "Please specify the details above";
}


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
  <div id="map"></div>
  <div id="inputcontainer">
  <form method="post" action="addplace.php">
  <input type="text" id="name" name="name" placeholder="Place's Name">
  <input type="text" id="category" name="category" placeholder="Place's Category">
  <input type="text" id="address" name="address" placeholder="Place's Address">
  <input type="text" id="city" name="city" placeholder="Place's City">
  <input type="text" id="phonenumber" name="phonenumber" placeholder="Place's Phone Number">
  <input type="text" id="webaddress" name="webaddress" placeholder="Place's Web Address">
  <input type="text" id="latitude" name="latitude" >
  <input type="text" id="longitude" name="longitude">
  <input type="submit" value="Save the Place">
  </form>
  </div>
  <!--[if lte IE 8]>
      <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.6.4/leaflet.ie.css" />
      <![endif]-->
  <script src="libraries/leaflet-0.6.4/leaflet.js"></script>
  <script src="libraries/leaflet-locate/L.Control.Locate.js"></script>
  <script src="libraries/leaflet-search/leaflet-search.js"></script>
  <script src="assets/addplace.js"></script>
  <script src="libraries/jquery-2.0.3.min.js"></script>


    </body>
    </html>