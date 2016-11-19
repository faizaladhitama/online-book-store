<?php
	session_start();
	header("Content-Type: text/html; charset=ISO-8859-1");
	$command = "";
	if(isset($_POST['command'])){
		$command = $_POST['command'];
	}
	else if(!isset($_SESSION['import_database'])){
		$command = "import_database";
		$_SESSION['import_database'] = true;
	}
	if(!isset($_SESSION['login'])){
		$_SESSION['login'] = false;
	}
	
	switch ($command) {
		case 'import_database':
			import_database();
			break;
		case 'login':
			# code...
			$username = "";	
			$password = "";	
			if(!$_SESSION['login'] && isset($_POST['username'])){
				$username = $_POST['username'];	
				$password = $_POST['password'];	
			}
			else if($_SESSION['login']){
				header("Location: index.php");
			}
			else{
				header("Location: login.php");
			}
			//print_database($mysql_host,$mysql_username,$mysql_password,$mysql_database);
			
			$cek = cek_user($username,$password);
			if(!$cek){
				$_SESSION['error'] = $_SESSION['username'];
				$_SESSION['warning'] = "Username atau password tidak ada";
			}
			break;
		case 'submit_review':
			# code...
			break;
		default:
			# code...
			break;
	}

	function connectDB(){
		$mysql_host = 'localhost';
		$mysql_username = 'root';
		$mysql_password = '';
		$mysql_database = 'dump';

		$conn = mysqli_connect($mysql_host, $mysql_username, $mysql_password,$mysql_database);

		return $conn;

	}

	function import_database(){
		$conn = connectDB();

		$filename = 'personal_library.sql';
		$sql = "CREATE DATABASE $database";
		mysqli_query($conn, $sql);

		$templine = '';
		$lines = file($filename);
		foreach ($lines as $line)
		{
			// Skip it if it's a comment
			if (substr($line, 0, 2) == '--' || $line == '')
			    continue;

			// Add this line to the current segment
			$templine .= $line;
			// If it has a semicolon at the end, it's the end of the query
			if (substr(trim($line), -1, 1) == ';')
			{
			    // Perform the query
			    mysqli_query($conn,$templine);
			    $templine = '';
			}
		}
		return false;
	}

	function print_database(){
		$conn = connectDB();
		//Select data
		$sql = "SELECT * FROM book";
		/*SELECT "atribut 1,...,atribut n" 
		FROM "nama table"*/

		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
		    // output data of each row
		    while($row = mysqli_fetch_assoc($result)) {
		    	foreach($row as $key=>$value){
		    		echo "$key: " . $value . "</br>";
		    	}
		    	echo "</br>";
		    }
			echo "</br>";
		} else {
		    echo "0 results";
			echo "</br></br>";
		}
	}

	function cek_user($user,$pass){
		$conn = connectDB();

		$sql = "SELECT username,password FROM user";
		mysqli_query($conn, $sql);

		$result = mysqli_query($conn, $sql);
		//echo $result;
		if (mysqli_num_rows($result) > 0) {
		    // output data of each row
		    while($row = mysqli_fetch_assoc($result)) {
		        if($user == $row['username'] && $pass == $row['password']){
					$_SESSION['login'] = true;
					$_SESSION['username'] = $user;
					$_SESSION['password'] = $pass;
					echo "login sukses";
					return true;
		        }
		    }
		} else {
		    return false;
		}
	}

	function generateBook(){
		$mysql_host = 'localhost';
		$mysql_username = 'root';
		$mysql_password = '';
		$mysql_database = 'dump';

		$conn = connectDB();

		$sql = "SELECT * FROM book";
		mysqli_query($conn, $sql);

		$result = mysqli_query($conn, $sql);
		//echo $result;
		if (mysqli_num_rows($result) > 0) {
		    // output data of each row
		    while($row = mysqli_fetch_row($result)) {
		    	$idbuku = $row[0];
		    	$gambar = $row[1];
		    	$judul = $row[2];
		    	$pengarang = $row[3];
		    	$penerbit = $row[4];
		    	$deskripsi = $row[5];
		    	$stok = $row[6];
		    	echo "<li class=\"col-md-12 list-group-item\">
					<div class=\"col-md-12 text-justify\">
						<div id=\"gambar buku\" class=\"col-md-3\">
							<img src=\"$gambar\" class=\"img-responsive\">
						</div>
						<div id=\"identitas buku\" class=\"col-md-9\">
							<div id=\"title\" class=\"panel\">
								<p class=\"col-md-4\">Nama Buku
									<span class=\"col-md-1 pull-right\">:</span>
								</p>
								<p class=\"col-md-8\">$judul</p>
							</div>
							<div id=\"author\" class=\"panel\">
								<p class=\"col-md-4\">Pengarang
									<span class=\"col-md-1 pull-right\">:</span>
								</p>
								<p class=\"col-md-8\">$pengarang</p>
							</div>
							<div id=\"publisher\" class=\"panel\">
								<p class=\"col-md-4\">Penerbit
									<span class=\"col-md-1 pull-right\">:</span>
								</p>
								<p class=\"col-md-8\">$penerbit</p>
							</div>
							<div id=\"description\" class=\"panel\">
								<p class=\"col-md-4\">Deskripsi
									<span class=\"col-md-1 pull-right\">:</span>
								</p>
								<p class=\"col-md-8\">$deskripsi</p>
							</div>
							<div id=\"quantity\" class=\"panel\">
								<p class=\"col-md-4\">Stok
									<span class=\"col-md-1 pull-right\">:</span>
								</p>
								<p class=\"col-md-8\">$stok</p>
							</div>
							<div id=\"button\" class=\"panel pull-right\">
								<form class=\"form\" method=\"post\">
									<input type=\"hidden\" name=\"idbuku\" value=\"$idbuku\"/>
									<button type=\"submit\" class=\"btn btn-danger\" name=\"command\" value=\"loan\">Pinjam Buku</button>
									<button type=\"submit\" class=\"btn btn-danger\" name=\"command\" value=\"return\">Kembalikan buku</button>
								</form>
							</div>
						</div>
					</div>
				</li>";
		    }
		} else {
		    return false;
		}
	}
?>