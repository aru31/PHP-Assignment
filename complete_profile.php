<?php
include("connection.php");

session_start();

if(!isset($_SESSION['username'])){
     header('location: login.php');
     echo "Login First.. ";
  }

?>

<?php

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$branch = ($_POST["branch"]);
		$interests = ($_POST["interest"]);
		$profile_pic = "";
		$cover_pic = "";
		$cookie_user = "";
		$yo_p = 0;
        $error_display1 = $error_display2 = $error_display3 = "";

		if(isset($_COOKIE['sessionid'])){
			$id_pass = $_COOKIE['sessionid'];
				$sql_cook_query = $conn->query("SELECT username FROM Cookie WHERE cook_id='$id_pass'");

				$row_cook = $sql_cook_query->fetch_assoc();
				$cookie_user = $row_cook['username'];
				
				if($cookie_user === '' and $cookie_user != $_SESSION['username'] ){
					echo "Please Log in to continue"."<br>";
				header('location:login.php');
				exit();

				}
			}

     $cookie_user = $_SESSION['username'];


     $sql_po = "UPDATE profile SET username='$cookie_user' where username='$cookie_user'";

     if ($conn->query($sql_po) === TRUE) {

			if(preg_match("/^[a-zA-Z]+$/",$branch)){
				$sql_branch="UPDATE profile SET branch='$branch' where username='$cookie_user'";
				if ($conn->query($sql_branch) === TRUE) {
					echo "Branch Entered";
				} else {	
					echo "Error ";
				}
			}
			else{
				$yo_p=1;
				$error_display1="Branch must consist of alphabets";
			}


			if(preg_match("/^[a-zA-Z]+$/",$interests)){
				$sql_interest="UPDATE profile SET interest = '$interests' where username='$cookie_user'";
				if ($conn->query($sql_interest) === TRUE) {
					echo "Interests Entered";
				} else {	
					echo "Error ";
				}
			}
			else{
				$yo_p = 1;
				$error_display2 = "Interests must consist of alphabets";
			}


			$target_dir = "uploads/";
			$target_file = $target_dir.basename($_FILES["profile_pic"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" ) {
				echo "Profile Picture not changed .";
			$uploadOk = 0;
		}
// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Profile pic not changed.";
// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
				$sql = "UPDATE profile set profile_pic = '$target_file' where username = '$cookie_user'";
				$result = mysqli_query($conn,$sql);
				echo "The file ". basename( $_FILES["profile_pic"]["name"]). " has been uploaded.";
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
		} 


		$target_direc = "uploads/";
		$target_filec = $target_direc.basename($_FILES["cover_pic"]["name"]);
		$uploadOkk = 1;
		$imageFileTypee = pathinfo($target_filec,PATHINFO_EXTENSION);
// Allow certain file formats
		if($imageFileTypee != "jpg" && $imageFileTypee != "png" && $imageFileTypee != "jpeg"
			&& $imageFileTypee != "gif" ) {
			$uploadOkk = 0;
	}
// Check if $uploadOk is set to 0 by an error
	if ($uploadOkk == 0) {
		echo "Cover photo not changed.";
// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["cover_pic"]["tmp_name"], $target_filec)) {
			echo "The file ". basename( $_FILES["cover_pic"]["name"]). " has been uploaded.";            
			$sqll = "UPDATE profile set cover_pic = '$target_filec' where username = '$cookie_user'";
			$resultt = mysqli_query($conn,$sqll);
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}


}


}


?>

<?php
   $user_me = $_SESSION['username'];
    $sql_values = "SELECT * FROM profile where username = '$user_me'";
    $result_value = $conn->query($sql_values);
    $row_value = $result_value->fetch_assoc();
    $branch_ = $row_value['branch'];
    $interest_ = $row_value['interest'];
    $profile_pic = $row_value['profile_pic'];
    $cover_pic_ = $row_value['cover_pic'];
?>

<html>
<head>
	<title>Your Info</title>
	</head>

	<body>
		
		<form  action="" method="POST" enctype="multipart/form-data">
<table>
      		 <tr>
            <th><label for="branch">Branch</label></th>
            <td><input type="text" id="branch" name="branch" value="<?php echo $branch_; ?>" /></td>
      </tr>
        

         <tr>
            <th><label for="interest">Interests</label></th>
            <td><input type="text" id="interest" name= "interest" value="<?php echo $interest_; ?>" /></td>
      </tr>

      <tr>
            <th><label for="profile_pic">Profile Picture</label></th>
            <td><input type="file" id="profile_pic" name= "profile_pic" /></td>
      </tr>

       <tr>
            <th><label for="cover_pic">Upload Cover Pic</label></th>
            <td><input type="file" id="cover_pic" name= "cover_pic" /></td>
      </tr>

</table>  
      		 <input type="submit" value="Submit" name="change_pass" />
  	
      	</form>

<a href="profile.php"><button class="button">Profile</button>
	</body>

