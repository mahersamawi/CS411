<?php session_start(); ?>
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
	 	alert("Account Deleted");
     		var url = "http://goatcalculator.web.engr.illinois.edu/";
     		window.location.assign(url);
     		</script>
<?php
		define('DB_SERVER', 'localhost');
		define('DB_USERNAME', 'goatcalc_admin');
		define('DB_PASSWORD', 'admin123');
		define('DB_DATABASE', 'goatcalc_main');
		
		$username=$_SESSION['user_name'];
		
		$db=mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		$query = "DELETE FROM users WHERE user_name='$username'";
		$result=mysqli_query($db,$query);
		
		session_unset();  
		session_destroy(); 

?>

</html>