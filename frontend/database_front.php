<?php

	include 'db.php';
	
	// Create connection
	$connection = mysqli_connect($hostname, $username, $password,$database);
	
	// Check connection
	if (!$connection)
	{
    		die("Connection failed: " . mysqli_connect_error());
	}
	
?>
