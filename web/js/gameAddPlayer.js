
function addPlayer($nickName, $gender){
      $.ajax({
          url: "/src/api/gameHandler.php", 
          type: "GET",
          data: {
        	  "action" : "add",
        	  "gameId": location.hash.substr(1),
        	  "nickName": $nickName,
        	  "gender" : $gender
          },
          dataType: "html",
          async: false,
          success: function(result){
        	  console.log(result);
        	  var resultObj = JSON.parse(result);
        	  
        	  $(document).ready(function(){
        		  drawPlayer(resultObj);
        	  })
          },
          error: function(status,exception) {
        	  console.log(status);
        	  console.log(exception);
            }
      });
}


function drawPlayer(resultObj) {
	var player = "<div id='player"+resultObj.teamId+"' class='col content player'>"+resultObj.nickName+"</div>";
	$("#team"+resultObj.teamId).append(player);
	console.log("Drawing player");
}