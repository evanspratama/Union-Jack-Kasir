<?php 
	include "query.php";
		$row=login($_POST["tipe"],$_POST["password"]);
		$_SESSION['tipe'] = $_POST["tipe"];
		if(password_verify($_POST["password"],$row["hash"])){
			if(isset($_SESSION["tipe"])){
				echo "berhasil";
			}else{
				echo "gagal";
			}
			
			if ($_POST["tipe"]==0) {
				header ("location:adminhome.php");
			}else{
				header ("location:newInvoicefix.php");
			}
		 
		}
		else{
		echo "password salah </br>";
		session_destroy();
		echo '<a href="index.php">back</a>';
		}
	
 ?>