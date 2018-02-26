function getThisGame(){
    var gameId = location.hash.substr(1);
	getGame(gameId);
}

function getGame($value){
    $.ajax({
          url: "/src/api/gameHandler.php", 
          type: "GET",
          data: {
        	  "action" : "retrieve",
              "subaction": "",
        	  "id": $value
          },
          dataType: "html",
          async: false,
          success: function(result){
              var $result = JSON.parse(result);

        	  $(document).ready(function(){
        	  	  drawEvent($result);
                  getPlayersAmount($value, "1");
                  getPlayersAmount($value, "2");
        	  	  drawTeams($result);
            	  drawTeamless($result);
        	  })
          },
          error: function(status,exception) {
        	  console.log(status);
        	  console.log(exception);
            }
      });
}



function getMetaById($id) {
	$result = $.ajax({
          url: "/src/api/gameHandler.php",
          type: "GET",
          data: {
        	  "action" : "retrieve",
        	  "id": $id,
			  "subaction": "data"
          },
          dataType: "html",
          async: false,
          success: function(result){
        	  $(document).ready(function(){

        	  })
          },
          error: function(status,exception) {
        	  console.log(status);
        	  console.log(exception);
            }
      });
	return JSON.parse($result.responseText);
}


function getPlayersAmount($id, $genderId){
	$.ajax({
        url: "/src/api/gameHandler.php",
        type: "GET",
        data: {
            "action" : "retrieveAmount",
            "id": $id,
			"genderId": $genderId
        },
        dataType: "html",
        async: false,
        success: function(result){
        	console.log(result);
            try {
                var $amountResult = JSON.parse(result)
                if($amountResult.status == "success"){
                    $(document).ready(function(){
                        switch($genderId){
                            default:
                            	console.log("DAFUQ");
                                break;
                            case "2":
                            	$("#event-counter-male").html($amountResult.amount);
                                break;
                            case "1":

                            	$("#event-counter-female").html($amountResult.amount);
                                break;
                        }
                    })
                } else {
                    $error ="<div class=\"alert alert-danger alert-dismissable\" >" +
                        "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>" +
                        "<strong>Hey!</strong>  Shit hit the ceiling. Talk to Alessandro." +
                        "</div>"
                    $("#error").append($error);
                }
            } catch(err) {
                $error ="<div class=\"alert alert-danger alert-dismissable\" >" +
                    "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>" +
                    "<strong>Hey!</strong> Shit hit the ceiling. Talk to Alessandro." +
                    "</div>"
                $("#error").append($error);
            }
        },
        error: function(status,exception) {
            console.log(status);
            console.log(exception);
        }
    });
    //return JSON.parse($result.responseText);
}

