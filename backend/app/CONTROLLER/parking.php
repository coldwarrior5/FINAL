<?php
include_once('../MODEL/administrator.php');
include_once('../MODEL/parkiraliste.php');
include_once('../MODEL/parkirnomjesto.php');
include_once('../MODEL/tipparking.php');
include_once('../MODEL/popust.php');
include_once('../MODEL/prijavljenikorisnik.php');
include_once('../MODEL/registriranikorisnik.php');

include_once('../CONTROLLER/bank.php');


include_once('../DAL/default.php');

include_once('../revan/error.php');
include_once('../revan/json.php');
include_once('../revan/revan.php');
include_once('../revan/security.php');

class ParkingController
{
	
	static function getAllParkings()
	{
		$parkings = Parkiraliste::findAll();
		
		$returnArray = array();
		
		foreach($parkings as $element1)
		{
			$parkingArray = array();
			
			$parking = new Parkiraliste;
			$parking = $element1;
			
			$parkingArray['id'] = $parking->id;
			$parkingArray['naziv'] = $parking->naziv;
			$parkingArray['adresa'] = $parking->adresa;
			$parkingArray['zemljopisnaSirina'] = $parking->zemljopisnaSirina;
			$parkingArray['zemljopisnaDuzina'] = $parking->zemljopisnaDuzina;
			$parkingArray['brojMjesta'] = $parking->brojMjesta;
			
			//ALGORITAM TRAZENJA BROJA SLOBODNIH MJESTA
			
			$occupied = 0;
			
			$possibleOccupiedRaw = Parkirnomjesto::init($parking->id, NULL, NULL, NULL);
			$possibleOccupiedFilter = $possibleOccupiedRaw->filter();
			
			foreach($possibleOccupiedFilter as $element)
			{
				$possibleOccupied = new Parkirnomjesto;
				$possibleOccupied = $element;
				
				$start = strtotime($possibleOccupied->od);
				$end = strtotime($possibleOccupied->do);
				
				if($start < time() && $end == false)
				{
					$occupied += 1;
				}
				else if($start < time() && $end > time())
				{
					$occupied += 1;
				}
				
			}
			
			
			//END ALGORITAM TRAZENJA SLOBODNIH MJESTA
			
			$parkingArray['brojSlobodnihMjesta'] = (string)($parking->brojMjesta - $occupied);
			
			
			
			$type = Tipparking::find($parking->idTip);
			$parkingArray['tip'] = $type->name;
			
			$parkingArray['cijena'] = $parking->cijena;
			
			array_push($returnArray, $parkingArray);
		}
		
		
		Json::renderArray($returnArray);
	}
	
	static function addParking($name, $address, $latitude, $longitude, $spots, $type, $price)
	{
		Revan::validateNullOrEmpty($name, $address, $latitude, $longitude, $spots, $type, $price);
		
		$parking = Parkiraliste::init($name, $address, $latitude, $longitude, $spots, $type, $price);
		$parking->save();
		
		Json::renderSuccess("Parkiraliste je dodano");
	}
	
	static function editParking($id, $name, $address, $latitude, $longitude, $spots, $type, $price)
	{
		Revan::validateNullOrEmpty($id, $name, $address, $latitude, $longitude, $spots, $type, $price);
		
		$parking = Parkiraliste::init($name, $address, $latitude, $longitude, $spots, $type, $price);
		$parking->id = $id;
		$parking->save();
		
		Json::renderSuccess("Informacije o parkiralistu su osvjezene");
	}
	
	static function deleteParking($id)
	{
		Revan::validateNullOrEmpty($id);
		
		$parking = Parkiraliste::find($id);
		$parking->destroy();
		
		Json::renderSuccess("Parkiraliste je obrisano");
	}
	

