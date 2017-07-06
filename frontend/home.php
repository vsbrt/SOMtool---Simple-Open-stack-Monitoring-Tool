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
					<button type="submit" form = "logout" value = "submit" name = "logout" class="btn btn-primary" style = "margin: 15px 5px 0 0; padding: 5px 2px 5px 2px; width: 100%;">
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
  <li class = "active">Home</li>
  <li></li>
</ol>
</div>
</div>
				

<!--					<div class = "col-md-1" style = "background-color:black;"></div>
			<div class = "col-md-1" ></div>
			
			<div class = "col-md-1" style = "background-color:black;"></div>
			<div class = "col-md-1" "></div>
			
			<div class = "col-md-1" style = "background-color:black;"></div>
			<div class = "col-md-1" ></div>
			
			<div class = "col-md-1" style = "background-color:black;"></div>
			<div class = "col-md-1" ></div>
			
			<div class = "col-md-1" style = "background-color:black;"></div>
			<div class = "col-md-1" ></div>
			
			<div class = "col-md-1" style = "background-color:black;"></div>
			<div class = "col-md-1" ></div>
		
-->
		
<div class = "row" style = "margin: 0;">


<!-- Navigation panel -->
<div class = "col-md-1" style = "padding: 0; border-right: solid 1px black; height: 1241px;">
	<div class = "container-fluid" style = "margin: 0; padding: 0;">
		<ul class = "nav nav-pills nav-stacked">
			<li role = "presentation" class = "active"><a href = "home.php">Home</a></li>
			<li role = "presentation"><a href = "monitor.php">Monitor</a></li>
			<li role = "presentation"><a href = "statistics.php">Statistics</a></li>
			<li role = "presentation"><a href = "accounts.php">Accounts</a></li>
		</ul>
	</div>
</div>



<div class = "col-md-8" style = "padding: 0; border-right: solid 1px black; height: 1241px;">
	<div class = "container-fluid" style = "margin: 0px; padding: 0px;">
		<div class = "jumbotron" style = "border: solid 1px black; padding: 20px; margin: 50px;">
		<h2 style = "text-align: center;">About the tool</h2>
		</br>
		<p>The tool has three modules:
			<ul>
				<li>Backend: Connects to the OpenStack node via SSH connection.</li>
				<li>MySQL Database: Stores service uptimes, their status, restart counts, user credentials, etc.</li>
				<li>Frontend: Is What Your Seeing Right Now!!!!!!</li>
			</ul>
		</p>
		</br>
		<p>The Web GUI includes three sections (other than Home):
			<ul>
				<li>Monitor webpage has provision to restart services. Also displays number of service restarts since the first run (of BackEnd script).</li>
				<li>Statistics webpage shows the uptime of various OpenStack services. For service uptime graphs goto any desired service tab in this page.</li>
				<li>Accounts webpage has provision to change the credentials of existing users as well as to register new users </li>
			</ul>
		</p>
		<p><h5 id = "home">The Service Status Panel appears on the left side of every webpage of the website. This panel shows the status of the OpenStack services. When a service is running, its corresponding status will appear as 'Running' in GREEN color. If a service stops running, its corresponding status changes to 'Stopped' shown in RED color. This panel refreshes every 5 seconds.
		</br>Please Note:- The Web GUI is tested on Firefox browser. Hence, to experience all the features i.e., for proper rendering of the Web GUI it is adviced to use Firefox browser.
		</h5></p>
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
