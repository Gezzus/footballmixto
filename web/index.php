<?php
include("src/connect.php");
session_start();
include("header.html");
include("src/menumanager.php");
include("src/events.php");
include("src/game.php");
?>


<?php
	$Events = new events($link);

	function organizeEvents($receivedEvents)
	{
		for ($i=0; $i < count($receivedEvents); $i++) { 
			echo "<div class='col-5' style='border:1px solid;border-color:#5D2E8C;border-radius:5px;background-color:white;padding:2%;margin:2%;'
><p>Date: ".$receivedEvents[$i]->date."<br>Type: ".$receivedEvents[$i]->properties['type_desc']."</p><a href='event.php?id=".$receivedEvents[$i]->id."'><input type='button' style='background-color:white;border:1px solid;border-color: #5D2E8C;border-radius: 3px;' value='See Event'/></a>
      </div>";
		}
		//echo var_dump($receivedEvents);

	}



?>

<html>
<body style="background-color:#E8E8E8">
<div class="container-fluid">

<div class="row">




	<div class="col-2" style="background-color: #313131;height:100%">
		<hr style="padding:0px;margin:0px;border-top:1px solid rgba(255, 255, 255, 0.1)">
		<div class="col" style="width:100%;padding:1%;margin:2%;">
			<div class="row" style="border:1px solid;border-color:#5D2E8C;border-radius:5px;margin:10px;background-color:#E8E8E8;width:90%;padding:2%;margin:2%;">
				<a style="" href="index.php">Events</a>
			</div>
			<?php if(active_session() == 0){ ?>
			<div class="row" style="border:1px solid;border-color:#5D2E8C;border-radius:5px;margin:10px;background-color:#E8E8E8;width:90%;padding:2%;margin:2%;">
				<a style="" href="login.php">Login</a>
			</div>
			<div class="row" style="border:1px solid;border-color:#5D2E8C;border-radius:5px;margin:10px;background-color:#E8E8E8;width:90%;padding:2%;margin:2%;">
				<a style="" href="register.php">Register</a>
			</div>
			<?php } else{ ?>
				<div class="row" style="border:1px solid;border-color:#5D2E8C;border-radius:5px;margin:10px;background-color:#E8E8E8;width:90%;padding:2%;margin:2%;">
				<a style="" href="src/logout.php">Logout</a>
				</div>
			<?php } ?>

		</div>
	
		
	</div> <!-- Header div -->
		<div class="col">
			<div class="row"">
			<div class="col" style="height:4%;width:100%;background-color:white">
			<a href="event/create" style="float:right;margin-top:1%;font-size: 70%" >Add new</a>
			</div>
			</div>
		 	<div class="row">
                  <div class="col" style="border:1px solid;border-color:#5D2E8C;border-radius:5px;margin:2%;padding:2%;background-color:white">
                  	<h5>Upcoming matches: </h5>
                  	<hr style="margin:0px;margin-bottom:10px">
                      <div class="row" style="padding-left:3.5%">
                        	<?= organizeEvents($Events->games); ?>
                      </div>


             	  </div>	
            
                  <div class="col-2" style="height:20%;border:1px solid;border-color:#5D2E8C;border-radius:5px;margin:2%;padding:2%;background-color:white">
                  <h5> About: </h5>
                  <hr style="margin:0px;margin-bottom:5%">
                    	
             	  </div>
             	  	  
            </div>
            <div class="row">
            	<div class="col" style="position:absolute;bottom:0;margin:0;" >
            		<footer class="footer" style="background-color:#E8E8E8;height:1%;";>
					<div style=""><p style="font-size:80%;">Made with ♥ by a bunch of people from Avature</p></div>
					</footer> 
            	</div>
            </div>

    		
    	
		</div> <!-- Col Div -->
			
</div><!-- Row Div -->

</div>

	

</body>

</html>

