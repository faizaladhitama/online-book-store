<?php
	include("service.php");
	if(isset($_SESSION['login']) && $_SESSION['login']){
		if($_SESSION['role'] == "admin"){
			$_SESSION['warning'] = "Halaman ini hanya bisa diakses oleh user";
			header("Location:index.php");
		}
	}
	else{
		$_SESSION['warning'] = "Anda harus login terlebih dahulu";
		header("Location:login.php");
	}
?>
<html>
	<head>
		<title>Halaman Peminjaman</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.1.1.min.js"></script>
		<link rel="stylesheet" href="src/css/style.css">
		<script src="src/javascript/js.js"></script>
	</head>
	<body>
		<div id="header" class="container-fluid" style="padding:4%">
			<h2 class="col-md-4">PERPUSTAKAAN ONLINE</h3>
		</div>
		<!--http://www.w3schools.com/bootstrap/bootstrap_navbar.asp-->
		<div id="navbar">
			<nav class="navbar navbar-inverse">
			    <div class="collapse navbar-collapse" id="myNavbar">
			      <ul class="nav navbar-nav">
			        <li><a href="index.php">Home</a></li>
			        <li><a class="dropdown-toggle" data-toggle="dropdown" href="#">Halaman Pengguna<span class="caret"></span></a>
			          <ul class="dropdown-menu">
			            <li><a href="addBooks.php">Tambah Buku</a></li>
			            <li><a href="user.php">Halaman Peminjaman</a></li>
			          </ul>
			         </li>
			        <li><a class="dropdown-toggle" data-toggle="dropdown" href="#">Akses Cepat<span class="caret"></span></a>
			          <ul class="dropdown-menu">
			            <li><a href="http://www.w3schools.com/" target="_blank">W3 School</a></li>
			            <li><a href="http://scele.cs.ui.ac.id/" target="_blank">Scele</a></li>
			            <li><a href="http://google.com/" target="_blank">Google</a></li>
			          </ul>
			         </li>
			      </ul>
			      <ul class="nav navbar-nav navbar-right">
			      	<?php 
			      		if(isset($_SESSION['login']) && $_SESSION['login']){
			      			$id = $_SESSION['id'];
			      			$user = $_SESSION['username'];
			      			$role = $_SESSION['role'];

				      		echo "<li><a href=\"#\">
				      			$user
				      		</a></li>".
			      			"<form action=\"service.php\" method=\"post\" class=\"navbar-form navbar-left\">
				    			<div class=\"form-group\">
				    				<input type=\"hidden\" class=\"form-control\" name=\"command\" value=\"logout\">
								</div> 
				      			<button type=\"submit\" class=\"btn btn-default\"><span class=\"glyphicon glyphicon-log-out\"></span>Logout</button>
				    		</form>";
			      		}
			      		else{
			      			echo "<li><a href=\"#\"><span class=\"glyphicon glyphicon-user\"></span> Sign Up</a></li><li><a href=\"login.php\"><span class=\"glyphicon glyphicon-log-in\"></span> Login</a></li>";
			      		}
			      	?>
			      </ul>
			    </div>
			  </div>
			</nav>
		</div>
		<div class="container">
			<div id="total peminjaman">
				<?php
					showLoan();
				?>
			</div>
		</div>
	</body>
</html>