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

 <link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body class="landing">

<div class="container-fluid" style="margin-top:10%;">

  <div class="row justify-content-center">
    <div class="landing col-4">
    <h5 class="form-text text-muted" style="padding-top:15px">Fúlbo | Welcome</h5>
      <h6 class="form-text text-muted" style="padding-top:15px">Login</h5>
      <hr>
      <form id="login_form" method="POST" action="src/login.php">
     
      <label>Username:</label>
      <input type="text" class="form-control landing" name="username" placeholder="Username">
      <label>Password:</label>
      <input type="password" class="form-control landing" name="password" placeholder="Password">
      
      <hr>
      <button class="content" type="submit">Submit</button>  
      <a href="index.php?id=returned">
        <button type="button" class="content">Back</button>
      </a>
      
      </form>
    </div> <!-- Col4 -->
  </div> <!-- row -->

</div> <!-- Container -->
<?php
 include("svg/graph.html")
?>
</body>

</html>


