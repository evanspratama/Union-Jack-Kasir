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
	$res = mysqli_fetch_assoc(mysqli_query($conn,$sql));
	return $res["res"];
 }
 
 function insert($type,$data){
	global $conn;
	if($type=="makanan"){
		$id=getMaxID("makanan");
		$id++;
		$sql="INSERT INTO `makanan`(`IdMakanan`, `Nama`, `harga`, `stock`) VALUES('".$id."','".$data[0]."','".$data[1]."','".$data[2]."');";
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
		$i++;
		}
		}
		if($type== "minuman"){
		$arrayres=mysqli_query($conn,$sql);
		while($row = mysqli_fetch_assoc($arrayres)){
		$result[$i]["IdMinuman"]=$row ["IdMinuman"];
		$result[$i]["Nama"]=$row ["Nama"];
		$result[$i]["harga"]=$row ["harga"];
		$result[$i]["stock"]=$row ["stock"];
		$i++;
		}
	}
		if($type== "makanan"){
		$arrayres=mysqli_query($conn,$sql);
		while($row = mysqli_fetch_assoc($arrayres)){
		$result[$i]["IdMakanan"]=$row ["IdMakanan"];
		$result[$i]["Nama"]=$row ["Nama"];
		$result[$i]["harga"]=$row ["harga"];
		$result[$i]["stock"]=$row ["stock"];
		$i++;
		}
	}
	 	if($type== "cemilan"){
			while($row = mysqli_fetch_assoc($result)){
			$arrayres[$i]["IdCemilan"]=$row ["IdCemilan"];
			$arrayres[$i]["Nama"]=$row ["Nama"];
			$arrayres[$i]["deskripsi"]=$row ["deskripsi"];
			$arrayres[$i]["harga"]=$row ["harga"];
			$arrayres[$i]["stock"]=$row ["stock"];
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
	$sql="UPDATE `makanan` SET `IdMakanan`='".$id."',`Nama`='".$data[0]."',`harga`='".$data[1]."',`stock`='".$data[2]."' WHERE IdMakanan='".$id."'";
	mysqli_query($conn,$sql);
	}
	if($type=="promo"){
	$sql="UPDATE `promo` SET `IdPromo`='".$id."',`Nama`='".$data[0]."',`Diskon`='".$data[1]."' WHERE IdPromo='".$id."'";
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
	if($type == "Invoice"){
	$sql="DELETE FROM `Invoice` WHERE `IdInvoice`='".$id."'";
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

function potonganHarga($IdI,$IdT,$IdP){
 	global $conn;
 	$diskon=0;
 	$diskon1=0;
 	$harga =0;
 	$harga1=0;
 	$harga2=0;
 	$harga3=0;
 	$harga = setTotalHarga($IdP);
 	if(($IdT != null or $IdT != 0)and($IdP != null or $IdP!=0))
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
 	}
 	updateHarga($IdI,$harga);
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
 	$sql="SELECT `stock` from `minuman` where `IdMinuman`='".$id."'";
 	$jumlahlama=mysqli_query($conn,$sql);
 	$jumlahbaru=$jumlahlama-$jumlah;
 	$sql="UPDATE `minuman` SET `stock`='".$jumlahbaru."' WHERE IdMinuman='".$id."'";
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
