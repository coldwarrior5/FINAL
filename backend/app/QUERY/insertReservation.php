<?php
error_reporting(0);

$callback = $_GET['callback'];

include_once('../CONTROLLER/bank.php');
include_once('../CONTROLLER/discount.php');
include_once('../CONTROLLER/parking.php');
include_once('../CONTROLLER/sensor.php');
include_once('../CONTROLLER/User.php');

include_once('../revan/error.php');
include_once('../revan/json.php');
include_once('../revan/security.php');

$parking = urldecode($_GET['parking']);
$user = urldecode($_GET['user']);
$from = urldecode($_GET['from']);
$to = urldecode($_GET['to']);


ParkingController::insertReservation($parking, $user, $from, $to);


?>
