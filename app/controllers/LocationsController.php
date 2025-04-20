<?php
require_once './../../config.php';
require_once './../../Database.php';


$conn = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);

$locations = Array();
$result = $conn->query("SELECT * FROM STORE_LOCATIONS");

if ($result) { 
    while ($row = $result->fetch_assoc()) {
        $locations[] = $row;
    }
}

foreach ($locations as $loc) {
    $res[] = [
        "name" => $loc["NAME"],
        "lat" => floatval($loc["LATITUDE"]),  
        "lng" => floatval($loc["LONGITUDE"]),
        "loca" => $loc["LOCATION"],
    ];
}
header('Content-Type: application/json');
echo json_encode($res);
