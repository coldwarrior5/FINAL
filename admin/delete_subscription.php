<?php
	
	include_once('php_backend.php');
	
	$id = $_GET['id'];
	
	$backend = backendCall('removeSubscription', array(
			'id' => $id
			
			));
			
		
?>

<script>
	window.location = 'user.php';
</script>