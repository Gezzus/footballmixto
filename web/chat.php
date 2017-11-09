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

			</div>
			</div>

		 	<div class="row">
                  <div class="col-4 team content" style="">
                    Chatting with: {$user} #Todo
                    <div class="row">
                      <div class="col" style="height: 30%;background-color: #DDDDDD"></div>
                    </div>
                    <div class="row">
                      <div class="col" style="height: 10%;background-color: #CCCCCC"></div>
                      </div>
                    </div>
            
                  <div class="col-2 team content" style="margin-left: 0%!important">
                	   <h6>Users</h6>
                     {$user} List->Select #Todo
                      	
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

