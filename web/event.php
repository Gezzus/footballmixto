
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

  function displayPlayers($thisTeam,$event)
  {
    for ($i=0; $i < count($thisTeam["nickname"]); $i++) { 
    echo "<div class='row team' style='background: lightblue'>
          <div class='col-9'>
            <label>".$thisTeam["nickname"][$i]."</label>

          </div>
          <div class='col-3'>
            <form method='POST' action='src/operatory.php?action=teamchange&id=".$event->id."'>
              <input name='id' value=".$thisTeam["id"][$i]." hidden></input>

              <button class='content' name='team' value='5'>R</button>
            </form>
            
            </div>

          </div>";
    }
  }

  

  if(active_session() == 1){
    $self_player_retrieve = "SELECT playerId,player.nickName FROM user
LEFT JOIN player ON user.playerId = player.id where user.id='".$_SESSION['id']."'";
    $self_player_retrieve_query = mysqli_query($link,$self_player_retrieve);
    $self_player_retrieve_row = mysqli_fetch_assoc($self_player_retrieve_query);
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

      <div class="row top"">
      <div class="col">

      
        <?php if(active_session() == 1){ ?>
        <form method="POST" action="src/add.php">
          <button class="content"  style="margin:0.5%" type="submit">Join event</button>
          <input name="gameId" hidden value=<?="'".$_GET["id"]."'"?>></input>
          <input class="content" type="text" name="nickname" value=<?=$self_player_retrieve_row['nickName'] ?> hidden></input>
        </form>
        <?php } ?>

      </div>
      </div>


		 	<div class="row">
                  <div class="col content">
                            <h5>Event information: <?=$event->properties['type_desc'];?> Fútbol Match</h5>
                            <hr class="content">

                            	  <div class="row" style="margin:-4px;width:30%;">
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
                                    <?php
                                    $thisTeam = $event->retrieve_team($_GET["id"],1);
                                    if(count($thisTeam["nickname"]) > 0){
                                        
                                          displayPlayers($thisTeam,$event);
                                        }
                                    ?>
                    						</div>

                              <div class="col team">
                                <h6>Team 2</h6>
                                <hr class="content">
                                  <?php
                                    $thisTeam = $event->retrieve_team($_GET["id"],2);
                                    if(count($thisTeam["nickname"]) > 0){
                                        
                                          displayPlayers($thisTeam,$event);
                                        }
                                    ?>

                              </div>


                              <div class="col team">
                                <h6>Team 3</h6>
                                <hr class="content">
                                  <?php
                                    $thisTeam = $event->retrieve_team($_GET["id"],3);
                                    if(count($thisTeam["nickname"]) > 0){
                                        
                                          displayPlayers($thisTeam,$event);
                                        }
                                    ?>
                              </div>


                              <div class="col team">
                                <h6>Team 4</h6>
                                <hr class="content">
                                  <?php
                                    $thisTeam = $event->retrieve_team($_GET["id"],4);
                                    if(count($thisTeam["nickname"]) > 0){
                                        
                                          displayPlayers($thisTeam,$event);
                                        }
                                    ?>
                              </div>

                                      
            						
                        </div>

                        <div class="row">
                        <div class="col team">
                                <h6>Teamless</h6>
                                <hr class="content">
                                <div class="row">
                                  <?php
                                    $thisTeam = $event->retrieve_team($_GET["id"],5);
                                    for ($i=0; $i < count($thisTeam["nickname"]); $i++) { 
                                      if($thisTeam["gender"][$i] == "1")
                                      {
                                        $color = "pink";
                                      }
                                      if($thisTeam["gender"][$i] == "2")
                                      {
                                        $color = "lightblue";
                                      }
                                      echo "<div class='col-2 team' style='background: ".$color."'>
                                            <label>".$thisTeam["nickname"][$i]."</label>
                                            <form method='POST' action='src/operatory.php?action=teamchange&id=".$event->id."'>
                                             <input name='id' value=".$thisTeam["id"][$i]." hidden></input>
                                              <button class='content' name='team' value='1'>1</button>
                                              <button class='content' name='team' value='2'>2</button>
                                              <button class='content' name='team' value='3'>3</button>
                                              <button class='content' name='team' value='4'>4</button>
                                            </form>
                                            </div>";
                                    }
                                    ?>
                                </div>
                        </div>
                       </div>

              </div>
                
                <div class="col-3 content" style="height:20%">
               	  	<h5>Add an outsider:</h5>
               	  	<form method="POST" action="src/add.php">
               	  		<label>Name:</label>
               	  		<input class="content" type="text" name="nickname" placeholder="Your friend's name"></input>
               	  		<label>Sex:</label>
               	  		<select class="content" name="gender">
                                  <option>Male</option>
                                  <option>Female</option>
                      </select><br>
                      <button class="content" type="submit">Submit</button>
                      <input name="gameId" hidden value=<?="'".$_GET["id"]."'"?>></input>
               	  	</form>
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
</div>

</div><!-- Row Div -->

</body>
</html>
