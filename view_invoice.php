<?php
include "query.php";
secure("view_invoice.php");
$mkn=get("Invoice","SELECT * from Invoice ");
if(isset($_POST["delete"])){
$id=$_POST["delid"];
delete("Invoice",$id);
}
?>
<html>
<head>
<link rel="stylesheet" href="css/stock-style.css">
</head>
<body>
<table class="table-fill" border='2'>
<tr>
<td>ID_Invoice</td>
<td>ID_Pengguna</td>
<td>Harga</td>
<td>Tanggal</td>
<td>Tipe_Pelanggan</td>
<td>IdPromo</td>
<td>Status</td>
<td></td>
<td></td>
</tr>
<?php
for($i=0;$i<sizeof($mkn);$i++){
echo "<tr><td>";
$id=$mkn[$i]["IdInvoice"];
$npm=$mkn[$i]["idPengguna"];
echo $mkn[$i]["IdInvoice"]."</td><td>";
echo $mkn[$i]["idPengguna"]."</td><td>";
echo $mkn[$i]["TotalHarga"]."</td><td>";
echo $mkn[$i]["Tanggal"]."</td><td>";
echo $mkn[$i]["Tipe"]."</td><td>";
echo $mkn[$i]["IdPromo"]."</td><td>";
$tipe=$mkn[$i]["status"]."</td><td>";
if($tipe==0){
echo "Lunas</td><td>";
}
if($tipe==1){
echo "Pending</td><td>";
}
if($tipe==2){
echo "Pelunasan Pending</td><td>";
}
echo "<a href=\"newInvoice.php?id=$id\">View</a></td><td>";
//echo " <form action='' method='post'><input type='submit' name='delete' value='Delete'></td>";
//echo "</tr>";
//echo "<input type='hidden' value='$id' name='delid'></form>";
}
echo "</table>";
?>
"<form action='' method='post'><input type='submit' name='print' value='Print'></td>
<a href="adminhome.php">Kembali</a>
</body>
</html>