<?php

	include_once('../BASE/base_raw.php');
	
class Base
{
	

	
	static function insert($table, $keyValues)
	{
		
		$queryPrefix = "INSERT INTO `".$table."` (";
		$valuesArray = array();
		foreach($keyValues as $key => $value)
		{
			$queryPrefix .= "`".$key."`,";
			array_push($valuesArray, $value);
		}
		
		$queryPrefix = substr_replace($queryPrefix, "", -1);
		
		$queryPrefix .= ") VALUES (";
		
		foreach($keyValues as $element)
		{
			$queryPrefix .= "?,";
		}
		
		$queryPrefix = substr_replace($queryPrefix, "", -1);
		$queryPrefix .= ")";	
		
		return BaseRaw::last_id_array($queryPrefix, $valuesArray);
		
	}
	
	static function selectAND($table, $whereAndOperator, $multipleResult = true)
	{
		$query = "SELECT * FROM `".$table."`";
		
		
		if(count($whereAndOperator) != 0)
		{
			$query .= " WHERE ";
			
			$values = array();
			foreach($whereAndOperator as $key => $value)
			{
				$query .= $key." = ? AND ";
				array_push($values, $value);
				
			}
			
			$query = substr_replace($query, "", -5);
			
		}
		
		if($multipleResult)
		{
			return BaseRaw::fetchAll_array($query, $values);
		}
		else
		{
			
			return BaseRaw::fetch_array($query, $values);
		}
		
	}
	
	
	static function selectOR($table, $whereAndOperator, $multipleResult = true)
	{
		$query = "SELECT * FROM `".$table."`";
		
		
		if(count($whereAndOperator) != 0)
		{
			$query .= " WHERE ";
			
			$values = array();
			foreach($whereAndOperator as $key => $value)
			{
				$query .= $key." = ? OR ";
				array_push($values, $value);
			}

			$query = substr_replace($query, "", -4);
		}
		
		if($multipleResult)
		{
			return BaseRaw::fetchAll_array($query, $values);
		}
		else
		{
			return BaseRaw::fetch_array($query, $values);
		}
		
	}
	
	static function updateAND($table, $keyValues, $whereArray)
	{
		$query = 'UPDATE `'.$table.'` SET ';
		$values = array();
		
		foreach($keyValues as $key => $value)
		{
			$query .= "`".$key."` = ?,";
			array_push($values, $value);
		}
		
		$query = substr_replace($query, "", -1);
		
		$query .= " WHERE ";
		
		foreach($whereArray as $key => $value)
		{
			$query .= "`".$key."` = ? AND ";
			array_push($values, $value);
		}
		
		$query = substr_replace($query, "", -5);
		
		return BaseRaw::nothing_array($query, $values);;
		
	}
	
	
	static function updateOR($table, $keyValues, $whereArray)
	{
		$query = 'UPDATE `'.$table.'` SET ';
		$values = array();
		
		foreach($keyValues as $key => $value)
		{
			$query .= "`".$key."` = ?,";
			array_push($values, $value);
		}
		
		$query = substr_replace($query, "", -1);
		
		$query .= " WHERE ";
		
		foreach($whereArray as $key => $value)
		{
			$query .= "`".$key."` = ? OR ";
			array_push($values, $value);
		}
		
		$query = substr_replace($query, "", -4);
		
		return BaseRaw::nothing_array($query, $values);
		
	}
	
	static function deleteAND($table, $whereArray)
	{
		$query = 'DELETE FROM `'.$table.'` WHERE ';
		$values = array();

		foreach($whereArray as $key => $value)
		{
			$query .= "`".$key."` = ? AND ";
			array_push($values, $value);
		}
		
		$query = substr_replace($query, "", -5);
		
		return BaseRaw::nothing_array($query, $values);
		
		
	}
	
	static function deleteOR($table, $whereArray)
	{
		$query = 'DELETE FROM `'.$table.'` WHERE ';
		$values = array();

		foreach($whereArray as $key => $value)
		{
			$query .= "`".$key."` = ? OR ";
			array_push($values, $value);
		}
		
		$query = substr_replace($query, "", -4);
		
		return BaseRaw::nothing_array($query, $values);
		
		
	}
	
	static function selectAll($table)
	{
		$query = 'SELECT * FROM `'.$table.'`';
		
		return BaseRaw::fetchAll($query);
	}
	
	
	
	
}

?>