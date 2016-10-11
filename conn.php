<?php
$servername = "localhost";
$username = "root";
$password = "ggs123";
$db_name="beer_mart";
//create connection
$conn=mysqli_connect($servername,$username,$password);
mysqli_select_db($conn,$db_name);
?>