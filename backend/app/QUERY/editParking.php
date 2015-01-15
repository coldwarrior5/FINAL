<?php

error_reporting(0);

$callback = $_GET['callback'];

include_once('../CONTROLLER/parking.php');
include_once('../CONTROLLER/User.php');

include_once('../revan/error.php');
include_once('../revan/json.php');
include_once('../revan/security.php');

$name = urldecode($_GET['name']);
$address = urldecode($_GET['address']);
$latitude = urldecode($_GET['latitude']);
$longitude = urldecode($_GET['longitude']);
$spots = urldecode($_GET['spots']);
$type = urldecode($_GET['type']);
$price = urldecode($_GET['price']);
$id = urldecode($_GET['id']);



ParkingController::editParking($id, $name, $address, $latitude, $longitude, $spots, $type, $price);

?>
