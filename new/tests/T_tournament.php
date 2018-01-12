<?php
include("../src/C_team.php");
include("../src/C_tournament.php");


	$test = new tournament("1","6","11/11/18");
	$test->add_team("1","5",["2","3","4","6"]);
	?>
	<pre>
	<?php
	print_r($test->retrieve());
	?>
	</pre>
	<?php

?>