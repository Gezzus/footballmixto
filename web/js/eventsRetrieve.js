function getEvents($status,$amount,$id){
    $.ajax({
        url: "/src/api/eventsHandler.php",
        type: "GET",
        data: {
            "status" : $status,
            "amount": $amount
        },
        dataType: "html",
        async: false,
        success: function(result){
            var resultObj = JSON.parse(result);

            $(document).ready(function(){
                drawEvents(resultObj,$id);
            })
        },
        error: function(status,exception) {
            console.log(status);
            console.log(exception);
        }
    });
}

function drawEvents($events,$id) {
	var $user = getUser();
	var $gamesResponse = getPlayerGames($user.playerId);
	var $playedGames = $gamesResponse.games;
    console.log($playedGames);

	var $eventType;
	var $eventImage;
    var $game;

    if($events["status"] == "failed") {
        var $text = "<div class='col my-4'>" +
                        "<p class='display-3 mt-4' style='color: #95A3B3;'> We couldn't find any events ;( <br>Please create some </p>" +
                    "</div>";
        $("#"+$id).append($text);
        return false;
    }

	for(i = 0; i < $events["games"].length; i++) {

	    switch ($events["games"][i]["typeId"]) {
            case "1":
                $eventType = "Football 5 vs 5 <br> (One field)";
                $eventImage = "football1"
                break;
            case "2":
                $eventType = "Football 5 vs 5 <br> (Two fields)";
                $eventImage = "football2"
                break;
            case "3":
                $eventType = "Tennis 1 vs 1";
                $eventImage = "tennis1"
                break;
            case "4":
                $eventType = "Tennis 2 vs 2";
                $eventImage = "tennis2"
                break;
        }

        switch($id) {
            case "events":
                for($j = 0; $j < $playedGames.length; $j++) {
                    if($events["games"][i]["id"] === $playedGames[$j]["id"]){
                        var $played = true;
                    }
                }

                if($played === true){
                    $buttons = "";
                } else {
                    $buttons =  "<button onclick='addSelfPlayer("+$events["games"][i]["id"]+")' class='btn btn-primary' style='float:right'>Join</button>";
                }

                $game = "<div class='col-sm-4 my-4'>" +
                                "<div class='card'>" +
                                    "<img class='card-img-top' src='img/"+$eventImage+".jpg' alt=''>" +
                                        "<div class='card-body' id='event-info'>" +
                                        "<h4 class='card-title'>"+$eventType+"</h4>" +
                                        "<p class='card-text'>"+$events["games"][i]["date"]+"</p>" +
                                        "</div>" +
                                    "<div class='card-footer'>" +
                                        "<a href='game.html#"+$events["games"][i]["id"]+"' class='btn btn-primary'>See event &raquo;</a>" +
                                        $buttons +
                                    "</div>" +
                                "</div>" +
                            "</div>";
                break;

            case "oldEvents":

                for($j = 0; $j < $playedGames.length; $j++) {
                    if($events["games"][i]["id"] === $playedGames[$j]["id"]){
                        var $played = true;
                    }
                }

                if($played === true){
                    $participatedBadge = "<span class='badge badge-primary badge-pill'>Participated</span>";
                } else {
                    $participatedBadge = "";
                }


                $game = "<li class='list-group-item d-flex justify-content-between align-items-center'>" +
                                $eventType + " - " + $events["games"][i]["date"] +
                                 $participatedBadge +
                                "<a href='game.html#"+$events["games"][i]["id"]+"' class='btn btn-primary' style='float:right' >See event &raquo;</a>" +

                        "</li>";
                break;
        }

		$("#"+$id).append($game);
	    $played = false;
	}
}
