<?php 
include('connection.php');


$user_ajax = $_GET['user_ajax'];
$query = "SELECT username FROM Register WHERE username = '$user_ajax'";

$result = mysqli_query($conn, $query);
if ($result) {
if (mysqli_num_rows($result)<1) {
   echo "Username is Available";
}
else{
   echo "Username is Not available";
}
}
else {
  echo "Username is Available";
}
?>