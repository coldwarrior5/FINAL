<?php

error_reporting(0);

$callback = $_GET['callback'];

include_once('../CONTROLLER/User.php');
include_once('../CONTROLLER/Parking.php');

include_once('../revan/error.php');
include_once('../revan/json.php');
include_once('../revan/security.php');

$void = urldecode($_GET['void']);




ParkingController::getAllParkings();

?>
