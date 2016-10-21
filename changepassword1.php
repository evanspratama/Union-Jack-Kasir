<html>
<head>
<title>Change password</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">
<?php 
	session_start();
	if(isset($_SESSION["tipe"])){
		if($_SESSION["tipe"]==0){

		}else if($_SESSION["tipe"]==1){
			header("location:newInvoicefix.php");
		}
	}else{
		header("location:adminhome.php");
	}
 ?>
</head>
<body>
		<form method = "post" action="cek1.php">
			<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
			  <div class="modal-dialog">
			  <div class="modal-content">
			      <div class="modal-header">
			          <h1 class="text-center">Insert password</h1>
			      </div>
			      <div class="modal-body">
			          <form class="form col-md-12 center-block">
			          
			            <div class="form-group">
			              <input type="password" name="password" class="form-control input-lg" placeholder="Password">
			            </div>
			            <div class="form-group">
			              <button name="submit" class="btn btn-primary btn-lg btn-block">Next</button>
			            </div>
			          </form>
			      </div>
			      <div class="modal-footer">
			          <div class="col-md-12">
					  </div>	
			      </div>
			  </div>
			  </div>
			</div>
		</form>
</body>
</html>
