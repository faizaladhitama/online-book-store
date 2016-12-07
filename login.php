<?php 
	session_start();
	if(isset($_SESSION['login']) && $_SESSION['login']){
		header("Location: index.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Form Validation</title>
	<meta charset="UTF-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.1.1.min.js"></script>
		<script src="src/javascript/js.js"></script>
		<link rel="stylesheet" type="text/css" href="src/css/loginStyle.css">
	</head>
	<body>
		<?php 
			if(isset($_SESSION['warning'])){
	    		$warning = $_SESSION['warning'];
	    		echo "<script>alert(\"$warning\")</script>";
	    		unset($_SESSION['warning']);
	    	}
		?>
		<div id="loginform" class="container text-center col-sm-offset-3">
			<div id="warning">
			<?php
				if(isset($_SESSION['notfound'])){ 
					echo $_SESSION['notfound'];
					session_unset($_SESSION['notfound']);
				}
			?>
			</div>
			<h2 class="judul text-center" style="padding:3%">Login Form</h2>
			<form class="form-horizontal" name="loginForm" id="loginFormAction" action="service.php" method="POST">
				<div class="form-group" style="padding:3%">
					<div class="col-sm-12">
						<label class="control-label col-sm-3">Username : </label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
						</div>
					</div>
					<div class ="col-sm-offset-2 col-sm-9">
						<span style="color:red" class="error-message" id="span1"></span>
					</div>
				</div>
				<div class="form-group" style="padding:3%">
					<div class="col-sm-12">
						<label class="control-label col-sm-3">Password : </label>
						<div class="col-sm-8">
							<input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
						</div>
					</div>
					<div class ="col-sm-offset-2 col-sm-9">
						<span style="color:red" class="error-message" id="span2"></span>
					</div>
				</div>
				<input type="hidden" name="command" value="login"/>
				<div class="form-group col-sm-offset-1">
					<div class="col-sm-offset-0">
						<input id="login-btn" type="submit" class="submit btn btn-warning" Value="Submit">
					</div>
				</div>
			</form>
		</div>
	</body>
</html>