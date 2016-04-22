<?php session_start(); ?>
<html>
<style type="text/css">
    body{
        background-color: #C0C0C0;
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
        color: black;
        position: absolute;
        top: 0.5%;
        right: 4%;
        text-align:right;
        padding-right: 1%;
     
     }
    div.search_message{
    	font-size:16;
    	padding-left:15%;
    }
    button[type="submit1"]{
     	position:absolute;
     	top:85%;
     	right:45%;
     	padding-right: 1%;
     	color:black;
     }
     button[type="submit2"]{
     	position:absolute;
     	top:85%;
     	right:5%;
     	padding-right: 1%;
     	color:black;
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
    div.result_message{
    	position:relative;
    	text-align: center;
    	top:20%;
    	left: 0.1%;
    	right:5%;
    	font-size:35;
    }

</style>
<body>
	<div class="banner">
		<p> <a href= "http://goatcalculator.web.engr.illinois.edu/"style="text-decoration: none; color:red; font-size:55; font-weight:bold;"> GOAT Calculator </a>				  		  </p>
	</div>
	<?php
	if(isset($_SESSION['user_name'])){
	$name=$_SESSION['user_name'];
      	?>
      	<div class="logged_in" >
       	 <p> Logged in as: <?php echo $_SESSION['user_name'];?></p>
       	 <form action = "../profile.php" method ="GET" id ="form1"> 
      		<button type="submit1" form="form1">Profile</button>
	</form>
      	<form action = "../logout.php" method ="GET" id ="form2"> 
      	<button type="submit2" form="form2">Logout </button>
	</form>
      </div>
      <?php
        }
        else{
    	?>
       <div class="name_pass" >
       
        <form action = "../login_test.php" method ="POST" id ="form1">
            <p> Log in or Create an account</p>
            Username: <input type="text"name="username"><br>
            Password: <input type="password" name="password"><br>
       </form>
      	<button type="submit1" form="form1" value="Submit">Login</button>
      	<form action = "signup.php" method ="GET" id ="form2"> 
      	<button type="submit2" form="form2">Sign Up </button>
	</form>
      </div>
      <?php } 
      ?>
	
	
<?php

$max=1000;
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'goatcalc_admin');
define('DB_PASSWORD', 'admin123');
define('DB_DATABASE', 'goatcalc_main');
$db=mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
$query = "select DISTINCT goat_name from GoatHistory WHERE Username = '$name' ";

$result=mysqli_query($db,$query);
$num_temp=mysqli_num_rows($result);
$num = floor($num_temp / 2);
$num = $num + ($num_temp % 2);

$query2 = " select * from
(select Goats.Un, Scoring.sscore from
(select Distinct A.un, B.name from 
( Select U.user_name as Un, U.First_name as Fn
 From users U) as A
Inner Join
( Select GH.Username as GUn, GH.Goat_score as GS, GH.goat_name as name
 From GoatHistory GH
 where GH.Username='$name') as B
on A.Un=B.GUn) as Goats
inner join
Scoring
on Goats.name=Scoring.player
order by sscore desc
limit $num, 1) as Scoring

natural join

(select Goats.Un, Shooting.shscore from
(select Distinct A.un, B.name from 
( Select U.user_name as Un, U.First_name as Fn
 From users U) as A
Inner Join
( Select GH.Username as GUn, GH.Goat_score as GS, GH.goat_name as name
 From GoatHistory GH
 where GH.Username='$name') as B
on A.Un=B.GUn) as Goats
inner join
Shooting
on Goats.name=Shooting.player
order by shscore desc
limit $num, 1) as Shooting

natural join

(select Goats.Un, Team.tscore from
(select Distinct A.un, B.name from 
( Select U.user_name as Un, U.First_name as Fn
 From users U) as A
Inner Join
( Select GH.Username as GUn, GH.Goat_score as GS, GH.goat_name as name
 From GoatHistory GH
 where GH.Username='$name') as B
on A.Un=B.GUn) as Goats
inner join
Team
on Goats.name=Team.player
order by tscore desc
limit $num, 1) as Team

natural join

(select Goats.Un, Defense.dscore from
(select Distinct A.un, B.name from 
( Select U.user_name as Un, U.First_name as Fn
 From users U) as A
Inner Join
( Select GH.Username as GUn, GH.Goat_score as GS, GH.goat_name as name
 From GoatHistory GH
 where GH.Username='$name') as B
on A.Un=B.GUn) as Goats
inner join
Defense
on Goats.name=Defense.player
order by dscore desc
limit $num, 1) as Defense

natural join

(select Goats.Un, Longevity.lscore from
(select Distinct A.un, B.name from 
( Select U.user_name as Un, U.First_name as Fn
 From users U) as A
Inner Join
( Select GH.Username as GUn, GH.Goat_score as GS, GH.goat_name as name
 From GoatHistory GH
 where GH.Username='$name') as B
on A.Un=B.GUn) as Goats
inner join
Longevity
on Goats.name=Longevity.player
order by lscore desc
limit $num, 1) as Longevity  ";

$result2=mysqli_query($db,$query2);
$num2=mysqli_num_rows($result);
echo mysqli_error($db);

$row2 = mysqli_fetch_assoc($result2);
$med_sscore = $row2['sscore'];
$med_shscore =  $row2['SHscore'];
$med_tscore =  $row2['tscore'];
$med_dscore =  $row2['dscore'];
$med_lscore =  $row2['lscore'];

