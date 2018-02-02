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
		
	switch(teamless[i].levelId){
	case "1":
		$level = "I know how to play";
		break;
	case "2":
		$level = "I'm ok";
		break;
	case "3":
		$level = "I know what a ball is.";
		break;
	case "4":
		$level = "I suck.";
		break;
	}
	
	switch(teamless[i].genderId){
	case "1":
		$gender = "Female";
		break;
	case "2":
		$gender = "Male";
		break;
	}
		
		
	var player = "<div class='col-sm-4'>" +
					 "<div id='player"+teamless[i].id+"' class='business-card'>" +
					 		"<div class='media'>" +
						 		"<div class='media-left'>" +
						 		"<img class='media-object rounded-circle profile-img' src='http://s3.amazonaws.com/37assets/svn/765-default-avatar.png'>" +
						 		"</div>" +
						 		"<div class='media-body'>" +
							 		"<h4 class='card-title'>"+teamless[i].nickName+"</h4>" +
							 		"<p class='card-text'>"+$level+"</p>" +
							 		"<p class='card-text'>"+$gender+"</p>" +
						 		"</div>" +
						 		"<div class='media-menu'>" +
							 		"<button class='btn btn-primary btn-sm' >1</button>" +
						 			"<button class='btn btn-primary btn-sm' >2</button>" +
						 			"<button class='btn btn-primary btn-sm' >3</button>" +
						 			"<button class='btn btn-primary btn-sm' >4</button>" +
						 		"</div>" +
						 		
						 	"</div>" +
						"</div>" +
					"</div>";
					 	
					 
					 
/*"<h4 class='card-title'>"+teamless[i].nickName+"</h4>" +
					     	"<p class='card-text'>"+$level+"</p>" +
					     	"<p class='card-text'>"+$gender+"</p>" +*/
	
	$("#teamless").append(player);
	console.log("Drawing player");
	}
}


function drawTeams(teams) {
	//console.log(teams);
	console.log("Teams Size: "+teams.length);
	for(i = 0; i < teams.length; i++) {
		var team = "<div class='col-3'>" +
				   "<ul id='team"+i+"' class='list-group-item'>" +
				   "</ul>" +
				   "</div>";
		
		console.log("Drawing team");
		
		$("#teams").append(team);
		var title = "<h6>Team "+i+"</h6>";
		$("#team"+i).append(title);
		
		for(j = 0; j < teams[i].players.length; j++) {
			var player = "<li class='list-group-item' id='player"+teams[i].players[j].id+"'>"+teams[i].players[j].nickName+"</li>";
			$("#team"+i).append(player);
			console.log("Drawing player")
		}
	}
	console.log("Finished drawing teams");  

}