<?php
 include "conn.php" ;
 
 function getMaxID($type){
	global $conn;
	if($type == "makanan"){
		$sql = "SELECT max(IdMakanan) as res from makanan";		 
	}
	if($type == "minuman"){
		$sql = "SELECT max(IdMinuman) as res from minuman";		 
	}
	if($type == "promo"){
	$sql = "SELECT max(IdPromo) as res from promo";		 
	}
	if($type == "rokok"){
	$sql = "SELECT max(IdRokok) as res from rokok";		 
	}
	if($type == "cemilan"){
	$sql = "SELECT max(IdCemilan) as res from cemilan";		 
	}
		if($type == "invoice"){
	$sql = "SELECT max(IdInvoice) as res from invoice";		 
	}
	$res = mysqli_fetch_assoc(mysqli_query($conn,$sql));
	return $res["res"];
 }
 
 function insert($type,$data){
	global $conn;
	if($type=="makanan"){
		$id=getMaxID("makanan");
		$id++;
		$sql="INSERT INTO `makanan`(`IdMakanan`, `Nama`, `harga`, `stock`) VALUES('".$id."','".$data[0]."','".$data[1]."',0);";
		mysqli_query($conn,$sql);
		return "Data makanan berhasil dimasukan";
	}
	if($type=="minuman"){
		$id=getMaxID("minuman");
		$id++;
		$sql="INSERT INTO `minuman`(`IdMinuman`, `Nama`, `harga`, `stock`,`tipe`) VALUES('".$id."','".$data[0]."','".$data[1]."','".$data[2]."','".$data[3]."');";
		mysqli_query($conn,$sql);
		return "Data minuman berhasil dimasukan";
	}
	if($type=="promo"){
		$sql="INSERT INTO `promo`(`IdPromo`, `Nama`, `Diskon`) Values('".$id."','".$data[0]."','".$data[1]."');";
		mysqli_query($conn,$sql);
		return "Data makanan berhasil dimasukan";
	}
	if($type=="rokok"){
		$id=getMaxID("rokok");
		$id++;
		$sql="INSERT INTO `rokok`(`IdRokok`, `Nama`, `harga`,`stock`) Values('".$id."','".$data[0]."','".$data[1]."','".$data[2]."');";
		mysqli_query($conn,$sql);
		return "Data makanan berhasil dimasukan";
	}
	if($type=="cemilan"){
		$id=getMaxID("cemilan");
		$id++;
		$sql="INSERT INTO `cemilan`(`IdCemilan`, `Nama`, `harga`,`stock`) Values('".$id."','".$data[0]."','".$data[1]."','".$data[2]."');";
		mysqli_query($conn,$sql);
		return "Data makanan berhasil dimasukan";
	}
	if($type=="invoice"){
		$id=getMaxID("invoice");
		$id++;
		$sql="INSERT INTO `invoice`(`IdInvoice`, `idPengguna`, `TotalHarga`, `Tanggal`,`Tipe`,`IdPromo`,`promo`,`status`) VALUES('".$id."',1,'".$data[1]."','".$data[2]."','1',1,'".$data[4]."','".$data[5]."');";
		mysqli_query($conn,$sql);
		return "Data makanan berhasil dimasukan";
	}
	
 }
 function get($type,$sql){
	global $conn;
	$i=0;
	$result=array();
	if($sql==""){
		switch($type){
			case "Invoice":
				$sql="SELECT * FROM invoice";
			break;
			case "minuman":
				$sql="SELECT * FROM minuman";
			break;
			case "makanan":
				$sql="SELECT * FROM makanan";
			break;
			case "cemilan":
				$sql="SELECT * FROM cemilan";
			break;
			case "promo":
				$sql="SELECT * FROM promo";
			break;
			default:
				return null;
			break;
		}
	}
	if($type== "Invoice"){
		$arrayres=mysqli_query($conn,$sql);
		while($row = mysqli_fetch_assoc($arrayres)){
		$result[$i]["IdInvoice"]=$row ["IdInvoice"];
		$result[$i]["idPengguna"]=$row ["idPengguna"];
		$result[$i]["TotalHarga"]=$row ["TotalHarga"];
		$result[$i]["Tanggal"]=$row ["Tanggal"];
		$result[$i]["Tipe"]=$row ["Tipe"];
		$result[$i]["IdPromo"]=$row ["IdPromo"];
		$result[$i]["status"]=$row ["status"];
		$result[$i]["NamaPending"]=$row ["NamaPending"];
		$i++;
		}
		}

		if($type== "minuman"){
		$arrayres=mysqli_query($conn,$sql);
		while($row = mysqli_fetch_assoc($arrayres)){
		$result[$i]["IdMinuman"]=$row ["IdMinuman"];
		$result[$i]["Nama"]=$row ["Nama"];
		$result[$i]["deskripsi"]=$row ["deskripsi"];
		$result[$i]["harga"]=$row ["harga"];
		$result[$i]["stock"]=$row ["stock"];
		$result[$i]["tipe"]=$row ["tipe"];
		$i++;
		}
	}
		if($type== "makanan"){
		$arrayres=mysqli_query($conn,$sql);
		while($row = mysqli_fetch_assoc($arrayres)){
		$result[$i]["IdMakanan"]=$row ["IdMakanan"];
		$result[$i]["Nama"]=$row ["Nama"];
		$result[$i]["deskripsi"]=$row ["deskripsi"];
		$result[$i]["harga"]=$row ["harga"];
		$result[$i]["stock"]=$row ["stock"];
		$i++;
		}
	}
	 	if($type== "cemilan"){
	 		$arrayres=mysqli_query($conn,$sql);
			while($row = mysqli_fetch_assoc($arrayres)){
			$result[$i]["IdCemilan"]=$row ["IdCemilan"];
			$result[$i]["Nama"]=$row ["Nama"];
			$result[$i]["deskripsi"]=$row ["deskripsi"];
			$result[$i]["harga"]=$row ["harga"];
			$result[$i]["stock"]=$row ["stock"];
			$i++;
			}
		}
		if($type== "rokok"){
			$arrayres=mysqli_query($conn,$sql);
			while($row = mysqli_fetch_assoc($arrayres)){
			$result[$i]["IdRokok"]=$row ["IdRokok"];
			$result[$i]["Nama"]=$row ["Nama"];
			$result[$i]["harga"]=$row ["harga"];
			$result[$i]["stock"]=$row ["stock"];
			$i++;
			}
		}	

		if($type== "menu"){
			$arrayres=mysqli_query($conn,$sql);
			while($row = mysqli_fetch_assoc($arrayres)){
			$result[$i]["IdMenu"]=$row ["IdMenu"];
			$result[$i]["Nama"]=$row ["Nama"];
			$result[$i]["IdMakanan"]=$row ["IdMakanan"];
			$result[$i]["JumlahMakanan"]=$row ["JumlahMakanan"];
			$result[$i]["IdMinuman"]=$row ["IdMinuman"];
			$result[$i]["JumlahMinuman"]=$row ["JumlahMinuman"];
			$result[$i]["IdCemilan"]=$row ["IdCemilan"];
			$result[$i]["JumlahCemilan"]=$row ["JumlahCemilan"];
			$i++;
			}
		}

		if($type== "promo"){
		$arrayres=mysqli_query($conn,$sql);
		while($row = mysqli_fetch_assoc($arrayres)){
		$result[$i]["IdPromo"]=$row ["IdPromo"];
		$result[$i]["Nama"]=$row ["Nama"];
		$result[$i]["Diskon"]=$row ["Diskon"];
		$i++;
		}
	}	
	return $result;
 }

 function update($type,$id,$data){
	global $conn;
	if($type=="minuman"){
	$sql="UPDATE `minuman` SET `IdMinuman`='".$id."',`Nama`='".$data[0]."',`harga`='".$data[1]."',`stock`='".$data[2]."',`tipe`='".$data[3]."' WHERE IdMinuman='".$id."'";
	mysqli_query($conn,$sql);
	}
	if($type=="makanan"){
	$sql="UPDATE `makanan` SET `IdMakanan`='".$id."',`Nama`='".$data[0]."',`harga`='".$data[1]."' WHERE IdMakanan='".$id."'";
	mysqli_query($conn,$sql);
	}
	if($type=="promo"){
	$sql="UPDATE `promo` SET `IdPromo`='".$id."',`Nama`='".$data[0]."',`Diskon`='".$data[1]."' WHERE IdPromo='".$id."'";
	mysqli_query($conn,$sql);
	}
	if($type=="rokok"){
	$sql="UPDATE `rokok` SET `IdRokok`='".$id."',`Nama`='".$data[0]."',`harga`='".$data[1]."',`stock`='".$data[2]."' WHERE IdRokok='".$id."'";
	mysqli_query($conn,$sql);
	}
	if($type=="cemilan"){
	$sql="UPDATE `cemilan` SET `IdCemilan`='".$id."',`Nama`='".$data[0]."',`harga`='".$data[1]."',`stock`='".$data[2]."' WHERE IdCemilan='".$id."'";
	mysqli_query($conn,$sql);
	}
 }
 session_start();
 function secure(){
 	if(isset($_SESSION["tipe"])==false){
 		header("location: bad.php");
 	}else{
 		if($_SESSION["tipe"]==0){
 		}else{
 			header("location: index.php");
 		}
 	}
 }
 
 function delete($type,$id){
	global $conn;
	if($type == "makanan"){
	$sql="DELETE FROM `makanan` WHERE `IdMakanan`='".$id."'";
	}
	if($type == "minuman"){
	$sql="DELETE FROM `minuman` WHERE `IdMinuman`='".$id."'";
	}
	if($type == "invoice"){
	$sql="DELETE FROM `Invoice` WHERE `IdInvoice`='".$id."'";
	}
	if($type == "promo"){
	$sql="DELETE FROM `Promo` WHERE `IdPromo`='".$id."'";
	}
	if($type == "rokok"){
	$sql="DELETE FROM `rokok` WHERE `IdRokok`='".$id."'";
	}
	if($type == "cemilan"){
	$sql="DELETE FROM `cemilan` WHERE `IdCemilan`='".$id."'";
	}
	mysqli_query($conn,$sql);
 }

 function hashpass($password){
 	$a = password_hash($password, PASSWORD_BCRYPT);
	
	return $a;
 }
 function login($tipe,$password){
	global $conn;
	//$sql="SELECT * FROM `mahasiswa` WHERE username='".$username."' and password='".$password."' ";
	$sql="SELECT * FROM `user` WHERE tipe='".$tipe."'";
	if(mysqli_num_rows(mysqli_query($conn,$sql))>0){
		$arrayres=mysqli_query($conn,$sql);
		$row=mysqli_fetch_assoc($arrayres);
		return $row;
	}
	return null;
 }

 function pesananMinuman($idP,$idM){
 	global $conn;
 	$harga=0;
 	$total=0;
 	$idI=0;
 	$sql="SELECT `harga` from Minuman where Minuman.IdMinuman='".$idM."'";
 	$harga= mysqli_query($conn,$sql);
 	$sql2= "INSERT INTO `pesanan_Minuman`(`IdPesanan`, `IdMinuman`) Values('".$idP."','".$idM."');";
	mysqli_query($conn,$sql2);
	$sql="UPDATE `pesanan` SET `harga`=`harga` + '".$harga."' WHERE IdPesanan='".$idP."'";
	mysqli_query($conn,$sql);
	$sql="SELECT SUM(pesanan.harga) from `pesanan`  inner join `Invoice` on pesanan.idInvoice=Invoice.idInvoice  where pesanan.idPesanan='".$idP."'";
	$total=mysqli_query($conn,$sql);
	$sql="SELECT `IdInvoice` from `pesanan` where `IdPesanan`='".$idP."'";
	$idI=mysqli_query($conn,$sql);
	$sql="UPDATE `Invoice` SET `totalharga`='".$total."' WHERE IdInvoice='".$idI."'";
	mysqli_query($conn,$sql);
	$sql="UPDATE `Minuman` SET `Stock`= `Stock` - '1' WHERE IdMinuman='".$idM."'";
	mysqli_query($conn,$sql);
 }

 function pesananMakanan($idP,$idM){
 	global $conn;
 	$harga=0;
 	$total=0;
 	$idI=0;
 	$sql="SELECT `harga` from Makanan where Makanan.IdMakanan='".$idM."'";
 	$harga= mysqli_query($conn,$sql);
 	$sql2= "INSERT INTO `pesanan_Makanan`(`IdPesanan`, `IdMakanan`) Values('".$idP."','".$idM."');";
	mysqli_query($conn,$sql2);
	$sql="UPDATE `pesanan` SET `harga`=`harga` + '".$harga."' WHERE IdPesanan='".$idP."'";
	mysqli_query($conn,$sql);
	$sql="SELECT SUM(pesanan.harga) from `pesanan`  inner join `Invoice` on pesanan.idInvoice=Invoice.idInvoice  where pesanan.idPesanan='".$idP."'";
	$total=mysqli_query($conn,$sql);
	$sql="SELECT `IdInvoice` from `pesanan` where `IdPesanan`='".$idP."'";
	$idI=mysqli_query($conn,$sql);
	$sql="UPDATE `Invoice` SET `totalharga`='".$total."' WHERE IdInvoice='".$idI."'";
	mysqli_query($conn,$sql);
	$sql="UPDATE `Makanan` SET `Stock`= `Stock` + '1' WHERE IdMakanan='".$idM."'";
	mysqli_query($conn,$sql);
 }

