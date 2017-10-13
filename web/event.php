
<?php
include("src/connect.php");
session_start();
include("header.html");
include("src/menumanager.php");
include("src/game.php");
?>

<html>
<body style="background-color:#E8E8E8">
<div class="container-fluid">
<div class="row">
	<div class="col-2" style="background-color: #313131;height: 100%">
		<hr style="padding:0px;margin:0px;border-top:1px solid rgba(255, 255, 255, 0.1)">
		<div class="col" style="width:100%;padding:2%;margin:1%;">
			<div class="row" style="border:1px solid;border-color:#5D2E8C;border-radius:5px;margin:10px;background-color:#E8E8E8;width:90%;padding:2%;margin:2%;">
				<a style="" href="index.php">Events</a></li>
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
	</div>

		<div class="col">
		 	<div class="row" style="width:100%;padding-top:1%;">
                  <div class="col" style="border:1px solid;border-color:#5D2E8C;border-radius:5px;margin:2%;padding:1%;background-color:white">
                  <h5>Event information: (10 vs 10) Fútbol Match</h5>
                  <hr style="margin:0px;margin-bottom:10px">

                  	  <div class="row" style="margin:0px;width:25%;">
                  	  	<ul class="list-group" style="width:100%">
						  <li style="list-style-type: none;list-style-type: none;border:1px solid rgba(0,0,0,.1);">When: 11/10/17</li>
						  <li style="list-style-type: none;border:1px solid rgba(0,0,0,.1);">Where: Placeholder</li>
						  <li style="list-style-type: none;border:1px solid rgba(0,0,0,.1);">Organizer: Placeholder</li>
						</ul>
                  	  </div>

                      <div class="row" style="">
                      
  						<div class="col" style="margin:1%;border:1px solid rgba(0,0,0,.1)">
  							<h6>Team Alpha</h6>
  							<hr style="margin:0px;margin-bottom:10px;">

  							<div class="row" style="margin:1%;border:1px solid rgba(0,0,0,.1);background:pink">
  								<label>Person1</label>
  							</div>


  							<div class="row" style="margin:1%;border:1px solid rgba(0,0,0,.1);background:lightblue">
								<label>Person1</label>
  							</div>

  							<div class="row" style="margin:1%;border:1px solid rgba(0,0,0,.1);background:pink">
  								<label>Person1</label>
  							</div>

  							<div class="row" style="margin:1%;border:1px solid rgba(0,0,0,.1);background:pink">
  								<label>Person1</label>
  							</div>

  							<div class="row" style="margin:1%;border:1px solid rgba(0,0,0,.1);background:lightblue">
  								<label>Person1</label>
  							</div>


  						</div>
                      
  						<div class="col" style="margin:1%;border:1px solid rgba(0,0,0,.1)">
  							<h6>Team Beta</h6>
  							<hr style="margin:0px;margin-bottom:10px">
  						</div>
  						<div class="col" style="margin:1%;border:1px solid rgba(0,0,0,.1)"> 
  							<h6>Team Gamma</h6>
  							<hr style="margin:0px;margin-bottom:10px">
  						</div>
  						<div class="col" style="margin:1%;border:1px solid rgba(0,0,0,.1)">
  							<h6>Team Delta</h6>
  							<hr style="margin:0px;margin-bottom:10px">
  						</div>
  						<div class="col" style="margin:1%;border:1px solid rgba(0,0,0,.1)">
  							<h6>Teamless</h6>
  							<hr style="margin:0px;margin-bottom:10px">
  						</div>

                      </div>

             	  </div>	
             	  <div class="col-3" style="border:1px solid;border-color:#5D2E8C;border-radius:5px;margin:2%;padding:1%;background-color:white;height:20%">
             	  	<div class="col-1">
             	  	</div>
					
					<div class="col">
					             	  	
             	  	<h5>Add an outsider:</h5>
             	  	<form style="position:center">
             	  		<label style="margin:0px">Name:</label><br>
             	  		<input type="text" style="width:100%;margin:0px;border:1px solid rgba(0,0,0,.1)" ></input>
             	  		<br>
             	  		<label>Sex: </label>
             	  		<select name="sex" style="width:30%;margin:1%;background-color:white;border-width:1px;border:1px solid rgba(0,0,0,.1);border-radius: 3px">
                                <option>Male</option>
                                <option>Female</option>
                        </select><br>
                        <button type="submit" style="background-color:white;border-width:1px;border-color: #5D2E8C;border-radius: 3px">Submit</button>
             	  	</form>
             	  	</div>
             	  	<div class="col-1">
             	  	</div>
             	  	
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

<?php

function displayEvent($id)
{
	echo $id;
}

#"
?>