<?php
	
	include_once('../php_backend.php');
	
	
	
	$backend = backendCall('editDiscount', array(
			'percent' => $_POST['percent'] 
			
			
			));
			
		
?>

<script>
	window.location = '../index.php';
</script>