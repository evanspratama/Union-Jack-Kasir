<?php 
	include "query.php";
	if(isset($_SESSION["cp"])){
		if($_SESSION["cp"]){

		}else{
			header("location:adminhome.php");
		}
	}else{
		header("location:index.php");
	}
	if(isset($_POST["password1"])||isset($_POST["password2"])){
		if($_POST["password1"]==$_POST["password2"]){
			$temp = hashpass($_POST["password1"]);
			$tipetemp = $_POST["tipe1"];
			$sql="UPDATE `user` SET `hash`='".$temp."' WHERE tipe=".$tipetemp.";";
			if(isset($_POST["cp"])){
				unset($_POST["cp"]);
			}
			if(mysqli_query($conn,$sql)){
				echo('<p>Ganti password berhasil!</p></br><a href="adminhome.php">back</a>');
			}else{
				echo('<p>Error, ganti password gagal!</p></br><a href="adminhome.php">back</a>');
			}

		}else{
			echo('<p>password yang dimasukan tidak sama</p></br><a href="changepassword2.php">back</a>');

		}
		
	}else{
		echo('<p>Masukan password dahulu!</p></br><a href="changepassword2.php">back</a>');
	}
	if(isset($_POST["password1"])){
		unset($_POST["password1"]);
	}
	if(isset($_POST["password2"])){
		unset($_POST["password2"]);
	}
	
 ?>
