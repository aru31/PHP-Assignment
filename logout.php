<?php
	include('connection.php');
	session_start();
	session_unset();
	session_destroy();

  if(isset($_COOKIE['sessionid'])){
	$delete_id = $_COOKIE['sessionid'];
	$sql_del = $conn->query("DELETE FROM Cookie WHERE cook_id='$delete_id'");
	setcookie("sessionid","", time() - (86400 * 30));
}
	echo "You have successfully logged out"."<br>";
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Logout</title>
	</head>
	<body>
		<a href="login.php"><button>Login</button></a>
	</body>
	</html>