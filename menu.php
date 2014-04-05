<?php
global $loggedIn;
global $admin;
global $confirmed;
global $username;

?>
	<div id="topPanelButtons">
		<ol>
			<?php
			if($loggedIn) {
				?>
				<div class="loggedIn"> <?php
					if($admin) {
						?>
						<a class='modern' href='index.php?page=users'>List of Users</a>
						<a class='modern' href='index.php?page=recipeTemplates'>Recipe Templates</a>
					<?php
					}
					?>
					<a class='modern'
					   href='index.php?page=profile&name=<?php echo $username; ?>'>Profile</a>
				<a class='modern' href='index.php?page=login&action=logout'>Logout</a>
				</div>
			<?php
			} else {
				?>
				<div class="loggedOut">
					<a class='modern' href='index.php?page=login'>Login</a>
					<a class='modern' href='index.php?page=register'>Register</a>
				</div>
			<?php
			}

			?>
		</ol>
	</div>

	<div class="banner"><span class='wikiName'>Industrial Craft - Wiki</span><img class="bannerImage"
																				  src="./pictures/banner.png"></div>
	<div id=menu class="modern embossed-link">
		<ol>
			<li><a class='modern' href='index.php?page=home'>Home</a></li>
			<li><a class='modern' href='index.php?page=recipes'>Recipes & Resources</a></li>
			<li><a class='modern ' href='index.php?page=tutorialList'>Tutorials</a></li>
			<li><a class='modern ' href='index.php?page=servers'>Servers</a></li>
			<li><a class='modern ' href='index.php?page=links'>Links</a></li>
		</ol>
	</div>
<?php
