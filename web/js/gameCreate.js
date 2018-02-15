function prepareGame() {
  console.log($("#newTypeId").val()+", "+$("#newDate").val()+", "+ $("#newTime").val())
  createGame($("#newTypeId").val(), $("#newDate").val(), $("#newTime").val());
}

function createGame($typeId, $date, $time){
    $.ajax({
          url: "/src/api/gameHandler.php", 
          type: "GET",
          data: {
        	  "action" : "createGame",
        	  "typeId": $typeId,
            "date": $date,
            "time": $time
          },
          dataType: "html",
          async: false,
          success: function(result){
        	  console.log(result);
        	  var $result = JSON.parse(result);

        	  $(document).ready(function(){
        	  	 if($result.status == "success") {
                window.location.href="game.html#"+$result.game.id;
               }
        	  })
          },
          error: function(status,exception) {
        	  console.log(status);
        	  console.log(exception);
            }
      });

}