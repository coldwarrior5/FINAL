<?php
include_once('../revan/json.php');
include_once('../revan/error.php');

class Revan
{
	
	public static function validateEmail($email)
	{
		if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
		  return false;
		}
		return true;
	}
	
	public static function validateEmailX($email)
	{
		$validation = Revan::validateEmail($email);
		
		if(!$validation)
		{
			Json::renderError(AuthenticationError::wrongEmailFormat());
		}
	}
	
	public static function validateName($name)
	{
		if (!preg_match("/^[a-zA-Z ]*$/",$name))
		{
  			return false;
		}
		return true;
	}
	
	public static function validateNameX($name)
	{
		$validation = Revan::validateName($name);
		
		if(!$validation)
		{
			Json::renderError(UrlError::expectedOnlyLetters());
		}
	}
	
	public static function validatePasswords($password, $repassword)
	{
		if($password != $repassword)
		{
			Json::renderError(AuthenticationError::passwordsDoNotMatch());
		}
		
		if($password == NULL)
		{
			Json::renderError(AuthenticationError::shortPassword());
		}
		
		if($password == "")
		{
			Json::renderError(AuthenticationError::shortPassword());
		}
	}
	
	public static function validateNull()
	{
		$params = func_get_args();
		
		foreach($params as $element)
		{
			if($element == NULL)
			{
				Json::renderError(UrlError::emptyFields());
			}
		}
	}
	
	public static function validateNullOrEmpty()
	{
		$params = func_get_args();
		foreach($params as $element)
		{
			
			if($element == NULL)
			{

			$errorArray = array();
			$errorArray['result'] = "ERROR";
			$errorArray['code'] = "-40";
			$errorArray['description'] = "Empty fields ".$$element;
			
			global $callback; echo $callback.'('.json_encode($errorArray).')';
			exit(-1);	
			}
			
			if($element == "")
			{

			$errorArray = array();
			$errorArray['result'] = "ERROR";
			$errorArray['code'] = "-40";
			$errorArray['description'] = "Empty fields ".$$element;
			
			global $callback; echo $callback.'('.json_encode($errorArray).')';
			exit(-1);	
				
			}
		}
	}
	
	public static function timestampToDatetime($stamp)
	{
		return date('Y-m-d H:i:s', $stamp);
	}
	
}


?>