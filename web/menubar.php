<div class="col-2 menu">
		<br>
			<center><h3 class="menu">Avafúlbo</h3>
			<hr class="menu">
			<div class="row">
				<a class="menubutton" href="index.php">
					<button class="menubutton team">Events</button>
				</a>
			</div>
			<? if(active_session() == 0){ ?>
			<div class="row">
				<a class="menubutton" href="login.php">
					<button class="menubutton team">Login</button>
				</a>
			</div>
			<div class="row">
				<a class="menubutton" href="register.php">
					<button class="menubutton team">Register</button>
				</a>
			</div>
			<? } else{ ?>
				<div class="row">
				<a class="menubutton" href="chat.php">
					<button class="menubutton team">Chat</button>
				</a>
				</div>
				<div class="row">
				<a class="menubutton" href="src/logout.php">
					<button class="menubutton team">Logout</button>
				</a>
				</div>
			<? } ?>
			</center>
	
		
	</div> <!-- Menu div -->