function pesananCemilan($idP,$idC){
 	global $conn;
 	$harga=0;
 	$total=0;
 	$idI=0;
 	$sql="SELECT `harga` from Cemilan where Cemilan.IdCemilan='".$idC."'";
 	$harga= mysqli_query($conn,$sql);
 	$sql2= "INSERT INTO `pesanan_Cemilan`(`IdPesanan`, `IdCemilan`) Values('".$idP."','".$idC."');";
	mysqli_query($conn,$sql2);
	$sql="UPDATE `pesanan` SET `harga`=`harga` + '".$harga."' WHERE IdPesanan='".$idP."'";
	mysqli_query($conn,$sql);
	$sql="SELECT SUM(pesanan.harga) from `pesanan`  inner join `Invoice` on pesanan.idInvoice=Invoice.idInvoice  where pesanan.idPesanan='".$idP."'";
	$total=mysqli_query($conn,$sql);
	$sql="SELECT `IdInvoice` from `pesanan` where `IdPesanan`='".$idP."'";
	$idI=mysqli_query($conn,$sql);
	$sql="UPDATE `Invoice` SET `totalharga`='".$total."' WHERE IdInvoice='".$idI."'";
	mysqli_query($conn,$sql);
	$sql="UPDATE `Cemilan` SET `Stock`= `Stock` - '1' WHERE IdCemilan='".$idC."'";
	mysqli_query($conn,$sql);
 }

