<?php session_start();
include 'connect.php' ?>
<html>
<head>
	<title> goatcalculator.com</title>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
</head>
<style type="text/css">
    body{
        background-color: #C0C0C0;
        margin: 0px;
        padding: 0px;
    }
     div.name_pass{
        color: black;
        position: absolute;
        top: 0.5%;
        right: 4%;
        text-align:right;
        padding-right: 1%;
     
     }
      div.logged_in{
       float: right;
       margin-top: 20px;
     }

     button[type="submit1"]{
     	
     }
     button[type="submit2"]{
     	
    }
    button[type="submit3"]{
     	
    }
    div.banner-wrapper {
    	background-color: orange;
    	height: 130px;
    }
    div.banner {
    	width: 90%;
    	font-weight:bold;
    	overflow: auto;
    	margin: 0 auto;

    }
    div.banner a {
    	text-decoration: none;
    	color: red;
    }
    div.banner h2 {
    	margin-top: 20px;
    	margin-bottom: 10px;
    	float: left;
    	font-size: 30px;
    	font-weight: bold;
    }
    div.profile{
    	width: 90%;
        height: 2%;
    	color:red;
    	font-size:20;
    	padding-left:10%;
    	padding-top:0.5%;
    }

    p1 {
        position: absolute;
        color:black;
        text-align: left;
        font-size:25px;
	padding-left:10%;
    }


</style>


<script type="text/javascript">
function findTotalGoats(x){
   if(x< 5){
   	alert("Find more unique GOATS, so we can recommend you one!");
   	return false;
   	}
}

    </script>


<body>
	<div class = "banner-wrapper">
 	<div class="banner">
		 <a href= "http://goatcalculator.web.engr.illinois.edu/"> <h2>GOAT Calculator </h2></a>
		 
		 <div class="logged_in" >
		       	 <p style="font-size: 15px; color: black;"> Logged in as: <?php echo '' . $_SESSION['user_name'] . '';?></p>
		      	<form action = "logout_profile.php" method ="GET" id ="form2"> 
		      	<button type="submit2" form="form2">Logout </button>
			</form>
		      </div>
	</div>
	</div>
      
     

<?php
$max=1000;
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'goatcalc_admin');
define('DB_PASSWORD', 'admin123');
define('DB_DATABASE', 'goatcalc_main');
$name=$_SESSION['user_name'];
$db=mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

#print "<br/>";
$query = "SELECT * FROM users WHERE user_name='$name'";
#print $query;
#print "<br/>";
$result=mysqli_query($db,$query);
$num=mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result)
?>
	<div class="profile">
		<p>Username: <?php echo $row['user_name'];?></p>
	</div> 
	<div class="profile">
		<p>First Name: <?php echo $row['First_name'];?></p>
	</div> 
	<div class="profile">
		<p>Last Name: <?php echo $row['Last_name'];?></p>
	</div> 
	<div class="profile">
		<p>Email: <?php echo $row['Email'];?></p>
	</div> 
	<div class="profile">
		<p>Favorite Player: <?php echo $row['Favorite_player'];?></p>
	</div>
	<div class="profile">
		<?php
		echo "<p>";
			$CAT_NAME = $row['Preference1'] . ' / ' . $row['Preference2'];
		//	echo '<br>';
		//	echo $CAT_NAME;
			
			$FORUM_QUERY = "SELECT cat_id
					FROM categories
					WHERE cat_name = '" . mysql_real_escape_string($CAT_NAME) . "'";
			
			$FQ_RES = mysql_query($FORUM_QUERY);
			$F_DATA = mysql_fetch_assoc($FQ_RES);
			
			
			$SF_URL = "category.php?id=" . $F_DATA['cat_id'];
		//	echo $SF_URL;
		//	echo $row['Preference1'];
		//	echo ' / ';
		//	echo $row['Preference2'];
			
			
			
	
		echo "Preferences: <a href='$SF_URL'>$CAT_NAME</a></p>";
		?>
	</div>
	<div align="center">
		<form action = "updateuser.php" method ="GET"> 
			<button> Edit Profile</button>
		</form>
	</div>
	<div align="center">
		<form action = "delete_user.php" method ="GET"> 
			<button> Delete Profile</button>
		</form>
	</div>
	
	<div align="center">
			<p2> Your GOAT History </p2> <br> <br>
	</div>
<?php
$query = "select * from
(Select Distinct Username as Un,  goat_name from GoatHistory) as B
inner join
`Basketball_Players`
on `Basketball_Players`.player=B.goat_name
where B.Un='$name'";
#print $query;
#print "<br/>";
$result=mysqli_query($db,$query);
$num=mysqli_num_rows($result);
if($num>0){

?>

<table  class = "results" border="2" align="center" style="width:95%">
  <thead>
    <th>Player</th>
    <th>Team</th> 
    <th>College</th>
    <th>Years Played</th>
    <th>Games</th>
    <th>Minutes Played</th>
    <th>Points</th>
    <th>Rebounds</th>
    <th>Assists</th>
    <th>FG%</th>
    <th>3P%</th>
    <th>FT%</th>
    <th>MPG</th>
    <th>PPG</th>
    <th>RBPG</th>
    <th>APG</th>
    <th>WS</th>
    <th>WS/48</th>
    <th>BPM</th>
    <th>VORP</th>
    <th>Information</th>
  </thead>
<?php
 if($num<=$max){
    $i=1;//new line
    while($row = mysqli_fetch_assoc($result)){
?>

 <tr>
      <td><?php echo $row['Player']; ?></td>
      <td><?php echo $row['Team']; ?></td>
      <td><?php echo $row['College']; ?></td>
      <td><?php echo $row['Years Played']; ?></td>
      <td><?php echo $row['Games']; ?></td>
      <td><?php echo $row['Minutes Played']; ?></td>
      <td><?php echo $row['Points']; ?></td>
      <td><?php echo $row['Rebounds']; ?></td>
      <td><?php echo $row['Assists']; ?></td>
      <td><?php echo $row['FG_P']; ?></td>
      <td><?php echo $row['3P_P']; ?></td>
      <td><?php echo $row['FT_P']; ?></td>
      <td><?php echo $row['MPG']; ?></td>
      <td><?php echo $row['PPG']; ?></td>
      <td><?php echo $row['RBPG']; ?></td>
      <td><?php echo $row['APG']; ?></td>
      <td><?php echo $row['WS']; ?></td>
      <td><?php echo $row['WS_PER_48']; ?></td>
      <td><?php echo $row['BPM']; ?></td>
      <td><?php echo $row['VORP']; ?></td>
      <td><a target="_blank" style="color:red;"href="https://en.wikipedia.org/wiki/<?php echo str_replace(' ', '_',$row['Player']); ?>"> More Info </a></td>
      
    </tr>

<?php             
    $i++;
    }
  }
  
  else{
	print "Too many results";
  }
  }
?>
</table>
<div align="center"> <br>
		<form action = "./algorithm/recommend.php" method ="GET" onsubmit="return findTotalGoats(<?php echo $num?>)"> 
			<button> Recommend me a GOAT</button>
		</form>
	</div>

</body>
</html>