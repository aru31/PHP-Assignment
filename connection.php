<?php
$servername = "localhost";
$username = "root";
// Enter your root, password
$password = "Arp31121997";
$db = "pachpee";	
	$conn = new mysqli($servername, $username, $password, $db);//for connection to databse via php
	//conn is object And ,mysqli is class
if($conn->connect_error) {
	die("Connection failed :".$conn->connect_error);
}

?>