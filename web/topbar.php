<div class="row"">
	<div class="col top">
	<? if((active_session() == 1) && ($_SERVER["REQUEST_URI"] == "/web/index.php")){ ?>
		<button class="team content"><a href="create.php" >Add new</a></button>
	 <?php }
	
	if((active_session() == 1) && ($_SERVER["REQUEST_URI"] == "/web/create.php")){ ?>
		<button class="team content"><a href="index.php" >Back</a></button>
	<?}

	$gamePath = pathinfo($_SERVER["REQUEST_URI"],PATHINFO_DIRNAME)."/".pathinfo($_SERVER["REQUEST_URI"],PATHINFO_FILENAME).".php";

	if((active_session() == 1) && ($gamePath == "/web/game.php")){ ?>
		<form style="padding:0px;margin:0px" method="POST" action="src/join.php">
            <button class="team content" style="float:left">Join Event</button>
            <input hidden value="<?=$_GET['id']?>" name="gameId"></input>
        </form>
	<?

		if(isAdmin($_SESSION['id'],$link)){
			?>
			<form style="padding:0px;margin:0px" method="POST" action="src/deletegame.php">
            <button style="float:left" class="team content">Delete Event</button>
            <input hidden value="<?=$_GET['id']?>" name="id"></input>
        	</form>
        	<form style="padding:0px;margin:0px" method="POST" action="<?= $_SERVER["REQUEST_URI"] ?>&error=3">
            <button style="float:left" class="team content">Admin only</button>
            <input hidden value="<?=$_GET['id']?>" name="id"></input>
        	</form>
			<?
		}
	}
	?>
	</div>
</div>

