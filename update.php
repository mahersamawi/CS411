<?php session_start(); ?>
<?php
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'goatcalc_admin');
	define('DB_PASSWORD', 'admin123');
	define('DB_DATABASE', 'goatcalc_main');
		
		$username=$_SESSION['user_name'];
		$firstname=$_POST['firstname'];
		$lastname=$_POST['lastname'];
		$favorite=$_POST['favorite'];
		
		
		#print $username;
		#print $password;
		
		$db=mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		$query = "UPDATE users SET First_name='$firstname', Last_name='$lastname', Favorite_player='$favorite' WHERE  user_name='$username';" ;
		mysqli_query($db, $query);
 		header('Location: /profile.php');
  
		
		
?>

</html>