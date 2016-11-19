<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.1.1.min.js"></script>
	</head>
	<body>
		<div class="Jumbotron">
			<h1>PERPUSTAKAAN ONLINE</h1>
		</div>
		<div id="navbar">
			<nav class="navbar navbar-inverse">
			  <div class="container-fluid">
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>                        
			      </button>
			      <a class="navbar-brand" href="#">WebSiteName</a>
			    </div>
			    <div class="collapse navbar-collapse" id="myNavbar">
			      <ul class="nav navbar-nav">
			        <li class="active"><a href="#">Home</a></li>
			        <li class="dropdown">
			          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
			          <ul class="dropdown-menu">
			            <li><a href="#">Page 1-1</a></li>
			            <li><a href="#">Page 1-2</a></li>
			            <li><a href="#">Page 1-3</a></li>
			          </ul>
			        </li>
			        <li><a href="#">Page 2</a></li>
			        <li><a href="#">Page 3</a></li>
			      </ul>
			      <ul class="nav navbar-nav navbar-right">
			        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
			        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
			      </ul>
			    </div>
			  </div>
			</nav>
		</div>
		<div class="panel container">
			<div id="book" class="col-md-12">
				<ul class="list-group">
					<?php 
						include("service.php");

						generateBook();
					?>
				</ul>
			</div>
		</div>
	</body>
</html>