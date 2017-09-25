<?php



function retrieveTeam($team, $size , $activeLink, $color, $marginleft="2"){

$task_retrieve = "SELECT * FROM Football WHERE team='$team'";
$task_query_retrieve = mysqli_query($activeLink,$task_retrieve);
echo mysqli_error($activeLink);
$task_query_row = mysqli_fetch_assoc($task_query_retrieve);
$tasks_query_ammount = mysqli_num_rows($task_query_retrieve);


 for ($i=0; $i < $tasks_query_ammount; $i++) { 
    ?>
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
                if(isset($_SESSION['id']) && $_SESSION['id'] == 25)
                {
                ?>
                <form action="footballmixto/operatory.php" method="POST">
                <input hidden name="id" value="<?=$task_query_row['id'];?>"></input>
                <button style="background-color:<?=$color?>;border-color:<?=$color;?>" name="team" value="1" >1</button>
                <button style="background-color:<?=$color?>;border-color:<?=$color;?>" name="team" value="2" >2</button>
                <button style="background-color:<?=$color?>;border-color:<?=$color;?>" name="team" value="3" >3</button>
                <button style="background-color:<?=$color?>;border-color:<?=$color;?>" name="team" value="4" >4</button>
                <button style="background-color:<?=$color?>;border-color:<?=$color;?>" name="team" value="0" >U</button>
                </form>
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