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
    <div class="col-4" style="border:1px solid;border-color:#5D2E8C;border-radius:5px;margin:10px;background-color:white">
    <h5 class="form-text text-muted" style="padding-top:15px">Avafutbol | Welcome</h5>
    <h6 class="form-text text-muted" style="padding-top:15px">Register</h5>
    <hr>
      <form id="login_form" method="POST" action="src/register.php">
     
      <label>Username:</label>
      <input style="background:#D8E1FF;border-color:#5D2E8C;width:100%" type="text" class="form-control" name="username" placeholder="Username">
      <small class="form-text text-muted">Username must be unique.</small>
      <label>Password:</label>
      <input style="background:#D8E1FF;border-color:#5D2E8C;width:100%" type="password" class="form-control" name="password" placeholder="Password">
      <small class="form-text text-muted">Use a random password.</small>
      <label>Nickname:</label>
      <input style="background:#D8E1FF;border-color:#5D2E8C;width:100%" type="text" class="form-control" name="nickname" placeholder="Shorty">
      <small class="form-text text-muted">Whatever you wanna be called.</small><br>
      <label>Gender:</label>
      <select style="background:#D8E1FF;border-color:#5D2E8C;border-radius:5%" name="gender">
          <option style="background:#D8E1FF;border-color:#5D2E8C;border-radius:5%">Male</option>
          <option style="background:#D8E1FF;border-color:#5D2E8C;border-radius:5%">Female</option>
      </select>
      <label>Skill:</label>
      <select style="background:#D8E1FF;border-color:#5D2E8C;border-radius:5%" name="skill">
          <option style="background:#D8E1FF;border-color:#5D2E8C;border-radius:5%">1</option>
          <option style="background:#D8E1FF;border-color:#5D2E8C;border-radius:5%">2</option>
          <option style="background:#D8E1FF;border-color:#5D2E8C;border-radius:5%">3</option>
          <option style="background:#D8E1FF;border-color:#5D2E8C;border-radius:5%">4</option>
          <option style="background:#D8E1FF;border-color:#5D2E8C;border-radius:5%">5</option>
      </select>
    <hr>
      <button type="submit" style="background-color:white;border:1px solid;border-color: #5D2E8C;border-radius: 3px;">Submit</button>  
      <a href="index.php?id=returned"><input type="button" style="background-color:white;border:1px solid;border-color: #5D2E8C;border-radius: 3px;"  value="Back"/></a>
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

