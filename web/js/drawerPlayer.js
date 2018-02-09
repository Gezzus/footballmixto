function drawPlayer($player, $user, $location){

    console.log($player);
    console.log($user);
    switch($player.levelId){
        case "1":
            $level = "I know how to play";
            break;
        case "2":
            $level = "I'm ok";
            break;
        case "3":
            $level = "I know what a ball is.";
            break;
        case "4":
            $level = "I suck.";
            break;
    }

    switch($player.genderId){
        case "1":
            $gender = "Female";
            break;
        case "2":
            $gender = "Male";
            break;
    }

    if($location === "teamless") {

        if($user.roleId === "2") { // ADMIN
            $lowerButtons = "<button class='btn btn-primary btn-sm' onclick='removePlayer("+$player.id+")' >Remove</button>";
            $sideButtons =  "<button class='btn btn-primary btn-sm' >1</button><br>"+
                "<button class='btn btn-primary btn-sm' >2</button><br>" +
                "<button class='btn btn-primary btn-sm' >3</button><br>" +
                "<button class='btn btn-primary btn-sm' >4</button>"
        } else if($player.id === $user.playerId) { // OWN PLAYER
            $lowerButtons = "<button class='btn btn-primary btn-sm' onclick='removePlayer("+$player.id+")' >Remove</button>";
            $sideButtons = "";
        } else {
            $lowerButtons = "";
            $sideButtons = "";
        }

        var player = "<div id='player"+$player.id+"' class='col-sm-3'>" +
                    "<div class='business-card'>" +
                        "<div class='media'>" +
                            "<div class='media-left'>" +
                                "<img class='media-object rounded-circle profile-img' src='http://s3.amazonaws.com/37assets/svn/765-default-avatar.png'><br>" +
                                "<center>"+$lowerButtons+"</center>" +
                                "</div>" +
                            "<div class='media-body'>" +
                                "<h4 class='card-title'>"+$player.nickName+"</h4>" +
                                "<small><p class='card-text'>"+$level+"</p></small>" +
                                "<p class='card-text'>"+$gender+"</p>" +
                            "</div>" +
                            "<div class='media-menu-lower'>" +
                                $sideButtons+
                            "</div>" +
                        "</div>" +
                    "</div>" +
                "</div>";
    } else {

        if($user.roleId === "2") { // ADMIN
            $buttons = "<button onclick='transferPlayer("+$player.id+", NULL,"+location.hash.substr(1)+")' class='btn btn-primary btn-sm' >Unasign</button>";
        } else if($player.id === $user.playerId) { // OWN PLAYER
            $buttons = "<button onclick='transferPlayer("+$player.id+", NULL,"+location.hash.substr(1)+")' class='btn btn-primary btn-sm' >Unasign</button>";
        } else {
            $buttons = "";
        }

        player = "<li class='list-group-item' id='player"+$player.id+"'>" +
                        $player.nickName+$buttons+
                "</li>";
    }

    $("#"+$location).append(player);

}

function erasePlayer($playerId,$location) {
	console.log("Erasing: #"+$location+$playerId);
	$("#"+$location+$playerId).remove();
}
