<?php
include 'db.php';

// Create connection
$conn = mysqli_connect($hostname, $username, $password,$database);

// Check connection
if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully<br>";

mysqli_select_db($conn,"$database");
$result = mysqli_query($conn,"SELECT * FROM neutron");
?>


<div>
<table class = "table table-bordered" style = "width: 100%; text-align: center;">
<tr style = "padding: 2px;">
<th  style = "text-align: center;">Service</th>
<th  style = "text-align: center;">UpTime(D-HH:MM:SS)</th>

</tr>
<?php
$i=0;
while($row = mysqli_fetch_array($result)) {
?>

<tr style = "padding: 2px;">

<td><?php echo $row["service"]; ?></td>
<td><?php echo $row["uptime"]; ?></td>


</tr>
<?php
$i++;
}
?>
</table>

</div>
