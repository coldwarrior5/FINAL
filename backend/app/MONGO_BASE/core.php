<?php
	include_once('../MONGO_BASE/authentication.php');


//MONGOLAB API QUERY
class MongolabCore
{	
	public static function coreConnect($collection)
	{
		global $mongoDatabase;
		global $mongoAppKey;
	
		$mongoDB = 'https://api.mongolab.com/api/1/databases/'
		.$mongoDatabase
		.'/collections/'
		.$collection
		.'?apiKey='
		.$mongoAppKey;
		
		return $mongoDB;
	}
	
	public static function coreWithId($collection, $id)
	{
		global $mongoDatabase;
		global $mongoAppKey;
	
		$mongoDB = 'https://api.mongolab.com/api/1/databases/'
		.$mongoDatabase
		.'/collections/'
		.$collection.
		'/'.$id
		.'?apiKey='
		.$mongoAppKey;
		
		return $mongoDB;
	}
}


//DEFAULT API QUERY
class Core
{	
	public static function coreConnect($collection)
	{
		global $mongoDatabase;
		global $mongoAppKey;
	
		$mongoDB = 'https://api.mongolab.com/api/1/databases/'
		.$mongoDatabase
		.'/collections/'
		.$collection
		.'?apiKey='
		.$mongoAppKey;
		
		return $mongoDB;
	}
	
	public static function coreWithId($collection, $id)
	{
		global $mongoDatabase;
		global $mongoAppKey;
	
		$mongoDB = 'https://api.mongolab.com/api/1/databases/'
		.$mongoDatabase
		.'/collections/'
		.$collection.
		'/'.$id
		.'?apiKey='
		.$mongoAppKey;
		
		return $mongoDB;
	}
}


?>