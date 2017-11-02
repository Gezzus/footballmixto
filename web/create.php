<?php
include("src/connect.php");
session_start();
include("header.html");

include("src/game.php");
?>

<html>
<head>
 <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="container-fluid">

<div class="row">
	<div class="col-2 menu">
		<hr class="menu">
			<div class="row">
				<a class="menubutton" href="index.php">
					<button class="menubutton">Events</button>
				</a>
			</div>
			<? if(active_session() == 0){ ?>
			<div class="row">
				<a class="menubutton" href="login.php">
					<button class="menubutton">Login</button>
				</a>
			</div>
			<div class="row">
				<a class="menubutton" href="register.php">
					<button class="menubutton">Register</button>
				</a>
			</div>
			<?php } else{ ?>
				<div class="row">
				<a class="menubutton" href="logout.php">
					<button class="menubutton">Logout</button>
				</a>
				</div>
			<?php } ?>

	
		
	</div> <!-- Menu div -->
		<div class="col">
			<div class="row"">
			<div class="col top">
			<a href="index.php" class="top" >Cancel</a>
			</div>
			</div>
		 	<div class="row" style="padding-bottom: 0;margin-bottom:0">
                  <div class="col-3 content">
                  	<h5>Create event: </h5>
                  	<hr class="content">
                      <div class="row" style="padding-left:3.5%">
                        <form style="width:90%" method="POST" action="src/addgame.php">
                        	<!--<label class="content">Event name: </label>
                        	<input class="content" type="text" name="name"><br>-->
                        	<label class="content">Type: </label>
                        	<select style="width:100%" class="content" name="type">
                        		<option value='1'>5 vs 5 (2 Fields)</option>
                        		<!--<option value='2'>5 vs 5 (1 Field)</option>
                        		<option value='3'>8 vs 8</option>
                        		<option value='4'>9 vs 9</option>
                        		<option value='4'>Gull</option>-->
                        	</select>
                        	<hr>
                        	<div class="row">
                        	<div class="col">
	                        	<label class="content">Date: </label>
	                        	<input class="content" type="date" name="date">
	                        </div>
	                        <div class="col">
	                        	<label class="">Time: </label>
	                        	<input class="content" type="time" name="time">
                        	</div>
                        	</div>
                        	<hr>
                        	<button style="padding-top:2%" class="content">Add</button>
                        </form>	
                      </div>


             	  </div>	
            
                  
             	  	  
            </div>
            <div class="row"  style="padding-top: 0;margin-top:0">
            	<div class="col-3 content" style="height:5%">
                	<center><h5>More stuff comming soon</h5></center>
                    	
             	  </div>
            </div>
            

            <div class="row">
            	<div class="col myfooter">
            		<footer class="myfooter">
						<p class="myfooter">Made with ♥ by a bunch of people from Avature</p>
					</footer> 
            	</div>
            </div>

    		
    	
		</div> <!-- Col Div -->
			
</div><!-- Row Div -->

</div>

	

</body>

</html>

