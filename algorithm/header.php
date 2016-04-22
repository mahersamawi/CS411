<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="nl" lang="nl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="A short description." />
    <meta name="keywords" content="put, keywords, here" />
    <title>Goat Calculator</title>
    <link rel="stylesheet" href="forum.css" type="text/css">
    
    
</head>
<body>
	<div class = "banner-wrapper">
	<div class="banner">
			 <a href="http://goatcalculator.web.engr.illinois.edu/"> <h2>GOAT Calculator</h2> </a>
			
		</div>
		<?php
		if(isset($_SESSION['user_name']))
		{
	      	
	      	echo '<div class="logged_in" >';
		echo 'Hello, ' . $_SESSION['user_name'] . '';	 
      	 	
      	 	echo'<form action = "../profile.php" method ="GET" id ="form1"> 
	      	<button type="submit1" form="form1">Profile</button>
		</form>
	      	<form action = "../logout.php" method ="GET" id ="form2"> 
	      	<button type="submit2" form="form2">Logout </button>
		</form>
	      </div>';
	      
	        }
	        else
	        {
	    
	       echo'<div class="name_pass" >
	       
	        <form action = "../signin.php" method ="POST" id ="form1">
	            <p> Log in or Create an account</p>
	            Username: <input type="text"name="user_name"><br>
	            Password: <input type="password" name="user_pass"><br>
	       </form>
	      	<button type="submit1" form="form1" value="Submit">Login</button>
	      	<form action = "../signup.php" method ="GET" id ="form2"> 
	      	<button type="submit2" form="form2">Sign Up </button>
		</form>
	      </div>';
	      }
	      ?>
	      </div>

    <div id="wrapper">
    <div id="menu">
        <a class="item" href="/forum_index.php">Forums</a> -
        <a class="item" href="/create_topic.php">Create a thread</a> -
        <a class="item" href="/create_cat.php">Create a category</a>
         
	
        <div id="content">