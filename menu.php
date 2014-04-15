<?php
global $loggedIn;
global $admin;
global $confirmed;
global $username;

$page = 'home';
if(isset($_GET['page'])){
    $page = sanitizeString($_GET['page']);
}

$home = '';
$recipes = '';
$tutorials = '';
$servers = '';
$links = '';
$users = '';
$templates = '';
$profile = '';
$login = '';
$register = '';

switch ($page) {
    case 'home' :
        $home = 'class="active"';
        break;
    case 'recipes' :
        $recipes = 'class="active"';
        break;
    case 'tutorialList' :
        $tutorials = 'class="active"';
        break;
    case 'servers' :
        $servers = 'class="active"';
        break;
    case 'links' :
        $links = 'class="active"';
        break;
    case 'users' :
        $users = 'class="active"';
        break;
    case 'recipeTemplates' :
        $templates = 'class="active"';
        break;
    case 'profile' :
        $profile = 'class="active"';
        break;
    case 'login' :
        $login = 'class="active"';
        break;
    case 'register' :
        $register = 'class="active"';
        break;
    default:
}



?>
    <nav class="navbar navbar-default" role="navigation">
        <div class="pull-right container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="pull-right navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php?page=home#">Wiki</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php
                    if($loggedIn) {
                        if($admin) {
                            ?>
                            <li <?php echo $users; ?>><a class='modern' href='index.php?page=users'>List of Users</a></li>
                            <li <?php echo $templates; ?>><a class='modern' href='index.php?page=recipeTemplates'>Recipe Templates</a></li>
                        <?php
                        }
                        ?>
                        <li <?php echo $profile; ?>><a class='modern'
                                                       href='index.php?page=profile&name=<?php echo $username; ?>'>Profile</a></li>
                        <li><a class='modern' href='index.php?page=login&action=logout'>Logout</a></li>
                    <?php
                    } else {
                        ?>
                        <li <?php echo $login; ?>><a class='modern' href='index.php?page=login'>Login</a></li>
                        <li <?php echo $register; ?>><a class='modern' href='index.php?page=register'>Register</a></li>
                    <?php
                    }

                    ?>
                </ul>
            </div>
        </div>

	</nav>
    <div class="page-header">
	<h1>Industrial Craft Experimental - Wiki</h1>
    <img class="img-responsive" src="./pictures/banner1.png" alt="banner">
    </div>
    <ul class="nav nav-tabs">
			<li <?php echo $home; ?>><a class='modern' href='index.php?page=home'>Home</a></li>
			<li <?php echo $recipes; ?>><a class='modern' href='index.php?page=recipes'>Recipes & Resources</a></li>
			<li <?php echo $tutorials; ?>><a class='modern ' href='index.php?page=tutorialList'>Tutorials</a></li>
			<li <?php echo $servers; ?>><a class='modern ' href='index.php?page=servers'>Servers</a></li>
			<li <?php echo $links; ?>><a class='modern ' href='index.php?page=links'>Links</a></li>
	</ul>
<?php
