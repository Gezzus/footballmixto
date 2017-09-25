<?php
include("connect.php");
session_start();

include("header.html");
include("teams.php");
?>

<html>
<body>

	<div class="container-fluid" style="border-radius:5px;margin:2px">		
			  <div class="row" style="width:100%;padding-top:1%p;adding-left:1%">
			  	<div class="column">
			  	<h6 class="alert p-0 m-0 alert-primary" style="background-color:white!important;border-color:white!important;margin-top:5px!important;margin-bottom:0px!important"><b>Work in progress (Menu)</b></h6>
               <?php include("./footballmixto/menumanager.php"); ?>

			  </div>
			  </div>
			  <hr>
			  <div class="row" style="width:100%;padding-top:1%;padding-left:1%;">
				  <div class="col">
				  <h5>Teamless: </h5>
				  <hr style="margin:0px">
					  <div class="row">
					  	<?php retrieveTeam('0',"20%",$link,"#FFA69E"); ?>
					  </div>
				  </div>



				  <div class="col-md-3" >

				  
				 	<div class="row" style="border:1px solid;border-radius:5px;border-color:black;padding:5px;">
				  <font size="2">
						<h5 class="alert-heading">Join us!</h5>
						<label class="mb-0">Use the following form to subscribe to our football matches.</label>
						<hr style="padding:2px">
							<?php 
						  if(active_session() == 1)
						  {
						  ?>
						<form action="./footballmixto/add.php" method="POST" class="form-group" >
						<div class="row alert alert-primary>">
							<label class="alert-heading" style="width:100%" ><b>Your name: </b></label>
							<input type="input" name="name" class="alert alert-secondary" style="width:75%; padding:0.2rem;"></input>
							<label class="alert-heading" style="width:100%" ><b>Skill level:</b></label>
							<select name="skill" class="form-control form-control-sm" style="width:60%">
								<option>I know how to play.</option>
								<option>Im ok.</option>
								<option>I know what a ball is.</option>
								<option>I suck.</option>
							</select>
							<label class="alert-heading" style="width:100%" ><b>Sex:</b></label>
							<select name="sex" class="form-control form-control-sm" style="width:60%">
								<option>Male</option>
								<option>Female</option>
								<option>Im offended by this</option>
							</select>
							<h12 class="alert-heading"  style="width:100%" ><b>Availability:</b></h12>
							<select name="schedule" class="form-control form-control-sm" style="width:60%">
								<option>I dont care</option>
								<option>19:00</option>
								<option>19:30</option>
								<option>20:00</option>
							</select><hr>
							<button type="input" class="btn btn-secondary" style="float:left;background-color:white;color:black!important"><small>Add</small></button>
						</div>
						</form>
						<?php

						}
						else
						{
							?>
							<h5 class="alert alert-secondary"> Log-In to see the subscription form</h5>
							<?php
						}
						?>
					</font>
					</div>
					<div class="row" style="border:1px solid;border-radius:5px;border-color:black;padding:5px;">
					<div class="container ">
					<h5>We are currently:</h5><br>
					
					<p>
					<b>Women:</b><?php retrieve('Female',$link) ?><br>
					<b>Men:</b><?php retrieve('Male',$link) ?><br>
					</p>
					</div>
					</div>
				  </div>  <!-- Col 4 Div -->


				  </div> <!-- Row Div -->
				  <hr>
				  <h5>Teams: </h5>
				  
				  <hr style="margin:0px">
				   <div class="row" style="width:100%;padding-top:1%;padding-left:1%;">
				  <div class="col-md-5"  style="border:1px solid;border-radius:5px;border-color:black;margin:5px;">
				  <h5 class="alert-heading">Team 1: </h5>
				  <hr style="margin:0px">
					  <div class="row" >
					  	<?php retrieveTeam('1',"30%",$link,"#ebf5ee","2"); ?>

					  </div>
					  <br>
				  </div>
				  <div class="col-md-5"  style="border:1px solid;border-radius:5px;border-color:black;margin:5px;">
				  <h5 class="alert-heading">Team 2: </h5>
				<hr style="margin:0px">

					  <div class="row" >
					  	<?php retrieveTeam('2',"30%",$link,"#ffe8c2","2"); ?>
					  </div>
					  <br>
				  </div>
				  <div class="col-md-5"  style="border:1px solid;border-radius:5px;border-color:black;margin:5px;">
				  <h5 class="alert-heading">Team 3: </h5>
				  <hr style="margin:0px">
					  <div class="row" >
					  	<?php retrieveTeam('3',"30%",$link,"#9CAFB7","2"); ?>
					  </div>
					  <br>
				  </div>
				  <div class="col-md-5"  style="border:1px solid;border-radius:5px;border-color:black;margin:5px;">
				  <h5 class="alert-heading">Team 4: </h5>
				  <hr style="margin:0px">
					  <div class="row" >
					  	<?php retrieveTeam('4',"30%",$link,"#ea7d75","2"); ?>
					  </div>
					  <br>
				  </div>
				  </div>
				  
		</div> <!-- Container Div -->



</body>
</html>
