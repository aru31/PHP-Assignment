<?php
include('connection.php');


session_start();

if(!isset($_SESSION['username'])){
     header('location: login.php');
     echo "Login First.. ";
  }

$user_me = $_SESSION['username'];

$current_one = "";
$new_pass = "";
$conf_pass = "";
$message1 = $message2 = $message3 = $message4 = "";
?>



<?php    
   if($_SERVER["REQUEST_METHOD"] == "POST") {
    $current_one = md5($_POST['current']);
		$new_pass = md5($_POST['upda']);
		$conf_pass = md5($_POST['confi']);

		$sql_pass = $conn->query("SELECT password_one FROM Register WHERE username = '$user_me'");
    $pass_row = $sql_pass->fetch_assoc();

		if($current_one === $pass_row['password_one'] and $new_pass === $conf_pass){
        $sql_upda="UPDATE Register SET password_one='$new_pass' where username='$user_me'";
         
         if($conn->query($sql_upda) === TRUE){
         	$message1 = "Password Updated Successfully";
         }
         else{
         	$message2 = "error Try Again";
         }
	}
	else{
		$message4 = "Please type correct password";
	}
  }

?>

<head>
<title>Change Password</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

	<form  action="" method="POST">
<table>
      		 <tr>
            <th><label for="current">Current Password</label></th>
            <td><input type="password" id="current" name="current" value="<?php echo $current_one; ?>" /> <span><?php if($message2 != ""){echo $message2;} ?></span> </td>
      </tr>
        

         <tr>
            <th><label for="upda">Password</label></th>
            <td><input type="password" id="upda" name= "upda" /> <span><?php if($message4 != ""){echo $message4;} ?></span></td>
      </tr>

      <tr>
            <th><label for="confi">Confirm New</label></th>
            <td><input type="password" id="confi" name= "confi" /></td>
      </tr>

</table>  
      		 <input type="submit" value="Update" name="change_pass" />
  	
      	</form>

<?php
          if(isset($message1)){
          	echo "<div class = 'message'>". $message1 ."</div>"; 
          }
?>


<a href="profile.php"><button class="button">Profile Page</button></a>