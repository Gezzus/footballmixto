<?php
function stop_session($activelink)
{
	session_destroy($activelink);
}


function active_session()
{
	if(isset($_SESSION['id']))
	{
	return(1);
	}
	else
	{return(0);}
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
?>