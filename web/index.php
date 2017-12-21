<?php
include("src/connect.php");
session_start();
include("header.html");
include("src/game.php");

if(isset($_GET["error"]) && $_GET["error"] == 3){
    echo "<script type='text/javascript'>alert('Please log in');</script>";
}

 #$headers = apache_request_headers();
 #print_r($headers);
 
?>


<html>
<head>
 <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="container-fluid">

<div class="row">


<? include("menubar.php");?>

		<div class="col">
			<? include("topbar.php"); ?>
		 	<div class="row">
                  <div class="col-8 team content">
                  	<h5>Upcoming matches: </h5>
                  	<hr class="content">
                      <div class="row" style="padding-left:3.5%">
                        	<?= organize_games(0,9,$link); ?>
                      </div>

             	    </div>	
              	  	  
      </div>
     
      <? include("menufooter.php"); ?>
    	
		</div>

			
</div>

</div>

	

</body>

</html>

