<?php
header("Content-Type: text/html; charset=ISO-8859-1");
/*Sumber:
http://stackoverflow.com/questions/19751354/how-to-import-sql-file-in-mysql-database-using-php
*/

// Name of the file
$filename = 'personal_library.sql';
// MySQL host
$mysql_host = 'localhost';
// MySQL username
$mysql_username = 'root';
// MySQL password
$mysql_password = '';
// Database name
$mysql_database = 'dump';

// Connect to MySQL server
$conn = mysqli_connect($mysql_host, $mysql_username, $mysql_password) or die('Error connecting to MySQL server: ' . mysqli_error($conn));

//Sql create database
$sql = "CREATE DATABASE $mysql_database";
if (mysqli_query($conn, $sql)) {
    echo "Database created successfully</br></br>";
} else {
    echo "Error creating database: " . mysqli_error($conn) . "</br></br>";
}

// Select database
mysqli_select_db($conn,$mysql_database) or die('Error selecting MySQL database: ' . mysqli_error($conn));

// Temporary variable, used to store current query
$templine = '';
// Read in entire file
$lines = file($filename);
// Loop through each line
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
    mysqli_query($conn,$templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysqli_error($conn) . '<br /><br />');
    // Reset temp variable to empty
    $templine = '';
}
}
echo "Tables imported successfully</br></br>";

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
    	echo "</br></br>";
    }
	echo "</br>";
} else {
    echo "0 results";
	echo "</br></br>";
}
?>