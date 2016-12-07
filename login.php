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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.1.1.min.js"></script>
	<script src="src/javascript/javascript.js"></script>
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
	<div id="loginform" class="container">
		<div id="warning">
		<?php
			if(isset($_SESSION['notfound'])){ 
				echo $_SESSION['notfound'];
				session_unset($_SESSION['notfound']);
			}
		?>
		</div>
		<h2 class="judul">Login Form</h2>
		<form class="form-horizontal" id="loginForm" name="loginForm" action="service.php" method="POST">
			<div class="form-group">
				<div class="col-sm-8">
					<label class="control-label col-sm-2">Username : </label>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
					</div>
				</div>
<<<<<<< HEAD
				<div class ="col-sm-3">
					<span id="span1"></span>
=======
				<div class ="col-sm-offset-2 col-sm-10">
					<span style="color : red" id="span1"></span>
					<span id="span2"></span>
>>>>>>> 2eb2dbb95f1ce0e26c59fd92b5684a212eafb5eb
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-8">
					<label class="control-label col-sm-2">Password : </label>
					<div class="col-sm-3">
						<input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
					</div>
				</div>
<<<<<<< HEAD
				<div class ="col-sm-3">
					<span id="span2"></span>
=======
				<div class ="col-sm-offset-2 col-sm-10">
					<span style="color : red" id="span3"></span>
					<span id="span4"></span>
>>>>>>> 2eb2dbb95f1ce0e26c59fd92b5684a212eafb5eb
				</div>
			</div>
			<input type="hidden" name="command" value="login"/>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-4">
					<input id="login-btn" type="submit" class="submit btn btn-warning" Value="Submit">
				</div>
			</div>
		</form>
	</div>
</body>
</html>