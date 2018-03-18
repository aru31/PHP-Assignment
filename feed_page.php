<?php
include("connection.php");

session_start();

if(!isset($_SESSION['username'])){
     header('location: login.php');
     echo "Login First.. ";
  }

	?>
		<?php
$user_feedp = $_SESSION['username'];

		$sql_feed = $conn->query("SELECT * FROM profile WHERE username='$user_feedp'");

		$row_feed = $sql_feed->fetch_assoc();

		if(($row_feed['branch'] == 1000) or ($row_feed['interest'] == 1000) or ($row_feed['profile_pic'] == 1000) or ($row_feed['cover_pic'] == 1000)){
			echo "Please Complete Profile to View all your posts";
		}
		else{
			/*To show all the common Posts*/
			$sql_post = "SELECT * FROM feed";
			$result_post = $conn->query($sql_post);


			if ($result_post->num_rows > 0) {
			while($row = $result_post->fetch_assoc()) {
				echo "" . $row["username"]. " Posted- " . $row["post"]. " <br>"." AT " . $row["post_date"]. "<br>";
				}

			} else {
				echo "Nothing to view right now";
			}
		}
?>
			<a href="logout.php"><button class="button">Logout</button></a><br>
	<a href="profile.php"><button class="button">Back to Profile</button></a>