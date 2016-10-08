<?php 
	include "query.php";
	$id = $_POST["disc"];
	if(isset($_SESSION['diskon'])){
		$_SESSION['diskon'][] = $id;
	}else{
		$arrtemp = array($id);
		$_SESSION['diskon'] = $arrtemp;
	}
	header("location:newInvoicefix.php");
 ?>