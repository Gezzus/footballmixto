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
            console.log(result);
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
}