$m_l= mysqli_fetch_assoc(mysqli_query($db, "select max(lscore) as m from Longevity"))['m'];
$m_s= mysqli_fetch_assoc(mysqli_query($db, "select max(sscore) as m from Scoring"))['m'];
$m_sh= mysqli_fetch_assoc(mysqli_query($db, "select max(shscore) as m from Shooting"))['m'];
$m_t= mysqli_fetch_assoc(mysqli_query($db, "select max(tscore) as m from Team"))['m'];
$m_d= mysqli_fetch_assoc(mysqli_query($db, "select max(dscore) as m from Defense"))['m'];

$range1 = .7; # 0.7 original
$range2 = 1.3; # 1.3 original

$query3 = "select * FROM (select *, (s_similar+sh_similar+t_similar+d_similar+l_similar) as total_similar from 
(select player as p, abs(sscore - $med_sscore)/ $m_s as s_similar from Scoring
where sscore >= ($med_sscore * $range1) and sscore <= ($med_sscore * $range2)) as S

natural join

(select player as p, abs(shscore - $med_shscore)/$m_sh as sh_similar from Shooting
where shscore >= ($med_shscore * $range1) and shscore <= ($med_shscore * $range2) )as SH

natural join

(select player as p, abs(tscore - $med_tscore)/$m_t as t_similar from Team
where tscore >= ($med_tscore * $range1) and tscore <= ($med_tscore * $range2))as T

natural join

(select player as p, abs(dscore - $med_dscore)/$m_d as d_similar from Defense
where dscore >= ($med_dscore * $range1) and dscore <= ($med_dscore * $range2) )as D

natural join

(select player as p, abs(lscore - $med_lscore)/$m_l as l_similar from Longevity
where lscore >= ($med_lscore * $range1) and lscore <= ($med_lscore * $range2)  )as L

order by total_similar Limit 10) as A 

NATURAL JOIN (

SELECT goat_name as p ,sum(c+1) as count  from ( select Preference1, Preference2 
	FROM `users` 
	WHERE user_name = '$name') as a 
	natural join users 
	inner join
	GoatHistory 
	on user_name = GoatHistory.Username 
	where user_name <> '$name'
	GROUP BY goat_name ) AS B 
	ORDER BY count DESC";



$result3=mysqli_query($db,$query3);
$num3=mysqli_num_rows($result3);
echo mysqli_error($db);
$query_backup = "select * FROM (select *, (s_similar+sh_similar+t_similar+d_similar+l_similar) as total_similar from 
(select player as p, abs(sscore - $med_sscore)/ $m_s as s_similar from Scoring
where sscore >= ($med_sscore * $range1) and sscore <= ($med_sscore * $range2)) as S

natural join

(select player as p, abs(shscore - $med_shscore)/$m_sh as sh_similar from Shooting
where shscore >= ($med_shscore * $range1) and shscore <= ($med_shscore * $range2) )as SH

natural join

(select player as p, abs(tscore - $med_tscore)/$m_t as t_similar from Team
where tscore >= ($med_tscore * $range1) and tscore <= ($med_tscore * $range2))as T

natural join

(select player as p, abs(dscore - $med_dscore)/$m_d as d_similar from Defense
where dscore >= ($med_dscore * $range1) and dscore <= ($med_dscore * $range2) )as D

natural join

(select player as p, abs(lscore - $med_lscore)/$m_l as l_similar from Longevity
where lscore >= ($med_lscore * $range1) and lscore <= ($med_lscore * $range2)  )as L

order by total_similar Limit 5) as A";

$result_backup=mysqli_query($db,$query_backup);
$num4=mysqli_num_rows($result_backup);
#echo mysqli_error($db);


$query_forum = "SELECT goat_name as p ,sum(c+1) as count  from ( select Preference1, Preference2 
	FROM `users` 
	WHERE user_name = '$name') as a 
	natural join users 
	inner join
	GoatHistory 
	on user_name = GoatHistory.Username 
	where user_name <> '$name'
	GROUP BY goat_name 
	ORDER BY count DESC";
$result_forum=mysqli_query($db,$query_forum);
$num5=mysqli_num_rows($result_forum);
$total_count=0;
$count=0;
$player = array();	
#echo mysqli_error($db);
#echo $num3;
#echo $num4;
#echo $num5;
#echo "test";
?>
<div class = "result_message">
	<p> Based on your previous GOATS and the preferences of your forum. <br> These GOATS should interest you <a target="_blank" style="color:red;"> <br> 
	<?php while($row=mysqli_fetch_assoc($result3 )){
		if($total_count<5){
		echo $row['p']." "; $players[$row['p']] = 1; 
		$total_count+=1;?> <br> <?php;
			}}?> 
	<?php while($row=mysqli_fetch_assoc($result_backup)){
		if($players[$row['p']] !=1&& $total_count<5){
			echo $row['p']." ";
			$players[$row['p']] = 1;
			$total_count+=1;
			?> <br> <?php
			};
			}?>
	<?php while($row=mysqli_fetch_assoc($result_forum)){
		if($players[$row['p']] !=1 && $count<2 && $total_count<5){
			echo $row['p']." ";
			$count+=1;
			$total_count+=1;
			?> <br> <?php
			};
			}?>		 <br></a> </p>
</div>

</body>
</html>