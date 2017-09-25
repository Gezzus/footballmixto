<html>
<?php
include("Conectarse.php");
include("header.html");
?>

<center>
<form action="loginAttempt.php" method="POST">
  <div class="form-group">
    <label for="username">Username</label>
    <input style="width: 45%;" type="text" class="form-control" name="username" aria-describedby="usernameHelp" placeholder="Username">
    <small id="usernameHelp" class="form-text text-muted">Username must be unique.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input style="width: 45%;"type="password" class="form-control" name="password" placeholder="Password">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  <a type="submit" class="btn btn-primary" href="/loginAttempt.php">Back</a>
</form>



<?php
if( (isset($_GET["id"]) && ($_GET["id"] == "1")))
	echo "Login failed.";
	session_start();
?>
</center>


</html>
