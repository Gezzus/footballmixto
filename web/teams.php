<script>
function team_change_submit(value,id)
{
    $.("#entry_form_team_id") = id;
    $.("#entry_form_team_value") = value;
    $.("#team_change_form").submit();
}
</script>

<?php

function retrieveTeam($team, $size , $activeLink, $color, $marginleft="2"){

$task_retrieve = "SELECT * FROM Football WHERE team='$team'";
$task_query_retrieve = mysqli_query($activeLink,$task_retrieve);
echo mysqli_error($activeLink);
$task_query_row = mysqli_fetch_assoc($task_query_retrieve);
$tasks_query_ammount = mysqli_num_rows($task_query_retrieve);


 for ($i=0; $i < $tasks_query_ammount; $i++) { 

                if($team == "0")
                {
                    if($task_query_row["sex"] == "Male")
                    {
                        $color = "lightblue";
                    }
                    if($task_query_row["sex"] == "Female")
                    {
                        $color = "pink";
                    }
                    if($task_query_row["sex"] == "Im offended by this")
                    {
                        $color = "lightgreen";
                    }
                } ?>  
                <div class="container" style="width:<?=$size;?>;background-color:<?=$color;?>;border-radius:5px;margin:2px;margin-left:<?=$marginleft?>!important">
                <font size="2">
                <h6 class="" style="background-color:<?=$color;?>;border-color:<?=$color;?>;margin-top:5px!important;margin-bottom:0px!important;"><b><?php echo $task_query_row["name"]?></b></h6>
                
                <br>
                
                <p class="" style="background-color:<?=$color;?>;border-color:<?=$color;?>">
                     <b>Skill: </b><?php echo $task_query_row["skill"]?>    <br>
                     <b>Sex: </b><?php echo $task_query_row["sex"]?>        <br>
                     <b>Schedule: </b><?php echo $task_query_row["schedule"]?>
                </p>
                <?php
                if(isset($_SESSION['id']) && isAdmin($_SESSION['id'],$activeLink))
                {
                ?>
                <button onclick="team_change_submit(<?=$task_query_row['id'];?>,1)" type="button" style="background-color:<?=$color?>;border-color:<?=$color;?>">1</button>
                <button onclick="team_change_submit(<?=$task_query_row['id'];?>,2)" type="button" style="background-color:<?=$color?>;border-color:<?=$color;?>">2</button>
                <button onclick="team_change_submit(<?=$task_query_row['id'];?>,3)" type="button" style="background-color:<?=$color?>;border-color:<?=$color;?>">3</button>
                <button onclick="team_change_submit(<?=$task_query_row['id'];?>,4)" type="button" style="background-color:<?=$color?>;border-color:<?=$color;?>">4</button>
                <button onclick="team_change_submit(<?=$task_query_row['id'];?>,0)" type="button" style="background-color:<?=$color?>;border-color:<?=$color;?>">N</button>
                <?php
                }
                ?>
                </font>
                </div>

    <?php
     $task_query_row = mysqli_fetch_assoc($task_query_retrieve);
    }
}

function retrieve($sex, $activeLink){

$task_retrieve = "SELECT * FROM Football WHERE sex='$sex'";
$task_query_retrieve = mysqli_query($activeLink,$task_retrieve);
echo mysqli_error($activeLink);
$task_query_row = mysqli_fetch_assoc($task_query_retrieve);
$tasks_query_ammount = mysqli_num_rows($task_query_retrieve);

echo $tasks_query_ammount;

}


?>
<form id="team_change_form" action="operatory.php" method="POST">
    <input hidden id="entry_form_team_id>" name="team"></input>
    <input hidden id="entry_form_team_id>" name="team"></input>
</form>
<html>
<div class="container-fluid" style="border-radius:5px;margin:2px">      
            

              <div class="row" style="width:100%;padding-top:1%;padding-left:1%;">
                  <div class="col" style="border:1px solid;border-color:#5D2E8C;border-radius:5px;margin:10px;background-color:white">
                  <h5>Teamless: </h5>
                  <hr style="margin:0px">
                      <div class="row">
                        <!--<?php retrieveTeam('0',"20%",$link,"#FFA69E"); ?>-->
                      </div>
                  </div>


                  <div class="col-md-3">

                  
                    <div class="row" style="border:1px solid;border-color:#5D2E8C;border-radius:5px;margin:10px;background-color:white;padding:10px">
                    <font size="2">
                        <h5>Join us!</h5>
                        <label>Use the following form to subscribe to our football matches.</label>
                        <hr style="padding:2px">
                            <?php 
                          if(active_session() == 1)
                          {
                          ?>
                        <form action="add.php" method="POST" class="form-group" >
                        <div class="row alert alert-primary>">
                            <label class="alert-heading" style="width:100%" ><b>Your name: </b></label>
                            <input type="input" name="name" class="alert alert-secondary" style="width:75%; padding:0.2rem;"></input>
                            <label class="alert-heading" style="width:100%" ><b>Skill level:</b></label>
                            <select name="skill" class="form-control form-control-sm" style="width:60%">
                                <option>I know how to play.</option>
                                <option>Im ok.</option>
                                <option>I know what a ball is.</option>
                                <option>I suck.</option>
                            </select>
                            <label class="alert-heading" style="width:100%" ><b>Sex:</b></label>
                            <select name="sex" class="form-control form-control-sm" style="width:60%">
                                <option>Male</option>
                                <option>Female</option>
                                <option>Im offended by this</option>
                            </select>
                            <h12 class="alert-heading"  style="width:100%" ><b>Availability:</b></h12>
                            <select name="schedule" class="form-control form-control-sm" style="width:60%">
                                <option>I dont care</option>
                                <option>19:00</option>
                                <option>19:30</option>
                                <option>20:00</option>
                            </select><hr>
                            <button type="input" class="btn btn-secondary" style="float:left;background-color:white;color:black!important"><small>Add</small></button>
                        </div>
                        </form>
                        <?php

                        }
                        else
                        {
                            ?>
                            <h5 class="alert alert-secondary"> Log-In to see the subscription form</h5>
                            <?php
                        }
                        ?>
                    </font>
                    </div>
                    <div class="row" style="border:1px solid;border-color:#5D2E8C;border-radius:5px;margin:10px;background-color:white;padding:5px;">
                        <div class="container ">
                            <h5>We are currently:</h5><br>
                            
                            <p>
                            <!--<b>Women:</b><?php retrieve('Female',$link) ?><br>
                            <b>Men:</b><?php retrieve('Male',$link) ?><br>-->
                            </p>
                        </div>
                    </div>
                    
                  
                  </div>  <!-- Col 4 Div -->


                  </div> <!-- Row Div -->
                  <hr>
                  
                  
                  <hr style="margin:0px">
                  
        </div> <!-- Container Div -->
</html>