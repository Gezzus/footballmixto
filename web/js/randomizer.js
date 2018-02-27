function getRandomizerBox() {
	if ($user.roleId == 2) {
		return "<div class=\"col outsider-box\"\">\n" +
	        "                <h4 id='randomizerTitle'>Randomizer</h4>\n" +
	        "                <hr>" +
	        "                <button id ='randomizerButton' class='btn btn-primary btn-md' onclick='randomize()'>Randomize!</button>\n" +
	        "            <div id = 'randomizerResult'></div>";	
	        "            </div>";
	}
	return "";
}

function randomize() {
	$.post("/src/api/randomizerHandler.php",
		{"gameId" : $game.id},
		function(response){
			$("#randomizerButton").hide();
			$("#randomizerTitle").html('Randomizer: Losers');
			$("#randomizerResult").html(response.result.replace(/\n/g,'<br/>'));
		},
		'json'
	);
}