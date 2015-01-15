<?php
include_once('../MODEL/administrator.php');
include_once('../MODEL/parkiraliste.php');
include_once('../MODEL/parkirnomjesto.php');
include_once('../MODEL/popust.php');
include_once('../MODEL/prijavljenikorisnik.php');
include_once('../MODEL/registriranikorisnik.php');

include_once('../DAL/default.php');

include_once('../revan/error.php');
include_once('../revan/json.php');
include_once('../revan/revan.php');
include_once('../revan/security.php');

class DiscountController
{
	static function getDiscount()
	{
		$discount = Popust::find(1);
		
		Json::renderObject($discount);
	}
	
	static function editDiscount($percent)
	{
		Revan::validateNullOrEmpty($percent);
		$discount = Popust::find(1);
		$discount->iznos = $percent;
		$discount->save();
		
		Json::renderSuccess("Popust je izmjenjen");
	}
}

?>
