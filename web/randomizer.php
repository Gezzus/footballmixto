<?php
include("src/connect.php");
session_start();
include("header.html");
include("src/game.php");
include("src/users.php");

if(isset($_GET["error"]) && $_GET["error"] == 3){
    echo "<script type='text/javascript'>alert('Please log in');</script>";
}

if(isset($_SESSION["winners"]) && (!isset($_GET['add']))){
    $_SESSION['winners'] = null;
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

                  <div class="col-4 team content" style="height: 35%">
                   Randomizer:<br>

                   <form action="src/rand.php" method="POST">

                   <div class="col team content" style="margin:1%">
                    <?php 
                      if(isset($_GET['add'])){
                        players_display($_GET['add'],$link);
                      }
                    ?> 

                   </div>
                   
                    <font size=2>Amount of winners</font><br>
                    <select class="content" name="amount">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option>4</option>
                      <option>5</option>
                      <option>6</option>
                      <option>7</option>
                    </select>
                    <button class="content team">Go!</button>
                    <a href="randomizer.php"><button type="button" class="content team">Clean</button></a>
                   </form>

                    <? if(isset($_SESSION['winners']) == 1 ){ ?>
                        <h6 class="">Winners</h6>
                         <?php winner_display($_SESSION['winners'],$link,$_SESSION['id']); ?>
                    
                    <? } ?>


                  </div>
                
                  <div class="col-3 team content" style="margin-left: 0%!important">
                    <h6 class="">Select players:</h6>
                	   <div class="col team content">
                     <?php if(isset($_GET['add']))
                            {
                              retrieve_players_display($_GET['add'],$link);
                            }
                         else{retrieve_players_display(null,$link);
                         } ?>
             	    </div>
             	  	  
                </div>
              

    		
    	
		</div> <!-- Row Div -->
       

</div><!-- Col Div -->

</div>

	

</body>

</html>

