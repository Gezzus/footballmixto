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
    <div class="col-4 landing">
    <h5 class="form-text text-muted" style="padding-top:15px">Fúlbo | Welcome</h5>
    <h6 class="form-text text-muted" style="padding-top:15px">Register</h5>
    <hr>
      <form id="login_form" method="POST" action="src/register.php">
     
      <label>Username:</label>
      <input class="form-control landing" name="username" placeholder="Username">
      <small class="form-text text-muted">Username must be unique.</small>
      <label>Password:</label>
      <input class="form-control landing" type="password" name="password" placeholder="Password">
      <small class="form-text text-muted">Use a random password.</small>
      <label>Nickname:</label>
      <input class="form-control landing" name="nickname" placeholder="Shorty">
      <small class="form-text text-muted">Whatever you wanna be called.</small><br>
      <label>Gender:</label>
      <select class="landing" name="gender">
          <option class="landing">Male</option>
          <option class="landing">Female</option>
      </select>
      <label>Skill:</label>
      <select class="landing" name="skill">
          <option class="landing" value="1">I know how to play</option>
          <option class="landing" value="3">I know what a ball is</option>
          <option class="landing" value="4">I suck</option>
          <option class="landing" value="2">I'm ok</option>
      </select>
    <hr>
      <button class="content" type="submit">Submit</button>  
      <a href="index.php?id=returned">
        <button type="button" class="content">Back</button>
      </a>
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

