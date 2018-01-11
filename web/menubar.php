

	<?php 

	if(isset($_SESSION['navbar']) && $_SESSION['navbar'] == 0){

		?>
			<div class="menu2" style="padding:1%">

				<a class="menubutton" href="/footballmixto/web/src/navbar.php">
				<button class="squarebutton team">
						<image width="16" height="16" src="/footballmixto/web/img/expand-icon.png">
						</image>
				</button>
				</a>

				<br><br>

				<a class="menubutton" href="/footballmixto/web/index.php">
				<button class="squarebutton team">
					<image width="16" height="16" src="/footballmixto/web/img/home.png">
					</image>
				</button>
				</a>
					
				<br><br>
				<? if(active_session() == 0){ ?>
				<a class="menubutton" href="/footballmixto/web/login.php">
					<button class="squarebutton team">
						<image width="16" height="16" src="/footballmixto/web/img/login.png">
						</image>
					</button>
				</a>
				<br><br>

				<a class="menubutton" href="/footballmixto/web/register.php">
					<button class="squarebutton team">
						<image width="16" height="16" src="/footballmixto/web/img/register.png">
						</image>
					</button>
				</a>

				<br><br>

				<? }

				elseif(active_session() == 1){ ?>

				<a class="menubutton" href="/footballmixto/web/randomizer.php">
					<button class="squarebutton team">
						<image width="16" height="16" src="/footballmixto/web/img/randomizer.png">
						</image>
					</button>
				</a>
				<br><br>

				<a class="menubutton" href="/footballmixto/web/profile.php">
					<button class="squarebutton team">
						<image width="16" height="16" src="/footballmixto/web/img/profile.png">
						</image>
					</button>
				</a>
				<br><br>

				<a class="menubutton" href="/footballmixto/web/src/logout.php">
					<button class="squarebutton team">
						<image width="16" height="16" src="/footballmixto/web/img/logout.png">
						</image>
					</button>
				</a>
				<br><br>

				<? } ?>

			</div> <!-- Menu div -->

				
		<?

	}
	else{
		?>
		<div class="col-2 menu">
		
		<br>

			<center><h3 class="menu">Avafúlbo</h3>
			

			<hr class="menu">
			<div class="row">
				<a class="menubutton" style="width:100%" href="/footballmixto/web/index.php">
					<button class="menubutton team">Events</button>
				</a>
			</div>
			<? if(active_session() == 0){ ?>
			<div class="row">
				<a class="menubutton" href="/footballmixto/web/login.php">
					<button class="menubutton team">Login</button>
				</a>
			</div>
			<div class="row">
				<a class="menubutton" href="/footballmixto/web/register.php">
					<button class="menubutton team">Register</button>
				</a>
			</div>
			<? } else{ ?>
				<div class="row">
				<a class="menubutton" href="/footballmixto/web/randomizer.php">
					<button class="menubutton team">Randomizer</button>
				</a>
				</div>
				<div class="row">
				<a class="menubutton" href="/footballmixto/web/profile.php">
					<button class="menubutton team">My profile</button>
				</a>
				</div>
				


				<div class="row">
				<a class="menubutton" href="/footballmixto/web/src/navbar.php">
					<button class="menubutton team">Collapse</button>
				</a>
				</div>

				<div class="row">
				<a class="menubutton" href="/footballmixto/web/src/logout.php">
					<button class="menubutton team">Logout</button>
				</a>
				</div>




			<? } ?>
			</center>
	
		
		</div> <!-- Menu div -->
		<?
	}


 include("svg/graph.html")


	?>