function getPlayer($playerId) {
    $response = $.ajax({
        url: "/src/api/playerHandler.php",
        type: "GET",
        data: {
            "action": "get",
            "id": $playerId
        },
        dataType: "html",
        async: false,
        success: function(result){
                console.log(result);
        },
        error: function(status,exception) {
        console.log(status);
        console.log(exception);
    }});
    return JSON.parse($response.responseText);
}



