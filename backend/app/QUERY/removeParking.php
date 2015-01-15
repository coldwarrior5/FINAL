<?php
error_reporting(0);

$callback = $_GET['callback'];

include_once('../CONTROLLER/parking.php');
include_once('../CONTROLLER/User.php');

include_once('../revan/error.php');
include_once('../revan/json.php');
include_once('../revan/security.php');

$id = urldecode($_GET['id']);



ParkingController::deleteParking($id);

?>
