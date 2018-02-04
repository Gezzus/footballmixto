function addSelfPlayer(){
    var $user = getUser();
    $.ajax({
        url: "/src/api/gameHandler.php",
        type: "GET",
        data: {
            "action" : "add",
            "id": location.hash.substr(1),
            "playerId": $user.playerId
        },
        dataType: "html",
        async: false,
        success: function(result){
            console.log(result);
            var $result = JSON.parse(result);

            $(document).ready(function(){
                if($result.status === null){
                    // TODO Error handling (Alert?)
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

function addPlayer($nickName, $gender){
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
            var resultObj = JSON.parse(result);

            $(document).ready(function(){

            })
        },
        error: function(status,exception) {
            console.log(status);
            console.log(exception);
        }
    });
}