	static function getParkingType()
	{
		$parkingType = Tipparking::findAll();
		
		Json::renderObjectArray($parkingType);
	}
	
	
	static function monthlyPay()
	{
		$subscribersRaw = Parkirnomjesto::init(NULL, NULL, NULL, '0000-00-00 00:00:00');
		$subscribersFilter = $subscribersRaw->filter();
		
		foreach($subscribersFilter as $element)
		{
			$subscribersBufffer = new Parkirnomjesto;
			$subscribersBufffer = $element;
			
			if($subscribersBufffer->idKorisnik > 0 && strtotime($subscribersBufffer->od) < time())
			{
				//tereti karticu
				
				$userRaw = Prijavljenikorisnik::init($subscribersBufffer->idKorisnik, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
				$userFilter = $userRaw->filter();
				
				$user = new Prijavljenikorisnik;
				$user = $userFilter[0];
				
				//cijena i popust
				$parkingId = $subscribersBufffer->idParkiralista;
				$discountObject = Popust::find(1);
				$discount = $discountObject->iznos;
				
				$parking = Parkiraliste::find($parkingId);
				
				$price = $parking->cijena - ($parking->cijena * ($discount/100.0));
				//END cijena i popust
				
				$result = BankController::buy($user->brojKartice, $price);
				
				if($result == 0)
				{
					ParkingController::terminateSubscription($user->id);
				}
				
							
			}
			
		}
		echo 'Obrada je zavrsila!';	
		
	}
	
	static function terminateSubscription($id)
	{
		Revan::validateNullOrEmpty($id);
		$parkingRaw = Parkirnomjesto::init(NULL, $id, NULL, '0000-00-00 00:00:00');
		$parkingFilter = $parkingRaw->filter();
		
		foreach($parkingFilter as $element)
		{
			$place = new Parkirnomjesto;
			$place = $element;
			$place->do = Revan::timestampToDatetime(time());
			$place->save();
		}
	}
	
	static function removeSubscription($id)
	{
		Revan::validateNullOrEmpty($id);
		$parking = Parkirnomjesto::find($id);
		$parking->destroy();
		
		Json::renderSuccess("Uklonjeno!");
	}
	
	static function getSubscriptions($id)
	{
		Revan::validateNullOrEmpty($id);
		$returnArray = array();
		
		$parkingRaw = Parkirnomjesto::init(NULL, $id, NULL, '0000-00-00 00:00:00');
		$parkingFilter = $parkingRaw->filter();
		
		foreach($parkingFilter as $element)
		{
			$parkingBuffer = new Parkirnomjesto;
			$parkingBuffer = $element;
			
			$park = Parkiraliste::find($parkingBuffer->idParkiralista);
			$parkingBuffer->idParkiralista = $park->naziv;
			
			array_push($returnArray, $parkingBuffer);
		}
		
		Json::renderArray($returnArray);
		
	}
	
	static function getReservations($id)
	{
		$returnArray = array();
		
		Revan::validateNullOrEmpty($id);
		$parkingRaw = Parkirnomjesto::init(NULL, $id, NULL, NULL);
		$parkingFilter = $parkingRaw->filter();
		
		foreach($parkingFilter as $element)
		{
			$parking = new Parkirnomjesto;
			$parking = $element;
			
			if($parking->do != '0000-00-00 00:00:00')
			{
				if(strtotime($parking->do) > time())
				{
					array_push($returnArray, $parking);
				}
				
			}
		}
		
		Json::renderArray($returnArray);
		
	}
	
	static function insertReservation($parkingId, $userId, $from, $to)
	{
		$userRaw = Prijavljenikorisnik::init($userId, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
		$userFilter = $userRaw->filter();
		$user = new Prijavljenikorisnik;
		$user = $userFilter[0];
		
		// if it is subscription
		if($to == -1)
		{
			$tox = '0000-00-00 00:00:00';
		}
		else
		{
			//cijena i popust
			$discountObject = Popust::find(1);
			$discount = $discountObject->iznos;
				
			$parking = Parkiraliste::find($parkingId);
				
			$price = $parking->cijena - ($parking->cijena * ($discount/100.0));
			//END cijena i popust
			
			$result = BankController::buy($user->brojKartice, $price);
			
			if($result == 0)
			{
				Json::renderError(AuthenticationError::authorizationError());
			}
			
			$tox = Revan::timestampToDatetime($to);
		}
		
		$master = Parkirnomjesto::init($parkingId, $userId, Revan::timestampToDatetime($from), $tox);
		$master->save();
		
		Json::renderSuccess("Dodano!"); 
	}
	
	
	static function getParkingInfo($id)
	{
		Revan::validateNullOrEmpty($id);
		
		$parking = Parkiraliste::find($id);
		
		Json::renderObject($parking);
	}

}

?>
