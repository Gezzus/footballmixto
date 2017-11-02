
<?php
include("src/connect.php");
session_start();
include("header.html");
include("src/game.php");

$game = game_retrieve($_GET['id'],$link);

if(active_session() == 0){
  header("location:index.php?error=3");
  
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
        <a class="menubutton" href="src/logout.php">
          <button class="menubutton">Logout</button>
        </a>
        </div>
      <?php } ?>

  
    
    </div> <!-- Menu div -->

    <div class="col">
      <div class="row"">
          <div class="col top">
          </div>
		      <div class="col-1 top">
            <form method="POST" action="src/join.php">
            <button href="index.php" class="top">Join Event</button>
            <input hidden value="<?=$_GET['id']?>" name="gameId"></input>
            </form>
          </div>
          <div class="col-1 top">
            <form method="POST" action="src/deletegame.php">
            <button href="index.php" class="top">Delete Event</button>
            <input hidden value="<?=$_GET['id']?>" name="id"></input>
            </form>
          </div>
		  </div>

      <div class="row">
        <div class="col team content">
            <h5>Event information: Fútbol Match</h5>
            <hr class="content">

                <div class="row" style="margin:-4px;width:30%;">
                  <ul class="list-group" style="">
                    <li>When: <?= $game["date"]; ?></li>
                    <li>Type: <?= $game["type"]; ?></li>
                  </ul>
                </div> 
                <? game_organize_teams($_GET['id'],$link,$_SESSION['id']) ?>
        </div> 
        <div class="col-3" style="border: none;margin-top:1%;margin-bottom:0px;margin-left:0px;margin-right:2%;padding: 0px;">   
                <div class="col team content">
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
                    <input name="gameId" hidden value="<?=$_GET['id']?>"></input>
             	  	</form>
             	</div>
              <div class="col team content">
              <h5>Current players:</h5>
                  
                  <label>Male: <?= game_retrieve_attribute_ammount($_GET['id'],$link,"player.genderId","1")?></label><br>
                  <label>Female: <?= game_retrieve_attribute_ammount($_GET['id'],$link,"player.genderId","2")?></label>
              </div>
      </div> <!-- End of both col -->
    </div>

    <div class="row">
       <div class="col team content">
                <h6>Teamless</h6>
                <hr class="content"> 
                <? organize_team($_GET['id'],'5',$link,'0',$_SESSION['id']); ?>
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
