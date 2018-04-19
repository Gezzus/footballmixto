function drawPlayer($playerId, $user, $location){

    $result = getPlayer($playerId);
    $player = $result.player;
    $game = getMetaById(location.hash.substr(1));


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
        default:
            $level = "Undefined."
            break;    
    }

    switch($player.genderId){
        case "1":
            $gender = "Female";
            break;
        case "2":
            $gender = "Male";
            break;
        default:
            $gender = "Undefined";
            break;
    }

    if($location === "teamless") {

        if($user.roleId === "2") { // ADMIN
           switch($game.typeId){
            case "default":
            case "1":
            case "2":
            $sideButtons =  "<button onclick='transferPlayer("+$player.id+",1,"+location.hash.substr(1)+")' class='btn btn-primary btn-sm' >1</button><br>"+
                "<button onclick='transferPlayer("+$player.id+",2,"+location.hash.substr(1)+")' class='btn btn-primary btn-sm' >2</button><br>" +
                "<button onclick='transferPlayer("+$player.id+",3,"+location.hash.substr(1)+")' class='btn btn-primary btn-sm' >3</button><br>" +
                "<button onclick='transferPlayer("+$player.id+",4,"+location.hash.substr(1)+")' class='btn btn-primary btn-sm' >4</button>";
                break;
            case "3":
                $sideButtons =  "<button onclick='transferPlayer("+$player.id+",1,"+location.hash.substr(1)+")'  class='btn btn-primary btn-sm' >1</button><br>"+
                    "<button onclick='transferPlayer("+$player.id+",2,"+location.hash.substr(1)+")'class='btn btn-primary btn-sm' >2</button><br>";
                break;
            case "4":
                $sideButtons =  "<button onclick='transferPlayer("+$player.id+",1,"+location.hash.substr(1)+")' class='btn btn-primary btn-sm'>1</button><br>"+
                    "<button onclick='transferPlayer("+$player.id+",2,"+location.hash.substr(1)+")' class='btn btn-primary btn-sm' >2</button><br>";

                break;
            case "5":
                $sideButtons =  "<button onclick='transferPlayer("+$player.id+",1,"+location.hash.substr(1)+")' class='btn btn-primary btn-sm'>1</button><br>"+
                    "<button onclick='transferPlayer("+$player.id+",2,"+location.hash.substr(1)+")' class='btn btn-primary btn-sm' >2</button><br>";
                break; 
            }
            $lowerButtons = "<button class='btn btn-primary btn-sm' onclick='removePlayer("+$player.id+")' >Remove</button>";
        
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
                                "<img class='media-object rounded-circle profile-img' onerror=\"this.src='http://s3.amazonaws.com/37assets/svn/765-default-avatar.png'\" src='attachments/"+$player.id+"'><br>" +
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
            $buttons = "<button onclick='transferPlayer("+$player.id+","+null+","+location.hash.substr(1)+")' class='btn btn-primary btn-sm' >Unassign</button>";
        } else if($player.id === $user.playerId) { // OWN PLAYER
            $buttons = "<button onclick='removePlayer("+$player.id+")' class='btn btn-primary btn-sm' >Remove</button>";
        } else {
            $buttons = "";
        }

        var player = "<li class='list-group-item' id='player"+$player.id+"'>" +
            "<div class='row'>"+
            "<div class='list-group-text'>" +
            $player.nickName+
            "</div>" +
            $buttons+
            "</div>"+
            "</li>";
    }

    $("#"+$location).append(player);

}

function erasePlayer($playerId,$location) {
	console.log("Erasing: #"+$location+$playerId);
	$("#"+$location+$playerId).remove();
}
