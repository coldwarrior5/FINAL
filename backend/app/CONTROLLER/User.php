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

class UserController
{
	public static function registerUser($username, $password, $name, $surname, $oib, $dateOfBirth, $address, $email, $phone, $card)
	{
		Revan::validateNullOrEmpty($username, $password, $name, $surname, $oib, $dateOfBirth, $email, $phone, $card);
		
		$registeredUser = Registriranikorisnik::init($username, Security::wrapSha1($password), $name, $surname);
		$registeredUser->save();
		

		$dob = date('Y-m-d H:i:s', $dateOfBirth);
		
		$user = Prijavljenikorisnik::init($registeredUser->id, $oib, $dob, $address, $email, $phone, $card, -1);
		$user->save();
		
		Json::renderSuccess("User registered");
	}
	
	public static function login($username, $password)
	{
		Revan::validateNullOrEmpty($username, $password);
		
		$userRaw = Registriranikorisnik::init($username, Security::wrapSha1($password), NULL, NULL);
		$userFilter = $userRaw->filter();
		$user = new Registriranikorisnik;
		

	
if(count($userFilter) == 0)
		{
			Json::renderError(DatabaseError::noRecord());
		}
		
		$user = $userFilter[0];
		$role = "User";
		
		$userBufferRaw = Prijavljenikorisnik::init($user->id, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
		$userBufferFilter = $userBufferRaw->filter();
		
		if(count($userBufferFilter) == 0)
		{
			$role = "Admin";
		}
		
		$returnArray = array();
		$returnArray['Role'] = $role;
		$returnArray['UserId'] = $user->id;
		
		
		global $callback; echo $callback.'('.json_encode($returnArray).')';
	}
	
	static function editUsernamePassword($id, $username, $password)
	{
		Revan::validateNullOrEmpty($id, $username, $password);
		
		$user = Registriranikorisnik::find($id);
		$user->korisnickoIme = $username;
		$user->lozinka = Security::wrapSha1($password);
		
		$user->save();
		
		Json::renderSuccess("Izmjenjeno");
	}
	
	static function editUserInfo($id, $name, $surname, $oib, $dateOfBirth, $address, $email, $phone, $card)
	{
		Revan::validateNullOrEmpty($id, $name, $surname, $oib, $dateOfBirth, $address, $email, $phone, $card);
		
		$registrered = Registriranikorisnik::find($id);
		$registrered->ime = $name;
		$registrered->prezime = $surname;
		$registrered->save();
		
		$userRaw = Prijavljenikorisnik::init($id, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
		$userFilter = $userRaw->filter();
		
		$user = new Prijavljenikorisnik;
		$user = $userFilter[0];
		
		$userMain = Prijavljenikorisnik::init($id, $oib, $user->datumRodenja, $address, $email, $phone, $card, -1);
		$userMain->id = $user->id;
		
		$userMain->save();
		
		Json::renderSuccess("Izmjenjeno");
		
	}
	
	static function getAllUsers()
	{
		$usersMaster = Registriranikorisnik::findAll();
		$returnArray = array();
		
		foreach($usersMaster as $element)
		{
			$user = new Prijavljenikorisnik;
			$user = $element;
			
			$userPrimeData = Prijavljenikorisnik::find($user->id);
			
			array_push($returnArray, $user);
		}
		
		Json::renderObjectArray($returnArray);
	}
	
	static function getUserInfo($id)
	{
		Revan::validateNullOrEmpty($id);
		
		$registeredUser = Registriranikorisnik::find($id);
		$array = array();
		
		$array['ime'] = $registeredUser->ime;
		$array['prezime'] = $registeredUser->prezime;
		$array['korisnickoIme'] = $registeredUser->korisnickoIme;
		
		$loginedUserRaw = Prijavljenikorisnik::init($id, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
		$loginedUserFilter = $loginedUserRaw->filter();
		
		$loginedUser = new Prijavljenikorisnik;
		$loginedUser = $loginedUserFilter[0];
		
		Json::wrapModelWithArray($loginedUser, $array);
		
		
	}
}

?>
