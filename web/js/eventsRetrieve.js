function getEvents($status,$amount){
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
                drawEvents(resultObj);
            })
        },
        error: function(status,exception) {
            console.log(status);
            console.log(exception);
        }
    });
}

function drawEvents($events) {
	
	console.log($events);
	for(i = 0; i < $events["games"].length; i++) {
		
		var $game = "<div class='col-sm-4 my-4'>" +
						"<div class='card'>" +
							"<img class='card-img-top' src='img/football.jpg' alt=''>" +
							"<div class='card-body'>" +
								"<h4 class='card-title'>"+$events["games"][i]["typeId"]+"</h4>" +
								"<p class='card-text'>"+$events["games"][i]["date"]+"</p>" +
							"</div>" +
							"<div class='card-footer'>" +
								"<a href='game#"+$events["games"][i]["id"]+"' class='btn btn-primary'>See event &raquo;</a>" +
								"<a href='game#' class='btn btn-primary' style='float:right'>Join</a>" +
							"</div>" +
						"</div>" +
					"</div>";
		
		$("#events").append($game);
		console.log("Event appended");
	}
	
	
	
	
}