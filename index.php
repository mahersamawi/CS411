<?php session_start(); ?>
<html>
<head>
	<title> Goatcalculator.com</title>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<link rel = "stylesheet" href = "bootstrap.min.css">
	
</head>
<style type="text/css">
    body{
        background-color: #C0C0C0;
    }
     div.name_pass{
     	float: right;
        color: black;
        text-align:right;
        padding-right: 1%;
     
     }
      div.logged_in{
        color: black;
        position: absolute;
        top: 0.0%;
        right: 4%;
        text-align:right;
        padding-right: 0%;
     
     }
     #menu {
    float: left;
    border: 1px solid #000;
    border-bottom: none;        /* avoid a double border */
    clear: both;                /* clear:both makes sure the content div doesn't float next to this one but stays under it */
    /*width:100%;*/
    height:20px;
   /* padding: 0 30px;*/
    background-color: white;
    color: black;
    text-align: left;
    font-size: 85%;
}
#menu a:hover {
    background-color: white;
}
 
     input[type = search]{
        //position: absolute;
        width: 100%;
        height: 65;
        //top: 30%;
        //left: 50%; 
        //margin-left: -250px;
        box-sizing: border-box;
        border: 5px solid orange;
        border-radius: 10px;
        font-size: 24px;
        background-color: white;
        background-image: url('searchicon.png');
        background-position: 102px 102px; 
        background-repeat: no-repeat;
        padding: 12px 20px 12px 10px;
     }
     button[type="submit1"]{
     	float: right;
     }
     button[type="submit2"]{
     	float: right;
    }
    button[type="submit3"]{
        background-color: white;
       border-radius: 16px;
       font-size:22;  
     }
    div.banner{
	overflow: auto;
    	color:red;
    	width: 90%;
    	margin: 0 auto;

    }
    .banner-wrapper {
    	background-color: orange;
    	height: 142px;
    	overflow: auto;
    }
    .title-banner {
    	margin-top: 150px;
    }
    p1 {
    	width: 100%;
    	margin: 0 auto;
        color:black;
        text-align: left;
        font-size:25px;
	padding-left:10%;
    }
    #jordan_pic{
       margin: 0 auto;
       width: 200px
    }
    #james_pic{
        margin: 0 auto;
        width: 300px;
    }
    table, th, td {
        border: 1px solid black;
    }
   
    table.input{
    	font-size:18;
    	border: 5px solid orange;
    	//position:fixed;
   	//top:50%;
   	//left:40%
    
    }
}


</style>
<script type="text/javascript">
function findTotal(){
   var a = parseInt(document.getElementById("qty1").value);
   var b = parseInt(document.getElementById("qty2").value);
   var c = parseInt(document.getElementById("qty3").value);
   var d = parseInt(document.getElementById("qty4").value);
   var e = parseInt(document.getElementById("qty5").value);
   if((a+b+c+d+e) > 100 || (a+b+c+d+e) == 0 || (a+b+c+d+e) != 100){
   	alert("Total Value must be equal to 100!");
   	return false;
   	}
}

    </script>

<body>
	<div class = "banner-wrapper">
	<div class = "banner">
		<a href= "http://goatcalculator.web.engr.illinois.edu/"style="text-decoration: none; color:red; font-weight:bold; float: left;"> <h2>GOAT Calculator</h2> </a>
		<?php
		if(isset($_SESSION['user_name']))
		{
	      	
	      	echo '<div class="logged_in" >';
		echo 'Hello, ' . $_SESSION['user_name'] . '';	 
      	 	
      	 	echo'<form action = "profile.php" method ="GET" id ="form1"> 
	      	<button type="submit1" form="form1">Profile</button>
		</form>
	      	<form action = "logout.php" method ="GET" id ="form2"> 
	      	<button type="submit2" form="form2">Logout </button>
		</form>
	      </div>';
	      
	        }
	        else
	        {
	    
	       echo'<div class="name_pass" >
	       
	        <form action = "signin.php" method ="POST" id ="form1">
	            <p> Log in or Create an account</p>
	            Username: <input type="text"name="user_name"><br>
	            Password: <input type="password" name="user_pass"><br>
	       </form>
	      	<button type="submit1" form="form1" value="Submit">Login</button>
	      	<form action = "signup.php" method ="GET" id ="form2"> 
	      	<button type="submit2" form="form2">Sign Up </button>
		</form>
	      </div>';
	      }
	      ?>
	      <div id="menu">
        <a class="item" href="/forum_index.php">Forums (Click here to access the forums of your favorite player)</a>
    
		</div>	
		
	      </div>
      
      </div> 
      
      
    <div class = "row title-banner">
     
     <div class = "col-lg-4">
    	<div id ="james_pic">
        	<img src="images/lebron_james.jpg" height="300px" width="300px">
    	</div>
    </div>
    <div class = "col-lg-4">
    <div id="search">
	<p1>Find your favorite NBA player!</p1>        
	<form action = "./temp.php" method="GET">
            <form><input type = "search" name ="search" placeholder = "Search for a player"/></form>
        </form>
        
        
        <div style = " width: 347px; margin: 0 auto;"> 
	    	<table class="input">
		  	<tr>
		      		  <td>Scoring</td>
	      	  		  <td>Shooting</td>      
	        		  <td>Team</td>
	        		  <td>Defense</td>
	        		  <td>Longevity</td>
	  		</tr>
			<tr>
	   			 <form action = "./algorithm/goat.php" method ="GET" id ="form5" onsubmit="return findTotal()">
	      				  <td ><input type="number"id="qty1"name="scoring"min="0" max="100" required></td>
	        			  <td ><input type="number"id="qty2"name="shooting" min="0" max="100" required></td>     
	        			  <td ><input type="number"id="qty3"name="team" min="0" max="100" required></td>
	       				  <td ><input type="number"id="qty4"name="defense" min="0" max="100" required></td>
	             			  <td ><input type="number"id="qty5"name="longevity" min="0" max="100" required></td>
	    			 </form>
	    		</tr>
	    		<tr>
	    			<td colspan="100%" align="center"><button type="submit3" form="form5" value="Submit" style="width:100%" >Find your GOAT</button></td>
	    		</tr>
	    		
	    	</table>
	    </div>
	    <p>Enter weights that correspond to the stats that you most value (Note: values must add up to 100). Then click the "Find your Goat" button</p>
      </div>
      </div>
    
    <div class = "col-lg-4">
    <div id="jordan_pic" width = "200px">
        <img src="images/jordan_black_white.jpg" height = "300" width= "200">
    </div>
    </div>
    
     
    </div>
    
    <script type="text/javascript" src = "bootstrap.min.js">
    
</body>
</html>