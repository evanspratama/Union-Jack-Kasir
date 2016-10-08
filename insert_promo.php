<!doctype HTML>
<?php
include "query.php";
$data = array("","");
if($_GET["id"] == 0){
 $data[0]="";
 $data[1]="";

}
else{
$result=get("promo","SELECT * FROM `promo` WHERE IdPromo='" .$_GET["id"]. "';");
	$data[0]=$result[0]["Nama"];
	$data[1]=$result[0]["Diskon"];
}
?>
<html>
<body>
<form action="" method="post">
<table>	
<td>Nama  		: </td><td><?php echo "<input type='text' name='Nama' value = '" .$data[0]. "'></input>"; ?></td>
</tr>
<tr>
<td>Diskon		: </td><td><?php echo "<input type='text' name='Diskon' value = '" .$data[1]. "'></input>"; ?></td>
</tr>
<tr>
</table>
<input type="submit" value="Submit" name="submit"></input>
<a href="stock_makanan.php">Kembali</a>
</form>
<?php
if(isset($_POST["submit"])){
	$data[0]=$_POST["Nama"];
	$data[1]=$_POST["Diskon"];

	if($_GET["id"] == 0){
	insert("promo",$data);	
	}

	else{
	update("promo",$_GET["id"],$data);
	}
}
?>
</body>
</html>