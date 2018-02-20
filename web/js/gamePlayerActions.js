function addSelfPlayer($gameId) {
    var $user = getUser();
    $.ajax({
        url: "/src/api/gameHandler.php",
        type: "GET",
        data: {
            "action": "add",
            "id": $gameId,
            "playerId": $user.playerId
        },
        dataType: "html",
        async: false,
        success: function (result) {
            console.log(result);
            try {
                $result = JSON.parse(result)
            } catch (err) {
                $error = "<div class=\"alert alert-danger alert-dismissable\" >" +
                    "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>" +
                    "<strong>Hey!</strong> Shit hit the ceiling. Speak with Alessandro" +
                    "</div>"
                $("#event-info").append($error);
            }
            $(document).ready(function () {
                if ($result.status == "failed") {
                    $(document).ready(function () {
                        $error = "<div class=\"alert alert-success alert-dismissable\" >" +
                            "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>" +
                            "<strong>Hey!</strong> You are already subscribed to this event." +
                            "</div>"
                        $("#event-info").append($error);

                    })
                    return false;
                } else if ($result.status == "success") {
                    if(window.location.pathname === "/web/game.html"){
                        drawPlayer($result.player.id, $user, "teamless");
                    } else {
                        window.location.href = "game.html#"+$gameId;
                    }
                } else {
                    $error = "<div class=\"alert alert-danger alert-dismissable\" >" +
                        "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>" +
                        "<strong>Hey!</strong> Shit hit the ceiling. Speak with Alessandro" +
                        "</div>"
                    $("#event-info").append($error);
                }
            })
        },
        error: function (status, exception) {
            console.log(status);
            console.log(exception);
        }
    });
}

function prepareAddPlayer($gameId){
    $user = getUser();
    var $playerName = $("#event-add-player-name").val();
    var $playerGender = $("#event-add-player-gender").val();
    console.log("GameID: "+$gameId+" Player Name: "+$playerName+" Player Gender: "+$playerGender);
    $result = addPlayer($gameId,$playerName,$playerGender);
    console.log($result);
    if($result.status === "success") {
        $(document).ready(function(){
            drawPlayer($result.player.id, $user,"teamless");
        })
    } else if($result.status === "failed") {
        $error = "<div class=\"alert alert-success alert-dismissable\" >" +
            "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>" +
            "<strong>Hey!</strong> This player is already subscribed" +
            "</div>"
        $("#event-error").append($error);
    } else {
        $error = "<div class=\"alert alert-danger alert-dismissable\" >" +
            "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>" +
            "<strong>Hey!</strong> Shit hit the ceiling. Speak with Alessandro" +
            "</div>"
        $("#event-error").append($error);
    }
}

function addPlayer($gameId, $nickName, $gender){
      $user = getUser();
      $result = $.ajax({
          url: "/src/api/gameHandler.php", 
          type: "GET",
          data: {
        	  "action" : "add",
        	  "id": $gameId,
        	  "nickName": $nickName,
        	  "genderId" : $gender
          },
          dataType: "html",
          async: false,
          success: function(result) {
              console.log(result);
              try {
                  $result = JSON.parse(result);
              } catch (err) {
                  $error = "<div class=\"alert alert-danger alert-dismissable\" >" +
                      "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>" +
                      "<strong>Hey!</strong> Shit hit the ceiling. Speak with Alessandro" +
                      "</div>"
                  $("#event-error").append($error);
              }
          },
          error: function(status,exception) {
        	  console.log(status);
        	  console.log(exception);
            }
      });
    return  JSON.parse($result.responseText);
}

function removePlayer($playerId) {
    $.ajax({
        url: "/src/api/gameHandler.php",
        type: "GET",
        data: {
            "action" : "remove",
            "id": location.hash.substr(1),
            "playerId": $playerId
        },
        dataType: "html",
        async: false,
        success: function(result){
            console.log(result);
            try {
                var $result = JSON.parse(result)
            } catch(err) {
                $error ="<div class=\"alert alert-danger alert-dismissable\" >" +
                    "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>" +
                    "<strong>Hey!</strong> Shit hit the ceiling. Speak with Alessandro" +
                    "</div>"
                $("#event-error").append($error);
            }

            $(document).ready(function(){
                if($result.status == "success"){
                	erasePlayer($result.playerId,"player");

                } else if($result.status == "failed"){
                    $error ="<div class=\"alert alert-error alert-dismissable\" >" +
                        "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>" +
                        "<strong>Hey!</strong> Something happened while trying to remove you. Please refresh the page and contact Alessandro." +
                        "</div>"
                    $("#event-error").append($error);
                }
            })
        },
        error: function(status,exception) {
            console.log(status);
            console.log(exception);
        }
    });
}


function getPlayerGames($playerId){
    var $playerGames = $.ajax({
        url: "/src/api/playerHandler.php",
        type: "GET",
        data: {
            "action" : "getGames",
            "id": $playerId
        },
        dataType: "html",
        async: false,
        success: function(result){
            try {
                $result = JSON.parse(result)
                if($result.status="success"){

                } else {
                    $error ="<div class=\"alert alert-danger alert-dismissable\" >" +
                        "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>" +
                        "<strong>Hey!</strong> Something happened when we attempted to get your games." +
                        "</div>"
                    $("#error").append($error);
                }
            } catch(err) {
                $error ="<div class=\"alert alert-danger alert-dismissable\" >" +
                    "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>" +
                    "<strong>Hey!</strong> Shit hit the ceiling. Speak with Alessandro" +
                    "</div>"
                $("#error").append($error);
            }
        },
        error: function(status,exception) {
            console.log(status);
            console.log(exception);
        }
    });
    return JSON.parse($playerGames.responseText);
}


function putPlayerTeam($playerId, $teamId, $gameId) {
    var $playerGames = $.ajax({
        url: "/src/api/gameHandler.php",
        type: "GET",
        data: {
            "action" : "transfer",
            "playerId": $playerId,
            "gameId": $gameId,
            "teamId": $teamId
        },
        dataType: "html",
        async: false,
        success: function(result){
            try {
                $result = JSON.parse(result)
            } catch(err) {
                $error ="<div class=\"alert alert-danger alert-dismissable\" >" +
                            "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>" +
                            "<strong>Hey!</strong> Shit hit the ceiling. Speak with Alessandro" +
                        "</div>"
                $("#event-error").append($error);
            }
        },
        error: function(status,exception) {
            console.log(status);
            console.log(exception);
        }
    });
    return JSON.parse($playerGames.responseText);
}


function transferPlayer($playerId, $teamId, $gameId){
    var $user = getUser();
    //console.log("GOT IN HERE: "+$playerId+" "+$teamId+" "+$gameId);
    var $result = putPlayerTeam($playerId, $teamId, $gameId);
    if($result.status === "success") {
        var $location = "team"+$teamId;
        var $oldLocation = "player"+$playerId;
        console.log("PlayerID: "+$result.player[0].playerId);
        if($teamId === null) {
            erasePlayer($playerId, "player");
            drawPlayer($playerId, $user, "teamless");
        } else {
            erasePlayer($playerId, "player")
            drawPlayer($playerId, $user, $location);
        }
    } else {
        $error ="<div class=\"alert alert-danger alert-dismissable\" >" +
            "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>" +
            "<strong>Hey!</strong> Shit hit the ceiling. Speak with Alessandro" +
            "</div>"
        $("#event-error").append($error);
    }
}
