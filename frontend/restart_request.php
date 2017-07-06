<?php

include 'db.php';

// Create connection
$connection = mysqli_connect($hostname, $username, $password,$database);

// Check connection
if (!$connection) {
   echo("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully<br>";



$res=$_POST['restart'];


 
foreach($res as $service)
	{
	echo "selected $service<br>"; 
	$query = "UPDATE restart SET request = '1' WHERE service = '$service'";

	if (mysqli_query($connection, $query)) {
	    echo "New record created successfully<br>";
	} else {
	    echo "Error: " . $query . "<br>" . mysqli_error($connection);
	}
}

header("Location: monitor.php");
die();

?>
