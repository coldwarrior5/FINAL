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
			$return = "Unknown Error Occured";
			switch ($error)
			{
				case "-1":
					$return = "Passwords do not match";
					break;
				case "-2":
					$return = "Email exists!";
					break;
				case "-3":
					$return = "Wrong email format";
					break;
				case "-4":
					$return = "Empty fields";
					break;
				case "-5":
					$return = "Authentication error occured";
					break;
				case "-7":
					$return = "Invalid url";
					break;
				case "-8":
					$return = "Authorization error";
					break;
				case "-10":
					$return = "No token";
					break;
				case "-11":
					$return = "Invalid token";
					break;
				case "-12":
					$return = "Variable must contain only letters";
					break;
				case "-13":
					$return = "Database error - element not inserted";
					break;
				case "-14":
					$return = "Empty result";
					break;
				case "-15":
					$return = "Record does not exist";
					break;
				case "-16":
					$return = "Remove Failure";
					break;
				case "-17":
					$return = "Expected number";
					break;
				case "-19":
					$return = "Expired";
					break;
				case "-18":
					$return = "Token exists";
					break;
				case "-20":
					$return = "Database error occured";
					break;
				case "-21":
					$return = "Time error occured";
					break;
				case "-22":
					$return = "URL error occured";
					break;
				case "-99":
					$return = "Error occured";
					break;
			}
			
			
			$errorArray = array();
			$errorArray['result'] = "ERROR";
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
		$successArray['result'] = "SUCCESS";
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