function pesananRokok($idP,$idR){
 	global $conn;
 	$harga=0;
 	$total=0;
 	$idI=0;
 	$sql="SELECT `harga` from Rokok where Rokok.IdRokok='".$idR."'";
 	$harga= mysqli_query($conn,$sql);
 	$sql2= "INSERT INTO `pesanan_Rokok`(`IdPesanan`, `IdRokok`) Values('".$idP."','".$idR."');";
	mysqli_query($conn,$sql2);
	$sql="UPDATE `pesanan` SET `harga`=`harga` + '".$harga."' WHERE IdPesanan='".$idP."'";
	mysqli_query($conn,$sql);
	$sql="SELECT SUM(pesanan.harga) from `pesanan`  inner join `Invoice` on pesanan.idInvoice=Invoice.idInvoice  where pesanan.idPesanan='".$idP."'";
	$total=mysqli_query($conn,$sql);
	$sql="SELECT `IdInvoice` from `pesanan` where `IdPesanan`='".$idP."'";
	$idI=mysqli_query($conn,$sql);
	$sql="UPDATE `Invoice` SET `totalharga`='".$total."' WHERE IdInvoice='".$idI."'";
	mysqli_query($conn,$sql);
	$sql="UPDATE `Cemilan` SET `Stock`= `Stock` - '1' WHERE IdRokok='".$idR."'";
	mysqli_query($conn,$sql);
 }

