<?php
include("src/connect.php");
session_start();
include("header.html");
include("src/menumanager.php");
include("src/events.php");
?>

<html>
<body style="background-color:#E8E8E8">
<div class="container-fluid">
<div class="row">
	<div class="col-2" style="background-color: #313131;height: 100%">
		<div class="row" style="border:1px solid;border-color:#5D2E8C;border-radius:5px;background-color:white;width:95%;padding:3%;padding-top:0%;margin:4%;">
		    <h5 style="width: 90%;padding-top:15px">Avafutbol | Menu</h5>
		<button style="width: 5%;height:2%;float:right;background-color:white;border:none;padding-top:2%;margin-top:2%";></button>
		</div>
		<hr style="padding:0px;margin:0px;border-top:1px solid rgba(255, 255, 255, 0.1)">
		<div class="col" style="width:100%;padding:2%;margin:2%;">
			<div class="row" style="border:1px solid;border-color:#5D2E8C;border-radius:5px;margin:10px;background-color:white;width:90%;padding:2%;margin:2%;">
				<a style="" href="index.php">News</a></li>
			</div>
			<div class="row" style="border:1px solid;border-color:#5D2E8C;border-radius:5px;margin:10px;background-color:white;width:90%;padding:2%;margin:2%;">
				<a style="" href="login.php">Login</a></li>
			</div>
			<div class="row" style="border:1px solid;border-color:#5D2E8C;border-radius:5px;margin:10px;background-color:white;width:90%;padding:2%;margin:2%;">
				<a style="" href="register.php">Register</a></li>
			</div>
		</div>
	</div>

		<div class=col>
		 	<div class="row" style="width:100%;padding-top:1%;padding-left:1%;">
                  <div class="col" style="height:90%;border:1px solid;border-color:#5D2E8C;border-radius:5px;margin:10px;background-color:white">
                  <br>
                  <h5>Upcoming matches: </h5>
                  <hr style="margin:0px;margin-bottom:10px">

                      <div class="row" style="padding-left:3.5%">
                        	<?= var_dump($Events->retrieve())  ?>
                      </div>

             	  </div>	
            
                  <div class="col-2" style="height:90%;border:1px solid;border-color:#5D2E8C;border-radius:5px;margin:10px;background-color:white">
                  <h5> Content: </h5>
                  <hr style="margin:0px">
                      	<div class="col" style="border:1px solid;border-color:#5D2E8C;border-radius:5px;margin:10px;background-color:white;width:100%;padding:2%;margin:2%;">
							

					  	</div><!-- Row-->
             	  </div>	
            </div>
    
		</div> <!-- Col Div -->
</div><!-- Row Div -->
</div>
</body>
</html>


<!--
<ul style="width:100%;list-style-type:none">
			<li><a style="border: 1px solid;border-color:black;border-radius:5px;color:black;width:100%" href="index.php"> News</a></li>
			
			<li><a style="border: 1px solid;border-color:black;border-radius:5px;color:black;width:100%" href="login.php"> Login</a></li>
			
			<li><a style="border: 1px solid;border-color:black;border-radius:5px;color:black;width:100%" href="register.php"> Register</a></li>
			
			<li><a style="border: 1px solid;border-color:black;border-radius:5px;color:black;width:100%" href="about.php"> About</a></li>
			
			<li><a style="border: 1px solid;border-color:black;border-radius:5px;color:black;width:100%" href="events.php"> Events</a></li>
		</ul>-->