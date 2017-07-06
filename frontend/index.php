<?php

//set session path
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']).'/session'));
//clear previous sessions
ini_set('session.gc_probability', 1);
//start session


include 'db.php';

// Create connection
$conn = mysqli_connect($hostname, $username, $password,$database);


if (mysqli_connect_errno()) {   echo "Failed to connect to MySQL: " . mysqli_connect_error();
}//check connection
$username =mysqli_real_escape_string($conn, $_POST["username"]); 
$password =mysqli_real_escape_string($conn,$_POST["password"]); ////get the input values                                              
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
session_start();


if(!empty($_POST["username"]))
{
    if(!empty($_POST["password"]))
    {//// if the username and password is not empty,then execute the query

    $res=mysqli_query($conn,"SELECT * FROM users WHERE username='".$username."' || password='".$password."' ") or die(mysqli_error());////get the row value accoring to the input username and password
    
    if(mysqli_num_rows($res) == 1) ////to check the number of rows, if it is 1 then execute the loop
    {
        
         $row = mysqli_fetch_assoc($res);
        $user = $row['username'];
        $pass = $row['password'];//assign the row values to the variables
        if ($password != $pass || $username != $user)
        {
       		if ($username != $user)
       		{
       			$misuser = "* invalid username";
       		}
       		if ($password != $pass) {
       		
       			$mispass= "* invalid password";
       		}
        } //if not match
        
        
        else{  
        $_SESSION["username"] = $_POST['username'];
        
            header("Location: ./home.php");
					}
        
        
        
     }   
      
    
    
    else{
    
    $noboth= "* Invalid username/password";
    
    		}
    }
    
    else{
          $nopass="* Password is empty" ;
        }
        
        
      
}

else {
    $nouser="* Username is empty";////error message
		 }


}
mysqli_close($conn);

?>


<!DOCTYPE html>
	<html>
		<head>
			
			<meta name = "viewport" content = "width = device-width , initial-scale = 1">
			<link rel="icon" href="favicon.ico" type="image/x-icon">
			<link rel = "stylesheet" href = "bootstrap/css/bootstrap.min.css">
			<link rel = "stylesheet" href = "bootstrap/css/bootstrap-theme.min.css">

			<link rel = "stylesheet" href = "bootstrap/css/style.css">
			<title>
				Simple OpenStack Monitoring Tool  |  Login
			</title>
		</head>
	
		<body>
		
			<div id = "t1">
				<div class = "row">
					<div class = "col-md-1">
						
						<a href="login.html">
						<img src = "os.PNG" href="" width = "80%" height = "80%"> 
						</a>
					</div>
					<div class = "col-md-10" style = "padding: 0;">
						<h2>Simple OpenStack Monitoring Tool</h2>
					</div>
					<div class = "col-md-1"></div>
				</div>
			</div>
		
			<div class = "container-fluid" style = "height: 560px;">	
				</br>
				<div class = "row" style = "margin: 5em 0 0 0;">
					<div class = "col-md-4" style = "padding: 0;"></div>
						
				</div>
				
				<div class = "row" style = "margin: 0;">
					<div class = "col-md-4 col-md-offset-4" style = "padding: 0;">
						<div class = "jumbotron" style = "border: solid 2px black; padding: 20px;">
							<form id = "login" method = "POST" action = "">
								
<input type = "text" class="form-control" placeholder="username*" name = "username" method = "POST" style = "margin-top: 10px;"><span style="color: red;"><?php echo $nouser.$misuser; ?></span></input>
</br>
								
<input type = "password" class="form-control" placeholder="password*" name = "password" method = "POST" style = "margin-top: 10px;"><span style="color: red;"><?php echo $nopass.$mispass; ?></span></input>
</br>								
							</form>
					<span style="color: red;"><?php echo $noboth; ?></span>		
<button form = "login" type="submit" name = "login" class="btn btn-success" style = "margin-left: 157.5px;">LOGIN</button>
							
						</div>
					</div>
				</div>
			</div>
		</body>
		
		<footer>By Oceans11</footer>
		
		
	</html>