function updateHarga($IdI,$harga){
	global $conn;
	$sql="UPDATE `Invoice` SET `totalharga`='".$harga."' WHERE IdInvoice='".$idI."'";
	mysqli_query($conn,$sql);
}

function setTotalHarga($IdI){
	global $conn;
	$harga=0;
	$sql="SELECT sum(harga) from pesanan where IdInvoice='".$idI."'";
	$harga = mysqli_query($conn,$sql);
	return $harga;
}

function getTipe($IdT){
	global $conn;
	$diskon=0;
	$sql="SELECT diskon from member where Tipe='".$idT."'";
	$diskon=mysqli_query($conn,$sql);
	return $diskon;
}

function getPromo($IdP){
	global $conn;
	$diskon=0;
	$sql="SELECT diskon from promo where IdPromo='".$idP."'";
	$diskon=mysqli_query($conn,$sql);
	return $diskon;
}
function getdiscmember($IdT){
	global $conn;
 	
 	$result = array();
	$sql="SELECT Diskon FROM MEMBER";
	$i=0;
	$arrayres=mysqli_query($conn,$sql);
	while($row = mysqli_fetch_assoc($arrayres)){
		$result[$i]=(int)$row ["Diskon"];
		$i++;
	}
	return $result[$IdT-1];
}
function potonganHarga($IdT,$harga){
	$diskon= getdiscmember($IdT);
	if ($diskon==0) {
 		return $harga;
 	}else{
 		$harga=$harga-(($harga*$diskon)/100);
 		return $harga;
 	}
 	//$harga1=0;
 	//$harga2=0;
 	//$harga3=0;
 	//$harga = setTotalHarga($IdP);
 	/*if(($IdT != null or $IdT != 0)and($IdP != null or $IdP!=0))
 	{
 		$diskon = getTipe($idT);
		$harga1 = $harga * 0.01*$diskon;
		$harga2 = $harga - $harga1;
		$diskon1 = getPromo($idP);
		$harga1 = $harga2 * 0.01*$diskon1;
		$harga3 = $harga2 - $harga1;
		$harga = $harga3;
 	}
 	elseif($IdT != null or $IdT != 0)
 	{
 		$diskon = getTipe($idT);
		$harga1 = $harga * 0.01*$diskon;
		$harga2 = $harga - $harga1;
		$harga = $harga2;
 	}
 	elseif($IdP != null or $IdP!=0)
 	{
 		$diskon1 = getPromo($idP);
		$harga1 = $harga * 0.01*$diskon1;
		$harga2 = $harga - $harga1;
		$harga = $harga2;
 	}*/
 	return $harga;
 	//updateHarga($IdI,$harga);
 }

 function delPesananMinuman($IdP,$IdM){
 	global $conn;
 	$harga = 0 ;
	$sql="UPDATE `Minuman` SET `Stock`= `Stock` + '1' From  minuman inner join pesanan_Minuman
				on minuman.IdMinuman = pesanan_Minuman.IdMinuman WHERE IdMinuman='".$IdM."'";
	mysqli_query($conn,$sql);
	$sql="DELETE FROM `pesanan_Minuman` WHERE `IdPesanan`='".$IdP."'";
	mysqli_query($conn,$sql);
	$sql="SELECT sum(harga) from Pesanan inner join Invoice on pesanan.IdInvoice = invoice.IdInvoice";
	$harga = mysqli_query($conn,$sql);
	$sql="UPDATE Invoice set TotalHarga = @harga from Pesanan inner join Invoice
											  on pesanan.IdInvoice = invoice.IdInvoice
											where pesanan.IdPesanan = '".$IdP."'";
	mysqli_query($conn,$sql);
 }

 function delPesananMakanan($IdP,$IdM){
 	global $conn;
 	$harga = 0;
	$sql="UPDATE `Makanan` SET `Stock`= `Stock` - '1' From  Makanan inner join pesanan_Makanan
				on Makanan.IdMakanan = pesanan_Makanan.IdMakanan WHERE IdMakanan='".$IdM."'";
	mysqli_query($conn,$sql);
	$sql="DELETE FROM `pesanan_Makanan` WHERE `IdPesanan`='".$IdP."'";
	mysqli_query($conn,$sql);
	$sql="SELECT sum(harga) from Pesanan inner join Invoice on pesanan.IdInvoice = invoice.IdInvoice";
	$harga = mysqli_query($conn,$sql);
	$sql="UPDATE Invoice set TotalHarga = @harga from Pesanan inner join Invoice
											  on pesanan.IdInvoice = invoice.IdInvoice
											where pesanan.IdPesanan = '".$IdP."'";
	mysqli_query($conn,$sql);
 }

 function delInvoice($IdI){
 	global $conn;
 	$sql="DELETE FROM `pesanan_Makanan` inner join pesanan on pesanan_makanan.IdPesanan = pesanan.IdPesanan 
 										inner join Invoice on pesanan.IdInvoice = pesanan.IdInvoice
 										WHERE `IdInvoice`='".$IdI."'";
 	mysqli_query($conn,$sql);
 	$sql="DELETE FROM pesanan WHERE `IdInvoice`='".$IdI."'";
 	mysqli_query($conn,$sql);
 	$sql="DELETE FROM pesanan WHERE `IdInvoice`='".$IdI."'";
 	mysqli_query($conn,$sql);
 }

 function delPesanan($IdP){
 	global $conn;
 	$harga=0;
 	$IdI=0;
 	$sql="UPDATE `Makanan` SET `Stock`= `Stock` - '1' From  Makanan inner join pesanan_Makanan
				on Makanan.IdMakanan = pesanan_Makanan.IdMakanan WHERE IdMakanan='".$IdM."'";
	mysqli_query($conn,$sql);
	$sql="DELETE FROM `pesanan_Makanan` WHERE `IdPesanan`='".$IdP."'";
	mysqli_query($conn,$sql);
	$sql="UPDATE `Minuman` SET `Stock`= `Stock` + '1' From  minuman inner join pesanan_Minuman
				on minuman.IdMinuman = pesanan_Minuman.IdMinuman WHERE IdMinuman='".$IdM."'";
	mysqli_query($conn,$sql);
	$sql="DELETE FROM `pesanan_Minuman` WHERE `IdPesanan`='".$IdP."'";
	mysqli_query($conn,$sql);
	$sql="SELECT sum(harga) from Pesanan inner join Invoice on pesanan.IdInvoice = invoice.IdInvoice";
	$harga = mysqli_query($conn,$sql);
	$sql="SELECT `IdInvoice` from `pesanan` where `IdPesanan`='".$idP."'";
	$idI=mysqli_query($conn,$sql);
	updateHarga($IdI,$harga);
 }
 function cutMinumanByNumber($id,$jumlah){
 	global $conn;
 	$sql="SELECT * from `minuman` where `IdMinuman`='".$id."'";
 	$res=get("minuman",$sql);
 	$jumlahlama=$res[0]["stock"];
 	if($res[0]["tipe"]==2)
 	{
 		$jumlahbaru=$jumlahlama+$jumlah;
 	}
 	else
 	{
 	$jumlahbaru=$jumlahlama-$jumlah;
 }
 	$sql="UPDATE `minuman` SET `stock`='".$jumlahbaru."' WHERE IdMinuman='".$id."'";
	mysqli_query($conn,$sql);
 }
 function plusMakananByNumber($id,$jumlah){
 	global $conn;
 	$sql="SELECT * from `makanan` where `IdMakanan`='".$id."'";
 	 $res=get("makanan",$sql);
 	$jumlahlama=$res[0]["stock"];
 	$jumlahbaru=$jumlahlama+$jumlah;
 	$sql="UPDATE `makanan` SET `stock`='".$jumlahbaru."' WHERE IdMakanan='".$id."'";
	mysqli_query($conn,$sql);
 }
 function cutCemilanByNumber($id,$jumlah){
 	global $conn;
 	$sql="SELECT * from `cemilan` where `IdCemilan`='".$id."'";
 	 $res=get("cemilan",$sql);
 	$jumlahlama=$res[0]["stock"];
 	$jumlahbaru=$jumlahlama-$jumlah;
 	$sql="UPDATE `cemilan` SET `stock`='".$jumlahbaru."' WHERE IdCemilan='".$id."'";
	mysqli_query($conn,$sql);
 }
 function cutRokokByNumber($id,$jumlah){
 	global $conn;
 	$sql="SELECT * from `rokok` where `IdRokok`='".$id."'";
 	$res=get("rokok",$sql);
 	$jumlahlama=$res[0]["stock"];
 	$jumlahbaru=$jumlahlama-$jumlah;
 	$sql="UPDATE `rokok` SET `stock`='".$jumlahbaru."' WHERE IdRokok='".$id."'";
	mysqli_query($conn,$sql);
 }
  function cutFromMenu($id){
 	global $conn;
 	$sql="SELECT * from `menu` where `IdMenu`='".$id."'";
 	$res=get("menu",$sql);
 	$sql2="SELECT * from `menu` where `Nama`='".$res[0]["Nama"]."'";
 	$res1=get("menu",$sql2);
 	for($i=0;$i<sizeof($res1);$i++){
 		if($res1[$i]["IdMinuman"] != 0){
 		cutMinumanByNumber($res1[$i]["IdMinuman"],$res1[$i]["JumlahMinuman"]);
 	}
 	if($res1[$i]["IdMakanan"] != 0){
 		plusMakananByNumber($res1[$i]["IdMakanan"],$res1[$i]["JumlahMakanan"]);
 	}
 	if($res1[$i]["IdCemilan"] != 0){
 		cutCemilanByNumber($res1[$i]["IdCemilan"],$res1[$i]["JumlahCemilan"]);
 	}
 	}
 }
 function cutStock(){
 	global $conn;
	$sql = "SELECT * from `temp`";
	$temp= get("temp",sql);
 	for($i=0;$i<sizeof($temp);$i++){
	if($temp[$i]["Tipe"]== 0){
	plusMakananByNumber($temp[$i]["Id"],$temp[$i]["Stock"]); 		
	}
	if($temp[$i]["Tipe"]== 1){
	cutMinumanByNumber($temp[$i]["Id"],$temp[$i]["Stock"]);
	}
	if($temp[$i]["Tipe"]== 2){
	cutCemilanByNumber($temp[$i]["Id"],$temp[$i]["Stock"]);
	}
	if($temp[$i]["Tipe"]== 3){
	cutRokokByNumber($temp[$i]["Id"],$temp[$i]["Stock"]);
	}
	if($temp[$i]["Tipe"]== 4){
	cutFromMenu($temp[$i]["Id"]);
	}
	delete("temp",$i+1);
}
 }
function resetJualMakanan($id){
	global $conn;
	$sql="UPDATE `makanan` SET `stock`= 0 WHERE IdMakanan='".$id."'";
	mysqli_query($conn,$sql);

}
function getRow($sql){
	global $conn;
 	if($result=mysqli_query($conn,$sql)){
 		return mysqli_num_rows($result);
 	}else{
 		return null;
 	}
 }

 ?>
