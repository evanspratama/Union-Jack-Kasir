<?php 
	include "query.php";
	secure();
 ?>
<html>
<head>
<title>admin home</title>
<link rel="stylesheet" href="css/style2.css">
</head>
<body>
	<div id="satu">
<h1>Selamat Datang Admin</h1>
<h2>silahkan pilih opsi anda</h2>
</div>
<div id="pilihan">
<ul>
<li><a href="stock_makanan.php">Stock Makanan</a></li>
<li><a href="stock_minuman.php">Stock Minuman</a></li>
<li><a href="view_invoice.php">Invoice</a></li>
<li><a href="stock_cemilan.php">Cemilan</a></li>
<li><a href="data_rokok.php">Rokok</a></li>
<li><a href="logout.php">Log out</a></li>
</ul>
</div>
</body>
</html>