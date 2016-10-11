<link rel="stylesheet" href="css/style.css">
<div id="cent">
	<h1>Pilih Jenis Diskon</h1>
	<form action="invodiskon1.php" method="post">
		<select name="disc" id="disc">
			<?php 
				include "query.php";
				$temp = get("promo");
				for ($i=0; $i < count($temp); $i++) { 
					echo ('<option value='.$temp[$i]["Diskon"].'>'.$temp[$i]["Nama"].'</option>');
					$_SESSION["iddiskon"][]=$temp[$i]["IdPromo"];
				}
				
			 ?>
		</select>
		</br>
		<input type="submit" name="submit" value="ok" />
	</form>
</div>