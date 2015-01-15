<?php
error_reporting(0);

$callback = $_GET['callback'];

include_once('../CONTROLLER/User.php');

include_once('../revan/error.php');
include_once('../revan/json.php');
include_once('../revan/security.php');

$username = urldecode($_GET['username']);
$password = urldecode($_GET['password']);
$name = urldecode($_GET['name']);
$surname = urldecode($_GET['surname']);
$oib = urldecode($_GET['oib']);
$date = urldecode($_GET['date']);
$address = urldecode($_GET['address']);
$email = urldecode($_GET['email']);
$telephone = urldecode($_GET['telephone']);
$card = urldecode($_GET['card']);


UserController::registerUser($username, $password, $name, $surname, $oib, $date, $address, $email, $telephone, $card);

?>
