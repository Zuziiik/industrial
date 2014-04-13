<?php
global $loggedIn;
global $admin;
global $confirmed;
global $username;

?>
	<div class="topPanelButtons">
		<ol>
			<?php
			if($loggedIn) {
					if($admin) {
						?>
						<li><a class='modern' href='index.php?page=users'>List of Users</a></li>
						<li><a class='modern' href='index.php?page=recipeTemplates'>Recipe Templates</a></li>
					<?php
					}
					?>
					<li><a class='modern'
					   href='index.php?page=profile&name=<?php echo $username; ?>'>Profile</a></li>
				<li><a class='modern' href='index.php?page=login&action=logout'>Logout</a></li>
			<?php
			} else {
				?>
					<li><a class='modern' href='index.php?page=login'>Login</a></li>
					<li><a class='modern' href='index.php?page=register'>Register</a></li>
			<?php
			}

			?>
		</ol>
	</div>

	<div class="banner"><span class='wikiName'>Industrial Craft Experimental - Wiki</span><img class="bannerImage"
																				  src="./pictures/banner.png" alt="banner"></div>
	<div class="menu modern embossed-link">
		<ol>
			<li><a class='modern' href='index.php?page=home'>Home</a></li>
			<li><a class='modern' href='index.php?page=recipes'>Recipes & Resources</a></li>
			<li><a class='modern ' href='index.php?page=tutorialList'>Tutorials</a></li>
			<li><a class='modern ' href='index.php?page=servers'>Servers</a></li>
			<li><a class='modern ' href='index.php?page=links'>Links</a></li>
		</ol>
	</div>
<?php
