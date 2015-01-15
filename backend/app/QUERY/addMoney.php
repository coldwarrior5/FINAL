<?php
include_once('../CONTROLLER/bank.php');
include_once('../CONTROLLER/discount.php');
include_once('../CONTROLLER/parking.php');
include_once('../CONTROLLER/User.php');

include_once('../revan/error.php');
include_once('../revan/json.php');
include_once('../revan/security.php');

$card = urldecode($_GET['card']);
$money = urldecode($_GET['money']);




BankController::addMoney($card, $money)

?>
