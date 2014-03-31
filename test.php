<?php

$my_file = file_get_contents('afyamap.geojson');
$jsonarray = json_decode($my_file,true);
//$features[] = $json["features"];

$featurearray  = array("type" => "Feature",
		                "properties" => array("name" => "name",
		                      "category" => "category",
		                      "address" => "address",
		                      "city" => "contacts",
		                      "phone" => "#"),
		                 "geometry" => array(
		                       "type"=> "Point",
		                       "coordinates" => array("latitude","longitude")));

array_push($jsonarray["features"],$featurearray);

file_put_contents('afyamap.geojson', json_encode($jsonarray));

?>