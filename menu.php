<?php
global $loggedIn;
global $admin;
global $confirmed;
global $username;

?>
	<div id=topPanel>
		<ol>
			<?php
			if($loggedIn) {
				if($admin) {
					?>
					<a class='modern embossed-link' href='index.php?page=users'>List of Users</a>
					<a class='modern embossed-link' href='index.php?page=recipeTemplates'>Recipe Templates</a>
				<?php
				}
				?>
				<a class='modern embossed-link' href='index.php?page=profile&name=<?php echo $username; ?>'>Profile</a>
				<a class='modern embossed-link' href='index.php?page=login&action=logout'>Logout</a>
			<?php
			} else {
				?>
				<a class='modern embossed-link' href='index.php?page=login'>Login</a>
				<a class='modern embossed-link' href='index.php?page=register'>Register</a>
			<?php
			}

			?>
		</ol>
	</div>
	<div id=menu>
		<ol>
			<li><a class='modern embossed-link' href='index.php?page=home'>Home</a></li>
			<li><a class='modern embossed-link' href='index.php?page=recipes'>Recipes & Resources</a></li>
			<li><a class='modern embossed-link' href='index.php?page=tutorialList'>Tutorials</a></li>
			<li><a class='modern embossed-link' href='index.php?page=servers'>Servers</a></li>
			<li><a class='modern embossed-link' href='index.php?page=links'>Links</a></li>
		</ol>
	</div>
<?php

