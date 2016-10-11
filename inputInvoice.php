<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php 
	include "query.php";
	

 ?>
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Editable Invoice</title>
	
	<link rel='stylesheet' type='text/css' href='css/style.css' />
	<link rel='stylesheet' type='text/css' href='css/print.css' media="print" />
	<script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>
	<!--<script type='text/javascript' src='js/example.js'></script>-->

</head>

<body>

	<div id="page-wrap">
		<a href="logout.php">logout</a>
		<textarea id="header">INVOICE</textarea>
		
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
                    <td><p>
                    <?php
						echo $_SESSION["idinvoice1"];
                    ?>
                    
                    </p></td>
                </tr>
                <tr>

                    <td class="meta-head">Date</td>
                    <td>
                    <?php 
	                    $new_date = date('m-d-Y', strtotime($_POST['date']));
						echo $new_date;
					?>
                    <!--<textarea id="date">December 15, 2009</textarea>-->

                    </td>
                </tr>

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
			echo $_SESSION["staticitem"];
		  ?>
		  <tr id="hiderow">
			    <td colspan="5"></td>
			  </tr>
		  <tr>
		      <td colspan="2" class="blank">
		      
		      	Diskon member:  
				<?php 
					$disc=getdiscmember($_POST["jenismember"]);
					echo(" ".$disc."%.");
				 ?>
		      </td>
		      <td colspan="2" class="total-line">Subtotal</td>
		      <td class="total-value"><div id="subtotal">
				<?php
					if(isset($_SESSION["subtotal"])){
						echo $_SESSION["subtotal"];
					}else{
						echo "tidak ada barang yang dibeli";
					}
				?>
		      </div></td>
		  </tr>
		  <tr>

		      <td colspan="2" class="blank">
				<?php
				echo "diskon: ".$_SESSION["diskonstr"];
				?>
		       </td>
		      <td colspan="2" class="total-line">Total</td>
		      <td class="total-value"><div id="total">
		      <?php
		      		$hargatemp = potonganHarga($_POST["jenismember"],$_SESSION["total"]);
					echo "Rp.".$hargatemp;
					$_SESSION["total"]=$hargatemp;
				?></div></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Amount Paid</td>

		      <td class="total-value">
				<?php
					$temp123 = (int) $_POST["paid"];
					echo "<p>Rp.".$temp123."</p>";
				?>
		      </td>
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line balance">change</td>
		      <td class="total-value balance"><div class="due">
				<?php
				$temp=0;
					if($_POST["paid"]>=$_SESSION["total"]){
						$temp1 = (int) $_POST["paid"];
						$temp = $_SESSION["total"]-$temp1;
						if($temp<0){
							$temp = $temp*-1;
						}else{
							
						}
					}else{
						$temp=0;
					}
					echo "Rp.".$temp;
				?>
		      </div></td>
		  </tr>
		
		</table>
		<a href="newInvoicefix.php"> back</a>
		<div id="terms">
		  <h5>Terms</h5>
		  <textarea>Pajak 15%</textarea>
		</div>

	<?php 

	if(isset($_SESSION['arr'])){
		$_SESSION["subtotal"]= 0;
		foreach($_SESSION['arr'] as $key=>$value){
			$tempstr = explode(",",$value);
			$jenis = $tempstr[0];
			$id = $tempstr[1];
			$jumlah = (int) $tempstr[2];

			switch($jenis){
			  	case "0":

			  		plusMakananByNumber($id,$jumlah);
			  		break;
			  	case "1":
			  		cutMinumanByNumber($id,$jumlah);
			  		break;
			  	case "2":
			  		cutCemilanByNumber($id,$jumlah);
			  		break;
			  	case "3":
			  		cutRokokByNumber($id,$jumlah);
			  		echo ("id: ".$id." jumlah: ".$jumlah);
			  		break;
			  	default :
					break;
			}
		}
	}

	$data = array("","","","","");
	if (isset($_SESSION['diskon'])) {
		$data[0]=$_SESSION['diskon'];
	}else{
		$data[0]=null;	
	}
	
	$data[1]=$_SESSION["total"];
	$data[2]=(string)$_POST["date"];
	$data[3]=$_POST["jenismember"];
	$data[4]=$_SESSION['diskonstr'];
	$temp = $_SESSION["total"] - $_POST["paid"];
	if($temp>0){
		$data[5]=1;
	}
	else{
		$data[5]=0;
	}

		insert("invoice",$data);
		unset($_SESSION["idinvoice1"]);
		unset($_SESSION["subtotal"]);
		unset($_SESSION['arr']);
		unset($_SESSION['diskonstr']);
		unset($_SESSION['diskon']);
		unset($_SESSION["total"]);
		unset($_SESSION["staticitem"]);
		unset($_POST["paid"]);
		unset($_POST["date"]);

	 ?>
	</div>
	
</body>

</html>