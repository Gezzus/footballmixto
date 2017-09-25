
<?php
	include("connect.php");
  include("header.html");
	session_start();

if(isset($_SESSION["id"]))
{
  header("location:index.php");
}

?>

<html>

<center>
<form action="registerAttempt.php" method="POST">
  <div class="form-group">
    <label for="username">Username</label>
    <input style="width: 45%" type="text" class="form-control" name="username" aria-describedby="usernameHelp" placeholder="Username">
    <small id="usernameHelp" class="form-text text-muted">Username must be unique.</small>
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input style="width: 45%" type="password" class="form-control" name="password" placeholder="Password">
    <small id="usernameHelp" class="form-text text-muted">Password must be hard to guess.</small>
  </div>
  <div class="button-group">
  <button type="submit" class="btn btn-primary">Submit</button>
  <a type="submit" class="btn btn-primary" href="/index.php">Back</a>
  <div>
</form>

<?php
if(isset($_GET["id"]) && ($_GET["id"] == "1"))
	echo "Registration failed.";
?>
<br>
<br>

</center>
</html>
