<!doctype HTML>
<?php
include "query.php";
$data = array("","","");
if($_GET["id"] == 0){
 $data[0]="";
 $data[1]="";
 $data[2]="";
}
else{
$result=get("paket","SELECT * FROM `paket` WHERE IdPaket='" .$_GET["id"]. "';");
	$data[0]=$result[0]["Nama"];
	$data[1]=$result[0]["IdMinuman"];
	$data[2]=$result[0]["jumlah"];
}
?>
<html>
<body>
<form action="" method="post">
<table>	
<td>Nama  		: </td><td><?php echo "<input type='text' name='Nama' value = '" .$data[0]. "'></input>"; ?></td>
</tr>
<tr>
<td>IdMinuman		: </td><td><?php echo "<input type='text' name='IdMinuman' value = '" .$data[1]. "'></input>"; ?></td>
</tr>
<tr>
<td>Jumlah	: </td><td><?php echo "<input type='text' name='jumlah' value = '" .$data[2]. "'></input>"; ?></td>
</tr>
<tr>
</table>
<input type="submit" value="Submit" name="submit"></input>
<a href="stock_paket.php">Kembali</a>
</form>
<?php
if(isset($_POST["submit"])){
	$data[0]=$_POST["Nama"];
	$data[1]=$_POST["IdMinuman"];
	$data[2]=$_POST["jumlah"];
	if($_GET["id"] == 0){
	insert("paket",$data);	
	}
	else{
	update("paket",$_GET["id"],$data);
	}
}
?>
</body>
</html>