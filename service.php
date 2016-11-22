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
	else if(isset($_GET['command'])){
		$command = $_GET['command']; 
	}

	if($_SERVER['PHP_SELF'] == "/a_12/service.php"){
		if($_SERVER['REQUEST_METHOD'] == "POST" || ($_SERVER['REQUEST_METHOD'] =="GET" && count($_GET) > 0)){
			
		}
		else{
			header('HTTP/1.0 404 Not Found');
	    	echo "<h1>Error 404 Not Found</h1>";
	    	echo "The page that you have requested could not be found.";
			exit();
		}
	}
	switch ($command) {
		case 'import_database':
			import_database();
			break;
		case 'login':
			# code...
			if(isset($_SESSION['login']) && $_SESSION['login']){
				header("Location: index.php");
			}
			else{
				$username = $_POST['username'];	
				$password = $_POST['password'];
			
				$cek = cek_user($username,$password);
				if($cek){
					header("Location:index.php");
				}
				else{
					$_SESSION['warning'] = "Username atau password tidak ada";
					header("Location: login.php");
				}
			}
			break;
		case 'submit_review':
			# code...
			break;
		case 'logout' :
			logout();
			break;
		case 'bookpage' :
			echo "masuk";
			bookpage();
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
		$sql = "CREATE DATABASE \"dump\"";
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

		$sql = "SELECT * FROM user";
		mysqli_query($conn, $sql);

		$result = mysqli_query($conn, $sql);
		//echo $result;
		if (mysqli_num_rows($result) > 0) {
		    // output data of each row
		    while($row = mysqli_fetch_assoc($result)) {
		        if($user == $row['username'] && $pass == $row['password']){
		        	$_SESSION['id'] = $row['user_id']; 
					$_SESSION['login'] = true;
					$_SESSION['username'] = $user;
					$_SESSION['role'] = $row['role'];
					return true;
		        }
		    }
		} else {
		    return false;
		}
	}

	function logout(){
		session_destroy();
		header("Location:index.php");
		// session_unset($_SESSION['id']);
		// session_unset($_SESSION['login']);
		// session_unset($_SESSION['username']);
		// session_unset($_SESSION['role']);
	}

	function bookpage(){
		$idbuku = $_GET['idbuku'];
		header("Location:halaman_buku.php?id=$idbuku");

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
		    	echo "<li class=\"col-md-12 col-sm-12 list-group-item\">
					<div class=\"text-justify\">
						<div id=\"gambar buku\" class=\"col-md-4 col-sm-4\">
							<img src=\"$gambar\" class=\"img-responsive\">
						</div>
						<div id=\"identitas buku\" class=\"col-md-12 col-sm-12\">
							<div id=\"title\" class=\"panel\">
								<p class=\"col-md-3 col-sm-3\">Nama Buku
									<span class=\"col-md-1 col-sm-1 pull-right\">:</span>
								</p>
								<p class=\"col-md-8 col-sm-8\">$judul</p>
							</div>
							<div id=\"author\" class=\"panel\">
								<p class=\"col-md-3 col-sm-3\">Pengarang
									<span class=\"col-md-1 col-sm-1 pull-right\">:</span>
								</p>
								<p class=\"col-md-8 col-sm-8\">$pengarang</p>
							</div>
							<div id=\"publisher\" class=\"panel\">
								<p class=\"col-md-3 col-sm-3\">Penerbit
									<span class=\"col-md-1 col-sm-1 pull-right\">:</span>
								</p>
								<p class=\"col-md-8 col-sm-8\">$penerbit</p>
							</div>
							<div id=\"description\" class=\"panel\">
								<p class=\"col-md-3 col-sm-3\">Deskripsi
									<span class=\"col-md-1 col-sm-1 pull-right\">:</span>
								</p>
								<p class=\"col-md-8 col-sm-8\">$deskripsi</p>
							</div>
							<div id=\"quantity\" class=\"panel\">
								<p class=\"col-md-3 col-sm-3\">Stok
									<span class=\"col-md-1 col-sm-1 pull-right\">:</span>
								</p>
								<p class=\"col-md-8 col-sm-8\">$stok</p>
							</div>
							<div id=\"button\" class=\"panel col-md-12 col-sm-12\">
								<form action=\"service.php\" class=\"form\" method=\"get\">
									<input type=\"hidden\" name=\"idbuku\" value=\"$idbuku\"/>
									<button type=\"submit\" class=\"btn btn-danger btn-xs btn-sm btn-xl\" name=\"command\" value=\"bookpage\">Halaman Buku</button>
									<button type=\"submit\" class=\"btn btn-danger btn-xs btn-sm btn-xl\" name=\"command\" value=\"loan\">Pinjam Buku</button>
									<button type=\"submit\" class=\"btn btn-danger btn-xs btn-sm btn-xl\" name=\"command\" value=\"return\">Kembalikan buku</button>
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