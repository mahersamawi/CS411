<?php

include '../connect.php';
include 'header.php';

$scoring=$_GET["scoring"];
$shooting=$_GET["shooting"];
$team=$_GET["team"];
$longevity=$_GET["longevity"];
$defense=$_GET["defense"];

$max=1000;
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'goatcalc_admin');
define('DB_PASSWORD', 'admin123');
define('DB_DATABASE', 'goatcalc_main');
$name='';
$db=mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
$m_l= mysqli_fetch_assoc(mysqli_query($db, "select max(lscore) as m from Longevity"))['m'];
$m_s= mysqli_fetch_assoc(mysqli_query($db, "select max(sscore) as m from Scoring"))['m'];
$m_sh= mysqli_fetch_assoc(mysqli_query($db, "select max(shscore) as m from Shooting"))['m'];
$m_t= mysqli_fetch_assoc(mysqli_query($db, "select max(tscore) as m from Team"))['m'];
$m_d= mysqli_fetch_assoc(mysqli_query($db, "select max(dscore) as m from Defense"))['m'];

$query = "SELECT Longevity.player,Longevity.lscore/$m_l as lscore, Scoring.sscore/$m_s as sscore, Shooting.shscore/$m_sh as SHscore, Team.tscore/$m_t as tscore, Defense.dscore/$m_d as dscore, $longevity/100*Longevity.lscore/$m_l + $shooting/100*Shooting.shscore/$m_sh + $scoring/100*Scoring.sscore/$m_s + $team/100*Team.tscore/$m_t + $defense/100*Defense.dscore/$m_d as GOAT_score 
FROM Longevity
	JOIN Scoring
		ON Longevity.player = Scoring.player
	JOIN Shooting
		ON Longevity.player = Shooting.player
	JOIN Team
		ON Longevity.player = Team.player
	JOIN Defense
		ON Longevity.player = Defense.player 
Order by GOAT_Score DESC Limit 5";
#print $query;
#print "<br/>";

$start = microtime(true);
$result=mysqli_query($db,$query);
$num=mysqli_num_rows($result);

$end= microtime(true);
$time= $end-$start




?>
<div class = "goats_results">
<table  class = "results" border="2" align="center" style="width:90%">
  <thead>
    <th>Player</th>
    <th>Scoring <?php echo ' ('.$scoring.'%)'; ?></th> 
    <th>Shooting <?php echo ' ('.$shooting.'%)'; ?></th>
    <th>Team <?php echo ' ('.$team.'%)'; ?></th>
    <th>Defense <?php echo ' ('.$defense.'%)'; ?></th>
    <th>Longevity <?php echo ' ('.$longevity.'%)'; ?></th>
    <th>Goat Score</th>
  </thead>
<?php
 if($num<=$max){
    $i=1;//new line
    while($row = mysqli_fetch_assoc($result)){
?>

 <tr>
      <td><a target="_blank" style="color:red;"href="https://en.wikipedia.org/wiki/<?php echo str_replace(' ', '_',$row['Player']); ?>"><?php echo $row['Player']; ?></a> </td>
      <td><?php echo number_format($row['sscore']*100,2,'.',''); ?></td>
      <td><?php echo number_format($row['SHscore']*100,2,'.',''); ?></td>
      <td><?php echo number_format($row['tscore']*100,2,'.',''); ?></td>
      <td><?php echo number_format($row['dscore']*100,2,'.',''); ?></td>
      <td><?php echo number_format($row['lscore']*100,2,'.',''); ?></td>
      <td><?php echo number_format($row['GOAT_score']*100,2,'.',''); ?></td>
<?php
	if($i==1){
   	$goat = $row['Player'];
   	$goat_score = number_format($row['GOAT_score']*100,2,'.','');
   	

   }
?>
      
      
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
</div>
<div class = "result_message">
	<p> The GOAT is <a target="_blank" style="color:red;"><?php echo $goat; ?> </a> </p>
	 <p> <font size="5"> Calculated in : <?php echo  number_format($time,2,'.','')?> sec. </font> <p>
	<p1> Based on your inputs of Scoring, Shooting, Team, Defense, and Longevity,<br>
		the best GOAT for you was <?php echo $goat; ?> with a GOAT Score of <br> 
		<a target="_blank" style="color:red; font-size:70;" ><?php echo $goat_score; ?> </a>  </p1>
		
</div>
<?php 
$username=$_SESSION['user_name'];
if(isset($_SESSION['user_name']))
{
   	$query = "INSERT INTO GoatHistory (`Username`, `goat_name`,`Scoring`,`Shooting`,`Team`,`Defense`,`Longevity`,`Goat_score`)
    		VALUES ('$username', '$goat', $scoring, $shooting, $team,$defense,$longevity, $goat_score) on DUPLICATE key update c=c+1";
	mysqli_query($db, $query);
	$query="Select query_count from users where user_name='$username'";
    	$count=mysqli_fetch_assoc(mysqli_query($db, $query))['query_count'];
	$query="UPDATE users SET query_count=query_count+1 WHERE user_name='$username'";
    	mysqli_query($db, $query);
    	if($count==4){
    		$query="select avg(scoring) as s,avg(shooting) as sh,avg(team) as t,avg(defense) as d,avg(longevity) as l from GoatHistory where Username='$username'";
		$result=mysqli_query($db, $query);
		$averages=mysqli_fetch_assoc($result);
		$stats=array(
		 "Scoring"=>$averages['s'],
		"Shooting"=>$averages['sh'],
		"Team"=> $averages['t'],
		"Defense"=> $averages['d'],
		"Longevity"=> $averages['l']);
		#var_dump($stats);
		arsort($stats);
		#var_dump($stats);
		$count=0;
		foreach($stats as $k => $v){
			
			if($count==0){
				$p1=$k;
			}
			if($count==1){
				$p2=$k;
			}
			$count+=1;
		}
		$query="UPDATE users SET Preference1='$p1',Preference2='$p2' WHERE user_name='$username'";
		$result=mysqli_query($db, $query);
		
    	}
    	
    	// echo $goat; --> scope works
    	$NEWQUERY = "SELECT cat_name 
    		FROM categories 
    		WHERE cat_name='$goat'";
    	$NEWRESULT = mysql_query($NEWQUERY);
    	if( mysql_num_rows($NEWRESULT) == 0)
    	{
    	
    		
    		$CATEGORY_NAME = "For fans of " . $goat . ".";
  //  		echo $CATEGORY_NAME;
    		//echo "<p>New forum must be created.</p>";
		$INSERTION = 
			"INSERT INTO 
				categories (cat_name, cat_description)
			VALUES('" . mysql_real_escape_string($goat) . "',
			       '" . mysql_real_escape_string($CATEGORY_NAME) . "'
			)";  
		$R = mysql_query($INSERTION);
//		echo mysql_error();  	
	}
    	
}
?>
</body>
</html>