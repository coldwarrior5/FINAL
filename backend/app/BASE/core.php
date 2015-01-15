<?php
include_once('../BASE/authentication.php');

try
{
	
	$conn = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8', $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'')); 
					 
}
catch(PDOException $e)
{
	echo "Server error! - Could not connect to database server: ", $e->getMessage();
}
?>