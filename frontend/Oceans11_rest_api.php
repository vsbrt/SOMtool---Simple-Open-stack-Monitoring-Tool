<?php
 
header("Content-Type:application/json");
include 'data.php';

if(!empty($_GET['service']))   
{
	$service = $_GET['service'];
	
	$response = ocean($service);
	   
	if(empty($response))
	{
		deliver_response(200,"Service not Found",NULL);
	}
	else
	{
		deliver_response(200,"Service Found",$response);
	}
}    
else
{
	deliver_response(400,"No entry Found",NULL);
}

function deliver_response($status,$status_message,$i)
{
	global $search;
	
	header("HTTP/1.1 $status $status_message");
	$reply['status']=$status;
	$reply['status_message']=$status_message;
	
	$json_response=json_encode($reply);
	echo "$json_response\n";
	
	
	
	for ($row = 0; $row < $i; $row++)
	{
		$result['service'] = $search[$row]['service'];
		$result['status'] = $search[$row]['status'];
		$result['uptime'] = $search[$row]['uptime'];

		$json_response=json_encode($result);
		echo "$json_response\n";
	}
	
}

?>
