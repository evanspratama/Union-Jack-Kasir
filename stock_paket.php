<?php
include "query.php";
secure("stock_paket.php");
$mnm=get("paket","SELECT * from paket");
if(isset($_POST["delete"])){
$id=$_POST["delid"];
delete("paket",$id);
}
?>
<html>
<head>
<link rel="stylesheet" href="stock-style.css">
</head>
<body>
<a href="data_paket_insert.php?id=">Insert New</a>
<table class="table-fill" border='2'>
<tr>
<th>ID_Paket</th>
<th>Nama</th>
<th>ID_Minuman</th>
<th>Jumlah</th>
</tr>
<?php
$tipe=0;
for($i=0;$i<sizeof($mnm);$i++){
echo "<tr><td>";
$id=$mnm[$i]["IdPaket"];
echo $mnm[$i]["IdPaket"]."</td><td>";
echo $mnm[$i]["Nama"]."</td><td>";
echo $mnm[$i]["IdMinuman"]."</td><td>";
echo $mnm[$i]["jumlah"]."</td><td>";
echo "<a href=\"data_paket_insert.php?id=$id\">Update</a></td><td>";
echo " <form action='' method='post'><input type='submit' name='delete' value='Delete'></td>";
echo "</tr>";
echo "<input type='hidden' value='$id' name='delid'></form>";
}
echo "</table>";
?>
<a href="adminhome.php">Kembali</a>
</body>
</html>