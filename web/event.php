
<?php
include("src/connect.php");
session_start();
include("header.html");
include("src/menumanager.php");
include("src/game.php");
?>

<?php 
  $event = new game();
  $event->retrieve($_GET['id'],$link);
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
      <a href="" class="top" >Options</a>
      </div>
      </div>


		 	<div class="row">
                  <div class="col content">
                  <h5>Event information: <?=$event->properties['type_desc'];?> Fútbol Match</h5>
                  <hr class="content">

                  	  <div class="row" style="margin:0px;width:25%;">
                        <ul class="list-group" style="">
            						  <li>When:<?=$event->properties['date']?></li>
            						  <li>Where: Placeholder</li>
            						  <li>Organizer: Placeholder</li>
            						</ul>
                  	  </div>

              <div class="row">
                      
        						<div class="col team">
        							<h6>Team 1</h6>
        							<hr class="content">
          							<div class="row team" style="background: lightblue">
          								<label>Person1</label>
          							</div>


        						</div>
                    <div class="col team">
                      <h6>Team 2</h6>
                      <hr class="content">
                        <div class="row team" style="background: lightblue">
                          <label>Person1</label>
                        </div>


                    </div>
                            
  						
              </div>

              </div>	
             	<div class="col-3 content">
             	  	<h5>Add an outsider:</h5>
             	  	<form>
             	  		<label>Name:</label>
             	  		<input class="content" type="text" placeholder="Your friend's name"></input>
             	  		<label>Sex:</label>
             	  		<select class="content" name="sex">
                                <option>Male</option>
                                <option>Female</option>
                    </select><br>
                    <button class="content" type="submit">Submit</button>
             	  	</form>
             	  	</div>

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

</body>
</html>

<?php

function displayEvent($id)
{
	echo $id;
}

#"
?>