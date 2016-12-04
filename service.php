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
			bookpage();
			break;
		case 'loan' :
			loan();
			break;
		
		case 'return' :
			returnBook();
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
	
	function cek_user($user,$pass){
		$conn = connectDB();
		$sql = "SELECT * FROM user";
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
	}

	function bookpage(){
		$idbuku = $_GET['idbuku'];
		header("Location:halaman_buku.php?id=$idbuku");
	}

	function searchName($id){
		$conn = connectDB();
		$sql = "SELECT * FROM user where user_id=$id";
		$result = mysqli_query($conn, $sql);
		//echo $result;
		if (mysqli_num_rows($result) > 0) {
		    // output data of each row
		    while($row = mysqli_fetch_assoc($result)) {
		        if($id == $row['user_id']){
		        	return $row['username'];
		        }
		    }
		} else {
		    return false;
		}
	}

	function loan(){
		$user_id = $_SESSION['id'];
		$thisid = $_GET['idbuku'];
		$conn = connectDB();
		$sql = "INSERT INTO loan (book_id, user_id) VALUES ('$thisid', '$user_id')";
		//echo $result;
		if (mysqli_query($conn, $sql)) {
			$sql = "SELECT * FROM book WHERE book_id=$thisid";
			$result = mysqli_query($conn, $sql);
			//echo $result;
			while($row = mysqli_fetch_row($result)) {
				if (mysqli_num_rows($result) > 0) {
			    	$idbuku = $row[0];
			    	$stok = $row[6];
			    	setStock($idbuku,$stok);
			    }
			}
		} else {
		    return false;
		}
	}

	function setStock($idbuku,$stok){
		$stock = $stok-1;
		$conn = connectDB();
		$sql = "UPDATE book SET quantity='$stock' WHERE book_id=$idbuku";
		mysqli_query($conn, $sql);
		header("Location:halaman_buku.php?id=$idbuku");
	}

	function returnBook(){

	}
	function generateReview(){
		$conn = connectDB();
		$thisid= $_GET['id'];
		$sql = "SELECT * FROM review";
		$result = mysqli_query($conn, $sql);
		//echo $result;
		while($row = mysqli_fetch_row($result)) {
			if (mysqli_num_rows($result) > 0) {
		    	$review_id = $row[0];
		    	$book_id = $row[1];
		    	$user_id = $row[2];
		    	$date = $row[3];
		    	$content = $row[4];
		    	$name = searchName($user_id);

		    	if($book_id == $thisid){
		    		echo"
		    		<div class=\"panel\">
						<div id=\"user\">
							$name
						</div>
						<div id=\"paragraph\">
							$content
						</div>
						<div id=\"time\">
							$date
						</div>
					</div>";
		    	}
			} else {
			    return false;
			}
		}
	}

	function generateBookPage(){
		$conn = connectDB();
		$thisid = $_GET['id'];
		$sql = "SELECT * FROM book WHERE book_id=$thisid";
		$result = mysqli_query($conn, $sql);
		//echo $result;
		while($row = mysqli_fetch_row($result)) {
			if (mysqli_num_rows($result) > 0) {
		    	$idbuku = $row[0];
		    	$gambar = $row[1];
		    	$judul = $row[2];
		    	$pengarang = $row[3];
		    	$penerbit = $row[4];
		    	$deskripsi = $row[5];
		    	$stok = $row[6];

		    	echo "<div id=\"gambar\" class=\"panel\">
						<img src=\"$idbuku.jpg\" class=\"img-responsive\">
					</div>
					<div id=\"identitas\" class=\"panel\">
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
					</div>";
					if(isset($_SESSION['login']) && $_SESSION['login']){
						echo " <div id=\"button\" class=\"panel\">
								<form action=\"service.php\" class=\"form\" method=\"get\">
									<input type=\"hidden\" name=\"idbuku\" value=\"$idbuku\"/>
									<button type=\"submit\" class=\"btn btn-danger btn-xs btn-sm btn-xl\" name=\"command\" value=\"loan\">Pinjam Buku</button>
									<button type=\"submit\" class=\"btn btn-danger btn-xs btn-sm btn-xl\" name=\"command\" value=\"return\">Kembalikan buku</button>
								</form>
							</div>";
					}
			} else {
			    return false;
			}
		}
	}

	function generateHome(){
		$conn = connectDB();
		$sql = "SELECT * FROM book";
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

		    	if($idbuku%2 == 1){
		    		echo "<div class=\"row\">";
		    	}
		    	echo "<div class=\"col-md-6 panel\">
						<img src=\"$idbuku.jpg\" class=\"img-responsive\"/>
						<p>$judul</p>
						<form action=\"service.php\" class=\"form\" method=\"get\">
							<input type=\"hidden\" name=\"idbuku\" value=\"$idbuku\"/>
							<button type=\"submit\" class=\"btn btn-danger btn-xs btn-sm btn-xl\" name=\"command\" value=\"bookpage\">Halaman Buku</button>
						</form>
					</div>";
				if($idbuku%2==0){
					echo"</div>";
				}
		    }
		} else {
		    return false;
		}
	}

	function showLoan(){
		$conn = connectDB();
		$sql = "SELECT * FROM loan";
		$result = mysqli_query($conn, $sql);
		$books = array();
		if(isset($_SESSION['login']) && $_SESSION['login']){
			$user_id = $_SESSION['id'];
			$user_name = $_SESSION['username'];
			//echo $user_id;
			//echo $user_name;
			//echo '<br>';
			if (mysqli_num_rows($result) > 0) {
				while($row = mysqli_fetch_row($result)) {
		    		$idLoan = $row[0];
		    		$idBook = $row[1];
		    		$idUser = $row[2];
		    		if($idUser == $user_id){
		    			if(array_key_exists($idBook, $books)){
		    				$books[$idBook] += 1;
		    				//echo $books[$idBook];
		    				//echo '<br>';
		    			} else {
		    				$books[$idBook] = 1;
		    				//echo $books[$idBook];
		    				//echo '<br>';
		    			}
		    			//echo $idBook;
		    			//showBook($idBook);
		    			//echo '<br>';
		    		}
		    	}
			}
			foreach ($books as $key => $value) {
				$bookName = showBook($key);
				echo 
				'<tr>
					<td>' . $bookName . '</td>
					<td>' . $value . '</td>
					<td>  </td>
				</tr>';
			}
		}
	}

	function showBook($bookId){
		$conn = connectDB();
		$sql = "SELECT * FROM book";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_row($result)) {
				$idbuku = $row[0];
		    	$judul = $row[2];
		    	if($bookId == $idbuku){
		    		return $judul;
		    	}		    	
		    }	
		}		
	}
?>