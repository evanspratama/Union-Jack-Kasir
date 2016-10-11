<?php
include "query.php";
secure("view_promo.php");
$makan=get("promo","SELECT * from promo ");
if(isset($_POST["delete"])){
$id=$_POST["delid"];
delete("promo",$id);
}
?>
<html>
<head>
<link rel="stylesheet" href="css/stock-style.css">
</head>
<body>
<a href="insert_promo.php?id=">Insert New</a>
<table class="table-fill" border='2'>
<tr>
<th>IDPromo</th>
<th>Nama</th>
<th>Diskon</th>
</tr>
<?php
for($i=0;$i<sizeof($makan);$i++){
echo "<tr><td>";
$id=$makan[$i]["IdPromo"];
echo $makan[$i]["IdPromo"]."</td><td>";
echo $makan[$i]["Nama"]."</td><td>";
echo $makan[$i]["Diskon"]."</td><td>";
echo "<a href=\"insert_promo.php?id=$id\">Update</a></td><td>";
echo " <form action='' method='post'><input type='submit' name='delete' value='Delete'></td>";
echo "</tr>";
echo "<input type='hidden' value='$id' name='delid'></form>";
}
echo "</table>";
?>
<a href="adminhome.php">Kembali</a>
</body>
</html>