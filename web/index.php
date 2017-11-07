<?php
include("src/connect.php");
session_start();
include("header.html");
include("src/game.php");

if(isset($_GET["error"]) && $_GET["error"] == 3){
    echo "<script type='text/javascript'>alert('Please log in');</script>";
}

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
			<div class="row"">
			<div class="col top">
			<? if(active_session() == 1){ ?>
			<a href="create.php" class="top" >Add new</a>
			<? } ?>
			</div>
			</div>
		 	<div class="row">
                  <div class="col-8 team content">
                  	<h5>Upcoming matches: </h5>
                  	<hr class="content">
                      <div class="row" style="padding-left:3.5%">
                        	<?= organize_games($link); ?>
                      </div>


             	  </div>	
            
                  <div class="col-3">
                	
                    	
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

