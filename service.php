<?php
	session_start();
	header("Content-Type: text/html; charset=ISO-8859-1");
	$perintah = $_GET['perintah'];

	if(!isset($_SESSION['login'])){
		$_SESSION['login'] = false;
	}
	
	$filename = 'personal_library.sql';
	$mysql_host = 'localhost';
	$mysql_username = 'root';
	$mysql_password = '';
	$mysql_database = 'dump';
	
	switch ($perintah) {
		case 'import_database':
			import_database($mysql_host,$mysql_username,$mysql_password,$mysql_database,$filename);
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
			import_database($mysql_host,$mysql_username,$mysql_password,$mysql_database,$filename);
			
			//print_database($mysql_host,$mysql_username,$mysql_password,$mysql_database);
			
			$cek = cek_user($username,$password,$mysql_host,$mysql_username,$mysql_password,$mysql_database);
			if(!$cek){
				$_SESSION['error'] = $_SESSION['username'];
				$_SESSION['warning'] = "Username atau password tidak ada";
				header("Location: login.php");
			}
			break;
		case 'submit_review':
			# code...
			break;
		default:
			# code...
			break;
	}

	function import_database($hostname,$username,$password,$database,$filename){
		$conn = mysqli_connect($hostname, $username, $password);

		$sql = "CREATE DATABASE $database";
		mysqli_query($conn, $sql);
		mysqli_select_db($conn,$database);

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

	function print_database($hostname,$username,$password,$database){
		$conn = mysqli_connect($hostname, $username, $password);
		mysqli_select_db($conn,$database);
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

	function cek_user($user,$pass,$hostname,$username,$password,$database){
		$conn = mysqli_connect($hostname, $username, $password);

		$sql = "SELECT username,password FROM user";
		mysqli_query($conn, $sql);
		mysqli_select_db($conn,$database);

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
		    return false;
		} else {
		    return false;
		}
	}
?>