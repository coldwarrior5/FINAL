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

$id = urldecode($_GET['id']);
$name = urldecode($_GET['name']);
$surname = urldecode($_GET['surname']);
$oib = urldecode($_GET['oib']);
$date = urldecode($_GET['date']);
$address = urldecode($_GET['address']);
$email = urldecode($_GET['email']);
$phone = urldecode($_GET['phone']);
$card = urldecode($_GET['card']);


UserController::editUserInfo($id, $name, $surname, $oib, $date, $address, $email, $phone, $card);


?>
