var gameId = location.hash.substr(1);
getGame(gameId);

$("#gameId").html(gameId);

function getGame($value){
      $.ajax({
          url: "/src/api/gameHandler.php", 
          type: "GET",
          data: {
        	  "action" : "retrieve",
        	  "id": $value
          },
          dataType: "html",
          async: false,
          success: function(result){
        	  console.log(result);
        	  var resultObj = JSON.parse(result);
        	  
        	  $(document).ready(function(){
        		  drawTeams(resultObj.teams);
            	  drawTeamless(resultObj.teamless);
        	  })
          },
          error: function(status,exception) {
        	  console.log(status);
        	  console.log(exception);
            }
      });
}


function drawTeamless(teamless) {
	console.log(teamless);
	console.log("Teamless Size: "+teamless.length);
	for(i = 0; i < teamless.length; i++) {
	var player = "<div id='player"+teamless[i].id+"' class='content player' style='width:10%'>"+teamless[i].nickName+"</div>";
	$("#teamless").append(player);
	console.log("Drawing player");
	}
}


function drawTeams(teams) {
	//console.log(teams);
	console.log("Teams Size: "+teams.length);
	for(i = 0; i < teams.length; i++) {
		var team = "<div id='team"+i+"' class='col content team'></div>";
		console.log("Drawing team");
		
		$("#teams").append(team);
		var title = "<h6>Team "+i+"</h6>";
		$("#team"+i).append(title);
		
		for(j = 0; j < teams[i].players.length; j++) {
			var player = "<div id='player"+teams[i].players[j].id+"' class='col content player'>"+teams[i].players[j].nickName+"</div>";
			$("#team"+i).append(player);
			console.log("Drawing player")
		}
	}
	console.log("Finished drawing teams");  

}