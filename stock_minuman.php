<?php
include "query.php";
secure("stock_minuman.php");
$mnm=get("minuman","SELECT * from minuman");
if(isset($_POST["delete"])){
$id=$_POST["delid"];
delete("minuman",$id);
}
?>
<html>
<head>
<link rel="stylesheet" href="stock-style.css">
</head>
<body>
<a href="data_minuman_insert.php?id=">Insert New</a>
<table class="table-fill" border='2'>
<tr>
<th>ID_Minuman</th>
<th>Nama</th>
<th>Harga</th>
<th>Stock</th>
<th>Tipe</th>
</tr>
<?php
$tipe=0;
for($i=0;$i<sizeof($mnm);$i++){
echo "<tr><td>";
$id=$mnm[$i]["IdMinuman"];
$tipe = $mnm[$i]["tipe"];
echo $mnm[$i]["IdMinuman"]."</td><td>";
echo $mnm[$i]["Nama"]."</td><td>";
echo $mnm[$i]["harga"]."</td><td>";
echo $mnm[$i]["stock"]."</td><td>";
if($tipe == 0)
{
  echo "Botol</td><td>";
}
else
{
  echo "Sloki</td><td>";
}
echo "<a href=\"data_minuman_insert.php?id=$id\">Update</a></td><td>";
echo " <form action='' method='post'><input type='submit' name='delete' value='Delete'></td>";
echo "</tr>";
echo "<input type='hidden' value='$id' name='delid'></form>";
}
echo "</table>";
?>
<a href="adminhome.php">Kembali</a>
</body>
</html>
