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

class SensorController
{
	static function toggleOn($parkingId, $sensorId, $time)
	{
		Revan::validateNullOrEmpty($parkingId, $sensorId, $time);
		
		$place = Parkirnomjesto::init($parkingId, (-1) * $sensorId, Revan::timestampToDatetime($time), '0000-00-00 00:00:00');
		$place->save();
		
		Json::renderSuccess("Senzor: ON");
	}
	
	static function toggleOff($parkingId, $sensorId, $time)
	{
		Revan::validateNullOrEmpty($parkingId, $sensorId, $time);
		
		
		$placeRaw = Parkirnomjesto::init($parkingId, (-1) * $sensorId, NULL, '0000-00-00 00:00:00');
		$placeFilter = $placeRaw->filter();
		
		foreach($placeFilter as $element)
		{
			$place = new Parkirnomjesto;
			$place = $element;
			
			$place->do = Revan::timestampToDatetime($time);
			$place->save();
		}
		
		Json::renderSuccess("Senzor: OFF");
	}
}

?>
