<?php 

session_start();

include("connection.php");
$name = "";
$user = "";
$email = "";
$mobile = "";
$password_one = "";
$password_confirm = "";
$error_dis1 = $error_dis2 = $error_dis3 = $error_dis4 = $error_dis5 = "";

if(isset($_POST["reg_page"])){
  $name = trim(filter_input(INPUT_POST, "name_o",FILTER_SANITIZE_STRING));
	$user = trim(filter_input(INPUT_POST, "user",FILTER_SANITIZE_STRING));
	$email = trim(filter_input(INPUT_POST,"email",FILTER_SANITIZE_EMAIL));
  $mobile = ($_POST["number"]);
	$password_one= $_POST["password"];
	$password_confirm = $_POST["confirm"];
  $yo = 0;
  


if(preg_match("/^[a-zA-Z]+$/",$name)){
  }
  else{
    $yo = 1;
    $error_dis1 = "Enter a Valid Name";
    echo $error_dis1;
  }



if(preg_match("/^[a-zA-Z0-9]+$/",$user)){
   $result = $conn->query("SELECT username from Register where username='$user'");

    $rows = $result->num_rows;

  if ($rows > 0) {
    $yo = 1;
    $error_dis2 = "Username already taken";
    echo $error_dis2;
    } 
  }
  else{
    $error_dis2 = "Please enter a valid username";
  }


  if(preg_match("/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/",$email)){
  }
  else{
    $yo = 1;
    $error_dis3 = "Is this Email Address .. :(";
  } 



  if(preg_match("/^(\+[\d]{1,5}|0)?[7-9]\d{9}$/", $mobile)){
  }
  else{
    $yo = 1;
    $error_dis4 = "Enter a valid mobile number";
  }


  if(isset($password_one)){
    if($password_one === $password_confirm){
      $password_one = md5($password_one);
    }
    else{
      $yo = 1;
      $error_dis5 = "Password's Didnot Match..  XD";
    }
  }
  else{
    $error_dis5 = "Please donot leave Password field empty";
  }


if($yo===0){
$sql = "INSERT INTO Register(name, username, email, password_one, mobile) 
           VALUES ('$name', '$user', '$email', '$password_one', '$mobile')";

   if($conn->query($sql) === TRUE){
		header('location: login.php'); 
    exit;

   }
}
else{
   echo "Please check your Details";
}

}



//Now one needs to login from the login page

if(isset($_POST["log_page"])){

$user_log = trim(filter_input(INPUT_POST, "username1",FILTER_SANITIZE_STRING));
$password = $_POST["password"];
$password_enc = md5($password);

if($user_log == "" || $password == ""){
  echo "Please fill in the required fields: Name and Password";
    exit;
  }

		$sql_query =  "SELECT * FROM Register WHERE username = '$user_log' AND password_one = '$password_enc'";
    
$results_login = $conn->query($sql_query);


 if($results_login->num_rows > 0){
  $_SESSION['username'] = $user_log;
		
   //Cookie
    if(isset($_POST["remem"])){
      $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
     
     $session_id=rand(1, 100000);
     $id_session=md5($session_id);

      $result_coo = $conn->query("INSERT INTO Cookie(cook_id, username) VALUES ('$id_session','$user_log')");

        setcookie("sessionid",$id_session, time() + (86400 * 30),$domain,false);
    }

 $result_pro = $conn->query("INSERT INTO profile(username) 
           VALUES ('$user_log')");

          
    $sql_redirec = "SELECT * FROM profile WHERE username = '$user_log'";
  $result_redirec = $conn->query($sql_redirec);

  $row_redirec = $result_redirec->fetch_assoc();

  if(isset($row_redirec['branch']) and isset($row_redirec['interest']) and isset($row_redirec['profile_pic']) and isset($row_redirec['cover_pic'])){
      header('location: profile.php');
    }
    else{
      header('location: complete_profile.php');
    }
  
    }
      else{
        echo "Please eneter correct details";
        exit();
      }
    

}

?>




