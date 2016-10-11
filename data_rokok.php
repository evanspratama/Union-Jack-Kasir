<?php
include "query.php";
secure("data_rokok.php");
$makan=get("rokok","SELECT * from rokok");
if(isset($_POST["delete"])){
$id=$_POST["delid"];
delete("rokok",$id);
}
?>
<html>
<head>
<link rel="stylesheet" href="css/stock-style.css">
</head>
<body>
<a href="data_rokok_iu.php?id=">Insert New</a>
<table class="table-fill" border='2'>
<tr>
<th>ID_Rokok</th>
<th>Nama</th>
<th>Harga</th>
<th>Stock</th>
</tr>
<?php
for($i=0;$i<sizeof($makan);$i++){
echo "<tr><td>";
$id=$makan[$i]["IdRokok"];
echo $makan[$i]["IdRokok"]."</td><td>";
echo $makan[$i]["Nama"]."</td><td>";
echo $makan[$i]["harga"]."</td><td>";
echo $makan[$i]["stock"]."</td><td>";
echo "<a href=\"data_rokok_iu.php?id=$id\">Update</a></td><td>";
echo " <form action='' method='post'><input type='submit' name='delete' value='Delete'></td>";
echo "</tr>";
echo "<input type='hidden' value='$id' name='delid'></form>";
}
echo "</table>";
?>
<a href="adminhome.php">Kembali</a>
</body>
</html>