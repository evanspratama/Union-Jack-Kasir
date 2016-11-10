<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php 
	//session_start();
	include "query.php";
	//secure();
 ?>
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>New Invoice</title>
	
	<link rel='stylesheet' type='text/css' href='css/style.css' />
	<link rel='stylesheet' type='text/css' href='css/print.css' media="print" />
	<script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>
	<script type="text/javascript" src="js/autoEnterCurrentDate.js"></script>
	<!--<script type='text/javascript' src='js/example.js'></script>-->

</head>

<body>
	
	<div id="page-wrap">
		<a href="logout.php">logout</a>
		<textarea id="header">INVOICE</textarea>
		<form action="inputInvoice.php" method="post">
			<div id="identity">
			
	            <p id="address">Beer Market <br />
					jl. 123 <br />
					Phone: (555) 555-5555</p>

	            <div id="logo">


	              <div id="logohelp">
	                <input id="imageloc" type="text" size="50" value="" /><br />
	                (max width: 540px, max height: 100px)
	              </div>
	              <img id="image" src="images/33894e9.jpg" height=50% width=50% alt="logo" />
	            </div>
			
			</div>
			
			<div style="clear:both"></div>
			
			<div id="customer">

	<!--            <textarea id="customer-title">Widget Corp.
	c/o Steve Widget</textarea>
	-->
	            <table id="meta">
	                <tr>
	                    <td class="meta-head">Invoice #</td>
	                    <td>
						<?php 
							$temprow = (int)getRow("SELECT * FROM invoice;")+1;
							echo('<p>'.$temprow.'</p>');
							$_SESSION["idinvoice1"]=$temprow;
						 ?>
	                    </td>
	                </tr>
	                <tr>

	                    <td class="meta-head">Date</td>
	                    <td><!--<p id="date">December 15, 2009</p>-->
							 <input name="date" id="date"/></td>
	                </tr>
	                <!--
	                <tr>
	                    <td class="meta-head">Amount Due</td>
	                    <?php 
	                    	//echo ('<td><div class="due">Rp.'.$jumlahbayar.'/div></td>');
	                     ?>
	                    <td><div class="due">Rp.150.000</div></td>
	                </tr>
	                -->

	            </table>
			
			</div>
			
			<table id="items">
			
			  <tr>
			      <th>Item</th>
			      <th>Description</th>
			      <th>Unit Cost</th>
			      <th>Quantity</th>
			      <th>Price</th>
			  </tr>
			  <?php 
			  //echo $_SESSION['arr'][0];
			  $_SESSION["staticitem"]="";
			  	if(isset($_SESSION['arr'])){
			  		$_SESSION["subtotal"]= 0;
			  		foreach($_SESSION['arr'] as $key=>$value){
			  			$i=0;
			  			$tempstr = explode(",",$value);
			  			$jenis = $tempstr[0];
			  			$id = $tempstr[1];
			  			$jumlah = (int) $tempstr[2];

			  			switch($jenis){
			  				case "0":
			  					$res=get("makanan","SELECT * FROM makanan WHERE idMakanan=".$id);
			  					break;
			  				case "1":
			  					$res=get("minuman","SELECT * FROM minuman WHERE idMinuman=".$id);
			  					break;
			  				case "2":
			  					$res=get("cemilan","SELECT * FROM cemilan WHERE idCemilan=".$id);
			  					break;
			  				case "3":
			  					$res=get("rokok","SELECT * FROM rokok WHERE idRokok=".$id);
			  					break;
			  				default :

			  					break;
			  			}
			  			$total = ((int) $res[$i]["harga"] * $jumlah);
			  			$_SESSION["subtotal"] = $_SESSION["subtotal"]+ $total;
			  			$stringtemp='<tr class="item-row">
						      <td class="item-name"><div class="delete-wpr"><p>'.$res[$i]["Nama"].'</p><a class="delete" href="invoicedel.php?key='.$key.'" title="Remove row">X</a></div></td>
						      <td class="description"><p>'.$res[$i]["deskripsi"].'</p></td>
						      <td><p class="cost">Rp.'.$res[$i]["harga"].'</p></td>
						      <td><p class="qty">'.$jumlah.'</p></td>
						      <td><span class="price">Rp.'.$total.'</span></td>
						  </tr>';
				  		echo ($stringtemp);
				  		$_SESSION["staticitem"]= $_SESSION["staticitem"].$stringtemp;
				  		$i=$i+1;
			  		}
			  	}
			   ?>
			  
			  <tr id="hiderow">
			    <td colspan="5"><a id="addrow" href="newInvoice step1.php" title="Add a row">Tambah barang</a></td>
			  </tr>
			  <?php 
			  	$_SESSION["iddiskon"]= array();
			   ?>
			  <tr>
			      <td colspan="2" class="blank">
			      <select name="jenismember" id="jenismember">
					<option value="1">non member</option>
					<option value="2">silver</option>
					<option value="3">gold</option>
				</select>
			      </td>
			      <td colspan="2" class="total-line">Subtotal</td>
				  <td class="total-value"><div id="subtotal">
			      <?php 
				      if (isset($_SESSION["subtotal"])) {
				      	echo "Rp.".$_SESSION["subtotal"];
				      }else{
				      	echo "Rp.0";
				      }
			      	
			       ?>
				  </div>

			      </td>
			  </tr>
			  <tr>

			      <td colspan="2" class="blank"> 
					<?php 
					$disctemp = "";
					$iddisctemp="";
					if(isset($_SESSION["diskon"])){
						foreach($_SESSION['diskon'] as $key=>$value){
							//$disctemp = $disctemp.",".$value."%";
							if($value<101){
								$disctemp = $disctemp.',<a href="delDiskon.php?del='.$value.'">'.$value.'%</a>';
							}
						}
					}
					if(isset($_SESSION["iddiskon"])){
						foreach($_SESSION['iddiskon'] as $key=>$value){
							$iddisctemp = $iddisctemp.",".$value."%";
							
						}
					}
					
					echo ("diskon: ".$disctemp);
					$_SESSION["diskonstr"] = $disctemp;
					 ?>
					 <a href="invodiskon.php">add</a>
			      </td>
			      <td colspan="2" class="total-line">Total</td>
			      <td class="total-value"><div id="total">
			      <?php 
			        $res = 0;
			        if (isset($_SESSION["subtotal"])) {
				      $res=$_SESSION["subtotal"];
				      	if (isset($_SESSION['diskon'])) {
				      		foreach($_SESSION['diskon'] as $key=>$value){
						     	//if($res==$_SESSION["subtotal"]){
						        	//$res = $_SESSION["subtotal"]-((int) $_SESSION["subtotal"]/100 * $value);
						    	//}else{
						    		//$res = $res-($res/100 * $value);
						    	//}
								if($value<101){
									$res = $res-($res/100 * $value);
								}
					      	}
				      	}

				    }else{
				    }
			        $res1= $res+($res/100 * 15);
			        $_SESSION["total"]=$res1;
			      	echo "Rp.".$res1;
			       ?>
			      </div>

			      </td>
			  </tr>
			  <tr>
			      <td colspan="2" class="blank"> </td>
			      <td colspan="2" class="total-line">Amount Paid</td>

			      <td class="total-value"> <input type="text" name="paid" />
			      <!--<textarea id="paid">200.000</textarea>-->
			      </td>
			  </tr>
			  <tr>
			      <td colspan="2" class="blank"> </td>
			      <td colspan="2" class="total-line balance">change</td>
			      <td class="total-value balance"><div class="due"></div></td>
			  </tr>
			
			</table>
			<input type="submit" name="submit" value="ok" />
		</form>
		<div id="terms">
		  <h5>Terms</h5>
		  <textarea>Pajak 15%</textarea>
		</div>
	
	</div>
	
</body>

</html>