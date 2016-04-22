<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'goatcalc_admin');
define('DB_PASSWORD', 'admin123');
define('DB_DATABASE', 'goatcalc_main');

$username=$_POST["username"];
$password=$_POST["password"];


$db=mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
$query = "SELECT * FROM User WHERE Username='$username' AND Password='$password'";

$result=mysqli_query($db,$query);
$num=mysqli_num_rows($result);
if($num>0){
	session_start();
	$_SESSION['username'] = $username;
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else{
	?>
<html>
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
    div.unsuccessful{
    	position:absolute;
    	top:40%;
    	left:45%;
    	color:red;
    	font-size:18;
    }
    div.successful{
    	position:absolute;
    	top:40%;
    	left:45%;
    	color:red;
    	font-size:20;
    }
    button{
       position:absolute;
       top: 45%;
       left:45%;
       width:8%;
       height:5%;
       font-size: 14px;
       background-color: white;
       border-radius: 8px;    
    }
</style>

<body>
	<div class="banner">
		<p> <a href="/"style="text-decoration: none; color:red; font-size:50; font-weight:bold;"> GOAT Calculator </a></p>
	</div>


<body>
	<div class ="unsuccessful">Login Unsuccessful</div>
	<a href=<?php echo $_SERVER['HTTP_REFERER'] ?> >
    		<button>Try Again</button>
	</a>

	
<?php
}
?>