<?php
 include "conn.php" ;
 
 function getMaxID($type){
	global $conn;
	if($type == "mahasiswa"){
		$sql = "SELECT max(NPM) as res from mahasiswa";		 
	}
	$res = mysqli_fetch_assoc(mysqli_query($conn,$sql));
	return $res["res"];
 }
 
 function insert($type,$data){
	global $conn;
	if($type=="makanan"){
		$sql="INSERT INTO `makanan`(`IdMakanan`, `Nama`, `harga`, `stock`) VALUES('".$data[0]."','".$data[1]."','".$data[2]."','".$data[3]."');";
		mysqli_query($conn,$sql);
		return "Data makanan berhasil dimasukan";
	}
	if($type=="minuman"){
		$sql="INSERT INTO `minuman`(`IdMinuman`, `Nama`, `harga`, `stock`) VALUES('".$data[0]."','".$data[1]."','".$data[2]."','".$data[3]."');";
		mysqli_query($conn,$sql);
		return "Data minuman berhasil dimasukan";
	}
	if($type=="dosen"){
		$sql="INSERT INTO `dosen`(`Id_Dosen`, `Nama_D`, `Email_D`, `Keahlian`, `Pendidikan`, `Username`, `Password`, `NIK`, `Status`) Values('".$data[0]."','".$data[1]."','".$data[2]."','".$data[3]."','".$data[4]."','".$data[5]."','".$data[6]."','".$data[7]."',0);";
		mysqli_query($conn,$sql);
		return "Data makanan berhasil dimasukan";
	}
 }
 function get($type,$sql){
	global $conn;
	$i=0;
	$result=array();
	
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
	return $result;
 }

 function update($type,$id,$data){
	global $conn;
	if($type=="dosen"){
	$sql="UPDATE `dosen` SET `Id_Dosen`='".$data[0]."',`Nama_D`='".$data[1]."',`Email_D`='".$data[2]."',`Keahlian`='".$data[3]."',`Pendidikan`='".$data[4]."',`Username`='".$data[5]."',`Password`='".$data[6]."',`NIK`='".$data[7]."',`Status`='".$data[8]."' WHERE Id_Dosen='".$id."'";
	mysqli_query($conn,$sql);
	}
	if($type=="mata_kuliah"){
	$sql="UPDATE `mata_kuliah` SET `Id_MK`='".$data[0]."',`Nama_MK`='".$data[1]."',`sks`='".$data[2]."' WHERE Id_MK='".$id."'";
	mysqli_query($conn,$sql);
	}
	if($type=="ambil_mk"){
	$na=null;
	if($data[0]>=80){
	$na="A";
	}
	else if($data[0]<80 and $data[0]>=70){
	$na="B";
	}
	else if($data[0]<70 and $data[0]>=60){
	$na="C";
	}
	else if($data[0]<60 and $data[0]>=50){
	$na="D";
	}
	else{
	$na="E";
	}
	$sql="UPDATE `ambil_mk` SET `AngkaAkhir`='".$data[0]."',`NilaiAkhir`='".$na."' where NPM='".$id."' and Id_MK ='".$data[1]."'";
	mysqli_query($conn,$sql);
	return "masukan nilai berhasil";
	}
 }
 function delete($type,$id){
	global $conn;
	if($type == "makanan"){
	$sql="DELETE FROM `makanan` WHERE `IdMakanan`='".$id."'";
	}
	if($type == "minuman"){
	$sql="DELETE FROM `minuman` WHERE `IdMinuman='".$id."'";
	}
	if($type == "Invoice"){
	$sql="DELETE FROM `Invoice` WHERE `IdInvoice`='".$id."'";
	}
	mysqli_query($conn,$sql);
 }

 function login($username,$password){
	global $conn;
	$sql="SELECT * FROM `mahasiswa` WHERE username='".$username."' and password='".$password."' ";
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
	$sql="UPDATE `Makanan` SET `Stock`= `Stock` - '1' WHERE IdMakanan='".$idM."'";
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
 	$harga int = 0
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
 	$harga int = 0
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
 ?>