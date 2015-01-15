<?php

	include_once('../MONGO_BASE/core.php');




class MongoBase
{
	public static function insert($table, $associativeArray)
	{
		$connectionString = Core::coreConnect($table);
		
		$data = $associativeArray;
		
		
		
		$options = array(
			'http' => array(
				'header'  => "Content-type: application/json\r\n",
				'method'  => 'POST',
				'content' => json_encode($data),
			),
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($connectionString, false, $context);
		
		$response = json_decode($result, true);
		return $response['_id']['$oid'];
	}
	
	
	public static function selectOne($table, $associativeArray)
	{
		
		$connectionString = Core::coreConnect($table);
		
		$result = file_get_contents($connectionString.'&q='.urlencode(json_encode($associativeArray)));
		$buffer = json_decode($result, true);
		return $buffer[0];
		

	}
	
	
	public static function selectAll($table)
	{
		
		$connectionString = Core::coreConnect($table);
		
		$result = file_get_contents($connectionString);
		$buffer = json_decode($result, true);
		return $buffer;
		

	}
	
	public static function select($table, $associativeArray)
	{
		
		$connectionString = Core::coreConnect($table);
		
		$result = file_get_contents($connectionString.'&q='.urlencode(json_encode($associativeArray)));
		$buffer = json_decode($result, true);

		return $buffer;
		

	}
	
	
	public static function update($table, $what, $where)
	{
		$connectionString = Core::coreConnect($table);
		
		$connectionString = $connectionString.'&q='.urlencode(json_encode($where)).'&m=true';
		$data = $what;
		
		
		
		$options = array(
			'http' => array(
				'header'  => "Content-type: application/json\r\n",
				'method'  => 'PUT',
				'content' => '{ "$set" :'.json_encode($data).'}',
			),
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($connectionString, false, $context);
		
		$response = json_decode($result, true);
		return $response;
	}
	
	
	public static function selectFromId($table, $id)
	{
		$connectionString = Core::coreWithId($table, $id);

		$result = file_get_contents($connectionString);
		
		$response = json_decode($result, true);
		return $response;
	}
	
	
	public static function delete($table, $id)
	{
		$connectionString = Core::coreWithId($table, $id);		
		
		$options = array(
			'http' => array(
				'header'  => "Content-type: application/json\r\n",
				'method'  => 'DELETE',

			),
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($connectionString, false, $context);
		
		$response = json_decode($result, true);
		return $response;
	}
}


//
?>