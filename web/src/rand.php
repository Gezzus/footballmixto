<?php
include("connect.php");
session_start();

include("users.php");

echo $_POST['pool']." <br><br> Amount:  ".$_POST['amount'];

$winners = players_return_random($_POST['pool'],$_POST['amount'],$_SESSION['id'],$link);

$_SESSION['winners'] = implode(",",$winners);

#echo $_SESSION['winners'];

header("location:../randomizer.php?add=".$_POST['pool']);
?>
