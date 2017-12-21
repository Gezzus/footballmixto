<?php
include("src/connect.php");
session_start();
include("header.html");
include("src/users.php");
include("src/game.php");
include("src/reports.php");

if(isset($_GET["error"]) && $_GET["error"] == 3){
    echo "<script type='text/javascript'>alert('Please log in');</script>";
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
      <? include("topbar.php"); ?>


		 	<div class="row">

                  <div class="col-2 team content" style="min-height: 15%">
                  <h4>Reports</h4>
                  <form action="reports.php" method="GET">
                  <select name="id" class="content team">
                  <? retrieve_players_display_select($link); ?>
    	            </select>
                  <button class="content team" type="input">Go</button>
                  </form>
		              </div> <!-- Col Div -->
                   </div><!-- Row Div -->
      <? if(isset($_GET['id'])){ ?>             
      <div class="row">             
                  <div class="col-4 team content" style="min-height: 15%">
                  <h4>Result for: <?= player_display_NickName($link,$_GET['id']) ?>
                  </h4>
                  <?
                  if(isset($_GET['id']))
                  {
                    retrieve_results_display($link,$_GET['id']);
                  }
                  ?>
                  </div> <!-- Col Div -->

      </div> <!-- Row Div -->
      <? } ?>


    </div>
    
</body>

</html>
