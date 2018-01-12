<?php
include("src/connect.php");
session_start();
include("header.html");

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
                  <div class="col-8 team content" style="background-color: rgba(255, 255, 255, 0.6)">
                  	<h5>Tournaments</h5>
                  	<hr class="content">
                      <div class="row" style="padding-left:3.5%">
                        	
                      </div>

             	    </div>	
              	  	  
      </div>

     
     <br>
      <? include("menufooter.php"); ?>
    	
		</div>

			
</div>

</div>

	

</body>

</html>

