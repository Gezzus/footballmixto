<?php
include("connect.php");
session_start();
include("header.html");
include("menumanager.php");
?>

<html>
<body style="background-color:#95A3B3">

<div class="row">
	<div class=col-2 style="background-color: #4A8FE7;height: 100%">
		<div class="row" style="border:1px solid;border-color:#5D2E8C;border-radius:5px;background-color:white;width:100%;padding:2%;padding-top:0;margin:2%;">
		    <h5 style="width: 95%;padding-top:15px">Avafutbol | Menu</h5>
		<button style="width: 5%;height:2%;float:right;background-color:white;border:none;padding-top:2%;margin-top:2%";><</button>
		</div>
		<hr style="padding:0px;margin:0px">
		<div class="row" style="border:1px solid;border-color:#5D2E8C;border-radius:5px;margin:10px;background-color:white;width:100%;padding:2%;margin:2%;">
		<ul style="width:100%;list-style-type:none">
			<li>><a style="border-width:1px;border-color:black;border-radius:5px;color:black" href="index.php"> News</a></li>
			<hr style="padding:0px;margin:0px">
			<li>><a style="border-width:1px;border-color:black;border-radius:5px;color:black" href="login.php"> Login</a></li>
			<hr style="padding:0px;margin:0px">
			<li>><a style="border-width:1px;border-color:black;border-radius:5px;color:black" href="register.php"> Register</a></li>
			<hr style="padding:0px;margin:0px">
			<li>><a style="border-width:1px;border-color:black;border-radius:5px;color:black" href="about.php"> About</a></li>
			<hr style="padding:0px;margin:0px">
			<li>><a style="border-width:1px;border-color:black;border-radius:5px;color:black" href="events.php"> Events</a></li>
		</ul>

		</div>
	</div>

		<div class=col>
		 	<div class="row" style="width:100%;padding-top:1%;padding-left:1%;">
                  <div class="col" style="height:90%;border:1px solid;border-color:#5D2E8C;border-radius:5px;margin:10px;background-color:white">
                  <h5>News: </h5>
                  <hr style="margin:0px">
                      <div class="row">
                        
                      </div>
             	  </div>	
            
                  <div class="col-2" style="height:90%;border:1px solid;border-color:#5D2E8C;border-radius:5px;margin:10px;background-color:white">
                  <h5> Content: </h5>
                  <hr style="margin:0px">
                      <div class="row">
                        ASDASD
                      </div>
             	  </div>	
            </div>
    
		</div> <!-- Col Div -->
</div><!-- Row Div -->

</body>
</html>
