<?php

//set session path
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']).'/session'));
//clear previous sessions
ini_set('session.gc_probability', 1);
//start session
session_start();

if(!isset($_SESSION["username"]))
{
	header("Location: ./index.php");
}

include 'database_front.php';
?>
<!DOCTYPE html>
<html>
	<head>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		<link rel = "stylesheet" href = "bootstrap/css/bootstrap.min.css">
		<link rel = "stylesheet" href = "bootstrap/css/bootstrap-theme.min.css">
		<link rel = "stylesheet" href = "bootstrap/css/style.css">

		<script type="text/javascript" src="./java.js"></script>
		<script type="text/JavaScript">

			var auto_refresh = setInterval(
			function ()
			{
			$('#tweet').load('status_panel.php').fadeIn("slow");
			}, 5000); // refresh every 5000 milliseconds

		</script>

		<title>
			Simple OpenStack Monitoring Tool  |  Home
		</title>
	</head>


	<body>
		<div class = "container-fluid" style = "margin: 0px; padding: 0px; width: 100%; height: 100%;">
			<div id = "t1">
				<div class = "container-fluid" style = "margin: 0px; padding: 0px;">
				<div class = "row">
					<div class = "col-md-1">
					<div class = "container-fluid" style = "margin: 0px; padding: 0px;">
						<a href="home.php">
						<img src = "os.PNG" width = "80%" height = "80%">
						</a>
					</div>
					</div>
					<div class = "col-md-10" style = "padding: 0;">
					<div class = "container-fluid" style = "margin: 0px; padding: 0px;">
						<h2>Simple OpenStack Monitoring Tool</h2>
					</div>
					</div>
					<div class = "col-md-1" style = "padding: 0 5px 0 0;">
					<div class = "container-fluid" style = "margin: 0px; padding: 0px;">
					<form action = "logout.php" id = "logout"></form>
					<button type="submit" form = "logout" name = "logout" value = "submit" class="btn btn-primary" style = "margin: 15px 5px 0 0; padding: 5px 2px 5px 2px; width: 100%;">
						<span class="glyphicon glyphicon-off" > Logout</span>
					</button>
					</div>
					</div>
				</div>
				</div>
			</div>

<div class = "container-fluid" style = "margin: 0px; padding: 0px; border-bottom: solid 1px black;">
<div class = "row" style = "width: 100%;">
<ol class = "breadcrumb" style = "padding: 2px 0 2px 25px; margin: 0; background-color: white;">
  <li class = "active">Monitor</li>
  <li></li>
</ol>
</div>
</div>
				
<div class = "row" style = "margin: 0;">


<!-- Navigation panel -->
<div class = "col-md-1" style = "padding: 0;">
	<div class = "container-fluid" style = "margin: 0; padding: 0;">
		<ul class = "nav nav-pills nav-stacked">
			<li role = "presentation"><a href = "home.php">Home</a></li>
			<li role = "presentation" class = "active"><a href = "monitor.php">Monitor</a></li>
			<li role = "presentation"><a href = "statistics.php">Statistics</a></li>
			<li role = "presentation"><a href = "accounts.php">Accounts</a></li>
		</ul>
	</div>
</div>


<!-- Restart Services Panel -->
<div class = "col-md-8" style = "padding: 0;">
	<div class = "container-fluid" style = "margin: 0px; padding: 0px; border-right: solid 1px black; border-left: solid 1px black; height: 1241px;">
		<h3 style = "text-align: center; color: green; padding-bottom: 10px">Service Restart</h3>
			<div class = "col-md-3" style = "padding: 0;"></div>
			<div class = "col-md-6" style = "padding: 0;">
			<form action="restart_request.php" method = "POST">
			<table class = "table table-bordered" style = "width: 100%; text-align: center;">
			    <thead>
			      <tr>
				<th  style = "text-align: center;">Service</th>
				<th  style = "text-align: center;">No. of </br>Restarts</th>
				<th  style = "text-align: center;">Select</th>
			      </tr>
			    </thead>
			    <tbody>
			      <tr style = "padding: 2px;">
				<td>Nova</td>
				<td>
				<?php				
					$query = "SELECT count FROM restart WHERE service = 'nova'";
					$result = mysqli_query($connection, $query);
					
					while($row = mysqli_fetch_assoc($result))
					{
						echo $row["count"];
					}
				?></td>
				<td>
				<input type = "checkbox" name = "restart[]" value = "nova">
				</td>
			      </tr>
			      <tr style = "padding: 2px;">
				<td>Neutron</td>
				<td>
				<?php				
					$query = "SELECT count FROM restart WHERE service = 'neutron'";
					$result = mysqli_query($connection, $query);
					
					while($row = mysqli_fetch_assoc($result))
					{
						echo $row["count"];
					}
				?></td>
				<td>
				<input type = "checkbox" name = "restart[]" value = "neutron">
				</td>
			      </tr>
			      <tr style = "padding: 2px;">
				<td>Cinder</td>	
				<td>
				<?php				
					$query = "SELECT count FROM restart WHERE service = 'cinder'";
					$result = mysqli_query($connection, $query);
					
					while($row = mysqli_fetch_assoc($result))
					{
						echo $row["count"];
					}
				?></td>		
				<td>
				<input type = "checkbox" name = "restart[]" value = "cinder">
				</td>
			      </tr>
			      <tr style = "padding: 2px;">
				<td>Keystone</td>
				<td>
				<?php				
					$query = "SELECT count FROM restart WHERE service = 'keystone'";
					$result = mysqli_query($connection, $query);
					
					while($row = mysqli_fetch_assoc($result))
					{
						echo $row["count"];
					}
				?></td>		
				<td>
				<input type = "checkbox" name = "restart[]" value = "keystone">
				</td>
			      </tr>
			      <tr style = "padding: 2px;">
				<td>Glance</td>
				<td>
				<?php				
					$query = "SELECT count FROM restart WHERE service = 'glance'";
					$result = mysqli_query($connection, $query);
					
					while($row = mysqli_fetch_assoc($result))
					{
						echo $row["count"];
					}
				?></td>		
				<td>
				<input type = "checkbox" name = "restart[]" value = "glance">
				</td>
			      </tr>
			      <tr style = "padding: 2px;">
				<td>Heat</td>
				<td>
				<?php				
					$query = "SELECT count FROM restart WHERE service = 'heat'";
					$result = mysqli_query($connection, $query);
					
					while($row = mysqli_fetch_assoc($result))
					{
						echo $row["count"];
					}
				?></td>	
				<td>
				<input type = "checkbox" name = "restart[]" value = "heat">
				</td>
			      </tr>
			    </tbody>
			</table>
			<input type = "submit" name = "submit" value = "RESTART" style = "width: 100%;"></form>		
		</div>
	</div>
</div>
	
	
	<!-- Service Status Panel -->
	<div class = "col-md-3" id = "tweet" style = "padding: 0 5px 0 0;">
		<div  style = "margin-top: 200px; margin-right: 5px; margin-left: 5px; margin-bottom: 5px;">
			Please Wait, Service Status Panel is Loading ...
			<div class = "progress" style = "margin: 5px; margin-top: 10px;">
				<div class = "progress-bar progress-bar-striped active" role = "progressbar" style = "width: 75%">Loading</div>
			</div>
		</div>
	</div>
</div>
</div>
	</body>

	
	<footer>By Oceans11</footer>
	
</html>
