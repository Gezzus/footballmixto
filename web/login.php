<html>
<head>
<?php
include("src/connect.php");
include("header.html");

  session_start();

  if(isset($_SESSION["id"]))
  {
    header("location:web/index.php");
  }
?>

 <link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body class="landing">

<div class="container-fluid" style="margin-top:10%;">

  <div class="row justify-content-center">
    <div class="col-4 content team">
       <h5 class="form-text text-muted" style="padding-top:15px">Fúlbo | Welcome</h5>
      <h5 class="form-text text-muted" style="padding-top:15px">Login</h5>
      <hr>
      <div class="row">
      <div class="col" style="border-right: 1px solid;border-color: #CCCCCC">
   
      <form id="login_form" method="POST" action="src/login.php">
     
      <label>Username:</label>
      <input type="text" class="content team" name="username" placeholder="Username">
      <label>Password:</label>
      <input type="password" class="content team" name="password" placeholder="Password">
      
      <hr>
      <button class="content team" type="submit">Submit</button>  
      <a href="web/index.php?id=returned">
        <button type="button" class="content team">Back</button>
      </a>
      
      </form>
      </div>
      <div class="col">
        <a href="web/register.php"><button type="submit" class="content team" style="min-width:80%" >Register</button></a><br>
        <button style="min-width:80%" class="content team" onclick=window.open("https://api.instagram.com/oauth/authorize/?client_id=d31abc6eb2d94c418c5b5ddc14df11cd&redirect_uri=http://172.20.10.81&response_type=code","_child","width=500,height=500")>Login with Instagram</button><br>

         <button style="min-width:80%" class="content team" onclick=window.open("","_child","width=500,height=500")>Login with Facebook</button><br>

         <button style="min-width:80%" class="content team" onclick=window.open("","_child","width=500,height=500")>Login with LinkedIn</button><br>
      </div>

    </div>
    </div> <!-- Col4 -->
    
  </div> <!-- row -->

</div> <!-- Container -->
<?php
 include("svg/graph.html")
?>
</body>

</html>


