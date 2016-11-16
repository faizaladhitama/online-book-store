<?php 
	session_start();
	$_SESSION['nama'];

	//access database
	$sql = "SELECT * FROM user";
	/*SELECT "atribut 1,...,atribut n" 
	FROM "nama table"*/

	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
	    // output data of each row
	    while($row = mysqli_fetch_assoc($result)) {
	    	foreach($row as $key=>$value){
	    		echo "$key: " . $value . "</br>";
	    	}
	    	echo "</br></br>";
	    }
		echo "</br>";
	} else {
	    echo "0 results";
		echo "</br></br>";
	}
?>