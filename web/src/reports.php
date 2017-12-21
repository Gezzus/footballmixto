<?php 

function retrieve_results($activelink,$user){

$received_id =  filter_var($_GET["id"],FILTER_SANITIZE_STRING);
$report_query_matches = "SELECT * FROM game LEFT JOIN pickPlayer ON playerId='".$received_id."' WHERE game.id=pickPlayer.gameId";

$report_query_matches_result  = mysqli_query($activelink, $report_query_matches);

return $report_query_matches_result;
}

function retrieve_results_display($activelink,$user){
	$playerReport = retrieve_results($activelink,$user);
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


	#$matchesReportCount = array_count_values(mysqli_fetch_array($playerReport)); 
	#$matchesMostPlayed = array_search(max($matchesReportCount), $matchesReportCount);
	#$matchesReportArray = mysqli_fetch_array($playerReport);
	#echo "<hr><h5>Most played game-mode: </h5>";
	#echo $matchesMostPlayed;
	#print_r($matchesReportArray);
	#echo "<hr>";


}

?>