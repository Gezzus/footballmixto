<?php

include("../src/C_player.php");

	$test = new player("1","thisNickname","Female");
	
	?>
	<pre>
	<?php
	print_r($test->retrieve());
	?>
	</pre>
	<?php

	
?>