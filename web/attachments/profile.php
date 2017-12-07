<?php
session_start();

print_r($_FILES['image']);

#echo basename($_FILES['userfile']);

#echo file_put_contents("attachments/".$_SESSION['id'].".png", file_get_contents($_FILES['image']));

file_put_contents($_SESSION['id'],file_get_contents($_FILES['image']['tmp_name']));

header("location:../profile.php");
?>