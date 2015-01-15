<?php
	
	include_once('../php_backend.php');
	
	
	if($_POST['password'] != $_POST['repassword'])
	{
		echo 'Lozinke nisu iste!';
		exit(-1);
	}
	
	if($_POST['password'] == '')
	{
		echo 'Lozinke ne smije biti prazna!';
		exit(-1);
	}
	
	if($_POST['username'] == '')
	{
		echo 'Korisničko ime ne smije biti prazno!';
		exit(-1);
	}
	
	$backend = backendCall('editUsernamePassword', array(
			'id' => $_POST['id'], 
			'username' => $_POST['username'], 
			'password' => $_POST['password']
			));
			
		
?>

<script>
	window.location = '../user.php';
</script>