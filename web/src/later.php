<?php 



  function displayPlayers($thisTeam,$event,$activeLink)
  {
    for ($i=0; $i < count($thisTeam); $i++) { ?>
          <div class='row team' style='background: lightblue'>
          <div class='col-9'>
            <label>".$thisTeam["nickname"][$i]."</label>

          </div>
          <?php if(isset($_SESSION['id']) && isAdmin($_SESSION['id'],$activeLink)) {?>
                  <div class='col-3'>
                  <form method='POST' action='src/operatory.php?action=teamchange&id=".$event->id."'>
                  <input name='id' value=".$thisTeam["id"][$i]." hidden></input>

                  <button class='content' name='team' value='5'>R</button>
                  </form>
            
                  </div>
          <?php } ?> 
          </div>
          <?php
    }
  }

  

  if(active_session() == 1){
    $self_player_retrieve = "SELECT playerId,player.nickName FROM user
LEFT JOIN player ON user.playerId = player.id where user.id='".$_SESSION['id']."'";
    $self_player_retrieve_query = mysqli_query($link,$self_player_retrieve);
    $self_player_retrieve_row = mysqli_fetch_assoc($self_player_retrieve_query);
  }
 
?>
