<?php

class Json
{
	/**
		If it is an error (variable < 0) render error, exit, program
		ELSE do nothing
	**/
	static function renderError($error)
	{
		if($error < 0)
		{
			$return = "Nepoznata greska";
			switch ($error)
			{
				case "-1":
					$return = "Lozinka nije odgovarajuća";
					break;
				case "-2":
					$return = "Email postoji!";
					break;
				case "-3":
					$return = "Krivi email format";
					break;
				case "-4":
					$return = "Imate prazna polja";
					break;
				case "-5":
					$return = "Greška prilikom autentifikacije";
					break;
				case "-7":
					$return = "Neispravan url";
					break;
				case "-8":
					$return = "Greska autorizacije";
					break;
				case "-10":
					$return = "Nema tokena";
					break;
				case "-11":
					$return = "Pogrešan token";
					break;
				case "-12":
					$return = "Varijabla mora sadržavati samo slova";
					break;
				case "-13":
					$return = "Greška u bazi - element nije unesen";
					break;
				case "-14":
					$return = "Prazan rezultat";
					break;
				case "-15":
					$return = "Taj korisnik ne postoji";
					break;
				case "-16":
					$return = "Uklonite grešku";
					break;
				case "-17":
					$return = "Broj je očekivan";
					break;
				case "-19":
					$return = "Isteklo";
					break;
				case "-18":
					$return = "Token postoji";
					break;
				case "-20":
					$return = "Greška u bazi podataka";
					break;
				case "-21":
					$return = "Greška u vremenu";
					break;
				case "-22":
					$return = "URL greška";
					break;
                                case "-24":
					$return = "Korisničko ime već postoji";
					break;
				case "-99":
					$return = "Greška";
					break;
			}
			
			
			$errorArray = array();
			$errorArray['result'] = "GRESKA";
			$errorArray['code'] = $error;
			$errorArray['description'] = $return;
			
			global $callback; echo $callback.'('.json_encode($errorArray).')';
			exit(-1);
			
		}
		
	}
	
	static function renderObject($object)
	{
		$array = get_object_vars($object);
		
		global $callback; echo $callback.'('.json_encode($array).')';
	}
	
	static function renderObjectArray($objectArray)
	{
		$array = array();
		
		foreach($objectArray as $element)
		{
			$bufferedArray = get_object_vars($element);
			array_push($array, $bufferedArray);
		}
		
		global $callback; echo $callback.'('.json_encode($array).')';
	}
	
	static function renderSuccess($message)
	{
		$successArray = array();
		$successArray['result'] = "USPJEH";
		$successArr['code'] = "200";
		$successArray['description'] = $message;
			
		global $callback; echo $callback.'('.json_encode($successArray).')';
	}
	
	static function wrapModelWithArray($model, $array)
	{
		$returnArray = get_object_vars($model);
		
		$result = array_merge($returnArray, $array);
		global $callback; echo $callback.'('.json_encode($result).')';
	}
	
	static function renderArray($array)
	{		
		global $callback; echo $callback.'('.json_encode($array).')';
	}
	
}

?>