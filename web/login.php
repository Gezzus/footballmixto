<html>
<head>
<?php
include("src/connect.php");
include("header.html");

  session_start();

  if(isset($_SESSION["id"]))
  {
    header("location:index.php");
  }
?>
</head>

<body style="background-color:#95A3B3">

<div class="container-fluid" style="margin-top:10%;">

  <div class="row justify-content-center">
    <div class="col"></div>
    <div class="col-3" style="border:1px solid;border-color:#5D2E8C;border-radius:5px;margin:10px;background-color:white">
    <h5 class="form-text text-muted" style="padding-top:15px">Avafutbol | Welcome</h5>
    <h6 class="form-text text-muted" style="padding-top:15px">Login</h5>
    <hr>
      <form id="login_form" method="POST" action="src/login.php">
     
      <label>Username:</label>
      <input id="username" style="background:#D8E1FF;border-color:#5D2E8C" type="text" class="form-control" name="username" placeholder="Username">
      <label>Password:</label>
      <input id="password" style="background:#D8E1FF;border-color:#5D2E8C" type="password" class="form-control" name="password" placeholder="Password">
      
    <hr>
      <button type="submit" style="background-color:white;border-width:1px;border-color: #5D2E8C;border-radius: 3px">Submit</button>  
      <a type="buton" href="index.php?id=returned"><input type="button" style="background-color:white;border:1px solid;border-color: #5D2E8C;border-radius: 3px;"  value="Back"/></a>
      
      </form>
    </div> <!-- Col -->
    <div class="col"></div>
  </div>

</div> <!-- Container -->
<?php
 include("svg/graph.html")
?>
</body>

</html>


