<?php
include("src/connect.php");
session_start();
include("header.html");
include("src/menumanager.php");
include("src/events.php");
include("src/game.php");
?>


<?php
	$Events = new events;
	$Events->build($link);

	function organizeEvents($receivedEvents)
	{
		for ($i=0; $i < count($receivedEvents); $i++) { 
		echo "<div class='col-3' style='border:1px solid;border-color:#5D2E8C;border-radius:5px;background-color:white;padding:2%;margin:2%;'
><p>Date: ".$receivedEvents[$i]->date."<br>Type: ".$receivedEvents[$i]->properties['type_desc']."</p><a href='event.php?id=".$receivedEvents[$i]->id."'><input type='button' style='background-color:white;border:1px solid;border-color: #5D2E8C;border-radius: 3px;' value='See Event'/></a>
      </div>";
		}
		/*echo var_dump($receivedEvents);
		echo "<br><a class='menubutton' href=''>
					<button class='menubutton' style='width:20%'>See Event</button>
				</a><hr><br>";
	*/
	}



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
			<?php if(active_session() == 0){ ?>
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
			<a href="create.php" class="top" >Add new</a>
			</div>
			</div>
		 	<div class="row">
                  <div class="col-8 content">
                  	<h5>Upcoming matches: </h5>
                  	<hr class="content">
                      <div class="row" style="padding-left:3.5%">
                        	<?= organizeEvents($Events->games); ?>
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

