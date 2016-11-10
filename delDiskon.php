<?php 
	include "query.php";
	$temp = $_GET["del"];
	foreach($_SESSION['diskon'] as $key=>$value){
		//$disctemp = $disctemp.",".$value."%";
		if($value==$temp){
			$_SESSION['diskon'][$key]=101;
			//$value=101;
		}
		//$_SESSION['diskon'][$temp]=101;
	}
	header("location:newInvoicefix.php");
 ?>