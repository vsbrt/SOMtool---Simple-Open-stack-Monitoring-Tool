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
  <li class = "active">Accounts</li>
  <li class = "active">Change Credentials</li>
  <li></li>
</ol>
</div>
</div>
				

<div class = "row" style = "margin: 0;">


<!-- Navigation panel -->
<div class = "col-md-1" style = "padding: 0; border-right: solid 1px black; height: 1241px;">
	<div class = "container-fluid" style = "margin: 0; padding: 0;">
		<ul class = "nav nav-pills nav-stacked">
			<li role = "presentation"><a href = "home.php">Home</a></li>
			<li role = "presentation"><a href = "monitor.php">Monitor</a></li>
			<li role = "presentation"><a href = "statistics.php">Statistics</a></li>
			<li role = "presentation"  class = "active"><a href = "accounts.php">Accounts</a></li>
		</ul>
	</div>
</div>



<div class = "col-md-8" style = "padding: 0; border-right: solid 1px black; height: 1241px;">
	<div class = "container-fluid" style = "margin: 0px; padding: 0px;">
		<div class = "row" style = "margin: 0;">
			<ul class="nav nav-tabs">
			  <li role="presentation"><a href = "accounts.php" class = "active">Register New Users</a></li>
			  <li role="presentation" class = "active"><a href = "change.php">Change Credentials</a></li>
			</ul>	
		</div>
		
		<div class = "row" style = "margin: 0;">
			<h3 style = "text-align: center; color: green; padding-bottom: 10px">Change Credentials</h3>
				<div class = "col-md-3" style = "padding: 0;"></div>
				<div class = "col-md-6" style = "padding: 0; text-align: center;">
<div class = "jumbotron" style = "border: solid 2px black; padding: 20px;">
	<form id = "login" method = "POST" action = "./change.php">
								
<input type = "text" class="form-control" placeholder="Username" name = "username" method = "POST" style = "margin-top: 10px;"
value = "<?php if(isset($_POST['username'])){echo $_POST['username'];} else{}?>"></input>
</br>
								
<input type = "password" class="form-control" placeholder="Current Password" name = "cpassword" method = "POST" style = "margin-top: 10px;"></input>
</br>

<input type = "password" class="form-control" placeholder="New Password" name = "npassword" method = "POST" style = "margin-top: 10px;"></input>
</br>

<input type = "password" class="form-control" placeholder="Retype New Password" name = "rnpassword" method = "POST" style = "margin-top: 10px;"></input>
</br>								
	</form>
							
<button form = "login" type="submit" name = "login" class="btn btn-success">Submit</button>
	
<?php
include 'db.php';
include 'database_front.php';

if(!isset($_POST["username"])  && !isset($_POST["cpassword"]) && !isset($_POST["npassword"]) && !isset($_POST["rnpassword"]))
{

}

elseif(empty($_POST["username"]) && empty($_POST["cpassword"]) && empty($_POST["npassword"]) && empty($_POST["rnpassword"]) )
{
	echo '
	<div class="alert alert-danger" role="alert" style = "margin-top: 10px; margin-bottom: 0;">
		<span class="glyphicon glyphicon-ban-circle" aria-hidden="true" style = "margin-right: 10px;"></span>
	Check the fields again!
	</div>';
}

elseif(isset($_POST["username"]) && isset($_POST["cpassword"]) && isset($_POST["npassword"]) && isset($_POST["rnpassword"]) )
{
		
	if(!empty($_POST["username"]))
	{
		if(!empty($_POST["cpassword"]))
		{
			if(!empty($_POST["npassword"]))
			{
				if(!empty($_POST["rnpassword"]))
				{
		$un = $_POST["username"];
		$cpass = $_POST["cpassword"];
		$npass = $_POST["npassword"];
		$rnpass = $_POST["rnpassword"];
		
	$sql = "SELECT * FROM users WHERE username = '$un'";
	if($result = mysqli_query($connection,$sql))
	{
		$arr = mysqli_fetch_array($result);
		
		if ($un == $arr["username"])
		{
			if($cpass == $arr["password"])
			{
				if($npass == $rnpass)
				{
					$sql = "UPDATE users SET password = '$npass' WHERE username = '$un'";
					if($result = mysqli_query($connection,$sql))
					{
						echo '
						<div class="alert alert-success" role="alert" style = "margin-top: 10px; margin-bottom: 0;">
							<span class="glyphicon glyphicon-ok" aria-hidden="true" style = "margin-right: 10px;"></span>
						Credentials updated successfully!
						</div>';
					}
				}
				else
				{
					echo '
					<div class="alert alert-danger" role="alert" style = "margin-top: 10px; margin-bottom: 0;">
						<span class="glyphicon glyphicon-remove-circle" aria-hidden="true" style = "margin-right: 10px;"></span>
					Retype new password!
					</div>';

				}
			}
			else
			{
				echo '
				<div class="alert alert-danger" role="alert" style = "margin-top: 10px; margin-bottom: 0;">
					<span class="glyphicon glyphicon-remove-circle" aria-hidden="true" style = "margin-right: 10px;"></span>
				Current password is wrong!
				</div>';
			}
		}
		else
		{
			echo '
			<div class="alert alert-danger" role="alert" style = "margin-top: 10px; margin-bottom: 0;">
				<span class="glyphicon glyphicon-remove-circle" aria-hidden="true" style = "margin-right: 10px;"></span>
			Wrong username typed!
			</div>';

		}
		
	}
		

		mysqli_close($connection);
		

				}
				else
				{
					echo '
					<div class="alert alert-danger" role="alert" style = "margin-top: 10px; margin-bottom: 0;">
						<span class="glyphicon glyphicon-remove-circle" aria-hidden="true" style = "margin-right: 10px;"></span>
					Retype new password is empty!
					</div>';
				}
			}
			else
			{
				echo '
				<div class="alert alert-danger" role="alert" style = "margin-top: 10px; margin-bottom: 0;">
				<span class="glyphicon glyphicon-ban-circle" aria-hidden="true" style = "margin-right: 10px;"></span>
				New Password is empty!
				</div>';
			}
		}
		else
		{
			echo '
			<div class="alert alert-danger" role="alert" style = "margin-top: 10px; margin-bottom: 0;">
				<span class="glyphicon glyphicon-ban-circle" aria-hidden="true" style = "margin-right: 10px;"></span>
			Current password is wrong!
			</div>';
		}

	}
	else
	{
		echo '
		<div class="alert alert-danger" role="alert" style = "margin-top: 10px; margin-bottom: 0;">
			<span class="glyphicon glyphicon-ban-circle" aria-hidden="true" style = "margin-right: 10px;"></span>
		Username field empty!
		</div>';
	}
}
else
{
	echo '
	<div class="alert alert-danger" role="alert" style = "margin-top: 10px; margin-bottom: 0;">
		<span class="glyphicon glyphicon-ban-circle" aria-hidden="true" style = "margin-right: 10px;"></span>
	Check the fields again!
	</div>';
}

?>

							
</div>
				
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
	</body>

	
	<footer>By Oceans11</footer>
	
</html>
