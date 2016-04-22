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
    	padding-left:15%;
    	padding-top:0.5%;
    }
    div.search_message{
    	font-size:16;
    	padding-left:15%;
    }
</style>
<body>
	<div class="banner">
		<h1> GOAT Calculator </h1>
	</div>
	<div class="search_message">
		<h2> Searching for <span style="color:red;font-weight:bold"> 
				<?php print $_GET["search"];?> </span>
		</h2> 
		<br>
		<h3> The results 
	</div>
	

<?php
//echo 'hello';
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'goatcalc_admin');
define('DB_PASSWORD', 'admin123');
define('DB_DATABASE', 'goatcalc_main');
$db=mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
$query = "SELECT * FROM Player WHERE 1";
$result=mysqli_query($db,$query);
$num=mysqli_num_rows($result);

//print $_GET["search"];
//echo $num;
//echo "<br />\r\n";
//while ($row = mysqli_fetch_assoc($result)) {
//print_r($row);

//print 'FirstName: '.$row['FirstName'].' ';
//print 'LastName: '.$row['LastName'].' ';
//print 'Team: '.$row['Team'].' ';
//print 'Points: '.$row['Points'].' ';
//print 'Rebounds: '.$row['Rebounds'].' ';
//print 'Assists: '.$row['Asissts'].' ';
//print 'Blocks: '.$row['Blocks'].' ';
//print 'Steals: '.$row['Steals'].' ';

//print "<br/>";
//}

?>
</body>
</html>