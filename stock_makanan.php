<?php
include "query.php";
secure("stock_makanan.php");
$makan=get("makanan","SELECT * from makanan ");
if(isset($_POST["delete"])){
$id=$_POST["delid"];
delete("makanan",$id);
}
?>
<html>
<head>
<link rel="stylesheet" href="css/stock-style.css">
</head>
<body>
<a href="data_makanan_iu.php?id=">Insert New</a>
<table class="table-fill" border='2'>
<tr>
<th>ID_Makanan</th>
<th>Nama</th>
<th>Harga</th>
<th>Keluar</th>
</tr>
<?php
for($i=0;$i<sizeof($makan);$i++){
echo "<tr><td>";
$id=$makan[$i]["IdMakanan"];
echo $makan[$i]["IdMakanan"]."</td><td>";
echo $makan[$i]["Nama"]."</td><td>";
echo $makan[$i]["harga"]."</td><td>";
echo $makan[$i]["stock"]."</td><td>";
echo "<a href=\"data_makanan_iu.php?id=$id\">Update</a></td><td>";
echo " <form action='' method='post'><input type='submit' name='delete' value='Delete'></td>";
echo "</tr>";
echo "<input type='hidden' value='$id' name='delid'></form>";
}
echo "</table>";
?>
<a href="adminhome.php">Kembali</a>
</body>
</html>