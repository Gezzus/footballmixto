/*function changeGameStatus($id, $status){
    //var $user = getUser();
    $.ajax({
        url: "/src/api/gameHandler.php",
        type: "GET",
        data: {
            "action" : "changeStatus",
            "id": $id,
            "status": $status
        },
        dataType: "html",
        async: false,
        success: function(result){
            console.log(result);
            try {
                $result = JSON.parse(result)
                if($result.status === "success") {
                    $error ="<div class=\"alert alert-success alert-dismissable\" >" +
                        "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>" +
                        "<strong>Hey!</strong> The game has been marked as finished" +
                        "</div>";
                    $("#event-info").append($error);
                } else {
                    $error ="<div class=\"alert alert-danger alert-dismissable\" >" +
                        "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>" +
                        "<strong>Hey!</strong> The game could not be closed." +
                        "</div>";
                    $("#event-info").append($error);
                }

            } catch(err) {
                $error ="<div class=\"alert alert-danger alert-dismissable\" >" +
                    "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>" +
                    "<strong>Hey!</strong> Shit hit the ceiling. Speak with Alessandro" +
                    "</div>";
                $("#event-info").append($error);
            }
        },
        error: function(status,exception) {
            console.log(status);
            console.log(exception);
        }
    });
}*/

