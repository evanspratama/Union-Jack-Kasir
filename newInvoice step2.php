<link rel="stylesheet" href="css/style.css">
<div id="cent">
<?php 
    echo '<form action="newInvoicefinal.php" method="post">';
	include "query.php";
	$sql = "" ;
	$jenis1 = "";

	if(isset($_POST["submit"])){
		$jenis = $_POST["jenisb"];
	}else{
		$jenis = -1;
	}
	if($jenis == 0){
		$sql = "SELECT * FROM makanan;";
		$jenis1 = "makanan";
	}else if($jenis == 1){
		$sql = "SELECT * FROM minuman;";
		$jenis1 = "minuman";
	}else if($jenis == 2){
		$sql = "SELECT * FROM cemilan;";
		$jenis1 = "cemilan";
	}else if($jenis == -1){
		echo "error";
	}
	if($jenis1!=""){
        echo('
            <select name="menu" id="menu">
        ');
		$temp = get($jenis1,$sql);
        switch ($jenis) {
            case 0:
                $tempid = "IdMakanan";
                break;
            case 1:
                $tempid = "IdMinuman";
                break;
            case 2:
                $tempid = "IdCemilan";
                break;
            default:
                # code...
                break;
        }
		for ($i=0; $i < count($temp) ; $i++) { 
			echo ('<option value="'.$jenis.','.$temp[$i][$tempid].'">'.$temp[$i]['Nama'].'</option>
                    
                ');
		}
        echo (' 
            </select>
            <div class="box">    
                <label for="qty"><abbr title="jumlah">Jumlah</abbr></label>
                <input id="qty" name="jumlah" value="0" />
            </div>
            </br>
            <input type="submit" name="submit" value="tambahkan" />
            </form>
            ');
	}
 ?>
 </div>