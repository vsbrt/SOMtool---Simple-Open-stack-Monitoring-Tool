<?php

$i = 0;
$search;

function ocean($service)
{
	global $i,$search;	
	
	include "db.php";

	$conn = mysqli_connect($hostname, $username, $password,$database);

	// Check connection
	if (!$conn)
	{
	   die("Connection failed: " . mysqli_connect_error());
	}
	
	mysqli_select_db($conn,"$database");	

	$result = mysqli_query($conn,"SELECT * FROM $service");        
	while($row = mysqli_fetch_assoc($result)) 
	{
		$search[$i]['service'] = $row['service'];
		$search[$i]['uptime'] = $row['uptime'];
		$search[$i]['status'] = $row['status'];
		$i++;
	}

return($i);

}

?>
