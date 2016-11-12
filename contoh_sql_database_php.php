 <?php
/*
Contoh mysql database php dalam bentuk procedural

*/

$server_name = "localhost";
$user_name = "root";
$password = "";
$database_name = "myDB";

// Create connection
$conn = mysqli_connect($server_name, $user_name, "", $database_name);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error()."</br>");
}

// sql to create table
$sql = "CREATE TABLE MyGuests (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
email VARCHAR(50),
reg_date TIMESTAMP
)";

if (mysqli_query($conn, $sql)) {
    echo "Table MyGuests created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}
echo "</br></br>";

//Insert 1 data
$sql = "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('John', 'Doe', 'john@example.com')";
if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
echo "</br></br>";

//Insert 1 data + mendapatkan last id
$sql = "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('John', 'Doe', 'john@example.com')";
if (mysqli_query($conn, $sql)) {
    $last_id = mysqli_insert_id($conn);
    echo "New record created successfully. Last inserted ID is: " . $last_id;
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
echo "</br></br>";

//Insert multiple data
$sql = "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('John', 'Doe', 'john@example.com');";
$sql .= "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('Mary', 'Moe', 'mary@example.com');";
$sql .= "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('Julie', 'Dooley', 'julie@example.com')";

if (mysqli_multi_query($conn, $sql)) {
    echo "New records created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn)."</br>";
}
echo "</br>";

//Digunakan pada multi_query untuk menunggu data berikutnya
//agar tidak terjadi error
while(mysqli_next_result($conn)){
	;
}

//Select data
$sql = "SELECT id,firstname,lastname FROM myguests";
/*SELECT "atribut 1,...,atribut n" 
FROM "nama table"*/

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    }
	echo "</br>";
} else {
    echo "0 results";
	echo "</br></br>";
}


// sql to delete a record
$sql = "DELETE FROM MyGuests WHERE id=3";
/*DELETE FROM "table" 
WHERE "lokasi yang pengen diubah*/

if (mysqli_query($conn, $sql)) {
    echo "Record deleted successfully</br>";
    $sql = "SELECT id,firstname,lastname FROM myguests";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
	    // output data of each row
	    while($row = mysqli_fetch_assoc($result)) {
	        echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
	    }
	    echo "</br>";
	} else {
	    echo "0 results";
		echo "</br></br>";
	}
} else {
    echo "Error deleting record: " . mysqli_error($conn);
	echo "</br></br>";
}

//update value di database

$sql = "UPDATE MyGuests SET lastname='Wakwaw' WHERE id=2";
$result = mysqli_query($conn, $sql);
/*Update "table" 
Set "Atribut=value baru 
WHERE "lokasi yang pengen diubah*/

if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully</br>";
    $sql = "SELECT id,firstname,lastname FROM myguests";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
	    // output data of each row
	    while($row = mysqli_fetch_assoc($result)) {
	        echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
	    }
	    echo "</br>";
	} else {
	    echo "0 results";
		echo "</br></br>";
	}
} else {
    echo "Error updating record: " . mysqli_error($conn);
    echo "</br></br>";
}

/*Selection Limit
berguna ketika ingin memilih data yang banyak,
sama seperti select, hanya yang diselect dibatasi
berapa banyak item yang diinginkan*/

/*
$sql = "SELECT * FROM Orders LIMIT 30";
Contoh tersebut berarti memilih semua elemen dari table
Orders dengan batas maksimum elemen 30

$sql = "SELECT * FROM Orders LIMIT 10 OFFSET 15";
Contoh tersebut berarti memilih semua elemen dari table
Orders dengan offset 15 (berarti mulai dari index ke 16)
lalu mengambil 10 elemen.
Berarti mengambil elemen 16 - 25 secara inklusif
Bentuk lainnya :
$sql = "SELECT * FROM Orders LIMIT 15, 10";
 */



mysqli_close($conn);
?>