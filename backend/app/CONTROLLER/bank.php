<?php
include_once('../MODEL/administrator.php');
include_once('../MODEL/banka.php');
include_once('../MODEL/parkiraliste.php');
include_once('../MODEL/parkirnomjesto.php');
include_once('../MODEL/popust.php');
include_once('../MODEL/prijavljenikorisnik.php');
include_once('../MODEL/registriranikorisnik.php');
include_once('../MODEL/tipparking.php');

include_once('../DAL/default.php');

include_once('../revan/error.php');
include_once('../revan/json.php');
include_once('../revan/revan.php');
include_once('../revan/security.php');

class BankController
{
	static function buy($card, $price)
	{
		$bankRaw = Banka::init($card, NULL);
		$bankFilter = $bankRaw->filter();
		
		if(count($bankFilter) == 0)
		{
			return 0;
		}
		
		$bank = new Banka;
		$bank = $bankFilter[0];
		
		$bank->iznos = $bank->iznos - $price;
		
		if($bank->iznos < 0)
		{
			return 0;
		}
		
		$bank->save();
		
		return 1;
	}
	
	static function addMoney($card, $money)
	{
		Revan::validateNullOrEmpty($card, $money);
		$id = -1;
		$init = $money;
		
		$bankRaw = Banka::init($card, NULL);
		$bankFilter = $bankRaw->filter();
		
		if(count($bankFilter) != 0)
		{
			$bankGetter = new Banka;
			$bankGetter = $bankFilter[0];
			$id = $bankGetter->id;
			$init = $bankGetter->iznos + $money;
		}
		
		$bank = Banka::init($card, $init);
		$bank->id = $id;
		$bank->save();
		
		echo 'Novac je uplacen';
	}
}

?>
