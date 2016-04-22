<?php
include 'connect.php';
include 'header.php';
?>
      </form>
	<div class="search_message">
		<h2> Searching for <span style="color:red;font-weight:bold"> 
				<?php print $_GET["search"];?> </span>
		</h2> 
		<br>
		<h3> The results 
	</div>
	<div id="search">
        <form action = "./temp.php" method="GET">
            <form><input type = "search" name ="search" placeholder = "Search for a player"/></form>
        </form>
      </div>


<?php
$max=1000;
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'goatcalc_admin');
define('DB_PASSWORD', 'admin123');
define('DB_DATABASE', 'goatcalc_main');
$name=$_GET["search"];
$db=mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
#print $name;
#print "<br/>";
$query = "SELECT * FROM Basketball_Players WHERE Games>0 and (Player like '%$name%_%' OR Player like '%_%$name%' OR Player like '%$name%') ORDER BY Player";
#print $query;
#print "<br/>";
$result=mysqli_query($db,$query);
$num=mysqli_num_rows($result);



if($num == 1)
{
	//$DATA = $mysql
	$DATA = mysqli_fetch_assoc($result);
	$PLAYER = $DATA['Player'];
	mysqli_data_seek($result , 0);
	
	$NEWQUERY = 
		"SELECT cat_name 
    		FROM categories 
    		WHERE cat_name='$PLAYER'";
    	$NEWRESULT = mysql_query($NEWQUERY);
    	if( mysql_num_rows($NEWRESULT) == 0)
    	{
    	
    		
    		$CATEGORY_NAME = "For fans of " . $PLAYER . ".";
//    		echo $CATEGORY_NAME;
		$INSERTION = 
			"INSERT INTO 
				categories (cat_name, cat_description)
			VALUES('" . mysql_real_escape_string($PLAYER) . "',
			       '" . mysql_real_escape_string($CATEGORY_NAME) . "'
			)";  
		$R = mysql_query($INSERTION);
//		echo mysql_error();  	
	}
}



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
    <th> Information</th>
  </thead>
<?php
 if($num<=$max){
    $i=1;//new line
    while($row = mysqli_fetch_assoc($result)){
?>

 <tr>
      <td><?php echo $row['Player']; ?> </td>
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
?>

</table>

</body>
</html>