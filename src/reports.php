<?php 

function retrieve_results_matches($activelink,$user){
$received_id =  filter_var($user,FILTER_SANITIZE_STRING);
$report_query_matches = "SELECT * FROM game LEFT JOIN pickPlayer ON playerId='".$received_id."' WHERE game.id=pickPlayer.gameId";

$report_query_matches_result  = mysqli_query($activelink, $report_query_matches);
return $report_query_matches_result;
}


function retrieve_results_pairedwith($activelink,$user)
{
	#$report_query_pairedwith = "SELECT * FROM player LEFT JOIN pickPlayer ON playerId= "
	$report_query_matches = "SELECT id FROM game LEFT JOIN pickPlayer ON playerId='".$user."' WHERE game.id=pickPlayer.gameId";
}



function retrieve_results_display($activelink,$user){
	$playerReport = retrieve_results_matches($activelink,$user);
	echo "<hr><h5>Matches: </h5>";
	for ($i=0; $i < mysqli_num_rows($playerReport); $i++) { 
		$report_cur_row = mysqli_fetch_assoc($playerReport);
		?>
			<li>
				Match date:<?= $report_cur_row['date'] ?>
			</li>
		<?
	}
	echo "<hr>";
}





?>