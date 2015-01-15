<?php
	session_start();
	
	$_SESSION['id'] = $_GET['id'];
	$_SESSION['role'] = $_GET['role'];
	
	

?>

<script>
	window.location = 'index.php';
</script>