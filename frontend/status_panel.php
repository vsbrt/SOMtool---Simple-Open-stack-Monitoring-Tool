<div style = "text-align: center;"><h5><strong>Service Status Panel</strong></h5></div>
<?php

include 'database_front.php';

$services = array("nova","neutron","cinder","glance","heat","keystone");

foreach($services as $ser)
{
	echo '	<table class = "table table-bordered" style = "width: 100%; text-align: center;">
		    <thead>
		      <tr>
			<th  style = "text-align: center;">' . $ser . '</th>
			<th  style = "text-align: center;">Status</th>
		      </tr>
		    </thead>
		    <tbody>';

		    
//Query for Nova Status 
	$query = "SELECT service,status FROM $ser";
	$result = mysqli_query($connection, $query);
	
	if (mysqli_num_rows($result) > 0)
	{
	    while($row = mysqli_fetch_assoc($result))
	    {
	    	echo '<tr style = "padding: 2px;">
			<td>' . $row["service"] . '</td>';
			
		if($row["status"] == "start/running,\n")
		{
			echo '<td style = "color: green;">Running</td></tr>';
		}
		else
		{
			echo '<td id = "blink" style = "color: red;">ERROR</td></tr>';
		}
	    }
	}
	
	else
	{
	    echo "0 results";
	}
		
}
	
		
?>
