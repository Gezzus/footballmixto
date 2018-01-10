<?php
include("src/connect.php");
session_start();
include("header.html");
include("src/menumanager.php");
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

            <!-- Top bar -->
			<div class="row"">
			<div class="col top">
			<a href="index.php" class="top" >Back</a>
			</div>
			</div>
            <!-- Top bar end -->

		 	<div class="row" style="padding-bottom: 0;margin-bottom:0">
                  <div class="col-3 content">
                  	<h5>Your profile: </h5>
                  	<hr class="content">
                      <div class="row"  style="padding:1%">

                            <form action="attachments/profile.php" method="POST" enctype="multipart/form-data" style="width:100%">
                            <div clas="col">
                               <label><img class="profileimage" height="100" width="100" src="<?="attachments/".$_SESSION['id'] ?>">
                               <input name="image" class="profileimage" type="file">
                               </img></label><br>
                               <label><font size="2" color="grey">Click up here to upload a picture.<br>Upload a small picture... please.<br>Changes wont take effect until you press "Upload Picture".</font></label>
                            </div>
                            
                             <button class="content team" type="input">Upload Picture</button>
                            </form>
                            <hr style="margin:1%">
                            
                            <form action="src/profile.php" method="POST" style="width:100%">

                            <label class="content">Nickname: </label>
                            <input class="content" style="width:70%" type="text" value=<?= $_SESSION['nickname']?>>
                            <br>
                       
                             <button class="content team" type="input">Update Profile</button>
                            </form>
                            <hr>
                            


                      </div>


             	  </div>	
            
                  
             	  	  
            </div>
            <div class="row"  style="padding-top: 0;margin-top:0">
            	<div class="col-3 content" style="height:5%">
                	<center><h5>More stuff comming soon</h5></center>
                    	
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