function drawEvent($event) {
    $user = getUser();



    switch ($event.typeId) {
        default:
            var $eventType = "Something went wrong ;(";
            break;
        case "1":
            $eventType = "Football 5 vs 5 - (One field)";

            break;
        case "2":
            $eventType = "Football 5 vs 5 - (Two fields)";

            break;
        case "3":
            $eventType = "Tennis 1 vs 1";

            break;
        case "4":
            $eventType = "Tennis 2 vs 2";

            break;
    }

    $outsiderBox = "<div class=\"col outsider-box\"\">\n" +
        "                <h4>Add an outsider</h4>\n" +
        "                <input  class=\"form-control\" id=\"event-add-player-name\" placeholder=\"Outsider nickname\">\n" +
        "                <select  class=\"form-control\" id=\"event-add-player-gender\">\n" +
        "                    <option value=\"1\">Female</option>\n" +
        "                    <option value=\"2\">Male</option>\n" +
        "                </select>\n" +
        "                <button class='btn btn-primary btn-md' onclick='prepareAddPlayer("+$event.id+")'>Add</button>\n" +
        "            </div>";

    $("#outsider-box").html($outsiderBox);

    var randomizerBox = getRandomizerBox();
    $("#randomizer-box").html(randomizerBox);

    if($user.roleId == '2'){
    	switch($event.status){
            default:
    		case "0":
				$buttons = "<a class='btn btn-primary btn-md' href='events.html'>Back</a>" +
                "<button class='btn btn-primary btn-md' onclick='addSelfPlayer("+$event.id+")'>Join Event</button>" +
                "<button class='btn btn-primary btn-md' onclick='changeGameStatus("+$event.id+",1)'>Mark as finished</button>" +
				"<button class='btn btn-primary btn-md' onclick='changeGameStatus("+$event.id+",3)'>Hide event</button>" +
                "<button class='btn btn-primary btn-md' onclick='deleteGame("+$event.id+")'>Delete</button>";
				break;
			case "1":
                $buttons = "<a class='btn btn-primary btn-md' href='events.html'>Back</a>" +
                    "<button class='btn btn-primary btn-md' onclick='changeGameStatus("+$event.id+",0)'>Mark as Unfinished</button>" +
                    "<button class='btn btn-primary btn-md' onclick='changeGameStatus("+$event.id+",3)'>Hide event</button>" +
                    "<button class='btn btn-primary btn-md' onclick='deleteGame("+$event.id+")'>Delete</button>";
				break;
			case "3":
                $buttons = "<a class='btn btn-primary btn-md' href='events.html'>Back</a>" +
                    "<button class='btn btn-primary btn-md' onclick='changeGameStatus("+$event.id+",0)'>Make event public</button>" +
                    "<button class='btn btn-primary btn-md' onclick='deleteGame("+$event.id+")'>Delete</button>";
				break;
        }
    } else {
        switch($event.status){
			default:
        	case "0":
                $buttons = "<a class='btn btn-primary btn-md' href='events.html'>Back</a>" +
                    "<button class='btn btn-primary btn-md' onclick='addSelfPlayer("+$event.id+")'>Join Event</button>";
                break;
            case "1":
                $buttons = "<a class='btn btn-primary btn-md' href='events.html'>Back</a>";
                break;
            case "3":
                window.location.href="index.html";
                break;
        }

	}

    $("#event-title").html($eventType);
    $("#event-date").html($event.date);
    $("#game-buttons").append($buttons);

}

// TODO Remove DrawTeamless -> Use DrawPlayer();
function drawTeamless(event) {
	$user = getUser();
    teamless = event.teamless;
	for(i = 0; i < teamless.length; i++) {
        drawPlayer(teamless[i].id, $user, "teamless");
    }
}


function drawTeams(event) {

	teams = event.teams;
    $user = getUser()
 	var $buttons;
	for(i = 1; i < teams.length+1; i++) {
		var team = "<div class='col-3'>" +
				   "<ul id='team"+i+"' class='list-group-item'>" +
				   "</ul>" +
				   "</div>";
		$("#teams").append(team);
		var title = "<h6>Team "+i+"</h6>";
		$("#team"+i).append(title);

		for(j = 0; j < teams[i-1].players.length; j++) {
            drawPlayer(teams[i-1].players[j].id, $user, "team"+i);
            }
	}

	/*
            if($user.roleId === "2") { // ADMIN
                $buttons = "<button onclick='transferPlayer("+teams[i-1].players[j].id+","+null+","+location.hash.substr(1)+")' class='btn btn-primary btn-sm' >Unassign</button>";
            } else if(teams[i-1].players[j].id === $user.playerId) { // OWN PLAYER
                $buttons = "<button onclick='removePlayer("+teams[i-1].players[j].id+")' class='btn btn-primary btn-sm' >Remove</button>";
            } else {
                $buttons = "";
            }

			var player = "<li class='list-group-item' id='player"+teams[i-1].players[j].id+"'>" +
							"<div class='row'>"+
								"<div class='list-group-text'>" +
								teams[i-1].players[j].nickName +
								"</div>" +
								$buttons+
							"</div>"+
							"</li>";
			$("#team"+i).append(player);
		*/

}