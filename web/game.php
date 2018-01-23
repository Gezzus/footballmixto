<html>
<head>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/gameRetrieve.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
<div class="container-fluid">

<div class="row">
    <div class="col">

    <div class="row">
        <div class="col-8 content" style="background-color: rgba(255, 255, 255, 0.6)">
            <h5>Event information:</h5>
            <hr class="content">

                <div class="row" style="margin:-4px;width:30%;">
					<p id="test"></p>                  
                </div> 
              
        </div> 
	</div>
	
        <div class="col-3 content" style=";background-color: rgba(255, 255, 255, 0.6)">   
                <div class="col content" style="margin:0px">
             	  	<h5>Add an outsider:</h5>
             	  	<form method="POST" action="../src/add.php">
             	  		<label>Name:</label>
             	  		<input class="content" type="text" name="nickname" placeholder="Your friend's name"></input>
             	  		<label>Sex:</label>
             	  		<select class="content" name="gender">
                                <option>Male</option>
                                <option>Female</option>
                    </select><br>
                    <button class="content team" type="submit">Submit</button>
                    <input hidden id="gameId"></input>
             	  	</form>
             	</div>
		 
              
      </div> <!-- End of both col -->
    </div>
            
    
		</div> <!-- Col Div -->
</div>


</body>
</html>
