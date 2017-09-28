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

function isAdmin($thisId,$activelink)
{
	$task_retrieve = "SELECT * FROM Credentials WHERE id=$thisId";
	$task_query_retrieve = mysqli_query($activelink,$task_retrieve);
	$task_query_row = mysqli_fetch_assoc($task_query_retrieve);
	if($task_query_row["admin"] == 1){
		return 1;
	}
	else{
		return 0;
	}
}


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
