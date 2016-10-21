<html>
<head>
<title>Change password</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">
<?php 
	session_start();
	if(isset($_SESSION["cp"])){
		if($_SESSION["cp"]){

		}else{
			header("location:adminhome.php");
		}
	}else{
		header("location:index.php");
	}
 ?>
</head>
<body>
		<form method = "post" action="cek2.php">
			<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
			  <div class="modal-dialog">
			  <div class="modal-content">
			      <div class="modal-header">
			          <h1 class="text-center">Change password</h1>
			      </div>
			      <div class="modal-body">
			          <form class="form col-md-12 center-block">
			            <div class="form-group">
			              <!--<input type="text" class="form-control input-lg" placeholder="Username">-->
			              <select name="tipe1" id="tipe1">
			              	<option value=0>Admin</option>
			              	<option value=1>Kasir</option>
			              </select>
			            </div>
			            <div class="form-group">
			            	<p>Insert new password</p>
			              	<input type="password" name="password1" class="form-control input-lg" placeholder="Password">
			            </div>
			            <div class="form-group">
			            	<p>Insert new password again</p>
			              	<input type="password" name="password2" class="form-control input-lg" placeholder="Password">
			            </div>
			            <div class="form-group">
			              <button name="submit" class="btn btn-primary btn-lg btn-block">Change password</button>
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
