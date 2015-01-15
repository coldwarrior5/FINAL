<?php
	
	include_once('../php_backend.php');
	
	
	
	$backend = backendCall('addParking', array(
			'name' => $_POST['name'], 
			'address' => $_POST['address'], 
			'latitude' => $_POST['latitude'], 
			'longitude' => $_POST['longitude'], 
			'spots' => $_POST['spots'], 
			'type' => $_POST['type'], 
			'price' => $_POST['price']
			
			));
			
		
?>

<script>
	window.location = '../index.php';
</script>