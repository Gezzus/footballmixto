function addSelfPlayer($gameId){
    var $user = getUser();
    $.ajax({
        url: "/src/api/gameHandler.php",
        type: "GET",
        data: {
            "action" : "add",
            "id": $gameId,
            "playerId": $user.playerId
        },
        dataType: "html",
        async: false,
        success: function(result){
            console.log(result);
            var $result = JSON.parse(result);

            $(document).ready(function(){
                if($result.status == "failed"){
                    $(document).ready(function(){
                        $error ="<div class=\"alert alert-success alert-dismissable\" >" +
                            "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>" +
                            "<strong>Hey!</strong> You are already subscribed to this event." +
                            "</div>"
                        $("#event-info").append($error);

                    })
                    return false;
                } else {
                    drawPlayer($result.player, $user,"teamless");
                }
            })
        },
        error: function(status,exception) {
            console.log(status);
            console.log(exception);
        }
    });
}

/*function addPlayer($nickName, $gender){
      $user = getUser();
      $.ajax({
          url: "/src/api/gameHandler.php", 
          type: "GET",
          data: {
        	  "action" : "add",
        	  "id": location.hash.substr(1),
        	  "nickName": $nickName,
        	  "gender" : $gender
          },
          dataType: "html",
          async: false,
          success: function(result){
        	  console.log(result);
        	  var $player = JSON.parse(result);
        	  $(document).ready(function(){
                  drawPlayer($player, $user,"teamless");
        	  })
          },
          error: function(status,exception) {
        	  console.log(status);
        	  console.log(exception);
            }
      });
}*/

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
            var result = JSON.parse(result);

            $(document).ready(function(){
                if(result.status == "success"){

                } else if(result.status == "failed"){
                    $error ="<div class=\"alert alert-error alert-dismissable\" >" +
                        "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>" +
                        "<strong>Hey!</strong> Something happened while trying to remove you. Please refresh the page and contact Alessandro." +
                        "</div>"
                    $("#event-info").append($error);
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
            console.log(result); // delete later
        },
        error: function(status,exception) {
            console.log(status);
            console.log(exception);
        }
    });
    return JSON.parse($playerGames.responseText);
}
