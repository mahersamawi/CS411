<hmtl>

<style type="text/css">
    body{
        background-color: #C0C0C0;
    }
    div.banner{
    	background-color: orange;
    	width: 90%;
        height: 10%;
    	color:red;
    	font-size:14;
    	padding-left:10%;
    	padding-top:0.5%;
    }
    </style>
    <body>
    <div class="banner">
		<p> <a href="http://goatcalculator.web.engr.illinois.edu/"style="text-decoration: none; color:red; font-size:50; font-weight:bold;"> GOAT Calculator </a></p>
    </div>
    </body>

	 <script type="text/javascript">
	 	alert("Sucessfully Created Account");
     		var url = "http://goatcalculator.web.engr.illinois.edu/";
     		window.location.assign(url);
     		</script>
<?php
		define('DB_SERVER', 'localhost');
		define('DB_USERNAME', 'goatcalc_admin');
		define('DB_PASSWORD', 'admin123');
		define('DB_DATABASE', 'goatcalc_main');
		
		$username=$_POST['username'];
		$password=$_POST['password'];
		$email=$_POST['email'];
		$firstname=$_POST['firstname'];
		$lastname=$_POST['lastname'];
		$favorite=$_POST['favorite'];
		
		
		#print $username;
		#print $password;
		
		$db=mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		$query = "SELECT * FROM User WHERE Username='$username'";
		$result=mysqli_query($db,$query);
		$num=mysqli_num_rows($result);
		if($num==0){
			$query = "INSERT INTO User (`Username`, `Password`, `First_name`, `Last_name`, `Email`, `Favorite_player`) VALUES ('$username', '$password', '$firstname', '$lastname', '$email', '$favorite');" ;
			if (mysqli_query($db, $query)) {
 		   		echo "New record created successfully";
			}
			else {
    				echo "Error: " . $query . "<br>" . mysqli_error($db);
    			}
    		}
    		else{
    			echo "User Already Exists";
    		}
		
		
?>

</html>