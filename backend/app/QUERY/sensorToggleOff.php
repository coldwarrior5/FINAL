<?php
include_once('../CONTROLLER/bank.php');
include_once('../CONTROLLER/discount.php');
include_once('../CONTROLLER/parking.php');
include_once('../CONTROLLER/sensor.php');
include_once('../CONTROLLER/User.php');

include_once('../revan/error.php');
include_once('../revan/json.php');
include_once('../revan/security.php');

$parking = urldecode($_GET['parking']);
$sensor = urldecode($_GET['sensor']);
$time = urldecode($_GET['time']);



SensorController::toggleOff($parking, $sensor, $time);

?>
