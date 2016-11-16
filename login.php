<!DOCTYPE html>
<html>
<head>
	<title>Login Form Validation</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.1.1.min.js"></script>
	<script src="javascript.js"></script>
</head>
<body>
	<?php session_start()?>
	<div class="container">
		<div id="warning">
		<?php
			if(isset($_SESSION['warning']) && !$_SESSION['login']){ 
				echo $_SESSION['warning'];
				session_unset($_SESSION['warning']);
			}
		?>
		</div>
		<h2>Login Form</h2>
		<form class="form-horizontal" id="loginForm" action="service.php?perintah=login" method="POST">
			<div class="form-group">
				<label class="control-label col-sm-2">Username : </label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="username" name="username" placeholder="Enter your username">
				</div>
				<div class ="col-sm-4">
					<span id="span1"></span>
					<span id="span2"></span>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2">Password : </label>
				<div class="col-sm-6">
					<input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
				</div>
				<div class ="col-sm-4">
					<span id="span3"></span>
					<span id="span4"></span>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input id="login-btn" type="submit" class="submit" Value="Submit" class="btn btn-primary"/>
				</div>
			</div>
			<div id="percobaan">
			</div>
		</form>
	</div>
</body>
</html>