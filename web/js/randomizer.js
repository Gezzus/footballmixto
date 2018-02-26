function getRandomizerBox() {
	if ($user.roleId == 2) {
		return "<div class=\"col outsider-box\"\">\n" +
	        "                <h4>Randomizer</h4>\n" +
	        "                <button class='btn btn-primary btn-md' onclick='randomize()'>Randomize!</button>\n" +
	        "            </div>";
	}
	return "";
}

function randomize() {
	$.post("/src/api/randomizerHandler.php",
		{"gameId" : $game.id},
		function(response){
		   console.log(response);
		}
	);
}