<?php
	include("service.php");
	if(!isset($_SESSION['login']) || !$_SESSION['login']){
		header("Location:login.php");
	}
?>

<html>
	<head>
		<title>Halaman Profile</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.1.1.min.js"></script>
	</head>
	<body>
		<div id="header" class="container-fluid page-header">
			<h2 class="col-md-4">PERPUSTAKAAN ONLINE</h3>
		</div>
		<div id="navbar">
			<nav class="navbar navbar-inverse">
			    <div class="collapse navbar-collapse" id="myNavbar">
			      <ul class="nav navbar-nav">
			        <li><a href="index.php">Home</a></li>
			        <li class="active"><a href="user.php">Halaman Profile</a></li>
			        <li><a class="dropdown-toggle" data-toggle="dropdown" href="#">Akses Cepat<span class="caret"></span></a>
			          <ul class="dropdown-menu">
			            <li><a href="http://www.w3schools.com/" target="_blank">W3 School</a></li>
			            <li><a href="http://scele.cs.ui.ac.id/" target="_blank">Scele</a></li>
			            <li><a href="http://google.com/" target="_blank">Google</a></li>
			          </ul>
			         </li>
			        <li><a href="#">Ketentuan Peminjaman</a></li>
			        <li><a href="#">About Us</a></li>
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
			<div id="history">
				<div id="table" class="table-responsive">
					<table class="table table-bordered">
						<caption>Table Waktu Peminjaman</caption>
						<thead>
							<tr>
								<th class="col-md-6 text-center">Nama buku</th>
								<th class="col-md-2 text-center">Waktu Peminjaman</th>
								<th class="col-md-2 text-center">Deadline Peminjaman</th>
								<th class="col-md-2 text-center">Denda</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><a href="#">test</a></td>
								<td>test</td>
								<td>test</td>
								<td>test</td>
							</tr>
							<tr>
								<td><a href="#">test</a></td>
								<td>test</td>
								<td>test</td>
								<td>test</td>
							</tr>
							<tr>
								<td><a href="#">test</a></td>
								<td>test</td>
								<td>test</td>
								<td>test</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div id="total peminjaman">
				<div id="table" class="table-responsive">
					<table class="table table-bordered">
						<caption>Table Peminjaman</caption>
						<thead>
							<tr>
								<th class="col-md-6 text-center">Nama buku</th>
								<th class="col-md-3 text-center">Jumlah buku</th>
								<th class="col-md-3 text-center">Mengembalikan Buku</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><a href="#">test</a></td>
								<td>test</td>
								<td>test</td>
							</tr>
							<tr>
								<td><a href="#">test</a></td>
								<td>test</td>
								<td>test</td>
							</tr>
							<tr>
								<td><a href="#">test</a></td>
								<td>test</td>
								<td>test</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>