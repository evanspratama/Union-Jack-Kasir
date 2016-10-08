<?php 
	session_start();
	$temp = explode(",",$_POST["menu"]);
	$tipe = $temp[0];
	$id = $temp[1];
	$jumlah = $_POST["jumlah"];
	$res = $_POST["menu"].",".$jumlah;
	//echo ($tipe.",".$id.",".$jumlah);
  	//$_SESSION['arr']= array();
	if(isset($_SESSION['arr'])){
		$_SESSION['arr'][] = $res;
	}else{
		$arrtemp = array($res);
		$_SESSION['arr'] = $arrtemp;
	}
	header("location:newInvoicefix.php");
 ?>