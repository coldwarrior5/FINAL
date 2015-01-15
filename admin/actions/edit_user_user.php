<?php
	
	include_once('../php_backend.php');
	
	
	
	$backend = backendCall('editUserInfo', array(
			'id' => $_POST['id'], 
			'name' => $_POST['name'], 
			'surname' => $_POST['surname'], 
			'oib' => $_POST['oib'], 
			'address' => $_POST['address'], 
			'email' => $_POST['email'], 
			'date' => '44',
			'phone' => $_POST['phone'],  
			'card' => $_POST['card']
			
			));
			
		
?>

<script>
	window.location = '../user.php';
</script>