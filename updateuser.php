<?php session_start(); ?>
<html>
<style type="text/css">
    body{
        background-color: #C0C0C0;
    }
    div.banner{
    	background-color: orange;
    	width: 90%;
        height: 15%;
    	color:red;
    	font-size:14;
    	padding-left:10%;
    	padding-top:0.5%;
    }
    div.form{
    	position:absolute;
    	top:25%;
    	left:45%;
    	color:red;
    	font-size:20;
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
    button[type="submit1"]{
     	position:absolute;
     	top:85%;
     	right:45%;
     	padding-right: 2%;
     	color:black;
     }
     button[type="submit2"]{
     	position:absolute;
     	top:85%;
     	right:13%;
     	padding-right: 2%;
     	color:black;
    }
    div.title{
    	position:absolute;
    	top:18%;
    	left:40%;
    	color:red;
    	font-size:30;
    }

  
</style>



<body>
	<?php
	if(isset($_SESSION['user_name'])){
      	?>
      	<div class="logged_in" >
       	 <p> Logged in as: <?php echo $_SESSION['user_name'];?></p>
       	 <form action = "profile.php" method ="GET" id ="form1"> 
      		<button type="submit1" form="form1">Profile</button>
	</form>
      	<form action = "logout.php" method ="GET" id ="form2"> 
      		<button type="submit2" form="form2">Logout </button>
	</form>
	
      </div>
     <?php
        }
        else{
    	?>
       <div class="name_pass" >
       
        <form action = "login_test.php" method ="POST" id ="form1">
            <p> Log in or Create an account</p>
            Username: <input type="text"name="username"><br>
            Password: <input type="password" name="password"><br>
       </form>
      	<button type="submit1" form="form1" value="Submit">Login</button>
      	<form action = "signup.php" method ="GET" id ="form2"> 
      	<button type="submit2" form="form2">Sign Up </button>
       </form>
      </div>
      <?php
       } 
      ?>
      </form>
	<div class="banner">
		<p> <a href="http://goatcalculator.web.engr.illinois.edu/"style="text-decoration: none; color:red; font-size:65; font-weight:bold;"> GOAT Calculator </a></p>
	</div>
	<div class = "title">
		<p3>Update Profile for <?php echo $_SESSION['user_name'];?> </p3>
	</div>
	<div class="form">
		<form action="update.php" method ="POST">
  	 		First name:<br>
	 		<input type="text" name="firstname">
			<br>
	  		Last name:<br>
	  		<input type="text" name="lastname">
	  		<br>
	  		Favorite Player:<br>
	  		<input type = "text" name="favorite">
	  		<br><br>
	  		<input type="submit" value="Submit">
		</form> 
		
		


	</div>
</body>
</html>