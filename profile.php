<?php include('connection.php'); 


session_start();


if(!isset($_SESSION['username'])){
     header('location: login.php');
     echo "Login First.. ";
  }

$user_profile = "";

if(isset($_COOKIE['sessionid'])){

	$user_session = $_COOKIE['sessionid'];
	$sql_que = $conn->query("SELECT username FROM Cookie WHERE cook_id='$user_session'");

	$row_session = $sql_que->fetch_assoc();
	$user_profile = $row_session['username'];
	
}
else{
	$user_profile=$_SESSION['username'];
}


if($user_profile === ''){
	echo "Log in you idiot";
	header('location:login.php');
	exit();
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data); 
	$data = htmlspecialchars($data);
	return $data;
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>

</head>
<body>
	<p>Welcome <?php echo $user_profile ?></p>

	
	<a href="password.php"><button class="button">Update Password</button></a><br>
	<a href="complete_profile.php"><button class="button">Update Profile</button></a>
	<a href="logout.php"><button class="button">Logout</button></a>


	<?php 
	$sql_fin = $conn->query("SELECT * from Register where username='$user_profile'");
	$sql_fin1 = $conn->query("SELECT * from profile where username='$user_profile'");
	$row_q = $sql_fin->fetch_assoc();
	$row_w = $sql_fin1->fetch_assoc();
	
	?>
	
	<table>
   <tr>
        <th>Name:</th>
        <td><?php echo $row_q["name"]; ?></td>
   </tr>

      <tr>
        <th>Email:</th>
        <td><?php echo $row_q["email"]; ?></td>
   </tr>

    <tr>
        <th>Mobile:</th>
        <td><?php echo $row_q["mobile"]; ?></td>
   </tr>

    <tr>
        <th>Branch:</th>
        <td><?php echo $row_w["branch"]; ?></td>
   </tr>

    <tr>
        <th>Interest:</th>
        <td><?php echo $row_w["interest"]; ?></td>
   </tr>

</table>

	<?php echo "<img src='".$row_w['cover_pic']."' id='cover' alt='cover_pic.' height = '300' width = '300'/>"; 
	echo "<br>";

	echo "<img src='".$row_w['profile_pic']."' id='profile' alt=' profile_pic.' height = '300' width = '300'/>";
	?>
	


<form action="" method="post">
		POST:
		<input type="text" name="feed_post">
		<input type="submit" name="submitpost"></input>
		<br>
	</form>


	<?php 

	if($_SERVER["REQUEST_METHOD"] == "POST") {

		function input($data) {
	$data = trim($data);
	$data = stripslashes($data); 
	$data = htmlspecialchars($data);
	return $data;
}

$user_feed = $_SESSION['username'];

  $post= input($_POST['feed_post']);

		$date = date("Y-m-d H:i:s");
		$sql_feed="INSERT INTO feed(username,post,post_date) VALUES ('$user_feed','$post','$date')";
		
		if($conn->query($sql_feed)){
			echo "";
		}
		else{
			echo "Some Problem occurred";
		}

		header('location: feed_page.php'); 
		}
		?>



	</body>
	</html>