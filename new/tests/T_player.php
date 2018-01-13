<?php
include("../src/N_connect.php");
include("../src/Player.php");

$player2data = ["newNi12114k","2"];
$player1data = "2";

	$test1 = new player;
	print_r($test1->__construct_existing($player2data,$mysqli));
	$test2 = new player;
	print_r($test2->__construct_new($player2data,$mysqli));

	?>
	<pre>
	<?php
	print_r($test1->retrieve());
	echo "<br>";
	#print_r($test2->retrieve());
	
	?>
	</pre>
	<?php

	
?>