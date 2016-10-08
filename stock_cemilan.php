<?php
include "query.php";
secure("stock_cemilan.php");
$makan=get("cemilan","SELECT * from cemilan ");
if(isset($_POST["delete"])){
$id=$_POST["delid"];
delete("cemilan",$id);
}
?>
<html>
<head>
<link rel="stylesheet" href="stock-style.css">
</head>
<body>
<a href="data_cemilan_insert.php?id=">Insert New</a>
<table class="table-fill" border='2'>
<tr>
<th>ID_Cemilan</th>
<th>Nama</th>
<th>Harga</th>
<th>Stock</th>
</tr>
<?php
for($i=0;$i<sizeof($makan);$i++){
echo "<tr><td>";
$id=$makan[$i]["IdCemilan"];
echo $makan[$i]["IdCemilan"]."</td><td>";
echo $makan[$i]["Nama"]."</td><td>";
echo $makan[$i]["harga"]."</td><td>";
echo $makan[$i]["stock"]."</td><td>";
echo "<a href=\"data_cemilan_insert.php?id=$id\">Update</a></td><td>";
echo " <form action='' method='post'><input type='submit' name='delete' value='Delete'></td>";
echo "</tr>";
echo "<input type='hidden' value='$id' name='delid'></form>";
}
echo "</table>";
?>
<a href="adminhome.php">Kembali</a>
</body>
</html>