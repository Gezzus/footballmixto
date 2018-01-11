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

  if(isset($_GET["id"]) && $_GET["id"] == 3){
    echo "<script type='text/javascript'>alert('Please use a different Username or Nickname');</script>";
}

?>

 <link rel="stylesheet" type="text/css" href="css/style.css">

</head>

<body class="landing">

<div class="container-fluid" style="margin-top:10%;">

  <div class="row justify-content-center">
    <div class="col"></div>

    <div class="col-4 content team">
<h5 class="content team" style="padding-top:15px">Fúlbo | Welcome</h5>
<hr style="margin:0px;padding:0px">
    <h5 class="content team" style="padding-top:15px">Register</h5>
    <hr>
      <div class="row">
        <div class="col" style="border-right: 1px solid;border-color: #CCCCCC">

    
      <form id="login_form" method="POST" action="src/register.php">
     
      <label style="margin:0px;padding:0px">Username:</label>
      <input class="content team" name="username" placeholder="Username">
      <small class="content team">Username must be unique.</small><br>
      <label style="margin:0px;padding:0px">Password:</label>
      <input class="content team" type="password" name="password" placeholder="Password">
      <small class="content team">Use a random password.</small><br>
      <label style="margin:0px;padding:0px">Nickname:</label>
      <input class="content team" name="nickname" placeholder="Shorty">
      <small class="content team">Whatever you wanna be called, must also be unique.</small><br>
      <label>Gender:</label>
      <select class="content team" name="gender">
          <option class="">Male</option>
          <option class="">Female</option>
      </select>
      <br>
      <label>Skill:</label>
      <select class="content team" style="min-width:80%" name="skill">
          <option class="" value="1">I know how to play</option>
          <option class="" value="2">I'm ok</option>
          <option class="" value="3">I know what a ball is</option>
          <option class="" value="4">I suck</option>
      </select>
    <hr>
      <button class="content team" type="submit">Submit</button>  
      <a href="index.php?id=returned">
        <button type="button" class="content team">Back</button>
      </a>
      </form>
    </div> <!-- Col -->
    
     <div class="col">
      <a href="login.php"><button type="submit" class="content team" style="min-width:80%" >Login</button></a><br>
        <button style="min-width:80%" class="content team" onclick=window.open("https://api.instagram.com/oauth/authorize/?client_id=d31abc6eb2d94c418c5b5ddc14df11cd&redirect_uri=http://172.20.10.81&response_type=code","_child","width=500,height=500")>Login with Instagram</button><br>

         <button style="min-width:80%" class="content team" onclick=window.open("","_child","width=500,height=500")>Login with Facebook</button><br>

         <button style="min-width:80%" class="content team" onclick=window.open("","_child","width=500,height=500")>Login with LinkedIn</button><br>
      </div>
    </div>
    </div>

    <div class="col"></div>
  </div>

</div> <!-- Container -->

<?php
 include("svg/graph.html")
?>
</body>

</html>

