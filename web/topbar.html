
<div class="row"">
	<div class="col top">
	<? if((active_session() == 1) && ($_SERVER["REQUEST_URI"] == "/index.php")){ ?>
		<a class="topmenu" href="create.php" ><button class="topmenu">Add new</button></a>
	 <?php }
	
	if((active_session() == 1) && ($_SERVER["REQUEST_URI"] == "/create.php")){ ?>
		<a class="topmenu" href="index.php" ><button class="topmenu">Back</button></a>
	<?}

	/*$gamePath = pathinfo($_SERVER["REQUEST_URI"],PATHINFO_DIRNAME)."/".pathinfo($_SERVER["REQUEST_URI"],PATHINFO_FILENAME).".php";
	$gamePath = $_SERVER["REQUEST_URI"];*/

	if((active_session() == 1) && ($_SERVER["REQUEST_URI"] == "/game.php")){ ?>
		<form style="padding:0px;margin:0px" method="POST" action="../src/join.php">
            <button class="topmenu" style="float:left">Join Event</button>
            <input hidden value="<?=$_GET['id']?>" name="gameId">
        </form>

       
	<?

		if(isAdmin($_SESSION['id'],$link)){
				$gameProperties = query_retrieve_game_property($_GET['id'],$link,"doodleurl");
			?>
			<form style="padding:0px;margin:0px" method="POST" action="../src/deletegame.php">
            <button style="float:left" class="topmenu">Delete Event</button>
            <input hidden value="<?=$_GET['id']?>" name="id">
        	</form>
        	<form style="padding:0px;margin:0px" method="POST" action="<?= $_SERVER["REQUEST_URI"] ?>&error=3">
            <button style="float:left" class="topmenu">Admin only</button>
            <input hidden value="<?=$_GET['id']?>" name="id">
        	</form>

        	<form style="padding:0px;margin:0px" method="POST" action="../src/crawler.php">
            <button class="topmenu" style="float:left">Sync Doodle</button>
            <input hidden value="<?=$gameProperties['doodleurl']?>" name=doodleUrl>
            <input hidden value="<?=$_GET['id']?>" name="game_id">
        	</form>
			<?
		}
	}
	?>
	</div>
</div>

