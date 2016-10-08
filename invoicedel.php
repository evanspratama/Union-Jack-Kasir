<?php 
	session_start();
	$key = $_GET['key'];
	unset($_SESSION['arr'][$key]);
	header("location: newInvoicefix.php");
 ?>