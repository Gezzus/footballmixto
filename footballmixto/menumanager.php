<?php
function stop_session($activelink)
{
	session_destroy($activelink);
}


function active_session()
{
	if(isset($_SESSION['id']))
	{
	return("1");
	}
}

?>
<?php
if(!isset($_SESSION['id']))
{
 	?>
		<a class="btn" style="border-width:1px;border-color:black;border-radius:5px" href="login.php">Login</a>
		<a class="btn" style="border-width:1px;border-color:black;border-radius:5px" href="register.php">Register</a>
 	<?php
}


if(isset($_SESSION['id']))
{
 	?>
		<a class="btn" style="border-width:1px;border-color:black;border-radius:5px" href="logout.php">Logout</a>
 	<?php
}




?>