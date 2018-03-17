<?php
 require('server.php'); 

 if(isset($_COOKIE['sessionid'])){
    $id_sess = $_COOKIE['sessionid'];
   $sql_query_se =  "SELECT username FROM Cookie WHERE cook_id = '$id_sess'";
    
$results_login_se = $conn->query($sql_query_se);

$row_session_se = $results_login_se->fetch_assoc();
  $user_session_se = $row_session_se['username'];

     $_SESSION['username'] = $user_session_se;

$sql_redirec = "SELECT * FROM profile WHERE username = '$user_session_se'";
  $result_redirec = $conn->query($sql_redirec);

  $row_redirec = $result_redirec->fetch_assoc();

  if(isset($row_redirec['branch']) and isset($row_redirec['interest']) and isset($row_redirec['profile_pic']) and isset($row_redirec['cover_pic'])){
      header('location: profile.php');
    }
    else{
      header('location: complete_profile.php');
    }
  }
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>login</title>
	<link rel="stylesheet" type="text/css">
 
</head>
<body>
	<div class="login_page">
  		
    		<form  action="" method="POST">
          

<table>

      		 <tr>
            <th><label for="username1">UserName</label></th>
            <td><input type="text" id="username1" name="username1" /></td>
      </tr>
        

         <tr>
            <th><label for="password">Password</label></th>
            <td><input type="password" id="password" name="password" /></td>
      </tr>

       <tr style="display:none">
            <th><label for="address">Address</label></th>
            <td><input type="text" id="address" name="address" /><p>Please leave this field blank</p></td>
      </tr>
     

</table>  
          <input type="checkbox" name="remem"></input>Remember Me
      		 <input type="submit" value="Login" name="log_page" />

      	<p class="login_">Not registered? <a href="register.php">Create an account</a></p>
  	
      	</form>
  
</div>

</body>
</html>


