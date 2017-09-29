<html>
<?php
//include("connect.php");
include("header.html");
include("handler.js");
?>

<body style="background-color:#95A3B3">

<div class="container-fluid" style="margin-top:10%;">

  <div class="row justify-content-center">
    <div class="col"></div>
    <div class="col-3" style="border:1px solid;border-color:#5D2E8C;border-radius:5px;margin:10px;background-color:white">
    <h5 class="form-text text-muted" style="padding-top:15px">Avafutbol | Welcome</h5>
    <h6 class="form-text text-muted" style="padding-top:15px">Login</h5>
    <hr>
      <form id="login_form" method="POST" action="loginAttempt.php">
     
      <label>Username:</label>
      <input id="username" style="background:#D8E1FF;border-color:#5D2E8C" type="text" class="form-control" name="username" placeholder="Username">
      <small class="form-text text-muted">Username must be unique.</small><br>
      <label>Password:</label>
      <input id="password" style="background:#D8E1FF;border-color:#5D2E8C" type="password" class="form-control" name="password" placeholder="Password">
      <small class="form-text text-muted">Use a random password.</small>
      
    <hr>
      <button type="submit" style="background-color:white;border-width:1px;border-color: #5D2E8C;border-radius: 3px">Submit</button>  
      <button type="button" onclick="redirect('index.php?id=returned')" style="background-color:white;border-width:1px;border-color: #5D2E8C;border-radius: 3px">Back</button>
      
      </form>
    </div> <!-- Col -->
    <div class="col"></div>
  </div>

</div> <!-- Container -->
<?php
 include("graph.html")
?>
</body>

</html>


