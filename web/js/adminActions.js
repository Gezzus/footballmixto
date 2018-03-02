function adminConsole($context){
    $.ajax({
        url: "/src/api/adminHandler.php",
        type: "POST",
        data: {
            "context" : $context
        },
        dataType: "html",
        async: false,
        success: function(result){
            console.log(result);
            try {
                $response = JSON.parse(result);
                console.log($response);
                if($response.status === "success") {
                    $error ="<div class=\"alert alert-success alert-dismissable\" >" +
                        "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>" +
                        "<strong>Success!</strong> Or something like that." +
                        "</div>";
                    $(document).ready(function() {
                        $("#admin-console-info").append($error);
                        $("#admin-console-result").append("<pre><code>"+JSON.stringify($response.message,null,4)+"</code></pre>");
                    })
                } else {
                    $error = "<div class=\"alert alert-danger alert-dismissable\" >" +
                        "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>" +
                        "<strong>Hey!</strong> Error." +
                        "</div>";
                    $(document).ready(function () {
                        $("#admin-console-info").append($error);
                        $("#admin-console-result").append($response.message);
                    })
                }

            } catch(err) {
                $error ="<div class=\"alert alert-danger alert-dismissable\" >" +
                    "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>" +
                    "<strong>Hey!</strong> Shit hit the ceiling. Speak with Alessandro" +
                    "</div>";
                $("#admin-console-info").append($error);
                $("#admin-console-result").append($response.message);
            }
        },
        error: function(status,exception) {
            console.log(status);
            console.log(exception);
        }
    });
}

function adminConsolePrepare() {
    adminConsole($("#admin-console-context").val());
}
