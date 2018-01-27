<?php

function stop_session($activeLink) {
	session_destroy($activeLink);
}


function active_session() {
	if(isset($_SESSION['id']))  {
		return(1);
	} else {
		return(0);
	}
}

function isAdmin($thisId, $activeLink) {
	$task_retrieve = "SELECT roleId FROM user WHERE id = " . $thisId;
	$task_query_retrieve = mysqli_query($activeLink, $task_retrieve);
	$task_query_row = mysqli_fetch_assoc($task_query_retrieve);
	if($task_query_row["roleId"] == 2) {
		return 1;
	} else{
		return 0;
	}
}
