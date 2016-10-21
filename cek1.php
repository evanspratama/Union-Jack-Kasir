<?php 
	include "query.php";
		$row=login(0,$_POST["password"]);
		if(password_verify($_POST["password"],$row["hash"])){
			header ("location:changepassword2.php");
			$_SESSION["cp"]=true;
		}
		else{
		echo "password salah </br>";
		echo '<a href="changepassword1.php">back</a>';
		}
	
 ?>
