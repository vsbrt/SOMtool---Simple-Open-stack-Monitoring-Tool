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
			Simple OpenStack Monitoring Tool  |  Statistics
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
					<button type="submit" form = "logout" value = "submit" name = "logout" class="btn btn-primary" style = "margin: 15px 5px 0 0; padding: 5px 2px 5px 2px; width: 100%;">
						<span class="glyphicon glyphicon-off" > Logout</span>
					</button>
					</div>
					</div>
				</div>
				</div>
			</div>

<!--Breadcrumb-->
<div class = "container-fluid" style = "margin: 0px; padding: 0px; border-bottom: solid 1px black;">
<div class = "row" style = "width: 100%;">
<ol class = "breadcrumb" style = "padding: 2px 0 2px 25px; margin: 0; background-color: white;">
  <li class = "active">Statistics</li>
  <li class = "active">Neutron</li>
  <li></li>
</ol>
</div>
</div>
				

<div class = "row" style = "margin: 0;">


<!-- Navigation panel -->
<div class = "col-md-1" style = "padding: 0;">
	<div class = "container-fluid" style = "margin: 0; padding: 0; height: 550px;">
		<ul class = "nav nav-pills nav-stacked">
			<li role = "presentation"><a href = "home.php">Home</a></li>
			<li role = "presentation"><a href = "monitor.php">Monitor</a></li>
			<li role = "presentation" class = "active"><a href = "statistics.php">Statistics</a></li>
			<li role = "presentation"><a href = "accounts.php">Accounts</a></li>
		</ul>
	</div>
</div>

<!--statistics panel-->
<div class = "col-md-8" style = "padding: 0; border-left: solid 1px black; border-right: solid 1px black; ">
	<div class = "container-fluid" style = "margin: 0px; padding: 0px; height: 1241px;">
		<div class = "row" style = "margin: 0;">
			<ul class="nav nav-tabs">
			  <li role="presentation"><a href="nova_graphs.php">Nova</a></li>
			  <li role="presentation"  class="active"><a href="neutron_graphs.php">Neutron</a></li>
			  <li role="presentation"><a href="glance_graphs.php">Glance</a></li>
			  <li role="presentation"><a href="cinder_graphs.php">Cinder</a></li>
			  <li role="presentation"><a href="heat_graphs.php">Heat</a></li>
			  <li role="presentation"><a href="keystone_graphs.php">Keystone</a></li>
			</ul>			
		</div>
		
		<div class = "row" style = "margin: 0;">
			<h3 style = "text-align: center; color: green; padding-bottom: 10px">Uptimes of Neutron services</h3>
				<div class = "col-md-3" style = "padding: 0;"></div>
				<div class = "col-md-6" style = "padding: 0; text-align: center;">
				
				<?php include 'neutron_uptime.php';?>
				
				</div>		
		</div>
		
	<div class = "row" style = "margin: 0;">
		<div class = "col-md-1" style = "padding: 0;"></div>
		<div class = "col-md-10" style = "padding: 0; text-align: center;">
		<?php	system("perl neutron.pl");	?>
		<img src = "./graphs/neutron.png" title = "Neutron Services Uptime" width = "100%" height = "100%" style = "margin-top: 50px;">
	</div>
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
</div>

	</body>

	
	<footer>By Oceans11</footer>
</html>
