<?php
global $loggedIn;
global $admin;
global $confirmed;
global $username;

?>
    <div id=topPanel>
        <ol>
            <?php
            if ($loggedIn) {
                if ($admin) {
                    ?>
                    <a id='users' href='index.php?page=users'>List of Users</a>
                    <a id='recipeTemplates' href='index.php?page=recipeTemplates'>Recipe Templates</a>
                <?php
                }
                ?>
                <a id="profile" href='index.php?page=profile&name=<?php echo $username; ?>'>Profile</a>
                <a id="logout" href='index.php?page=login&action=logout'>Logout</a>
            <?php
            } else {
                ?>
                <a id="login" href='index.php?page=login'>Login</a>
                <a id="register" href='index.php?page=register'>Register</a>
            <?php
            }

            ?>
        </ol>
    </div>
    <div id=menu>
        <ol>
            <li><a href='index.php?page=home'>Home</a></li>
            <li><a href='index.php?page=recipes'>Recipes & Resources</a></li>
            <li><a href='index.php?page=tutorialList'>Tutorials</a></li>
            <li><a href='index.php?page=servers'>Servers</a></li>
            <li><a href='index.php?page=links'>Links</a></li>
        </ol>
    </div>
<?php

echo("<nav>");

echo("</nav>");

