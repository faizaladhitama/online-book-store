<?php
	include("service.php");
?>

<html>
	<head>
		<title>Halaman Buku</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.1.1.min.js"></script>
		<link rel="stylesheet" type="text/css" href="src/css/style.css">
		<script src="src/javascript/js.js"></script>
	</head>
	<body>
		<div id="header" class="container-fluid" style="padding:4%">
			<h2 class="col-md-4">PERPUSTAKAAN ONLINE</h3>
		</div>
		<!--http://www.w3schools.com/bootstrap/bootstrap_navbar.asp-->
		<div id="navbar">
			<nav class="navbar navbar-inverse">
				<div class="navbar-header">
			      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>                        
			      </button>
			    </div>
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
			<div id="layout" class="row">
				<div id="buku" class="col-md-9 text-justify row">
					<?php 
						generateBookPage();
					?>
				</div>
				<?php 
					if(isset($_SESSION['notification'])){
						echo "<div id=\"warning\" style=\"border:3px solid white;padding-bottom:5%;color:white;position:relative\" class=\"col-md-3\">";
						echo generateNotification();
						echo "</div>";
						unset($_SESSION['notification']);
					}
				?>
			</div>
			<div id="review" class="row">
				<div id="box" class="row" style="color:white;">
					<h4>Kolom Review</h4>
				</div>
				<?php 
					if(!generateReview()){
						echo "<h6 style=\"color:white;\">Tidak ada review</h6>";
					}
					if(isset($_SESSION['login']) && $_SESSION['login'] && $_SESSION['role'] == "user"){
						$thisid = $_GET['id'];
						echo"
						<div class=\"row\">
							<div id=\"review\">
								<form>
									<div>
										<textarea rows=\"3\" cols=\"50\" id=\"review-box\" placeholder=\"Tulis disini\"></textarea>
									</div>
								</form><input type=\"hidden\" id=\"hiddenid\" value=\"$thisid\"/>
								<button id=\"review-btn\">Submit Review</button>
							</div>
						</div>";
					}
				?>
			</div>
		</div>
	</body>
</html>