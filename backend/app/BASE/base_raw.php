<?php
	
include_once('../BASE/core.php');
	
	
class BaseRaw
{
	static function fetch()
	{
		
			global $conn;
			$paramsx = func_get_args();
			$queryx = $paramsx[0];
			$params = array();
			for($i = 1, $j = 0; $i < count($paramsx); $i++, $j++)
			{
				$params[$j] = $paramsx[$i];
			}
			
			
			$query = $conn->prepare($queryx);
			
			for($i = 0; $i < count($params); $i++)
			{
				$query->bindValue($i + 1, $params[$i]);
			}
			
			$query->execute();
			
			$result = $query->fetch();
			
			return  $result;	
		
	}
	
	
	static function fetchAll()
	{
		
			global $conn;
			$paramsx = func_get_args();
			$queryText = $paramsx[0];
			$params = array();
			for($i = 1, $j = 0; $i < count($paramsx); $i++, $j++)
			{
				$params[$j] = $paramsx[$i];
			}
			
			
			$query = $conn->prepare($queryText);
			
			for($i = 0; $i < count($params); $i++)
			{
				$query->bindValue($i + 1, $params[$i]);
			}
			
			$query->execute();
			
			$result = $query->fetchAll();
			
			return  $result;	
		
	}
	
	static function last_id()
	{
		global $conn;
		$paramsx = func_get_args();
		$queryText = $paramsx[0];
		$params = array();
		for($i = 1, $j = 0; $i < count($paramsx); $i++, $j++)
		{
			$params[$j] = $paramsx[$i];
		}
		
		
		
		
		$query = $conn->prepare($queryText);
		
		for($i = 0; $i < count($params); $i++)
		{
			$query->bindValue($i + 1, $params[$i]);
		}
		
		$query->execute();
		
		return $conn->lastInsertId();
		
	}
	
	static function last_id_array($queryText, $array)
	{
		global $conn;

		$query = $conn->prepare($queryText);
		for($i = 0; $i < count($array); $i++)
		{
			$buffer = $array[$i];
			$query->bindValue($i + 1, $buffer);
		}
		
		$query->execute();
		
		return $conn->lastInsertId();
		
	}
	
	static function fetch_array($queryRaw, $params)
	{
		
		global $conn;
			$query = $conn->prepare($queryRaw);
			
			for($i = 0; $i < count($params); $i++)
			{
				$query->bindValue($i + 1, $params[$i]);
			}
			
			$query->execute();
			
			$result = $query->fetch();
			
			return  $result;	
		
	}
	
	static function fetchAll_array($queryText, $params)
	{
		global $conn;
			
			$query = $conn->prepare($queryText);
			
			for($i = 0; $i < count($params); $i++)
			{
				$query->bindValue($i + 1, $params[$i]);
			}
			
			
			$query->execute();
			
			$result = $query->fetchAll();
			
			return  $result;	
		
	}
	
	static function nothing()
	{
		global $conn;
		$paramsx = func_get_args();
		$queryText = $paramsx[0];
		$params = array();
		for($i = 1, $j = 0; $i < count($paramsx); $i++, $j++)
		{
			$params[$j] = $paramsx[$i];
		}
		
		
		$query = $conn->prepare($queryText);
		
		for($i = 0; $i < count($params); $i++)
		{
			$query->bindValue($i + 1, $params[$i]);
		}
		
		$query->execute();
	}
	
	
	static function nothing_array($queryText, $params)
	{
		global $conn;
		
		$query = $conn->prepare($queryText);
		
		for($i = 0; $i < count($params); $i++)
		{
			$query->bindValue($i + 1, $params[$i]);
		}
		
		$query->execute();
	}
	
	
}

?>