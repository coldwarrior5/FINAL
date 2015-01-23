<?php

class UrlError
{

	
	static function invalidUrl()
	{
		return "-7";	
	}
	
	
	static function noToken()
	{
		return "-10";	
	}
	
	static function invalidToken()
	{
		return "-11";	
	}
	
	static function expectedOnlyLetters()
	{
		return "-12";	
	}
	
	static function expectedNumber()
	{
		return "-17";	
	}
	
	static function emptyFields()
	{
		return "-4";	
	}
	
	static function urlErrorOccured()
	{
		return "-22";	
	}
		
}

class TimeError
{
	
	static function expired()
	{
		return "-19";	
	}
	
	static function timeErrorOccured()
	{
		return "-21";	
	}
	
}

class AuthenticationError
{
	static function passwordsDoNotMatch()
	{
		return "-1";	
	}	
	
	
	static function emailExists()
	{
		return "-2";	
	}
	
	static function tokenExists()
	{
		return "-18";	
	}
	
	static function wrongEmailFormat()
	{
		return "-3";	
	}
	
	static function emptyFields()
	{
		return "-4";	
	}
	
	static function AuthenticationErrorOccured()
	{
		return "-5";	
	}
	
	static function authorizationError()
	{
		return "-8";	
	}
	
	static function shortPassword()
	{
		return "-23";	
	}
	
			
}

class DatabaseError
{

	static function notInserted()
	{
		return "-13";	
	}
	
	static function emptyResult()
	{
		return "-14";	
	}
	
	static function noRecord()
	{
		return "-15";	
	}
	
	static function removeFailure()
	{
		return "-16";	
	}
	
	static function databaseErrorOccured()
	{
		return "-20";	
	}
	
        static function usernameTaken()
	{
		return "-24";	
	}
}

class CommonError
{
	static function Error()
	{
		return "-99";	
	}
}

?>