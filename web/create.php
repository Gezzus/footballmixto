<?php
include("src/connect.php");
session_start();

  if(!isset($_SESSION["id"]))
  {
    header("location:index.php");
  }

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

	<? include("menubar.php"); ?>

		<div class="col">
			<? include("topbar.php"); ?>

		 	<div class="row" style="padding-bottom: 0;margin-bottom:0">
                  <div class="col-3 content">
                  	<h5>Create event: </h5>
                  	<hr class="content">
                      <div class="row"  style="padding:1%">
                        <form style="" method="POST" action="../src/addgame.php">

                        	<label class="content">Type: </label><br>
                        	<select style="width:60%" class="content" name="type">
                        		<option value='2'>5 vs 5 (2 Fields)</option>
                        		<option value='1'>5 vs 5 (1 Field)</option>
                        		<option value='3'>8 vs 8</option>
                        		<option value='4'>9 vs 9</option>
                        		<option value='5'>Social Event</option>
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
                            <label class="content">Integrations: </label><br>
                            <label class="content">DoodleUrl: </label><br><input name="doodleurl" class="content">
                            <hr>
                        	<button class="content team">Add</button>
                        </form>	
                      </div>


             	  </div>	
            
                  
             	  	  
            </div>
            <div class="row">
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

